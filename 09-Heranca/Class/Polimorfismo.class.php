<?php

class Polimorfismo {

    public $Produto;
    public $valor;
    public $Metodo;

    function __construct($Produto, $valor) {
        $this->Produto = $Produto;
        $this->valor = $valor;
        $this->Metodo = 'Boleto';
    }

    public function Pagar() {

        echo "Voce pagou {$this->valor} para um {$this->Produto}<br>";
        echo "<small>Pagamento efetuado via {$this->Metodo}</small><hr>";
    }

    public function Real($Valor) {
        return "R$ " . number_format($Valor, 2, ',', '.');
    }

}
