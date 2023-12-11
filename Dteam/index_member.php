<?php
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
//以下はセッションメンバー管理用のインクルード
require_once($CMS_COMMON_INCLUDE_DIR . "auth_member.php");

//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('index_member.tmpl');


?>
