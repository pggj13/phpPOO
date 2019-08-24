<?php

class AtributosMetodos {

    var $Nome;
    var $Idade;
    var $Profissao;

    public function setUsuarios($Nome, $Idade, $Profissao) {

        $this->Nome = $Nome;
        $this->Profissao = $Profissao;
        $this->setIdade($Idade);
    }

    public function getUsuarios() {
        return "{$this->Nome} tem anos de {$this->Idade}. E trabalha como {$this->Profissao}";
    }

    public function getClass() {
        echo "<pre>";
        print_r($this);
        echo "</pre>";
    }

    public function setIdade($Idade) {
        if (!is_int($Idade)):
            die('Idade informada eh Incorreto!');
        else:
            $this->Idade = $Idade;
        endif;
    }

    public function envelhecer() {
        $this->Idade = $this->Idade + 1;
    }

}
