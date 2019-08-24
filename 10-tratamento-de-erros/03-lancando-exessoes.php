<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Lançando Exessões</title>
    </head>
    <body>
        <?php
        $eu = null;

        if (!$eu):
            $a = new Exception("Eu é NULL", E_USER_NOTICE);
        endif;

        echo $a->getMessage();
        var_dump($a);
        echo "<hr>";

        try {

            if (!$eu):
                throw new Exception("Eu novamente está NULL", E_USER_NOTICE);
            endif;
            
            
        } catch (Exception $e) {
            echo "<p>Erro #{$e->getCode()}: {$e->getMessage()}<br>";
            echo "<small>{$e->getFile()} na linha {$e->getLine()}</small></p>";
            
//            echo "<hr>";
//            echo $e->xdebug_message;
        }
        ?>
    </body>
</html>
