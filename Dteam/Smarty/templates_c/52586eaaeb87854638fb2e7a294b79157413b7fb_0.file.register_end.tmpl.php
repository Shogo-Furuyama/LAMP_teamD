<?php
/* Smarty version 4.1.1, created on 2023-08-22 10:07:00
  from '/home/j2023d/public_html/Smarty/templates/register_end.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e40a34d49e72_61844120',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '52586eaaeb87854638fb2e7a294b79157413b7fb' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/register_end.tmpl',
      1 => 1692665963,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e40a34d49e72_61844120 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./img/bungo_tabicon.png">
    <link href="./css/login.css" rel="stylesheet">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">

</head>

<body>
<title>新規登録</title>
    <nav class="navbar navbar-expand-sm" id="nav_style">
        <a href="index.php" class="navbar-brand"><img src="./img/logo1.png" id="site_logo" /></a>
    </nav>
    <div class="form-wrapper" style="margin-top: 10%;">
        <h1>登録が完了しました</h1>
        <div class="mt-3">
            <h3>続けてログインを行ってください</h3>
        </div>
    </div>

    <div class="text-center">
        <div class="form-wrapper" style="margin-top: 10%;">
            <button onclick="location.href='user_login.php<?php if ($_smarty_tpl->tpl_vars['path']->value !== false) {?>?path=<?php echo $_smarty_tpl->tpl_vars['path']->value;
}?>'" class="btn btn-success">ログイン</button>
        </div>
    </div>

</body>

</html><?php }
}
