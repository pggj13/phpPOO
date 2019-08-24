<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './Class/ComportamentoInicial.class.php';

        $robert = new ComportamentoInicial('Paulo Joao', 26, "Programador", 1200);
        $robert->ver();
        ?>
    </body>
</html>
