<?php
/*!
@file contents_db.php
@brief 
@copyright Copyright (c) 2021 Yamanoi Yasushi.
*/
//PDO接続初期化
require_once("pdointerface.php");

////////////////////////////////////
//以下、DBクラス使用例

//--------------------------------------------------------------------------------------
///	都道府県クラス
//--------------------------------------------------------------------------------------
class cprefecture extends crecord {
	//--------------------------------------------------------------------------------------
	/*!
	@brief	コンストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __construct() {
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	すべての個数を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@return	個数
	*/
	//--------------------------------------------------------------------------------------
	public function get_all_count($debug){
		//親クラスのselect()メンバ関数を呼ぶ
		$this->select(
			$debug,					//デバッグ文字を出力するかどうか
			"count(*)",				//取得するカラム
			"prefecture",			//取得するテーブル
			"1"					//条件
		);
		if($row = $this->fetch_assoc()){
			//取得した個数を返す
			return $row['count(*)'];
		}
		else{
			return 0;
		}
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定された範囲の配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$from	抽出開始行
	@param[in]	$limit	抽出数
	@return	配列（2次元配列になる）
	*/
	//--------------------------------------------------------------------------------------
	public function get_all($debug,$from,$limit){
		$arr = array();
		//親クラスのselect()メンバ関数を呼ぶ
		$this->select(
			$debug,			//デバッグ表示するかどうか
			"*",			//取得するカラム
			"prefecture",	//取得するテーブル
			"1",			//条件
			"prefecture_id asc",	//並び替え
			"limit " . $from . "," . $limit		//抽出開始行と抽出数
		);
		//順次取り出す
		while($row = $this->fetch_assoc()){
			$arr[] = $row;
		}
		//取得した配列を返す
		return $arr;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定された範囲の配列を得る（プレースホルダつき版）
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$from	抽出開始行
	@param[in]	$limit	抽出数
	@return	配列（2次元配列になる）
	*/
	//--------------------------------------------------------------------------------------
	public function get_all_prep($debug,$from,$limit){
		$arr = array();
		$query = <<< END_BLOCK
select
*
from
prefecture
where
1
order by
prefecture_id asc
limit ?, ?
END_BLOCK;
		$prep_arr = array($from,$limit);
		//親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,			//デバッグ表示するかどうか
			$query,			//プレースホルダつきSQL
			$prep_arr		//データの配列
		);
		//順次取り出す
		while($row = $this->fetch_assoc()){
			$arr[] = $row;
		}
		//取得した配列を返す
		return $arr;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定されたIDの配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$id		ID
	@return	配列（1次元配列になる）空の場合はfalse
	*/
	//--------------------------------------------------------------------------------------
	public function get_tgt($debug,$id){
		if(!cutil::is_number($id)
		||  $id < 1){
			//falseを返す
			return false;
		}
		//親クラスのselect()メンバ関数を呼ぶ
		$this->select(
			$debug,			//デバッグ表示するかどうか
			"*",			//取得するカラム
			"prefecture",	//取得するテーブル
			"prefecture_id=" . $id	//条件
		);
		return $this->fetch_assoc();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定されたIDの配列を得る（プレースホルダつき版）
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$id		ID
	@return	配列（1次元配列になる）空の場合はfalse
	*/
	//--------------------------------------------------------------------------------------
	public function get_tgt_prep($debug,$id){
		if(!cutil::is_number($id)
		||  $id < 1){
			//falseを返す
			return false;
		}
		$query = <<< END_BLOCK
select
*
from
prefecture
where
prefecture_id = ?
END_BLOCK;
		$prep_arr = array($id);
		//親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,			//デバッグ表示するかどうか
			$query,			//プレースホルダつきSQL
			$prep_arr		//データの配列
		);
		return $this->fetch_assoc();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct(){
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}

//--------------------------------------------------------------------------------------
///	フルーツクラス
//--------------------------------------------------------------------------------------
class cfruits extends crecord {
	//--------------------------------------------------------------------------------------
	/*!
	@brief	コンストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __construct() {
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	すべての個数を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@return	個数
	*/
	//--------------------------------------------------------------------------------------
	public function get_all_count($debug){
		return $this->get_all_count_simple($debug,'fruits');
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定された範囲の配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@return	配列（2次元配列になる）
	*/
	//--------------------------------------------------------------------------------------
	public function get_all($debug){
		return $this->get_alltable_simple($debug,'fruits','fruits_id');
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定されたIDの配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$id		ID
	@return	配列（1次元配列になる）空の場合はfalse
	*/
	//--------------------------------------------------------------------------------------
	public function get_tgt($debug,$id){
		return $this->get_tgt_simple($debug,$id,'fruits','fruits_id');
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct(){
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}

//--------------------------------------------------------------------------------------
///	メンバークラス
//--------------------------------------------------------------------------------------
class cmember extends crecord {
	//--------------------------------------------------------------------------------------
	/*!
	@brief	コンストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __construct() {
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	すべての個数を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@return	個数
	*/
	//--------------------------------------------------------------------------------------
	public function get_all_count($debug){
		//親クラスのselect()メンバ関数を呼ぶ
		$this->select(
			$debug,					//デバッグ文字を出力するかどうか
			"count(*)",				//取得するカラム
			"member,prefecture",			//取得するテーブル
			"member.prefecture_id = prefecture.prefecture_id" //条件
		);
		if($row = $this->fetch_assoc()){
			//取得した個数を返す
			return $row['count(*)'];
		}
		else{
			return 0;
		}
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定された範囲の配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$from	抽出開始行
	@param[in]	$limit	抽出数
	@return	配列（2次元配列になる）
	*/
	//--------------------------------------------------------------------------------------
	public function get_all($debug,$from,$limit){
		$arr = array();
		//親クラスのselect()メンバ関数を呼ぶ
		$this->select(
			$debug,			//デバッグ表示するかどうか
			"member.*,prefecture.prefecture_name", //取得するカラム
			"member,prefecture",	//取得するテーブル
			"member.prefecture_id = prefecture.prefecture_id", //条件
			"member.member_id asc",	//並び替え
			"limit " . $from . "," . $limit		//抽出開始行と抽出数
		);
		//順次取り出す
		while($row = $this->fetch_assoc()){
			$arr[] = $row;
		}
		//取得した配列を返す
		return $arr;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定されたIDの配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$id		ID
	@return	配列（1次元配列になる）空の場合はfalse
	*/
	//--------------------------------------------------------------------------------------
	public function get_tgt($debug,$id){
		if(!cutil::is_number($id)
		||  $id < 1){
			//falseを返す
			return false;
		}
		//親クラスのselect()メンバ関数を呼ぶ
		$this->select(
			$debug,			//デバッグ表示するかどうか
			"member.*,prefecture.prefecture_name",			//取得するカラム
			"member,prefecture",	//取得するテーブル
			"member.member_id ={$id} and 
member.prefecture_id = prefecture.prefecture_id"	//条件
		);
		return $this->fetch_assoc();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	フルーツとのマッチする配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$id		ID
	@return	配列（1次元配列になる）
	*/
	//--------------------------------------------------------------------------------------
	public function get_all_fruits_match($debug,$id){
		$arr = array();
		//親クラスのselect()メンバ関数を呼ぶ
		$this->select(
			$debug,			//デバッグ表示するかどうか
			"*", //取得するカラム
			"fruits_match",	//取得するテーブル
			"member_id = {$id}", //条件
			"fruits_id asc"	//並び替え
		);
		//順次取り出す
		while($row = $this->fetch_assoc()){
			$arr[] = $row['fruits_id'];
		}
		//取得した配列を返す
		return $arr;
	}

	//--------------------------------------------------------------------------------------
	/*!
	@brief	デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct(){
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}

class ccategory extends crecord {
	//--------------------------------------------------------------------------------------
	/*!
	@brief	コンストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __construct() {
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	すべての個数を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@return	個数
	*/
	//--------------------------------------------------------------------------------------
	public function get_all_count($debug){
		//親クラスのselect()メンバ関数を呼ぶ
		$this->select(
			$debug,					//デバッグ文字を出力するかどうか
			"count(*)",				//取得するカラム
			"category",			//取得するテーブル
			"1"					//条件
		);
		if($row = $this->fetch_assoc()){
			//取得した個数を返す
			return $row['count(*)'];
		}
		else{
			return 0;
		}
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定された範囲の配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$from	抽出開始行
	@param[in]	$limit	抽出数
	@return	配列（2次元配列になる）
	*/
	//--------------------------------------------------------------------------------------
	public function get_all($debug,$from,$limit){
		$arr = array();
		//親クラスのselect()メンバ関数を呼ぶ
		$this->select(
			$debug,			//デバッグ表示するかどうか
			"*",			//取得するカラム
			"category",	//取得するテーブル
			"1",			//条件
			"category_id asc",	//並び替え
			"limit " . $from . "," . $limit		//抽出開始行と抽出数
		);
		//順次取り出す
		while($row = $this->fetch_assoc()){
			$arr[] = $row;
		}
		//取得した配列を返す
		return $arr;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定された範囲の配列を得る（プレースホルダつき版）
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$from	抽出開始行
	@param[in]	$limit	抽出数
	@return	配列（2次元配列になる）
	*/
	//--------------------------------------------------------------------------------------
	public function get_all_prep($debug,$from,$limit){
		$arr = array();
		$query = <<< END_BLOCK
select
*
from
category
where
1
order by
category_id asc
limit ?, ?
END_BLOCK;
		$prep_arr = array($from,$limit);
		//親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,			//デバッグ表示するかどうか
			$query,			//プレースホルダつきSQL
			$prep_arr		//データの配列
		);
		//順次取り出す
		while($row = $this->fetch_assoc()){
			$arr[] = $row;
		}
		//取得した配列を返す
		return $arr;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定されたIDの配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$id		ID
	@return	配列（1次元配列になる）空の場合はfalse
	*/
	//--------------------------------------------------------------------------------------
	public function get_tgt($debug,$id){
		if(!cutil::is_number($id)
		||  $id < 1){
			//falseを返す
			return false;
		}
		//親クラスのselect()メンバ関数を呼ぶ
		$this->select(
			$debug,			//デバッグ表示するかどうか
			"*",			//取得するカラム
			"category",	//取得するテーブル
			"category_id=" . $id	//条件
		);
		return $this->fetch_assoc();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定されたIDの配列を得る（プレースホルダつき版）
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$id		ID
	@return	配列（1次元配列になる）空の場合はfalse
	*/
	//--------------------------------------------------------------------------------------
	public function get_tgt_prep($debug,$id){
		if(!cutil::is_number($id)
		||  $id < 1){
			//falseを返す
			return false;
		}
		$query = <<< END_BLOCK
select
*
from
category
where
category_id = ?
END_BLOCK;
		$prep_arr = array($id);
		//親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,			//デバッグ表示するかどうか
			$query,			//プレースホルダつきSQL
			$prep_arr		//データの配列
		);
		return $this->fetch_assoc();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct(){
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}

class cbook extends crecord {
	//--------------------------------------------------------------------------------------
	/*!
	@brief	コンストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __construct() {
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	すべての個数を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@return	個数
	*/
	//--------------------------------------------------------------------------------------
	public function get_all_count($debug){
		//親クラスのselect()メンバ関数を呼ぶ
		$this->select(
			$debug,					//デバッグ文字を出力するかどうか
			"count(*)",				//取得するカラム
			"book,category",			//取得するテーブル
			"book.category_id = category.category_id" //条件
		);
		if($row = $this->fetch_assoc()){
			//取得した個数を返す
			return $row['count(*)'];
		}
		else{
			return 0;
		}
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定された範囲の配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$from	抽出開始行
	@param[in]	$limit	抽出数
	@return	配列（2次元配列になる）
	*/
	//--------------------------------------------------------------------------------------
	public function get_all($debug,$from,$limit){
		$arr = array();
		//親クラスのselect()メンバ関数を呼ぶ
		$this->select(
			$debug,			//デバッグ表示するかどうか
			"book.*,category.category_name", //取得するカラム
			"book,category",	//取得するテーブル
			"book.category_id = category.category_id", //条件
			"book.book_id asc",	//並び替え
			"limit " . $from . "," . $limit		//抽出開始行と抽出数
		);
		//順次取り出す
		while($row = $this->fetch_assoc()){
			$arr[] = $row;
		}
		//取得した配列を返す
		return $arr;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定されたIDの配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$id		ID
	@return	配列（1次元配列になる）空の場合はfalse
	*/
	//--------------------------------------------------------------------------------------
	public function get_tgt($debug,$id){
		if(!cutil::is_number($id)
		||  $id < 1){
			//falseを返す
			return false;
		}
		//親クラスのselect()メンバ関数を呼ぶ
		$this->select(
			$debug,			//デバッグ表示するかどうか
			"book.*,category.category_name",			//取得するカラム
			"book,category",	//取得するテーブル
			"book.book_id ={$id} and 
book.category_id = category.category_id"	//条件
		);
		return $this->fetch_assoc();
	}
			

	//--------------------------------------------------------------------------------------
	/*!
	@brief	デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct(){
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}
