<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';

        $maria = new AcessoProtected("Robson", "campus@unesc.net");

        $maria->Nome = "Carlos";

        echo"<pre>";
        var_dump($maria);
        echo"</pre>";
        echo"<hr/>";

        $pablo = new AcessoProtectedFilha("Pablo", "paulo@unesc.net");
        $pablo->AddCpf("Pablo","377366366363");
        echo"<pre>";
        var_dump($pablo);
        echo"</pre>";
        echo"<hr/>";
        ?>
    </body>
</html>
