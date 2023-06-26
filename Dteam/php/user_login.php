<?php
/*!
@file login.php
@brief  ログイン（フロント）
@copyright Copyright (c) 2017 Yamanoi Yasushi.
*/

require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
require_once($CMS_COMMON_INCLUDE_DIR . "auth_member.php");

 

$show_mode = '';
$ERR_STR = "";
$user_id = "";
$user_name = "";

session_start();
if(isset($_SESSION['tmD2023_mem']['err']) && $_SESSION['tmD2023_mem']['err'] != ""){
    $ERR_STR = $_SESSION['tmD2023_mem']['err'];
}

//このセッションをクリア
$_SESSION['tmD2023_mem'] = array();

if(isset($_POST['user_login']) && isset($_POST['user_password'])){
    if(chk_user_login(
        strip_tags($_POST['user_login']),
        strip_tags($_POST['user_password']))){
        session_start();
        $_SESSION['tmD2023_mem']['user_login'] = strip_tags($_POST['user_login']);
        $_SESSION['tmD2023_mem']['user_id'] = $user_id;
        $_SESSION['tmD2023_mem']['user_name'] = $user_name;
        cutil::redirect_exit("index_smarty..php");
    }
}

function chk_user_login($user_login,$user_password){
    global $ERR_STR;
    global $user_id;
    global $user_name;
    $user = new cuser();
    $row = $user->get_tgt_login(false,$user_login);
    if($row === false || !isset($row['user_id'])){
        $ERR_STR .= "ログイン名が不定です。\n";
        return false;
    }
    //暗号化によるパスワード認証
    if(!cutil::pw_check($user_password,$row['enc_password'])){
        $ERR_STR .= "パスワードが違っています。\n";
        return false;
    }
    $user_id = $row['user_id'];
    $user_name = $row['user_name'];
    return true;
}

$smarty->assign('ERR_STR',$ERR_STR);
//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('user_login.tmpl');


?>
