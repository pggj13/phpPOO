<?php

 class Abstracao {

    public $Cliente;
    public $Conta;
    public $Saldo;

    function __construct($Cliente, $Saldo) {
        $this->Cliente = $Cliente;
        $this->Saldo = $Saldo;
    }

    public function Depositar($Valor) {
        $this->Saldo += (float) $Valor;
        echo "<span style='color:green'><b>{$this->Conta}:</b> Deposito de {$this->Real($Valor)} efetuado com sucesso!</span><br>";
    }

    public function Sacar($Valor) {
        $this->Saldo -= (float) $Valor;
        echo "<span style='color:red'><b>{$this->Conta}:</b> Saque de {$this->Real($Valor)} efetuado com sucesso!</span><br>";
    }

    /**
     * @param Abstracao $Destino
     */
    public function Transferir($Valor, $Destino) {

        if ($this === $Destino) {
            echo "Voce nao pode transferir valores pra mesma conta!<br>";
        } else {
            echo"<hr>";
            $this->Sacar($Valor);
            $Destino->Depositar($Valor);
            echo "<span style='color:blue'><b>{$this->Conta}:</b> Transferencia de {$this->Real($Valor)} efetuado com sucesso de {$this->Cliente} para {$Destino->Cliente}!</span><br>";
            echo"<hr>";
        }
    }

    public function Extrato() {
        echo "<hr><hr>Ola {$this->Cliente}.Seu saldo em {$this->Conta} e de {$this->Real($this->Saldo)}<hr>";
    }

    public function Real($Valor) {
        return "R$ " . number_format($Valor, 2, '.', ',');
    }

}
