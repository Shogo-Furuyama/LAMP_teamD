<?php
/* Smarty version 4.1.1, created on 2023-08-23 10:53:57
  from '/home/j2023d/public_html/Smarty/templates/admin/book_detail.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e566b5451ce0_57565157',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4e309143556e186824f5cd1f610698f1d2052f5f' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/admin/book_detail.tmpl',
      1 => 1692755628,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./gmenu.tmpl' => 1,
  ),
),false)) {
function content_64e566b5451ce0_57565157 (Smarty_Internal_Template $_smarty_tpl) {
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
                min-height: 45vh;
                max-height: 75vh;
                margin: auto;
            }

            #top_bar>a {
                float: left;
            }

            #top_bar>button {
                float: right;
                background-color: red;
                color: white;
                margin-bottom: 3px;
                border: solid 1px black;
            }

            #top_bar>button:hover {
                background-color: crimson;
            }
        </style>
    
</head>

<body>
    <!-- 全体コンテナ　-->
    <div id="container">
        <?php $_smarty_tpl->_subTemplateRender('file:./gmenu.tmpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <div id="headTitle">
            <h2>本詳細</h2>
        </div>
        <!-- コンテンツ　-->
        <div id="inquiry">
            <?php echo $_smarty_tpl->tpl_vars['err_flag']->value;?>

            <form name="form1" action="<?php echo $_SERVER['PHP_SELF'];?>
" method="post" enctype="multipart/form-data">
                <div id="top_bar">
                    <a href="book_list.php">一覧に戻る</a>
                    <button type="button" onclick="delJob()">削除</button>
                </div>
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
                        <th>ISBN</th>
                        <td width="70%">
                            <input type="tel" name="isbn" value="<?php echo $_smarty_tpl->tpl_vars['isbn']->value;?>
" maxlength="13" disabled>
                        </td>
                    </tr>
                    <tr>
                        <th>タイトル</th>
                        <td width="70%">
                            <input type="text" class="big_input" name="book_title" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['book_title']->value, ENT_QUOTES, 'UTF-8', true);?>
"
                                maxlength="100" disabled>
                        </td>
                    </tr>
                    <tr>
                        <th>著者</th>
                        <td width="70%">
                            <input type="tel" name="authors" class="big_input" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['authors']->value, ENT_QUOTES, 'UTF-8', true);?>
" disabled>
                        </td>
                    </tr>
                    <tr>
                        <th>表紙画像</th>
                        <td width="70%">
                            <input type="text" name="image_link" class="big_input" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['image_link']->value, ENT_QUOTES, 'UTF-8', true);?>
"
                                disabled>
                            </br>
                            <a href="javascript:void(0)" onclick="img_show()">画像を表示</a>
                        </td>
                    </tr>
                    <tr>
                        <th>ページ数</th>
                        <td width="70%">
                            <input type="tel" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" disabled>
                        </td>
                    </tr>
                    <tr>
                        <th>価格</th>
                        <td width="70%">
                            <input type="tel" name="price" value="<?php echo $_smarty_tpl->tpl_vars['price']->value;?>
" disabled>
                        </td>
                    </tr>
                    <tr>
                        <th>在庫</th>
                        <td width="70%">
                            <input type="tel" name="stock" value="<?php echo $_smarty_tpl->tpl_vars['stock']->value;?>
" disabled>
                        </td>
                    </tr>
                    <tr>
                        <th>発売日</th>
                        <td width="70%">
                            <input type="tel" name="release_date" value="<?php echo $_smarty_tpl->tpl_vars['release_date']->value;?>
" disabled>
                        </td>
                    </tr>
                </table>
                <div id="danger"></div>
                <input type="hidden" name="func" value="edit">
                <p class="center"><input type="submit" value="編集" /></p>
            </form>
        </div>
        <!-- /コンテンツ　-->
    </div>
    <!-- /全体コンテナ　-->
    
        <?php echo '<script'; ?>
 type="text/javascript">
            const imageLinkNode = document.querySelector('[name="image_link"]');

            function img_show() {
                const url = imageLinkNode.value;
                if (url == '') {
                    alert('表紙画像が設定されていません。');
                    return;
                }
                const img = new Image();
                img.src = url;
                img.onload = function () {img_show_process(url);};
                img.onerror = function() { alert("接続に失敗しました。\nリンクが正しくない可能性があります。") };

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

            function delJob() {
                let result = window.confirm('この本を削除します。よろしいでしょうか？');
                if (result) {
                    document.querySelector('[name="func"]').value = 'del';
                    document.form1.submit();
                }
            }
        <?php echo '</script'; ?>
>
    
</body>

</html><?php }
}
