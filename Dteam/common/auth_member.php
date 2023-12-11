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
if(isset($_SESSION['tmD2023_mem']['user_id'])){
    $userdb = new cuser();
    $row = $userdb->get_tgt(false,$_SESSION['tmD2023_mem']['user_id']);
    if($row === false){
        unset($_SESSION['tmD2023_mem']['user_id']);
    }
}
?>
