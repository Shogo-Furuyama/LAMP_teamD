<?php
/* Smarty version 4.1.1, created on 2023-07-24 13:45:19
  from '/home/j2023d/public_html/Smarty/templates/admin/login.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64be01df8a9b60_96944481',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0754fcf50ac21bf82dec8afa2ba3d2f6be251a8' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/admin/login.tmpl',
      1 => 1688101391,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64be01df8a9b60_96944481 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<link href="css/main.css" rel="stylesheet" type="text/css">
<title>ログイン</title>
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
<div id="headTitle">
<h2>ログイン</h2>

</div>
<!-- コンテンツ　-->
<div id="inquiry">
<p class="red"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['ERR_STR']->value, ENT_QUOTES, 'UTF-8', true);?>
</p>
<form action="login.php" method="post">
<table>
<tr>
<th>メールアドレス</th>
<td width="60%"><input type="text" size="50" name="admin_login" value="" style="ime-mode: disabled;"/></td>
</tr>
<tr>
<th class="nobottom">パスワード</th>
<td width="60%" class="nobottom"><input type="password" size="20" name="admin_password" value="" style="ime-mode: disabled;"/></td>
</tr>
</table>
<p class="center"><input type="submit" value="ログイン"/></p>
</form>
</div>
<!-- /コンテンツ　-->
</div>
<!-- /全体コンテナ　-->
</body>
</html>

<?php }
}
