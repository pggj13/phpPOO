<?php

/**
 * Session Class [HELPER]
 * Responsavel pelas estatisticas,sessões, atualizações e tráfico do sistema
 * @copyright (c) 2018, Paulo joao,TecGenius
 */
class Session {
    /*
     * @var $Date = Define a data desta sessao
     * @var $Cache = ##     o tempo de sessao
     * @var $Traffic = Gerencia o trafico do site
     * @var $Browser = Descubrir qual navegador e fazer a contagem
     */

    private $Date;
    private $Cache;
    private $Traffic;
    private $Browser;

    function __construct($Cache = null) {
        session_start();
        $this->CheckSession($Cache);
    }

    //Verifica e executa todos os metodos da classe
    private function CheckSession($Cache = null) {

        $this->Date = date('Y-m-d');
        $this->Cache = ((int) $Cache ? $Cache : 20);

        if (empty($_SESSION['useronline'])):
            $this->setTraffic();
            $this->setSession();
            $this->CheckBrowser();
            $this->setUsuarios();
            $this->BrowserUpdate();
        else:

            $this->TrafficUpdate();
            $this->sessionUpdate();
            $this->CheckBrowser();
            $this->UsuarioUpdate();
            $this->Browser = null;

        endif;
        $this->Date = null;
    }

    /**
     * ########################################
     * |########## SESSAO DO USUARIO #########|
     * ########################################
     */
    //Inicia a sessao do usuario
    private function setSession() {

        $_SESSION['useronline'] = [
            "online_session" => session_id(),
            "online_startview" => date('Y-m-d H:i:s'),
            "online_endview" => date('Y-m-d H:i:s', strtotime("+{$this->Cache}minutes")),
            "online_ip" => filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP),
            "online_url" => filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT),
            "online_agent" => filter_input(INPUT_SERVER, "HTTP_USER_AGENT", FILTER_DEFAULT)//Armazena os dados do navegador
        ];
    }

    //Atualiza a session do usuario
    private function sessionUpdate() {

        $_SESSION['useronline']['online_endview'] = date('Y-m-d H:i:s', strtotime("+{$this->Cache}minutes"));
        $_SESSION['useronline']['online_url'] = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT);
    }

    /**
     * ########################################
     * |## USUARIOS,VISISTAS,ATUALIZAÇÕES ####|
     * ########################################
     */
    //Verifica e insere Trafico na Tabela
    public function setTraffic() {

        $this->getTraffic();
        if (!$this->Traffic):

            $ArrSiteViews = [
                'siteviews_date' => $this->Date,
                'siteviews_users' => 1, //vai contar quando inicializar cookie
                'siteviews_views' => 1, //vai contar quando inicializar uma sessao
                'siteviews_pages' => 1 //vai contar sempre que a pagina for carregada
            ];
            $CreateSiteViews = new Create;
            $CreateSiteViews->ExeCreate('ws_siteviews', $ArrSiteViews);
        else:

            /**
             * Verifica se existe um cookie de um usuario
             * caso nao existe ele incrementa(siteviews_users,siteviews_views,siteviews_pages)
             * 
             * caso existe um cookie quer dizer que o mesmo usuario
             * entao ele incrementa (siteviews_views,siteviews_pages)
             * nao atualizando o usuario num periodo de 24h
             */
            if (!$this->getCookie()):

                $ArrSiteViews = [
                    'siteviews_users' => $this->Traffic['siteviews_users'] + 1,
                    'siteviews_views' => $this->Traffic['siteviews_views'] + 1,
                    'siteviews_pages' => $this->Traffic['siteviews_pages'] + 1
                ];
            else:
                $ArrSiteViews = [
                    'siteviews_views' => $this->Traffic['siteviews_views'] + 1,
                    'siteviews_pages' => $this->Traffic['siteviews_pages'] + 1
                ];
            endif;

            $updateSiteViews = new Update;
            $updateSiteViews->ExeUpdate("ws_siteviews", $ArrSiteViews, "WHERE siteviews_date =:data", "data={$this->Date}");
        endif;
    }

    //Verifica e atualiza os pageviews
    private function TrafficUpdate() {
        $this->getTraffic();
        $ArrSiteViews = ['siteviews_pages' => $this->Traffic['siteviews_pages'] + 1];
        $updatePageViews = new Update;
        $updatePageViews->ExeUpdate("ws_siteviews", $ArrSiteViews, "WHERE siteviews_date =:data", "data={$this->Date}");

        $this->Traffic = null; //Depois de atualizar o trafico limpa o espaco na memoria
    }

    //Óbtem os dados da tabela [HELPER TRAFFIC]
    //ws_siteviews
    private function getTraffic() {

        $ReadSiteViews = new Read;
        $ReadSiteViews->ExeRead("ws_siteviews", "WHERE siteviews_date = :data", "data={$this->Date}");
        if ($ReadSiteViews->getRowCount()):
            $this->Traffic = $ReadSiteViews->getResult()[0];
        endif;
    }

    //Verifica, cria e atualiza o  cookie do usuario[HELPER TRAFFIC]
    private function getCookie() {

        $Cookie = filter_input(INPUT_COOKIE, 'useronline', FILTER_DEFAULT);
        /**
         * Verifica se ja contou este cookie neste dia 
         * caso passa 86400 que e o segundo de um dia completo 
         * faz mais uma contagem
         */
        setcookie("useronline", base64_encode("upinside"), time() + 86400);
        if (!$Cookie):
            return false;
        else:
            return true;
        endif;
    }

    /**
     * ########################################
     * |####### NAVEGADORES DE ACESSOS #######|
     * ########################################
     */
    //Identifica o navegador do usuario
    private function CheckBrowser() {

        $this->Browser = $_SESSION['useronline']['online_agent'];
        /**
         * Verifica se existe a palavra Chrome string $this->Browser
         */
        if (strpos($this->Browser, 'Chrome')):
            $this->Browser = 'Chrome';
        elseif (strpos($this->Browser, 'MSIE') || strpos($this->Browser, 'Trident/'))://Identifica internet explore 11
            $this->Browser = 'IE';
        elseif (strpos($this->Browser, 'Firefox')):
            $this->Browser = 'Firefox';
        else:
            $this->Browser = 'Outros';
        endif;
    }

    //Atualiza a tabela com dados do navegador
    private function BrowserUpdate() {

        $readAgent = new Read;

        $readAgent->ExeRead("ws_siteviews_agent", "WHERE agent_name =:agent", "agent={$this->Browser}");
        if (!$readAgent->getRowCount()):


            $ArrayAgent = [
                'agent_name' => $this->Browser,
                'agent_views' => 1
            ];
            $createAgent = new Create;


            $createAgent->ExeCreate("ws_siteviews_agent", $ArrayAgent);
        else:

            $ArrayAgent = [
                'agent_views' => $readAgent->getResult()[0]['agent_views'] + 1
            ];
            $updateAgent = new Update;

            $updateAgent->ExeUpdate("ws_siteviews_agent", $ArrayAgent, "WHERE agent_name =:agent", "agent={$this->Browser}");

        endif;
    }

    /**
     * ########################################
     * |########## USUÁRIOS ONLINES ##########|
     * ########################################
     */
    //Cadastra usuarios online na tabela
    private function setUsuarios() {

        $SesionOnline = $_SESSION['useronline'];
        $SesionOnline['agent_name'] = $this->Browser;

        $userCreate = new Create;
        $userCreate->ExeCreate("ws_siteviews_online", $SesionOnline);
    }

    private function UsuarioUpdate() {

        $ArrOnline = [
            'online_endview' => $_SESSION['useronline']['online_endview'],
            'online_url' => $_SESSION['useronline']['online_url']
        ];

        $userOnlineUpdate = new Update;
        $userOnlineUpdate->ExeUpdate("ws_siteviews_online", $ArrOnline, "WHERE online_session = :session", "session={$_SESSION['useronline']['online_session']}");

        if (!$userOnlineUpdate->getRowCount()):
            $ReadSession = new Read();
            $ReadSession->ExeRead("ws_siteviews_online", "WHERE online_session = :onsession", "onsession={$_SESSION['useronline']['online_session']}");
            if (!$ReadSession->getRowCount()):
                $this->setUsuarios();
            endif;
        endif;
    }

}
