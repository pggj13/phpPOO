<?php

/**
 * USAMOS AQUI SOBRE CARGAAS DE METODOS
 */
class PolimorfismoCartao extends Polimorfismo {

    public $Juros;
    public $Encargos;
    public $Parcelas;
    public $NumParcelas;

    function __construct($Produto, $valor) {
        parent::__construct($Produto, $valor);
        $this->Juros = 1.17;
        $this->Metodo = 'Cartao de Credito';
    }

    public function Pagar($Parcelas = null) {

        $this->setNumParcelas($Parcelas);
        $this->setEncargos();
        $this->valor = $this->valor + $this->Encargos;
        $this->Parcelas = $this->valor / $this->NumParcelas;

        echo "Voce pagou {$this->Real($this->valor)} para um {$this->Produto}<br>";
        echo "<small>Pagamento efetuado via {$this->Metodo} em {$this->NumParcelas}x iguais de {$this->Real($this->Parcelas)}</small><hr>";
    }

    /** para 5,5% informe 5.5 */
    function setJuros($Juros) {
        $this->Juros = $Juros;
    }

    function setEncargos() {
        $this->Encargos = ($this->valor * ($this->Juros / 100)) * $this->NumParcelas;
    }

    function setParcelas($Parcelas) {
        $this->Parcelas = $Parcelas;
    }

    function setNumParcelas($NumParcelas) {
        $this->NumParcelas = ((int) $NumParcelas >= 1 ? $NumParcelas : 1);
    }

}
