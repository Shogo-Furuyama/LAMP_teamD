<?php
/*!
@file prefecture_detail.php
@brief 都道府県詳細(Smarty版)
@copyright Copyright (c) 2017 Yamanoi Yasushi.
*/

//ライブラリをインクルード
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
//smartyクラスの初期化
require_once("inc_smarty.php");
//以下はセッション管理用のインクルード
require_once($CMS_COMMON_INCLUDE_DIR . "auth_adm.php");


$prefecture_id = 0;
$err_array = array();
$err_flag = 0;


if(isset($_GET['pid']) 
//cutilクラスのメンバ関数をスタティック呼出
	&& cutil::is_number($_GET['pid'])
	&& $_GET['pid'] > 0){
	$prefecture_id = $_GET['pid'];
}
//$_POST優先
if(isset($_POST['prefecture_id']) 
//cutilクラスのメンバ関数をスタティック呼出
	&& cutil::is_number($_POST['prefecture_id'])
	&& $_POST['prefecture_id'] > 0){
	$prefecture_id = $_POST['prefecture_id'];
}
//都道府県クラスを構築
$prefecture_obj = new cprefecture();
//配列に都道府県を$_POSTに取り出す
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
	if($prefecture_id > 0){
		if(($_POST = $prefecture_obj->get_tgt(false,$prefecture_id)) === false){
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

//エラー表示のアサイン
function assign_err_flag(){
	//$smartyをグローバル宣言（必須）
	global $smarty;
	global $err_flag;
	$errflag_str = '';
	switch($err_flag){
		case 1:
		$errflag_str =<<<END_BLOCK

<p class="red">入力エラーがあります。各項目のエラーを確認してください。</p>
END_BLOCK;
		break;
		case 2:
		$errflag_str =<<<END_BLOCK

<p class="red">更新に失敗しました。サポートを確認下さい。</p>
END_BLOCK;
		break;
	}
	$smarty->assign('err_flag',$err_flag);
}



/*パラメータのチェック
エラーの場合はfalseを返す*/
function paramchk(){
	global $err_array;
	global $prefecture_id;
	$retflg = true;
////////////////////////////////////////////////////////////
	if(ccontentsutil::chkset_err_field($err_array,'prefecture_name','都道府県名','isset_nl')){
		$retflg = false;
	}

	return $retflg;
}

//データ更新
function regist(){
	global $prefecture_id;
	$dataarr = array();
	$dataarr['prefecture_name'] = (string)$_POST['prefecture_name'];
	$chenge = new cchange_ex();
	if($prefecture_id > 0){
		$chenge->update(false,'prefecture',$dataarr,'prefecture_id=' . $prefecture_id);
		cutil::redirect_exit($_SERVER['PHP_SELF'] . '?pid=' . $prefecture_id);
	}
	else{
		$pid = $chenge->insert(false,'prefecture',$dataarr);
		cutil::redirect_exit($_SERVER['PHP_SELF'] . '?pid=' . $pid);
	}
}


//IDのアサイン
function assign_prefecture_id(){
	//$smartyをグローバル宣言（必須）
	global $smarty;
	global $prefecture_id;
	$smarty->assign('prefecture_id',$prefecture_id);
}

//IDのアサイン（新規対応）
function assign_prefecture_id_txt(){
	//$smartyをグローバル宣言（必須）
	global $smarty;
	global $prefecture_id;
	if($prefecture_id <= 0){
		$smarty->assign('prefecture_id_txt','新規');
	}
	else{
		$smarty->assign('prefecture_id_txt',$prefecture_id);
	}
}

//都道府県のアサイン
function assign_prefecture_name(){
	//$smartyをグローバル宣言（必須）
	global $smarty;
	global $err_array;
	if(!isset($_POST['prefecture_name']))$_POST['prefecture_name'] = '';
	$smarty->assign('prefecture_name',$_POST['prefecture_name']);
}


//▲▲▲▲▲▲関数ブロック▲▲▲▲▲▲


//▼▼▼▼▼▼関数呼び出しブロック▼▼▼▼▼▼

//関数呼び出し
assign_err_flag();
assign_prefecture_id();
assign_prefecture_id_txt();
assign_prefecture_name();

//Smartyを使用した表示(テンプレートファイルの指定)
if(isset($_POST['func']) && $_POST['func'] == 'conf'){
	$smarty->display('admin/prefecture_detail_conf.tmpl');
}
else{
	$smarty->display('admin/prefecture_detail.tmpl');
}

//▲▲▲▲▲▲関数呼び出しブロック▲▲▲▲▲▲


?>
