<?php
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
require_once($CMS_COMMON_INCLUDE_DIR . 'auth_member.php');
require_once($CMS_COMMON_INCLUDE_DIR . "submitcheck.php");

$errortext = '';
$submit_id = 0;
$list_id = 0;
$edit_flag = false;


if(!isset($_SESSION['tmD2023_mem']['user_id']) || ($user=(new cuser())->get_tgt(false,$_SESSION['tmD2023_mem']['user_id'])) === false){
    cutil::redirect_exit('user_login.php?path=' . rawurlencode($_SERVER['REQUEST_URI']));
}

$smarty->assign('user_icon',$user['icon_img']);
$smarty->assign('FILEUP_DIR', $CMS_FILEUP_DIR);

if (isset($_GET['id']) && cutil::is_number($_GET['id']) && $_GET['id'] > 0) {
	$list_id = $_GET['id'];
}

if(isset($_POST['title']) && isset($_POST['genre']) && isset($_POST['target']) && isset($_POST['comment']) && isset($_POST['submit_id'])) {
    if(!submitcheck::check(false,$_POST['submit_id'])) {        
        $smarty->display('double_submit_err.tmpl');        
        exit;
    }
    $old_comment = array();
    $bookvalue = '';
    if($list_id > 0) {
        $list = (new clist())->get_tgt(false,$list_id);
        if($list === false || $list['user_id'] != $_SESSION['tmD2023_mem']['user_id']) {
            cutil::redirect_exit('index.php');
        }
        foreach(explode(",",$list['book_ids']) as $key => $value )  {
            $value = explode("c",$value);
            if(cutil::is_number($value[1])) {
                $old_comment[] = $value[1];
            }    
        }
    }
    if(!preg_match('/^.{1,50}$/u',$_POST['title'])) {
        $errortext .= 'タイトルは１文字以上５０文字以内です。</br>';
    }
    if(mb_strlen(str_replace("\r\n", " ", $_POST['comment'])) > 200) {
        $errortext .= 'リストコメントは２００文字以内です。</br>';
    }
    if(($gv = (new cgenre())->get_tgt(false,$_POST['genre'])) === false) {
        $errortext .= '存在しないジャンルです。</br>';
    }
    if(($tv = (new ctarget())->get_tgt(false,$_POST['target'])) === false) {
        $errortext .= '存在しないターゲットです。</br>';
    }

    $bookimgs = array();
    $comments = array();
    $count = 0;
    $bookdb = new cbook();
    for($i = 0; $i < 10; ++$i) {
        if(isset($_POST['ta_' . $i]) && isset($_POST['id_' . $i])) {
            if(($book = $bookdb->get_tgt(false,$_POST['id_' . $i])) !== false) {
                if(count($bookimgs) < 2) {
                    if($book['image_link'] === null) {
                        $bookimgs[] = '';
                    }else {
                        $bookimgs[] = $book['is_up_img'] == 1 ? $CMS_FILEUP_DIR . $book['image_link'] : $book['image_link'];
                    }
                }
                if($i != 0) {
                    $bookvalue .= ',';
                }
                $bookvalue .= $_POST['id_' . $i] . 'c';
                if(preg_match('/[^ 　\r\n]+/u',$_POST['ta_' . $i]) && mb_strlen(str_replace("\r\n", " ", $_POST['ta_' . $i])) <= 200) {
                    $comments[] = $i;
                    $bookvalue .= '<' . $i; 
                }
                ++$count;
                continue;
            }else {
                $errortext .= '存在しない本が選択されました。もう一度選択してください。</br>';
            }
        }
        break;
    }
    if($bookvalue == '') {
        $errortext .= '本が選択されていません。</br>';
    }
    if($errortext == '') {
        submitcheck::delete(false);
        $chenge = new cchange_ex();
        $c_index = 0;
        $old_c_length = count($old_comment);
        foreach ($comments as $key => $value) {
            $data = array();
            $data['comment'] = $_POST['ta_' . $value];
            if($c_index < $old_c_length) {
                $chenge->update(false,'book_comment_table',$data,'comment_id=' . $old_comment[$c_index]);
                $bookvalue = str_replace('<' . $value,$old_comment[$c_index] , $bookvalue);
                unset($old_comment[$c_index]);
                $c_index += 1;
            }else {
                $bookvalue = str_replace('<' . $value,$chenge->insert(false,'book_comment_table',$data), $bookvalue);   
            }   
        }
        $dataarr = array();
        $dataarr['list_title'] = $_POST['title'];
        $dataarr['list_comment'] = $_POST['comment'];
        $dataarr['book_count'] = $count;
        $dataarr['genre_id'] = $_POST['genre'];
        $dataarr['target_id'] = $_POST['target'];
        $dataarr['book_ids'] = $bookvalue;
        $dataarr['user_id'] = $user['user_id'];
        for($i = 0,$len = count($bookimgs); $i < 2; ++$i) {
            $flg = $i < $len;
            $dataarr['img_link' . $i] = $flg ? $bookimgs[$i] : null;
            if($flg) {
                $smarty->assign('img_link' . $i,$bookimgs[$i]);
            }
        }
        $lid = 0;
        if($list_id == 0) {            
            $lid = $chenge->insert(false,'list_table',$dataarr);
            $listInfo = $user['register_list'];
            $listInfo = $listInfo == null ? $lid:"$listInfo,$lid";
            $userArray = array();
            $userArray['register_list'] = $listInfo; 
            $chenge->update(false,'user_table',$userArray,'user_id=' . $user['user_id']);
        }else {
            $lid = $list_id;
            $chenge->update(false,'list_table',$dataarr,'list_id=' . $list_id);
            foreach($old_comment as $key => $value )  {
                $chenge->delete(false,"book_comment_table","comment_id=" . $value);
            }
        }
        $smarty->assign('list_id',$lid);
        $smarty->assign('list_title',$_POST['title']);
        $smarty->assign('genre_name',$gv['genre_name']);
        $smarty->assign('target_name',$tv['target_name']);
        $smarty->assign('book_count',$count);
        $smarty->assign('user_name',$user['user_name']);
        $smarty->display('create_list_end.tmpl');        
        exit;
    }
    $submit_id = $_POST['submit_id'];
}else {
    if(!isset($_GET['subid'])) {
        $redirectUrl = $_SERVER['PHP_SELF'] . '?subid=' . submitcheck::generate_id(false);
        if($list_id > 0) {
            $redirectUrl .= '&id=' . $list_id;
        }
        cutil::redirect_exit($redirectUrl);
    }else if(!submitcheck::check(false,$_GET['subid'])) {
        cutil::redirect_exit('index.php');
    }else {
        $submit_id = $_GET['subid'];
    }
    if($list_id > 0) {
        $list = (new clist())->get_tgt(false,$list_id);
        if($list === false || $list['user_id'] != $_SESSION['tmD2023_mem']['user_id']) {
            cutil::redirect_exit('index.php');
        }
        $bookdb = new cbook();
        $commentdb = new cbookcom();
        $index = 0;
        $books = array();
        foreach(explode(",",$list['book_ids']) as $key => $value )  {
            $value = explode("c",$value);
            $book = $bookdb->get_tgt(false,$value[0]);
            if($book !== false) {
                $book['index'] = $index++;
                $book['comment'] = $commentdb->get_tgt(false,$value[1]);
                if($book['image_link'] === null) {
                    $book['image_link'] = './img/book_no_image.jpg';
                }else if($book['is_up_img'] == 1) {
                    $book['image_link'] = $CMS_FILEUP_DIR . $book['image_link'];
                }
                $books[] = $book;
            }
        }
        $smarty->assign('list',$list);
        $smarty->assign('books',$books);
        $edit_flag = true;
    }
}

$smarty->assign('errortext',$errortext);
$smarty->assign('subid',$submit_id);

//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display($edit_flag ? 'create_list_edit.tmpl':'create_list.tmpl');
?>