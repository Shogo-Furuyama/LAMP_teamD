<?php
/* Smarty version 4.1.1, created on 2023-08-12 21:36:19
  from '/home/j2023d/public_html/Smarty/templates/headerAnker.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d77cc3a8a4d4_23842370',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '032b3628e655dc8c4430b24cb2b96f36f8815807' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/headerAnker.tmpl',
      1 => 1691843771,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64d77cc3a8a4d4_23842370 (Smarty_Internal_Template $_smarty_tpl) {
?><button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu" aria-controls="navmenu" aria-expanded="false">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse justify-content-end" id="navmenu">
    <ul class="navbar-nav" id="nav_a_style">
        <?php if ((isset($_SESSION['tmD2023_mem']['user_id']))) {?>
            <li class="nav-item">
                <a class="nav-item nav-link" href="myPage.php">マイページ</a>
            </li>
            <li class="nav-item">
                <a class="nav-item nav-link" href="create_list.php">リスト作成</a>
            </li>
            <li class="nav-item">
                <a class="nav-item nav-link" href="cart.php">カート</a>
            </li>
        <?php } else { ?>
            <li class="nav-item">
                <a class="nav-item nav-link" href="overview.php">サービス概要</a>
            </li>
            <li class="nav-item">
                <a class="nav-item nav-link" href="register.php">新規登録</a>
            </li>
            <li class="nav-item">
                <a class="nav-item nav-link" href="user_login.php?path=<?php echo urlencode(htmlspecialchars((string)$_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8', true));?>
">ログイン</a>
            </li>
        <?php }?>
    </ul>
</div><?php }
}
