<?php
/*!
@file login.php
@brief  メインメニュー(管理画面)
@copyright Copyright (c) 2017 Yamanoi Yasushi.
*/

require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");

$ERR_STR = "";
$admin_master_id = "";
$admin_name = "";

session_start();
if(isset($_SESSION['tmD2023_member']['err']) && $_SESSION['tmD2023_member']['err'] != ""){
    $ERR_STR = $_SESSION['tmD2023_member']['err'];
}

//このセッションをクリア
$_SESSION['tmD2023_member'] = array();

if(isset($_POST['admin_login']) && isset($_POST['admin_password'])){
    if(chk_admin_login(
        strip_tags($_POST['admin_login']),
        strip_tags($_POST['admin_password']))){
        session_start();
        $_SESSION['tmD2023_member']['admin_login'] = strip_tags($_POST['admin_login']);
        $_SESSION['tmD2023_member']['admin_master_id'] = $admin_master_id;
        $_SESSION['tmD2023_member']['admin_name'] = $admin_name;
        cutil::redirect_exit("index.php");
    }
}

function chk_admin_login($admin_login,$admin_password){
    global $ERR_STR;
    global $admin_master_id;
    global $admin_name;
    $admin = new cadmin_master();
    $row = $admin->get_tgt(false,$admin_login);
    if($row === false || !isset($row['admin_master_id'])){
        $ERR_STR .= "ログイン名が不定です。\n";
        return false;
    }
    //暗号化によるパスワード認証
    if(!cutil::pw_check($admin_password,$row['enc_password'])){
        $ERR_STR .= "パスワードが違っています。\n";
        return false;
    }
    $admin_master_id = $row['admin_master_id'];
    $admin_name = $row['admin_name'];
    return true;
}

//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('inquiry.tmpl');


?>
