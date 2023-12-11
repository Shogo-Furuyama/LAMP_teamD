<?php
/* Smarty version 4.1.1, created on 2023-08-22 10:24:54
  from '/home/j2023d/public_html/Smarty/templates/credit.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e40e669f32c9_11843993',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7462c4674a8b0056d5643437b8f071bccc413a19' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/credit.tmpl',
      1 => 1692667488,
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
function content_64e40e669f32c9_11843993 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="./img/bungo_tabicon.png">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
    <link href="./css/footer.css" rel="stylesheet">
    <link href="./css/myPage_menu.css" rel="stylesheet">
    <title>支払情報</title>
    
        <style>
            .display {
                display: none;
            }

            .modal {
                /*z-indexは奥行き*/
                z-index: 1001;
                display: none;
                position: fixed;
                left: 0;
                top: 0;
                height: 100%;
                width: 100%;
                overflow: auto;
                /*↓は半透明にするやつ*/
                background-color: rgba(0, 0, 0, 0.5);
            }

            .modal-content {
                background-color: #f4f4f4;
                margin: 20% auto;
                width: 50%;
                box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17);
                /*１つ↓は変数宣言
            　２つ↓はフレーム設定*/
                animation-name: modalopen;
                animation-duration: 1s;
            }

            /*アニメーションを付ける */
            @keyframes modalopen {
                from {
                    opacity: 0
                }

                to {
                    opacity: 1
                }
            }

            .modal-header {
                float: right;
                padding: 3px 15px;
                display: flex;
                justify-content: space-between;
            }

            .modalClose {
                font-size: 2rem;
            }

            .modalClose:hover {
                cursor: pointer;
            }

            .modal-body {
                padding: 10px 20px;
                color: black;
            }

            .tableSize>tr>th {
                width: 25%;
            }

            .tableSize>tr>td {
                width: 100%;
            }

            .error {
                color: #ff0000;
                text-align: start;
            }

            .sub_p {
                font-size: 1.3rem !important;
            }

            .span {
                color: #ff0000;
            }

            .card_number {
                display: flex;
                height: 2em;
                width: 40%;
            }

            .credit {
                margin-left: 5%;
                margin-bottom: 5%;
            }

            body {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            +img{
                height: 30px;
            }
        </style>
    
</head>

<body>
    <?php $_smarty_tpl->_subTemplateRender("file:./header.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <main class="d-flex" style="background-color: #f5f5f5;">
        <?php $_smarty_tpl->_subTemplateRender("file:./mypage_sidebar.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <div class="col-9">
            <h1 class="py-3 px-3">支払情報</h1>
            <h2 class="py-3 px-3">カード＆アカウント</h2>    
            <div class="ntainer py-5">
                <?php if ((isset($_smarty_tpl->tpl_vars['alert']->value))) {?>
                    <?php echo $_smarty_tpl->tpl_vars['alert']->value;?>

                <?php }?>

                <div class="credit flex-column w-75">
                    <!--クレカ追加ボタン-->
                    <div class="d-flex align-items-center border"  onclick="switchDisplay('display2')" style="width: 60%;cursor: pointer;">
                        <img src="./img/+.png"style="width: 20%;" class="+img">
                        <div class=" px-4 d-grid gap-1" style="width: 50%;">
                            <span class="fw-bold text-center" style="font-size: 1em; font-size:20px;">支払方法の追加</span>
                        </div>
                    </div>



                    <!--右に表示するaside-->
                    <aside class="bg-white" style="width: 100%;">

                        <!--クレカ追加の画面-->
                        <div class="display page px-5" id="display2" style="width: 100%;">
                            <div class="mt-2 border-bottom mr-4">
                                <h4>新しいお支払方法を追加</h4>
                            </div>
                            <div class="mt-2">
                                <h3>クレジットまたはデビットカード</h3>
                                <span>ぶんごうでは主要なクレジットカードおよびデビットカードをご利用いただけます</span>
                            </div>

                            <div class="border-bottom" id="display2">
                                <button class="rounded border-secondary mt-3 Regular shadow" onclick="modalopen()">
                                    クレジットカードまたはデビットカードを追加
                                </button>
                                <br>
                                <br>
                                <br>
                            </div>
                        </div>
                </div>
                <!--クレカ入力画面-->
                <div id="modal" class="modal w-100">
                    <div class="modal-content container col-xs-12 col-sm-10 col-lg-7 mx-auto mt-5  p-5">
                        <div class="p-2 mx-3">
                            <form method="post" asp-controller="Home" asp-action="Login" novalidate>
                                <div class="modal-header">
                                    <span class="modalClose text-right" onclick="modalClose()">×</span>
                                </div>
                                <br>
                                <br>
                                <table class="modal-body ">
                                    <tbody class="tableSize">
                                        <tr class="align-middle">
                                            <th>
                                                カード番号<span class="span">*</span>
                                            </th>
                                            <td>
                                                <div class="d-flex">
                                                    <input type="text" name="id1" id="id1"
                                                        class="card_number form-control" maxlength="4">
                                                    <div id="id_error"></div>
                                                    &nbsp;-
                                                    <input type="text" name="id2" id="id2"
                                                        class="card_number form-control" maxlength="4">
                                                    <div id="id_error"></div>
                                                    &nbsp;-
                                                    <input type="text" name="id3" id="id3"
                                                        class="card_number form-control" maxlength="4">
                                                    <div id="id_error"></div>
                                                    &nbsp;-
                                                    <input type="text" name="id4" id="id4"
                                                        class="card_number form-control" maxlength="4">
                                                    <div id="id_error"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="align-middle">
                                            <th>
                                                クレジットカード<br>名義人<span class="span">*</span>
                                            </th>
                                            <td>
                                                <input type="text" name="credit_name" id="name" class="form-control">
                                                <div id="pass_error"></div>
                                            </td>
                                        </tr>
                                        <tr class="align-middle">
                                            <th>
                                                有効期限<span class="span">*</span>
                                            </th>
                                            <td>
                                                <select name="month">
                                                    <option slot="month">--</option>
                                                    <option slot="month">01</option>
                                                    <option slot="month">02</option>
                                                    <option slot="month">03</option>
                                                    <option slot="month">04</option>
                                                    <option slot="month">05</option>
                                                    <option slot="month">06</option>
                                                    <option slot="month">07</option>
                                                    <option slot="month">08</option>
                                                    <option slot="month">09</option>
                                                    <option slot="month">11</option>
                                                    <option slot="month">12</option>
                                                </select>
                                                &nbsp;月
                                                <select name="year">
                                                    <option slot="year">----</option>
                                                    <option slot="year">2023</option>
                                                    <option slot="year">2024</option>
                                                    <option slot="year">2025</option>
                                                    <option slot="year">2026</option>
                                                    <option slot="year">2027</option>
                                                    <option slot="year">2028</option>
                                                    <option slot="year">2029</option>
                                                    <option slot="year">2030</option>
                                                    <option slot="year">2031</option>
                                                    <option slot="year">2032</option>
                                                    <option slot="year">2033</option>
                                                    <option slot="year">2034</option>
                                                    <option slot="year">2035</option>
                                                    <option slot="year">2036</option>
                                                    <option slot="year">2037</option>
                                                    <option slot="year">2038</option>
                                                    <option slot="year">2039</option>
                                                    <option slot="year">2040</option>
                                                    <option slot="year">2041</option>
                                                    <option slot="year">2042</option>
                                                    <option slot="year">2043</option>
                                                </select>
                                                &nbsp;年
                                            </td>
                                    </tbody>
                                </table>
                                <p class="text-danger"><?php echo nl2br((string) $_smarty_tpl->tpl_vars['ERR_STR']->value, (bool) 1);?>
</p>
                                <div class="button text-light w-100 py-5" style="text-align: end;">
                                    <button type="submit" class="btn btn-success btn-lg alert" id="credit"
                                        name="credit_btn">カードを追加</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </aside>
    </main>
    <?php $_smarty_tpl->_subTemplateRender("file:./footer.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    
        <?php echo '<script'; ?>
 type="text/javascript">
            //name呼出
            const num1 = document.querySelector('[name="id1"]');
            const num2 = document.querySelector('[name="id2"]');
            const num3 = document.querySelector('[name="id3"]');
            const num4 = document.querySelector('[name="id4"]');
            const name = document.querySelector('[name="credit_name"]');
            const month = document.querySelector('[name="month"]');
            const year = document.querySelector('[name="year"]');

            //各値の正規表現
            const pattern_num = /^[0-9]{4}$/;
            const pattern_name = /^[^ 　]{1,15}$/;
            const pattern_month = /^(0[1-9]|1[0-2])$/;
            const pattern_year = /^[0-9]{4}$/;

            //条件
            document.getElementById('credit').addEventListener('click', function(event) {
                let flag = true;
                let errMsg = '';
                if (!pattern_num.test(num1.value) || !pattern_num.test(num2.value) || !pattern_num.test(num3
                        .value) || !pattern_num.test(num4.value)) {
                    num1.classList.add('is-invalid');
                    num1.classList.remove('is-valid');
                    num2.classList.add('is-invalid');
                    num2.classList.remove('is-valid');
                    num3.classList.add('is-invalid');
                    num3.classList.remove('is-valid');
                    num4.classList.add('is-invalid');
                    num4.classList.remove('is-valid');
                    flag = false;
                    errMsg += '4桁の数字で入力してください\n';
                } else {
                    num1.classList.remove('is-invalid');
                    num1.classList.add('is-valid');
                    num2.classList.remove('is-invalid');
                    num2.classList.add('is-valid');
                    num3.classList.remove('is-invalid');
                    num3.classList.add('is-valid');
                    num4.classList.remove('is-invalid');
                    num4.classList.add('is-valid');
                }

                if (!pattern_name.test(name.value)) {
                    name.classList.add('is-invalid');
                    name.classList.remove('is-valid');
                    flag = false;
                    errMsg += '1字から20字以内で入力してください\n';
                } else {
                    name.classList.remove('is-invalid');
                    name.classList.add('is-valid');
                }

                if (!pattern_month.test(month.value) || !pattern_year.test(year.value)) {
                    flag = false;
                    errMsg += '有効期限を選択してください\n';
                }

                if (!flag) {
                    event.preventDefault();
                    document.querySelector('.text-danger').innerText = errMsg;
                }
            });



            function delete_btn() {
                let paypay_del = document.getElementById("PayPay");
                paypay_del.remove();

            }


            function switchDisplay(targetDisplay) {
                //idを取得
                var displayElements = document.getElementsByClassName('display');
                for (var i = 0; i < displayElements.length; i++) {
                    //display要素を非表示
                    displayElements[i].style.display = 'none';
                }
                //選択されたdisplayのid取得
                var selectedDisplay = document.getElementById(targetDisplay);
                //選択されたdisplayの表示
                selectedDisplay.style.display = 'block';
            }

            function modalopen() {
                document.getElementById('modal').style.display = 'block ';
                document.body.style.overflow = 'hidden';
            }

            function modalClose() {
                document.getElementById('modal').style.display = 'none';
                document.body.style.overflow = 'auto';
            }

            document.getElementById('button').onclick = function() {
                location.reload()
            };
        <?php echo '</script'; ?>
>
    
</body>

</html><?php }
}
