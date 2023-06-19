<?php
/*!
@file member_detail_smarty.php
@brief メンバー詳細(Smarty版)
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


$member_id = 0;
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
    $member_id = $_GET['mid'];
}
//$_POST優先
if(isset($_POST['member_id']) 
//cutilクラスのメンバ関数をスタティック呼出
    && cutil::is_number($_POST['member_id'])
    && $_POST['member_id'] > 0){
    $member_id = $_POST['member_id'];
}
//メンバークラスを構築
$member_obj = new cmember();
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
    if($member_id > 0){
        if(($_POST = $member_obj->get_tgt(false,$member_id)) === false){
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
    if(!isset($_FILES[$imagefile]['name']) || $_FILES[$imagefile]['name'] == ""){
        return false;
    }
    if($_FILES[$imagefile]['error'] == 0){
        $ext_dot_str = strtolower(strrchr($_FILES[$imagefile]['name'],"."));
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
        $datastr = $subdir . $headstr . date("YmdHis") . strrchr($_FILES[$imagefile]['name'],".");
        $uppath = $CMS_FILEUP_DIR . $datastr;
        if (!move_uploaded_file($_FILES[$imagefile]['tmp_name'],
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
    global $member_id;
    $retflg = true;
    /// メンバー名の存在と空白チェック
    if(ccontentsutil::chkset_err_field($err_array,'member_name','メンバー名','isset_nl')){
        $retflg = false;
    }
////////////////////////////////////////////////////////////
	if(ccontentsutil::chkset_err_field($err_array,'member_login','ログイン','isset_pass')){
		$retflg = false;
	}
////////////////////////////////////////////////////////////
	if($member_id == 0 && $_POST['enc_password'] == ''){
		if(ccontentsutil::chkset_err_field($err_array,'enc_password','パスワード','isset_pass')){
			$retflg = false;
		}
		if(ccontentsutil::chkset_err_field($err_array,'enc_password_chk','パスワード確認','isset_pass')){
			$retflg = false;
		}
		else if($_POST['enc_password'] != $_POST['enc_password_chk']){
			$err_array['enc_password_chk'] = "「パスワード確認」が「パスワード」と違っています。";
			$retflg = false;
		}
	}
	if($member_id > 0 && $_POST['enc_password'] != ''){
		if(ccontentsutil::chkset_err_field($err_array,'enc_password','パスワード','isset_pass')){
			$retflg = false;
		}
		if(ccontentsutil::chkset_err_field($err_array,'enc_password_chk','パスワード確認','isset_pass')){
			$retflg = false;
		}
		else if($_POST['enc_password'] != $_POST['enc_password_chk']){
			$err_array['enc_password_chk'] = "「パスワード確認」が「パスワード」と違っています。";
			$retflg = false;
		}
	}

    /// メンバーの都道府県チェック
    if(ccontentsutil::chkset_err_field($err_array,'prefecture_id','都道府県','isset_num_range',1,47)){
        $retflg = false;
    }
    /// メンバー住所の存在と空白チェック
    if(ccontentsutil::chkset_err_field($err_array,'member_address','市区郡町村以下','isset_nl')){
        $retflg = false;
    }
    /// メンバーの性別チェック
    if(ccontentsutil::chkset_err_field($err_array,'member_gender','性別','isset_num_range',1,2)){
        $retflg = false;
    }

	//ファイルのアップロード
	//添付されてなくてもエラーは出さない
	$ext_arr = array();
	$ext_arr[] = '.jpg';
	$ext_arr[] = '.png';
	$subdir = '';
	upload('main_image',$ext_arr,$subdir,'main');

//print_r($err_array);

    return $retflg;
}

//--------------------------------------------------------------------------------------
/*!
@brief  フルーツデータの追加／更新
@return なし
*/
//--------------------------------------------------------------------------------------
function regist_fruits($member_id){
    $chenge = new cchange_ex();
    $chenge->delete(false,"fruits_match","member_id=" . $member_id);
		if(isset($_POST['fruits']) && is_array($_POST['fruits'])){
	    foreach($_POST['fruits'] as $key => $val){
	        $dataarr = array();
	        $dataarr['member_id'] = (int)$member_id;
	        $dataarr['fruits_id'] = (int)$val;
	        $chenge->insert(false,'fruits_match',$dataarr);
	    }
		}
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
    global $member_id;
    $dataarr = array();
    //パスワードが変更さえているかを確認する
    if($member_id > 0){
        $obj = new cmember();
        $arr = $obj->get_tgt(false,$member_id);
        if($arr['enc_password'] != ''){
            //変更された
            $_POST['enc_password'] = cutil::pw_encode($_POST['enc_password']);
        }
    }
    else{
        //新規
        $_POST['enc_password'] = cutil::pw_encode($_POST['enc_password']);
    }
    $dataarr['member_name'] = (string)$_POST['member_name'];
    $dataarr['member_login'] = (string)$_POST['member_login'];
    $dataarr['enc_password'] = (string)$_POST['enc_password'];
    $dataarr['main_image'] = (string)$_POST['main_image'];
    $dataarr['prefecture_id'] = (int)$_POST['prefecture_id'];
    $dataarr['member_address'] = (string)$_POST['member_address'];
    $dataarr['member_gender'] = (int)$_POST['member_gender'];
    $dataarr['member_comment'] = (string)$_POST['member_comment'];
    $chenge = new cchange_ex();
    if($member_id > 0){
        $chenge->update(false,'member',$dataarr,'member_id=' . $member_id);
        regist_fruits($member_id);
		//メール送信の場合はコメント外す
		//send_mail_job();
        cutil::redirect_exit($_SERVER['PHP_SELF'] . '?mid=' . $member_id);
    }
    else{
        $mid = $chenge->insert(false,'member',$dataarr);
        regist_fruits($mid);
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
function assign_member_id(){
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $member_id;
    $smarty->assign('member_id',$member_id);
}

//--------------------------------------------------------------------------------------
/*!
@brief  メンバーIDのアサイン(新規の場合は「新規」)
@return なし
*/
//--------------------------------------------------------------------------------------
function assign_member_id_txt(){
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $member_id;
    if($member_id <= 0){
        $smarty->assign('member_id_txt','新規');
    }
    else{
        $smarty->assign('member_id_txt',$member_id);
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


//--------------------------------------------------------------------------------------
/*!
@brief  都道府県プルダウンのアサイン
@return なし
*/
//--------------------------------------------------------------------------------------
function assign_prefecture_rows(){
    //$smartyをグローバル宣言（必須）
    global $smarty;
    //都道府県の一覧を取得
    $prefecture_obj = new cprefecture();
    $allcount = $prefecture_obj->get_all_count(false);
    $prefecture_rows = $prefecture_obj->get_all(false,0,$allcount);
    $smarty->assign('prefecture_rows',$prefecture_rows);
}
//--------------------------------------------------------------------------------------
/*!
@brief  好きな果物のアサイン
@return なし
*/
//--------------------------------------------------------------------------------------
function assign_fruits_rows(){
    //$smartyをグローバル宣言（必須）
    global $smarty;
    //フルーツの一覧を取得
    $fruits_obj = new cfruits();
    $fruits_rows = $fruits_obj->get_all(false);
    if(!isset($_POST['fruits']))$_POST['fruits'] = array();
    foreach($fruits_rows as $key => $val){
        if(array_search($val['fruits_id'],$_POST['fruits']) !== false){
            $fruits_rows[$key]['check'] = 1;
        }
        else{
            $fruits_rows[$key]['check'] = 0;
        }
    }
    $smarty->assign('fruits_rows',$fruits_rows);
}


/////////////////////////////////////////////////////////////////
/// 関数呼び出しブロック
/////////////////////////////////////////////////////////////////
if(!isset($_POST['member_name']))$_POST['member_name'] = '';
if(!isset($_POST['member_login']))$_POST['member_login'] = '';
if(!isset($_POST['enc_password']))$_POST['enc_password'] = '';
if(!isset($_POST['enc_password_chk']))$_POST['enc_password_chk'] = '';
if(!isset($_POST['main_image']))$_POST['main_image'] = '';
if(!isset($_POST['prefecture_id']))$_POST['prefecture_id'] = 0;
if(!isset($_POST['member_address']))$_POST['member_address'] = '';
if(!isset($_POST['member_gender']))$_POST['member_gender'] = 0;
if(!isset($_POST['member_comment']))$_POST['member_comment'] = '';
assign_err_flag();
assign_page();
assign_member_id();
assign_member_id_txt();
assign_updir();
assign_prefecture_rows();
assign_fruits_rows();
$smarty->assign('err_array',$err_array);

//Smartyを使用した表示(テンプレートファイルの指定)
if(isset($_POST['func']) && $_POST['func'] == 'conf'){
    $button = '更新';
    if($member_id <= 0){
        $button = '追加';
    }
    $smarty->assign('button',$button);
    $smarty->display('admin/member_detail_smarty_conf.tmpl');
}
else{
    $smarty->display('admin/member_detail_smarty.tmpl');
}
?>
