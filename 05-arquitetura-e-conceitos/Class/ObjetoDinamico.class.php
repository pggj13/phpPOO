<?php

class ObjetoDinamico {

    public $Nome;
    public $Email;

    public function Novo($Cliente) {

        if (is_object($Cliente)):
            $this->Nome = $Cliente->Nome;
            $this->Email = $Cliente->Email;
        else:
            die("erro, informe o nome e email do cliente");
        endif;
    }

}
