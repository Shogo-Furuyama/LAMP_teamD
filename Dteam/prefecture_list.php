<?php
/*!
@file prefecture_list.php
@brief 都道府県一覧
@copyright Copyright (c) 2021 Yamanoi Yasushi.
*/

/////////////////////////////////////////////////////////////////
/// 実行ブロック
/////////////////////////////////////////////////////////////////

//ライブラリをインクルード
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");

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
				//削除操作
				deljob();
				//リダイレクトするページの計算
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
				//再読み込みのためにリダイレクト
				cutil::redirect_exit($_SERVER['PHP_SELF'] 
				. '?page=' . $re_page);
			break;
			default:
			break;
		}
	}
}
$show_mode = 'edit';
//データの読み込み
readdata();

/////////////////////////////////////////////////////////////////
/// 関数ブロック
/////////////////////////////////////////////////////////////////

//--------------------------------------------------------------------------------------
/*!
@brief	コマンドが渡されたかどうか
@return	渡されたらtrue
*/
//--------------------------------------------------------------------------------------
function is_func_active(){
    if(isset($_POST['func']) && $_POST['func'] != ""){
        return true;
    }
    return false;
}


//--------------------------------------------------------------------------------------
/*!
@brief	パラメータのチェック
@return	エラーがあったらfalse
*/
//--------------------------------------------------------------------------------------
function param_chk(){
	 global $ERR_STR;
	if(!isset($_POST['param']) 
	|| !cutil::is_number($_POST['param'])
	|| $_POST['param'] <= 0){
		$ERR_STR .= "パラメータを取得できませんでした\n";
		return false;
	}
	return true;
}


//--------------------------------------------------------------------------------------
/*!
@brief	データ読み込み
@return	なし
*/
//--------------------------------------------------------------------------------------
function readdata(){
	global $limit;
	global $rows;
	global $page;
	$obj = new cprefecture();
	$from = ($page - 1) * $limit;
	$rows = $obj->get_all(false,$from,$limit);
}

//--------------------------------------------------------------------------------------
/*!
@brief	削除
@return	なし
*/
//--------------------------------------------------------------------------------------
function deljob(){
	$chenge = new cchange_ex();
	if($_POST['param'] > 0){
		$chenge->delete(false,"prefecture","prefecture_id=" . $_POST['param']);
	}
}


//--------------------------------------------------------------------------------------
/*!
@brief	ページャーの表示
@return	なし
*/
//--------------------------------------------------------------------------------------
function echo_page_block(){
	global $limit;
	global $page;
	$obj = new cprefecture();
	$allcount = $obj->get_all_count(false);
	$ctl = new cpager($_SERVER['PHP_SELF'],$allcount,$limit);
	$ctl->show('page',$page);
}


//--------------------------------------------------------------------------------------
/*!
@brief	一覧の表示
@return	なし
*/
//--------------------------------------------------------------------------------------
function echo_prefecture_list(){
	global $rows;
	global $page;
	$retstr = '';
	$urlparam = '&page=' . $page;
	$rowscount = 1;
	if(count($rows) > 0){
		foreach($rows as $key => $value){
		$javamsg =  '【' . $rows[$key]['prefecture_name'] . '】';
		$nobottom = '';
		if($rowscount == count($rows)){
			$nobottom = ' nobottom';
		}
		$str =<<<END_BLOCK
<tr>
<td width="20%" class="center{$nobottom}">
{$rows[$key]['prefecture_id']}
</td>
<td width="65%" class="center{$nobottom}">
<a href="prefecture_detail.php?pid={$rows[$key]['prefecture_id']}{$urlparam}">{$rows[$key]['prefecture_name']}</a>
</td>
<td width="15%" class="center{$nobottom}">
<input type="button" value="削除確認" onClick="javascript:del_func_form({$rows[$key]['prefecture_id']},'{$javamsg}')" />
</td>
</tr>
END_BLOCK;
		$retstr .= $str;
		$rowscount++;
		}
	}
	else{
		$retstr =<<<END_BLOCK
<tr><td colspan="3" class="nobottom">都道府県が見つかりません</td></tr>
END_BLOCK;
	}
	echo $retstr;
}

function echo_tgt_uri(){
    global $page;
    echo $_SERVER['PHP_SELF'] 
        . '?page=' . $page;
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link href="css/main.css" rel="stylesheet" type="text/css">
<title>都道府県一覧</title>
<script type="text/javascript">
function set_func_form(fn,pm){
    document.form1.target = "_self";
    document.form1.func.value = fn;
    document.form1.param.value = pm;
    document.form1.submit();
}

function del_func_form(pm,mess){
    var message = "本当に\r\n";
    message += mess;
    message += "\r\nを削除しますか？";
    if(confirm(message)){
        document.form1.target = "_self";
        document.form1.func.value = 'del';
        document.form1.param.value = pm;
        document.form1.submit();
    }
}
</script>
</head>
<body>
<!-- 全体コンテナ　-->
<div id="container">
<?php require_once("gmenu.php"); ?>
<div id="headTitle">
<h2>都道府県一覧</h2>
</div>
<!-- コンテンツ　-->
<div id="contents">
<?php echo $ERR_STR; ?>
<form name="form1" action="<?php echo_tgt_uri(); ?>" method="post" >
<p><a href="prefecture_detail.php">新規</a></p>
<p><?php echo_page_block(); ?></p>
<table>
<tr>
<th>都道府県ID</th>
<th>都道府県名</th>
<th>操作</th>
</tr>
<?php echo_prefecture_list(); ?>
</table>
<input type="hidden" name="func" value="" />
<input type="hidden" name="param" value="" />
</form>
<p>&nbsp;</p>

</div>
<!-- /コンテンツ　-->
</div>
<!-- /全体コンテナ　-->
</body>
</html>

