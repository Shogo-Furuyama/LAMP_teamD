<?php
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
require_once($CMS_COMMON_INCLUDE_DIR . 'auth_member.php');
require_once($CMS_COMMON_INCLUDE_DIR . "fileupload.php");
require_once($CMS_COMMON_INCLUDE_DIR . "submitcheck.php");

$user_id = null;
$myFlag = false;
$submit_index = 'submit_mpage';

function update($datrr){
    global $user_id;
    global $submit_index;
    $change = new cchange_ex();
    $change->update(false, 'user_table', $datrr, 'user_id=' . $user_id);
    submitcheck::delete(false,$submit_index);
    $_POST['submit_id'] = submitcheck::generate_id(false,$submit_index);
}

function date_assign($suffix,$safeText = null){
    global $smarty;
    if($safeText === null) {
        $smarty->assign($suffix, $_POST[$suffix]);
    }else {
        $smarty->assign($suffix, $_POST[$suffix] === null ? $safeText:$_POST[$suffix]);
    }
}


if (isset($_GET['uid'])) {
    if(cutil::is_number($_GET['uid']) && $_GET['uid'] > 0) {
	    $user_id = $_GET['uid'];
        $myFlag = isset($_SESSION['tmD2023_mem']['user_id']) && $user_id == $_SESSION['tmD2023_mem']['user_id'];
    }
}else if(isset($_SESSION['tmD2023_mem']['user_id'])){
    $user_id = $_SESSION['tmD2023_mem']['user_id'];
    $myFlag = true;
}

if($user_id === null) {
    cutil::redirect_exit('index.php');
}

if(isset($_GET['lo'])) {
    unset($_SESSION['tmD2023_mem']['user_id']);
    cutil::redirect_exit('myPage.php?uid=' . $user_id);
}

$db_obj = new cuser();
if(isset($_POST['func']) && $myFlag && isset($_POST['submit_id']) && submitcheck::check(false,$_POST['submit_id'],$submit_index)){
    switch($_POST['func']){
        case 'profile_name':
            $flg = true;
            $fileUpFlag = false;
            if(!isset($_POST['profile_name']) || !preg_match('/^.{1,20}$/u',$_POST['profile_name'])){
                $flg = false;
            }else if(isset($_FILES['input-iconfile']) && $_FILES['input-iconfile']['error'] == 0) {
                $upload = new fileupload();
                $result = $upload->upload(
                    'input-iconfile',
                    2097152,//2MB
                    array(".png",".jfif",".pjpeg",".jpeg",".pjp",".jpg",".gif"),
                    'icon_img/',
                    '',
                    $CMS_FILEUP_DIR
                );
                if($result !== false) {
                    $_POST['input-iconfile'] = $result;
                    $fileUpFlag = true;
                }else {
                    $flg = false;
                }
            }

            if($flg) {
                $dataarr = array();
                $dataarr['user_name'] = (string) $_POST['profile_name'];
                if($fileUpFlag) {
                    $dataarr['icon_img'] = (string) $_POST['input-iconfile'];
                    $db_result = $db_obj-> get_tgt(false,$user_id);
                    if($db_result !== false && $db_result['icon_img'] !== null) {
                        unlink($CMS_FILEUP_DIR . $db_result['icon_img']);
                    }
                }
                update($dataarr);
                $smarty->assign('alert','<div class="alert alert-primary" role="alert">保存しました</div>');
            }
            break;
        case 'profile_comment':
            if(isset($_POST['profile_comment']) && mb_strlen(str_replace("\r\n", " ", $_POST['profile_comment'])) <= 200){
                $dataarr = array();
                $dataarr['comment'] = $_POST['profile_comment'];
                update($dataarr);
                $smarty->assign('alert','<div class="alert alert-primary" role="alert">保存しました</div>');
            }
            break;
        case 'profile_category':
            if(isset($_POST['category']) && ((new cgenre)->get_tgt(false,$_POST['category'])) !== false){
                $dataarr = array();
                $dataarr['favorite_genre'] = $_POST['category'];
                update($dataarr);
                $smarty->assign('alert','<div class="alert alert-primary" role="alert">保存しました</div>');
            }
            break;
        case 'profile_count':
            if(isset($_POST['profile_count']) && preg_match('/^([1-9]{1}[0-9]{0,8}|0)$/',$_POST['profile_count'])){
                $dataarr = array();
                $dataarr['book_count'] = $_POST['profile_count'];
                update($dataarr);
                $smarty->assign('alert','<div class="alert alert-primary" role="alert">保存しました</div>');
            }
            break;
        case 'favorite_book':
            if(isset($_POST['favorite_book_id'])){
                $dataarr = array();
                $dataarr['favorite_book'] = (new cbook())->get_tgt(false,$_POST['favorite_book_id']) !== false ? $_POST['favorite_book_id']:null;
                update($dataarr);
                $smarty->assign('alert','<div class="alert alert-primary" role="alert">保存しました</div>');
            }
            break;
        default:
            break;
    }
    $smarty->assign('submit_id',$_POST['submit_id']);
}else {
    $smarty->assign('submit_id', submitcheck::generate_id(false,$submit_index));
}
if(($_POST = $db_obj-> get_tgt(false,$user_id)) !== false){
    date_assign('user_name');
    date_assign('comment','');
    date_assign('book_count');
    date_assign('favorite_genre');
    if($_POST['icon_img'] !== null) {
        $_POST['icon_img'] = $CMS_FILEUP_DIR . $_POST['icon_img'];
    }
    date_assign('icon_img');
    if($_POST['favorite_book'] !== null) {
        $book = (new cbook())-> get_tgt(false,$_POST['favorite_book']);
        if($book !== false) {
            date_assign('favorite_book');
            $smarty->assign('favorite_book_title', $book['book_title']);
            $link = null;
            if($book['image_link'] === null) {
                $link = './img/book_no_image.jpg';
            }else {
                $link = $book['is_up_img'] == 1 ? $CMS_FILEUP_DIR . $book['image_link'] : $book['image_link'];
            }
            $smarty->assign('favorite_book_img', $link);
        }
    }
    if(!$myFlag){
        $count = 0;
        $register = $_POST['register_list'];
        if($register !== null) {
            $list_db = new clist();
            $count = $list_db->get_tgts_count(false,$register);
            if($count != 0) {
                $lists = $list_db->get_tgts(false,$register,-1);
                $smarty->assign('lists',$lists);
                $smarty->assign('FILEUP_DIR', $CMS_FILEUP_DIR);
            }
        }
        $smarty->assign('count',$count);
        $smarty->assign('genre_result',(new cgenre)->get_tgt(false,$_POST['favorite_genre']));
    }
}else {
    cutil::redirect_exit('index.php');   
}

//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display($myFlag ? 'myPage.tmpl' : 'myPage_public.tmpl');
?>