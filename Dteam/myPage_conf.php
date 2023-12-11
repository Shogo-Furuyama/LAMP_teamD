<?php
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
require_once($CMS_COMMON_INCLUDE_DIR . 'auth_member.php');
require_once($CMS_COMMON_INCLUDE_DIR . "submitcheck.php");

if(!isset($_SESSION['tmD2023_mem']['user_id'])){
    cutil::redirect_exit('user_login.php?path=' . rawurlencode($_SERVER['REQUEST_URI']));
}

$user_id = $_SESSION['tmD2023_mem']['user_id'];
$submit_index = 'submit_mpage';
$user_db = new cuser();

function update($datrr){
    global $user_id;
    global $submit_index;
    $change = new cchange_ex();
    $change->update(false, 'user_table', $datrr, 'user_id=' . $user_id);
    submitcheck::delete(false,$submit_index);
    $_POST['submit_id'] = submitcheck::generate_id(false,$submit_index);
}

function date_assign($suffix){
    global $smarty;
    $smarty->assign($suffix, $_POST[$suffix]);
}

function alert_assign($flg,$str,$pos = '') {
    global $smarty;
    if($flg) {
        $smarty->assign('alert', '<div class="alert alert-primary" role="alert">' . $str . 'の更新が完了しました。</div>');
    }else {
        $smarty->assign('alert', '<div class="alert alert-danger" role="alert">' . $str . 'の更新に失敗しました。' . $pos . '</div>');
    }       
}

if(isset($_POST['func']) && isset($_POST['submit_id']) && submitcheck::check(false,$_POST['submit_id'],$submit_index)){
    switch($_POST['func']){
        case 'name':
            $flg = true;
            if(!isset($_POST['name1']) || !preg_match('/^[^ 　]{1,15}$/u',$_POST['name1'])){
                $flg = false;
            }else if(!isset($_POST['name2']) || !preg_match('/^[^ 　]{1,15}$/u',$_POST['name2'])){
                $flg = false;
            }

            if($flg) {
                $dataarr = array();
                $dataarr['first_name'] = (string) $_POST['name2'];
                $dataarr['last_name'] = (string) $_POST['name1'];
                update($dataarr);
                alert_assign(true,'名前');
            }else {
                alert_assign(false,'名前');
            }
            break;
        case 'email':
            if(isset($_POST['mail']) && preg_match('/^[a-zA-Z0-9_+-]+(\.[a-zA-Z0-9_+-]+)*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/',$_POST['mail'])){
                $result = $user_db->get_tgt_login(false,$_POST['mail']);
                if($result === false){
                    $dataarr = array();
                    $dataarr['mail'] = $_POST['mail'];
                    update($dataarr);
                    alert_assign(true,'Email');
                }else if($result['user_id'] != $user_id){
                    alert_assign(false,'Email','</br>このメールアドレスはすでに登録されています。');
                }
            }else {
                alert_assign(false,'Email');
            }
            break;
        case 'address':
            $flg = true;
            if(!isset($_POST['address']) || !preg_match('/^[^ 　]{1,255}$/u',$_POST['address'])){
                $flg = false;
            }else if(!isset($_POST['post_1']) || !preg_match('/^[0-9]{3}$/',$_POST['post_1'])){
                $flg = false;
            }else if(!isset($_POST['post_2']) || !preg_match('/^[0-9]{4}$/',$_POST['post_2'])){
                $flg = false;
            }

            if($flg){
                $dataarr = array();
                $dataarr['address'] = (string) $_POST['address'];
                $dataarr['post_num'] = $_POST['post_1'] . '-' . $_POST['post_2'];
                update($dataarr);
                alert_assign(true,'住所');
            }else {
                alert_assign(false,'住所');
            }
            break;
        case 'password':
            if(isset($_POST['password']) && preg_match('/^[\w\x21-\x7e]{8,25}$/',$_POST['password'])){
                $dataarr = array();
                $dataarr['password'] = cutil::pw_encode($_POST['password']);
                update($dataarr);
                alert_assign(true,'パスワード');
            }else {
                alert_assign(false,'パスワード');
            }

            break;
        default:
            break;
    }
    $smarty->assign('submit_id', $_POST['submit_id']);
}else {
    $smarty->assign('submit_id', submitcheck::generate_id(false,$submit_index));
}

if(($_POST = $user_db -> get_tgt(false,$user_id)) === false){
    cutil::redirect_exit('index.php');
}

date_assign('first_name');
date_assign('last_name');
date_assign('mail');
date_assign('address');
date_assign('post_num');
//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('myPage_conf.tmpl');
?>