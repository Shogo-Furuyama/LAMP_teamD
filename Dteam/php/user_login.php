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
$user_id = "";
$user_name = "";

session_start();
if (isset($_SESSION['tmD2023_mem']['err']) && $_SESSION['tmD2023_mem']['err'] != "") {
    $ERR_STR = $_SESSION['tmD2023_mem']['err'];
}

//このセッションをクリア
$_SESSION['tmD2023_mem'] = array();

if (!empty($_POST['mail']) && !empty($_POST['password'])) 
{ 
    $cuser = new cuser;
    //親クラスのselect()メンバ関数を呼ぶ
    $result = $cuser->get_tgt_login(false,$_POST['mail'],$_POST['password']);
    if(!empty($result)){
        session_start();
    $_SESSION['tmD2023_mem']['user_id'] = $result['user_id'];
    $_SESSION['tmD2023_mem']['user_name'] = $result['user_name'];
    cutil::redirect_exit("index.php");
    }else{
        global $ERR_STR;
        $ERR_STR ="メールアドレスまたはパスワードが一致しません。\n";
        
    }
}


$smarty->assign('ERR_STR',$ERR_STR);
//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('user_login.tmpl');


?>
