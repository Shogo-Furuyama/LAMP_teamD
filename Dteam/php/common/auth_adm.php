<?php
/********************************

auth_adm.php

管理者ログイン認証
認証が必要なページはこのファイルをインクルードする
すでにlibs.phpがインクルードされている必要がある
*複数のサイトが同居またはユーザー管理と混同しないため
$_SESSIONは多次元配列にする

             2020/6/20 Y.YAMANOI
*********************************/
session_start();
if((!isset($_SESSION['tmD2023_adm']['admin_login'])) 
    || (!isset($_SESSION['tmD2023_adm']['admin_master_id']))){
    cutil::redirect_exit("login.php");
}
$admin = new cadmin_master();
$row = $admin->get_tgt(false,$_SESSION['tmD2023_adm']['admin_login']);
if($row === false || !isset($row['admin_master_id'])){
    cutil::redirect_exit("login.php");
}

if($row['admin_master_id'] != $_SESSION['tmD2023_adm']['admin_master_id']){
    cutil::redirect_exit("login.php");
}
if($row['admin_login'] != $_SESSION['tmD2023_adm']['admin_login']){
    cutil::redirect_exit("login.php");
}

function echo_hello_admin_name(){
    if(isset($_SESSION['tmD2023_adm']['admin_name'])){
        echo $_SESSION['tmD2023_adm']['admin_name'];
    }
}


?>
