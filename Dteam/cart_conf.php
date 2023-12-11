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
require_once($CMS_COMMON_INCLUDE_DIR ."auth_member.php");

if(isset($_POST['bid']) && isset($_POST['num'])) {
    $json = array();
    $success = false;
    $isLogin = true;
    if(isset($_SESSION['tmD2023_mem']['user_id'])) {
        if(
            is_numeric($_POST['bid']) && 
            (new cbook())->get_tgt(false,$_POST['bid']) !== false && 
            is_numeric($_POST['num']) && 
            $_POST['num'] > 0 && 
            $_POST['num'] <= 99) {
                $cart = (new cuser())->get_tgt(false,$_SESSION['tmD2023_mem']['user_id'])['user_cart'];
                if($cart === null) {
                    $cart = $_POST['bid'] . 'n' . $_POST['num'];
                }else {
                    $flg = true;
                    $bid = $_POST['bid'];
                    $num = $_POST['num'];
                    $temp = explode(",",$cart);
                    foreach($temp as $key => $value )  {
                        $value = explode("n",$value);
                        if($value[0] == $bid) {
                            $flg = false;
                            unset($temp[$key]);
                            $value[1] = ((int)$value[1]) + $num;
                            if($value[1] > 99) {
                                $value[1] = 99;
                            }
                            $temp[] = $value[0] . 'n' . $value[1];
                            break;
                        }
                    }
                    if($flg) {
                        $cart .= ",{$bid}n{$num}";
                    }else {
                        $cart = implode(",", $temp);
                    }
                }
                $data = array();
                $data['user_cart'] = $cart;
                (new cchange_ex())->update(false, 'user_table', $data, 'user_id=' . $_SESSION['tmD2023_mem']['user_id']);
                $success = true;
        }
    }else {
        $isLogin = false;
    }
    $json['success'] = $success;
    $json['isLogin'] = $isLogin;
    echo json_encode($json);
    exit;
}

if(isset($_SESSION['tmD2023_mem']['user_id']) && isset($_GET['bid'])) {
    $book_db = new cbook();
    $result = $book_db->get_tgt(false,$_GET['bid']);
    if($result !== false) {
        if($result['is_up_img'] == 1) {
            $result['image_link'] = $CMS_FILEUP_DIR . $result['image_link'];
        }else if($result['image_link'] === null) {
            $result['image_link'] = './img/book_no_image.jpg';
        }
        $subtotal = 0;
        $cart = (new cuser())->get_tgt(false,$_SESSION['tmD2023_mem']['user_id'])['user_cart'];
        foreach(explode(",",$cart) as $key => $value )  {
            $value = explode("n",$value);
            $book = $book_db->get_tgt(false,$value[0]);
            if($book !== false) {
                $subtotal += $book['price'] * ((int)$value[1]);
            }
        }
        $smarty->assign('backUrl', isset($_GET['lid']) && is_numeric($_GET['lid']) ? 'list_detail.php?id=' . $_GET['lid']:'index.php');
        $smarty->assign('subtotal', $subtotal);
        $smarty->assign('image_link', $result['image_link']);
        $smarty->display('cart_conf.tmpl');
        exit;
    }
}
cutil::redirect_exit('index.php');
?>