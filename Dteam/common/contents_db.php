<?php
/*!
@file contents_db.php
@brief 
@copyright Copyright (c) 2017 Yamanoi Yasushi.
*/
//PDO接続初期化
require_once("pdointerface.php");

////////////////////////////////////

//TeamD
//--------------------------------------------------------------------------------------
///	本クラス
//--------------------------------------------------------------------------------------
class cbook extends crecord
{
    //--------------------------------------------------------------------------------------
    /*!
       @brief	コンストラクタ
       */
    //--------------------------------------------------------------------------------------
    public function __construct()
    {
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
    public function get_all_count($debug)
    {
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ文字を出力するかどうか
            "count(*)",
            //取得するカラム
            "book_table",
            //取得するテーブル
            "1" //条件
        );
        if ($row = $this->fetch_assoc()) {
            //取得した個数を返す
            return $row['count(*)'];
        } else {
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
    public function get_all($debug, $from, $limit)
    {
        $arr = array();
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "book_table",
            //取得するテーブル
            "1",
            //条件
            "book_id asc", //並び替え
            "limit " . $from . "," . $limit //抽出開始行と抽出数
        );
        //順次取り出す
        while ($row = $this->fetch_assoc()) {
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
    public function get_tgt($debug, $id)
    {
        if (
            !cutil::is_number($id)
            || $id < 1
        ) {
            //falseを返す
            return false;
        }
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "book_table", //取得するテーブル
            "book_id=" . $id //条件
        );
        return $this->fetch_assoc();
    }
    //--------------------------------------------------------------------------------------
    /*!
       @brief	指定された範囲とキーワードをもとに配列を得る(タイトル)
       @param[in]	$debug	デバッグ出力をするかどうか
       @param[in]	$keyword	キーワード
       @param[in]	$from	抽出開始行
       @param[in]	$limit	抽出数
       @return	配列（2次元配列になる）
       */
    //--------------------------------------------------------------------------------------
    public function get_t_keyword($debug, $keyword, $from, $limit)
    {
        $arr = array();
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*,CASE 
            WHEN book_title LIKE '$keyword' THEN 0
            WHEN book_title LIKE '$keyword%' THEN 1
            WHEN book_title collate utf8_unicode_ci LIKE '$keyword%' THEN 2
            ELSE 3
            END AS 'score'",
            //取得するカラム
            "book_table",
            //取得するテーブル
            "book_title collate utf8_unicode_ci LIKE '%$keyword%'",
            //条件
            "score asc", //並び替え
            "limit " . $from . "," . $limit //抽出開始行と抽出数
        );
        //順次取り出す
        while ($row = $this->fetch_assoc()) {
            $arr[] = $row;
        }
        //取得した配列を返す
        return $arr;
    }
    //--------------------------------------------------------------------------------------
    /*!
       @brief	指定された範囲とキーワードをもとに配列を得る(著者)
       @param[in]	$debug	デバッグ出力をするかどうか
       @param[in]	$keyword	キーワード
       @param[in]	$from	抽出開始行
       @param[in]	$limit	抽出数
       @return	配列（2次元配列になる）
       */
    //--------------------------------------------------------------------------------------
    public function get_a_keyword($debug, $keyword, $from, $limit)
    {
        $arr = array();
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*,CASE 
            WHEN authors LIKE '$keyword' THEN 0
            WHEN authors LIKE '$keyword%' THEN 1
            WHEN authors collate utf8_unicode_ci LIKE '$keyword%' THEN 2
            ELSE 3
            END AS 'score'",
            //取得するカラム
            "book_table",
            //取得するテーブル
            "authors collate utf8_unicode_ci LIKE '%$keyword%'",
            //条件
            "score asc", //並び替え
            "limit " . $from . "," . $limit //抽出開始行と抽出数
        );
        //順次取り出す
        while ($row = $this->fetch_assoc()) {
            $arr[] = $row;
        }
        //取得した配列を返す
        return $arr;
    }
    //--------------------------------------------------------------------------------------
    /*!
       @brief	キーワードにヒットした個数を得る（タイトル）
       @param[in]	$debug	デバッグ出力をするかどうか
       @param[in]	$keyword	キーワード
       @return	個数
       */
    //--------------------------------------------------------------------------------------
    public function get_t_keyword_count($debug, $keyword)
    {
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ文字を出力するかどうか
            "count(*)",
            //取得するカラム
            "book_table",
            //取得するテーブル
            "book_title collate utf8_unicode_ci LIKE '%$keyword%'" //条件
        );
        if ($row = $this->fetch_assoc()) {
            //取得した個数を返す
            return $row['count(*)'];
        } else {
            return 0;
        }
    }
    //--------------------------------------------------------------------------------------
    /*!
       @brief	キーワードにヒットした個数を得る（著者）
       @param[in]	$debug	デバッグ出力をするかどうか
       @param[in]	$keyword	キーワード
       @return	個数
       */
    //--------------------------------------------------------------------------------------
    public function get_a_keyword_count($debug, $keyword)
    {
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ文字を出力するかどうか
            "count(*)",
            //取得するカラム
            "book_table",
            //取得するテーブル
            "authors collate utf8_unicode_ci LIKE '%$keyword%'" //条件
        );
        if ($row = $this->fetch_assoc()) {
            //取得した個数を返す
            return $row['count(*)'];
        } else {
            return 0;
        }
    }
    //--------------------------------------------------------------------------------------
    /*!
       @brief	指定されたisbnの配列を得る
       @param[in]	$debug	デバッグ出力をするかどうか
       @param[in]	$isbn
       @return	配列（1次元配列になる）空の場合はfalse
       */
    //--------------------------------------------------------------------------------------
    public function get_tgt_isbn($debug, $isbn)
    {
        if (!preg_match('/^[0-9]{9}[0-9X]{1}$/', $isbn)) {
            //falseを返す
            return false;
        }
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "book_table",
            //取得するテーブル
            "isbn='$isbn'", //条件
            limit: "LIMIT 1"
        );
        return $this->fetch_assoc();
    }
    //--------------------------------------------------------------------------------------
    /*!
       @brief	デストラクタ
       */
    //--------------------------------------------------------------------------------------
    public function __destruct()
    {
        //親クラスのデストラクタを呼ぶ
        parent::__destruct();
    }
}

//--------------------------------------------------------------------------------------
///	ジャンルクラス
//--------------------------------------------------------------------------------------
class cgenre extends crecord
{
    //--------------------------------------------------------------------------------------
    /*!
       @brief	コンストラクタ
       */
    //--------------------------------------------------------------------------------------
    public function __construct()
    {
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
    public function get_all_count($debug)
    {
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ文字を出力するかどうか
            "count(*)",
            //取得するカラム
            "genre_table",
            //取得するテーブル
            "1" //条件
        );
        if ($row = $this->fetch_assoc()) {
            //取得した個数を返す
            return $row['count(*)'];
        } else {
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
    public function get_all($debug, $from, $limit)
    {
        $arr = array();
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "genre_table",
            //取得するテーブル
            "1",
            //条件
            "genre_id asc", //並び替え
            "limit " . $from . "," . $limit //抽出開始行と抽出数
        );
        //順次取り出す
        while ($row = $this->fetch_assoc()) {
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
    public function get_tgt($debug, $id)
    {
        if (
            !cutil::is_number($id)
            || $id < 1
        ) {
            //falseを返す
            return false;
        }
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "genre_table", //取得するテーブル
            "genre_id=" . $id //条件
        );
        return $this->fetch_assoc();
    }
    //--------------------------------------------------------------------------------------
    /*!
       @brief	デストラクタ
       */
    //--------------------------------------------------------------------------------------
    public function __destruct()
    {
        //親クラスのデストラクタを呼ぶ
        parent::__destruct();
    }
}


//--------------------------------------------------------------------------------------
///	クレジットクラス
//--------------------------------------------------------------------------------------
class ccredit extends crecord
{
    //--------------------------------------------------------------------------------------
    /*!
       @brief	コンストラクタ
       */
    //--------------------------------------------------------------------------------------
    public function __construct()
    {
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
    public function get_all_count($debug)
    {
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ文字を出力するかどうか
            "count(*)",
            //取得するカラム
            "credit_table",
            //取得するテーブル
            "1" //条件
        );
        if ($row = $this->fetch_assoc()) {
            //取得した個数を返す
            return $row['count(*)'];
        } else {
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
    public function get_all($debug, $from, $limit)
    {
        $arr = array();
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "credit_table",
            //取得するテーブル
            "1",
            //条件
            "credit_id asc", //並び替え
            "limit " . $from . "," . $limit //抽出開始行と抽出数
        );
        //順次取り出す
        while ($row = $this->fetch_assoc()) {
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
    public function get_tgt($debug, $id)
    {
        if (
            !cutil::is_number($id)
            || $id < 1
        ) {
            //falseを返す
            return false;
        }
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "credit_table", //取得するテーブル
            "credit_id=" . $id //条件
        );
        return $this->fetch_assoc();
    }
    //--------------------------------------------------------------------------------------
    /*!
       @brief	デストラクタ
       */
    //--------------------------------------------------------------------------------------
    public function __destruct()
    {
        //親クラスのデストラクタを呼ぶ
        parent::__destruct();
    }
}

//--------------------------------------------------------------------------------------
///	お支払い方法クラス
//--------------------------------------------------------------------------------------
class cpayment_method extends crecord
{
    //--------------------------------------------------------------------------------------
    /*!
       @brief	コンストラクタ
       */
    //--------------------------------------------------------------------------------------
    public function __construct()
    {
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
    public function get_all_count($debug)
    {
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ文字を出力するかどうか
            "count(*)",
            //取得するカラム
            "payment_method_table",
            //取得するテーブル
            "1" //条件
        );
        if ($row = $this->fetch_assoc()) {
            //取得した個数を返す
            return $row['count(*)'];
        } else {
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
    public function get_all($debug, $from, $limit)
    {
        $arr = array();
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "payment_method_table",
            //取得するテーブル
            "1",
            //条件
            "payment_method_id asc", //並び替え
            "limit " . $from . "," . $limit //抽出開始行と抽出数
        );
        //順次取り出す
        while ($row = $this->fetch_assoc()) {
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
    public function get_tgt($debug, $id)
    {
        if (
            !cutil::is_number($id)
            || $id < 1
        ) {
            //falseを返す
            return false;
        }
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "payment_method_table", //取得するテーブル
            "payment_method_id=" . $id //条件
        );
        return $this->fetch_assoc();
    }
    //--------------------------------------------------------------------------------------
    /*!
       @brief	デストラクタ
       */
    //--------------------------------------------------------------------------------------
    public function __destruct()
    {
        //親クラスのデストラクタを呼ぶ
        parent::__destruct();
    }
}

/// ユーザークラス
//--------------------------------------------------------------------------------------
class cuser extends crecord
{
    //--------------------------------------------------------------------------------------
    /*!
    @brief  コンストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __construct()
    {
        //親クラスのコンストラクタを呼ぶ
        parent::__construct();
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  すべての個数を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @return 個数
    */
    //--------------------------------------------------------------------------------------
    public function get_all_count($debug)
    {
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ文字を出力するかどうか
            "count(*)",
            //取得するカラム
            "user_table",
            //取得するテーブル
            "1" //条件
        );
        if ($row = $this->fetch_assoc()) {
            //取得した個数を返す
            return $row['count(*)'];
        } else {
            return 0;
        }
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定された範囲の配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $from   抽出開始行
    @param[in]  $limit  抽出数
    @return 配列（2次元配列になる）
    */
    //--------------------------------------------------------------------------------------
    public function get_all($debug, $from, $limit)
    {
        $arr = array();
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "user_table.*",
            //取得するカラム
            "user_table",
            //取得するテーブル
            "1",
            //条件
            "user_id asc", //並び替え
            "limit " . $from . "," . $limit //抽出開始行と抽出数
        );
        //順次取り出す
        while ($row = $this->fetch_assoc()) {
            $arr[] = $row;
        }
        //取得した配列を返す
        return $arr;
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定されたIDの配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $id     ID
    @return 配列（1次元配列になる）空の場合はfalse
    */
    //--------------------------------------------------------------------------------------
    public function get_tgt($debug, $id)
    {
        if (
            !cutil::is_number($id)
            || $id < 1
        ) {
            //falseを返す
            return false;
        }
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "user_table",
            //取得するテーブル
            "user_id = {$id}" //条件
        );
        return $this->fetch_assoc();
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定されたloginの配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $login     login
    @return 配列（1次元配列になる）空の場合はfalse
    */
    //--------------------------------------------------------------------------------------
    public function get_tgt_login($debug, $mail, $pass)
    {
        if ($mail == '' && $pass == '') {
            //falseを返す
            return false;
        }
        $safe_mail = $this->make_safe_sqlstr((string) $mail);
        $safe_password = $this->make_safe_sqlstr((string) $pass);
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "user_id,user_name,is_admin",
            //取得するカラム
            "user_table",
            //取得するテーブル
            "mail = {$safe_mail} AND password = {$safe_password}"
            //条件
        );
        return $this->fetch_assoc();
    }



    //--------------------------------------------------------------------------------------
    /*!
    @brief  デストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __destruct()
    {
        //親クラスのデストラクタを呼ぶ
        parent::__destruct();
    }
}
//--------------------------------------------------------------------------------------
///	お問い合わせクラス
//--------------------------------------------------------------------------------------
class cinquiry extends crecord
{
    //--------------------------------------------------------------------------------------
    /*!
       @brief	コンストラクタ
       */
    //--------------------------------------------------------------------------------------
    public function __construct()
    {
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
    public function get_all_count($debug)
    {
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ文字を出力するかどうか
            "count(*)",
            //取得するカラム
            "inquiry_table",
            //取得するテーブル
            "1" //条件
        );
        if ($row = $this->fetch_assoc()) {
            //取得した個数を返す
            return $row['count(*)'];
        } else {
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
    public function get_all($debug, $from, $limit)
    {
        $arr = array();
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "inquiry_table",
            //取得するテーブル
            "1",
            //条件
            "inquiry_id desc", //並び替え
            "limit " . $from . "," . $limit //抽出開始行と抽出数
        );
        //順次取り出す
        while ($row = $this->fetch_assoc()) {
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
    public function get_tgt($debug, $id)
    {
        if (
            !cutil::is_number($id)
            || $id < 1
        ) {
            //falseを返す
            return false;
        }
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "inquiry_table", //取得するテーブル
            "inquiry_id=" . $id //条件
        );
        return $this->fetch_assoc();
    }
    //--------------------------------------------------------------------------------------
    /*!
       @brief	デストラクタ
       */
    //--------------------------------------------------------------------------------------
    public function __destruct()
    {
        //親クラスのデストラクタを呼ぶ
        parent::__destruct();
    }
}

/// 購入履歴ークラス
//--------------------------------------------------------------------------------------
class cpurchase_history extends crecord
{
    //--------------------------------------------------------------------------------------
    /*!
    @brief  コンストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __construct()
    {
        //親クラスのコンストラクタを呼ぶ
        parent::__construct();
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  すべての個数を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @return 個数
    */
    //--------------------------------------------------------------------------------------
    public function get_all_count($debug)
    {
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ文字を出力するかどうか
            "count(*)",
            //取得するカラム
            "purchase_history_table,user_table",
            //取得するテーブル
            "purchase_history_table.user_id = user_table.user_id" //条件
        );
        if ($row = $this->fetch_assoc()) {
            //取得した個数を返す
            return $row['count(*)'];
        } else {
            return 0;
        }
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定された範囲の配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $from   抽出開始行
    @param[in]  $limit  抽出数
    @return 配列（2次元配列になる）
    */
    //--------------------------------------------------------------------------------------
    public function get_all($debug, $from, $limit)
    {
        $arr = array();
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "purchase_history_table.*,user_table.user_name",
            //取得するカラム
            "purchase_history_table,user_table",
            //取得するテーブル
            "purchase_history_table.user.id = user_table.user_id",
            //条件
            "purchase_history_table.purchase_id asc", //並び替え
            "limit " . $from . "," . $limit //抽出開始行と抽出数
        );
        //順次取り出す
        while ($row = $this->fetch_assoc()) {
            $arr[] = $row;
        }
        //取得した配列を返す
        return $arr;
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定されたIDの配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $id     ID
    @return 配列（1次元配列になる）空の場合はfalse
    */
    //--------------------------------------------------------------------------------------
    public function get_tgt($debug, $id)
    {
        if (
            !cutil::is_number($id)
            || $id < 1
        ) {
            //falseを返す
            return false;
        }
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "purchase_history_table.*,user_table.user_name",
            //取得するカラム
            "purchase_history_table,user_table",
            //取得するテーブル
            "purchase_history_table.purchase_id ={$id} and 
            purchase_history_table.user_id = user_table.user_id" //条件
        );
        return $this->fetch_assoc();
    }


    //--------------------------------------------------------------------------------------
    /*!
    @brief  デストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __destruct()
    {
        //親クラスのデストラクタを呼ぶ
        parent::__destruct();
    }
}
/// リストクラス
//--------------------------------------------------------------------------------------
class clist extends crecord
{
    //--------------------------------------------------------------------------------------
    /*!
    @brief  コンストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __construct()
    {
        //親クラスのコンストラクタを呼ぶ
        parent::__construct();
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  すべての個数を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @return 個数
    */
    //--------------------------------------------------------------------------------------
    public function get_all_count($debug)
    {
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ文字を出力するかどうか
            "count(*)",
            //取得するカラム
            "list_table",
            //取得するテーブル
            "1" //条件
        );
        if ($row = $this->fetch_assoc()) {
            //取得した個数を返す
            return $row['count(*)'];
        } else {
            return 0;
        }
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  すべての個数を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @return 個数
    */
    //--------------------------------------------------------------------------------------
    public function get_keyword_count($debug,$keyword)
    {
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ文字を出力するかどうか
            "count(*)",
            //取得するカラム
            "list_table",
            //取得するテーブル
            "list_title collate utf8_unicode_ci LIKE '%$keyword%'" //条件
        );
        if ($row = $this->fetch_assoc()) {
            //取得した個数を返す
            return $row['count(*)'];
        } else {
            return 0;
        }
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定された範囲の配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $from   抽出開始行
    @param[in]  $limit  抽出数
    @return 配列（2次元配列になる）
    */
    //--------------------------------------------------------------------------------------
    public function keyword_search($debug, $from, $limit,$keyword)
    {
    $arr = array();
    $this->select (   
        $debug,
    "list_id,list_title,genre_id,favorite,book_id,user_id,img_link1,img_link2, CASE 
    WHEN list_title LIKE '$keyword' THEN 0
    WHEN list_title LIKE '$keyword%' THEN 1
    WHEN list_title collate utf8_unicode_ci LIKE '$keyword%' THEN 2
    ELSE 3
    END AS 'score'",
    //取得するカラム
    "list_table",
    //取得するテーブル
    "list_title collate utf8_unicode_ci LIKE '%$keyword%'",
    //条件
    "score asc", //並び替え
    "limit " . $from . "," . $limit //抽出開始行と抽出数
    );
     //順次取り出す
    while ($row = $this->fetch_assoc()) {
        $arr[] = $row;
    }
    //取得した配列を返す
    return $arr;
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定された範囲の配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $from   抽出開始行
    @param[in]  $limit  抽出数
    @return 配列（2次元配列になる）
    */
    //--------------------------------------------------------------------------------------
    public function get_all($debug, $from, $limit)
    {
        $arr = array();
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "list_table.*,genre_table.genre_name,
             book_table.book_title,
             user_table.user_name",
            //取得するカラム
            "list_table,genre_table,book_table,user_table",
            //取得するテーブル
            "liat_table.genre.id = genre_table.genre_id,
             list_table.book_id =book_table.book_id,
             list_table.user.id =user_table.user.id",
            //条件
            "list_table.list_id asc", //並び替え
            "limit " . $from . "," . $limit //抽出開始行と抽出数
        );
        //順次取り出す
        while ($row = $this->fetch_assoc()) {
            $arr[] = $row;
        }
        //取得した配列を返す
        return $arr;
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定されたIDの配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $id     ID
    @return 配列（1次元配列になる）空の場合はfalse
    */
    //--------------------------------------------------------------------------------------
    public function get_tgt($debug, $id)
    {
        if (
            !cutil::is_number($id)
            || $id < 1
        ) {
            //falseを返す
            return false;
        }
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "list_table.*,genre_table.genre_name,
             book_table.book_title,
             user_table.user_name",
            //取得するカラム
            "list_table,genre_table,book_table,user_table",
            //取得するテーブル
            "list_table.list_id ={$id} and 
            list_table.genre_id = genre_table.genre_id and
            list_table.book_id =book_table.book_id and
             list_table.user.id =user_table.user.id
            " //条件
        );
        return $this->fetch_assoc();
    }


    //--------------------------------------------------------------------------------------
    /*!
    @brief  デストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __destruct()
    {
        //親クラスのデストラクタを呼ぶ
        parent::__destruct();
    }
}

//以下、DBクラス使用例

//--------------------------------------------------------------------------------------
///	都道府県クラス
//--------------------------------------------------------------------------------------
class cprefecture extends crecord
{
    //--------------------------------------------------------------------------------------
    /*!
       @brief	コンストラクタ
       */
    //--------------------------------------------------------------------------------------
    public function __construct()
    {
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
    public function get_all_count($debug)
    {
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ文字を出力するかどうか
            "count(*)",
            //取得するカラム
            "prefecture",
            //取得するテーブル
            "1" //条件
        );
        if ($row = $this->fetch_assoc()) {
            //取得した個数を返す
            return $row['count(*)'];
        } else {
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
    public function get_all($debug, $from, $limit)
    {
        $arr = array();
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "prefecture",
            //取得するテーブル
            "1",
            //条件
            "prefecture_id asc", //並び替え
            "limit " . $from . "," . $limit //抽出開始行と抽出数
        );
        //順次取り出す
        while ($row = $this->fetch_assoc()) {
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
    public function get_tgt($debug, $id)
    {
        if (
            !cutil::is_number($id)
            || $id < 1
        ) {
            //falseを返す
            return false;
        }
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "prefecture", //取得するテーブル
            "prefecture_id=" . $id //条件
        );
        return $this->fetch_assoc();
    }
    //--------------------------------------------------------------------------------------
    /*!
       @brief	デストラクタ
       */
    //--------------------------------------------------------------------------------------
    public function __destruct()
    {
        //親クラスのデストラクタを呼ぶ
        parent::__destruct();
    }
}

//--------------------------------------------------------------------------------------
/// フルーツクラス
//--------------------------------------------------------------------------------------
class cfruits extends crecord
{
    //--------------------------------------------------------------------------------------
    /*!
    @brief  コンストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __construct()
    {
        //親クラスのコンストラクタを呼ぶ
        parent::__construct();
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  すべての個数を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @return 個数
    */
    //--------------------------------------------------------------------------------------
    public function get_all_count($debug)
    {
        return $this->get_all_count_simple($debug, 'fruits');
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定された範囲の配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @return 配列（2次元配列になる）
    */
    //--------------------------------------------------------------------------------------
    public function get_all($debug)
    {
        return $this->get_alltable_simple($debug, 'fruits', 'fruits_id');
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定されたIDの配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $id     ID
    @return 配列（1次元配列になる）空の場合はfalse
    */
    //--------------------------------------------------------------------------------------
    public function get_tgt($debug, $id)
    {
        return $this->get_tgt_simple($debug, $id, 'fruits', 'fruits_id');
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  デストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __destruct()
    {
        //親クラスのデストラクタを呼ぶ
        parent::__destruct();
    }
}

//--------------------------------------------------------------------------------------
/// メンバークラス
//--------------------------------------------------------------------------------------
class cmember extends crecord
{
    //--------------------------------------------------------------------------------------
    /*!
    @brief  コンストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __construct()
    {
        //親クラスのコンストラクタを呼ぶ
        parent::__construct();
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  すべての個数を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @return 個数
    */
    //--------------------------------------------------------------------------------------
    public function get_all_count($debug)
    {
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ文字を出力するかどうか
            "count(*)",
            //取得するカラム
            "member,prefecture",
            //取得するテーブル
            "member.prefecture_id = prefecture.prefecture_id" //条件
        );
        if ($row = $this->fetch_assoc()) {
            //取得した個数を返す
            return $row['count(*)'];
        } else {
            return 0;
        }
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定された範囲の配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $from   抽出開始行
    @param[in]  $limit  抽出数
    @return 配列（2次元配列になる）
    */
    //--------------------------------------------------------------------------------------
    public function get_all($debug, $from, $limit)
    {
        $arr = array();
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "member.*,prefecture.prefecture_name",
            //取得するカラム
            "member,prefecture",
            //取得するテーブル
            "member.prefecture_id = prefecture.prefecture_id",
            //条件
            "member.member_id asc", //並び替え
            "limit " . $from . "," . $limit //抽出開始行と抽出数
        );
        //順次取り出す
        while ($row = $this->fetch_assoc()) {
            $arr[] = $row;
        }
        //取得した配列を返す
        return $arr;
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定されたIDの配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $id     ID
    @return 配列（1次元配列になる）空の場合はfalse
    */
    //--------------------------------------------------------------------------------------
    public function get_tgt($debug, $id)
    {
        if (
            !cutil::is_number($id)
            || $id < 1
        ) {
            //falseを返す
            return false;
        }
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "member.*,prefecture.prefecture_name",
            //取得するカラム
            "member,prefecture",
            //取得するテーブル
            "member.member_id ={$id} and 
member.prefecture_id = prefecture.prefecture_id" //条件
        );
        return $this->fetch_assoc();
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定されたloginの配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $login     login
    @return 配列（1次元配列になる）空の場合はfalse
    */
    //--------------------------------------------------------------------------------------
    public function get_tgt_login($debug, $login)
    {
        if ($login == '') {
            //falseを返す
            return false;
        }
        $safe_login = $this->make_safe_sqlstr((string) $login);
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "member.*,prefecture.prefecture_name",
            //取得するカラム
            "member,prefecture",
            //取得するテーブル
            "member.member_login like {$safe_login} and 
member.prefecture_id = prefecture.prefecture_id" //条件
        );
        return $this->fetch_assoc();
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief  フルーツとのマッチする配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $id     ID
    @return 配列（1次元配列になる）
    */
    //--------------------------------------------------------------------------------------
    public function get_all_fruits_match($debug, $id)
    {
        $arr = array();
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "fruits_match",
            //取得するテーブル
            "member_id = {$id}",
            //条件
            "fruits_id asc" //並び替え
        );
        //順次取り出す
        while ($row = $this->fetch_assoc()) {
            $arr[] = $row['fruits_id'];
        }
        //取得した配列を返す
        return $arr;
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief  デストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __destruct()
    {
        //親クラスのデストラクタを呼ぶ
        parent::__destruct();
    }
}


//--------------------------------------------------------------------------------------
/// 管理者クラス
//--------------------------------------------------------------------------------------
class cadmin_master extends crecord
{
    //--------------------------------------------------------------------------------------
    /*!
    @brief  コンストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __construct()
    {
        //親クラスのコンストラクタを呼ぶ
        parent::__construct();
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  すべての個数を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @return 個数
    */
    //--------------------------------------------------------------------------------------
    public function get_all_count($debug)
    {
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ文字を出力するかどうか
            "count(*)",
            //取得するカラム
            "admin_master",
            //取得するテーブル
            "1" //条件
        );
        if ($row = $this->fetch_assoc()) {
            //取得した個数を返す
            return $row['count(*)'];
        } else {
            return 0;
        }
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定された範囲の配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $from   抽出開始行
    @param[in]  $limit  抽出数
    @return 配列（2次元配列になる）
    */
    //--------------------------------------------------------------------------------------
    public function get_all($debug, $from, $limit)
    {
        $arr = array();
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "admin_master",
            //取得するテーブル
            "1",
            //条件
            "admin_master_id asc", //並び替え
            "limit " . $from . "," . $limit //抽出開始行と抽出数
        );
        //順次取り出す
        while ($row = $this->fetch_assoc()) {
            $arr[] = $row;
        }
        //取得した配列を返す
        return $arr;
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定されたログインの配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $id     ログイン
    @return 配列（1次元配列になる）空の場合はfalse
    */
    //--------------------------------------------------------------------------------------
    public function get_tgt($debug, $id)
    {
        $safe_login = $this->make_safe_sqlstr((string) $id);
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "admin_master",
            //取得するテーブル
            "admin_login like {$safe_login}" //条件
        );
        return $this->fetch_assoc();
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定されたIDの配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $id     ID
    @return 配列（1次元配列になる）空の場合はfalse
    */
    //--------------------------------------------------------------------------------------
    public function get_tgt_id($debug, $id)
    {
        if (
            !cutil::is_number($id)
            || $id < 1
        ) {
            //falseを返す
            return false;
        }
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            "*",
            "admin_master",
            "admin_master_id = " . $id
        );
        return $this->fetch_assoc();
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  デストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __destruct()
    {
        //親クラスのデストラクタを呼ぶ
        parent::__destruct();
    }

}