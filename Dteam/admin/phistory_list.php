<?php

//ライブラリをインクルード
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
//以下はセッション管理用のインクルード
require_once($CMS_COMMON_INCLUDE_DIR . "auth_adm.php");


$show_mode = '';
$ERR_STR = '';
$rows = array();

$db_obj = new cpurchase_history();

//ページの設定デフォルトは1
$page = 1;
//１ページあたりのリミット
$limit = 20;

/////////////////////////////////////////////////////////////////
/// 関数ブロック
/////////////////////////////////////////////////////////////////

//--------------------------------------------------------------------------------------
/*!
@brief  データ読み込み
@return なし
*/
//--------------------------------------------------------------------------------------
function readdata(){
    global $limit;
    global $rows;
    global $page;
    global $db_obj;
    $from = ($page - 1) * $limit;
    $rows = $db_obj->get_all(false,$from,$limit);
}


//--------------------------------------------------------------------------------------
/*!
@brief  ページャーのアサイン
@return なし
*/
//--------------------------------------------------------------------------------------
function assign_page_block(){
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $limit;
    global $page;
    global $db_obj;
    $allcount = $db_obj->get_all_count(false);
    $ctl = new cpager($_SERVER['PHP_SELF'],$allcount,$limit);
    $smarty->assign('pager_arr',$ctl->get('page',$page));
}


//--------------------------------------------------------------------------------------
/*!
@brief  一覧のアサイン
@return なし
*/
//--------------------------------------------------------------------------------------
function assign_data(){
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $rows;
    $smarty->assign('rows',$rows);
}

//--------------------------------------------------------------------------------------
/*!
@brief  URIのアサイン
@return なし
*/
//--------------------------------------------------------------------------------------
function assign_tgt_uri(){
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $page;
    $smarty->assign('tgt_uri',"phistory_detail.php?id=");
}

/////////////////////////////////////////////////////////////////
/// 実行ブロック
/////////////////////////////////////////////////////////////////

//もしページが指定されていたら
if(isset($_GET['page']) 
    //なおかつ、数字だったら
    && cutil::is_number($_GET['page'])
    //なおかつ、0より大きかったら
    && $_GET['page'] > 0){
    //パラメータを設定
    $page = $_GET['page'];
}

/////////////////////////////////////////////////////////////////
/// 関数呼び出しブロック
/////////////////////////////////////////////////////////////////
//データの読み込み
readdata();
assign_page_block();
assign_data();
assign_tgt_uri();

$smarty->assign('ERR_STR',$ERR_STR);
//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('admin/phistory_list.tmpl');


?>
