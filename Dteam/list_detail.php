<?php
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
require_once($CMS_COMMON_INCLUDE_DIR . 'auth_member.php');

$id = null;
$list_info = false;

if (
    isset($_GET['id'])
    //cutilクラスのメンバ関数をスタティック呼出
    && cutil::is_number($_GET['id'])
    && $_GET['id'] > 0
) {
    $id = $_GET['id'];
}else {
    cutil::redirect_exit('index.php');
}

if (($list_info = (new clist())->get_tgt(false, $id)) !== false) {
    $book_db = new cbook();
    $commnet_db = new cbookcom();
    $books = array();
    $index = 0;
    $list_info['list_comment'];
    foreach(explode(",",$list_info['book_ids']) as $key => $value )  {
        $value = explode("c",$value);
        $book = $book_db->get_tgt(false,$value[0]);
        if($book !== false) {
            $book['index'] = ++$index;
            $book['comment'] = $commnet_db->get_tgt(false,$value[1]);
            if($book['image_link'] === null) {
                $book['image_link'] = './img/book_no_image.jpg';
            }else if($book['is_up_img'] == 1) {
                $book['image_link'] = $CMS_FILEUP_DIR . $book['image_link'];
            }        
            $books[] = $book;
        }
    }
    $smarty->assign('books', $books);
    
    if(isset($_SESSION['tmD2023_mem']['user_id'])){
        $user_result = (new cuser())->get_tgt(false,$_SESSION['tmD2023_mem']['user_id']);
        $smarty->assign('favoriteFlg', array_search($id,($user_result['favorite_list'] === null ? array() : explode(',',$user_result['favorite_list']))) === false ? '1' : '0');    
    }else {
        $smarty->assign('favoriteFlg', null);
    }
}

$smarty->assign('list_info', $list_info);
$smarty->assign('FILEUP_DIR', $CMS_FILEUP_DIR);
//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('list_detail.tmpl');
?>