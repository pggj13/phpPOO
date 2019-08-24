<?php

class Upload {

    private $File;
    private $Name;
    private $Send;

    /**
     * IMAGE UPLOAD
     */
    private $Width;
    private $Image;

    /** RESULTSET */
    private $Result;
    private $Error;

    /** DIRETORIOS */
    private $Folder;
    private static $BaseDir;

    function __construct($BaseDir = null) {
        self::$BaseDir = ((string) $BaseDir ? $BaseDir : '../uploads/');
        if (!file_exists(self::$BaseDir) && !is_dir(self::$BaseDir)):
            mkdir(self::$BaseDir, 0777);
        endif;
    }

    public function Image(array $Image, $Name = null, $Width = null, $Folder = null) {
        $this->File = $Image;
        $this->Name = ((string) $Name ? $Name : substr($Image['name'], 0, strrpos($Image['name'], '.')));
        $this->Width = ((int) $Width ? $Width : 1024);
        $this->Folder = ((String) $Folder ? $Folder : 'images');

        $this->CheckFolder($this->Folder);
        $this->setFileName();
        $this->UpdateImagem();
    }

    public function File(array $File, $Name = null, $Folder = null, $MaxFileSize = null) {
        $this->File = $File;
        $this->Name = ((string) $Name ? $Name : substr($File['name'], 0, strrpos($File['name'], '.')));
        $this->Folder = ((String) $Folder ? $Folder : 'files');
        /**
         * Determina o tamanho do arquivo
         * Neste caso so vai aceitar arquivos de 2mb
         */
        $MaxFileSize = ((int) $MaxFileSize ? $MaxFileSize : 2);

        /**
         * @var $FileAccept varia que guarda os arquivos 
         * aceite pelo sistema
         * Apenas configurei para aceitar arquivos docx e pdf
         */
        $FileAccept = [
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/pdf'
        ];

        /**
         * Aqui ele verifica se o arquivo e maior que 2mb
         * so o arquivo aperece em byte esta funcao(($MaxFileSize * (1024 * 1024)))
         * faz a conversao de mb para byte
         */
        if ($this->File['size'] > ($MaxFileSize * (1024 * 1024))):
            $this->Result = false;
            $this->Error = "Arquivo muito grande, tamanho maximo permitido de {$MaxFileSize}mb";
        elseif (!in_array($this->File['type'], $FileAccept)):
            $this->Result = false;
            $this->Error = 'Tipo de arquivo nao suportado, envie arquivos .PDF OU .DOCX';

        else:
            $this->CheckFolder($this->Folder);
            $this->setFileName();
            $this->MoveFile();
        endif;
    }

    public function Media(array $Media, $Name = null, $Folder = null, $MaxFileSize = null) {
        $this->File = $Media;
        $this->Name = ((string) $Name ? $Name : substr($Media['name'], 0, strrpos($Media['name'], '.')));
        $this->Folder = ((String) $Folder ? $Folder : 'Midias');
        /**
         * Determina o tamanho do arquivo midia
         * Neste caso so vai aceitar arquivos midias de 8mb
         */
        $MaxFileSize = ((int) $MaxFileSize ? $MaxFileSize : 40);

        /**
         * @var $FileAccept varia que guarda os arquivos 
         * aceite pelo sistema
         * Apenas configurei para aceitar arquivos docx e pdf
         */
        $FileAccept = [
            'audio/mp3',
            'video/x-ms-wmv',
            'video/mp4',
        ];

        /**
         * Aqui ele verifica se o arquivo e maior que 2mb
         * so o arquivo aperece em byte esta funcao(($MaxFileSize * (1024 * 1024)))
         * faz a conversao de mb para byte
         */
        if ($this->File['size'] > ($MaxFileSize * (1024 * 1024))):
            $this->Result = false;
            $this->Error = "Arquivo muito grande, tamanho maximo permitido de {$MaxFileSize}mb";
        elseif (!in_array($this->File['type'], $FileAccept)):
            $this->Result = false;
            $this->Error = 'Tipo de arquivo nao suportado, envie audio MP3 OU videos MP4';

        else:
            $this->CheckFolder($this->Folder);
            $this->setFileName();
            $this->MoveFile();
        endif;
    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }

    //PRIVATE 
    private function CheckFolder($Folder) {

        list($y, $m) = explode('/', date('Y/m'));
        $this->CreateFolder("{$Folder}");
        $this->CreateFolder("{$Folder}/{$y}");
        $this->CreateFolder("{$Folder}/{$y}/{$m}/");
        $this->Send = "{$Folder}/{$y}/{$m}/";
    }

    private function CreateFolder($Folder) {

        if (!file_exists(self::$BaseDir . $Folder) && !is_dir(self::$BaseDir . $Folder)):
            mkdir(self::$BaseDir . $Folder, 0777);
        endif;
    }

    private function setFileName() {
        $FileName = Check::Name($this->Name) . strrchr($this->File['name'], '.');

        // die($FileName);
        if (file_exists(self::$BaseDir . $this->Send . $FileName)):
            $FileName = Check::Name($this->Name) . '-' . time() . strrchr($this->File['name'], '.');
        endif;
        $this->Name = $FileName;
    }

    //Realiza o upload de imagem redimencionando a mesma
    private function UpdateImagem() {

        /**
         * SITE PARA PEGAR TODOS OS FORMATOS CONSULTAR NA GOOGLE: MEMIS TYPE
         */
        switch ($this->File['type']) :
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->Image = imagecreatefromjpeg($this->File['tmp_name']);
                break;
            case 'image/png':
            case 'image/x-png':
                $this->Image = imagecreatefrompng($this->File['tmp_name']);
                break;
        endswitch;
        if (!$this->Image):
            $this->Error = 'Tipo de arquivo nao existe, envie imagem JPG OU PNG';
        else:

            /**
             * faz com que a imagem nao perca a sua qualidade ao diminuir
             */
            $x = imagesx($this->Image);
            $y = imagesy($this->Image);

            $ImageX = ($this->Width < $x ? $this->Width : $x);
            $ImageH = ($ImageX * $y) / $x;

            $newImage = imagecreatetruecolor($ImageX, $ImageH); //transforma em uma nova imagem
            imagealphablending($newImage, false); //faz com que aceite imagem transparentes
            imagesavealpha($newImage, true);

            /**
             * dst = Destino
             * src = caminho
             */
            imagecopyresampled($newImage, $this->Image, 0, 0, 0, 0, $ImageX, $ImageH, $x, $y);

            /**
             * Validacao do nome da Imagem
             */
            switch ($this->File['type']) :
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/pjpeg':
                    imagejpeg($newImage, self::$BaseDir . $this->Send . $this->Name);
                    break;
                case 'image/png':
                case 'image/x-png':
                    imagepng($newImage, self::$BaseDir . $this->Send . $this->Name);
                    break;
            endswitch;
            /**
             * Verifica se a imagem foi criada
             */
            if (!$newImage):
                $this->Result = false;
                $this->Error = 'Tipo de arquivo nao existe, envie imagem JPG OU PNG';
            else:
                $this->Result = $this->Send . $this->Name;
                $this->Error = null;
            endif;
            /**
             * Destroi a imagem na memoria depois de ser utilizado
             * para poder liberar espaco no memoria
             * porque ja foi enviado a imagem na propria pasta
             */
            imagedestroy($this->Image);
            imagedestroy($newImage);
        endif;
    }

    /**
     * Envia arquivos e midias
     */
    private function MoveFile() {

        /** verifica se enviou o arquivo */
        if (move_uploaded_file($this->File['tmp_name'], self::$BaseDir . $this->Send . $this->Name)):
            $this->Result = $this->Send . $this->Name; //Passa no result o caminho e o nome da pasta
            $this->Error = null;
        else:
            $this->Result = false;
            $this->Error = 'Erro ao mover o arquivo, por favor tente mais tarde';
        endif;
    }

    private function MoveMidia() {

        /** verifica se enviou o arquivo */
        if (move_uploaded_file($this->File['tmp_name'], self::$BaseDir . $this->Send . $this->Name)):
            $this->Result = $this->Send . $this->Name; //Passa no result o caminho e o nome da pasta
            $this->Error = null;
        else:
            $this->Result = false;
            $this->Error = 'Erro ao mover o arquivo, por favor tente mais tarde';
        endif;
    }

}
