<?php
/* Smarty version 4.1.1, created on 2023-08-23 10:10:36
  from '/home/j2023d/public_html/Smarty/templates/user_login.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e55c8c60d6f2_23891458',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8862c901c4c73919917a96401ad52de1a98d4783' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/user_login.tmpl',
      1 => 1692753015,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e55c8c60d6f2_23891458 (Smarty_Internal_Template $_smarty_tpl) {
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
<title>ログイン</title>
  <nav class="navbar navbar-expand-sm" id="nav_style">
    <a href="index.php" class="navbar-brand"><img src="./img/logo1.png" id="site_logo" /></a>
  </nav>
  <div class="form-wrapper">
    <form action="user_login.php<?php if ($_smarty_tpl->tpl_vars['path']->value !== false) {?>?path=<?php echo $_smarty_tpl->tpl_vars['path']->value;
}?>" method="post">
      <h1>ログイン</h1>
      <p class="text-danger"><?php echo nl2br((string) $_smarty_tpl->tpl_vars['ERR_STR']->value, (bool) 1);?>
</p>
      <div class="form-item">
        <label for="mail"></label>
        <input type="email" name="mail" placeholder="メールアドレス"></input>
      </div>
      <div class="form-item">
        <label for="password"></label>
        <input type="password" name="password" placeholder="パスワード"></input>
      </div>
      <div class="button-panel">
        <input type="submit" class="button bg-success" title="Sign In" value="ログイン" href="index.php"></input>
      </div>
      <div class="form-footer">
        <p><a href="register.php<?php if ($_smarty_tpl->tpl_vars['path']->value !== false) {?>?path=<?php echo $_smarty_tpl->tpl_vars['path']->value;
}?>">まだアカウント登録していない方はこちら</a></p>
      </div>
    </form>
  </div>
  
    <style>
       input.is-invalid{
            color: #ff0000;
        }
    </style>
    <?php echo '<script'; ?>
>
      const mailnode = document.querySelector('[name="mail"]');
      const passnode = document.querySelector('[name="password"]');
      
      // メールアドレスの正規表現パターン
      const mailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      // パスワードの正規表現パターン
      const passwordPattern = /^[\x21-\x7e]{8,}$/;
      
      const invalid_class = 'input_err';
      const valid_class = 'input_suc';

      // フォームの送信ボタンがクリックされたときの処理
      document.querySelector('input[type="submit"]').addEventListener('click', function(event) {
          let flag = false;
          let errMsg = '';
          // メールアドレスの検証
          if (mailPattern.test(mailnode.value)) {
            mailnode.classList.remove(invalid_class);
            mailnode.classList.add(valid_class);
          } else {
            mailnode.classList.remove(valid_class);
            mailnode.classList.add(invalid_class);
            errMsg += '有効なメールアドレスを入力してください。\n';
            flag = true;
          }
        

          if (passwordPattern.test(passnode.value)) {
            passnode.classList.remove(invalid_class);
            passnode.classList.add(valid_class);
          } else {
            passnode.classList.remove(valid_class);
            passnode.classList.add(invalid_class);
            errMsg += 'パスワードは8文字以上の英数字の組み合わせで入力してください。\n';
            flag = true;
          }

          if (flag) {
            document.querySelector('.text-danger').innerText = errMsg;
            event.preventDefault(); // フォームの送信をキャンセルして検証を行う
          }
      });
    <?php echo '</script'; ?>
>
  
</body>

</html><?php }
}
