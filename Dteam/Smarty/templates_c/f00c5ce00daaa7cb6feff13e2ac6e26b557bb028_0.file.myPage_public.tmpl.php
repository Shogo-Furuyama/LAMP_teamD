<?php
/* Smarty version 4.1.1, created on 2023-08-22 10:03:41
  from '/home/j2023d/public_html/Smarty/templates/myPage_public.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e4096d5a5c92_04563606',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f00c5ce00daaa7cb6feff13e2ac6e26b557bb028' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/myPage_public.tmpl',
      1 => 1692666203,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tmpl' => 1,
    'file:./footer.tmpl' => 1,
  ),
),false)) {
function content_64e4096d5a5c92_04563606 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./img/bungo_tabicon.png">
    <link href = "./css/bootstrap.min.css" rel = "stylesheet" />
    <link href = "./css/header.css" rel = "stylesheet">
    <link href = "./css/footer.css" rel = "stylesheet">
    <link href = "./css/myPage_public.css" rel = "stylesheet">
    <link href="./css/book_list.css" rel="stylesheet">
    <title>マイページ</title>
</head>

<body>
    <?php $_smarty_tpl->_subTemplateRender("file:./header.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <main>
        <div>
            <div class = "Mypage col-5">
                <div class="profile-icon"> 
                    <img id="profile-image" src="<?php if ($_smarty_tpl->tpl_vars['icon_img']->value === null) {?>./img/default_icon.png<?php } else {
echo $_smarty_tpl->tpl_vars['icon_img']->value;
}?>">
                </div>
                
                <h3><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['user_name']->value, ENT_QUOTES, 'UTF-8', true);?>
</h3>
                <!----
                <P class = "a">このしたに投稿したリストがあれば表示</P>

                <P class = "a">なければなんか「投稿はありません」みたいなことを表示する</P>
                --->
            </div>

            <!---この下に投稿したリストを表示するコードを書く---->

            <div id="wrapper">


              <div class="container">
                <ul class="custom-tabs" style="margin-top: 30px">
                  <li class="active"><a href="#tab1">プロフィール</a></li>
                  <li><a href="#tab2">投稿</a></li>
                </ul>

                <div class="tab-content">
                  <div id="tab1" class="content-pane is-active col-6">
                    <div class = "myPage_comment">
                      <p><?php echo nl2br((string) htmlspecialchars((string)$_smarty_tpl->tpl_vars['comment']->value, ENT_QUOTES, 'UTF-8', true), (bool) 1);?>
</p>
                    </div>

                    <div class = "myPage_genre">
                        <h5>好きなジャンル</h5>
                        <?php if ($_smarty_tpl->tpl_vars['genre_result']->value !== false) {?>
                        <h7><?php echo $_smarty_tpl->tpl_vars['genre_result']->value['genre_name'];?>
</h7>
                        <?php } else { ?>
                        <h7>設定されていません</h7>
                        <?php }?>
                    </div>

                    <div class = "myPage_book">
                        <h5>好きな本</h5>
                        <div>
                          <?php if ((isset($_smarty_tpl->tpl_vars['favorite_book']->value))) {?>
                          <p><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['favorite_book_title']->value, ENT_QUOTES, 'UTF-8', true);?>
</p>
                          <img src = "<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['favorite_book_img']->value, ENT_QUOTES, 'UTF-8', true);?>
">
                          <?php } else { ?>
                          <p>設定されていません</p>  
                          <?php }?>
                        </div>
                    </div>
                  </div>
                  <div id="tab2" class="content-pane">
                    <?php if ($_smarty_tpl->tpl_vars['count']->value == 0) {?>
                    <div class = "myPage_count">
                      <h5>投稿数 0 件</h5>
                    </div>
                    <?php } else { ?>
                    <div class = "myPage_count">
                      <h5>投稿数 <?php echo $_smarty_tpl->tpl_vars['count']->value;?>
 件</h5>
                    </div>
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
                    </div>
                    <?php }?>
                  </div>
                </div>
              </div>
            </div>
  
        </div>
    </main>
    <?php $_smarty_tpl->_subTemplateRender("file:./footer.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php echo '<script'; ?>
 src="./js/myPage_public.js"><?php echo '</script'; ?>
>

    
</body>


</html><?php }
}
