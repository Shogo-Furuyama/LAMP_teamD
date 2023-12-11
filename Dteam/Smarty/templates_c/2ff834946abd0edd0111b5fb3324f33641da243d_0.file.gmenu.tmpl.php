<?php
/* Smarty version 4.1.1, created on 2023-08-09 23:03:36
  from '/home/j2023d/public_html/Smarty/templates/admin/gmenu.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d39cb8578dd4_38963766',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2ff834946abd0edd0111b5fb3324f33641da243d' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/admin/gmenu.tmpl',
      1 => 1691589811,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64d39cb8578dd4_38963766 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- ぱんクズ　-->
<div id="pan">
<table >
<tr>
<td><a href="index.php">メインメニュー</a></td>
<td><a href="user_list.php">ユーザー管理</a></td>

<td><a href="book_list.php">本一覧</a></td>
<td><a href="booklist_list.php">リスト一覧</a></td>
<td><a href="phistory_list.php">売上照会</a></td>
<td><a href="inquiry_list.php">お問い合わせ管理</a></td>


<td><a href="login.php">ログアウト</a></td>
</tr>
</table>
</div>
ようこそ<?php echo $_SESSION['tmD2023_adm']['admin_name'];?>
さん<br />
<!-- /ぱんクズ　-->
<?php }
}
