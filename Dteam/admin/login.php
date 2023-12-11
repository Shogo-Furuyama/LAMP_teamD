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

function chk_admin_login($admin_login,$admin_password){
    global $ERR_STR;
    global $admin_master_id;
    global $admin_name;
    $admin = new cuser();
    $row = $admin->get_tgt_login(false,$admin_login);
    if($row === false || !isset($row['user_id']) || ($admin_password != $row['password'] && !cutil::pw_check($admin_password,$row['password']))){
        $ERR_STR .= "ログイン名またはパスワードが間違っています。\n";
        return false;
    }
    if($row['is_admin'] != 1) {
        $ERR_STR .= "このユーザーには権限がありません。\n";
        return false;
    }
    $admin_master_id = $row['user_id'];
    return true;
}

session_start();

//このセッションをクリア
$_SESSION['tmD2023_adm'] = array();

if(isset($_POST['admin_login']) && isset($_POST['admin_password'])){
    if(chk_admin_login(strip_tags($_POST['admin_login']),strip_tags($_POST['admin_password']))){
        session_start();
        $_SESSION['tmD2023_adm']['admin_master_id'] = $admin_master_id;
        cutil::redirect_exit("index.php");
    }
}

$smarty->assign('ERR_STR',$ERR_STR);
//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('admin/login.tmpl');
?>
