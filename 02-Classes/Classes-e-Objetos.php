<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './Class/ClassesObjetos.class.php';
        $teste = new ClassesObjetos;
        $teste->getClass('De introducao', 'mostrar uma classe');
        $teste->verClass();
        
        $teste->Classe = 'Classe 2';
        $teste->Funcao = 'Ver os Atributos';
        $teste->verClass();

        //print_r($teste);
        //exit;
        ?>
    </body>
</html>
