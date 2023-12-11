<?php
/* Smarty version 4.1.1, created on 2023-07-31 13:56:43
  from '/home/j2023d/public_html/Smarty/templates/admin/booklist_detail.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64c73f0b407424_30818700',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b7fe0ccc2985adf0a8b90e4ccd563d906c1f103' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/admin/booklist_detail.tmpl',
      1 => 1690779396,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./gmenu.tmpl' => 1,
  ),
),false)) {
function content_64c73f0b407424_30818700 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <title>リスト詳細</title>
    
        <style>
            .big_input {
                width: 80%;
            }

            #container {
                padding-bottom: 5px;
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
            <h2>リスト詳細</h2>
        </div>
        <!-- コンテンツ　-->
        <div id="inquiry">
            <form name="form1" action="<?php echo $_SERVER['PHP_SELF'];?>
" method="post">
                <div id="top_bar">
                    <a href="booklist_list.php">一覧に戻る</a>
                    <button type="button" onclick="delJob()">削除</button>
                </div>
                <table>
                    <tr>
                        <th>リストID</th>
                        <td width="70%">
                            <?php echo $_smarty_tpl->tpl_vars['list_id']->value;?>

                            <input type="hidden" name="list_id" value="<?php echo $_smarty_tpl->tpl_vars['list_id']->value;?>
">
                        </td>
                    </tr>
                    <tr>
                        <th>タイトル</th>
                        <td width="70%">
                            <input type="text" class="big_input" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['list_title']->value, ENT_QUOTES, 'UTF-8', true);?>
" disabled>
                        </td>
                    </tr>
                    <tr>
                        <th>書籍数</th>
                        <td width="70%">
                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['book_count']->value;?>
" disabled>
                        </td>
                    </tr>
                    <tr>
                        <th>リストコメント</th>
                        <td width="70%">
                            <textarea class="big_input" disabled><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['list_comment']->value, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>ジャンル</th>
                        <td width="70%">
                            ID:&nbsp;<?php echo $_smarty_tpl->tpl_vars['genre_id']->value;?>
&emsp;<?php echo $_smarty_tpl->tpl_vars['genre_name']->value;?>

                        </td>
                    </tr>
                    <tr>
                        <th>ターゲット</th>
                        <td width="70%">
                            ID:&nbsp;<?php echo $_smarty_tpl->tpl_vars['target_id']->value;?>
&emsp;<?php echo $_smarty_tpl->tpl_vars['target_name']->value;?>

                        </td>
                    </tr>
                    <tr>
                        <th>お気に入り数</th>
                        <td width="70%">
                            <input type="tel" value="<?php echo $_smarty_tpl->tpl_vars['favorite']->value;?>
" disabled>
                        </td>
                    </tr>
                    <tr>
                        <th>作成ユーザー</th>
                        <td width="70%">
                            ID:&nbsp;<a href="user_detail.php?mid=<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
</a>&emsp;<?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>

                        </td>
                    </tr>
                </table>
                <h2>登録書籍</h2>
                <table>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>タイトル</th>
                        <th>書籍コメント</th>
                    </tr>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['books']->value, 'value', false, 'k');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                        <tr>
                            <td width="4%" class="center"><?php echo $_smarty_tpl->tpl_vars['value']->value['index'];?>
</td>
                            <td width="10%" class="center">
                                <?php if ($_smarty_tpl->tpl_vars['value']->value['is_alive']) {?>
                                    <a href="book_detail.php?bid=<?php echo $_smarty_tpl->tpl_vars['value']->value['book_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value['book_id'];?>
</a>
                                <?php } else { ?>
                                    <?php echo $_smarty_tpl->tpl_vars['value']->value['book_id'];?>

                                <?php }?>
                            </td>
                            <td width="43%" class="center<?php if (!$_smarty_tpl->tpl_vars['value']->value['is_alive']) {?> red<?php }?>"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['book_title'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                            <td width="43%" class="center">
                                <textarea class="big_input"
                                    disabled><?php if ($_smarty_tpl->tpl_vars['value']->value['comment'] !== false) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['comment']['comment'], ENT_QUOTES, 'UTF-8', true);
}?></textarea>
                            </td>
                        </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </table>
                <input type="hidden" name="func" value="">
            </form>
        </div>
        <!-- /コンテンツ　-->
    </div>
    <!-- /全体コンテナ　-->
    
        <?php echo '<script'; ?>
 type="text/javascript">
            function delJob() {
                let result = window.confirm('このリストを削除します。よろしいでしょうか？');
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
