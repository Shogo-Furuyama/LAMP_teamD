<?php
/* Smarty version 4.1.1, created on 2023-08-08 02:11:45
  from '/home/j2023d/public_html/Smarty/templates/list_detail.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d125d166df82_86604409',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fb0e9694eb075d9626804da412f8a933c85f5ffc' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/list_detail.tmpl',
      1 => 1691428286,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tmpl' => 1,
    'file:./footer.tmpl' => 1,
  ),
),false)) {
function content_64d125d166df82_86604409 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./img/bungo_tabicon.png">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
    <link href="./css/footer.css" rel="stylesheet">
    <title><?php if ((isset($_smarty_tpl->tpl_vars['list_info']->value['list_title']))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['list_info']->value['list_title'], ENT_QUOTES, 'UTF-8', true);
} else { ?>存在しないリストです。<?php }?></title>
    <style>
        main {
            padding: 2%;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        footer {
            margin-top: auto;
        }

        #l_info {
            width: 100%;
            display: flex;
        }

        #l_info_1 {
            width: 70%;
        }

        #l_info_1>h1 {
            font-size: 2.2vw;
        }

        #l_info_1>h3 {
            display: flex;
            color: dimgray;
            font-size: 1.7vw;
            margin-left: 2px;
        }

        #l_info_1>h3>img {
            margin-block: auto;
            margin-right: 5px;
            height: 1.7vw;
            width: auto;
        }

        #l_info_1>h5 {
            font-size: 1.5vw;
        }

        #l_info_2 {
            width: 30%;
            margin-left: 5px;
        }

        #thumbs {
            width: 100%;
            display: flex;
            align-items: center;
        }

        #thumbs>a {
            width: 10%;
            margin-inline: 5%;
        }

        #thumbs>a>img {
            height: auto;
            width: 100%;
            transition: filter 0.3s ease;
        }

        #thumbs>a>img:hover {
            filter: opacity(50%);
        }

        #thumbs>div {
            width: 55%;
            font-size: 2.5vw;
        }

        .thumbsActive {
            filter: opacity(50%) !important;
        }

        #list_user_info {
            display: flex;
            align-items: center;
            border: solid gray 0.2rem;
            border-radius: 10px;
            margin: 10% 5%;
            padding: 5%;
        }

        #list_user_info>a {
            width: 18%;
        }

        #list_user_info>a>div {
            width: 100%;
            aspect-ratio: 1 / 1;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            transition: filter 0.3s ease;
        }

        #list_user_info>a>div:hover {
            filter: opacity(80%);
        }

        #list_user_info>span {
            margin-inline: 5%;
            width: 70%;
            font-size: 1.5vw;
            font-weight: bold;
            word-break: break-all;
        }

        #register_books {
            margin-block: 5%;
            border-top: dashed 1px black;
        }

        #register_books>* {
            padding-block: 1%;
            border-bottom: dashed 1px black;
            aspect-ratio: 6 / 1;
            display: flex;
        }

        .regist_book {
            height: auto;
        }

        .reg_num {
            margin-block: auto;
            width: 5%;
            text-align: center;
            font-size: 1.3vw;
        }

        .book_img {
            width: 20%;
            display: flex;
            overflow: hidden;
        }

        .book_img>img {
            height: 80%;
            width: auto;
            margin: auto;

        }

        .book_info {
            width: 40%;
            height: 100%;
            padding-inline: 1%;
            justify-content: center;
            margin-block: auto;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .book_info>h3 {
            width: 100%;
            max-height: 47%;
            margin-bottom: 2%;
            font-size: 1.5vw;
            word-break: break-all;
            overflow-y: scroll;
        }

        .book_info>h5 {
            height: 13%;
            color: dimgray;
            margin: 0;
            font-size: 1.3vw;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            word-break: break-all;
        }

        .into_cart {
            height: 20%;
            width: 100%;
            margin-top: 5%;
            display: flex;
            align-items: center;
        }

        .into_cart>div {
            width: 56%;
            height: 100%;
            font-size: 1.3vw;
            display: flex;
            align-items: center;
        }

        .into_cart>div>button {
            height: 100%;
            font-size: 1.3vw;
            padding-inline: 5%;
            padding-block: 0;
            border: solid gray 1px;
            border-radius: 20px;
            box-shadow: 2px 2px 2px gray;
            background-color: orange;
            transition: background-color 0.3s ease;
            margin-right: 2%;
        }

        .into_cart>div>input {
            font-size: 1.3vw;
        }

        .into_cart>div>button:hover {
            background-color: darkorange;

        }

        .into_cart>span {
            font-size: 1.5vw;
        }

        .book_introduction {
            width: 35%;
            font-size: 1.3vw;
            overflow-y: scroll;
        }

        @media (max-width: 950px) {
            #l_info {
                display: block;
            }

            #l_info_1 {
                width: 100%;
            }

            #l_info_1>h1 {
                font-size: 3.5vw;

            }

            #l_info_1>h3 {
                font-size: 2.4vw;
            }

            #l_info_1>h3>img {
                height: 2.4vw;
            }

            #l_info_1>h5 {
                font-size: 2.2vw;
            }

            #l_info_2 {
                width: 100%;
                display: flex;
                margin-top: 1rem;
            }

            #thumbs {
                width: 50%;
            }

            #thumbs>a {
                width: 8%;
                margin-inline: 0 5%;
            }

            #thumbs>div {
                width: 55%;
                font-size: 4vw;
            }

            #list_user_info {
                width: 40%;
                margin: 0 0 0 auto;
                padding: 2%;
            }

            #list_user_info>a {
                width: 15%;
            }

            #list_user_info>span {
                font-size: 2vw;
            }

            #register_books>* {
                aspect-ratio: 3 / 1;
            }

            .reg_num {
                font-size: 2.2vw;
            }

            .book_img {
                width: 25%;
            }

            .book_img>img {
                height: 65%;

            }

            .book_info>h3 {
                max-height: 50%;
                font-size: 2vw;
            }

            .book_info>h5 {
                font-size: 1.5vw;
            }

            .book_info>.rel_date {
                height: 8%;
            }

            .book_info>.authors {
                height: auto;
                max-height: 17%;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                white-space: normal;
            }

            .into_cart {
                height: 20%;
                margin-top: 3%;
                flex-direction: column;
                align-items: normal;
            }

            .into_cart>div {
                height: 50%;
                width: 100%;
                font-size: 1.7vw;
            }

            .into_cart>div>button {
                font-size: 1.7vw;
            }

            .into_cart>span {
                display: inline-block;
                line-height: 1;
                margin-top: auto;
                font-size: 2.3vw;
            }

            .book_introduction {
                width: 40%;
                font-size: 1.8vw;
            }
        }
    </style>
</head>

<body>
    <?php $_smarty_tpl->_subTemplateRender("file:./header.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <main>
        <?php if ($_smarty_tpl->tpl_vars['list_info']->value !== false) {?>
            <div id="l_info">
                <div id="l_info_1">
                    <h1><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['list_info']->value['list_title'], ENT_QUOTES, 'UTF-8', true);?>
</h1>
                    <h3><img src="./img/genre_icon.png"><?php echo $_smarty_tpl->tpl_vars['list_info']->value['genre_name'];?>
&emsp;<img
                            src="./img/target_icon.png"><?php echo $_smarty_tpl->tpl_vars['list_info']->value['target_name'];?>
</h3>
                    <h5><?php echo nl2br((string) htmlspecialchars((string)$_smarty_tpl->tpl_vars['list_info']->value['list_comment'], ENT_QUOTES, 'UTF-8', true), (bool) 1);?>
</h5>
                </div>
                <div id="l_info_2">
                    <div id="thumbs">
                        <a href="javascript:void(0)" onclick="favoriteClick()">
                            <img src="./img/thumbsup.png" />
                        </a>
                        <div><?php echo $_smarty_tpl->tpl_vars['list_info']->value['favorite'];?>
</div>
                    </div>
                    <div id="list_user_info">
                        <a href="myPage.php?uid=<?php echo $_smarty_tpl->tpl_vars['list_info']->value['user_id'];?>
">
                            <div
                                style="background-image: url('<?php if ($_smarty_tpl->tpl_vars['list_info']->value['icon_img'] === null) {?>./img/default_icon.png<?php } else {
echo $_smarty_tpl->tpl_vars['FILEUP_DIR']->value;
echo $_smarty_tpl->tpl_vars['list_info']->value['icon_img'];
}?>');">
                            </div>
                        </a>
                        <span><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['list_info']->value['user_name'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                    </div>
                </div>
            </div>
            <div id="register_books">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['books']->value, 'value', false, 'k');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                    <div class="regist_book">
                        <div class="reg_num"><?php echo $_smarty_tpl->tpl_vars['value']->value['index'];?>
</div>
                        <div class="book_img">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['value']->value['image_link'];?>
" />
                        </div>
                        <div class="book_info">
                            <h3><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['book_title'], ENT_QUOTES, 'UTF-8', true);?>
</h3>
                            <h5 class="rel_date"><?php echo $_smarty_tpl->tpl_vars['value']->value['release_date'];?>
</h5>
                            <h5 class="authors"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['authors'], ENT_QUOTES, 'UTF-8', true);?>
</h5>
                            <div class="into_cart">
                                <div>
                                    <button type="button" onclick="addCart(<?php echo $_smarty_tpl->tpl_vars['value']->value['index'];?>
)">カートに入れる</button>
                                    数量：<input type="number" value="1" min="1" max="99" id="bn_<?php echo $_smarty_tpl->tpl_vars['value']->value['index'];?>
">
                                </div>
                                <span>&yen;<?php echo $_smarty_tpl->tpl_vars['value']->value['price'];?>
</span>
                            </div>
                        </div>
                        <input type="hidden" id="bi_<?php echo $_smarty_tpl->tpl_vars['value']->value['index'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['book_id'];?>
">
                        <span
                            class="book_introduction"><?php if ($_smarty_tpl->tpl_vars['value']->value['comment'] !== false) {
echo nl2br((string) htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['comment']['comment'], ENT_QUOTES, 'UTF-8', true), (bool) 1);
}?></span>
                    </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
            <input id="status" type="hidden" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['favoriteFlg']->value, ENT_QUOTES, 'UTF-8', true);?>
">
        <?php } else { ?>
            <h1>このリストは存在しません。</h1>
        <?php }?>
    </main>
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
            let submitFlg = true;
            let fluctuationFlg = true;
            let listId = 0;

            async function favoriteClick() {
                if (submitFlg) {
                    submitFlg = false;
                    try {
                        const thumbsNode = document.getElementById('thumbs');
                        const thumbsImg = thumbsNode.querySelector('img');
                        const thumbsNum = thumbsNode.querySelector('div');
                        try {
                            thumbsImg.classList.add('thumbsActive');
                            const params = new URL(window.location.href).searchParams;
                            let jsonObj = null;
                            let promise = new Promise(function(end) {
                                let xmlhttp = new XMLHttpRequest();
                                xmlhttp.onreadystatechange = function() {
                                    if (xmlhttp.readyState == 4) {
                                        if (xmlhttp.status == 200) {
                                            jsonObj = JSON.parse(xmlhttp.responseText);
                                        }
                                        end();
                                    }
                                }
                                xmlhttp.open('POST', 'favorite.php');
                                xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                xmlhttp.send(new URLSearchParams({f:fluctuationFlg?1:0,id:listId}).toString());
                            });
                            await promise;
                            if (jsonObj != null) {
                                if (jsonObj.success) {
                                    if (fluctuationFlg) {
                                        thumbsImg.src = './img/thumbsup_active.png';
                                        thumbsNum.innerText = Number(thumbsNum.innerText) + 1;
                                    } else {
                                        thumbsImg.src = './img/thumbsup.png';
                                        thumbsNum.innerText = Number(thumbsNum.innerText) - 1;
                                    }
                                    fluctuationFlg = !fluctuationFlg;
                                } else if (!jsonObj.isLogin) {
                                    send_login_page();
                                }
                            }
                        } finally {
                            thumbsImg.classList.remove('thumbsActive');
                        }
                    } finally {
                        submitFlg = true;
                    }
                }
            }



            async function addCart(i) {
                if (submitFlg) {
                    submitFlg = false;
                    try {
                        const bookId = document.getElementById('bi_' + i).value;
                        const bookNum = document.getElementById('bn_' + i).value;
                        let jsonObj = null;
                        let promise = new Promise(function(end) {
                            let xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                                if (xmlhttp.readyState == 4) {
                                    if (xmlhttp.status == 200) {
                                        try {
                                            jsonObj = JSON.parse(xmlhttp.responseText);
                                        } catch (e) {}
                                    }
                                    end();
                                }
                            }
                            xmlhttp.open('POST', 'cart_conf.php');
                            xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                            xmlhttp.send(new URLSearchParams({bid:bookId,num:bookNum}).toString());
                        });
                        await promise;
                        if (jsonObj != null) {
                            if (jsonObj.success) {
                                location.href = 'cart_conf.php?bid=' + bookId + '&lid=' + listId;
                                return;
                            } else if (!jsonObj.isLogin) {
                                send_login_page();
                                return;
                            }
                        }
                        alert('処理に失敗しました。時間をおいて再度実行してください。');
                    } finally {
                        submitFlg = true;
                    }
                }
            }

            function send_login_page() {
                location.href = 'user_login.php?path=' + encodeURIComponent('list_detail.php?id=' + listId);
            }

            document.addEventListener('DOMContentLoaded', function() {
                const statusNode = document.getElementById('status');
                if (statusNode != null) {
                    const status = statusNode.value;
                    if (status != '') {
                        const flg = status == 1;
                        fluctuationFlg = flg;
                        if (!flg) {
                            document.getElementById('thumbs').querySelector('img').src =
                            './img/thumbsup_active.png';
                        }
                    }
                    listId = new URL(window.location.href).searchParams.get('id');
                }
            });
        <?php echo '</script'; ?>
>
    
</body>

</html><?php }
}
