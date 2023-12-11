<?php
/* Smarty version 4.1.1, created on 2023-08-23 10:45:05
  from '/home/j2023d/public_html/Smarty/templates/cart.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e564a17110d0_55853340',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b933754c99e1290c7dfa4899523e59eec8eddc43' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/cart.tmpl',
      1 => 1692753622,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tmpl' => 1,
    'file:./footer.tmpl' => 1,
  ),
),false)) {
function content_64e564a17110d0_55853340 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="./img/bungo_tabicon.png">
  <link href="./css/login.css" rel="stylesheet">
  <link href="./css/header.css" rel="stylesheet">
  <link href="./css/cart.css" rel="stylesheet">
  <link href="./css/footer.css" rel="stylesheet">
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <title>ショッピングカート</title>
  
    <?php echo '<script'; ?>
 src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"><?php echo '</script'; ?>
>
  

  
    <style>
      body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
      }

      main {
        flex-grow: 1;
        min-height: 400px;
      }

      .stepper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        margin-top: 20px;
        width: 70%;
      }

      .stepper-step {
        flex: 1;
        text-align: center;

        border: solid 1px #999999;
        padding: 10px;
        border: solid 1px #009900;
        ;
        border-radius: 10px;
        background-color: #009900;
        ;
        color: aliceblue;
        cursor: pointer;
      }

      .stepper-step.active {
        color: #333333;
        color: aliceblue;
      }

      .stepper-line {
        flex: 1;
        height: 2px;
        background-color: #999999;
      }

      .stepper-line.active {
        background-color: #999999;
      }

      .popup-container {
        position: relative;
      }


      .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 1.5rem;
        color: #000;
        text-decoration: none;
      }

      .close-btn:hover {
        color: #ff0000;
      }

      .table {
        margin-top: 20px;
      }

      a:hover {
        color: #009900;
      }

      button.add {
        background-color: #009900;
        color: #fff;
        width: 10em;
        height: 3em;
        border-radius: 10%;


      }

      button.add:hover {
        opacity: 0.7;
        color: white;

      }

      button.cancel {
        background-color: #AAAAAA;
        color: #fff;
        width: 10em;
        height: 3em;
        margin-right: 5%;
        margin-left: 45%;
        border-radius: 10%;


      }

      .summary {
        box-shadow: 0 0 8px gray;
      }

      .popup {

        display: flex;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 600px;
        background-color: white;
        border: 1px solid white;
        padding: 20px;
        text-align: center;
        z-index: 2;

        justify-content: center;
        align-items: center;

      }


      .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1001;
        display: none;
      }


      .popup2 {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1001;
        display: none;
      }

      .popup-content {

        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 600px;
        height: 400px;
        background-color: white;
        border: 1px solid white;
        padding: 20px;
        text-align: center;
        z-index: 2;

        justify-content: center;
        align-items: center;
      }

      #credit_num_inputs {
        display: flex;
      }

      #credit_num_inputs>span {
        margin-block: auto;
        color: black;
      }
    </style>
  

</head>

<body>
  <?php $_smarty_tpl->_subTemplateRender("file:./header.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <main>
    <div class="stepper">
      <div class="stepper-step active">ショッピングカート</div>
      <div class="stepper-line"></div>
      <div class="stepper-step">支払いと配送方法</div>
      <div class="stepper-line"></div>
      <div class="stepper-step">注文確認</div>
    </div>



    <div class="display1">
      <div class="basket">


        <i class="bi bi-cart4"></i>

        <div style="display: flex; align-items: center;">
          <img src="./img/cart.png" style="width: 32px; height: auto;margin-right: 7px;" alt="ショッピングカートアイコン">
          <h2>ショッピングカート</h2>
        </div>


        <div class="basket-labels">
          <ul>
            <li class="item item-heading">商品</li>
            <li class="price">価格</li>
            <li class="quantity">個数</li>
            <li class="subtotal">小計</li>
          </ul>
        </div>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['books']->value, 'value', false, 'k');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
          <div class="basket-product" id="bp_<?php echo $_smarty_tpl->tpl_vars['value']->value['index'];?>
">


            <div class="item">
              <div class="product-image">
                <img src="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['image_link'], ENT_QUOTES, 'UTF-8', true);?>
" alt="Placholder Image 2" class="product-frame">
              </div>
              <div class="product-details">
                <h5><strong><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['book_title'], ENT_QUOTES, 'UTF-8', true);?>
</strong></h5>
                <p>著書:<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['authors'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                <?php if ($_smarty_tpl->tpl_vars['value']->value['stock'] == 0) {?>
                  <p class="text-danger stockStatus">在庫がありません</p>
                <?php } elseif ($_smarty_tpl->tpl_vars['value']->value['stock'] <= 10) {?>
                  <p class="text-danger stockStatus">残り<?php echo $_smarty_tpl->tpl_vars['value']->value['stock'];?>
冊となりました</p>
                <?php } else { ?>
                  <p class="text-success stockStatus">在庫あり</p>
                <?php }?>
              </div>
            </div>
            <input type="hidden" class="stockParam" value="<?php if ($_smarty_tpl->tpl_vars['value']->value['stock'] == 0) {?>1<?php } else { ?>0<?php }?>">
            <input type="hidden" class="book_id" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['book_id'];?>
">
            <div class="price"><?php echo $_smarty_tpl->tpl_vars['value']->value['price'];?>
</div>
            <div class="quantity">
              <input type="number" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['num'];?>
" min="1" class="quantity-field" onchange="updateSubtotal(this)">
            </div>
            <div class="subtotal"></div>
            <div class="remove">
              <button class="button" onclick="removeProduct(<?php echo $_smarty_tpl->tpl_vars['value']->value['index'];?>
)">消去</button>
            </div>
          </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

      </div>
      <div id="cart-empty-message" style="display: none;">
        現在カートの中身には商品が入っておりません。またご利用お待ちしております。<br>
        <a href="#">お買い物に戻る</a>
      </div>
    </div>
    <form method="post" action="cart.php" name="form1">
      <div class="display2" style="display: none;">
        <div class="" style="width: 70%; float: left;">


          <div style="margin-bottom: 30px;">
            <h4>お支払い方法の選択</h4>
          </div>

          <div class="payment-section" style="margin-bottom: 50px;">

            <div class="cresit" style="margin-bottom: 20px; margin-top:10px;">
              <input type="radio" id="creditCard" name="paymentMethod" value="1" checked="checked">
              <label for="creditCard">クレジットカード
                <img src="./img/logoCard_visa_v2.png" style="display: inline; width: 35px; height: auto;">
                <img src="./img/logoCard_jcb2.png" style="display: inline; width: 35px; height: auto;">
                <img src="./img/logoCard_master.png" style="display: inline; width: 35px; height: auto;">
                <span id="registCredittext" style="color: black;"></span>
              </label>
              <br>
              <img src="./img/PlusIcon._CB485933946_.gif"
                style="display: inline; width: 20px; height: auto; padding: 3px;">
              <a href="javascript:void(0)" onclick="openPopup('popup-overlay')">クレジットカードまたはデビットカードを追加</a><br>

            </div>

            <div class="convenience">
              <input type="radio" id="convenience" name="paymentMethod" value="3">
              <label for="convenience">コンビニ前払い</label><br>
            </div>

            <div class="info">
              <img src="./img/インフォメーションアイコン3.png" style="display: inline; width: 20px; height: auto; padding: 3px;">
              <a href="#" id="payment_detail">支払い方法に関する詳細</a><br>
            </div>


          </div>

          
          <div>
            <div style="margin-bottom: 30px;">
              <h4>配送方法とお届け日時の選択</h4>
            </div>
            <div class="delivery-section">

              <div style="margin-bottom: 10px;">
                <h6>配送方法</h6>
              </div>

              <div class="delivery" style="margin-bottom: 20px;">
                <input type="radio" id="delivery" name="deliveryMethod" checked="checked">
                <label for="delivery" style="display: inline-block;">通常配達　　　　　　　　　　　　　<span
                    style="color: #ff0000;">送料無料</span></label> <br>
                <img src="./img/インフォメーションアイコン3.png" style="display: inline; width: 20px; height: auto; padding: 3px;">
                <a href="#" id="delivery_detail">配送方法に関する詳細</a><br>
              </div>

              <div class="place" style="margin-bottom: 20px;">
                <h6>受取場所</h6>
                <div>
                  <?php if ($_smarty_tpl->tpl_vars['user']->value['address'] !== null) {?>
                    <input type="radio" id="regAddress" name="address" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['user']->value['address'], ENT_QUOTES, 'UTF-8', true);?>
" checked="checked">
                    <label for="regAddress" id="regAddresslabel"
                      style="display: inline-block;">〒<?php echo $_smarty_tpl->tpl_vars['user']->value['post_num'];?>
&emsp;<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['user']->value['address'], ENT_QUOTES, 'UTF-8', true);?>
</label>
                    <br>
                  <?php }?>
                  <input type="radio" id="address" name="address" style="display: none;">
                  <label for="address" id="addresslabel" style="display: none;"></label>
                </div>
                <div>
                </div>
                <div style="margin-top:5px;">
                  <img src="./img/hensyuu.png" style="display: inline; width: 20px; height: auto; padding: 3px;">
                  <a href="javascript:void(0)" id="editAddress" onclick="openPopup('addressPopup')">住所を編集</a>
                </div>
              </div>

              <div class="date">
                <div>
                  <h6>お届け日時</h6>
                </div>

                <div class="date-dicision" style="margin-bottom: 15px;">
                  <input type="radio" id="date_specification" name="deliveryDate" checked="checked" value="日時指定">
                  <label for="date">日時指定</label><br>
                  <label for="dateSelect">日付を選択してください:</label>
                  <select id="dateSelect" name="dateSelect">
                  </select><br>
                </div>
                
                  <?php echo '<script'; ?>
>
                    document.addEventListener("DOMContentLoaded", function() {
                      // 今日の日付を取得
                      var today = new Date();
                      // 最小の日付を今日から3日後に設定
                      var minDate = new Date(today);
                      minDate.setDate(today.getDate() + 3);
                      // 最大の日付を今日から1週間後に設定
                      var maxDate = new Date(today);
                      maxDate.setDate(today.getDate() + 7);

                      // ドロップダウンをminDateからmaxDateまでの日付で埋める
                      var select = document.getElementById("dateSelect");
                      for (var date = minDate; date <= maxDate; date.setDate(date.getDate() + 1)) {
                        var option = document.createElement("option");
                        var dateString = date.toISOString().split("T")[0];
                        var dayOfWeek = getDayOfWeek(date.getDay()); // 曜日を取得
                        option.value = dateString;
                        option.textContent = dateString + " (" + dayOfWeek + ")";
                        select.appendChild(option);
                      }


                      select.value = minDate.toISOString().split("T")[0];
                    });

                    // 曜日を返す関数
                    function getDayOfWeek(dayNumber) {
                      var days = ["日", "月", "火", "水", "木", "金", "土"];
                      return days[dayNumber];
                    }
                  <?php echo '</script'; ?>
>

                

                <div class="no-date">
                  <input type="radio" id="date_no" name="deliveryDate" value="指定なし">
                  <label for="date">指定なし</label><br>
                </div>
              </div>
            </div>

          </div>




          



                              
        </div>
      </div>


      <div class="display3" style="display: none;">
        <div class="order-confirmation" style="width: 70%; float: left;">
          <div style="margin-bottom: 20px;">
            <h4>受取場所 </h4>
          </div>
          <div id="fAddressText" style="margin-bottom: 10px;">
            設定されていません
          </div>
          <div style="margin-bottom:20px;">
            <h4>お支払い方法 </h4>
          </div>
          <div id="fPayMethodText" style="margin-bottom: 10px;">
            クレジットカード
          </div>

          <h4>ご注文商品</h4>
          <div class="basket">
            <i class="bi bi-cart4"></i>
            <div class="basket-labels">
              <ul>
                <li class="item item-heading">商品</li>
                <li class="price">価格</li>
                <li class="quantity">個数</li>
                <li class="subtotal">小計</li>
              </ul>
            </div>
            <div id="fBaskets">
                          </div>
          </div>
        </div>
      </div>
    </form>


        <aside id="confirmButtonContainer">
      <div class="summary">
        <div class="summary-total-items"><span class="total-items"></span>
          <h5>
            <font color="#333333"> お支払い金額</font>
          </h5>
        </div>
        <div class="summary-subtotal">
          <div class="subtotal-title">商品小計</div>
          <div class="subtotal-value final-value" id="basket-subtotal"></div>

        </div>

        <div class="summary-total">
          <div class="total-title">合計金額(税込)</div>
          <div class="total-value final-value" id="basket-total"></div>
        </div>
        <div class="summary-checkout">
          <button type="button" class="checkout-cta onclick=proceedToPaymentDelivery()" id="nextButton"
            style="border: none;">次へ進む</button>
        </div>


      </div>
    </aside>

    <div class="popup-overlay" id="popup-overlay">
      <div class="window">
        <div class="popup" id="popup" style="border-radius: 20px; display: block;">
          <h5 style="margin-bottom: 50px; margin-top: 20px;">クレジットカードまたはデビットカード追加</h5>
          <table class="table">
            <tbody class="tableSize">
              <tr class="align-middle">
                <th style="border-style: none;">カード番号<span class="span">*</span></th>
                <td style="border-style: none;">
                  <div id="credit_num_inputs">
                    <input type="tel" id="credit_1" class="card_number form-control" minlength="4" maxlength="4">
                    <span>ー</span>
                    <input type="tel" id="credit_2" class="card_number form-control" minlength="4" maxlength="4">
                    <span>ー</span>
                    <input type="tel" id="credit_3" class="card_number form-control" minlength="4" maxlength="4">
                    <span>ー</span>
                    <input type="tel" id="credit_4" class="card_number form-control" minlength="4" maxlength="4">
                  </div>
                </td>
              </tr>
              <tr class="align-middle">
                <th style="border-style: none;">クレジットカード<br>名義人<span class="span">*</span></th>
                <td style="border-style: none;">
                  <input type="text" id="credit_5" class="form-control">
                  <div id="pass_error"></div>
                </td>
              </tr>
              <tr class="align-middle">
                <th style="border-style: none;">有効期限<span class="span">*</span></th>
                <td style="border-style: none;">
                  <div class="dicide">
                    <select name="month" id="credit_6">
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
                    <select name="year" id="credit_7">
                      <option slot="year">--</option>
                      <option slot="year">2023</option>
                      <option slot="year">2024</option>
                      <option slot="year">2025</option>
                      <option slot="year">2026</option>
                      <option slot="year">2027</option>
                      <option slot="year">2028</option>
                    </select>
                    &nbsp;年
                  </div>
                </td>
              </tr>
              <tr class="align-middle">
                <th style="border-style: none;">セキュリティコード<span class="span">*</span></th>
                <td style="border-style: none;">
                  <input type="text" id="credit_8" class="form-control">
                </td>
              </tr>
            </tbody>
          </table>
          <div id="credit_error" style="color: red;margin-bottom: 20px;"></div>
          <button type="button" class="cancel" onclick="closePopup('popup-overlay')"
            style="border: none;">キャンセル</button>
          <button type="button" class="add" style="border: none;" onclick="creditRegist()">登録</button>
          <a href="javascript:void(0)" onclick="closePopup('popup-overlay')"><span class="close-btn">&times;</span></a>
        </div>
      </div>
    </div>
        <div id="addressPopup" class="popup2">
      <div class="popup-content" style="border-radius: 20px;">
        <h5 style="margin-bottom: 40px; margin-top: 20px;">住所を編集</h5>
        <div>
          <table class="table" cellpadding="15">
            <tbody class="tableSize" style="border-style: none;">
              <tr class="align-middle">
                <th style="width: 40%;border-style: none;">郵便番号</th>
                <td style="width: 60%;border-style: none;"> <input type="text" id="rAddress_1" value=""
                    placeholder="例：1234567" style="width: 100px;"
                    onKeyUp="AjaxZip3.zip2addr(this,'','rAddress_2','rAddress_3','rAddress_4');"></td>

              </tr>
              <tr class="align-middle">
                <th style="border-style: none;">都道府県</th>
                <td style="border-style: none;"><input type="text" name="rAddress_2" id="rAddress_2"></td>
              </tr>

              <tr class="align-middle">
                <th style="border-style: none;">市区町村</th>
                <td style="border-style: none;"><input type="text" name="rAddress_3" id="rAddress_3"></td>
              </tr>
              <tr class="align-middle">
                <th style="border-style: none;">以降の住所</th>
                <td style="border-style: none;"> <input type="text" name="rAddress_4" id="rAddress_4"
                    style="width: 200px;">
                </td>
              </tr>


            </tbody>
          </table>
        </div>
        <div id="rAddress_error" style="color: red;margin-bottom: 20px;"></div>
        <button type="button" id="closeAddressPopup" onclick="closePopup('addressPopup')"><span
            class="close-btn">&times;</span></button>
        <div style="padding-top:60px;padding-left: 330px ">
          <button type="button" class="add" style="border: none;" onclick="addressRegist()">確定</button>
        </div>
      </div>
    </div>



    <!-- 配送詳細モーダル -->
    <div id="deliveryPopup" class="popup2">
      <div class="popup-content" style="border-radius: 20px;">
        <h4 style="margin-bottom: 30px; margin-top: 20px;">配送方法に関する詳細</h4>
        <form style="text-align: left">
          <div class="detail_1" style="margin-bottom: 20px;">
            <h5>商品発送のタイミング</h5>
            <p style="margin-bottom: 0;">備考 :</p>
            <p style="margin-bottom: 0;">特にご指定がない場合、</p>
            <p style="margin-bottom: 0;">上記以外の決済の場合（例：クレジットカード）⇒ご注文確認後、5営業日に発送いたします。</p>
          </div>
          <h5>配送サービスについて</h5>
          <div class="detail_2">
            <p style="margin-bottom: 0;">備考 :</p>
            <p>複数の商品をお買い上げの場合、メール便に収まらない場合がございます。その際には運送便に変更させて頂く場合がございます。</p>
          </div>
          <button id="closeDeliveryPopup"><span class="close-btn">&times;</span></button>
        </form>
      </div>
    </div>

    <div id="paymentPopup" class="popup2">
      <div class="popup-content" style="border-radius: 20px;">
        <h5 style="margin-bottom: 20px; margin-top: 20px;">支払い方法に関する詳細</h5>
        <form style="text-align: left;">

          <div class="detail_1" style="margin-bottom: 20px;">

            <h5 style="text-align: left;margin-bottom: 20px;">クレジットカード</h5>
            <p style="text-align: left;">
              お客様のご利用状況などによってクレジットカードがご利用いただけない場合、楽天市場がクレジットカード情報やお支払い方法の変更をご案内、またはご注文をキャンセルいたします。</p>
            <p style="text-align: left;">クレジットカード情報またはお支払い方法の変更をご案内後、7日間変更いただけない場合、楽天市場が自動でご注文をキャンセルいたします。</p>
            <p style="text-align: left;">
              ※お客様と異なる名義のクレジットカードはご利用いただけません。
            </p>
            <h5 style="text-align: left;margin-bottom: 20px;">コンビニ前払い</h5>
            <p style="text-align: left;margin-bottom: 0;">ご注文後に、払込票番号および払込票のURLを記載したメールを楽天市場からお送りいたします。</p>
            <p style="text-align: left;margin-bottom: 0;">14日以内にお支払いが確認できない場合、楽天市場が自動でご注文をキャンセルいたします。</p>
            <p style="text-align: left;margin-bottom: 0;">決済手数料は無料です</p>
          </div>




          <button id="closeDeliveryPopup"><span class="close-btn">&times;</span></button>

        </form>
      </div>
    </div>



    
      <?php echo '<script'; ?>
>
        // 初期の小計を計算して表示する関数
        // 小計を計算
        function calculateSubtotal() {
          const productRows = document.getElementsByClassName("basket-product");
          let subtotal = 0;

          for (const productRow of productRows) {
            const quantityField = productRow.getElementsByClassName("quantity-field")[0];
            const price = parseInt(productRow.getElementsByClassName("price")[0].innerText);
            const subtotalField = productRow.getElementsByClassName("subtotal")[0];

            const quantity = parseInt(quantityField.value);
            const productSubtotal = quantity * price;
            subtotal += productSubtotal;

            subtotalField.innerText = productSubtotal;

          }


          const subtotalValue = document.getElementById("basket-subtotal");
          const totalValue = document.getElementById("basket-total");

          subtotalValue.innerText = subtotal;
          totalValue.innerText = subtotal;
        }

        // 商品の個数が変更された時に小計を更新する関数
        function updateSubtotal(input) {
          const quantity = parseInt(input.value);
          const price = parseInt(input.parentNode.parentNode.getElementsByClassName("price")[0].innerText);
          const subtotal = quantity * price;

          input.parentNode.parentNode.getElementsByClassName("subtotal")[0].innerText = subtotal;

          calculateSubtotal();
        }

        // 商品を削除する関数
        function removeProduct(index) {
          document.getElementById("bp_" + index).remove();

          calculateSubtotal();
          // カートの中身をチェック
          checkCartEmpty();
        }

        // 初期の小計を計算して表示する
        calculateSubtotal();
        // ステップごとの表示切り替え
        const stepperSteps = document.querySelectorAll('.stepper-step');
        const stepperLines = document.querySelectorAll('.stepper-line');
        const paymentDeliveryMethod = document.querySelector('.display2');
        const orderConfirmation = document.querySelector('.display3');
        const display1 = document.querySelector('.display1');

        let currentStep = 0;

        const nextButton = document.getElementById('nextButton');


        const steps = [display1, paymentDeliveryMethod, orderConfirmation];
        nextButton.addEventListener('click', () => {
          // 現在のステップを非表示にする
          steps[currentStep].style.display = 'none';
          stepperSteps[currentStep].classList.remove('active');
          currentStep++;
          if (currentStep == 3) {
            document.form1.submit();
            return;
          }
          if (currentStep >= steps.length) {
            currentStep = 2; // 最後のステップの次は最初に戻る
          }
          steps[currentStep].style.display = 'block';
          stepperSteps[currentStep].classList.add('active');
          if (currentStep == 2) {
            display3ShowProcess();
          }
        });

        stepperSteps.forEach((step, index) => {
          step.addEventListener('click', () => {
            updateStepper(index);
          });
        });

        function updateStepper(activeStep) {
          currentStep = activeStep;
          steps.forEach((step, index) => {
            if (index === activeStep) {
              step.style.display = 'block';
              stepperSteps[index].classList.add('active');
              if (index == 2) {
                display3ShowProcess();
              }
            } else {
              step.style.display = 'none';
              stepperSteps[index].classList.remove('active');
            }
          });
        }

        function display3ShowProcess() {
          const fBaskets = document.getElementById('fBaskets');
          const oldBaskets = fBaskets.querySelectorAll('.basket-product2');
          for (let i = 0; i < oldBaskets.length; i += 1) {
            oldBaskets[i].remove();
          }
          let regiIndex = 0;
          const baskets = document.querySelectorAll('.basket-product');
          for (let i = 0; i < baskets.length; i += 1) {
            if (baskets[i].querySelector('.stockParam').value != 0) {
              continue;
            }
            const bNum = baskets[i].querySelector('.quantity-field').value;
            const div = document.createElement('div');
            div.classList.add('basket-product2');
            const item = baskets[i].querySelector('.item').cloneNode(true);
            item.querySelector('.stockStatus').remove();
            const price = baskets[i].querySelector('.price').cloneNode(true);
            const quantity = baskets[i].querySelector('.quantity').cloneNode(false);
            const pQuantity = document.createElement('p');
            pQuantity.innerText = bNum;
            quantity.appendChild(pQuantity);
            const subtotal = baskets[i].querySelector('.subtotal').cloneNode(true);
            const book_id = baskets[i].querySelector('.book_id').cloneNode(true);
            book_id.name = 'bid' + regiIndex;
            const bNumNode = document.createElement('input');
            bNumNode.type = 'hidden';
            bNumNode.value = bNum;
            bNumNode.name = 'bNum' + regiIndex;
            div.append(item, price, quantity, subtotal, book_id, bNumNode);
            fBaskets.appendChild(div);
            regiIndex += 1;
          }
        }


        function proceedToPaymentDelivery() {
          updateStepper(1); // 遷移先を支払いと配送方法に設定
          // 商品小計の更新
        }

        function checkCartEmpty() {
          var productRows = document.getElementsByClassName('basket-product');
          var cartEmptyMessage = document.getElementById('cart-empty-message');

          if (productRows.length === 0) {
            cartEmptyMessage.style.display = 'block';
            basket.style.display = 'none';
            paymentDeliveryMethod.style.display = 'none';
            orderConfirmation.style.display = 'none';
          } else {
            cartEmptyMessage.style.display = 'none';
            basket.style.display = 'block';
            paymentDeliveryMethod.style.display = 'none';
            orderConfirmation.style.display = 'none';
          }
        }
        // display3要素が表示されたときにnextButtonのテキストを変更する関数
        function changeButtonText() {

          if (orderConfirmation.style.display === 'block') {
            nextButton.textContent = '注文確定';

          } else {
            nextButton.textContent = '次へ進む';
          }
        }

        // display3要素が表示/非表示に切り替わるたびにchangeButtonText関数を呼び出す
        const observer = new MutationObserver(changeButtonText);
        observer.observe(orderConfirmation, { attributes: true, attributeFilter: ['style'] });


        function creditRegist() {
          const credit_1 = document.getElementById('credit_1');
          const credit_2 = document.getElementById('credit_2');
          const credit_3 = document.getElementById('credit_3');
          const credit_4 = document.getElementById('credit_4');
          const credit_5 = document.getElementById('credit_5');
          const credit_6 = document.getElementById('credit_6');
          const credit_7 = document.getElementById('credit_7');
          const credit_8 = document.getElementById('credit_8');

          const credit_num_pattern = '^[0-9]{4}$';
          let flag = false;
          let errortext = '';
          if (!credit_1.value.match(credit_num_pattern) ||
            !credit_2.value.match(credit_num_pattern) ||
            !credit_3.value.match(credit_num_pattern) ||
            !credit_4.value.match(credit_num_pattern)) {
            errortext += 'クレジット番号の形式が正しくありません。\n';
            flag = true;
          }
          if (credit_5.value == '') {
            errortext += '名義人を入力してください。\n';
            flag = true;
          }
          if (credit_6.value == '--' || credit_7.value == '--') {
            errortext += '有効期限を入力してください。\n';
            flag = true;
          }
          if(!credit_8.value.match('^[0-9]{3}$')) {
          errortext += 'セキュリティーコードを正しく入力してください。\n';
          flag = true;
        }
        if (flag) {
          document.getElementById('credit_error').innerText = errortext;
        } else {
          document.getElementById('registCredittext').innerText = credit_1.value + '-xxxx-xxxx-xxxx';
          closePopup('popup-overlay');
        }
        }

        function addressRegist() {
          const rAddress_1 = document.getElementById('rAddress_1');
          const rAddress_2 = document.getElementById('rAddress_2');
          const rAddress_3 = document.getElementById('rAddress_3');
          const rAddress_4 = document.getElementById('rAddress_4');

          let flag = false;
          let errortext = '';

          if(!rAddress_1.value.match('^[0-9]{7}$')) {
          errortext += '郵便番号が正しくありません。\n';
          flag = true;
        }

        if (rAddress_2.value == '' || rAddress_3.value == '' || rAddress_4.value == '') {
          errortext += '住所が入力されていません\n';
          flag = true;
        }
        if (flag) {
          document.getElementById('rAddress_error').innerText = errortext;
        } else {
          const address = rAddress_2.value + rAddress_3.value + rAddress_4.value;
          const addressText = '〒' + rAddress_1.value.substring(0, 3) + '-' + rAddress_1.value.substring(3) + '　' +
            address;
          const addNode = document.getElementById('address');
          const addlNode = document.getElementById('addresslabel');
          addNode.value = address;
          addlNode.innerText = addressText;
          addNode.style.display = 'inline';
          addlNode.style.display = 'inline';
          addNode.checked = true;
          document.getElementById('fAddressText').innerText = addressText;
          closePopup('addressPopup');
        }
        }

        function openPopup(id) {
          var overlay = document.getElementById(id);
          overlay.style.display = 'block';
          document.body.style.overflow = 'hidden';
        }

        function closePopup(id) {
          var overlay = document.getElementById(id);
          overlay.style.display = 'none';
          document.body.style.overflow = 'auto';
        }

        document.addEventListener("DOMContentLoaded", function() {
          const creditCBox = document.getElementById('creditCard');
          const convenienceCBox = document.getElementById('convenience');
          const regAddressCBox = document.getElementById('regAddress');
          const addressCBox = document.getElementById('address');

          creditCBox.addEventListener('change', function() {
            document.getElementById('fPayMethodText').innerText = 'クレジットカード';
          });

          convenienceCBox.addEventListener('change', function() {
            document.getElementById('fPayMethodText').innerText = 'コンビニ前払い';
          });

          addressCBox.addEventListener('change', function() {
            document.getElementById('fAddressText').innerText = document.getElementById('addresslabel').innerText;
          });

          if (regAddressCBox != null) {
            document.getElementById('fAddressText').innerText = document.getElementById('regAddresslabel').innerText;
            regAddressCBox.addEventListener('change', function() {
              document.getElementById('fAddressText').innerText = document.getElementById('regAddresslabel')
                .innerText;
            });
          }

        });
      <?php echo '</script'; ?>
>
    

  </main>
  <?php $_smarty_tpl->_subTemplateRender("file:./footer.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

  
    <?php echo '<script'; ?>
 src="./js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
  
</body>

</html><?php }
}
