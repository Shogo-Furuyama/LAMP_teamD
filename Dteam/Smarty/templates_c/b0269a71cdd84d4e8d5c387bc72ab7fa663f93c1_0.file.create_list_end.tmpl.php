<?php
/* Smarty version 4.1.1, created on 2023-08-04 10:30:45
  from '/home/j2023d/public_html/Smarty/templates/create_list_end.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64cc54c53bcac5_85041273',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0269a71cdd84d4e8d5c387bc72ab7fa663f93c1' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/create_list_end.tmpl',
      1 => 1691074293,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./headerAnker.tmpl' => 1,
  ),
),false)) {
function content_64cc54c53bcac5_85041273 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./img/bungo_tabicon.png">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
    <link href="./css/book_list.css" rel="stylesheet">
    <title>リスト作成完了しました</title>
    <style>
        .navbar {
            background-color: red;
        }

        main {
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm" id="nav_min_style">
        <a href="index.php" class="navbar-brand"><img src="./img/logo1.png" id="site_logo" /></a>
        <form id="nav_input" action="search_list.php" method="get">
            <div>
                <input type="search" placeholder="キーワードを入力" aria-label="Search" name="w" value="<?php if ((isset($_smarty_tpl->tpl_vars['keyword']->value))) {
echo $_smarty_tpl->tpl_vars['keyword']->value;
}?>" pattern=".*\S+.*" title="一文字以上入力してください。" required>
                <button type="submit">検索</button>
            </div>
        </form>
        <?php $_smarty_tpl->_subTemplateRender("file:./headerAnker.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    </nav>
    <main>
        <h1 class="my-5">リストの作成が完了しました！</h1>
        <span>
            <button class="btn btn-primary" type="button" onclick="location.href='list_detail.php?id=<?php echo $_smarty_tpl->tpl_vars['list_id']->value;?>
'">作成したリストを確認する</button>
            &emsp;
            <button class="btn btn-primary" type="button" onclick="location.href='index.php'">トップへ戻る</button>
        </span>
        <div class="book_list mt-3 mx-auto">
            <a class="list_anchor" href="list_detail.php?id=<?php echo $_smarty_tpl->tpl_vars['list_id']->value;?>
">
                <div class="book_list_title">
                    <h3><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['list_title']->value, ENT_QUOTES, 'UTF-8', true);?>
</h3>
                    <h5><img src="./img/genre_icon.png"><?php echo $_smarty_tpl->tpl_vars['genre_name']->value;?>
&emsp;<img src="./img/target_icon.png"><?php echo $_smarty_tpl->tpl_vars['target_name']->value;?>
</h5>
                </div>
                <div class="book_list_img">
                    <?php if ((isset($_smarty_tpl->tpl_vars['img_link0']->value))) {?>
                        <img src="<?php if ($_smarty_tpl->tpl_vars['img_link0']->value == '') {?>./img/book_no_image.jpg<?php } else {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['img_link0']->value, ENT_QUOTES, 'UTF-8', true);
}?>" />
                    <?php }?>
                    <?php if ((isset($_smarty_tpl->tpl_vars['img_link1']->value))) {?>
                        <img src="<?php if ($_smarty_tpl->tpl_vars['img_link1']->value == '') {?>./img/book_no_image.jpg<?php } else {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['img_link1']->value, ENT_QUOTES, 'UTF-8', true);
}?>" />
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['book_count']->value > 2) {?>
                        <span>...+<?php echo $_smarty_tpl->tpl_vars['book_count']->value-2;?>
</span>
                    <?php }?>
                </div>
                <div class="list_user">
                    <div class="list_user_info">
                        <div style="background-image: url('<?php if ($_smarty_tpl->tpl_vars['user_icon']->value === null) {?>./img/default_icon.png<?php } else {
echo $_smarty_tpl->tpl_vars['FILEUP_DIR']->value;
echo $_smarty_tpl->tpl_vars['user_icon']->value;
}?>');"></div>
                        <span><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['user_name']->value, ENT_QUOTES, 'UTF-8', true);?>
</span>
                    </div>
                    <img class="list_user_thumbs" src="./img/thumbsup.png" />
                    <span class="list_user_thumbs_num">0</span>
                </div>
            </a>
        </div>
    </main>
    <?php echo '<script'; ?>
 src="./js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
