<?php
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
require_once($CMS_COMMON_INCLUDE_DIR . "auth_adm.php");

//メンバークラスを構築
$his_id = 0;

$db_obj = new cpurchase_history();
$books = array();

/////////////////////////////////////////////////////////////////
/// 関数ブロック
/////////////////////////////////////////////////////////////////


function assign_process() {
    global $smarty;
    global $his_id;
    $smarty->assign('his_id',$his_id);
    data_assign($smarty,'payment_name');
    data_assign($smarty,'user_id');
    data_assign($smarty,'user_name');
    data_assign($smarty,'user_alive');
    data_assign($smarty,'total_amount');
    data_assign($smarty,'book_data');
    data_assign($smarty,'address');
    data_assign($smarty,'purchase_date');
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
    isset($_GET['id'])
    //cutilクラスのメンバ関数をスタティック呼出
    && cutil::is_number($_GET['id'])
    && $_GET['id'] > 0
) {
    $his_id = $_GET['id'];
}

if ($his_id <= 0 || ($_POST = $db_obj->get_tgt(false, $his_id)) === false) {
    cutil::redirect_exit('phistory_list.php');
}else {
    if(($puser = (new cuser())->get_tgt(false,$_POST['user_id'])) !== false) {
        $_POST['user_name'] = $puser['user_name'];
        $_POST['user_alive'] = true;
    }else {
        $_POST['user_name'] = '存在しないユーザーです。';
        $_POST['user_alive'] = false;
    }
    $book_db = new cbook();
    foreach(explode(",",$_POST['book_data']) as $key => $value )  {
        $value = explode("n",$value);
        $book = array();
        $book['book_id'] = $value[0];
        $bookDbResult = $book_db->get_tgt(false,$value[0]);
        if($bookDbResult !== false) {
            $book['book_title'] = $bookDbResult['book_title'];
            $book['is_alive'] = true;
            if($bookDbResult['image_link'] === null) {
                $book['image_link'] = '../img/book_no_image.jpg';
            }else if($bookDbResult['is_up_img'] == 1) {
                $book['image_link'] = $CMS_FILEUP_DIR . $bookDbResult['image_link'];
            }else {
                $book['image_link'] = $bookDbResult['image_link'];
            }
        }else {
            $book['book_title'] = '存在しない書籍です。';
            $book['image_link'] = '../img/book_no_image.jpg';
            $book['is_alive'] = false;
        }        
        $book['b_count'] = $value[1];
        $books[] = $book;
    }
}


assign_process();
$smarty->assign('books', $books);
$smarty->display('admin/phistory_detail.tmpl');
?>
