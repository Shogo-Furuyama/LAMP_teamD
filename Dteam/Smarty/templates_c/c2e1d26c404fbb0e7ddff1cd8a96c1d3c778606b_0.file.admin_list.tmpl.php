<?php
/* Smarty version 4.1.1, created on 2023-08-16 02:16:36
  from '/home/j2023d/public_html/Smarty/templates/admin/admin_list.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64dbb2f450c799_79612768',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c2e1d26c404fbb0e7ddff1cd8a96c1d3c778606b' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/admin/admin_list.tmpl',
      1 => 1687935632,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./gmenu.tmpl' => 1,
  ),
),false)) {
function content_64dbb2f450c799_79612768 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<link href="css/main.css" rel="stylesheet" type="text/css">
<title>管理者一覧</title>

<?php echo '<script'; ?>
 type="text/javascript">
<!--
function set_func_form(fn,pm){
    document.form1.target = "_self";
    document.form1.func.value = fn;
    document.form1.param.value = pm;
    document.form1.submit();
}

function del_func_form(pm,mess){
    var message = "本当に\r\n";
    message += mess;
    message += "\r\nを削除しますか？";
    if(confirm(message)){
        document.form1.target = "_self";
        document.form1.func.value = 'del';
        document.form1.param.value = pm;
        document.form1.submit();
    }
}
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
<h2>管理者一覧</h2>
</div>
<!-- コンテンツ　-->
<div id="inquiry">
<?php if ($_smarty_tpl->tpl_vars['ERR_STR']->value != '') {?>
<p><?php echo $_smarty_tpl->tpl_vars['ERR_STR']->value;?>
</p>
<?php }?>
<form name="form1" action="<?php echo $_smarty_tpl->tpl_vars['tgt_uri']->value;?>
" method="post" >
<p><a href="admin_detail.php">新規</a></p>
<p><?php echo $_smarty_tpl->tpl_vars['pager_arr']->value;?>
</p>
<table>
<tr>
<th>管理者名</th>
<th>ログイン</th>
<th>操作</th>
</tr>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rows']->value, 'value', false, 'k');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
<td width="35%" class="center">
<a href="admin_detail.php?aid=<?php echo $_smarty_tpl->tpl_vars['value']->value['admin_master_id'];?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['admin_name'], ENT_QUOTES, 'UTF-8', true);?>
</a>
</td>
<td width="35%" class="center"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['admin_login'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td width="30%" class="center">
<input type="button" value="削除確認" onClick="javascript:del_func_form(<?php echo $_smarty_tpl->tpl_vars['value']->value['admin_master_id'];?>
,'【<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['admin_name'], ENT_QUOTES, 'UTF-8', true);?>
】')" /></td>
</tr>
<?php
}
if ($_smarty_tpl->tpl_vars['value']->do_else) {
?>
<tr>
<tr><td colspan="3" class="nobottom">管理者が見つかりません</td></tr>
</tr>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
<input type="hidden" name="func" value="" />
<input type="hidden" name="param" value="" />
</form>
<p>&nbsp;</p>

</div>
<!-- /コンテンツ　-->
</div>
<!-- /全体コンテナ　-->
</body>
</html>
<?php }
}
