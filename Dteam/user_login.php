<?php
/*!
@file login.php
@brief  ログイン（フロント）
@copyright Copyright (c) 2017 Yamanoi Yasushi.
*/

require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");

$ERR_STR = "";
$path = false;
if(isset($_GET['path'])) {
    $path = $_GET['path'];
}

session_start();
if (isset($_SESSION['tmD2023_mem']['err']) && $_SESSION['tmD2023_mem']['err'] != "") {
    $ERR_STR = $_SESSION['tmD2023_mem']['err'];
}

//このセッションをクリア
$_SESSION['tmD2023_mem'] = array();

if (isset($_POST['mail']) && isset($_POST['password'])) 
{ 
    $cuser = new cuser;
    //親クラスのselect()メンバ関数を呼ぶ
    $result = $cuser->get_tgt_login(false,$_POST['mail']);
    if($result === false || ($result['password'] != $_POST['password'] && !cutil::pw_check($_POST['password'],$result['password']))){
        global $ERR_STR;
        $ERR_STR ="メールアドレスまたはパスワードが一致しません。\n";
    }else{
        $_SESSION['tmD2023_mem']['user_id'] = $result['user_id'];
        cutil::redirect_exit($path === false ? 'index.php' : $path);
    }
}

if($path === false) {
    $smarty->assign('path', false);
}else {
    $smarty->assign('path', rawurlencode($path));
}
$smarty->assign('ERR_STR', $ERR_STR);
//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('user_login.tmpl');
?>