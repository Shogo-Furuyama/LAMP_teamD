<?php
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
require_once($CMS_COMMON_INCLUDE_DIR . "auth_adm.php");

//メンバークラスを構築
$list_id = 0;

$db_obj = new clist();
$books = array();

/////////////////////////////////////////////////////////////////
/// 関数ブロック
/////////////////////////////////////////////////////////////////


//--------------------------------------------------------------------------------------
/*!
@brief  削除
@return なし
*/
//--------------------------------------------------------------------------------------
function deljob(){
    global $list_id;
    global $db_obj;
    if ($list_id > 0 && ($list = $db_obj->get_tgt(false, $list_id)) !== false) {
        $chenge = new cchange_ex();
        foreach(explode(",",$list['book_ids']) as $key => $value )  {
            $value = explode("c",$value);
            if(cutil::is_number($value[1])) {
                $chenge->delete(false,"book_comment_table","comment_id=" . $value[1]);
            }    
        }
        $chenge->delete(false,"list_table","list_id=" . $list_id);
        if(($user = (new cuser())->get_tgt(false,$list['user_id'])) !== false && $user['register_list'] !== null) {
            $regiList = explode(',',$user['register_list']);
            $regiSearchResult = array_search($list_id, $regiList);
            if ($regiSearchResult !== false) {
                unset($regiList[$regiSearchResult]);
                $userUpdata['register_list'] = count($regiList) != 0 ? implode(',', $regiList) : null;;
                $chenge->update(false,'user_table',$userUpdata,'user_id=' . $list['user_id']);
            }
        }
        cutil::redirect_exit('booklist_list.php');
    }
}

function assign_process() {
    global $smarty;
    global $list_id;
    $smarty->assign('list_id',$list_id);
    data_assign($smarty,'list_title');
    data_assign($smarty,'book_count');
    data_assign($smarty,'list_comment');
    data_assign($smarty,'genre_id');
    data_assign($smarty,'genre_name');
    data_assign($smarty,'target_id');
    data_assign($smarty,'target_name');
    data_assign($smarty,'favorite');
    data_assign($smarty,'user_id');
    data_assign($smarty,'user_name');
}

function data_assign($smarty,$suffix) {
    $smarty->assign($suffix,isset($_POST[$suffix]) ? $_POST[$suffix]:'');
}

///////////////////////////////////////////////////////////////
/// 関数呼び出しブロック
/////////////////////////////////////////////////////////////////


//配列にメンバーを$_POSTに取り出す
//すでにPOSTされていたら、DBからは取り出さない
if (
    isset($_GET['lid'])
    //cutilクラスのメンバ関数をスタティック呼出
    && cutil::is_number($_GET['lid'])
    && $_GET['lid'] > 0
) {
    $list_id = $_GET['lid'];
}

//$_POST優先
if (
    isset($_POST['list_id'])
    //cutilクラスのメンバ関数をスタティック呼出
    && cutil::is_number($_POST['list_id'])
    && $_POST['list_id'] > 0
) {
    $list_id = $_POST['list_id'];
}

if (isset($_POST['func'])) {
    switch ($_POST['func']) {
        case 'del':
            deljob();
            //deljob()内でリダイレクトするので
            //ここまで実行されればリダイレクト失敗
            echo '削除に失敗しました。';
            exit;
            break;
        default:
            //通常はありえない
            echo '原因不明のエラーです。';
            exit;
            break;
    }
} else {
    if ($list_id <= 0 || ($_POST = $db_obj->get_tgt(false, $list_id)) === false) {
        cutil::redirect_exit('booklist_list.php');
    }else {
        $book_db = new cbook();
        $commnet_db = new cbookcom();
        $index = 0;
        foreach(explode(",",$_POST['book_ids']) as $key => $value )  {
            $value = explode("c",$value);
            $book = array();
            $book['index'] = ++$index;
            $book['book_id'] = $value[0];
            $bookDbResult = $book_db->get_tgt(false,$value[0]);
            if($bookDbResult !== false) {
                $book['book_title'] = $bookDbResult['book_title'];
                $book['comment'] = $commnet_db->get_tgt(false,$value[1]);
                $book['is_alive'] = true;
            }else {
                $book['book_title'] = '存在しない書籍です。';
                $book['comment'] = false;
                $book['is_alive'] = false;
            }
            $books[] = $book;
        }
    }
}

assign_process();
$smarty->assign('books', $books);
$smarty->display('admin/booklist_detail.tmpl');
?>
