<?php
/*!
@file member_list_smarty.php
@brief メンバー一覧(Smarty版)
@copyright Copyright (c) 2021 Yamanoi Yasushi.
*/

/////////////////////////////////////////////////////////////////
/// 実行ブロック
/////////////////////////////////////////////////////////////////

//ライブラリをインクルード
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");


$path = false;
if(isset($_GET['path'])) {
    $path = rawurlencode($_GET['path']);
}
$smarty->assign('path', $path);

//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('register_end.tmpl');


?>