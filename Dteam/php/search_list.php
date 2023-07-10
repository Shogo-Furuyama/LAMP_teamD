<?php
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
//smartyクラスの初期化
require_once("inc_smarty.php");
//以下はセッション管理用のインクルード
require_once($CMS_COMMON_INCLUDE_DIR . "auth_adm.php");

//前画面の検索ボックスから取得してデータベース接続、抽出、出力をする

//▼▼▼▼▼▼初期実行ブロック▼▼▼▼▼▼

$show_mode = '';
$ERR_STR = '';

//ページの設定
//デフォルトは1
$page = 1;
//もしページが指定されていたら
if(isset($_GET['page']) 
	//なおかつ、数字だったら
	&& cutil::is_number($_GET['page'])
	//なおかつ、0より大きかったら
	&& $_GET['page'] > 0){
	//パラメータを設定
	$page = $_GET['page'];
}
//1ページのリミット
$limit = 20;
$rows = array();

if(is_func_active()){
    if(param_chk()){
		switch($_POST['func']){
		case "del":
			$show_mode = 'del';
			deljob();
			$re_page = $page;
			$obj = new cprefecture();
			$allcount = $obj->get_all_count(false);
			$last_page = (int)($allcount / $limit);
			if($allcount % $limit){
				$last_page++;
			}
			if($re_page > $last_page){
				$re_page = $last_page;
			}
			cutil::redirect_exit($_SERVER['PHP_SELF'] 
				. '?page=' . $re_page);
		break;
		default:
			$show_mode = 'edit';
			readdata();
		break;
		}
    }
	else{
		$show_mode = 'edit';
		//データの読み込み
		readdata();
	}
}
else{
	$show_mode = 'edit';
//データの読み込み
	readdata();
}

//▲▲▲▲▲▲初期実行ブロック▲▲▲▲▲▲


//▼▼▼▼▼▼関数ブロック▼▼▼▼▼▼

//コマンド送出されているかどうか
function is_func_active(){
	if(isset($_POST['func']) && $_POST['func'] != ""){
		return true;
	}
	return false;
}


//パラメータのチェック
function param_chk(){
     global $ERR_STR;
	if(!isset($_POST['param']) 
	|| !cutil::is_number($_POST['param'])
	|| $_POST['param'] <= 0){
		$ERR_STR .= "コマンドを取得できませんでした\n";
		return false;
	}
	return true;
}

//データの読み込み
//contentsdbを呼び出してデータベースから抽出するための呼出をする
function readdata(){
	global $limit;
	global $rows;
	global $order;
	global $page;
	$obj = new cbook_input();
	$from = ($page - 1) * $limit;
	if(isset($_GET['pname']) && $_GET['pname'] != ""){
		$rows = $obj->get_all_by_name($_GET['pname']);
	}
	else{
		$rows = $obj->get_all(false,$from,$limit);
	}
}


//ページャーのアサイン
function assign_page_block(){
	//$smartyをグローバル宣言（必須）
	global $smarty;
	global $limit;
	global $page;
	$retstr = '';
	$obj = new cbook_input();
	if(isset($_GET['pname']) && $_GET['pname'] != ""){
		$allcount = $obj->get_all_count_by_name($_GET['pname']);
	}
	else{
		$allcount = $obj->get_all_count(false);
	}
	$ctl = new cpager($_SERVER['PHP_SELF'],$allcount,$limit);
	$smarty->assign('pager_arr',$ctl->get('page',$page));
}

//都道府県のアサイン
function assign_prefecture_list(){
	//$smartyをグローバル宣言（必須）
	global $smarty;
	global $rows;
	global $page;
	$smarty->assign('rows',$rows);
}

function assign_tgt_uri(){
	//$smartyをグローバル宣言（必須）
	global $smarty;
	global $page;
	$smarty->assign('tgt_uri',$_SERVER['PHP_SELF'] . '?page=' . $page);
}


//▲▲▲▲▲▲関数ブロック▲▲▲▲▲▲


//▼▼▼▼▼▼関数呼び出しブロック▼▼▼▼▼▼

//関数呼び出し
$smarty->assign('ERR_STR',$ERR_STR);
assign_prefecture_list();
assign_page_block();
assign_tgt_uri();

//Smartyを使用した表示(テンプレートファイルの指定)
$smarty->display('search_list.tmpl');

/*
function chk_admin_login(){

// MySQLデータベースの接続情報を設定します
$host = 'データベースのホスト名';
$username = 'ユーザー名';
$password = 'パスワード';
$database = 'データベース名';

// フォームからキーワードを受け取ります
$keyword = $_POST['keyword'];

// MySQLデータベースに接続します
$mysqli = new mysqli($host, $username, $password, $database);
if ($mysqli->connect_errno) {
    die('MySQLの接続に失敗しました: ' . $mysqli->connect_error);
}

// SQL文を作成して実行します
$query = "SELECT * FROM テーブル名 WHERE カラム名 LIKE '%$keyword%'";
$result = $mysqli->query($query);

// 検索結果を表示します
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array()) {
        echo $row['カラム名1'] . ': ' . $row['カラム名2'] . '<br>';
    }
} else {
    echo '該当する結果はありませんでした。';
}

// MySQLデータベースの接続を閉じます
$mysqli->close();
}
*/

?>