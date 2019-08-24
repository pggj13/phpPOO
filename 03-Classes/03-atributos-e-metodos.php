<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './Class/AtributosMetodos.class.php';
        $pessoa = new AtributosMetodos;
        $pessoa->setUsuarios('Paulo Joao',26,'Estudante');
        $pessoa->envelhecer();
        $usuarios = $pessoa->getUsuarios();
        echo $usuarios;
        echo "<hr/>";
        $pessoa->getClass();
        
        ?>
    </body>
</html>
