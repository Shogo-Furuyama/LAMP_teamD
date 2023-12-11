<?php
/* Smarty version 4.1.1, created on 2023-08-21 18:17:29
  from '/home/j2023d/public_html/Smarty/templates/myPage_purchase_detail.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e32ba97d87e2_69310754',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9699dcefdf7aa23ab0fe6efc3115cf8450c5c38e' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/myPage_purchase_detail.tmpl',
      1 => 1692609152,
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
function content_64e32ba97d87e2_69310754 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="./img/bungo_tabicon.png">
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <link href="./css/mypage_favorite.css" rel="stylesheet">
  <link href="./css/header.css" rel="stylesheet">
  <link href="./css/footer.css" rel="stylesheet">
  <link href="./css/myPage_menu.css" rel="stylesheet">
  <link href="./css/book_list.css" rel="stylesheet">
  <title>注文履歴</title>
  <style>
    .a-box-inner {
      padding: 9px;
      display: flex;
      justify-content: space-between;
      background-color: #EEEEEE;
      border-bottom;
      : 1px solid #c0c0c0;
      border-radius: 20px 20px 0px 0px;

    }

    .a-box-inner-left {
      display: flex;

    }

    .a-box-inner-left>div {
      margin: 10px;

    }

    .product-in {
      display: flex;

    }

    .book-detail {
      margin-left: 40px;
    }

    .repeat {
      background-color: #ffffff;
      border-radius: 4px;
      padding: 5px 10px 5px 10px;

    }

    .group2 {
      display: flex;
    }

    .detail {
      padding-left: 300px;
      margin-top: 10px;
    }

    .box {
      margin-bottom: 10px;
      border: 0.5px solid#c0c0c0;
      border-radius: 20px;

    }

    .order-num {
      margin-top: 4px;
      margin-left: 10px;
      margin-right: 10px;

    }



    .tool {
      /* 補足説明するテキストのスタイル */
      position: relative;
      cursor: pointer;
      padding: 0 5px;
      font-size: 0.9em;
      color: #4682b4;
    }

    .description_bottom {
      /* ツールチップのスタイル */
      width: 150px;
      /* 横幅 */
      position: absolute;
      top: 80%;
      /* Y軸の位置 */
      left: 50%;
      transform: translateX(-50%);
      margin-top: 8px;
      /* テキストとの距離 */
      padding: 8px;
      border-radius: 10px;
      /* 角の丸み */
      background-color: #666;
      font-size: 0.7em;
      color: #fff;
      text-align: center;
      visibility: hidden;
      /* ツールチップを非表示に */
      opacity: 0;
      /* 不透明度を0％に */
      z-index: 1;
      transition: 0.5s all;
      /* マウスオーバー時のアニメーション速度 */
    }

    .tool:hover .description_bottom {
      /* マウスオーバー時のスタイル */
      top: 100%;
      /* Y軸の位置 */
      visibility: visible;
      /* ツールチップを表示 */
      opacity: 1;
      /* 不透明度を100％に */
    }
  </style>
</head>

<body>
  <?php $_smarty_tpl->_subTemplateRender("file:./header.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <main class="d-flex">
    <div class="container row">
      <?php $_smarty_tpl->_subTemplateRender("file:./mypage_sidebar.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
      <div id="Prf" class="col-9">
        <div class="personal_all">
          <section>
            <div class="container py-5">
              <h1 style="margin-bottom: 30px;">注文詳細</h1>

              

            

              

                 
             
            </div>
          </section>
        </div>
      </div>
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
