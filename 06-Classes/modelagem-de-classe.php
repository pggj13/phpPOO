<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './Class/ModelagemDeClasses.class.php';
        $robson = new ModelagemDeClasses("Paulo", 26, "Programador", 1200);
        $robson->Trabalhar("Desenvolver portal", 1200);
        
        var_dump($robson);
        ?>
    </body>
</html>
