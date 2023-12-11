<?php
/* Smarty version 4.1.1, created on 2023-08-08 04:35:07
  from '/home/j2023d/public_html/Smarty/templates/myPage_regist.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d1476bc6a6d6_99955865',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b1e145a1b05a2223e7d8f7cd10116380af98d33' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/myPage_regist.tmpl',
      1 => 1691436903,
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
function content_64d1476bc6a6d6_99955865 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="./img/bungo_tabicon.png">
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <link href="./css/mypage_regist.css" rel="stylesheet">
  <link href="./css/header.css" rel="stylesheet">
  <link href="./css/footer.css" rel="stylesheet">
  <link href="./css/myPage_menu.css" rel="stylesheet">
  <link href="./css/book_list.css" rel="stylesheet">
  <title>投稿したリスト</title>
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
              <?php if ((isset($_smarty_tpl->tpl_vars['alert']->value))) {?>
                <?php echo $_smarty_tpl->tpl_vars['alert']->value;?>

              <?php }?>
              <h1>投稿したリスト</h1>
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
                      <div class="book_list_outline">
                        <div class="book_list">
                          <a class="list_anchor" href="list_detail.php?id=<?php echo $_smarty_tpl->tpl_vars['value']->value['list_id'];?>
">
                            <div class="book_list_title">
                              <h3 id="title_<?php echo $_smarty_tpl->tpl_vars['value']->value['index'];?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['list_title'], ENT_QUOTES, 'UTF-8', true);?>
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
                        <div class="book_list_edit">
                          <button type="button" class="btn btn-primary"
                            onclick="location.href='create_list.php?id=<?php echo $_smarty_tpl->tpl_vars['value']->value['list_id'];?>
'">編集</button>
                          <button type="button" class="btn btn-danger" onclick="delJob(<?php echo $_smarty_tpl->tpl_vars['value']->value['index'];?>
)">削除</button>
                        </div>
                        <input type="hidden" id="lid_<?php echo $_smarty_tpl->tpl_vars['value']->value['index'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['list_id'];?>
">
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
  
    <?php echo '<script'; ?>
>
      function delJob(i) {
        const title = document.getElementById('title_' + i).innerText;
        let result = window.confirm(title + '\n\nこのリストを削除します。よろしいでしょうか？');
        if (result) {
          const form = document.createElement('form');
          form.method = 'POST';
          const idNode = document.getElementById('lid_' + i);
          idNode.name = "delId";
          form.append(idNode);
          document.body.append(form);
          form.submit();
        }
      }
    <?php echo '</script'; ?>
>
  
</body>

</html><?php }
}
