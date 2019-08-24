<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';
        $claseA = new AtributosMetodos;
        $claseB = new ClassesObjetos;
        $claseC = new InteracaoDeObjetosteste("TecGenius");
        
        var_dump($claseA,$claseB,$claseC);
        ?>
    </body>
</html>
