<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';

        $robson = new AcessoPublico("Robson", "campus@unesc.net");


        echo"<pre>";
        var_dump($robson);
        echo"</pre>";
        echo"<hr/>";
        ?>
    </body>
</html>
