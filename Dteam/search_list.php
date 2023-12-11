<?php
/*!
@file member_list_smarty.php
@brief メンバー一覧(Smarty版)
@copyright Copyright (c) 2021 Yamanoi Yasushi.
*/

/////////////////////////////////////////////////////////////////
/// 実行ブロック
/////////////////////////////////////////////////////////////////

//ライブラリをインクルード
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
require_once($CMS_COMMON_INCLUDE_DIR . 'auth_member.php');

$ERR_STR = '';
$db_obj = new clist();

//ページの設定
//デフォルトは1
$page = 1;
//1ページのリミット
$limit = 20;

$count = 0;

$genre = false;
$target = false;
$keyword = false;
$result = array();

/////////////////////////////////////////////////////////////////
/// 関数ブロック
/////////////////////////////////////////////////////////////////


function assign_page_block()
{
	//$smartyをグローバル宣言（必須）
	global $smarty;
	global $limit;
	global $page;
	global $db_obj;
	global $count;
    global $keyword;
    global $genre;
    global $target;
	$urlParam = '';
	if($keyword !== false) {
		$urlParam = '?w=' . rawurlencode($keyword);	
	}
	if($genre !== false) {
		$urlParam .= ($urlParam == '' ? '?' : '&') . 'g=' . $genre['genre_id'];
	}
	if($target !== false) {
		$urlParam .= ($urlParam == '' ? '?' : '&') . 't=' . $target['target_id'];
	}
	$ctl = new cpager($_SERVER['PHP_SELF'] . $urlParam , $count, $limit);
	$smarty->assign('pager_arr', $ctl->get_website('page', $page));
}


//--------------------------------------------------------------------------------------
/*!
@brief	一覧のアサイン
@return	なし
*/
//--------------------------------------------------------------------------------------
function assign_result()
{
	//$smartyをグローバル宣言（必須）
	global $smarty;
	global $result;
	$smarty->assign('result', $result);
}

function assign_keyword() {
	global $smarty;
	global $keyword;
	if($keyword !== false) {
		$smarty->assign('keyword', $keyword);
	}
}

function assign_condOthers() {
	global $smarty;
	global $genre;
	global $target;
	$condOthers = '';
	if($genre !== false) {
		$condOthers .= 'ジャンル：' . $genre['genre_name'] .'&emsp;';
	}
	if($target !== false) {
		$condOthers .= 'ターゲット：' . $target['target_name'];
	}
	$smarty->assign('condOthers', $condOthers);
}

function assign_page_count(){
	global $smarty;
	global $count;
	$smarty->assign('key_count',$count);
} 
/////////////////////////////////////////////
/// 関数呼び出しブロック
/////////////////////////////////////////////////////////////////

//もしページが指定されていたら
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

if (isset($_GET['g'])) {
	$genre = (new cgenre())->get_tgt(false,$_GET['g']);
}

if (isset($_GET['t'])) {
	$target = (new ctarget())->get_tgt(false,$_GET['t']);
}

if (isset($_GET['w'])){
	$keyword = rawurldecode($_GET["w"]);
	if (preg_match('/[^ 　]+/u',$keyword)) {
		$safe_keyword = $db_obj->make_safe_keyword($keyword);
		$count = $db_obj -> get_keyword_count(false,$safe_keyword,$genre,$target);
		$result= $db_obj -> keyword_search(false,($page-1)*$limit,$limit,$safe_keyword,$genre,$target);
	}	
}else if($genre !== false || $target !== false) {
	$count = $db_obj -> get_genre_target_count(false,$genre,$target);
	$result= $db_obj -> genre_target_search(false,($page-1)*$limit,$limit,$genre,$target);
}


//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->assign('ERR_STR', $ERR_STR);
assign_keyword();
assign_condOthers();
assign_page_block();
assign_result();
assign_page_count();
$smarty->assign('FILEUP_DIR', $CMS_FILEUP_DIR);
$smarty->display('search_list.tmpl');

?>