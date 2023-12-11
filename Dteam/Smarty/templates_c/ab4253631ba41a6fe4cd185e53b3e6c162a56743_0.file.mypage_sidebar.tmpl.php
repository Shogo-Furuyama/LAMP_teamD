<?php
/* Smarty version 4.1.1, created on 2023-08-22 10:41:20
  from '/home/j2023d/public_html/Smarty/templates/mypage_sidebar.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e4124009f014_46645590',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ab4253631ba41a6fe4cd185e53b3e6c162a56743' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/mypage_sidebar.tmpl',
      1 => 1692668474,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e4124009f014_46645590 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="items" class="col-3">
    <div>
        <div class="B_style">
            <a class="a_style" href="myPage.php">プロフィール</a><br />
        </div>

        <div class="B_style">
            <a class="a_style" href="myPage_regist.php">投稿したリスト</a><br />
        </div>

        <div class="B_style">
            <a class="a_style" href="myPage_favorite.php">いいね</a><br />
        </div>

        <div class="B_style">
            <a class="a_style" href="myPage_conf.php">個人情報</a><br />
        </div>

        <div class="B_style">
            <a class="a_style" href="myPage_purchase.php">注文履歴</a>
        </div>
        <div class="B_style">
            <a class="a_style" href="myPage.php?lo">ログアウト</a>
        </div>
    </div>
</div><?php }
}
