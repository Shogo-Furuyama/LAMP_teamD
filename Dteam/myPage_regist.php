<?php
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
require_once($CMS_COMMON_INCLUDE_DIR . 'auth_member.php');

if(!isset($_SESSION['tmD2023_mem']['user_id'])){
    cutil::redirect_exit('user_login.php?path=' . rawurlencode($_SERVER['REQUEST_URI']));
}

$list_db = new clist();
$register = (new cuser())-> get_tgt(false,$_SESSION['tmD2023_mem']['user_id'])['register_list'];

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

if(isset($_POST['delId']) && cutil::is_number($_POST['delId']) && ($list_id = $_POST['delId']) > 0 && ($list = $list_db->get_tgt(false, $list_id)) !== false && $list['user_id'] == $_SESSION['tmD2023_mem']['user_id']) {
    $chenge = new cchange_ex();
    foreach(explode(",",$list['book_ids']) as $key => $value )  {
        $value = explode("c",$value);
        if(cutil::is_number($value[1])) {
            $chenge->delete(false,"book_comment_table","comment_id=" . $value[1]);
        }    
    }        
    $chenge->delete(false,"list_table","list_id=" . $list_id);
    $smarty->assign('alert','<div class="alert alert-primary" role="alert">リストの削除が完了しました。</div>');
    if($register !== null) {
        $regiList = explode(',',$register);
        $regiSearchResult = array_search($list_id, $regiList);
        if ($regiSearchResult !== false) {
            unset($regiList[$regiSearchResult]);
            $register = count($regiList) != 0 ? implode(',', $regiList) : null;
            $userUpdata['register_list'] = $register;
            $chenge->update(false,'user_table',$userUpdata,'user_id=' . $_SESSION['tmD2023_mem']['user_id']);
        }
    }
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

if($register !== null) {
    $count = $list_db->get_tgts_count(false,$register);
    if($count != 0) {
        $lists = $list_db->get_tgts(false,$register,($page-1)*$limit,$limit);
        if(count($lists) == 0) {
            $page = 1;
            $lists = $list_db->get_tgts(false,$register,0,$limit);
        }
        $index = 0;
        foreach($lists as $key => &$value) {
            $value['index'] = $index++; 
        }
        $smarty->assign('lists',$lists);
    }
}

$smarty->assign('count',$count);
$smarty->assign('FILEUP_DIR', $CMS_FILEUP_DIR);
assign_page_block();
//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('myPage_regist.tmpl');
?>