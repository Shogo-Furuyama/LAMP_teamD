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
            "score asc, book_id asc", //並び替え
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
            "score asc, book_id asc", //並び替え
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
    public function get_all($debug)
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
            "1"
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
///	ターゲットクラス
//--------------------------------------------------------------------------------------
class ctarget extends crecord
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
            "target_table",
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
    public function get_all($debug)
    {
        $arr = array();
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "*",
            //取得するカラム
            "target_table",
            //取得するテーブル
            "1"
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
            "target_table", //取得するテーブル
            "target_id=" . $id //条件
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

    //検索


    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定されたloginの配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $mail mail
    @return 配列（1次元配列になる）空の場合はfalse
    */
    //--------------------------------------------------------------------------------------
    public function get_tgt_login($debug, $mail)
    {
        if ($mail == '') {
            //falseを返す
            return false;
        }
        $safe_mail = $this->make_safe_sqlstr((string) $mail);
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ表示するかどうか
            "user_id,password,is_admin",
            //取得するカラム
            "user_table",
            //取得するテーブル
            "mail = {$safe_mail}",
            //条件
            limit: "LIMIT 1"
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
            "purchase_history_table",
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
            "purchase_history_table.*,payment_method_table.payment_name",
            //取得するカラム
            "purchase_history_table
            JOIN payment_method_table ON purchase_history_table.payment = payment_method_table.payment_id 
            ",
            //取得するテーブル
            "1",
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
            "purchase_history_table.*,payment_method_table.payment_name",
            //取得するカラム
            "purchase_history_table
            JOIN payment_method_table ON purchase_history_table.payment = payment_method_table.payment_id 
            ",
            //取得するテーブル
            "purchase_history_table.purchase_id = {$id}" //条件
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
    public function get_keyword_count($debug, $keyword, $genre = false, $target = false)
    {
        $addwhere = '';
        if($genre !== false) {
            $addwhere .= ' AND genre_id = ' . $genre['genre_id'];
        }

        if($target !== false) {
            $addwhere .= ' AND target_id = ' . $target['target_id'];
        }

        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ文字を出力するかどうか
            "count(*)",
            //取得するカラム
            "list_table",
            //取得するテーブル
            "list_title collate utf8_unicode_ci LIKE '%$keyword%'" . $addwhere //条件
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
    public function keyword_search($debug, $from, $limit, $keyword, $genre = false, $target = false)
    {
        $addwhere = '';
        if($genre !== false) {
            $addwhere .= ' AND list_table.genre_id = ' . $genre['genre_id'];
        }

        if($target !== false) {
            $addwhere .= ' AND list_table.target_id = ' . $target['target_id'];
        }

        $arr = array();
        $this->select(
            $debug,
            "list_table.list_id, list_table.list_title, list_table.book_count, list_table.favorite, list_table.img_link0, list_table.img_link1, 
            user_table.user_name, user_table.icon_img, genre_table.genre_name, target_table.target_name, CASE 
            WHEN list_table.list_title LIKE '$keyword' THEN 0
            WHEN list_table.list_title LIKE '$keyword%' THEN 1
            WHEN list_table.list_title collate utf8_unicode_ci LIKE '$keyword%' THEN 2
            ELSE 3
            END AS 'score'",
            //取得するカラム
            "list_table
            JOIN user_table ON list_table.user_id = user_table.user_id 
            JOIN genre_table ON list_table.genre_id = genre_table.genre_id 
            JOIN target_table ON list_table.target_id = target_table.target_id
            ",
            //取得するテーブル
            "list_table.list_title collate utf8_unicode_ci LIKE '%$keyword%'" . $addwhere,
            //条件
            "score asc, list_table.list_id asc", //並び替え
            "limit " . $from . "," . $limit //抽出開始行と抽出数
        );
        //順次取り出す
        while ($row = $this->fetch_assoc()) {
            $arr[] = $row;
        }
        //取得した配列を返す
        return $arr;
    }

    public function get_genre_target_count($debug, $genre = false, $target = false)
    {
        $where = '';
        if($genre !== false) {
            $where .= 'genre_id = ' . $genre['genre_id'];
        }
        if($target !== false) {
            if($where != '') {
                $where .= ' AND ';
            }
            $where .= 'target_id = ' . $target['target_id'];
        }

        if($where == '') {
            return 0;
        }

        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ文字を出力するかどうか
            "count(*)",
            //取得するカラム
            "list_table",
            //取得するテーブル
            $where //条件
        );
        if ($row = $this->fetch_assoc()) {
            //取得した個数を返す
            return $row['count(*)'];
        } else {
            return 0;
        }
    }

    public function genre_target_search($debug, $from, $limit, $genre = false, $target = false)
    {
        $where = '';
        if($genre !== false) {
            $where .= 'list_table.genre_id = ' . $genre['genre_id'];
        }
        if($target !== false) {
            if($where != '') {
                $where .= ' AND ';
            }
            $where .= 'list_table.target_id = ' . $target['target_id'];
        }

        if($where == '') {
            return false;
        }

        $arr = array();
        $this->select(
            $debug,
            "list_table.list_id, list_table.list_title, list_table.book_count, list_table.favorite, list_table.img_link0, list_table.img_link1, 
            user_table.user_name, user_table.icon_img, genre_table.genre_name, target_table.target_name",
            //取得するカラム
            "list_table
            JOIN user_table ON list_table.user_id = user_table.user_id 
            JOIN genre_table ON list_table.genre_id = genre_table.genre_id 
            JOIN target_table ON list_table.target_id = target_table.target_id
            ",
            //取得するテーブル
            $where,
            //条件
            "list_table.favorite desc, list_table.list_id asc", //並び替え
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
            "list_table.*,user_table.user_name",
            //取得するカラム
            "list_table
            LEFT JOIN user_table ON list_table.user_id = user_table.user_id ",
            //取得するテーブル
            "1",
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
    @brief  ランダムでリストを取得する
    @param[in]  $debug  デバッグ出力をするかどうか
    @return 配列（2次元配列になる）
    */
    //--------------------------------------------------------------------------------------
    public function get_rand_list($debug)
    {
        $arr = array();
        $this->select(
            $debug,
            "list_table.list_id, list_table.list_title, list_table.book_count, list_table.favorite, list_table.img_link0, list_table.img_link1, 
            user_table.user_name, user_table.icon_img, genre_table.genre_name, target_table.target_name",
            //取得するカラム
            "list_table
            JOIN user_table ON list_table.user_id = user_table.user_id 
            JOIN genre_table ON list_table.genre_id = genre_table.genre_id 
            JOIN target_table ON list_table.target_id = target_table.target_id",
            //取得するテーブル
            "1",
            //条件
            "RAND()", //並び替え
            "limit 12"//抽出数
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
            "list_table.*, user_table.user_name, user_table.icon_img, genre_table.genre_name, target_table.target_name",
            //取得するカラム
            "list_table
            LEFT JOIN user_table ON list_table.user_id = user_table.user_id 
            LEFT JOIN genre_table ON list_table.genre_id = genre_table.genre_id 
            LEFT JOIN target_table ON list_table.target_id = target_table.target_id
            ",
            //取得するテーブル
            "list_table.list_id = $id" 
            //条件        
        );
        return $this->fetch_assoc();
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief  指定された複数のIDの個数を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $ids    IDs  ※ID1,ID2,ID3
    @return 個数
    */
    //--------------------------------------------------------------------------------------
    public function get_tgts_count($debug, $ids)
    {
        //親クラスのselect()メンバ関数を呼ぶ
        $this->select(
            $debug,
            //デバッグ文字を出力するかどうか
            "count(*)",
            //取得するカラム
            "list_table",
            //取得するテーブル
            "list_id in ({$ids})"
            //条件
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
    @brief  指定された複数のIDの配列を得る
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $ids    IDs  ※ID1,ID2,ID3
    @return 配列（1次元配列になる）空の場合はfalse
    */
    //--------------------------------------------------------------------------------------
    public function get_tgts($debug, $ids, $from, $limit = 1)
    {
        $arr = array();
        if($from != -1) {
            //親クラスのselect()メンバ関数を呼ぶ
            $this->select(
                $debug,
                //デバッグ表示するかどうか
                "list_table.*, user_table.user_name, user_table.icon_img, genre_table.genre_name, target_table.target_name",
                //取得するカラム
                "list_table
                LEFT JOIN user_table ON list_table.user_id = user_table.user_id 
                LEFT JOIN genre_table ON list_table.genre_id = genre_table.genre_id 
                LEFT JOIN target_table ON list_table.target_id = target_table.target_id
                ",
                //取得するテーブル
                "list_table.list_id in ({$ids})",
                //条件
                "list_table.list_id asc", //並び替え
                "limit " . $from . "," . $limit //抽出開始行と抽出数
            );
        }else {
            $this->select(
                $debug,
                //デバッグ表示するかどうか
                "list_table.*, user_table.user_name, user_table.icon_img, genre_table.genre_name, target_table.target_name",
                //取得するカラム
                "list_table
                LEFT JOIN user_table ON list_table.user_id = user_table.user_id 
                LEFT JOIN genre_table ON list_table.genre_id = genre_table.genre_id 
                LEFT JOIN target_table ON list_table.target_id = target_table.target_id
                ",
                //取得するテーブル
                "list_table.list_id in ({$ids})",
                //条件
                "list_table.list_id asc"//並び替え
            );
        }

        while ($row = $this->fetch_assoc()) {
            $arr[] = $row;
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

/// 本コメントクラス
//--------------------------------------------------------------------------------------
class cbookcom extends crecord
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
            "book_comment_table",
            //取得するテーブル
            "comment_id = $id" 
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