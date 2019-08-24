<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Generic Crud :: Update</title>
    </head>
    <body>
        <?php
        require('./_app/Config.inc.php');
        //ws_siteviews_agent
        
        $Dados = ['agent_name' => 'Internet explora', 'agent_views' => '120'];
        
        $update = new Update;
        $update->ExeUpdate('ws_siteviews_agent', $Dados, "WHERE agent_id = :id", 'id=4');
        
        if($update->getResult()):
            echo "{$update->getRowCount()} dado(s) atualizados com sucesso!<hr>";
        endif;
        
        $update->setPlaces('id=6');
        $update->setPlaces('id=7');
        $update->setPlaces('id=8');
        
//        var_dump($update);
        ?>
    </body>
</html>
