<?php
/* Smarty version 4.1.1, created on 2023-08-02 04:00:14
  from '/home/j2023d/public_html/Smarty/templates/header.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64c9563eb88e20_71787333',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2692539aadfa7fa246ee8f3e70749262f9f271e3' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/header.tmpl',
      1 => 1690916385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./headerAnker.tmpl' => 1,
  ),
),false)) {
function content_64c9563eb88e20_71787333 (Smarty_Internal_Template $_smarty_tpl) {
?><header id="header_fixed_jud">
    <nav class="navbar navbar-expand-sm" id="nav_style">
        <a href="index.php" class="navbar-brand"><img src="./img/logo1.png" id="site_logo"/></a>
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
</header><?php }
}
