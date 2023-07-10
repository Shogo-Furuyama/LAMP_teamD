<?php
//
/*
本リストのデータベース抽出コード
*/
class cbook                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    _list extends crecord {
    public function __construct() {
        parent::__construct();
    }
    //全取得
    public function get_all_count($debug){
        $this->select(
            $debug,
            "count(*)",
            "list_table",
            "1"
        );
        if($row = $this->fetch_assoc()){
            return $row['count(*)'];
        }
        else{
            return 0;
        }
    }
    //条件付きでふるい落とす
    public function get_all($debug,$from,$limit){
        $arr = array();
        $this->select(
            $debug,
            "*",
            "list_table",
            "1",
            "list_id asc",
            "limit " . $from . "," . $limit
        );
        //順次取り出す
        while($row = $this->fetch_assoc()){
            $arr[] = $row;
        }
        //取得した配列を返す
        return $arr;
    }
    //1ページ内でどれくらい作るか
    public function get_all_prep($debug,$from,$limit){
        $arr = array();
        $query = <<< END_BLOCK
select
*
from
list_table
where
1
order by
list_id asc
limit ?, ?
END_BLOCK;
        $prep_arr = array($from,$limit);
        $this->select_query(
            $debug,
            $query,
            $prep_arr
        );
        while($row = $this->fetch_assoc()){
            $arr[] = $row;
        }
        return $arr;
    }
    public function get_tgt($debug,$id){
        if(!is_int($id)
        ||  $id < 1){
            return false;
        }
        $this->select(
            $debug,
            "*",
            "list_table",
            "list_id=" . $id
        );
        return $this->fetch_assoc();
    }
    public function get_tgt_prep($debug,$id){
        if(!is_int($id)
        ||  $id < 1){
            return false;
        }
        $query = <<< END_BLOCK
select
*
from
list_table
where
list_id = ?
END_BLOCK;
        $prep_arr = array($id);
        $this->select_query(
            $debug,
            $query,
            $prep_arr
        );
        return $this->fetch_assoc();
    }
    public function __destruct(){
        parent::__destruct();
    }
}
?>