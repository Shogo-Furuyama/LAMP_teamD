<?php
/* Smarty version 4.1.1, created on 2023-08-23 10:52:32
  from '/home/j2023d/public_html/Smarty/templates/admin/user_detail_conf.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e56660f2b5a9_93019104',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8150bfe1ab65c39cf457a6f434c4bbe9e54427cc' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/admin/user_detail_conf.tmpl',
      1 => 1692755525,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./gmenu.tmpl' => 1,
  ),
),false)) {
function content_64e56660f2b5a9_93019104 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<link href="css/main.css" rel="stylesheet" type="text/css">
	<title>ユーザー詳細</title>
	
		<?php echo '<script'; ?>
 type="text/javascript">
			function set_func_form(fn, pm) {
				document.form1.target = "_self";
				document.form1.func.value = fn;
				document.form1.param.value = pm;
				document.form1.submit();
			}
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"> <?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="js/ajaxzip3.js" charset="UTF-8"> <?php echo '</script'; ?>
>
	
</head>

<body>
	<!--全体コンテナ-->
	<div id="container">
		<?php $_smarty_tpl->_subTemplateRender('file:./gmenu.tmpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<div id="headTitle">
			<h2>ユーザー詳細</h2>
		</div>
		<!-- コンテンツ　-->
		<div id="inquiry">

			<form name="form1" action="<?php echo $_SERVER['PHP_SELF'];?>
" method="post" enctype="multipart/form-data">
				<a href="user_list.php">一覧に戻る</a><br />
				<table>
					<tr>
						<th>ユーザーID</th>
						<td width="70%"><?php echo $_smarty_tpl->tpl_vars['user_id_txt']->value;?>
</td>
					</tr>
					<tr>
						<th>ユーザー名</th>
						<td width="70%">
							<strong><?php echo htmlspecialchars((string)$_POST['user_name'], ENT_QUOTES, 'UTF-8', true);?>
</strong>
							<input type="hidden" name="user_name" value="<?php echo htmlspecialchars((string)$_POST['user_name'], ENT_QUOTES, 'UTF-8', true);?>
"/>
						</td>
					</tr>

					<tr>
						<th>メールアドレス</th>
						<td width="70%"><strong><?php echo htmlspecialchars((string)$_POST['mail'], ENT_QUOTES, 'UTF-8', true);?>
</strong>
							<input type="hidden" name="mail" value="<?php echo htmlspecialchars((string)$_POST['mail'], ENT_QUOTES, 'UTF-8', true);?>
">
						</td>
					</tr>

					<input type="hidden" name="password" value="<?php echo htmlspecialchars((string)$_POST['password'], ENT_QUOTES, 'UTF-8', true);?>
">
					<input type="hidden" name="password_chk" value="<?php echo htmlspecialchars((string)$_POST['password_chk'], ENT_QUOTES, 'UTF-8', true);?>
">


					<tr>
						<th>郵便番号</th>
						<td width="70%"><strong><?php echo htmlspecialchars((string)$_POST['post_code'], ENT_QUOTES, 'UTF-8', true);?>
</strong>
							<input type="hidden" name="post_code" onkeyup="AjaxZip3.zip2addr(this,'','address','address');"
								value="<?php echo htmlspecialchars((string)$_POST['post_code'], ENT_QUOTES, 'UTF-8', true);?>
">
						</td>
					</tr>


					</tr>

					<th>住所</th>
					<td width="70%"><strong><?php echo htmlspecialchars((string)$_POST['address'], ENT_QUOTES, 'UTF-8', true);?>
</strong>
						<input type="hidden" name="address" size="80" value="<?php echo htmlspecialchars((string)$_POST['address'], ENT_QUOTES, 'UTF-8', true);?>
" />
						<?php if ((isset($_smarty_tpl->tpl_vars['err_array']->value['address']))) {?><br /><span class="red"><?php echo $_smarty_tpl->tpl_vars['err_array']->value['address'];?>
</span><?php }?>
					</td>
					</tr>

					<tr>
						<th>電話番号</th>
						<td width="70%"><strong><?php echo htmlspecialchars((string)$_POST['phone_num'], ENT_QUOTES, 'UTF-8', true);?>
</strong>
							<input type="hidden" name="phone_num" value="<?php echo htmlspecialchars((string)$_POST['phone_num'], ENT_QUOTES, 'UTF-8', true);?>
">
						</td>
					</tr>

					<tr>
						<th>アイコン画像</th>
						<td width="70%">
							<?php if ($_POST['icon_img'] != '') {?>
								<img src="<?php echo $_smarty_tpl->tpl_vars['updir']->value;
echo $_POST['icon_img'];?>
" width="200px" /><br />
							<?php }?>
							<input type="hidden" name="icon_img" value="<?php echo htmlspecialchars((string)$_POST['icon_img'], ENT_QUOTES, 'UTF-8', true);?>
" />
						</td>
					</tr>
				</table>
				<input type="hidden" name="func" value="" />
				<input type="hidden" name="param" value="" />
				<input type="hidden" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
" />
				<p class="center">
					<input type="button" value="戻る" onClick="javascript:set_func_form('edit','')" />&nbsp;
					<input type="button" value="<?php echo $_smarty_tpl->tpl_vars['button']->value;?>
" onClick="javascript:set_func_form('set','')" />
				</p>
			</form>
		</div>
		<!-- /コンテンツ　-->
	</div>
	<!-- /全体コンテナ　-->
</body>

</html><?php }
}
