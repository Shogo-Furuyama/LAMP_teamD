<?php
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
require_once($CMS_COMMON_INCLUDE_DIR . "auth_adm.php");
require_once($CMS_COMMON_INCLUDE_DIR . "fileupload.php");
require_once($CMS_COMMON_INCLUDE_DIR . "submitcheck.php");
require_once($CMS_COMMON_INCLUDE_DIR . "convert_isbn.php");

//メンバークラスを構築
$book_id = 0;
$err_flag = false;

$db_obj = new cbook();

/////////////////////////////////////////////////////////////////
/// 関数ブロック
/////////////////////////////////////////////////////////////////

//--------------------------------------------------------------------------------------
/*!
@brief  パラメータのチェック
@return エラーの場合はfalseを返す
*/
//--------------------------------------------------------------------------------------
function paramchk()
{
    $retflg = true;

    //１エラー配列
    //２ポスト添え字
    //３エラーメッセージテキスト※'ユーザーネームが見つかりません'
    //４チェック方法
    
    /// メンバー名の存在と空白チェック
    if (!preg_match('/^([0-9]{9}[0-9X]{1}|[0-9]{12}[0-9X]{1})$/',$_POST['isbn'])) {
        $retflg = false;
    }else if (!preg_match('/^.{1,100}$/u',$_POST['book_title'])) {
        $retflg = false;
    }else if (!preg_match('/^.{1,30}$/u',$_POST['authors'])) {
        $retflg = false;
    }else if ($_POST['img_type'] == 'link' && !preg_match('/^.{1,200}$/u',$_POST['image_link'])) {
        $retflg = false;
    }else if (!preg_match('/^([1-9]{1}[0-9]{0,8}|0)$/',$_POST['page'])) {
        $retflg = false;
    }else if (!preg_match('/^([1-9]{1}[0-9]{0,8}|0)$/',$_POST['price'])) {
        $retflg = false;
    }else if (!preg_match('/^([1-9]{1}[0-9]{0,8}|0)$/',$_POST['stock'])) {
        $retflg = false;
    }else if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$_POST['release_date'])) {
        $retflg = false;
    }
    if($retflg) {
        list($Y, $m, $d) = explode('-', $_POST['release_date']);
        if (checkdate($m, $d, $Y)) {
            global $db_obj;
            global $book_id;
            if(mb_strlen($_POST['isbn']) == 13) {
                $_POST['isbn'] = convert_isbn::to_10($_POST['isbn']);
            }
            if(($obj = $db_obj->get_tgt_isbn(false, $_POST['isbn'])) === false || $obj['book_id'] == $book_id) {
                return true;
            }
        }
    }
    return false;
}

//--------------------------------------------------------------------------------------
/*!
@brief  ファイルアップロードの場合はアップロードするメソッド
@return エラーの場合はfalseを返す
*/
//--------------------------------------------------------------------------------------
function file_upload()
{
    switch ($_POST['img_type']) {
        case 'up':
            global $CMS_FILEUP_DIR;
            $upload = new fileupload();
            $result = $upload->upload(
                'image_file',
                2097152,//2MB
                array(".png",".jfif",".pjpeg",".jpeg",".pjp",".jpg"),
                'book_img/',
                '',
                $CMS_FILEUP_DIR
            );
            if($result !== false) {
                $_POST['image_link'] = $result;  
            }else {
                return false;
            }
        case 'def':
            $_POST['is_up_img'] = 1;
            break;
        default:
            $_POST['is_up_img'] = 0;
            break;
    }
    return true;
}

//--------------------------------------------------------------------------------------
/*!
@brief  前回、ファイルアップロードだった場合は削除するメソッド
@return なし
*/
//--------------------------------------------------------------------------------------
function file_delete() {
    global $db_obj;
    global $book_id;
    if ($book_id > 0 && ($obj = $db_obj->get_tgt(false, $book_id)) !== false && $obj['is_up_img'] == 1) {
        global $CMS_FILEUP_DIR;
        unlink($CMS_FILEUP_DIR . $obj['image_link']);
    }
}

//--------------------------------------------------------------------------------------
/*!
@brief  メンバーデータの追加／更新。保存後自分自身を再読み込みする。
@return なし
*/
//--------------------------------------------------------------------------------------
function regist()
{
    global $book_id;
    $dataarr = array();
    $dataarr['isbn'] = (string) $_POST['isbn'];
    $dataarr['book_title'] = (string) $_POST['book_title'];
    $dataarr['authors'] = (string) $_POST['authors'];
    $dataarr['page'] = (string) $_POST['page'];
    $dataarr['price'] = (string) $_POST['price'];
    $dataarr['stock'] = (string) $_POST['stock'];
    $dataarr['release_date'] = (string) $_POST['release_date'];
    $dataarr['is_up_img'] = (string)$_POST['is_up_img'];
    switch($_POST['img_type']) {
        case 'link':
        case 'up':
            $dataarr['image_link'] = (string) $_POST['image_link'];
            break;
        case 'emp':
            $dataarr['image_link'] = null;
            break;
        default:
            break;
    }
    $chenge = new cchange_ex();
    if ($book_id > 0) {
        $chenge->update(false, 'book_table', $dataarr, 'book_id=' . $book_id);
        cutil::redirect_exit($_SERVER['PHP_SELF'] . '?bid=' . $book_id);
    } else {
        $bid = $chenge->insert(false, 'book_table', $dataarr);
        cutil::redirect_exit($_SERVER['PHP_SELF'] . '?bid=' . $bid);
    }
}

//--------------------------------------------------------------------------------------
/*!
@brief  削除
@return なし
*/
//--------------------------------------------------------------------------------------
function deljob(){
    global $book_id;
    if ($book_id > 0) {
        $chenge = new cchange_ex();
        $chenge->delete(false,"book_table","book_id=" . $book_id);
        cutil::redirect_exit('book_list.php');
    }
}

function link_processing() {
    if($_POST['is_up_img'] == 1) {
        global $CMS_FILEUP_DIR;
        $linksuffix = 'image_link';
        $_POST[$linksuffix] = $CMS_FILEUP_DIR . $_POST[$linksuffix];
    }
}

function assign_process() {
    global $smarty;
    global $book_id;
    $smarty->assign('book_id_txt',$book_id <= 0 ? '新規' : $book_id );
    $smarty->assign('book_id',$book_id);
    data_assign($smarty,'book_title');
    data_assign($smarty,'price');
    data_assign($smarty,'image_link');
    data_assign($smarty,'stock');
    data_assign($smarty,'authors');
    data_assign($smarty,'page');
    data_assign($smarty,'release_date');
    data_assign($smarty,'isbn');
    data_assign($smarty,'is_up_img');
}

function data_assign($smarty,$suffix) {
    $smarty->assign($suffix, $_POST[$suffix]);
}

//--------------------------------------------------------------------------------------
/*!
@brief  エラー存在のアサイン
@return なし
*/
//--------------------------------------------------------------------------------------
function assign_err_flag()
{
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_flag;
    $str = '';
    if($err_flag) {
        $str = 
        <<<END_BLOCK
        <p class="red">更新に失敗しました。もう一度お試しください。</p>
        END_BLOCK;    
    }
    $smarty->assign('err_flag', $str);
}

function post_check() {
    post_init('isbn');
    post_init('book_title');
    post_init('authors');
    post_init('img_type');
    post_init('image_def');
    post_init('image_link');
    post_init('image_file');
    post_init('page');
    post_init('price');
    post_init('stock');
    post_init('release_date');
    post_init('is_up_img');
    post_init('submit_id');
}

function post_init($suffix) {
    if (!isset($_POST[$suffix]))
        $_POST[$suffix] = '';
}

///////////////////////////////////////////////////////////////
/// 関数呼び出しブロック
/////////////////////////////////////////////////////////////////


//配列にメンバーを$_POSTに取り出す
//すでにPOSTされていたら、DBからは取り出さない
if (
    isset($_GET['bid'])
    //cutilクラスのメンバ関数をスタティック呼出
    && cutil::is_number($_GET['bid'])
    && $_GET['bid'] > 0
) {
    $book_id = $_GET['bid'];
    if(!isset($_POST['func']) && isset($_GET['subid'])) {
        $_POST['func'] = 'edit';
    }
}

//$_POST優先
if (
    isset($_POST['book_id'])
    //cutilクラスのメンバ関数をスタティック呼出
    && cutil::is_number($_POST['book_id'])
    && $_POST['book_id'] > 0
) {
    $book_id = $_POST['book_id'];
}

if (isset($_POST['func'])) {
    switch ($_POST['func']) {
        case 'set':
            post_check();
            if (submitcheck::check(true,$_POST['submit_id'])) {
                if(paramchk() && file_upload()) {
                    file_delete();
                    submitcheck::delete(true);
                    regist();
                    //regist()内でリダイレクトするので
                    //ここまで実行されればリダイレクト失敗
                    echo '登録に失敗しました。';
                    exit;
                }
            }else {
                echo '二重サブミットを検出しました。新規または編集ボタンを押して作業を進めてください。';
                exit;
            }
            if($_POST['is_up_img'] == 1) {
                $_POST['image_link'] = $_POST['image_def'];
            }
            $_POST['func'] = 'edit';
            //システムに問題のあるエラー
            $err_flag = true;
            break;
        case 'del':
            post_check();
            file_delete();
            deljob();
            //deljob()内でリダイレクトするので
            //ここまで実行されればリダイレクト失敗
            echo '削除に失敗しました。';
            exit;
            break;
        case 'edit':
            if ($book_id > 0) {
                if(isset($_GET['subid'])) {
                    if(submitcheck::check(true,$_GET['subid']) && ($_POST = $db_obj->get_tgt(false, $book_id)) !== false) {
                        link_processing();
                        $_POST['func'] = 'edit';
                        break;
                    }
                }else {
                    cutil::redirect_exit($_SERVER['PHP_SELF'] . '?bid=' . $book_id . '&subid=' . submitcheck::generate_id(true) );
                }
            }
            cutil::redirect_exit('book_list.php');
        default:
            //通常はありえない
            echo '原因不明のエラーです。';
            exit;
            break;
    }
} else {
    if ($book_id <= 0 || ($_POST = $db_obj->get_tgt(false, $book_id)) === false) {
        if(!isset($_GET['subid'])) {
            cutil::redirect_exit($_SERVER['PHP_SELF'] . '?subid=' . submitcheck::generate_id(true));
        }else if(!submitcheck::check(true,$_GET['subid'])) {
            cutil::redirect_exit('book_list.php');
        }else if($book_id != 0) {
            $book_id = 0;
        }
        post_check();
        $_POST['func'] = 'edit';
    }else {
        link_processing();
    }
}

assign_process();
assign_err_flag();

//Smartyを使用した表示(テンプレートファイルの指定)
if (isset($_POST['func']) && $_POST['func'] == 'edit') {
    if($book_id <= 0) {
        $smarty->assign('button','追加');
        $smarty->assign('back','book_list.php');
    }else {
        $smarty->assign('button','更新');
        $smarty->assign('back','book_detail.php?bid=' . $book_id);
    }
    $smarty->assign('submit_id',$_GET['subid']);
    $smarty->display('admin/book_detail_edit.tmpl');
}else {
    $smarty->display('admin/book_detail.tmpl');
}
?>
