<?php
/* Smarty version 4.1.1, created on 2023-08-13 07:21:58
  from '/home/j2023d/public_html/Smarty/templates/myPage_conf.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d80606111873_21410291',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b8ee79ad0f199603c8994bb607f91f3504ffaefa' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/myPage_conf.tmpl',
      1 => 1691878910,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tmpl' => 1,
    'file:./mypage_sidebar.tmpl' => 1,
    'file:./footer.tmpl' => 1,
  ),
),false)) {
function content_64d80606111873_21410291 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="./img/bungo_tabicon.png">
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <link href="./css/mypage_conf.css" rel="stylesheet">
  <link href="./css/header.css" rel="stylesheet">
  <link href="./css/footer.css" rel="stylesheet">
  <link href="./css/myPage_menu.css" rel="stylesheet">
  <?php echo '<script'; ?>
 src="./js/ajaxzip3.js"><?php echo '</script'; ?>
>
  <title>個人情報</title>
</head>

<body>
  <?php $_smarty_tpl->_subTemplateRender("file:./header.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <main class="d-flex">
    <div class="container row">
      <?php $_smarty_tpl->_subTemplateRender("file:./mypage_sidebar.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
      <div class="col-9">
        <div class="personal_all">
          <section>
            <div class="container py-5">
              <?php if ((isset($_smarty_tpl->tpl_vars['alert']->value))) {?>
                <?php echo $_smarty_tpl->tpl_vars['alert']->value;?>

              <?php }?>
              <h1>個人情報</h1>
              <div style="border: solid gray 1px; padding-top: 4%; padding-left: 2%; padding-right: 2%; border-radius: 40px;">
                <div class="row">
                  <span class="col-sm-3 my-auto">名前</span>
                  <div class="col-sm-9 profile_row">
                    <span class="text-muted" id="lname"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['last_name']->value, ENT_QUOTES, 'UTF-8', true);?>
</span>
                    &emsp;
                    <span class="text-muted" id="fname"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['first_name']->value, ENT_QUOTES, 'UTF-8', true);?>
</span>
                    <a class="ms-auto" href="javascript:void(0)" id="nameAnker"><img src="./img/pen.png"></a>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <span class="col-sm-3 my-auto">Email</span>
                  <div class="col-sm-9 profile_row">
                    <p class="text-muted" id="email"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['mail']->value, ENT_QUOTES, 'UTF-8', true);?>
</p>
                    <a href="javascript:void(0)" id="mailAnker"><img src="./img/pen.png"></a>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <span class="col-sm-3 my-auto">住所</span>
                  <div class="col-sm-9">
                    <span class="text-muted" id="post"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['post_num']->value, ENT_QUOTES, 'UTF-8', true);?>
</span>
                    <div class="profile_row">
                      <p class="text-muted" id="address"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value, ENT_QUOTES, 'UTF-8', true);?>
</p>
                      <a href="javascript:void(0)" id="addressAnker"><img src="./img/pen.png"></a>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <span class="col-sm-3 my-auto">パスワード</span>
                  <div class="col-sm-9 profile_row">
                    <p class="text-muted">●●●●●●●●●●●</p>
                    <a href="javascript:void(0)" id="passAnker"><img src="./img/pen.png"></a>
                  </div>
                </div>
                <hr>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </main>
  <div id="easyModal" class="modal" style="display: none;">
    <div class="modal-content">
      <div class="modal-header">
        <h2 id="modal-title" class="m-0">パスワード</h2>
        <span class="modalClose">×</span>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
  <input type="hidden" name="submit_id" value="<?php echo $_smarty_tpl->tpl_vars['submit_id']->value;?>
"> 
  <?php $_smarty_tpl->_subTemplateRender("file:./footer.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <?php echo '<script'; ?>
 src="./js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="./js/header.js"><?php echo '</script'; ?>
>
  
    <?php echo '<script'; ?>
>
      document.getElementById('nameAnker').addEventListener('click', modalOpen(0));
      document.getElementById('mailAnker').addEventListener('click', modalOpen(1));
      document.getElementById('addressAnker').addEventListener('click', modalOpen(2));
      document.getElementById('passAnker').addEventListener('click', modalOpen(3));
      document.querySelector('.modalClose').addEventListener('click', function() {
        document.getElementById('easyModal').style.display = 'none';
      });

      function modalOpen(i) {
        return function() {
          const modal = document.getElementById('easyModal');
          switch (i) {
            case 0:
              delModalBody(modal);
              createNameInput(modal);
              break;
            case 1:
              delModalBody(modal);
              createEmailInput(modal);
              break;
            case 2:
              delModalBody(modal);
              createAddressInput(modal);
              break;
            case 3:
              delModalBody(modal);
              createPassInput(modal);
              break;
          }
        }
      }

      function delModalBody(modal) {
        document.body.append(document.querySelector('[name="submit_id"]'));
        const cont = modal.querySelector('.modal-content');
        cont.querySelector('.modal-body').remove();
        const body = document.createElement('div');
        body.classList.add('modal-body');
        cont.append(body);
      }

      function createForm() {
        let form = document.createElement('Form');
        form.method = 'POST';
        form.action = 'myPage_conf.php';
        form.append(document.querySelector('[name="submit_id"]'));
        return form;
      }

      function createNameInput(modal) {
        modal.style.display = 'flex';
        const form = createForm();
        const inputDiv = document.createElement('div');
        modal.querySelector('#modal-title').innerText = 'お名前';
        inputDiv.classList.add('input-group', 'mb-3', 'mt-3');
        const input1 = document.createElement('input');
        input1.type = 'text';
        input1.name = 'name1';
        input1.classList.add('form-control');
        input1.placeholder = '苗字';
        input1.value = document.getElementById('lname').innerText;
        const input2 = document.createElement('input');
        input2.type = 'text';
        input2.name = 'name2';
        input2.classList.add('form-control');
        input2.placeholder = '名前';
        input2.value = document.getElementById('fname').innerText;
        const dangerDiv = document.createElement('div');
        dangerDiv.classList.add('text-danger');
        const inputButton = document.createElement('button');
        inputButton.type = 'button';
        inputButton.classList.add('btn', 'btn-primary', 'ms-auto', 'd-flex');
        inputButton.innerText = '登録';
        inputButton.addEventListener('click', function() {
            let flag = true;
            let errMsg = '';
            if (input1.value.match('^[^ 　]{1,15}$')) {
            inputValid(input1);
          } else {
            inputInValid(input1);
            flag = false;
          }
          if (input2.value.match('^[^ 　]{1,15}$')) {
          inputValid(input2);
        }
        else {
          inputInValid(input2);
          flag = false;
        }
        if (flag) {
          form.submit();
        } else {
          dangerDiv.innerText = '名前が入力されていません。スペースを含まず入力してください。';
        }
      });
      const func = document.createElement('input');
      func.type = 'hidden';
      func.name = 'func';
      func.value = 'name';
      inputDiv.append(input1, input2);
      form.append(inputDiv, dangerDiv, inputButton, func);
      modal.querySelector('.modal-body').append(form);
      }

      function createEmailInput(modal) {
        modal.style.display = 'flex';
        const form = createForm();
        modal.querySelector('#modal-title').innerText = 'メールアドレス';
        const inputDiv = document.createElement('div');
        inputDiv.classList.add('input-group', 'mb-3', 'mt-3');
        const inputMail = document.createElement('input');
        inputMail.type = 'email';
        inputMail.name = 'mail';
        inputMail.value = document.getElementById('email').innerText;
        inputMail.classList.add('form-control');
        inputMail.placeholder = 'メールアドレス';
        const dangerDiv = document.createElement('div');
        dangerDiv.classList.add('text-danger');
        const inputButton = document.createElement('button');
        inputButton.type = 'button';
        inputButton.classList.add('btn', 'btn-primary', 'ms-auto', 'd-flex');
        inputButton.innerText = '登録';
        inputButton.addEventListener('click', function() {
          if (inputMail.value.match('^[a-zA-Z0-9_+-]+(\\.[a-zA-Z0-9_+-]+)*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\\.)+[a-zA-Z]{2,}$')) {
            form.submit();
          } else {
            inputInValid(inputMail);
            dangerDiv.innerText = 'メールアドレスを正しく入力してください。';
          }
        });
      const func = document.createElement('input');
      func.type = 'hidden';
      func.name = 'func';
      func.value = 'email';
      inputDiv.append(inputMail);
      form.append(inputDiv, dangerDiv, inputButton, func);
      modal.querySelector('.modal-body').append(form);
      }

      function createAddressInput(modal) {
        modal.style.display = 'flex';
        const form = createForm();
        const inputDiv = document.createElement('div');
        modal.querySelector('#modal-title').innerText = '住所';
        inputDiv.classList.add('input-group', 'mb-3', 'mt-3');
        const inputDiv2 = document.createElement('div');
        inputDiv2.classList.add('input-group', 'my-3', 'w-75');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'address';
        input.value = document.getElementById('address').innerText;
        input.classList.add('form-control');
        input.placeholder = '住所';
        const dangerDiv = document.createElement('div');
        dangerDiv.classList.add('text-danger');
        const inputButton = document.createElement('button');
        inputButton.type = 'button';
        inputButton.classList.add('btn', 'btn-primary', 'ms-auto', 'd-flex');
        inputButton.innerText = '登録';

        const func = document.createElement('input');
        func.type = 'hidden';
        func.name = 'func';
        func.value = 'address';
        inputDiv.append(input);
        let postText = document.getElementById('post').innerText.split('-');
        if (postText.length != 2) {
          postText = ['', ''];
        }
        inputDiv2.innerHTML = '<span class="input-group-text">郵便番号</span>' +
          '<input type="tel" class="form-control" name="post_1" oninput="AjaxZip3.zip2addr(\'post_1\', \'post_2\',\'address\',\'address\',\'address\', \'address\' );" maxlength="3" value="' +
          postText[0] + '" placeholder="3ケタ">' +
          '<spen class="input-group-text">ー</spen>' +
          '<input type="tel" class="form-control" name="post_2" oninput="AjaxZip3.zip2addr(\'post_1\', \'post_2\',\'address\',\'address\',\'address\', \'address\' );" maxlength="4" value="' +
          postText[1] + '" placeholder="4ケタ">';
        form.append(inputDiv2, inputDiv, dangerDiv, inputButton, func);
        modal.querySelector('.modal-body').append(form);
        const inputTel = document.querySelector('[name="post_1"]');
        const inputTel1 = document.querySelector('[name="post_2"]');
        inputButton.addEventListener('click', function() {
            const POST_ERR = '郵便番号は半角数字のみの、正しい桁数で入力してください。';
            const ADD_ERR = '住所が正しく入力されていません。スペースを含まず住所を入力し直してください。';
            let flag = true;
            let errMsg = '';
            if (inputTel.value.match('^[0-9]{3}$')) {
            inputValid(inputTel);
          } else {
            errMsg += POST_ERR;
            inputInValid(inputTel);
            flag = false;
          }
          if (inputTel1.value.match('^[0-9]{4}$')) {
          inputValid(inputTel1);
        }
        else {
          if (flag) {
            errMsg += POST_ERR;
          }
          inputInValid(inputTel1);
          flag = false;
        }
        if(input.value.match('^[^ 　]{1,255}$')){
        inputValid(input);
      } else {
        errMsg += flag ? ADD_ERR : '\n' + ADD_ERR;
        inputInValid(input);
        flag = false;
      }
      if (flag) {
        form.submit();
      } else {
        dangerDiv.innerText = errMsg;
      }
      });
      }

      function createPassInput(modal) {
        modal.style.display = 'flex';
        const form = createForm();
        modal.querySelector('#modal-title').innerText = 'パスワード';
        const input1 = document.createElement('input');
        input1.type = 'password';
        input1.name = 'password';
        input1.classList.add('form-control', 'my-3');
        input1.placeholder = 'パスワード';
        const input2 = document.createElement('input');
        input2.type = 'password';
        input2.classList.add('form-control', 'mb-3');
        input2.placeholder = 'パスワード再入力';
        const dangerDiv = document.createElement('div');
        dangerDiv.classList.add('text-danger');
        const inputButton = document.createElement('button');
        inputButton.type = 'button';
        inputButton.classList.add('btn', 'btn-primary', 'ms-auto', 'd-flex');
        inputButton.innerText = '登録';
        inputButton.addEventListener('click', function() {
            if (!input1.value.match('^[\w\x21-\x7e]{8,25}$')) {
            dangerDiv.innerText = 'スペースを含めず、半角英数字の８文字以上２５文字以内で入力してください。';
            inputInValid(input1);
            inputInValid(input2);
          } else if (input1.value == input2.value) {
            form.submit();
          } else {
            dangerDiv.innerText = 'パスワードが一致しません、もう一度やり直してください。';
            inputInValid(input2);
            inputValid(input1);
          }
        });
      const func = document.createElement('input');
      func.type = 'hidden';
      func.name = 'func';
      func.value = 'password';
      form.append(input1, input2, dangerDiv, inputButton, func);
      modal.querySelector('.modal-body').append(form);
      }

      function inputValid(node) {
        node.classList.add('is-valid');
        node.classList.remove('is-invalid');
      }

      function inputInValid(node) {
        node.classList.add('is-invalid');
        node.classList.remove('is-valid');
      }
    <?php echo '</script'; ?>
>
  
</body>

</html><?php }
}
