<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Helpers :: Paginação de resultados</title>
    </head>
    <body>
        <?php
        require('./_app/Config.inc.php');

        $Atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
        //print_r($Atual);exit;
        $Pager = new Pager('04-gestao-de-resultados.php?atual=', 'Primeira', 'Última');
        $Pager->ExePager($Atual, 1);

        $read = new Read;
        $read->ExeRead('ws_categories', 'LIMIT :limit OFFSET :offset', "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

        if (!$read->getRowCount()):
            $Pager->ReturnPage();
            echo 'Não existem resultados!<hr>';
        else:
            var_dump($read->getResult());
        endif;


        $Pager->ExePaginator('ws_categories');
        echo $Pager->getPaginator();

//        var_dump($Pager);
        ?>
    </body>
</html>
