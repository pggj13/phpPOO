<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Helpers :: Manipulação e Validação</title>
    </head>
    <body>
        <?php
        //mod8_01_arquivo.txt
        //mod8_01_material.rar
        
        require ('./_app/Config.inc.php');        
        //$check = new Check;
        //var_dump($check);
        
        $Email = 'robson@upinside.com';
        
        if(Check::Email($Email)):
            echo 'Válido! <hr>';
        else:
            echo 'Inválido! <hr>';
        endif;
        
        $Name = 'Estamos aprendendo PHP. Veja você como é!';
        echo Check::Name($Name) . '<hr>';
        
        $Data = '05/01/2014 13:14:20';
        $Data = '05/01/2014';
        echo Check::Data($Data) .'<hr>';
        
        $String = 'Olá mundo, estamos estudando PHP na UpInside!';
        echo Check::Words($String, 5, '<small>continue lendo...</small><hr>');
        
        echo Check::CatByName('artigos') . '<hr>';
        echo Check::CatByName('esportes') . '<hr>';
        //echo Check::CatByName('internet') . '<hr>';
        
        echo Check::UserOnline() . '<hr>';
        
      //echo Check::Image('google.jpg', 'Google!');
        echo Check::Image('google.jpg', 'Google!', 300, 180);
        
        ?>
        
        
    </body>
</html>
