<?php
/* Smarty version 4.1.1, created on 2023-08-08 04:57:24
  from '/home/j2023d/public_html/Smarty/templates/search_list.tmpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d14ca4487683_16056117',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '686eac4cba055c7a9c3ef4c3c3137816101b947f' => 
    array (
      0 => '/home/j2023d/public_html/Smarty/templates/search_list.tmpl',
      1 => 1691438240,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tmpl' => 1,
    'file:./genre_dropdown.tmpl' => 1,
    'file:./target_dropdown.tmpl' => 1,
    'file:./footer.tmpl' => 1,
  ),
),false)) {
function content_64d14ca4487683_16056117 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./img/bungo_tabicon.png">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
    <link href="./css/footer.css" rel="stylesheet">
    <link href="./css/book_list.css" rel="stylesheet">
    <title>リスト検索</title>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        footer {
            margin-top: auto;
        }

        #book_lists {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        #dropdown_style>div {
            margin-inline: 0.5vw;
        }

        #dropdown_style>div>button {
            border: solid 1px darkgray;
            border-radius: 1rem;
        }

        #dropdown_style>div>button.show {
            box-shadow: none;
            background-color: gainsboro;            
        }

        #dropdown_style>div>button:hover {
            background-color: gainsboro;
        }

        #pager {
            max-width: 75%;
            margin-inline: auto;
        }
    </style>
</head>

<body>
    <?php $_smarty_tpl->_subTemplateRender("file:./header.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <div class="ps-3 ps-md-5 pt-3 pb-3">
        <div class="mb-4" id="dropdown_style">
            <?php $_smarty_tpl->_subTemplateRender("file:./genre_dropdown.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            <?php $_smarty_tpl->_subTemplateRender("file:./target_dropdown.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        </div>
        <h4><?php echo $_smarty_tpl->tpl_vars['condOthers']->value;?>
</h4>
        <?php if ((isset($_smarty_tpl->tpl_vars['keyword']->value))) {?>
        <h3><?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
に関する検索結果</h3>
        <?php }?>
        <h5>&emsp;&emsp;約<?php echo $_smarty_tpl->tpl_vars['key_count']->value;?>
件のリスト</h5>
    </div>
    <div id="book_lists">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['result']->value, 'value', false, 'k');
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
if ($_smarty_tpl->tpl_vars['value']->do_else) {
?>
            <h1>該当する結果が見つかりませんでした。</h1>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
    <div class="d-flex mt-5">
        <nav id="pager" aria-label="Page navigation example">
            <ul class="pagination flex-wrap">
            <?php echo $_smarty_tpl->tpl_vars['pager_arr']->value;?>

            </ul>
        </nav>
    </div>
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
        function selectGenre(i) {
            pageUpdate('g',i);
        }

        function selectTarget(i) {
            pageUpdate('t',i);
        }

        function pageUpdate(key,value) {
            const params = new URL(location.href).searchParams;
            params.set(key,value);
            location.href = 'search_list.php?' + params.toString();
        }
        
        function parDel(key) {
            return function() {
                const params = new URL(location.href).searchParams;
                params.delete(key);
                location.href = 'search_list.php?' + params.toString();
            }
        }

        document.addEventListener('DOMContentLoaded',function(){
            const params = new URL(location.href).searchParams; 
            let gId = params.get('g');
            let tId = params.get('t');
            if(gId != null) {
                gId = 'gl_' + gId; 
                const nodeList = document.querySelectorAll('.g_anker');
                for(let i = 0,length = nodeList.length;i < length; ++i) {
                    if(nodeList[i].id == gId) {
                        nodeList[i].classList.add('active');
                        document.getElementById("g_btn").innerText = nodeList[i].innerText;
                        document.getElementById('g_dropmenu').prepend(createCancelAnker('g'),createDropdownHr());
                        break;
                    }
                }
            }
            if(tId != null) {
                tId = 'tl_' + tId; 
                const nodeList = document.querySelectorAll('.t_anker');
                for(let i = 0,length = nodeList.length;i < length; ++i) {
                    if(nodeList[i].id == tId) {
                        nodeList[i].classList.add('active');
                        document.getElementById("t_btn").innerText = nodeList[i].innerText;
                        document.getElementById('t_dropmenu').prepend(createCancelAnker('t'),createDropdownHr());
                        break;
                    }
                }
            }
        });

        function createCancelAnker(value) {
            const li = document.createElement('li');
            const anker = document.createElement('a');
            anker.classList.add('dropdown-item');
            anker.href = 'javascript:void(0)';
            anker.addEventListener('click',parDel(value));
            anker.innerText = '取り消す';
            li.append(anker);
            return li;            
        }

        function createDropdownHr() {
            const li = document.createElement('li');
            const hr = document.createElement('hr');
            hr.classList.add('dropdown-divider');
            li.append(hr);
            return li;
        }
    <?php echo '</script'; ?>
>
    
</body>

</html><?php }
}
