<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';
        $documentar = new DocumentacaoDeClasses("TEC");
        $documentar->Promover("Gerente");
        ?>
    </body>
</html>
