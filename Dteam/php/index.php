<?php
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");


    //$urlで〇〇.phpを指定する
    /*<?php view(遷移先のphp)?>
    */
    function view($url)
    {
        return "http://150.95.36.201/~j2023d/"+ $url;
    }

//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('index.tmpl');
