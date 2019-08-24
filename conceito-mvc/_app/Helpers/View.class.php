<?php

/**
 * View Class [HELPER]
 * Classe responsavel para mandar informacao do controller para view
 * Arquitetura mvc
 * @copyright (c) 2018, Paulo Joao,TecGenius
 */
class View {

    private static $Data; //Todos os dados
    private static $Keys; //var todos os links do template
    private static $Values; //Armazena os valores que vao ser substituido
    private static $Template; // var responsavel pelo template

    public static function Load($Template) {
        self::$Template = (String) $Template;
        self::$Template = file_get_contents(self::$Template . '.tpl.html');
        var_dump(self::$Template);
    }

    public static function Show(array $Data) {
        self::setKeys($Data);
        self::setValues();
        self::ShowView();
    }

    public static function Request($File, $Data) {
        extract($Data);
        require "{$File}.inc.php";
    }

    //PRIVATE

    private static function setKeys($Data) {
        self::$Data = $Data;
        self::$Keys = explode('&', '#' . implode('#&#', array_keys(self::$Data)) . '#');
    }

    private static function setValues() {
        self::$Values = array_values(self::$Data);
    }

    private static function ShowView() {
        echo str_replace(self::$Keys, self::$Values, self::$Template);
    }

}
