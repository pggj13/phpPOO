<?php

class ComportamentoInicial {

    var $Nome;
    var $Idade;
    var $Profissao;
    var $Salario;

    public function __construct($Nome, $Idade, $Profissao, $Salario) {

        $this->Nome = (string) $Nome;
        $this->Idade = (int) $Idade;
        $this->Profissao = (string) $Profissao;
        $this->Salario = (float) $Salario;
    }

    public function ver() {
        echo "<pre>";
        print_r($this);
        echo "</pre>";
    }

}
