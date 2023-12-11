<?php
/*!
@file admin_detail.php
@brief  お問い合わせ詳細(管理画面)
@copyright Copyright (c) 2017 Yamanoi Yasushi.
*/
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
//以下はセッション管理用のインクルード
require_once($CMS_COMMON_INCLUDE_DIR . "auth_adm.php");


$inquiry_id = 0;
$err_array = array();
$err_flag = 0;



if (
    isset($_GET['mid'])
    //cutilクラスのメンバ関数をスタティック呼出
    && cutil::is_number($_GET['mid'])
    && $_GET['mid'] > 0
) {
    $inquiry_id = $_GET['mid'];
    if(!isset($_POST['func']) && isset($_GET['sumid'])) {
        $_POST['func'] = 'edit';
    }
    
}
//$_POST優先
if (
    isset($_POST['inquiry_id'])
    //cutilクラスのメンバ関数をスタティック呼出
    && cutil::is_number($_POST['inquiry_id'])
    && $_POST['inquiry_id'] > 0
) {
    $inquiry_id = $_POST['inquiry_id'];
}


//お問い合わせクラスを構築
$inquiry_obj = new cinquiry();
//配列に管理者を$_POSTに取り出す
//すでにPOSTされていたら、DBからは取り出さない


if (isset($_POST['func'])) {
    switch ($_POST['func']) {
        case 'conf':
            if (!paramchk()) {
                $_POST['func'] = 'edit';
                $err_flag = 1;
            } else {
                regist();
                //regist()内でリダイレクトするので
                //ここまで実行されればリダイレクト失敗
                $_POST['func'] = 'edit';
                //システムに問題のあるエラー
                $err_flag = 2;
            }
        case 'edit':
            //戻るボタン。
            break;
        default:
            //通常はありえない
            echo '原因不明のエラーです。';
            exit;
            break;
    }
} else {
    if ($inquiry_id > 0) {
        if (($_POST = $inquiry_obj->get_tgt(false, $inquiry_id)) === false) {
            $_POST['func'] = 'new';
        } else {
            $_POST['func'] = 'edit';
        }
    } else {
        //新規の入力フォーム
        $_POST['func'] = 'new';
    }
}

//▲▲▲▲▲▲実行ブロック▲▲▲▲▲▲
//▼▼▼▼▼▼関数ブロック▼▼▼▼▼▼

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
    switch ($err_flag) {
        case 1:
            $str = <<<END_BLOCK

入力エラーがあります。各項目のエラーを確認してください。
END_BLOCK;
            break;
        case 2:
            $str = <<<END_BLOCK

更新に失敗しました。サポートを確認下さい。
END_BLOCK;
            break;
    }
    $smarty->assign('err_flag', $str);
}


//--------------------------------------------------------------------------------------
/*!
@brief  パラメータのチェック
@return エラーの場合はfalseを返す
*/
//--------------------------------------------------------------------------------------
function paramchk()
{
    global $err_array;
    global $inquiry_id;
    $retflg = true;
    ////////////////////////////////////////////////////////////
    if (ccontentsutil::chkset_err_field($err_array, 'inquiry_name', '名前', 'isset_nl')) {
        $retflg = false;
    }
    ////////////////////////////////////////////////////////////

    if (ccontentsutil::chkset_err_field($err_array, 'inquiry_mail', 'メールアドレス', 'isset_mail')) {
        $retflg = false;
    }

    if (ccontentsutil::chkset_err_field($err_array, 'inquiry_comment', 'お問い合わせ内容', 'isset_nl')) {
        $retflg = false;
    }



    return $retflg;
}



//--------------------------------------------------------------------------------------
/*!
@brief  管理者データの追加／更新。保存後自分自身を再読み込みする。
@return なし
*/
//--------------------------------------------------------------------------------------
function regist()
{
    global $inquiry_id;
 
    $dataarr = array();
    $dataarr['reply'] = (string) $_POST['reply'];
    $dataarr['reply_title'] = (string) $_POST['reply_title'];
    $dataarr['is_reply'] = 1;

    $chenge = new cchange_ex();
    if ($inquiry_id > 0) {
        $chenge->update(false, 'inquiry_table', $dataarr, 'inquiry_id=' . $inquiry_id);
        send_mail_job2();
        cutil::redirect_exit($_SERVER['PHP_SELF'] . '?mid=' . $inquiry_id);
    } else {
        $mid = $chenge->insert(false, 'inquiry_table', $dataarr);
        send_mail_job2();
        cutil::redirect_exit($_SERVER['PHP_SELF'] . '?mid=' . $mid);
    }
}
//--------------------------------------------------------------------------------------
/*!
@brief  削除
@return なし
*/
//--------------------------------------------------------------------------------------
function deljob()
{
    $chenge = new cchange_ex();
    if ($_POST['param'] > 0) {
        $chenge->delete(true, "inquiry_table", "inquiry_id=" . $_POST['param']);
    }
}
//--------------------------------------------------------------------------------------
/*!
@brief  メールの送信
@return なし
*/
//--------------------------------------------------------------------------------------


//--------------------------------------------------------------------------------------
/*!
@brief  管理者IDのアサイン
@return なし
*/
//--------------------------------------------------------------------------------------
function assign_inquiry_id()
{
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $inquiry_id;
    $smarty->assign('inquiry_id', $inquiry_id);
}

//--------------------------------------------------------------------------------------
/*!
@brief  管理者IDのアサイン(新規の場合は「新規」)
@return なし
*/
//--------------------------------------------------------------------------------------
function assign_inquiry_id_txt()
{
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $inquiry_id;
    if ($inquiry_id <= 0) {
        $smarty->assign('inquiry_id_txt', '新規');
    } else {
        $smarty->assign('inquiry_id_txt', $inquiry_id);
    }
}

//名前のアサイン
function assign_inquiry_name()
{
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_array;
    if (!isset($_POST['inquiry_name']))
        $_POST['inquiry_name'] = '';
    $smarty->assign('inquiry_name', $_POST['inquiry_name']);
}

//メールアドレスのアサイン
function assign_inquiry_mail()
{
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_array;
    if (!isset($_POST['inquiry_mail']))
        $_POST['inquiry_mail'] = '';
    $smarty->assign('inquiry_mail', $_POST['inquiry_mail']);
}

//お問い合わせ内容のアサイン
function assign_inquiry_comment()
{
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_array;
    if (!isset($_POST['inquiry_comment']))
        $_POST['inquiry_comment'] = '';
    $smarty->assign('inquiry_comment', $_POST['inquiry_comment']);
}

function assign_inquiry_tittle()
{
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_array;
    if (!isset($_POST['inquiry_title']))
        $_POST['inquiry_title'] = '';
    $smarty->assign('inquiry_title', $_POST['inquiry_title']);
}

function assign_reply()
{
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_array;
    if (!isset($_POST['reply']))
        $_POST['reply'] = '';
    $smarty->assign('reply', $_POST['reply']);
}

function assign_is_reply() {
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_array;
    if (!isset($_POST['is_reply']))
        $_POST['is_reply'] = 0;
    $smarty->assign('is_reply', $_POST['is_reply']);
}

function assign_reply_title()
{
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_array;
    if (!isset($_POST['reply_title']))
        $_POST['reply_title'] = '';
    $smarty->assign('reply_title', $_POST['reply_title']);
}

function assign_inquiry_tel()
{
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_array;
    if (!isset($_POST['inquiry_tel']))
        $_POST['inquiry_tel'] = '';
    $smarty->assign('inquiry_tel', $_POST['inquiry_tel']);
}

function assign_inquiry_kana()
{
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_array;
    if (!isset($_POST['inquiry_kana']))
        $_POST['inquiry_kana'] = '';
    $smarty->assign('inquiry_kana', $_POST['inquiry_kana']);
}


function assign_mail()
{
    global $smarty;
    $user = new cuser;
    $row = $user->get_tgt(false, $_SESSION['tmD2023_adm']['admin_master_id']);

    if ($row === false || !isset($row['mail'])) {
        $smarty->assign('mail', '');
    } else {
        $smarty->assign('mail', $row['mail']);
    }
}




function send_mail_job()
{
    // メール送信処理
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['func']) && $_POST['func'] === 'conf') {
        // 必要な値を取得
        $to = $_POST['inquiry_mail'];
        $from = $_POST['mail'];
        $subject = $_POST['reply_title'];
        $message = $_POST['reply'];

        // 送信者のメールアドレスが空でないことを確認
        if (empty($from)) {
            die("送信者のメールアドレスが未入力です。");
        }

        // 件名が空でないことを確認
        if (empty($subject)) {
            die("件名が未入力です。");
        }

        // メッセージが空でないことを確認
        if (empty($message)) {
            die("返信内容が未入力です。");
        }

        // メールを送信する処理
        $headers = "From: $from" . "\r\n" .
            "Reply-To: $from" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            echo "メールが送信されました。";
        } else {
            echo "メールの送信に失敗しました。";
        }
    }
}

//--------------------------------------------------------------------------------------
/*!
@brief  メールの送信
@return なし
*/
//--------------------------------------------------------------------------------------
function send_mail_job2(){
    $Subject = '【<!--reply_title-->】';
$BaseMessage=<<<END_BLOCK




大竹　陽輝 様




<!--reply-->


お客様の問題を迅速に解決するため、サポートチームが全力でサポートいたします。引き続き、ご協力いただけますようお願い申し上げます。
何かご質問やご不明な点がございましたら、お気軽にお知らせください。
お客様のサポートを心よりお待ちしております。

【更新日時】
<!--date-->

【更新管理者】
<!--admin_name-->

株式会社 ぶんごう！
所在地： 〒963-8811 福島県郡山市方八町２丁目４−１５
TEL :  024-956-0030




以上
END_BLOCK;


    $date_data = date('Y/m/d H:i:s');
    $BaseMessage = str_replace('<!--reply-->',$_POST['reply'],$BaseMessage);
    $Subject = str_replace('<!--reply_title-->',$_POST['reply_title'],$Subject);
    $BaseMessage = str_replace('<!--date-->',$date_data,$BaseMessage);
    $BaseMessage = str_replace('<!--admin_name-->',$_SESSION['tmD2023_adm']['admin_name'],$BaseMessage);

    $Message = $BaseMessage;
    //通常はFromは管理者メルアドを設定する
    //あるいは送信元メルアドをPOSTから得る
    $Headers = "From: " . 'test@example.com' . "\r\n";
    $Headers .= "Content-Type: text/plain;";
    $Message .= "\r\n";
    //通常は$Toは管理者メルアドを設定する
    //つまり「管理者」から「管理者」に送るメールとして送信する
    $To =  $_POST['inquiry_mail'];
/*
メール送信は実際に送信する前に、何度もデバッグをすべきである
そのため、以下のデバッグロジックを実装しておいて、確認の上、コメントにする
      
$debugstr=<<<END_BLOCK
<br />///////メールデバッグここから/////////<br />
<br />送信されるタイトル<br />
{$Subject}
<br />本文メッセージ<br />
{$Message}
<br />ヘッダ<br />
{$Headers}
<br />送信先<br />
{$To}
<br />
<br />/////////メールデバッグここまで//////////<br />

END_BLOCK;
echo $debugstr;
*/
    if (mb_send_mail($To, $Subject, $Message, $Headers)) {
        echo "メールが送信されました。";
    } else {
        echo "メールの送信に失敗しました。";
    }
    
   //本番送信
//改行が2重になる場合は以下行を生かす
//$Message = str_replace("\r","",$Message);
//以下のコメントを外すときは慎重に

//mb_send_mail($To, $Subject, $Message, $Headers);

}
/////////////////////////////////////////////////////////////////
/// 関数呼び出しブロック
/////////////////////////////////////////////////////////////////
if (!isset($_POST['inquiry_name']))
    $_POST['inquiry_name'] = '';
if (!isset($_POST['inquiry_comment']))
    $_POST['inquiry_comment'] = '';
if (!isset($_POST['inquiry_mail']))
    $_POST['inquiry_mail'] = '';
if (!isset($_POST['reply']))
    $_POST['reply'] = '';


assign_err_flag();
assign_inquiry_id();
assign_inquiry_id_txt();
assign_inquiry_name();
assign_inquiry_mail();
assign_inquiry_comment();
assign_reply();
assign_is_reply();
assign_mail();
assign_reply_title();
assign_inquiry_tittle();
assign_inquiry_kana();
assign_inquiry_tel();

//Smartyを使用した表示(テンプレートファイルの指定)
if (isset($_POST['func']) && $_POST['func'] == 'conf') {
    if($inquiry_id <= 0) {
        $smarty->assign('button','追加');
        $smarty->assign('back','inquiry_list.php');
    }else {
        $smarty->assign('button','更新');
        $smarty->assign('back','inquiry_detail.php?mid=' . $inquiry_id);
    }
  
    $smarty->display('admin/inquiry_detail_conf.tmpl');
} else {
    $smarty->display('admin/inquiry_detail.tmpl');
   
}


?>