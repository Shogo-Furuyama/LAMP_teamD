<?php
/* Smarty version 4.1.1, created on 2023-08-22 09:57:11
  from '/home/j2023d/public_html/Smarty/templates/overview.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e407e7ec4262_11458807',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '68149c55587fe7f5ccdd070c615e24c7aba8dcbb' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/overview.tmpl',
      1 => 1692665813,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tmpl' => 1,
    'file:./footer.tmpl' => 1,
  ),
),false)) {
function content_64e407e7ec4262_11458807 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./img/bungo_tabicon.png">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
    <link href="./css/footer.css" rel="stylesheet">
    <title>サイト概要</title>
    <style>
        #t_t {
            height: 16vw;
            display: flex;
            position: relative;
        }

        #t_t>img {
            position: absolute;
            top: 10%;
            left: 0;
            height: 80%;
            width: auto;

        }

        #t_t>h1 {
            font-size: 3.3vw;
            margin: auto;

        }

        #expla {
            padding-block: 10vw;
            text-align: center;
            font-size: 2.5vw;
        }

        #detail_t {
            border-top: solid 1px black;
            padding-block: 5vw;
            font-size: 2vw;
            text-align: center;
        }

        #detail {
            width: 100%;
            margin-bottom: 10vw;
        }

        #detail>tbody>tr>th {
            width: 50%;
            text-align: center;
        }

        #detail>tbody>tr>th>img {
            height: auto;
            width: 40%;
            margin-block: 4rem;
        }

        #detail>tbody>tr>td {
            width: 50%;     
        }

        #detail>tbody>tr>td>span {
            font-size: 2vw;
            font-weight: bold;            
        }

        .i_t {
            font-size: 1.5vw;
            margin-bottom: 5px;
        }

        @media (max-width: 992px) {
            .i_t {
                font-size: 2vw;
            }

            #detail_t {
                font-size: 2.5vw;
            }
        }
    </style>
</head>

<body>
    <?php $_smarty_tpl->_subTemplateRender("file:./header.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <main class="mx-auto mt-5 col-lg-9 col-md-11 col-12">
        <div id="t_t">
            <img src="./img/over_1.png">
            <h1>サイト概要</h1>
        </div>
        <p id="expla">
            このサイトはあなたのお気に入りの本を</br>
            リスト化し、共有できるサイトです
        </p>
        <h4 id="detail_t">
            当サイトでできること
        </h4>
        <table id="detail">
            <tbody>
                <tr>
                    <th><img src="./img/over_2.png"></th>
                    <td>
                        <div class="i_t">その１</div>
                        <span>
                            気に入った本を追加して</br>
                            あなただけのリストが作れる！
                        </span>
                    </td>
                </tr>
                <tr>
                    <th><img src="./img/over_3.png"></td>
                    <td>
                        <div class="i_t">その２</div>
                        <span>
                            作ったリストは</br>
                            みんなに共有できる！
                        </span>
                    </td>
                </tr>
                <tr>
                    <th><img src="./img/over_4.png"></td>
                    <td>
                        <div class="i_t">その３</div>
                        <span>
                            みんなのリストから</br>
                            本を購入できる！
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
    <?php $_smarty_tpl->_subTemplateRender("file:./footer.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php echo '<script'; ?>
 src="./js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="./js/header.js"><?php echo '</script'; ?>
>
</body>

</html><?php }
}
