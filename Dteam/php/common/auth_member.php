<?php
/********************************

auth_member.php

メンバーログイン認証
認証が必要なページはこのファイルをインクルードする
すでにlibs.phpがインクルードされている必要がある
*複数のサイトが同居または管理者管理と混同しないため
$_SESSIONは多次元配列にする

             2020/6/20 Y.YAMANOI
*********************************/
session_start();
if((!isset($_SESSION['tmY2023_mem']['member_login'])) 
    || (!isset($_SESSION['tmY2023_mem']['member_id']))){
    cutil::redirect_exit("member_login.php");
}
$member = new cmember();
$row = $member->get_tgt_login(false,$_SESSION['tmY2023_mem']['member_login']);
if($row === false || !isset($row['member_id'])){
    cutil::redirect_exit("member_login.php");
}
if($row['member_id'] != $_SESSION['tmY2023_mem']['member_id']){
    cutil::redirect_exit("member_login.php");
}
if($row['member_login'] != $_SESSION['tmY2023_mem']['member_login']){
    cutil::redirect_exit("member_login.php");
}

function echo_hello_member_name(){
    if(isset($_SESSION['tmY2023_mem']['member_name'])){
        echo $_SESSION['tmY2023_mem']['member_name'];
    }
}


?>
