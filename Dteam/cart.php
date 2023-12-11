<?php
/*!
@file login.php
@brief  メインメニュー(管理画面)
@copyright Copyright (c) 2017 Yamanoi Yasushi.
*/

require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
require_once($CMS_COMMON_INCLUDE_DIR . "auth_member.php");    

if (isset($_SESSION['tmD2023_mem']['user_id'])) {
    $book_db = new cbook();
    if(isset($_POST['paymentMethod']) && isset($_POST['address']) && isset($_POST['address'])) {
        $day = null;
        if(isset($_POST['dateSelect']) && preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$_POST['dateSelect'])) {
            $day = date("Y-m-d", strtotime($_POST['dateSelect']));
        }else {
            $day = date("Y-m-d", strtotime("3 day"));
        }
        $data = array();
        $total_amount = 0;
        for($i = 0;$i < 100;++$i) {
            if( isset($_POST['bid' . $i]) && isset($_POST['bNum' . $i])) {        
                $book = $book_db->get_tgt(false, $_POST['bid' . $i]);
                if ($book !== false) {
                    $total_amount += $book['price'] * $_POST['bNum' . $i];
                    $data[] = $_POST['bid' . $i] . 'n' . $_POST['bNum' . $i];
                }
            }else {
                break;
            }
        }
        $datrr = array();
        $datrr['payment'] = $_POST['paymentMethod'];
        $datrr['user_id'] = $_SESSION['tmD2023_mem']['user_id'];
        $datrr['total_amount'] = $total_amount;
        $datrr['book_data'] = implode(',',$data);
        $datrr['address'] = $_POST['address'];
        $datrr['delivery_date'] = $day;
        $change = new cchange_ex();
        $change->insert(false, 'purchase_history_table', $datrr);
        $datrr = array();
        $datrr['user_cart'] = null;
        $change->update(false, 'user_table', $datrr, 'user_id=' . $_SESSION['tmD2023_mem']['user_id']);
        $smarty->assign('day',$day);
        $smarty->display('purchase_conf.tmpl');
        exit;
    }

    $books = array();
    $user = (new cuser())->get_tgt(false, $_SESSION['tmD2023_mem']['user_id']);
    $cart = $user['user_cart'];
    $i = 0;
    foreach (explode(",", $cart) as $key => $value) {
        $value = explode("n", $value);
        $book = $book_db->get_tgt(false, $value[0]);
        if ($book !== false) {
            $book['index'] = $i;
            $book['num'] = $value[1];
            if($book['image_link'] === null) {
                $book['image_link'] = '../img/book_no_image.jpg';
            }else if($book['is_up_img'] == 1) {
                $book['image_link'] = $CMS_FILEUP_DIR . $book['image_link'];
            }
            $books[] = $book;
            $i += 1;
        }
    }
    $smarty->assign('books', $books);
    $smarty->assign('user', $user);

    // テンプレートを表示
    $smarty->display('cart.tmpl');

} else {
    cutil::redirect_exit('index.php');
}
?>
