<?php
/* Smarty version 4.1.1, created on 2023-08-22 22:17:18
  from '/home/j2023d/public_html/Smarty/templates/admin/user_list.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e4b55e091e00_64008394',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '04164be2bd03b2f2269e7406d6b067456f0da5df' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/admin/user_list.tmpl',
      1 => 1692710160,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./gmenu.tmpl' => 1,
  ),
),false)) {
function content_64e4b55e091e00_64008394 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <title>ユーザー一覧</title>
    
        <?php echo '<script'; ?>
 type="text/javascript">
            <!--
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
    <!-- 全体コンテナ　-->
    <div id="container">
        <?php $_smarty_tpl->_subTemplateRender('file:./gmenu.tmpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <div id="headTitle">
            <h2>ユーザー一覧</h2>
        </div>
        <!-- コンテンツ　-->
        <div id="inquiry">
            <?php if ($_smarty_tpl->tpl_vars['ERR_STR']->value != '') {?>
                <p><?php echo $_smarty_tpl->tpl_vars['ERR_STR']->value;?>
</p>
            <?php }?>
            <form name="form1" action="<?php echo $_smarty_tpl->tpl_vars['tgt_uri']->value;?>
" method="post">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p style="display: inline;"><a href="user_detail.php">新規</a></p>
                        <select name="accountType" id="accountType">
                            <option value="all">全件</option>
                            <option value="admin">管理者</option>
                            <option value="user">ユーザー</option>
                        </select>
                    </div>
                </div>

                <p><?php echo $_smarty_tpl->tpl_vars['pager_arr']->value;?>
</p>
                <table id="table">
                    <tr>
                        <th>ユーザーID</th>
                        <th>ユーザー名</th>
                        <th>メールアドレス</th>
                        <th>アカウントタイプ</th>
                        <th>削除</th>
                    </tr>


                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rows']->value, 'value', false, 'k');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                        <tr data-account-type="<?php if ($_smarty_tpl->tpl_vars['value']->value['is_admin'] == 1) {?>admin<?php } else { ?>user<?php }?>">
                            <td width="10%" class="center">
                                <a href="user_detail.php?mid=<?php echo $_smarty_tpl->tpl_vars['value']->value['user_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value['user_id'];?>
</a>
                            </td>
                            <td width="30%" class="center">
                                <?php echo $_smarty_tpl->tpl_vars['value']->value['user_name'];?>

                            </td>
                            <td width="30%" class="center">
                                <?php echo $_smarty_tpl->tpl_vars['value']->value['mail'];?>

                            </td>

                            <td width="20%" class="center">
                                <?php if ($_smarty_tpl->tpl_vars['value']->value['is_admin'] == 1) {?>
                                    <span style="background-color: 	#9BF9CC; border-radius: 5px; text-align: center; padding: 2px;">管理者</span>
                                <?php } else { ?>
                                    <span style="background-color: #FFABCE; border-radius: 5px; text-align: center; padding: 2px;">ユーザー</span>
                                <?php }?>
                            </td>
                            <td width="10%" class="center">
                                <input type="button" value="削除確認"
                                    onClick="javascript:del_func_form(<?php echo $_smarty_tpl->tpl_vars['value']->value['user_id'];?>
,'【<?php echo $_smarty_tpl->tpl_vars['value']->value['user_name'];?>
】')" />
                            </td>
                        </tr>
                    <?php
}
if ($_smarty_tpl->tpl_vars['value']->do_else) {
?>
                        <tr>
                            <td colspan="3" class="nobottom">ユーザーが見つかりません</td>
                        </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </table>
                <input type="hidden" name="func" value="" />
                <input type="hidden" name="param" value="" />

                
            
                        <?php echo '<script'; ?>
>
                            document.addEventListener('DOMContentLoaded', function() {
                                // プルダウン要素を取得
                                var accountTypeSelect = document.getElementById('accountType');

                                // プルダウンの変更イベントを監視
                                accountTypeSelect.addEventListener('change', function() {
                                    var selectedValue = accountTypeSelect.value; // 選択された値を取得

                                    // ユーザーリストの行を取得
                                    var userRows = document.querySelectorAll('#table tr[data-account-type]');

                                    // 選択された値に応じて行を表示/非表示にする
                                    userRows.forEach(function(row) {
                                        var accountType = row.getAttribute('data-account-type');
                                        if (selectedValue === 'all' || accountType === selectedValue) {
                                            row.style.display = ''; // 表示
                                        } else {
                                            row.style.display = 'none'; // 非表示
                                        }
                                    });
                                });
                            });
                    <?php echo '</script'; ?>
>
                
            </form>
            <p>&nbsp;</p>
        </div>
        <!-- /コンテンツ　-->
    </div>
    <!-- /全体コンテナ　-->
</body>

</html><?php }
}
