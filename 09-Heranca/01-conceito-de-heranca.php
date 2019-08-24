<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';

        /* $pessoa = new Heranca("Paulo joao", 26);
          $pessoa->Formacao("PHP");
          $pessoa->Formacao("JAVASCRIPT");
          $pessoa->Envelhecer();
          $pessoa->verPessoa();
          var_dump($pessoa);

          echo"<hr/>";

          $pessoaHe = new HerancaJuridica("Laurindo Jorge", 27, 'TECGENIUS');
          $pessoaHe->Formacao("PHP");
          $pessoaHe->Formacao("JAVASCRIPT");
          $pessoaHe->Envelhecer();
          $pessoaHe->Contratar("Delfina Garcia");
          $pessoaHe->verPessoa();

          var_dump($pessoaHe);


          echo"<hr/>";
         * 
         */

        //instancia usando polimorfismo

        $boleto = new Polimorfismo("PHPDOZEROAOPROFISSIONAL", 334.90);
        $boleto->Pagar();
        echo"<pre>";
        print_r($boleto);
        echo"</pre>";
        echo"<hr/>";

        $deposito = new PolimorfismoDeposito("PHPDOZEROAOPROFISSIONAL", 334.90);
        $deposito->Pagar();
        echo"<pre>";
        print_r($deposito);
        echo"</pre>";
        echo"<hr/>";
        
        $cartao = new PolimorfismoCartao("PHPDOZEROAOPROFISSIONAL", 334.90);
        //$cartao->Pagar();
        $cartao->Pagar(10);
        echo"<pre>";
        print_r($cartao);
        echo"</pre>";
        echo"<hr/>";
        ?>
    </body>
</html>
