<?php
/* Smarty version 4.1.1, created on 2023-07-31 02:16:37
  from '/home/j2023d/public_html/Smarty/templates/admin/book_list.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64c69af5010f13_82195077',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '86f5e3825934d230d9199383d746b2bff050fd92' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/admin/book_list.tmpl',
      1 => 1690737394,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./gmenu.tmpl' => 1,
  ),
),false)) {
function content_64c69af5010f13_82195077 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <title>本一覧</title>
    
        <style>
            #top_bar {
                display: flex;
                align-items: center;
            }

            #top_bar>div {
                margin-left: auto;
            }

            #top_bar>form {
                margin-left: 10px;
                display: flex;
            }

            #top_bar>form>input {
                border: solid black 0.5px;
                height: 25px;
            }

            #top_bar>form>select {
                height: 25px;
                border: none;
                border-block: solid black 0.5px;
                border-right: solid black 0.5px;
            }

            #top_bar>form>button {
                height: 25px;
                border: none;
                border-block: solid black 0.5px;
                border-right: solid black 0.5px;
                background-color: forestgreen;
                color: white;
            }

            .book_img {
                height: auto;
                width: 100%;
            }
        </style>
    
</head>

<body>
    <!-- 全体コンテナ　-->
    <div id="container">
        <?php $_smarty_tpl->_subTemplateRender('file:./gmenu.tmpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <div id="headTitle">
            <h2>本一覧</h2>
        </div>
        <!-- コンテンツ　-->
        <div id="inquiry">
            <?php if ($_smarty_tpl->tpl_vars['ERR_STR']->value != '') {?>
                <p><?php echo $_smarty_tpl->tpl_vars['ERR_STR']->value;?>
</p>
            <?php }?>
            <div id="top_bar">
                <p><a href="book_detail.php">新規</a></p>
                <div><?php if ((isset($_smarty_tpl->tpl_vars['search_result']->value))) {
echo $_smarty_tpl->tpl_vars['search_result']->value;
}?></div>
                <form method="get">
                    <input type="search" name="w" pattern=".*\S+.*" placeholder="キーワードを入力" title="一文字以上入力してください。"
                        value="<?php if ((isset($_smarty_tpl->tpl_vars['w']->value))) {
echo $_smarty_tpl->tpl_vars['w']->value;
}?>" required>
                    <select name="stype">
                        <option value="t" <?php if ($_smarty_tpl->tpl_vars['stype']->value == 't') {?>selected<?php }?>>タイトル</option>
                        <option value="a" <?php if ($_smarty_tpl->tpl_vars['stype']->value == 'a') {?>selected<?php }?>>著者</option>
                        <option value="i" <?php if ($_smarty_tpl->tpl_vars['stype']->value == 'i') {?>selected<?php }?>>ISBN</option>
                    </select>
                    <button type="submit">検索</button>
                </form>
            </div>
            <p><?php echo $_smarty_tpl->tpl_vars['pager_arr']->value;?>
</p>
            <table>
                <tr>
                    <th>本ID</th>
                    <th>ISBN</th>
                    <th>タイトル</th>
                    <th>著者</th>
                    <th>発売日</th>
                    <th>表紙</th>
                </tr>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rows']->value, 'value', false, 'k');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                    <tr>
                        <td width="10%" class="center">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['tgt_uri']->value;
echo $_smarty_tpl->tpl_vars['value']->value['book_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value['book_id'];?>
</a>
                        </td>
                        <td width="11%" class="center">
                            <?php echo $_smarty_tpl->tpl_vars['value']->value['isbn'];?>

                        </td>
                        <td width="43%" class="center">
                            <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['book_title'], ENT_QUOTES, 'UTF-8', true);?>

                        </td>
                        <td width="17%" class="center">
                            <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['authors'], ENT_QUOTES, 'UTF-8', true);?>

                        </td>
                        <td width="12%" class="center">
                            <?php echo $_smarty_tpl->tpl_vars['value']->value['release_date'];?>

                        </td>
                        <td width="7%" class="center">
                            <img src="<?php if ($_smarty_tpl->tpl_vars['value']->value['image_link'] == null) {?>../img/book_no_image.jpg<?php } else {
if ($_smarty_tpl->tpl_vars['value']->value['is_up_img'] == 1) {
echo $_smarty_tpl->tpl_vars['FILEUP_DIR']->value;
}
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['image_link'], ENT_QUOTES, 'UTF-8', true);
}?>" class="book_img">
                        </td>
                    </tr>
                <?php
}
if ($_smarty_tpl->tpl_vars['value']->do_else) {
?>
                    <tr>
                    <tr>
                        <td colspan="3" class="nobottom">本が見つかりません</td>
                    </tr>
                    </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </table>
            <p>&nbsp;</p>

        </div>
        <!-- /コンテンツ　-->
    </div>
    <!-- /全体コンテナ　-->
</body>

</html><?php }
}
