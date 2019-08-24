<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './Class/ReplicaClonagem.class.php';
        $ReadA = new ReplicaClonagem("posts", "categorias = noticias","ORDER BY DESC data");
        $ReadA->Ler();
        
        $ReadA->setTermos("categorias = internet");
        $ReadA->Ler();
        
        $ReadB = $ReadA;
        
        $ReadB->setTermos("categorias = produtos");
        $ReadB->Ler();
        
        $ReadC = clone($ReadA);
        $ReadC->setTabela("comentarios");
        $ReadC->setTermos("posts = 25");
        $ReadC->Ler();
        
        
        var_dump($ReadA,$ReadB,$ReadC);
        ?>
    </body>
</html>
