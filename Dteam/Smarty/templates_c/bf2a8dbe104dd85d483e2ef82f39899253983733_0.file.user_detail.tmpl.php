<?php
/* Smarty version 4.1.1, created on 2023-08-22 14:52:10
  from '/home/j2023d/public_html/Smarty/templates/admin/user_detail.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e44d0acbe2e2_95312765',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bf2a8dbe104dd85d483e2ef82f39899253983733' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/admin/user_detail.tmpl',
      1 => 1692683526,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./gmenu.tmpl' => 1,
  ),
),false)) {
function content_64e44d0acbe2e2_95312765 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <link href="css/main.css" rel="stylesheet" type="text/css">
  <title>ユーザー詳細</title>
  <style>
    .error-message {
      color: red;
      display: inline-block;
      margin-left: 10px;
    }
  </style>
  
    <?php echo '<script'; ?>
 src="../js/ajaxzip3.js" charset="UTF-8"><?php echo '</script'; ?>
>
  
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
" method="post" enctype="multipart/form-data">
        <a href="user_list.php<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
">一覧に戻る</a><br />
        <span class="red">＊</span>は必須項目
        <table>
          <tr>
            <th>ユーザーID</th>
            <td width="70%"><?php echo $_smarty_tpl->tpl_vars['user_id_txt']->value;?>
</td>
          </tr>
          <tr>
            <th>ユーザー名<span class="red">＊</span></th>
            <td width="70%">
              <input type="text" name="user_name" size="50" value="<?php echo htmlspecialchars((string)$_POST['user_name'], ENT_QUOTES, 'UTF-8', true);?>
" />
              <span id="uname-error" class="error-message"></span>
              <?php if ((isset($_smarty_tpl->tpl_vars['err_array']->value['user_name']))) {?><br /><span class="red"><?php echo $_smarty_tpl->tpl_vars['err_array']->value['user_name'];?>
</span><?php }?>
            </td>
          </tr>

          <tr>
            <th>メールアドレス<span class="red">＊</span></th>
            <td width="70%">
              <input type="text" name="mail" value="<?php echo htmlspecialchars((string)$_POST['mail'], ENT_QUOTES, 'UTF-8', true);?>
" onblur="validateEmail()" />
              <span id="email-error" class="error-message"></span>
              <?php if ((isset($_smarty_tpl->tpl_vars['err_array']->value['mail']))) {?><br /><span class="red"><?php echo $_smarty_tpl->tpl_vars['err_array']->value['mail'];?>
</span><?php }?>
            </td>
          </tr>

          <tr>
            <th>パスワード（変更するとき入力）<span class="red">＊</span></th>
            <td width="70%">
              <input type="password" name="password" value="<?php echo htmlspecialchars((string)$_POST['password'], ENT_QUOTES, 'UTF-8', true);?>
"/>
              <span id="password-error" class="error-message"></span>
            </td>
          </tr>
          <tr>
            <th>パスワード確認（変更するとき入力）<span class="red">＊</span></th>
            <td width="70%"><input type="password" name="password_chk" value="<?php echo htmlspecialchars((string)$_POST['password_chk'], ENT_QUOTES, 'UTF-8', true);?>
"></td>
          </tr>

          <tr>
            <th>郵便番号</th>
            <td width="70%">
              <input type="text" name="post_code" onKeyUp="AjaxZip3.zip2addr(this,'','address','address')"
                value="<?php echo htmlspecialchars((string)$_POST['post_code'], ENT_QUOTES, 'UTF-8', true);?>
">
              <span id="zipcode-error" class="error-message"></span>
            </td>
          </tr>

          <tr>
            <th>住所</th>
            <td width="70%"><input type="text" name="address" size="80" value="<?php echo htmlspecialchars((string)$_POST['address'], ENT_QUOTES, 'UTF-8', true);?>
" />
              <?php if ((isset($_smarty_tpl->tpl_vars['err_array']->value['address']))) {?><br /><span class="red"><?php echo $_smarty_tpl->tpl_vars['err_array']->value['address'];?>
</span><?php }?>
            </td>
          </tr>

          <tr>
            <th>電話番号</th>
            <td width="70%">
              <input type="tel" name="phone_num" value="<?php echo htmlspecialchars((string)$_POST['phone_num'], ENT_QUOTES, 'UTF-8', true);?>
" onblur="validatePhoneNumber()">
              <span id="phone-error" class="error-message"></span>
              <?php if ((isset($_smarty_tpl->tpl_vars['err_array']->value['phone_num']))) {?><br /><span class="red"><?php echo $_smarty_tpl->tpl_vars['err_array']->value['phone_num'];?>
</span><?php }?>
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
              <input type="file" name="icon_img">
            </td>
          </tr>
          <tr>
            <th>アカウントタイプ</th>
            <td width="70%">
              <input type="radio" name="is_admin" value="1" <?php if ($_POST['is_admin'] == 1) {?>checked="checked" <?php }?>
                class="account-type" id="is_admin_1"/><label for="is_admin_1">管理者</label>&nbsp;
              <input type="radio" name="is_admin" value="0" <?php if ($_POST['is_admin'] == 0) {?>checked="checked" <?php }?>
                class="account-type" id="is_admin_2"/><label for="is_admin_2">ユーザー</label>
              <?php if ((isset($_smarty_tpl->tpl_vars['err_array']->value['is_admin']))) {?><br /><span class="red"><?php echo $_smarty_tpl->tpl_vars['err_array']->value['is_admin'];?>
</span><?php }?>
            </td>
          </tr>
        </table>
        <input type="hidden" name="func" value="" />
        <input type="hidden" name="param" value="" />
        <input type="hidden" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
" />
        <p class="center">
          <input type="button" value="確認" onClick="javascript:set_func_form('conf','')" />
        </p>
      </form>

    </div>
    <!-- /コンテンツ　-->
  </div>
  <!-- /全体コンテナ　-->
  


    <?php echo '<script'; ?>
>
      function set_func_form(fn, pm) {
        var errors = [];

        var userInput = document.form1.user_name;
        var userName = userInput.value.trim();
        var userRegex = /^.{1,20}$/;
        var unameErrorElement = document.getElementById("uname-error");

        if (!userRegex.test(userName)) {
          errors.push("ユーザー名は１文字以上２０文字以内で入力してください。");
          userInput.classList.add("error");
          unameErrorElement.textContent = "ユーザー名は１文字以上２０文字以内で入力してください。";
        } else {
          userInput.classList.remove("error");
          unameErrorElement.textContent = "";
        }

        var emailInput = document.form1.mail;
        var email = emailInput.value.trim();
        var emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
        var emailErrorElement = document.getElementById("email-error");

        if (!emailRegex.test(email)) {
          errors.push("有効なメールアドレスを入力してください。");
          emailInput.classList.add("error");
          emailErrorElement.textContent = "有効なメールアドレスを入力してください。";
        } else {
          emailInput.classList.remove("error");
          emailErrorElement.textContent = "";
        }

        var passwordInput = document.form1.password;
        var password = passwordInput.value.trim();
        var passwordRegex = /^[\x21-\x7e]{8,}$/;
        var passwordErrorElement = document.getElementById("password-error");

        if (!passwordRegex.test(password)) {
          errors.push("パスワードは8文字以上を使用してください。");
          passwordInput.classList.add("error");
          passwordErrorElement.textContent = "パスワードは8文字以上を使用してください。";
        } else {
          var passcheckInput = document.form1.password_chk;
          var passwordcheck = passcheckInput.value.trim();
          if(password != passwordcheck) {
            errors.push("パスワードが一致しません。");
            passwordInput.classList.add("error");
            passwordErrorElement.textContent = "パスワードが一致しません。";
          }else {
            passwordInput.classList.remove("error");
            passwordErrorElement.textContent = "";
          }
        }


        if (errors.length > 0) {
          // エラーメッセージを表示する
          var errorContainer = document.getElementById("error-container");
          errorContainer.innerHTML = "";
          errors.forEach(function(error) {
            var errorElement = document.createElement("span");
            errorElement.textContent = error;
            errorElement.classList.add("error-message");
            zipCodeInput.parentNode.appendChild(errorElement);
          });

          return;
        }

        document.form1.target = "_self";
        document.form1.func.value = fn;
        document.form1.param.value = pm;
        document.form1.submit();


      }

    <?php echo '</script'; ?>
>
  
</body>

</html><?php }
}
