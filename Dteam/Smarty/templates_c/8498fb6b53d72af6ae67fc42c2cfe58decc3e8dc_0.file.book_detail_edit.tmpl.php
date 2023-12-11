<?php
/* Smarty version 4.1.1, created on 2023-07-31 01:06:13
  from '/home/j2023d/public_html/Smarty/templates/admin/book_detail_edit.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64c68a75e92196_09919526',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8498fb6b53d72af6ae67fc42c2cfe58decc3e8dc' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/admin/book_detail_edit.tmpl',
      1 => 1690436634,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./gmenu.tmpl' => 1,
  ),
),false)) {
function content_64c68a75e92196_09919526 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <title>本詳細</title>
    
        <style>
            .big_input {
                width: 80%;
            }

            .input_error {
                border-color: red;
            }

            #danger {
                color: red;
            }

            #img_show {
                position: fixed;
                left: 0;
                top: 0;
                height: 100vh;
                width: 100vw;
                background-color: rgba(0, 0, 0, 0.25);
            }

            #img_show>a {
                position: absolute;
                right: 0;
                top: 0;
                color: black;
                font-size: 5vw;
                text-decoration: none;
            }

            #img_show>a:hover {
                color: red;
            }

            #img_show>div {
                display: flex;
                height: 100%;
                width: 100%;
            }

            #img_show>div>img {
                width: auto;
                max-height: 75vh;
                margin: auto;
            }

            #isbnTestResult {
                font-weight: bold;
            }
        </style>
    
</head>

<body>
    <!-- 全体コンテナ　-->
    <div id="container">
        <?php $_smarty_tpl->_subTemplateRender('file:./gmenu.tmpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <div id="headTitle">
            <h2>本登録</h2>
        </div>
        <!-- コンテンツ　-->
        <div id="inquiry">
            <?php echo $_smarty_tpl->tpl_vars['err_flag']->value;?>

            <form name="form1" action="<?php echo $_SERVER['PHP_SELF'];?>
?subid=<?php echo $_smarty_tpl->tpl_vars['submit_id']->value;?>
" method="post"
                enctype="multipart/form-data">
                <a href="book_list.php">一覧に戻る</a><br />
                <table>
                    <tr>
                        <th>ID</th>
                        <td width="70%">
                            <?php echo $_smarty_tpl->tpl_vars['book_id_txt']->value;?>

                            <input type="hidden" name="book_id" value="<?php echo $_smarty_tpl->tpl_vars['book_id']->value;?>
">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            ISBN</br>
                            <font color="red">※ハイフンは含めないでください</font>
                        </th>
                        <td width="70%">
                            <input type="tel" name="isbn" value="<?php echo $_smarty_tpl->tpl_vars['isbn']->value;?>
">
                            <?php if ($_smarty_tpl->tpl_vars['book_id']->value != 0) {?>
                                <input type="hidden" name="d_isbn" value="<?php echo $_smarty_tpl->tpl_vars['isbn']->value;?>
">
                            <?php }?>
                            <button type="button" onclick="isbnTest(true)">重複チェック</button>
                            <span id="isbnTestResult"><span>
                        </td>
                    </tr>
                    <tr>
                        <th>タイトル</th>
                        <td width="70%">
                            <input type="text" class="big_input" name="book_title" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['book_title']->value, ENT_QUOTES, 'UTF-8', true);?>
"
                                maxlength="100">
                        </td>
                    </tr>
                    <tr>
                        <th>著者</th>
                        <td width="70%">
                            <input type="tel" name="authors" class="big_input" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['authors']->value, ENT_QUOTES, 'UTF-8', true);?>
" maxlength="30">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            表紙画像
                            </br>
                            <font color="red">※アップロードは2MBまで</font>
                        </th>
                        <td width="70%">
                            <?php if ($_smarty_tpl->tpl_vars['is_up_img']->value == 1) {?>
                                <input type="radio" name="img_type" id="img_t_2" value="def" onchange="change_up_img()"
                                    checked><label for="img_t_2">前回の画像を使用する</label>
                                <input type="radio" name="img_type" id="img_t_1" value="link"
                                    onchange="change_up_img()"><label for="img_t_1">リンク</label>
                            <?php } else { ?>
                                <input type="radio" name="img_type" id="img_t_1" value="link" onchange="change_up_img()"
                                    checked><label for="img_t_1">リンク</label>
                            <?php }?>
                            <input type="radio" name="img_type" id="img_t_0" value="up"
                                onchange="change_up_img()"><label for="img_t_0">アップロード</label>
                            <input type="radio" name="img_type" id="img_t_3" value="emp"
                                onchange="change_up_img()"><label for="img_t_3">設定しない</label>
                            </br>
                            <?php if ($_smarty_tpl->tpl_vars['is_up_img']->value == 1) {?>
                                <input type="hidden" name="image_def" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['image_link']->value, ENT_QUOTES, 'UTF-8', true);?>
">
                                <input type="text" name="image_link" class="big_input" style="display: none;"
                                    maxlength="200">
                            <?php } else { ?>
                                <input type="text" name="image_link" class="big_input" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['image_link']->value, ENT_QUOTES, 'UTF-8', true);?>
"
                                    style="display: block;" maxlength="200">
                            <?php }?>
                            <input type="file" name="image_file" class="big_input"
                                accept="image/png, image/jpeg, image/jpg" onchange="img_size_check()"
                                style="display: none;">
                            <a href="javascript:void(0)" onclick="img_show()">画像を表示</a>
                            <input type="hidden" name="is_up_img" value="<?php echo $_smarty_tpl->tpl_vars['is_up_img']->value;?>
">
                        </td>
                    </tr>
                    <tr>
                        <th>ページ数</th>
                        <td width="70%">
                            <input type="tel" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" maxlength="9">
                        </td>
                    </tr>
                    <tr>
                        <th>価格</th>
                        <td width="70%">
                            <input type="tel" name="price" value="<?php echo $_smarty_tpl->tpl_vars['price']->value;?>
" maxlength="9">
                        </td>
                    </tr>
                    <tr>
                        <th>在庫</th>
                        <td width="70%">
                            <input type="tel" name="stock" value="<?php echo $_smarty_tpl->tpl_vars['stock']->value;?>
" maxlength="9">
                        </td>
                    </tr>
                    <tr>
                        <th>発売日&emsp;<font color="red">※例 2023-01-01</font>
                        </th>
                        <td width="70%">
                            <input type="tel" name="release_date" value="<?php echo $_smarty_tpl->tpl_vars['release_date']->value;?>
" maxlength="10">
                        </td>
                    </tr>
                </table>
                <div id="danger"></div>
                <input type="hidden" name="func" value="set">
                <input type="hidden" name="submit_id" value="<?php echo $_smarty_tpl->tpl_vars['submit_id']->value;?>
">
                <p class="center">
                    <input type="button" value="戻る" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['back']->value;?>
'" />&emsp;<input type="button"
                        value="<?php echo $_smarty_tpl->tpl_vars['button']->value;?>
" onclick="checkInput()" />
                </p>
            </form>
        </div>
        <!-- /コンテンツ　-->
    </div>
    <!-- /全体コンテナ　-->
    
        <?php echo '<script'; ?>
 type="text/javascript">
            const isbnNode = document.querySelector('[name="isbn"]');
            const isbnTestTextNode = document.getElementById('isbnTestResult');
            const titleNode = document.querySelector('[name="book_title"]');
            const authorsNode = document.querySelector('[name="authors"]');
            const imageLinkNode = document.querySelector('[name="image_link"]');
            const imageFileNode = document.querySelector('[name="image_file"]');
            const pageNode = document.querySelector('[name="page"]');
            const priceNode = document.querySelector('[name="price"]');
            const stockNode = document.querySelector('[name="stock"]');
            const releaseNode = document.querySelector('[name="release_date"]');
            const imageDefNode = document.querySelector('[name="image_def"]');
            const imgChangeFile = document.getElementById('img_t_0');
            const imgChangeLink = document.getElementById('img_t_1');
            const imgChangeDef = document.getElementById('img_t_2');
            const imgChangeEmp = document.getElementById('img_t_3');
            const isbnDefNode = document.querySelector('[name="d_isbn"]');
            let isSubmit = true;
            let errMsg = '';

            async function checkInput() {
                isSubmit = true;
                errMsg = '';
                isbnTestTextNode.innerText = '';
                await Promise.all([isbnTest(false)]);
                if(checkProcess(titleNode,'^.{1,100}$')) {
                errMsg += 'タイトルは1文字以上100文字以内です。\n';
                isSubmit = false;
            }
            if(checkProcess(authorsNode,'^.{1,30}$')) {
            errMsg += '著者は1文字以上30文字以内です。\n';
            isSubmit = false;
            }
            if (imgChangeLink.checked) {
                if(checkProcess(imageLinkNode,'^.{1,200}$')) {
                errMsg += '表紙画像リンクは200文字以内です。\n';
                isSubmit = false;
            } else {
                let promise = new Promise(function(resolve) {
                    const img = new Image();
                    img.onload = function() {
                        imageLinkNode.classList.remove('input_error');
                        resolve();
                    }
                    img.onerror = function() {
                        errMsg += '画像の読み込みに失敗しました。リンクが正しくない可能性があります。\n';
                        isSubmit = false;
                        imageLinkNode.classList.add('input_error');
                        resolve();
                    }
                    img.src = imageLinkNode.value;
                });
                await promise;
            }
            } else if (imgChangeFile.checked && imageFileNode.value == '') {
                errMsg += '画像を選択してください。\n';
                isSubmit = false;
            }
            if(checkProcess(pageNode,'^([1-9]{1}[0-9]{0,8}|0)$')) {
            errMsg += 'ページは半角数字、1文字以上9文字以内、0以上の値です。\n';
            isSubmit = false;
            }
            if(checkProcess(priceNode,'^([1-9]{1}[0-9]{0,8}|0)$')) {
            errMsg += '価格は半角数字、1文字以上9文字以内、0以上の値です。\n';
            isSubmit = false;
            }
            if(checkProcess(stockNode,'^([1-9]{1}[0-9]{0,8}|0)$')) {
            errMsg += '在庫は半角数字、1文字以上9文字以内、0以上の値です\n';
            isSubmit = false;
            }
            if(checkProcess(releaseNode,'^[0-9]{4}-[0-9]{2}-[0-9]{2}$')) {
            errMsg += '発売日の形式が正しくありません。例に従って入力してください。\n';
            isSubmit = false;
            }
            else {
                let strDate = releaseNode.value.split('-');
                let y = strDate[0];
                let m = strDate[1] - 1;
                let d = strDate[2];
                let date = new Date(y, m, d);
                if (date.getFullYear() != y || date.getMonth() != m || date.getDate() != d) {
                    releaseNode.classList.add('input_error');
                    errMsg += '発売日に存在しない日付が入力されました。正しい値を入力してください\n';
                    isSubmit = false;
                }
            }
            if (isSubmit) {
                document.form1.submit();
            } else {
                document.getElementById('danger').innerText = errMsg;
            }
            }

            async function isbnTest(msgFlag) {
                if(checkProcess(isbnNode,'^([0-9]{9}[0-9X]{1}|[0-9]{12}[0-9X]{1})$')) {
                if (msgFlag) {
                    isbnTestTextNode.innerText = 'isbnの形式が正しくありません。';
                    isbnTestTextNode.style.color = 'red';
                } else {
                    errMsg = 'isbnの形式が正しくありません。\n';
                    isSubmit = false;
                }
            } else {
                let result = false;
                if (isbnDefNode == null || isbnDefNode.value != isbnNode.value) {
                    let promise = new Promise(function(end) {
                        const xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (xmlhttp.readyState == 4) {
                                if (xmlhttp.status == 200) {
                                    try {
                                        result = JSON.parse(xmlhttp.responseText).count == 1;
                                    } catch (e) {}
                                }
                                end();
                            }
                        }
                        xmlhttp.open("GET", "../booksearch.php?sf=2&k=" + isbnNode.value);
                        xmlhttp.send();
                    });
                    await promise;
                }
                if (result) {
                    isbnNode.classList.add('input_error');
                    if (msgFlag) {
                        isbnTestTextNode.innerText = 'この本は既に登録されています。';
                        isbnTestTextNode.style.color = 'red';
                    } else {
                        isSubmit = false;
                        errMsg = 'この本は既に登録されています。\n';
                    }
                } else if (msgFlag) {
                    isbnTestTextNode.innerText = '登録できます。';
                    isbnTestTextNode.style.color = 'green';
                }
            }
            }

            function checkProcess(node, pattern) {
                if (node.value.match(pattern)) {
                    node.classList.remove('input_error');
                } else {
                    node.classList.add('input_error');
                    return true;
                }
                return false;
            }

            function change_up_img() {
                if (imgChangeFile.checked) {
                    imageLinkNode.style.display = 'none';
                    imageFileNode.style.display = 'block';
                } else if (imgChangeLink.checked) {
                    imageFileNode.style.display = 'none';
                    imageLinkNode.style.display = 'block';
                } else if (imgChangeEmp.checked || imgChangeDef.checked) {
                    imageFileNode.style.display = 'none';
                    imageLinkNode.style.display = 'none';
                }
            }

            function img_show() {
                if (imgChangeFile.checked) {
                    if (imageFileNode.files[0] == null) {
                        alert('画像が選択されていません。');
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function (evnet) {img_show_process(reader.result);}
                    reader.readAsDataURL(imageFileNode.files[0]);
                } else if (imgChangeLink.checked) {
                    const url = imageLinkNode.value;
                    if (url == '') {
                        alert('画像先のリンクを入力してください。');
                        return;
                    }
                    const img = new Image();
                    img.src = url;
                    img.onload = function () {img_show_process(url);};
                    img.onerror = function() { alert("接続に失敗しました。\nリンクが正しくない可能性があります。") };
                } else if (!imgChangeEmp.checked && imgChangeDef.checked) {
                    const url = imageDefNode.value;
                    const img = new Image();
                    img.src = url;
                    img.onload = function () {img_show_process(url);};
                    img.onerror = function() { alert("接続に失敗しました。もう一度お試しください。") };
                }
            }

            function img_show_process(source) {
                const div = document.createElement('div');
                div.id = 'img_show';
                const ex = document.createElement('a');
                ex.innerText = '×';
                ex.href = 'javascript:void(0)';
                ex.addEventListener('click',function() {div.remove();});
                const imgDiv = document.createElement('div');
                const img = document.createElement('img');
                img.src = source;
                imgDiv.append(img);
                div.append(ex, imgDiv);
                document.querySelector('body').append(div);
            }

            function img_size_check() {
                const file = imageFileNode.files[0];

                //拡張子チェック
                if (!file.name.match('.(png|jfif|pjpeg|jpeg|pjp|jpg)$')) {
                    alert('このファイルはサポートされていない形式です。');
                }
                //2ﾒｶﾞ制限 1024*1024*2
                else if (file.size > 2097152) {
                    alert('２メガバイトを超過しています。');
                } else {
                    return;
                }
                imageFileNode.value = '';
            }
        <?php echo '</script'; ?>
>
    
</body>

</html><?php }
}
