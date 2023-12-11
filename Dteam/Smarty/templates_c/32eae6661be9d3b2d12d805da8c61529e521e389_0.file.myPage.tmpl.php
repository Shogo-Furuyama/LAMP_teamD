<?php
/* Smarty version 4.1.1, created on 2023-08-22 10:07:12
  from '/home/j2023d/public_html/Smarty/templates/myPage.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e40a401b4468_57401169',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '32eae6661be9d3b2d12d805da8c61529e521e389' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/myPage.tmpl',
      1 => 1692666149,
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
function content_64e40a401b4468_57401169 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" href="./img/bungo_tabicon.png">
  <link href="./css/bootstrap.min.css" rel="stylesheet" />
  <link href="./css/profile_config.css" rel="stylesheet" />
  <link href="./css/header.css" rel="stylesheet">
  <link href="./css/myPage_menu.css" rel="stylesheet">
  <link href="./css/footer.css" rel="stylesheet">
  <title>マイページ</title>
</head>

<body>
  <?php $_smarty_tpl->_subTemplateRender("file:./header.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <main class="d-flex">
    <div class="container row">
      <?php $_smarty_tpl->_subTemplateRender("file:./mypage_sidebar.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
      <div id="Prf" class="col-9">
        <?php if ((isset($_smarty_tpl->tpl_vars['alert']->value))) {?>
          <?php echo $_smarty_tpl->tpl_vars['alert']->value;?>

        <?php }?>
        <div class="_all row">
          <div class="col-11">
            <form action="myPage.php" name="form1" method="post" enctype="multipart/form-data">
              <h1>プロフィール</h1>
              <div class="profile">
                <div class="d-flex">
                  <div class="profile-img col-2 col-md-4">
                    <div class="profile-icon">
                      <img id="profile-image" src="<?php if ($_smarty_tpl->tpl_vars['icon_img']->value === null) {?>./img/default_icon.png<?php } else {
echo $_smarty_tpl->tpl_vars['icon_img']->value;
}?>">
                    </div>
                    <div class="change-icon">
                      <a href="javascript:void(0)" id="change-icon-link">Icon change</a>
                    </div>
                    <input type="file" name="input-iconfile" accept="image/png, image/jpeg, image/jpg, image/gif"
                      class="d-none">
                  </div>
                  <div class="cp_iptxt col-7">
                    <input class="ef" type="text" placeholder="名前を入力してください" name="profile_name"
                      value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['user_name']->value, ENT_QUOTES, 'UTF-8', true);?>
">
                    <input type="hidden" name="func" value="profile_name">
                    <label for="name">name</label>
                    <span class="focus_line"></span>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="save-button" onclick="save(1,event)">保存する</button>
                </div>
                <div id="dangerDiv1" class="text-danger"></div>
              </div>
            </form>
            <form action="myPage.php" name="form2" method="post">
              <div class="profile_comment">
                <div class="profile_nt">
                  <textarea id="myTextarea" rows="7" cols="50" placeholder="自己紹介を書いてみましょう"
                    name="profile_comment"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['comment']->value, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
                  <input type="hidden" name="func" value="profile_comment">
                  <button type="submit" class="save-button" onclick="save(2,event)">保存する</button>
                  <div id="dangerDiv2" class="text-danger"></div>
                </div>
              </div>
            </form>
            <form action="myPage.php" name="form3" method="post">
              <div class="profile_category">
                <h1>好きなジャンルを選択してください</h1>
                <div class="tag-cloud">
                  <div class="tag-row">
                    <label class="tag">
                      <input type="radio" name="category" value="2" onclick="toggleTag(this)" />
                      ホラー
                    </label>
                    <label class="tag">
                      <input type="radio" name="category" value="3" onclick="toggleTag(this)" />
                      エッセイ
                    </label>
                    <label class="tag">
                      <input type="radio" name="category" value="4" onclick="toggleTag(this)" />
                      ファンタジー
                    </label>
                  </div>
                  <div class="tag-row">
                    <label class="tag">
                      <input type="radio" name="category" value="5" onclick="toggleTag(this)" />
                      歴史
                    </label>
                    <label class="tag">
                      <input type="radio" name="category" value="6" onclick="toggleTag(this)" />
                      ミステリー
                    </label>
                    <label class="tag">
                      <input type="radio" name="category" value="7" onclick="toggleTag(this)" />
                      SF
                    </label>
                  </div>
                  <div class="tag-row">
                    <label class="tag">
                      <input type="radio" name="category" value="8" onclick="toggleTag(this)" />
                      図鑑
                    </label>
                    <label class="tag">
                      <input type="radio" name="category" value="9" onclick="toggleTag(this)" />
                      ビジネス
                    </label>
                    <label class="tag">
                      <input type="radio" name="category" value="10" onclick="toggleTag(this)" />
                      参考書
                    </label>
                  </div>
                  <div class="tag-row">
                    <label class="tag">
                      <input type="radio" name="category" value="11" onclick="toggleTag(this)" />
                      専門書
                    </label>
                    <label class="tag">
                      <input type="radio" name="category" value="12" onclick="toggleTag(this)" />
                      コミック
                    </label>
                    <label class="tag">
                      <input type="radio" name="category" value="1" onclick="toggleTag(this)" />
                      その他
                    </label>
                  </div>
                </div>
                <input type="hidden" name="func" value="profile_category">
                <button type="submit" class="save-button" onclick="save(3,event)">保存する</button>
                <input type="hidden" id="default_category" value="<?php echo $_smarty_tpl->tpl_vars['favorite_genre']->value;?>
">
                <p id="warning-message" style="display: none; color: red">カテゴリーを選択してください</p>
                <p id="selected-category" style="display: none">選択されたカテゴリー: <span id="category-name"></span></p>
                <p id="success-message" style="display: none; color: green">保存が完了しました！</p>
              </div>
            </form>
            <form action="myPage.php" name="form5" method="post">
              <div class="profile_favoriteBook">
                <h1>好きな本を登録してください</h1>
                <?php if ((isset($_smarty_tpl->tpl_vars['favorite_book']->value))) {?>
                  <a href="javascript:void(0)" onclick="modalOpen()" id="favorite_book_img"><img src="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['favorite_book_img']->value, ENT_QUOTES, 'UTF-8', true);?>
"></a>
                  <input type="hidden" name="favorite_book_id" value="<?php echo $_smarty_tpl->tpl_vars['favorite_book']->value;?>
">
                  <h4 class="mt-2" id="favorite_book_title"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['favorite_book_title']->value, ENT_QUOTES, 'UTF-8', true);?>
</h4>
                <?php } else { ?>
                  <a href="javascript:void(0)" onclick="modalOpen()" class="favorite_default_book" id="favorite_book_img"></a>
                  <input type="hidden" name="favorite_book_id" value="">
                  <h4 class="mt-2" id="favorite_book_title"></h4>
                <?php }?>
                <input type="hidden" name="func" value="favorite_book">
                <button type="button" class="def-button" onclick="favoritBookDef()">取り消す</button>
                <button type="submit" class="save-button" onclick="save(5,event)">保存する</button>
              </div>
            </form>
            <form action="myPage.php" name="form4" method="post">
              <div class="book_count">
                <h1>今まで読んだ本の数を入力してください</h1>
                <input class="count" type="number" placeholder="数値を入力してください" name="profile_count"
                  value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['book_count']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
                <input type="hidden" name="func" value="profile_count">
                <button type="submit" class="save-button" onclick="save(4,event)">保存する</button>
                <div id="dangerDiv4" class="text-danger"></div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
  <div id="easyModal" class="modal" style="display: none;">
    <div class="modal-content">
      <div class="modal-header">
        <h2 id="modal-title" class="m-0">本検索</h2>
        <span class="modalClose" onclick="modalClose()">×</span>
      </div>
      <div class="modal-body">
        <div id="search_box">
          <button type="button" class="btn btn-primary" id="return_regi" onclick="back_regi()">戻る</button>
          <div class="mx-auto input-group">
            <input type="search" class="form-control" placeholder="書籍キーワードを入力" id="search_keyword">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
              aria-expanded="false" id="s_drop_btn">タイトル</button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item active" href="javascript:void(0)" id="sd_0" onclick="sDropClick(0)">タイトル</a>
              </li>
              <li><a class="dropdown-item" href="javascript:void(0)" id="sd_1" onclick="sDropClick(1)">著者</a>
              </li>
              <li><a class="dropdown-item" href="javascript:void(0)" id="sd_2" onclick="sDropClick(2)">ISBN</a></li>
            </ul>
            <button class="btn btn-outline-success bg-success text-white" type="button" onclick="bookSearchClick()"
              id="s_btn">&emsp;検索&emsp;</button>
          </div>
        </div>
        <div id="search" class="main_scroll">
          <div id="search_result">

          </div>
          <nav id="pager">
            <ul class="pagination">
              <li class="page-item" id="page_0" style="display: none;">
                <a class="page-link" href="javascript:void(0)" onclick="searchPageListener(0)">1 ..</a>
              </li>
              <li class="page-item" id="page_1" style="display: none;"><a class="page-link" href="javascript:void(0)"
                  onclick="searchPageListener(1)">1</a></li>
              <li class="page-item" id="page_2" style="display: none;"><a class="page-link" href="javascript:void(0)"
                  onclick="searchPageListener(2)">2</a></li>
              <li class="page-item" id="page_3" style="display: none;"><a class="page-link" href="javascript:void(0)"
                  onclick="searchPageListener(3)">3</a></li>
              <li class="page-item" id="page_4" style="display: none;">
                <a class="page-link" href="javascript:void(0)" onclick="searchPageListener(4)">..
                  <span><span></a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" name="submit_id" value="<?php echo $_smarty_tpl->tpl_vars['submit_id']->value;?>
"> 
  <?php $_smarty_tpl->_subTemplateRender("file:./footer.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <?php echo '<script'; ?>
 src="./js/profile_config.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="./js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="./js/header.js"><?php echo '</script'; ?>
>
</body>

</html><?php }
}
