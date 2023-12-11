<?php
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "function.php");
require_once($CMS_COMMON_INCLUDE_DIR . "contents_db.php");
require_once($CMS_COMMON_INCLUDE_DIR . 'auth_member.php');

function exitProcess($success,$isLogin = true) {
    $json = array();    
    $json['success'] = $success;
    $json['isLogin'] = $isLogin;
    echo json_encode($json);
    exit;
}

if(isset($_SESSION['tmD2023_mem']['user_id'])) {
    if(isset($_POST['f']) && isset($_POST['id'])) 
    {
        $user_result = (new cuser())->get_tgt(false,$_SESSION['tmD2023_mem']['user_id']);
        $list_result = (new clist())->get_tgt(false,$_POST['id']);
        if($user_result !== false && $list_result !== false) {
            $userUpdata = array();
            $listUpdata = array();
            $favList = $user_result['favorite_list'] === null ? array() : explode(',',$user_result['favorite_list']);
            $favSearchResult = array_search($_POST['id'], $favList);
            if($_POST['f'] == 1) {
                if ($favSearchResult !== false) {
                    exitProcess(true);
                }
                $favList[] = $list_result['list_id'];
                $listUpdata['favorite'] = $list_result['favorite'] + 1;
            }else {
                if ($favSearchResult === false) {
                    exitProcess(true);
                }
                unset($favList[$favSearchResult]);
                $listUpdata['favorite'] = $list_result['favorite'] - 1;
            }
            $userUpdata['favorite_list'] = count($favList) != 0 ? implode(',', $favList) : null;
            $chenge = new cchange_ex();
            $chenge->update(false,'user_table',$userUpdata,'user_id=' . $user_result['user_id']);
            $chenge->update(false,'list_table',$listUpdata,'list_id=' . $list_result['list_id']);
            exitProcess(true);
        }
    }
    exitProcess(false);
}else {
    exitProcess(false,false);
}

?>