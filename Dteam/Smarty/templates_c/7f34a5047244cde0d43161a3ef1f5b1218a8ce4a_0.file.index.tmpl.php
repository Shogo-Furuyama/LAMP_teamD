<?php
/* Smarty version 4.1.1, created on 2023-08-23 10:04:00
  from '/home/j2023d/public_html/Smarty/templates/index.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e55b00224613_20148338',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7f34a5047244cde0d43161a3ef1f5b1218a8ce4a' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/index.tmpl',
      1 => 1692752634,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./headerAnker.tmpl' => 1,
    'file:./footer.tmpl' => 1,
  ),
),false)) {
function content_64e55b00224613_20148338 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./img/bungo_tabicon.png">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
    <link href="./css/footer.css" rel="stylesheet">
    <link href="./css/book_list.css" rel="stylesheet">
    <title>ぶんごう-トップページ</title>
    
    <style>
        header {
            height: 50rem;
            display: flex;
            flex-direction: column;
        }

        #header_images {
            height: 100%;
        }

        #header_images >* {
            height: 100%; 
        }

        #header_images >*>* {
            height: 100%;
            background-size: cover;
            position: relative;
        }

        #header_images >*>*>img {
            height: 40%;
            width: auto;
            position: absolute;
            bottom: 0;
            right: 0;
        }


        .category_card {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding-block: 2rem;
        }

        .category_card >* {
            width: 15rem;
            height: 15rem;
            padding: 1rem;
            text-decoration: none;
        }

        .category_card >*>* {
            width: 100%;
            height: 100%;
            transition: all 0.3s ease;
            background-size: cover;
            background-position: center;
        }

        .category_card >*>*>*:hover {
            filter: opacity(80%);    
        }

        .category_card >*>*>* {
            width: 100%;
            height: 100%;
            background-color: #00000050; 
            display: flex;
        }

        .category_card >*>*>*>* {
            margin: auto;
            color: white;
        }
        

        #book_lists {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
    </style>
    
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm" id="nav_none_border_style">
            <a href="index.php" class="navbar-brand"><img src="./img/logo1.png" id="site_logo" /></a>
            <?php $_smarty_tpl->_subTemplateRender("file:./headerAnker.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        </nav>
        <div class="carousel slide" data-bs-ride="carousel" data-bs-pause="false"
            style="flex-grow: 1; position: relative;">
            <div class="carousel-inner" id="header_images">
                <div class="carousel-item active" data-bs-interval="10000">
                    <div style="background-image: url('./img/top_test2.png');">
                        <img src="./img/top_design.png">
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="10000">
                    <div style="background-image: url('./img/top_img5.png');"></div>
                </div>
                <div class="carousel-item" data-bs-interval="10000">
                    <div style="background-image: url('./img/top_test.png');"></div>
                </div>
               
            </div>
            <div class="w-100 position-absolute top-0 start-0" style="margin-top: 10%;">
                <div class="col-lg-5 col-md-7 col-10 m-auto">
                    <form action="search_list.php" method="GET">
                        <div class="input-group">
                            <input type="search" name="w" class="form-control form-control-lg" placeholder="キーワードを入力" aria-label="Search" pattern=".*\S+.*" title="一文字以上入力してください。" required>
                            <button class="btn btn-outline-success bg-success text-white"
                                type="submit">&emsp;検索&emsp;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <div class="category_card">
        <a href="search_list.php?g=2">
            <div style="background-image: url('./img/horror.jpg');">
                <div>
                    <h3>ホラー</h3>
                </div>
            </div>
        </a>
        <a href="search_list.php?g=3">
            <div style="background-image: url('./img/essei.jpg');">
                <div>
                    <h3>エッセイ</h3>
                </div>
            </div>
        </a>
        <a href="search_list.php?g=4">
            <div style="background-image: url('./img/fantasy.jpg');">
                <div>                    
                    <h3>ファンタジー</h3>
                </div>
            </div>
        </a>
        <a href="search_list.php?g=5">
            <div style="background-image: url('./img/history.jpg');">
                <div>
                    <h3>歴史</h3>
                </div>
            </div>
        </a>
        <a href="search_list.php?g=6">
            <div style="background-image: url('./img/mistery.jpg');">
                <div>
                    <h3>ミステリー</h3>
                </div>
            </div>
        </a>
        <a href="search_list.php?g=7">
            <div style="background-image: url('./img/sf.webp');">
                <div>
                    <h3>SF</h3>
                </div>
            </div>
        </a>
        <a href="search_list.php?g=8">
            <div style="background-image: url('./img/zukan.jpg');">
                <div>
                    <h3>図鑑</h3>
                </div>
            </div>
        </a>

        <a href="search_list.php?g=9">
            <div style="background-image: url('./img/bisiness.jpg');">
                <div>
                    <h3>ビジネス</h3>
                </div>
            </div>
        </a>
        <a href="search_list.php?g=10">
            <div style="background-image: url('./img/sankou.jpeg');">
                <div>
                    <h3>参考書</h3>
                </div>
            </div>
        </a>
        <a href="search_list.php?g=11">
            <div style="background-image: url('./img/senmon.png');">
                <div>
                    <h3>専門書</h3>
                </div>
            </div>
        </a>
        <a href="search_list.php?g=12">
            <div style="background-image: url('./img/comic.jpg');">
                <div>
                    <h3>コミックス</h3>
                </div>
            </div>
        </a>
    </div>
    <h3 class="ms-5 mt-5">&lt;みんなのブックリスト&gt;</h3>
    <div id="book_lists">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'value', false, 'k');
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
&emsp;<img src="./img/target_icon.png"><?php echo $_smarty_tpl->tpl_vars['value']->value['target_name'];?>
</h5>
                </div>
                <div class="book_list_img">
                    <?php if ($_smarty_tpl->tpl_vars['value']->value['img_link0'] != null) {?>
                        <img src="<?php if ($_smarty_tpl->tpl_vars['value']->value['img_link0'] == '') {?>./img/book_no_image.jpg<?php } else {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value['img_link0'], ENT_QUOTES, 'UTF-8', true);
}?>" />
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['value']->value['img_link1'] != null) {?>
                        <img src="<?php if ($_smarty_tpl->tpl_vars['value']->value['img_link1'] == '') {?>./img/book_no_image.jpg<?php } else {
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
                        <div style="background-image: url('<?php if ($_smarty_tpl->tpl_vars['value']->value['icon_img'] === null) {?>./img/default_icon.png<?php } else {
echo $_smarty_tpl->tpl_vars['FILEUP_DIR']->value;
echo $_smarty_tpl->tpl_vars['value']->value['icon_img'];
}?>');"></div>
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
    <?php $_smarty_tpl->_subTemplateRender("file:./footer.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php echo '<script'; ?>
 src="./js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
</body>

</html><?php }
}
