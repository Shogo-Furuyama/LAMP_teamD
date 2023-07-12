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

$ERR_STR = '';
$obj = new clist();

//ページの設定
//デフォルトは1
$page = 1;
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

//1ページのリミット
$limit = 20;
$count = 0;
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
	global $obj;
	global $count;
    $keyword = rawurldecode($_GET["w"]);;
	$retstr = '';
	$count = $obj->get_keyword_count(false,$keyword);
	$ctl = new cpager($_SERVER['PHP_SELF'], 100, $limit);
	$smarty->assign('pager_arr', $ctl->get_website('page', $page, $keyword));
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

function assign_keyword($keyword = '') {
	global $smarty;
	$smarty->assign('keyword', $keyword);
}

function assign_page_count(){
	global $smarty;
	global $count;
	$smarty->assign('key_count',$count);
} /////////////////////////////////////////////
/// 関数呼び出しブロック
/////////////////////////////////////////////////////////////////


if(isset($_GET['w'])){
	$db = new clist();
	$keyword = rawurldecode($_GET["w"]);
	$result= $db ->keyword_search(false,0,20,$keyword);
	assign_keyword($keyword);
}else {
	assign_keyword();
}

//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->assign('ERR_STR', $ERR_STR);
assign_page_block();
assign_result();
assign_page_count();
$smarty->display('search_list.tmpl');

?>