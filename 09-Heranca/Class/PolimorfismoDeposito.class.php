<?php

class PolimorfismoDeposito extends Polimorfismo {

    public $Desconto;

    public function __construct($Produto, $valor) {
        parent::__construct($Produto, $valor);
        $this->Desconto = 15;
        $this->Metodo = 'Deposito';
    }

    function setDesconto($Desconto) {
        $this->Desconto = $Desconto;
    }

    public function Pagar() {
        $this->valor = ($this->valor / 100) * 100 - $this->Desconto;
        parent::Pagar();
    }

}
