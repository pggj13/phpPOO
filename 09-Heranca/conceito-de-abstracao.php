<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './Class/Abstracao.class.php';
        
        $conta = new Abstracao("Robson V. Leite", 500);
        $conta = new Abstracao("Paulo Joao",200);
        $conta->Depositar(1000);
        $conta->Sacar(400);
        $conta->Transferir(200, $conta);
        
        echo"<pre>";
        print_r($conta);
        print_r($conta);
        echo"</pre>";
        echo"<hr/>";
        ?>
    </body>
</html>
