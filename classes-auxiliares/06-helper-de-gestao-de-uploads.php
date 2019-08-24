<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet"href="css/reset.css"/>
    </head>
    <body>
        <?php
        require './_app/Config.inc.php';

        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ($form && $form['sendImage']):

            $upload = new Upload('uploads/');
            $Imagem = $_FILES['imagem'];

            $upload->Image($Imagem);
            if (!$upload->getResult()):
                WSErro("Erro ao enviar a imagem:<br><b><small>{$upload->getError()}</small></b>", WS_ERROR);
            else:
                WSErro("Imagem enviada com sucesso:<br><b><small>{$upload->getResult()}</small></b>", WS_ACCEPT);
            endif;
            var_dump($upload);
        endif;
        ?>
        <form method="POST" action=""enctype="multipart/form-data">
            <label>
                <input type="file"name="imagem"/>
            </label>
            <input type="submit"name="sendImage"value="Enviar Arquivo:"/>
        </form>
    </body>
</html>
