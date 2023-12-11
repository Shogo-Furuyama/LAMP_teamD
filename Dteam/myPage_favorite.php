<?php
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
require_once($CMS_COMMON_INCLUDE_DIR . 'auth_member.php');

if(!isset($_SESSION['tmD2023_mem']['user_id'])){
    cutil::redirect_exit('user_login.php?path=' . rawurlencode($_SERVER['REQUEST_URI']));
}

$list_db = new clist();
$favorite = (new cuser())-> get_tgt(false,$_SESSION['tmD2023_mem']['user_id'])['favorite_list'];

$count = 0;
$page = 1;
$limit = 20;

function assign_page_block()
{
	//$smartyをグローバル宣言（必須）
	global $smarty;
	global $limit;
	global $page;
	global $count;
	$ctl = new cpager($_SERVER['PHP_SELF'], $count, $limit);
	$smarty->assign('pager_arr', $ctl->get_website('page', $page));
}

if (
	isset($_GET['page'])
	//なおかつ、数字だったら
	&& cutil::is_number($_GET['page'])
	//なおかつ、0より大きかったら
	&& $_GET['page'] > 0
) {
	//パラメータを設定
	$page = $_GET['page'];
}

if($favorite !== null) {
    $count = $list_db->get_tgts_count(false,$favorite);
    if($count != 0) {
        $lists = $list_db->get_tgts(false,$favorite,($page-1)*$limit,$limit);
        if(count($lists) == 0) {
            $page = 1;
            $lists = $list_db->get_tgts(false,$favorite,0,$limit);
        }        
        $smarty->assign('lists',$lists);
    }
}

$smarty->assign('count',$count);
$smarty->assign('FILEUP_DIR', $CMS_FILEUP_DIR);
assign_page_block();
//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('myPage_favorite.tmpl');
?>