<?php
/* Smarty version 4.1.1, created on 2023-08-08 04:34:04
  from '/home/j2023d/public_html/Smarty/templates/myPage_favorite.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d1472c313c46_01877395',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5c69d5de7b305693fbb8fa65647b6b2868ed3447' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/myPage_favorite.tmpl',
      1 => 1691436833,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tmpl' => 1,
    'file:./mypage_sidebar.tmpl' => 1,
    'file:./footer.tmpl' => 1,
  ),
),false)) {
function content_64d1472c313c46_01877395 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="./img/bungo_tabicon.png">
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <link href="./css/mypage_favorite.css" rel="stylesheet">
  <link href="./css/header.css" rel="stylesheet">
  <link href="./css/footer.css" rel="stylesheet">
  <link href="./css/myPage_menu.css" rel="stylesheet">
  <link href="./css/book_list.css" rel="stylesheet">
  <title>いいねしたリスト</title>
</head>

<body>
  <?php $_smarty_tpl->_subTemplateRender("file:./header.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <main class="d-flex">
    <div class="container row">
      <?php $_smarty_tpl->_subTemplateRender("file:./mypage_sidebar.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
      <div id="Prf" class="col-9">
        <div class="personal_all">
          <section>
            <div class="container py-5">
              <h1>いいねしたリスト</h1>
              <?php if ($_smarty_tpl->tpl_vars['count']->value == 0) {?>
                <h5>見つかりませんでした</h5>
              <?php } else { ?>
                <h5><?php echo $_smarty_tpl->tpl_vars['count']->value;?>
件リストが見つかりました</h5>
                <div>
                  <div id="book_lists">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lists']->value, 'value', false, 'k');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                      <div class="book_list">
                        <a class="list_anchor" href="list_detail.php?id=<?php echo $_smarty_tpl->tpl_vars['value']->value['list_id'];?>
">
                          <div class="book_list_title">
                            <h3><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['list_title'], ENT_QUOTES, 'UTF-8', true);?>
</h3>
                            <h5><img src="./img/genre_icon.png"><?php echo $_smarty_tpl->tpl_vars['value']->value['genre_name'];?>
&emsp;<img
                                src="./img/target_icon.png"><?php echo $_smarty_tpl->tpl_vars['value']->value['target_name'];?>
</h5>
                          </div>
                          <div class="book_list_img">
                            <?php if ($_smarty_tpl->tpl_vars['value']->value['img_link0'] != null) {?>
                              <img
                                src="<?php if ($_smarty_tpl->tpl_vars['value']->value['img_link0'] == '') {?>./img/book_no_image.jpg<?php } else {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['img_link0'], ENT_QUOTES, 'UTF-8', true);
}?>" />
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['value']->value['img_link1'] != null) {?>
                              <img
                                src="<?php if ($_smarty_tpl->tpl_vars['value']->value['img_link1'] == '') {?>./img/book_no_image.jpg<?php } else {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['img_link1'], ENT_QUOTES, 'UTF-8', true);
}?>" />
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['value']->value['book_count'] > 2) {?>
                              <span>...+<?php echo $_smarty_tpl->tpl_vars['value']->value['book_count']-2;?>
</span>
                            <?php }?>
                          </div>
                          <div class="list_user">
                            <div class="list_user_info">
                              <div
                                style="background-image: url('<?php if ($_smarty_tpl->tpl_vars['value']->value['icon_img'] === null) {?>./img/default_icon.png<?php } else {
echo $_smarty_tpl->tpl_vars['FILEUP_DIR']->value;
echo $_smarty_tpl->tpl_vars['value']->value['icon_img'];
}?>');">
                              </div>
                              <span><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['user_name'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                            </div>
                            <img class="list_user_thumbs" src="./img/thumbsup.png" />
                            <span class="list_user_thumbs_num">
                              <?php echo $_smarty_tpl->tpl_vars['value']->value['favorite'];?>

                            </span>
                          </div>
                        </a>
                      </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <div class="d-flex">
                      <nav id="pager" aria-label="Page navigation example">
                        <ul class="pagination flex-wrap">
                          <?php echo $_smarty_tpl->tpl_vars['pager_arr']->value;?>

                        </ul>
                      </nav>
                    </div>
                  </div>
                </div>
              <?php }?>
            </div>
          </section>
        </div>
      </div>
  </main>
  <?php $_smarty_tpl->_subTemplateRender("file:./footer.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <?php echo '<script'; ?>
 src="./js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="./js/header.js"><?php echo '</script'; ?>
>
  

  
</body>

</html><?php }
}
