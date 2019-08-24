<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';

        $cliente = new ObjetoDinamico;
        
        $robson = new stdClass();
        $robson->Nome = "Paulo Joao";
        $robson->Email = "paulo@unesc.net";
        
        
        $cliente->Novo($robson);
        echo"<pre>";
        var_dump($cliente,$robson);
        echo"</pre>";
        echo"<hr/>";
        
        ?>
    </body>
</html>
