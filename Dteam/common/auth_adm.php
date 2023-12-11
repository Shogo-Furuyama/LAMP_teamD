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
if(!isset($_SESSION['tmD2023_adm']['admin_master_id'])){
    cutil::redirect_exit("login.php");
}
$admin = new cuser();
$row = $admin->get_tgt(false,$_SESSION['tmD2023_adm']['admin_master_id']);
if($row === false ||  $row['is_admin'] != 1 ){
    cutil::redirect_exit("login.php");
}
$_SESSION['tmD2023_adm']['admin_name'] = $row['user_name'];

function echo_hello_admin_name(){
    if(isset($_SESSION['tmD2023_adm']['admin_name'])){
        echo $_SESSION['tmD2023_adm']['admin_name'];
    }
}


?>
