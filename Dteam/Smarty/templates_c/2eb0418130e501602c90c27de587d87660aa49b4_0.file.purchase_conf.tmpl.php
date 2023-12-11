<?php
/* Smarty version 4.1.1, created on 2023-08-23 10:45:07
  from '/home/j2023d/public_html/Smarty/templates/purchase_conf.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e564a39212d6_10564415',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2eb0418130e501602c90c27de587d87660aa49b4' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/purchase_conf.tmpl',
      1 => 1692753890,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tmpl' => 1,
    'file:./footer.tmpl' => 1,
  ),
),false)) {
function content_64e564a39212d6_10564415 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="./img/bungo_tabicon.png">
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
            padding: 50px;
            margin-top: 50px;
            margin-left: 70px;
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

                

                <div class="check-str">
                    <img src="./img/check.png" width="25" height="25">
                    <strong class="check-text">お支払いが完了しました</strong>
                </div>

            </div>

            <div id="cart-box">
                <div>
                   
                    <div>
                    <h5>お届け予定日:<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
</h5>
                    </div>

                 
                      <!-- ここにちょっと余白入れたいんだけどいれようとすると枠が大きくなっちゃうんだよね～だれかたすけて～ -->
                    <div id="btns" style="padding-top: 20%; padding-left:80px;">
                    <button id="btn1" onclick="location.href='index.php'">トップに戻る</button>
                    
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
