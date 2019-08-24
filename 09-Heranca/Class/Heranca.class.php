<?php

class Heranca {

    public $Nome;
    public $Idade;
    public $Formacao;

    function __construct($Nome, $Idade) {
        $this->Nome = $Nome;
        $this->Idade = $Idade;
        $this->Formacao = array();
    }

    public function Envelhecer() {
        $this->Idade += 1;
    }

    public function Formacao($Cursos) {
        $this->Formacao[] = (string) $Cursos;
    }

    public function verPessoa() {
        $Formacao = implode(',', $this->Formacao);
        echo"{$this->Nome} tem {$this->Idade} anos de idade. E formado em {$Formacao}<hr/>";
    }

}
