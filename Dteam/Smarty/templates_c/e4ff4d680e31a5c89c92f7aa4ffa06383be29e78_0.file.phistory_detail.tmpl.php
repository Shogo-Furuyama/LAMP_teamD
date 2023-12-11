<?php
/* Smarty version 4.1.1, created on 2023-08-11 12:32:03
  from '/home/j2023d/public_html/Smarty/templates/admin/phistory_detail.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d5abb32ff282_96597522',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e4ff4d680e31a5c89c92f7aa4ffa06383be29e78' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/admin/phistory_detail.tmpl',
      1 => 1691724716,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./gmenu.tmpl' => 1,
  ),
),false)) {
function content_64d5abb32ff282_96597522 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <title>売上照会詳細</title>
    
        <style>
            .big_input {
                width: 80%;
            }

            #container {
                padding-bottom: 5px;
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
            <h2>売上照会詳細</h2>
        </div>
        <!-- コンテンツ　-->
        <div id="inquiry">
            <a href="phistory_list.php">一覧に戻る</a>
            <table>
                <tr>
                    <th>ID</th>
                    <td width="70%"><?php echo $_smarty_tpl->tpl_vars['his_id']->value;?>
</td>
                </tr>
                <tr>
                    <th>決済方法</th>
                    <td width="70%"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['payment_name']->value, ENT_QUOTES, 'UTF-8', true);?>
</td>
                </tr>
                <tr>
                    <th>合計金額</th>
                    <td width="70%"><?php echo $_smarty_tpl->tpl_vars['total_amount']->value;?>
</td>
                </tr>
                <tr>
                    <th>届け先住所</th>
                    <td width="70%">
                        <textarea class="big_input" disabled><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
                    </td>
                </tr>
                <tr>
                    <th>購入日</th>
                    <td width="70%">
                        <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['purchase_date']->value, ENT_QUOTES, 'UTF-8', true);?>

                    </td>
                </tr>
                <tr>
                    <th>作成ユーザー</th>
                    <td width="70%">
                        <?php if ($_smarty_tpl->tpl_vars['user_alive']->value) {?>
                        ID:&nbsp;<a href="user_detail.php?mid=<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
</a>&emsp;<?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
    
                        <?php } else { ?>
                        ID:&nbsp;<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
&emsp;<span class="red"><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</span>
                        <?php }?>
                    </td>
                </tr>
            </table>
            <h2>購入書籍</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>表紙</th>
                    <th>タイトル</th>
                    <th>購入冊数</th>
                </tr>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['books']->value, 'value', false, 'k');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                    <tr>
                        <td width="10%" class="center">
                            <?php if ($_smarty_tpl->tpl_vars['value']->value['is_alive']) {?>
                                <a href="book_detail.php?bid=<?php echo $_smarty_tpl->tpl_vars['value']->value['book_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value['book_id'];?>
</a>
                            <?php } else { ?>
                                <?php echo $_smarty_tpl->tpl_vars['value']->value['book_id'];?>

                            <?php }?>
                        </td>
                        <td width="10%" class="center"><img class="book_img" src="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['image_link'], ENT_QUOTES, 'UTF-8', true);?>
"></td>
                        <td width="75%" class="center<?php if (!$_smarty_tpl->tpl_vars['value']->value['is_alive']) {?> red<?php }?>"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['book_title'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                        <td width="5%" class="center"><input type="number" min="1" max="100" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['b_count'];?>
" disabled></td>
                    </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </table>
        </div>
        <!-- /コンテンツ　-->
    </div>
    <!-- /全体コンテナ　-->
</body>

</html><?php }
}
