<?php

//ライブラリをインクルード
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
//以下はセッション管理用のインクルード
require_once($CMS_COMMON_INCLUDE_DIR . "auth_adm.php");
require_once($CMS_COMMON_INCLUDE_DIR . "convert_isbn.php");


$show_mode = '';
$ERR_STR = '';
$rows = array();

$db_obj = new cbook();

$allcount = 0;
//ページの設定デフォルトは1
$page = 1;
//１ページあたりのリミット
$limit = 20;

$urlParam = '';

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
    global $allcount;
    $allcount = $db_obj->get_all_count(false);
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
    global $allcount;
    global $urlParam;
    $ctl = new cpager($_SERVER['PHP_SELF'] . $urlParam,$allcount,$limit);
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
    $smarty->assign('tgt_uri',"book_detail.php?bid=");
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
if(isset($_GET['w']) && isset($_GET['stype'])) {
    $flg = true;
    $keyword = rawurldecode($_GET['w']);
    if (preg_match('/[^ 　]+/u',$keyword)) {
        switch($_GET['stype']) {
            case 't':
                $safe_keyword = $db_obj->make_safe_keyword($keyword);
                $allcount = $db_obj-> get_t_keyword_count(false ,$safe_keyword); 
                if($allcount == 0) {
                    $smarty->assign('search_result','<font color="red">本が見つかりませんでした。</font>');
                }else {
                    $smarty->assign('search_result',$allcount . '件ヒットしました。<a href="book_list.php">取り消し</a>');
                    $rows = $db_obj-> get_t_keyword(false ,$safe_keyword ,($page-1)*$limit ,$limit);
                    $flg = false;
                }
                break;
            case 'a':
                $safe_keyword = $db_obj->make_safe_keyword($keyword);
                $allcount = $db_obj-> get_a_keyword_count(false ,$safe_keyword);
                if($allcount == 0) {
                    $smarty->assign('search_result','<font color="red">本が見つかりませんでした。</font>');
                }else {
                    $smarty->assign('search_result',$allcount . '件ヒットしました。<a href="book_list.php">取り消し</a>');
                    $rows = $db_obj-> get_a_keyword(false ,$safe_keyword ,($page-1)*$limit ,$limit);
                    $flg = false;
                }
                break;
            case 'i':
                if(mb_strlen($keyword) == 13) {
                    $keyword = convert_isbn::to_10($keyword);
                }
                if(($rows = $db_obj->get_tgt_isbn(false ,$keyword)) === false ) {
                    $smarty->assign('search_result','<font color="red">本が見つかりませんでした。</font>');
                }else {
                    $rows = array($rows);
                    $smarty->assign('search_result','ヒットしました。<a href="book_list.php">取り消し</a>');
                    $flg = false;
                }
                break;
            default:
                break;
        }
    }
    if($flg) {
        readdata();
    }else {
        $urlParam = '?w=' . rawurlencode($keyword) . '&stype=' . $_GET['stype'];
    }
    $smarty->assign('w',$keyword);
    $smarty->assign('stype',$_GET['stype']);
}else {
    $smarty->assign('stype','');
    readdata();
}
assign_page_block();
assign_data();
assign_tgt_uri();

$smarty->assign('ERR_STR',$ERR_STR);
$smarty->assign('FILEUP_DIR',$CMS_FILEUP_DIR);
//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('admin/book_list.tmpl');


?>
