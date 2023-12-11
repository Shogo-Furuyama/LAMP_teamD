<?php
/* Smarty version 4.1.1, created on 2023-08-22 09:58:35
  from '/home/j2023d/public_html/Smarty/templates/inquiry.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e4083be11c92_68409346',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f17e28b4ce9a89a2350268702c81a5f9fdc3084' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/inquiry.tmpl',
      1 => 1692665893,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tmpl' => 1,
    'file:./footer.tmpl' => 1,
  ),
),false)) {
function content_64e4083be11c92_68409346 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">
<head>
     <meta charset="UTF-8">
     <link rel="icon" href="./img/bungo_tabicon.png">
    <link href="./css/bootstrap.min.css" rel="stylesheet" >
    <link href="./css/header.css" rel="stylesheet" >
    <link href="./css/footer.css" rel="stylesheet" >
    
    <style>
        .hr{ 
            border-bottom:solid 1px darkgrey;
            box-shadow: 0 0.4rem 0.4rem gainsboro;
        }

        #page-link>a{
            padding: 0 2rem ;

        }

        #QandA-1 {
	width: 100%;
	font-family: メイリオ;
	font-size: 14px; 
}
#QandA-1 dt {
	background: #5cb85c; 
	color: #fff; 
	padding: 8px;
	border-radius: 2px;
}
#QandA-1 dt:before {
	content: "Q.";
	font-weight: bold;
	margin-right: 8px;
}
#QandA-1 dd {
	margin: 24px 16px 40px 32px;
	line-height: 140%;
	text-indent: -24px;
}
#QandA-1 dd:before {
	content: "A.";
	font-weight: bold;
	margin-right: 8px;
}

.btn{
    border-radius: 10px;
}

    </style>
    
    <title>お問い合わせ</title>
</head>

<body>

<?php $_smarty_tpl->_subTemplateRender("file:./header.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <div class="Main_head">
        <h1 class="pt-4 px-5">お問い合わせ</h1>
    </div>
    <div class="Main_body">
        <p class="pt-4 px-5 text-center fs-4">当サイトにおける問題の解決方法、お問い合わせ窓口をご案内いたします</p>
    </div>

    
    <div id="page-link" class="page-link text-center">
        <a href="#FAQ"> よくあるご質問（FAQ）</a>
        
        <a href="#inquiry">お問い合わせ</a>
    </div>

    <div class="Main_head" >
        <h1 class="pt-4 px-5" id="FAQ">よくあるご質問（FAQ）</h1>
    </div>

    <div id="QandA-1" class="QandA-1 px-5">
        <dl>
            <dt>返品は可能ですか？</dt>
            <dd>購入した商品にキズ、汚れ等が付着していた場合のみ返品可能です<br>それ以外の返品は基本受け付けておりません</dd>
            <dt>納品までの期間はどのくらいですか？</dt>
            <dd>通常、ご注文から3日以内に納品させていただいております。<br>ただし、地域や天候、繁忙期によっては前後する可能性がございます。</dd>
            <dt>保障内容を教えてください</dt>
            <dd>最短期間での再発送などのサポート体制で対応させていただいております。<br>また、必要に応じて分析や調査を行い、お客様に結果をご報告させていただくとともに再発防止も徹底してまいります。</dd>
            <dt>コンビニ支払いの「支払期限」を過ぎてしまったのですが支払いできますか？</dt>
            <dd>「支払期限」を過ぎましてもお手元の払い込み用紙でお支払いいただけます</dd>
            <dt>書籍に帯はついていますか？</dt>
            <dd>帯は販促品扱いとなり、当社では帯つきでの出荷はお約束しておりません。<br>出荷の際、帯に破損などがあった場合、あらかじめ帯を外して出荷する場合もございます。帯の有無・破損による交換・返品は承っておりません。</dd>
            <dt>SMSやメールが送られてきましたが、「迷惑メール」では無いか確認できますか？</dt>
            <dd>下記ドメイン以外からのメールは、「ぶんごうを装ったなりすましサイト」の可能性がありますのでご注意ください。
                <br>【ぶんごうが使用するドメイン】
                <br>@bungou.co.jp
                <br>※個人のお客さま宛ても、法人のお客さま宛ても、同じドメインを使用しております。ぶんごうでは、ショートメール（SMS）によるご不在通知やお届け予定通知は行っておりません。
            </dd>
            
        </dl>
    </div>

    <div class="Main_head">
        <h1 class="pt-4 px-5 text-center" id="inquiry">各ご意見、ご質問、ご提案はこちらから</h1>
    </div>

    <div class="button text-center py-5 px-5 ">
        <button type="button" class="btn btn-dark btn-lg px-4 py-4" onclick="location.href='inquiry_form.php'">お問い合わせフォーム</button>
    </div>
    
    
    <?php $_smarty_tpl->_subTemplateRender("file:./footer.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</body>
</ht再配達再配達>
<?php }
}
