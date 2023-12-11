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
require_once($CMS_COMMON_INCLUDE_DIR . "fileupload.php");


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
    $user_id = $_POST['user_id'];
}
//メンバークラスを構築
$user_obj = new cuser();
//配列にメンバーを$_POSTに取り出す
//すでにPOSTされていたら、DBからは取り出さない

if(isset($_POST['func'])){
    switch($_POST['func']){
        case 'set':
            if(!paramchk()){
                $_POST['func'] = 'set';
                $err_flag = 1;
            }else if((new cuser())->get_tgt_login(false,$_POST['mail']) !== false) {
                $_POST['func'] = 'set';
                $err_flag = 3;
            }else {
                regist();
                //regist()内でリダイレクトするので
                //ここまで実行されればリダイレクト失敗
                $_POST['func'] = 'edit';
                //システムに問題のあるエラー
                $err_flag = 2;
            }
            break;
        case 'ctype':
            if(!isset($_POST['is_admin'])){
                $_POST['func'] = 'edit';
                $err_flag = 1;
            }
            else if($user_id > 0){
                $dataarr = array();
                $dataarr['is_admin'] = (string)$_POST['is_admin'];
                $chenge = new cchange_ex();
                $chenge->update(false,'user_table',$dataarr,'user_id=' . $user_id);
                cutil::redirect_exit($_SERVER['PHP_SELF'] . '?mid=' . $user_id);
            }
            break;
        case 'conf':
            if(!paramchk()){
                $_POST['func'] = 'set';
                $err_flag = 1;
            }else if((new cuser())->get_tgt_login(false,$_POST['mail']) !== false) {
                $_POST['func'] = 'set';
                $err_flag = 3;
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
			
            $_POST['func'] = 'edit';
        }
    }
    else{
        //新規の入力フォーム
        $_POST['func'] = 'new';
    }
}
/////////////////////////////////////////////////////////////////
/// 関数ブロック
/////////////////////////////////////////////////////////////////
//--------------------------------------------------------------------------------------
/*!
@brief  ファイルアップエラーの取得
@param[in]  $upfile  イメージ変数名
@return エラー文字列
*/
//--------------------------------------------------------------------------------------
function get_upload_err($upfile){
	$str = '';
    switch($_FILES[$upfile]['error']){
        case 1:
        case 2:
            $str = "アップロードされたファイルサイズが上限を越えています。\n";
        break;
        case 3:
            $str = "アップロードされたファイルは一部しかアップロードされませんでした。\n";
        break;
        case 4:
            $str = "画像ファイルはアップロードされませんでした\n";
        break;
        case 6:
            $str = "テンポラリフォルダがありません。管理者に連絡して下さい。\n";
        break;
        case 7:
            $str = "テンポラリファイルへのディスク書き込みに失敗しました。管理者に連絡して下さい。\n";
        break;
        default:
            $str = "原因不明のエラーです。管理者に連絡して下さい。\n";
        break;
    }
    return $str;
}


//--------------------------------------------------------------------------------------
/*!
@brief  ファイルのアップロード
@param[in]  $imagefile  イメージ変数名
@param[in]  $pathext  アップロードを許可する拡張子名（ドットも含める。半角小文字で記述）
@param[in]  $subdir  サブディレクトリ('2017/')など
@param[in]  $headstr  先頭につける文字列
@return 成功すればtrue
*/
//--------------------------------------------------------------------------------------
function upload($imagefile,$pathext,$subdir,$headstr){
    global $err_array;
    global $CMS_FILEUP_DIR;
    if(!isset($_FILES[$imagefile]['icon_img']) || $_FILES[$imagefile]['icon_img'] == ""){
        return false;
    }
    if($_FILES[$imagefile]['error'] == 0){
        $ext_dot_str = strtolower(strrchr($_FILES[$imagefile]['icon_img'],"."));
		$okflg = false;
		foreach($pathext as $key => $val){
			if($ext_dot_str == $val){
				$okflg = true;
				break;
			}
		}
		if(!$okflg){
			$err_array[$imagefile] = "アップロードファイルの種類が許可されてません";
			return false;
		}
        //保存されるファイル名は目的に合わせて変更する
        $datastr = $subdir . $headstr . date("YmdHis") . strrchr($_FILES[$imagefile]['icon_img'],".");
        $uppath = $CMS_FILEUP_DIR . $datastr;
        if (!move_uploaded_file($_FILES[$imagefile]['tmp_icon_img'],
            $uppath)) {
            $err_array[$imagefile] .= "アップロードに失敗しました";
            return false;
        }
        else{
            chmod($uppath,0646);
            //アップロードされたファイルをPOST変数に入れる
            //データベースに登録する場合は、この変数を使う
            $_POST[$imagefile] = $datastr;
            return true;
        }
    }
    else{
        $err_array[$imagefile] = get_upload_err($imagefile);
        return false;
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
        case 3:
            $str =<<<END_BLOCK
    
<p class="red">このメールアドレスは既に登録されています。</p>
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
    $retflg = true;
    /// メンバー名の存在と空白チェック
    if(ccontentsutil::chkset_err_field($err_array,'user_name','ユーザー名','isset_nl')){
        $retflg = false;
    }
////////////////////////////////////////////////////////////
	if(ccontentsutil::chkset_err_field($err_array,'mail','メールアドレス','isset_mailx')){
		$retflg = false;
	}
    
////////////////////////////////////////////////////////////
	if(ccontentsutil::chkset_err_field($err_array,'password','パスワード','isset_pass')){
		$retflg = false;
	}
	else if($_POST['password'] != $_POST['password_chk']){
		$err_array['password_chk'] = "「パスワード確認」が「パスワード」と違っています。";
		$retflg = false;
	}
    /// メンバーの性別チェック
    if(ccontentsutil::chkset_err_field($err_array,'is_admin','アカウントタイプ','isset_num_range',0,1)){
        $retflg = false;
    }

    

    global $CMS_FILEUP_DIR;
	
    $result =(new fileupload())->upload(
        'icon_img',
        2097152,
        array(".png",".jfif",".pjpeg",".jpeg",".pjp",".jpg",".gif"),
        'icon_img/',
        '',
        $CMS_FILEUP_DIR,
        $err_array
    );
    if($result!==false){
        $_POST['icon_img']=$result;
    }else{
        $retflg==false; 
    }
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
    $dataarr['icon_img'] = (string)$_POST['icon_img'];
    $dataarr['address'] = (string)$_POST['address'];
    $dataarr['is_admin'] = (string)$_POST['is_admin'];
    $dataarr['phone_num'] = (string)$_POST['phone_num'];
    $dataarr['post_code'] = (string)$_POST['post_code'];
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
@brief  ページの出力()
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

//--------------------------------------------------------------------------------------
/*!
@brief  イメージディレクトリのアサイン
@return なし
*/
//--------------------------------------------------------------------------------------
function assign_updir(){
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $CMS_FILEUP_DIR;
    $smarty->assign('updir',$CMS_FILEUP_DIR);
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

function assign_post_code()
{
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_array;
    if (!isset($_POST['post_code']))
        $_POST['post_code'] = '';
    $smarty->assign('post_code', $_POST['post_code']);
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
if(!isset($_POST['post_code']))$_POST['post_code'] = '';
if(!isset($_POST['phone_num']))$_POST['phone_num'] = '';
if(!isset($_POST['icon_img']))$_POST['icon_img'] = '';
if(!isset($_POST['is_admin']))$_POST['is_admin'] = 0;


assign_err_flag();
assign_page();  
assign_user_id();
assign_user_id_txt();
assign_phone_num();
assign_address();
assign_mail();
assign_user_name();
assign_post_code();
assign_updir();

$smarty->assign('err_array',$err_array);

if(isset($_POST['func']) && $_POST['func'] == 'edit') {
    $smarty->display('admin/user_detail_edit.tmpl');
    exit;
}

//Smartyを使用した表示(テンプレートファイルの指定)
if(isset($_POST['func']) && $_POST['func'] == 'conf'){
    $button = '更新';
    if($user_id <= 0){
        $button = '追加';
    }
    $smarty->assign('button',$button);
    $smarty->display('admin/user_detail_conf.tmpl');
}
else{
    $smarty->display('admin/user_detail.tmpl');
}
?>
