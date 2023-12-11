<?php
/*!
@file member_detail_smarty.php
@brief ユーザー詳細(Smarty版)
@copyright Copyright (c) 2017 Yamanoi Yasushi.
*/

/////////////////////////////////////////////////////////////////
/// 実行ブロック
/////////////////////////////////////////////////////////////////

//ライブラリをインクルード
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
//以下はセッション管理用のインクルード
require_once($CMS_COMMON_INCLUDE_DIR . "auth_adm.php");


$user_id = 0;
$err_array = array();
$err_flag = 0;

$page = 0;
if(isset($_GET['page']) 
    && cutil::is_number($_GET['page'])
    && $_GET['page'] > 0){
    $page = $_GET['page'];
}

if(isset($_GET['mid']) 
//cutilクラスのメンバ関数をスタティック呼出
    && cutil::is_number($_GET['mid'])
    && $_GET['mid'] > 0){
    $user_id = $_GET['mid'];
}
//$_POST優先
if(isset($_POST['user_id']) 
//cutilクラスのメンバ関数をスタティック呼出
    && cutil::is_number($_POST['user_id'])
    && $_POST['user_id'] > 0){
    $member_id = $_POST['user_id'];
}
//メンバークラスを構築
$user_obj = new cuser();
//配列にメンバーを$_POSTに取り出す
//すでにPOSTされていたら、DBからは取り出さない

if(isset($_POST['func'])){
    switch($_POST['func']){
        case 'set':
            if(!paramchk()){
                $_POST['func'] = 'edit';
                $err_flag = 1;
            }
            else{
                regist();
                //regist()内でリダイレクトするので
                //ここまで実行されればリダイレクト失敗
                $_POST['func'] = 'edit';
                //システムに問題のあるエラー
                $err_flag = 2;
            }
        case 'conf':
            if(!paramchk()){
                $_POST['func'] = 'edit';
                $err_flag = 1;
            }
        break;
        case 'edit':
            //戻るボタン。
        break;
        default:
            //通常はありえない
            echo '原因不明のエラーです。';
            exit;
        break;
    }
}
else{
    if($user_id > 0){
        if(($_POST = $user_obj->get_tgt(false,$user_id)) === false){
            $_POST['func'] = 'new';
       }
        else{
			$_POST['enc_password'] = '';
			$_POST['enc_password_chk'] = $_POST['enc_password'];
            $_POST['fruits'] = $member_obj->get_all_fruits_match(false,$member_id);
            $_POST['func'] = 'edit';
        }
    }
    else{
        //新規の入力フォーム
        $_POST['func'] = 'new';
    }
}





//--------------------------------------------------------------------------------------
/*!
@brief  エラー存在のアサイン
@return なし
*/
//--------------------------------------------------------------------------------------
function assign_err_flag(){
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_flag;
    $str = '';
    switch($err_flag){
        case 1:
        $str =<<<END_BLOCK

<p class="red">入力エラーがあります。各項目のエラーを確認してください。</p>
END_BLOCK;
        break;
        case 2:
        $str =<<<END_BLOCK

<p class="red">更新に失敗しました。サポートを確認下さい。</p>
END_BLOCK;
        break;
    }
    $smarty->assign('err_flag',$str);
}

//--------------------------------------------------------------------------------------
/*!
@brief  パラメータのチェック
@return エラーの場合はfalseを返す
*/
//--------------------------------------------------------------------------------------
function paramchk(){
    global $err_array;
    global $user_id;
    $retflg = true;
    /// メンバー名の存在と空白チェック
    if(ccontentsutil::chkset_err_field($err_array,'user_name','ユーザー名','isset_nl')){
        $retflg = false;
    }
////////////////////////////////////////////////////////////
	if(ccontentsutil::chkset_err_field($err_array,'mail','メールアドレス','isset_mail   ')){
		$retflg = false;
	}
////////////////////////////////////////////////////////////
	if($user_id == 0 && $_POST['password'] == ''){
		if(ccontentsutil::chkset_err_field($err_array,'password','パスワード','isset_pass')){
			$retflg = false;
		}
		if(ccontentsutil::chkset_err_field($err_array,'password_chk','パスワード確認','isset_pass')){
			$retflg = false;
		}
		else if($_POST['password'] != $_POST['password_chk']){
			$err_array['password_chk'] = "「パスワード確認」が「パスワード」と違っています。";
			$retflg = false;
		}
	}
	if($user_id > 0 && $_POST['password'] != ''){
		if(ccontentsutil::chkset_err_field($err_array,'password','パスワード','isset_pass')){
			$retflg = false;
		}
		if(ccontentsutil::chkset_err_field($err_array,'password_chk','パスワード確認','isset_pass')){
			$retflg = false;
		}
		else if($_POST['password'] != $_POST['password_chk']){
			$err_array['password_chk'] = "「パスワード確認」が「パスワード」と違っています。";
			$retflg = false;
		}
	}

    
    /// ユーザー住所の存在と空白チェック
    if(ccontentsutil::chkset_err_field($err_array,'address','住所','isset_nl')){
        $retflg = false;
    }

     /// ユーザー住所の存在と空白チェック
     if(ccontentsutil::chkset_err_field($err_array,'phone_num','電話番号','isset_nl')){
        $retflg = false;
    }


//print_r($err_array);

    return $retflg;
}



//--------------------------------------------------------------------------------------
/*!
@brief  メールの送信
@return なし
*/
//--------------------------------------------------------------------------------------
function send_mail_job(){
    $Subject = '【メンバーデータが更新されました】';
$BaseMessage=<<<END_BLOCK
メンバーデータが更新されました

【更新日時】
<!--date-->

【更新メンバー】
<!--member_name-->


【更新管理者】
<!--admin_name-->


以上
END_BLOCK;


    $date_data = date('Y/m/d H:i:s');
    $BaseMessage = str_replace('<!--date-->',$date_data,$BaseMessage);
    $BaseMessage = str_replace('<!--member_name-->',$_POST['member_name'],$BaseMessage);
    $BaseMessage = str_replace('<!--admin_name-->',$_SESSION['j2020tmY_adm']['admin_name'],$BaseMessage);

    $Message = $BaseMessage;
    //通常はFromは管理者メルアドを設定する
    //あるいは送信元メルアドをPOSTから得る
    $Headers = "From: " . 'aaa@bbb.cc' . "\r\n";
    $Headers .= "Content-Type: text/plain;";
    $Message .= "\r\n";
    //通常は$Toは管理者メルアドを設定する
    //つまり「管理者」から「管理者」に送るメールとして送信する
    $To = 'aaa@bbb.cc';
/*
メール送信は実際に送信する前に、何度もデバッグをすべきである
そのため、以下のデバッグロジックを実装しておいて、確認の上、コメントにする
*/


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
exit;


   //本番送信
//改行が2重になる場合は以下行を生かす
//  $Message = str_replace("\r","",$Message);
//以下のコメントを外すときは慎重に

//	mb_send_mail($To, $Subject, $Message, $Headers);

}


//--------------------------------------------------------------------------------------
/*!
@brief  メンバーデータの追加／更新。保存後自分自身を再読み込みする。
@return なし
*/
//--------------------------------------------------------------------------------------
function regist(){
    global $user_id;
    $dataarr = array();
    //パスワードが変更さえているかを確認する
    if($user_id > 0){
        $obj = new cuser();
        $arr = $obj->get_tgt(false,$user_id);
        if($arr['password'] != ''){
            //変更された
            $_POST['password'] = cutil::pw_encode($_POST['password']);
        }
    }
    else{
        //新規
        $_POST['password'] = cutil::pw_encode($_POST['password']);
    }
    $dataarr['user_name'] = (string)$_POST['user_name'];
    $dataarr['mail'] = (string)$_POST['mail'];
    $dataarr['password'] = (string)$_POST['password'];
   
    $dataarr['address'] = (string)$_POST['address'];
  
    $dataarr['phone_num'] = (string)$_POST['phone_num'];
    $chenge = new cchange_ex();
    if($user_id > 0){
        $chenge->update(false,'user_table',$dataarr,'user_id=' . $user_id);
        
		//メール送信の場合はコメント外す
		//send_mail_job();
        cutil::redirect_exit($_SERVER['PHP_SELF'] . '?mid=' . $user_id);
    }
    else{
        $mid = $chenge->insert(false,'user_table',$dataarr);
    
        
		//メール送信の場合はコメント外す
		//send_mail_job();
        cutil::redirect_exit($_SERVER['PHP_SELF'] . '?mid=' . $mid);
    }
}
//--------------------------------------------------------------------------------------
/*!
@brief  ページの出力(一覧に戻るリンク用)
@return なし
*/
//--------------------------------------------------------------------------------------
function assign_page(){
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $page;
    $pagestr = '';
    if($page > 0){
        $pagestr =  '?page=' . $page;
    }
    $smarty->assign('page',$pagestr);
}

//--------------------------------------------------------------------------------------
/*!
@brief  メンバーIDのアサイン
@return なし
*/
//--------------------------------------------------------------------------------------
function assign_user_id(){
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $user_id;
    $smarty->assign('user_id',$user_id);
}

//--------------------------------------------------------------------------------------
/*!
@brief  メンバーIDのアサイン(新規の場合は「新規」)
@return なし
*/
//--------------------------------------------------------------------------------------
function assign_user_id_txt(){
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $user_id;
    if($user_id <= 0){
        $smarty->assign('user_id_txt','新規');
    }
    else{
        $smarty->assign('user_id_txt',$user_id);
    }
}


function assign_user_name()
{
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_array;
    if (!isset($_POST['user_name']))
        $_POST['user_name'] = '';
    $smarty->assign('user_name', $_POST['user_name']);
}
function assign_mail()
{
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_array;
    if (!isset($_POST['mail']))
        $_POST['mail'] = '';
    $smarty->assign('mail', $_POST['mail']);
}

function assign_address()
{
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_array;
    if (!isset($_POST['address']))
        $_POST['address'] = '';
    $smarty->assign('address', $_POST['address']);
}

function assign_phone_num()
{
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_array;
    if (!isset($_POST['phone_num']))
        $_POST['phone_num'] = '';
    $smarty->assign('phone_num', $_POST['phone_num']);
}



//--------------------------------------------------------------------------------------



/////////////////////////////////////////////////////////////////
/// 関数呼び出しブロック
/////////////////////////////////////////////////////////////////
if(!isset($_POST['user_name']))$_POST['user_name'] = '';
if(!isset($_POST['mail']))$_POST['mail'] = '';
if(!isset($_POST['password']))$_POST['password'] = '';
if(!isset($_POST['password_chk']))$_POST['password_chk'] = '';
if(!isset($_POST['address']))$_POST['address'] = '';

if(!isset($_POST['phone_num']))$_POST['phone_num'] = '';
assign_err_flag();
assign_page();
assign_user_id();
assign_user_id_txt();
ssign_phone_num();
assign_address();
assign_mail();
assign_user_name(); 

$smarty->assign('err_array',$err_array);

//Smartyを使用した表示(テンプレートファイルの指定)
if(isset($_POST['func']) && $_POST['func'] == 'conf'){
    $button = '更新';
    if($member_id <= 0){
        $button = '追加';
    }
    $smarty->assign('button',$button);
    $smarty->display('admin/user_detail_conf.tmpl');
}
else{
    $smarty->display('admin/user_detail.tmpl');
}
?>
