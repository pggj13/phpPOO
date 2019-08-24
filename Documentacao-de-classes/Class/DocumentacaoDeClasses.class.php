<?php

/**
 * <b>DocumentacaoDeClasses:</b>
 * Está classe foi criada para mostrar a interação entre objetos.Logo depois replicamos ela para 
 * ver a documentação no PHPDoc
 * 
 * @copyright (c) 2018, PAULO GONÇALO GARCIA,TEC
 */
class DocumentacaoDeClasses {
    /*     * @var string nome da empresa */

    public $Empresa;
    /*     * @var int número de funcionários */
    public $Setores;

    /** @var InteracaoClasse * */
    public $Funcionario;

    public function __construct($Empresa) {
        $this->Empresa = $Empresa;
        $this->Setores = 0;
    }

    /**
     * <b>Contratar Funcionário:</b>Informe o objeto da classe interacaoClasse, o cargo e o salário
     * do funcionário a ser contratado!
     * 
     * @param object $Funcionario = Objeto da classe InteracaoClasse 
     * @param string $Cargo profissão ou cargo de um funcionário
     * @param float $Salario salário de um funcionário
     */
    public function Contratar($Funcionario, $Cargo, $Salario) {
        $this->Funcionario = (object) $Funcionario;
        $this->Funcionario->Trabalhar($this->Empresa, $Salario, $Cargo);
        $this->Setores += 1;
    }

    /**@return float retorna o salário do contratado */
    public function Pagar() {
        $this->Funcionario->Receber($this->Funcionario->Salario);
        return $this->Funcionario->Salario;
    }

    /**
     * 
     * @param string $Cargo = Cargo ou profissão de um funcionário
     * @param float $Salario = Salario de um funcionario
     */
    public function Promover($Cargo, $Salario = null) {
        $this->Funcionario->Profissao = $Cargo;
        if ($Salario):
            $this->Funcionario->Salario = $Salario;
        endif;
    }

    public function Funcionario($Funcionarios) {
        $this->Funcionario = (object) $Funcionarios;
    }

    public function Demitir($Recisao) {
        $this->Funcionario->Receber($Recisao);
        $this->Funcionario->Empresa = null;
        $this->Funcionario->Salario = null;
        $this->Setores -= 1;
    }

}
