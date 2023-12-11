<?php
/* Smarty version 4.1.1, created on 2023-07-27 17:38:49
  from '/home/j2023d/public_html/Smarty/templates/cart_conf.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64c22d19b3af49_07114757',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c0a4538000df24ee6b1eaa3195ab6cc00e21637e' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/cart_conf.tmpl',
      1 => 1690446972,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tmpl' => 1,
    'file:./footer.tmpl' => 1,
  ),
),false)) {
function content_64c22d19b3af49_07114757 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
    <link href="./css/footer.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex-grow: 1;
        }

        main>div {
            display: flex;
            flex-direction: row;
        }

        #cart-check {
            display: flex;
            align-items: center;
            margin-top: 50px;
            margin-left: 70px;
            padding-left: 5%;
            padding-right: 30%;
            padding-top: 5%;
            padding-bottom: 5%;
            background-color: #EEEEEE;
        }

        #cart-box {
            background-color: #EEEEEE;
            padding: 40px;
            margin-top: 50px;
            margin-left: 30px;
            margin-right: 70px;
        }

        .book_img {
            margin-right: 40px;
            padding-left: 20%;
        }

        .book_img > div {
            width: 170px;
            display: flex;
        }

        .book_img > div > img { 
            margin: auto;
        }

        .check-str {
            display: flex;
            align-items: center;
        }


        .check-text {
            font-size: 20px;
            white-space: nowrap;
            margin-left: 10px;
        }

        #btn1 {
            box-shadow: 0 0 8px gray;
            border-radius: 5px;
            text-align: center;
            width: 200px;
            padding: 2px;
            margin: 10px 0;
            background-color: orange;
            border: 1px solid  orange;
        }

        #btn2 {
            box-shadow: 0 0 8px gray;
            border-radius: 5px;
            text-align: center;
            width: 200px;
            padding: 2px;
            margin: 10px 0;
            background-color: white;
            border: 1px solid #777777;
        }

        #btn1:hover {
            opacity: 0.6;

        }

        #btn2:hover {
            transform: translateY(2px);
        }
    </style>
</head>

<body>
    <?php $_smarty_tpl->_subTemplateRender("file:./header.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <main>
        <div>
            <div id="cart-check">

                <div class="book_img">
                    <div>
                        <img src="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['image_link']->value, ENT_QUOTES, 'UTF-8', true);?>
" width="auto" height="100" />
                    </div>
                </div>

                <div class="check-str">
                    <img src="./img/check.png" width="25" height="25">
                    <strong class="check-text">追加されました</strong>
                </div>

            </div>

            <div id="cart-box">
                <div>
                    <strong style="font-size: 20px;  ">カートの小計:　&yen;<span id="price"><?php echo $_smarty_tpl->tpl_vars['subtotal']->value;?>
</span></strong>
                      <!-- ここにちょっと余白入れたいんだけどいれようとすると枠が大きくなっちゃうんだよね～だれかたすけて～ -->
                    <div id="btns" style="padding-top: 15%;">
                    <button id="btn1"onclick="location.href='cart.php'">カートに移動</button>
                    <button id="btn2"onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['backUrl']->value;?>
'">詳細に戻る</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php $_smarty_tpl->_subTemplateRender("file:./footer.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</body>

</html><?php }
}
