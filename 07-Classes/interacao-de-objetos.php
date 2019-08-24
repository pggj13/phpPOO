<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './Class/InteracaoDeObjetos.class.php';
        require './Class/InteracaoClasse.class.php';

        $robson = new InteracaoClasse("Paulo", 26, 'Programador', 2000);
        $marcos = new InteracaoClasse("Delfina Garcia", 20, "Analista de Sistema", 500);

        $tecGenius = new InteracaoDeObjetos("TECGENIUS ANGOLA");
        $tecGenius->Contratar($robson, "Programador Junior", 1000);
        $tecGenius->Pagar();
        $tecGenius->Promover("Gerente de projetos", 12000);
        $tecGenius->Pagar();
        $tecGenius->Demitir(5000);

        $tecGenius->Contratar($marcos, "Analista", 1000);
        $tecGenius->Pagar();


        var_dump($robson,$marcos, $tecGenius);
        ?>
    </body>
</html>
