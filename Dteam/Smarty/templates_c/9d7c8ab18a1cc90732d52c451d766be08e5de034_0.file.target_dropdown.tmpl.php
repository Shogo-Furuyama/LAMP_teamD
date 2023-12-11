<?php
/* Smarty version 4.1.1, created on 2023-07-29 02:17:14
  from '/home/j2023d/public_html/Smarty/templates/target_dropdown.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64c3f81a3b4085_92352295',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d7c8ab18a1cc90732d52c451d766be08e5de034' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/target_dropdown.tmpl',
      1 => 1690563696,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64c3f81a3b4085_92352295 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="btn-group">
    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="t_btn">ターゲット</button>
    <ul class="dropdown-menu" id="t_dropmenu">
        <li><a class="dropdown-item t_anker" href="javascript:void(0)" onclick="selectTarget(2)" id="tl_2">小～中学生向け</a></li>
        <li><a class="dropdown-item t_anker" href="javascript:void(0)" onclick="selectTarget(3)" id="tl_3">高～大学生向け</a></li>
        <li><a class="dropdown-item t_anker" href="javascript:void(0)" onclick="selectTarget(4)" id="tl_4">新社会人向け</a></li>
        <li><a class="dropdown-item t_anker" href="javascript:void(0)" onclick="selectTarget(5)" id="tl_5">社会人向け</a></li>
        <li><a class="dropdown-item t_anker" href="javascript:void(0)" onclick="selectTarget(6)" id="tl_6">シニア世代向け</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item t_anker" href="javascript:void(0)" onclick="selectTarget(7)" id="tl_7">初心者向け</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item t_anker" href="javascript:void(0)" onclick="selectTarget(8)" id="tl_8">感動したい人向け</a></li>
        <li><a class="dropdown-item t_anker" href="javascript:void(0)" onclick="selectTarget(9)" id="tl_9">癒されたい人向け</a></li>
        <li><a class="dropdown-item t_anker" href="javascript:void(0)" onclick="selectTarget(10)" id="tl_10">励まされたい人向け</a></li>
        <li><a class="dropdown-item t_anker" href="javascript:void(0)" onclick="selectTarget(11)" id="tl_11">発見したい人向け</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item t_anker" href="javascript:void(0)" onclick="selectTarget(1)" id="tl_1">その他</a></li>
    </ul>
</div><?php }
}
