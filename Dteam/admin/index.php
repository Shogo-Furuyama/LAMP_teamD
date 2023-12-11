<?php
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
require_once($CMS_COMMON_INCLUDE_DIR . 'auth_adm.php');


//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('admin/index.tmpl');
