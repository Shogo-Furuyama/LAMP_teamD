<?php
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "function.php");
require_once($CMS_COMMON_INCLUDE_DIR . "contents_db.php");
require_once($CMS_COMMON_INCLUDE_DIR . "convert_isbn.php");

function create_array($value) {
    $book = array();
    $book['id'] = $value['book_id'];  
    $book['title'] = $value['book_title'];  
    $book['authors'] = $value['authors'];
    if($value['image_link'] === null) {
        $book['link'] = './img/book_no_image.jpg';
    }else if($value['is_up_img'] == 1) {
        global $CMS_FILEUP_DIR;
        $book['link'] = $CMS_FILEUP_DIR . $value['image_link'];
    }else {
        $book['link'] = $value['image_link'];
    }
    return $book;
}

if(isset($_GET['k'])) 
{
    $page = 1;
    $limit = 5;
    $sf = 0;
    if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
        $page = $_GET['page'];
    }
    if(isset($_GET['sf'])) {
        $sf = $_GET['sf'];
    }
    $json = array();
    $books = array();

    $keyword = rawurldecode($_GET['k']);
    if (!preg_match('/[^ 　]+/u',$keyword)) {
        exit;
    }
    $book_db = new cbook();
    if($sf == 2) {
        if(mb_strlen($keyword) == 13) {
            $keyword = convert_isbn::to_10($keyword);
        }
        $db_result = $book_db-> get_tgt_isbn(false, $keyword);
        if($db_result !== false) {
            $count = 1;
            $books[] = create_array($db_result);
        }else {
            $count = 0;
        }
    }else {
        $safe_keyword = $book_db->make_safe_keyword($keyword);
        $count = $sf == 0 ? $book_db-> get_t_keyword_count(false ,$safe_keyword) : $book_db-> get_a_keyword_count(false ,$safe_keyword);
        if($count != 0) {
            $db_result = $sf == 0 ? $book_db-> get_t_keyword(false ,$safe_keyword ,($page-1)*$limit ,$limit) : $book_db-> get_a_keyword(false ,$safe_keyword ,($page-1)*$limit ,$limit);
            if($db_result !== false) {
                foreach($db_result as $key => $value) {
                    $books[] = create_array($value);
                }
            }
        }
    }
    $json['count'] = $count;
    $json['limit'] = $limit;
    $json['books'] = $books;
    echo json_encode($json);
}
else if(isset($_GET['tes']))
{
    echo convert_isbn::to_10($_GET['tes']);
        
}
?>