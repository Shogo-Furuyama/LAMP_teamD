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
require_once($CMS_COMMON_INCLUDE_DIR . "submitcheck.php");
require_once("inc_smarty.php");

$ERR_STR = '';
$path = false;
if(isset($_GET['path'])) {
    $path = rawurlencode($_GET['path']);
}

/* データベースへ登録 */
if (isset($_POST['user_name']) && isset($_POST['mail']) && isset($_POST['password'])) {
	$regflg = true;
	if (!preg_match('/^.{1,20}$/u',$_POST['user_name'])) {
		$regflg = false;
	}else if(!preg_match('/^[a-zA-Z0-9_+-]+(\.[a-zA-Z0-9_+-]+)*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/',$_POST['mail'])){
		$regflg = false;
	}else if(!preg_match('/^[\x21-\x7e]{8,}$/',$_POST['password'])){
		$regflg = false;
	}else if((new cuser())->get_tgt_login(false,$_POST['mail'])!==false){
		$ERR_STR .= "メールアドレスが重複しています\n";
		$regflg = false;
	}
	if($regflg){
		$dataarr = array();
		$dataarr['user_name'] = (string) $_POST['user_name'];
		$dataarr['mail'] = (string) $_POST['mail'];
		$dataarr['password'] = cutil::pw_encode($_POST['password']);
		$ccheng = new cchange_ex();
		$ccheng->insert(false, 'user_table', $dataarr);
		if($path === false) {			
			cutil::redirect_exit('register_end.php');
		}else {
			cutil::redirect_exit('register_end.php?path=' . $path);
		}
	}
}

$smarty->assign('path', $path);
$smarty->assign('ERR_STR', $ERR_STR);

//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('register.tmpl');


?>