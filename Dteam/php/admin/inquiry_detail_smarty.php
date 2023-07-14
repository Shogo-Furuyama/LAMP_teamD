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


if(isset($_GET['aid']) 
//cutilクラスのメンバ関数をスタティック呼出
	&& cutil::is_number($_GET['aid'])
	&& $_GET['aid'] > 0){
	$inquiry_id = $_GET['aid'];
}
//$_POST優先
if(isset($_POST['inquiry_id']) 
//cutilクラスのメンバ関数をスタティック呼出
	&& cutil::is_number($_POST['inquiry_id'])
	&& $_POST['inquiry_id'] > 0){
	$inquiry_id = $_POST['inquiry_id'];
}

//お問い合わせクラスを構築
$inquiry_obj = new cinquiry();
//配列に管理者を$_POSTに取り出す
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
    if($inquiry_id > 0){
		if(($_POST = $inquiry_obj->get_tgt(false,$inquiry_id)) === false){
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

//▲▲▲▲▲▲実行ブロック▲▲▲▲▲▲
//▼▼▼▼▼▼関数ブロック▼▼▼▼▼▼

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

入力エラーがあります。各項目のエラーを確認してください。
END_BLOCK;
		break;
		case 2:
		$str =<<<END_BLOCK

更新に失敗しました。サポートを確認下さい。
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
	global $inquiry_id;
	$retflg = true;
////////////////////////////////////////////////////////////
	if(ccontentsutil::chkset_err_field($err_array,'inquiry_name','名前','isset_nl')){
		$retflg = false;
	}
////////////////////////////////////////////////////////////
	
	if(ccontentsutil::chkset_err_field($err_array,'inquiry_mail','メールアドレス','isset_pass')){
		$retflg = false;
	}
	
	if(ccontentsutil::chkset_err_field($err_array,'inquiry_comment','お問い合わせ内容','isset_pass')){
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
function regist(){
    global $inquiry_id;
    //パスワードが変更さえているかを確認する
    
    $dataarr = array();
    $dataarr['inquiry_name'] = (string)$_POST['inquiry_name'];
    $dataarr['inquiry_comment'] = (string)$_POST['inquiry_comment'];
	$dataarr['inquiry_mail'] = (string)$_POST['inquiry_mail'];
    
    $chenge = new cchange_ex();
    if($inquiry_id > 0){
        $chenge->update(false,'inquiry_table',$dataarr,'inquiry_id=' . $inquiry_id);
        cutil::redirect_exit($_SERVER['PHP_SELF'] . '?aid=' . $inquiry_id);
    }
    else{
        $aid = $chenge->insert(false,'inquiry_table',$dataarr);
        cutil::redirect_exit($_SERVER['PHP_SELF'] . '?aid=' . $aid);
    }
}

//--------------------------------------------------------------------------------------
/*!
@brief  管理者IDのアサイン
@return なし
*/
//--------------------------------------------------------------------------------------
function assign_inquiry_id(){
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $inquiry_id;
    $smarty->assign('inquiry_id',$inquiry_id);
}

//--------------------------------------------------------------------------------------
/*!
@brief  管理者IDのアサイン(新規の場合は「新規」)
@return なし
*/
//--------------------------------------------------------------------------------------
function assign_inquiry_id_txt(){
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $inquiry_id;
    if($inquiry_id <= 0){
        $smarty->assign('inquiry_id_txt','新規');
    }
    else{
        $smarty->assign('inquiry_id_txt',$inquiry_id);
    }
}

//名前のアサイン
function assign_inquiry_name(){
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_array;

if(!isset($_POST['inquiry_name']))$_POST['inquiry_name'] = '';
	$smarty->assign('inquiry_name',$_POST['inquiry_name']);


    }

//メールアドレスのアサイン
function assign_inquiry_mail(){
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_array;

if(!isset($_POST['inquiry_mail']))$_POST['inquiry_mail'] = '';
	$smarty->assign('inquiry_mail',$_POST['inquiry_mail']);


    }
//お問い合わせ内容のアサイン
function assign_inquiry_comment(){
    //$smartyをグローバル宣言（必須）
    global $smarty;
    global $err_array;

if(!isset($_POST['inquiry_comment']))$_POST['inquiry_comment'] = '';
	$smarty->assign('inquiry_comment',$_POST['inquiry_comment']);


}
/////////////////////////////////////////////////////////////////
/// 関数呼び出しブロック
/////////////////////////////////////////////////////////////////
if(!isset($_POST['inquiry_name']))$_POST['inquiry_name'] = '';
if(!isset($_POST['inquiry_comment']))$_POST['inquiry_comment'] = '';
if(!isset($_POST['inquiry_mail']))$_POST['inquiry_mail'] = '';

assign_err_flag();
assign_inquiry_id();
assign_inquiry_id_txt();
assign_inquiry_name();
assign_inquiry_mail();
assign_inquiry_comment();
$smarty->assign('err_array',$err_array);

//Smartyを使用した表示(テンプレートファイルの指定)
if(isset($_POST['func']) && $_POST['func'] == 'conf'){
    $button = '更新';
    if($inquiry_id <= 0){
        $button = '追加';
    }
    $smarty->assign('button',$button);
    $smarty->display('admin/admin_detail_conf_smarty.tmpl');
}
else{
    $smarty->display('admin/inquiry_detail_smarty.tmpl');
}


?>
