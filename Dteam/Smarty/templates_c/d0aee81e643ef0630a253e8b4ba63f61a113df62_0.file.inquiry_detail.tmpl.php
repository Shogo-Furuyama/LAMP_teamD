<?php
/* Smarty version 4.1.1, created on 2023-08-23 09:28:17
  from '/home/j2023d/public_html/Smarty/templates/admin/inquiry_detail.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e552a19c5935_70606102',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd0aee81e643ef0630a253e8b4ba63f61a113df62' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/admin/inquiry_detail.tmpl',
      1 => 1692715320,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./gmenu.tmpl' => 1,
  ),
),false)) {
function content_64e552a19c5935_70606102 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <style>
        label {
            display: inline-block;
            text-align: right;
            width: 50px;
        }

        input::placeholder {
            font-size: 10px;
        }



        label {
            display: inline-block;
            text-align: right;
            width: 50px;
        }

        input::placeholder {
            font-size: 10px;
        }

        .flex-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 2px;
            /* 上下の間隔を狭くするための値 */
        }

        .flex-item {
            flex: 1 1 auto;
            margin-top: 1px;
            /* 上部の間隔を狭くするための値 */
            margin-bottom: 1px;
            /* 下部の間隔を狭くするための値 */
        }
    </style>
    <title>【お問い合わせ画面】お問い合わせ詳細</title>
    


        <?php echo '<script'; ?>
 type="text/javascript">
            < !-
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
            // -->
        <?php echo '</script'; ?>
>
    
</head>

<body>
    <!-- 全体コンテナ　-->
    <div id="container">
        <?php $_smarty_tpl->_subTemplateRender('file:./gmenu.tmpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <div id="headTitle">
            <h2>お問い合わせ詳細</h2>
        </div>
        <!-- コンテンツ　-->
        <div id="inquiry">
            <?php if ($_smarty_tpl->tpl_vars['err_flag']->value != '') {?>
                <p><?php echo $_smarty_tpl->tpl_vars['err_flag']->value;?>
</p>
            <?php }?>
            <form name="form1" action="<?php echo $_SERVER['PHP_SELF'];?>
" method="post">
                <div id="top_bar">
                    <a href="inquiry_list.php">一覧に戻る</a><br />

                    <table>
                        <tr>
                            <th>お問い合わせID</th>
                            <td width="70%"><?php echo $_smarty_tpl->tpl_vars['inquiry_id_txt']->value;?>
</td>
                        </tr>
                        <tr>
                            <th>名前</th>
                            <td width="70%"><input type="text" name="inquiry_name"
                                    value="<?php echo htmlspecialchars((string)$_POST['inquiry_name'], ENT_QUOTES, 'UTF-8', true);?>
"></td>
                        </tr>

                        <tr>
                            <th>フリガナ</th>
                            <td width="70%"><input type="text" name="inquiry_kana"
                                    value="<?php echo htmlspecialchars((string)$_POST['inquiry_kana'], ENT_QUOTES, 'UTF-8', true);?>
"></td>
                        </tr>

                        <tr>
                            <th>メールアドレス</th>
                            <td width="70%"><input type="em     ail" name="inquiry_mail"
                                    value="<?php echo htmlspecialchars((string)$_POST['inquiry_mail'], ENT_QUOTES, 'UTF-8', true);?>
"></td>
                        </tr>

                        <tr>
                            <th>電話番号</th>
                            <td width="70%"><input type="tel" name="inquiry_tel"
                                    value="<?php echo htmlspecialchars((string)$_POST['inquiry_tel'], ENT_QUOTES, 'UTF-8', true);?>
">
                            </td>
                        </tr>

                        <tr>
                            <th class="bobottom">お問い合わせ内容</th>
                            <td width="70%" class="bobottom">
                                <textarea name="inquiry_comment" cols="70" rows="10"
                                    placeholder=""><?php echo htmlspecialchars((string)$_POST['inquiry_comment'], ENT_QUOTES, 'UTF-8', true);?>
</textarea>
                            </td>
                        </tr>



                        <?php echo '<script'; ?>
>
                            function msgdsp() {
                                alert("お問い合わせに回答します。回答はメールで送られます。");
                            }
                        <?php echo '</script'; ?>
>



                    </table>

                    <div id="headTitle">
                        <h2>回答詳細</h2>
                    </div>
                    <table>


                        <th>差出人</th>
                        <td width="70%"><input type="email" name="mail" id="mail" value="<?php echo $_smarty_tpl->tpl_vars['mail']->value;?>
" />
                        </td>
                        </tr>

                        <tr>
                            <th>宛先</th>
                            <td width="70%"> <input type="email" name="inquiry_mail" id="inquiry_mail"
                                    value="<?php echo htmlspecialchars((string)$_POST['inquiry_mail'], ENT_QUOTES, 'UTF-8', true);?>
" /></td>

                        </tr>


                        <tr>
                            <th>件名</th>
                            <td width="70%"> <input type="text" name="reply_title" id="reply_title" size="60"
                                    placeholder="回答件名をご記入ください。" value="<?php echo htmlspecialchars((string)$_POST['reply_title'], ENT_QUOTES, 'UTF-8', true);?>
" /></td>

                        </tr>
                        <tr>
                            <th>回答内容</th>
                            <td width="70%"> <textarea name="reply" id="reply" cols="70" rows="20"
                                    placeholder="回答内容をご記入ください。"><?php echo htmlspecialchars((string)$_POST['reply'], ENT_QUOTES, 'UTF-8', true);?>
</textarea>


                            </td>
                        </tr>


                    </table>
                    <input type="hidden" name="func" value="conf" />
                    <input type="hidden" name="param" value="" />
                    <input type="hidden" name="inquiry_id" value="<?php echo $_smarty_tpl->tpl_vars['inquiry_id']->value;?>
" />
                    <?php if ($_smarty_tpl->tpl_vars['is_reply']->value == 0) {?>
                        <p class="center"><input type="submit" name="submit" value="確認" onclick="msgdsp()"
                                onClick="javascript:set_func_form('conf','')" /></p>
                        
                    <?php }?>
            </form>
        </div>
        <!-- /コンテンツ　-->
    </div>

    <!-- /全体コンテナ　-->
</body>

</html><?php }
}
