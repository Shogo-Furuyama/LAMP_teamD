<?php
/* Smarty version 4.1.1, created on 2023-08-09 23:03:36
  from '/home/j2023d/public_html/Smarty/templates/admin/index.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d39cb85742d8_72713156',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '66d671a189b6722ac0ae17616f48ecb25a939686' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/admin/index.tmpl',
      1 => 1691589804,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./gmenu.tmpl' => 1,
  ),
),false)) {
function content_64d39cb85742d8_72713156 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<link href="css/main.css" rel="stylesheet" type="text/css">
<title>メインメニュー</title>
<?php echo '<script'; ?>
 type="text/javascript">
<!--


// -->
<?php echo '</script'; ?>
>
</head>
<body>
<!-- 全体コンテナ　-->
<div id="container">
<?php $_smarty_tpl->_subTemplateRender('file:./gmenu.tmpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="headTitle">
<h2>メインメニュー</h2>
</div>
<!-- コンテンツ　-->
<div id="inquiry">
<table >
<tr>
<td><a href="user_list.php">ユーザー管理</a></td>
</tr>
<tr>
<td><a href="book_list.php">本一覧</a></td>
</tr>
<tr>
<td><a href="booklist_list.php">リスト一覧</a></td>
</tr>
<tr>
<td><a href="phistory_list.php">売上照会</a></td>
</tr>
<tr>
<td><a href="inquiry_list.php">お問い合わせ管理</a></td>
</tr>


</table>
<p>&nbsp;</p>
</div>
<!-- /コンテンツ　-->
</div>
<!-- /全体コンテナ　-->
</body>
</html>

<?php }
}
