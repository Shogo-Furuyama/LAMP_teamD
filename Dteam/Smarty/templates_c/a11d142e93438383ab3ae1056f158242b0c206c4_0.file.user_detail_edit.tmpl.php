<?php
/* Smarty version 4.1.1, created on 2023-08-22 13:20:42
  from '/home/j2023d/public_html/Smarty/templates/admin/user_detail_edit.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e4379ab6dfc8_25877713',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a11d142e93438383ab3ae1056f158242b0c206c4' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/admin/user_detail_edit.tmpl',
      1 => 1692677775,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./gmenu.tmpl' => 1,
  ),
),false)) {
function content_64e4379ab6dfc8_25877713 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <link href="css/main.css" rel="stylesheet" type="text/css">
  <title>ユーザー詳細</title> 
</head>

<body>
  <!-- 全体コンテナ　-->
  <div id="container">
    <?php $_smarty_tpl->_subTemplateRender('file:./gmenu.tmpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <div id="headTitle">
      <h2>ユーザー詳細</h2>
    </div>
    <!-- コンテンツ　-->
    <div id="inquiry">
      <?php if ($_smarty_tpl->tpl_vars['err_flag']->value != '') {?>
        <p><?php echo $_smarty_tpl->tpl_vars['err_flag']->value;?>
</p>
      <?php }?>

      <form name="form1" action="<?php echo $_SERVER['PHP_SELF'];?>
" method="post">
        <a href="user_list.php<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
">一覧に戻る</a><br />
        <table>
          <tr>
            <th>ユーザーID</th>
            <td width="70%"><?php echo $_smarty_tpl->tpl_vars['user_id_txt']->value;?>
</td>
          </tr>
          <tr>
            <th>ユーザー名</th>
            <td width="70%">
              <input type="text" name="user_name" size="50" value="<?php echo htmlspecialchars((string)$_POST['user_name'], ENT_QUOTES, 'UTF-8', true);?>
" disabled/>  
            </td>
          </tr>

          <tr>
            <th>メールアドレス</th>
            <td width="70%">
              <input type="text" name="mail" value="<?php echo htmlspecialchars((string)$_POST['mail'], ENT_QUOTES, 'UTF-8', true);?>
" disabled/>
            </td>
          </tr>

          <tr>
            <th>郵便番号</th>
            <td width="70%">
              <input type="text" name="post_code" value="<?php echo htmlspecialchars((string)$_POST['post_code'], ENT_QUOTES, 'UTF-8', true);?>
" disabled>
            </td>
          </tr>

          <tr>
            <th>住所</th>
            <td width="70%">
              <input type="text" name="address" size="80" value="<?php echo htmlspecialchars((string)$_POST['address'], ENT_QUOTES, 'UTF-8', true);?>
" disabled/>
            </td>
          </tr>

          <tr>
            <th>電話番号</th>
            <td width="70%">
              <input type="tel" name="phone_num" value="<?php echo htmlspecialchars((string)$_POST['phone_num'], ENT_QUOTES, 'UTF-8', true);?>
" disabled>
            </t
            d>
          </tr>

          <tr>
            <th>アイコン画像</th>
            <td width="70%">
              <?php if ($_POST['icon_img'] != '') {?>
                <img src="<?php echo $_smarty_tpl->tpl_vars['updir']->value;
echo $_POST['icon_img'];?>
" style="max-height: 200px; width: auto;" /><br />
              <?php }?>
            </td>
          </tr>
          <tr>
            <th>アカウントタイプ</th>
            <td width="70%">
              <input type="radio" name="is_admin" value="1" <?php if ($_POST['is_admin'] == 1) {?>checked="checked" <?php }?>
                class="account-type" id="is_admin_1"/><label for="is_admin_1">管理者</label>&nbsp;
              <input type="radio" name="is_admin" value="0" <?php if ($_POST['is_admin'] == 0) {?>checked="checked" <?php }?>
                class="account-type" id="is_admin_2"/><label for="is_admin_2">ユーザー</label>&nbsp;  
              <input type="submit" value="変更"/>
            </td>
          </tr>
        </table>
        <input type="hidden" name="func" value="ctype" />
        <input type="hidden" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
" />
      </form>

    </div>
    <!-- /コンテンツ　-->
  </div>
  <!-- /全体コンテナ　-->
  
    <?php echo '<script'; ?>
>
      
    <?php echo '</script'; ?>
>
  
</body>

</html><?php }
}
