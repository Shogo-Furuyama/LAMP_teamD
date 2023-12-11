<?php
/* Smarty version 4.1.1, created on 2023-08-21 18:20:36
  from '/home/j2023d/public_html/Smarty/templates/myPage_purchase.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e32c64091720_83112675',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '255ca26169eb7f7128075143b7f4e1702e4322b7' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/myPage_purchase.tmpl',
      1 => 1692609626,
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
function content_64e32c64091720_83112675 (Smarty_Internal_Template $_smarty_tpl) {
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
              <h1 style="margin-bottom: 30px;">注文履歴</h1>

              <div class="box">
                <div class="a-box-inner">
                  <div class="a-box-inner-left">
                    <div class="group">
                      <div class="order-date">
                        <font size="2"><a>注文日</a><br></font>
                        <a>2023年7月23日</a>
                      </div>
                    </div>
                    <div class="group">
                      <div class="sum">
                        <font size="2"><a>合計</a><br></font>
                        <a><span> &yen; </span>2,000</a>
                      </div>
                    </div>
                    <div class="group">
                      <div class="address">
                        <font size="2">お届け先</br></font>
                        <a class="tool">小林杏優<span class="description_bottom">福島県郡山市方八町２丁目４－１５</span></a>

                      </div>
                    </div>
                  </div>

                  <div class="a-box-inner-rigjt">
                    <div class="order-num" style="margin: 10px;">
                      <font size="2"><a>注文番号</a><br></font>
                      <a>22222222222222</a>
                    </div>

                  </div>
                </div>
                <div class="product" style="padding-left: 15px;">
                  <h4 style="margin-top: 20px; margin-bottom: 20px;"><span>配送中</span></h4>
                  <div class="product-in" style="padding-bottom: 20px;">
                    <div class="book-img" style="width: 30%;">
                      <img src="img/book1.jpg" width="200px" height="150px">
                    </div>

                    <div class="book-detail" style="width: 70%;">
                      <h5 style="margin-bottom: 10px;">はらぺこあおむし</h5>
                      </font>
                      <p style="margin-bottom: 50px;"> エリック・カール</p>
                      <div class="group2">
                        <button class="repeat">
                          <font size="2">再度購入</font>
                        </button>

                        <div class="detail">
                          <a href="#">注文詳細</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="box">
                <div class="a-box-inner">
                  <div class="a-box-inner-left">
                    <div class="group">
                      <div class="order-date">
                        <font size="2"><a>注文日</a><br></font>
                        <a>2023年6月23日</a>
                      </div>
                    </div>
                    <div class="group">
                      <div class="sum">
                        <font size="2"><a>合計</a><br></font>
                        <a><span> &yen; </span>1,600</a>
                      </div>
                    </div>
                    <div class="group">
                      <div class="address">
                        <font size="2">お届け先</br></font>
                        <a class="tool">小林杏優<span class="description_bottom">福島県郡山市方八町２丁目４－１５</span></a>

                      </div>
                    </div>
                  </div>

                  <div class="a-box-inner-rigjt">
                    <div class="order-num" style="margin: 10px;">
                      <font size="2"><a>注文番号</a><br></font>
                      <a>22222222222222</a>
                    </div>
                  </div>
                </div>
                <div class="product" style="padding-left: 15px;">
                  <h4 style="margin-top: 20px; margin-bottom: 20px;"><span>2023/6/31</span>に<span>出荷</span></h4>
                  <div class="product-in" style="padding-bottom: 20px;">
                    <div class="book-img" style="width: 30%;">
                      <img src="img/book2.jpg" width="150px" height="200x">
                    </div>

                    <div class="book-detail" style="width: 70%;">
                      <h5 style="margin-bottom: 10px;">人間失格</h5>
                      </font>
                      <p style="margin-bottom: 50px;"> 太宰治</p>
                      <div class="group2">
                        <button class="repeat">
                          <font size="2">再度購入</font>
                        </button>
                        <div class="detail">
                          <a href="#">キャンセル</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box">
                <div class="a-box-inner">
                  <div class="a-box-inner-left">
                    <div class="group">
                      <div class="order-date">
                        <font size="2"><a>注文日</a><br></font>
                        <a>2023年7月23日</a>
                      </div>
                    </div>
                    <div class="group">
                      <div class="sum">
                        <font size="2"><a>合計</a><br></font>
                        <a><span> &yen; </span>1,260</a>
                      </div>
                    </div>
                    <div class="group">
                      <div class="address">
                        <font size="2">お届け先</br></font>
                        <a class="tool">小林杏優<span class="description_bottom">福島県郡山市方八町２丁目４－１５</span></a>

                      </div>
                    </div>
                  </div>

                  <div class="a-box-inner-rigjt">
                    <div class="order-num" style="margin: 10px;">
                      <font size="2"><a>注文番号</a><br></font>
                      <a>22222222222222</a>
                    </div>

                  </div>
                </div>
                <div class="product" style="padding-left: 15px;">
                  <h4 style="margin-top: 20px; margin-bottom: 20px;"><span>2023/6/31</span>に<span>配達</span></h4>
                  <div class="product-in" style="padding-bottom: 20px;">
                    <div class="book-img" style="width: 30%;">
                      <img src="img/book3.jpg" width="150px" height="200x">
                    </div>

                    <div class="book-detail" style="width: 70%;">
                      <h5 style="margin-bottom: 10px;">線は僕を描く</h5>
                      </font>
                      <p style="margin-bottom: 50px;">砥上 裕將</p>
                      <div class="group2">
                        <button class="repeat">
                          <font size="2">再度購入</font>
                        </button>
                        <div class="detail">
                          <a href="#">注文詳細</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
