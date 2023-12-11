<?php
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
require_once($CMS_COMMON_INCLUDE_DIR . "auth_member.php");

//リストをランダムで取得
$smarty->assign('list', (new clist())->get_rand_list(false));
$smarty->assign('FILEUP_DIR', $CMS_FILEUP_DIR);

//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('index.tmpl');
