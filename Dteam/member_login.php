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
$member_id = "";
$member_name = "";

session_start();
if(isset($_SESSION['tmY2023_mem']['err']) && $_SESSION['tmY2023_mem']['err'] != ""){
    $ERR_STR = $_SESSION['tmY2023_mem']['err'];
}

//このセッションをクリア
$_SESSION['tmY2023_mem'] = array();

if(isset($_POST['member_login']) && isset($_POST['member_password'])){
    if(chk_member_login(
        strip_tags($_POST['member_login']),
        strip_tags($_POST['member_password']))){
        session_start();
        $_SESSION['tmY2023_mem']['member_login'] = strip_tags($_POST['member_login']);
        $_SESSION['tmY2023_mem']['member_id'] = $member_id;
        $_SESSION['tmY2023_mem']['member_name'] = $member_name;
        cutil::redirect_exit("index_member.php");
    }
}

function chk_member_login($member_login,$member_password){
    global $ERR_STR;
    global $member_id;
    global $member_name;
    $member = new cmember();
    $row = $member->get_tgt_login(false,$member_login);
    if($row === false || !isset($row['member_id'])){
        $ERR_STR .= "ログイン名が不定です。\n";
        return false;
    }
    //暗号化によるパスワード認証
    if(!cutil::pw_check($member_password,$row['enc_password'])){
        $ERR_STR .= "パスワードが違っています。\n";
        return false;
    }
    $member_id = $row['member_id'];
    $member_name = $row['member_name'];
    return true;
}

$smarty->assign('ERR_STR',$ERR_STR);
//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('member_login.tmpl');


?>
