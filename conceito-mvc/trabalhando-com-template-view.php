<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require('./_app/Config.inc.php');

        $read = new Read;
        $read->ExeRead('ws_categories');
        $tpl = file_get_contents('_mvc/category.tpl.html');

        foreach ($read->getResult() as $cat):
            extract($cat);
        
            $cat['pubdate'] = date('Y-m-d', strtotime($cat['category_date']));
            $links = explode('&', '#' . implode('#&#', array_keys($cat)) . '#');
            echo str_replace($links, array_values($cat), $tpl);

            //var_dump($links);

        endforeach;
        ?>

    </body>
</html>
