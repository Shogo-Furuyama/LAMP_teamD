<?php
/* Smarty version 4.1.1, created on 2023-07-29 02:17:14
  from '/home/j2023d/public_html/Smarty/templates/genre_dropdown.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64c3f81a3b1b39_83205848',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c274f9110a7d3442055a2b8a9fd15925032fce88' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/genre_dropdown.tmpl',
      1 => 1690563710,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64c3f81a3b1b39_83205848 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="btn-group">
    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="g_btn">ジャンル</button>
    <ul class="dropdown-menu" id="g_dropmenu">
        <li><a class="dropdown-item g_anker" href="javascript:void(0)" onclick="selectGenre(2)" id="gl_2">ホラー</a></li>
        <li><a class="dropdown-item g_anker" href="javascript:void(0)" onclick="selectGenre(3)" id="gl_3">エッセイ</a></li>
        <li><a class="dropdown-item g_anker" href="javascript:void(0)" onclick="selectGenre(4)" id="gl_4">ファンタジー</a></li>
        <li><a class="dropdown-item g_anker" href="javascript:void(0)" onclick="selectGenre(5)" id="gl_5">歴史</a></li>
        <li><a class="dropdown-item g_anker" href="javascript:void(0)" onclick="selectGenre(6)" id="gl_6">ミステリー</a></li>
        <li><a class="dropdown-item g_anker" href="javascript:void(0)" onclick="selectGenre(7)" id="gl_7">SF</a></li>
        <li><a class="dropdown-item g_anker" href="javascript:void(0)" onclick="selectGenre(8)" id="gl_8">図鑑</a></li>
        <li><a class="dropdown-item g_anker" href="javascript:void(0)" onclick="selectGenre(9)" id="gl_9">ビジネス</a></li>
        <li><a class="dropdown-item g_anker" href="javascript:void(0)" onclick="selectGenre(10)" id="gl_10">参考書</a></li>
        <li><a class="dropdown-item g_anker" href="javascript:void(0)" onclick="selectGenre(11)" id="gl_11">専門書</a></li>
        <li><a class="dropdown-item g_anker" href="javascript:void(0)" onclick="selectGenre(12)" id="gl_12">コミックス</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item g_anker" href="javascript:void(0)" onclick="selectGenre(1)" id="gl_1">その他</a></li>
    </ul>
</div><?php }
}
