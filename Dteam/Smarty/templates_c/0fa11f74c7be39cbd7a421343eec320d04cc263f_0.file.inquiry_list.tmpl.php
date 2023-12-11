<?php
/* Smarty version 4.1.1, created on 2023-08-22 11:44:51
  from '/home/j2023d/public_html/Smarty/templates/admin/inquiry_list.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e42123246171_09944762',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0fa11f74c7be39cbd7a421343eec320d04cc263f' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/admin/inquiry_list.tmpl',
      1 => 1692672114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./gmenu.tmpl' => 1,
  ),
),false)) {
function content_64e42123246171_09944762 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <title>お問い合わせ一覧</title>
    
        <?php echo '<script'; ?>
 type="text/javascript">
           
        function set_func_form(fn, pm) {
            document.form1.target = "_self";
            document.form1.func.value = fn;
            document.form1.param.value = pm;
            document.form1.submit();
        }

        function del_func_form(pm, mess) {
            var message = "本当に\r\n";
            message += mess;
            message += "\r\nを削除しますか？";
            if (confirm(message)) {
                document.form1.target = "_self";
                document.form1.func.value = 'del';
                document.form1.param.value = pm;
                document.form1.submit();
            }
        }
        // 
        -->
        <?php echo '</script'; ?>
>
    
</head>

<body>
    <!-- 全体コンテナ -->
    <div id="container">
        <?php $_smarty_tpl->_subTemplateRender('file:./gmenu.tmpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <div id="headTitle">
            <h2>お問い合わせ一覧</h2>
        </div>
        <!-- コンテンツ -->
        <div id="inquiry">
            <?php if ($_smarty_tpl->tpl_vars['ERR_STR']->value != '') {?>
                <p><?php echo $_smarty_tpl->tpl_vars['ERR_STR']->value;?>
</p>
            <?php }?>
            <form name="form1" action="<?php echo $_smarty_tpl->tpl_vars['tgt_uri']->value;?>
" method="post">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <div>

                        <select name="condition" onchange="filterInquiries(this)">
                            <option value="all">全件</option>
                            <option value="resolved">対応済み</option>
                            <option value="unresolved">未対応</option>
                        </select>
                    </div>
                    <div>
                        <p><?php echo $_smarty_tpl->tpl_vars['pager_arr']->value;?>
</p>
                    </div>
                </div>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>名前</th>
                        <th>件名</th>
                        <th>受付日時</th>
                        <th>対応状況</th>
                    </tr>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rows']->value, 'value', false, 'k');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                        <tr>
                            <td width="10%" class="center">
                                <a href="inquiry_detail.php?mid=<?php echo $_smarty_tpl->tpl_vars['value']->value['inquiry_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value['inquiry_id'];?>
</a>
                            </td>
                            <td width="15%" class="center">
                                <?php echo $_smarty_tpl->tpl_vars['value']->value['inquiry_name'];?>

                            </td>
                            <td width="40%" class="center">
                                <?php echo $_smarty_tpl->tpl_vars['value']->value['inquiry_title'];?>

                            </td>
                            <td width="25%" class="center">
                                <?php echo $_smarty_tpl->tpl_vars['value']->value['inquiry_date'];?>

                            </td>
                            <td width="10%" class="center">
                                <?php if ($_smarty_tpl->tpl_vars['value']->value['is_reply'] == 1) {?>
                                    <span
                                        style="background-color: 	#9BF9CC; border-radius: 5px; text-align: center; padding: 2px;">対応済み</span>
                                <?php } else { ?>
                                    <span
                                        style="background-color: #FFABCE; border-radius: 5px; text-align: center; padding: 2px;">未対応</span>
                                <?php }?>
                            </td>
                        </tr>
                    <?php
}
if ($_smarty_tpl->tpl_vars['value']->do_else) {
?>
                        <tr>
                            <td colspan="3" class="nobottom">メンバーが見つかりません</td>
                        </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </table>
                <input type="hidden" name="func" value="" />
                <input type="hidden" name="param" value="" />
            </form>
            <p>&nbsp;</p>
        </div>
        <!-- /コンテンツ -->
    </div>
    <!-- /全体コンテナ -->
    <?php echo '<script'; ?>
>
        //ドロップダウン絞り込み
        function filterInquiries(selectElement) {
            var condition = selectElement.value;
            var rows = document.querySelectorAll('#inquiry table tr');
            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var replyCell = row.querySelector('td:nth-child(5)');
                if (condition === 'all') {
                    row.style.display = 'table-row';
                } else if (condition === 'resolved') {
                    if (replyCell.innerHTML.includes('対応済み')) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                } else if (condition === 'unresolved') {
                    if (replyCell.innerHTML.includes('未対応')) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                }
            }
        }
    <?php echo '</script'; ?>
>
</body>

</html><?php }
}
