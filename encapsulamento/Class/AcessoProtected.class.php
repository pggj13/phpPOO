<?php

class AcessoProtected {

    public $Nome;
    protected $Email;

    function __construct($Nome, $Email) {
        $this->Nome = $Nome;
        $this->setEmail($Email);
    }

    public function setEmail($Email) {

        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)):
            die("Email invalido!");
        else:
            $this->Email = $Email;
        endif;
    }

    final protected function setNome($Nome) {
        $this->Nome = $Nome;
    }

}

class AcessoProtectedFilha extends AcessoProtected {

    protected $Cpf;

    public function AddCpf($Nome, $Cpf) {

        parent::setNome($Nome);
        $this->Cpf = $Cpf;
    }

}
