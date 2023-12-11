<?php
    function chk_login($admin_login,$admin_password,$flg){
        $admin = new cuser();
        $row = $admin->get_tgt_login(false,$admin_login);
        if($row === false || !isset($row['user_id'])){
            echo 'loginerr';
            return false;
        }
        if(!cutil::pw_check($admin_password,$row['password'])){
            if($flg) {
                $pass = cutil::pw_encode($row['password']);
                echo $pass;
                $datrr = array();
                $datrr['password'] = $pass;
                (new cchange_ex())->update(false, 'user_table', $datrr, 'user_id=' . $row['user_id']);
            }else {
                echo 'logpasserr';
            }
            return false;
        }else {
            echo 'success';
        }
        return true;
    }

    session_start();
    if(!isset($_SESSION['tmD2023_adm']['admin_master_id'])){
        exit;
    }
    require_once("inc_base.php");
    require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
    if(isset($_POST['mail']) && isset($_POST['pass'])) {
        //chk_login($_POST['mail'],$_POST['pass'],isset($_POST['regi']) && isset($_POST['regi2']) && isset($_POST['regi3']));
    }
    if(isset($_POST['textaaa'])) {
        $pattern="/^.{0,49}\n?/u";
        preg_match($pattern,$_POST['textaaa'],$match);
        print $match[0];
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <form name="form" method="POST">
        <input name="mail" id="a"></input>
        <input name="pass" id="a"></input>
        <input type="checkbox" name="regi" id="a"></input>
        <input type="checkbox" name="regi2" id="a"></input>
        <input type="checkbox" name="regi3" id="a"></input>
        <textarea name="textaaa"></textarea>
        <button type="submit" onclick="testA()">てすと</button>
    </form>
    <script>
        function testA() {
            const node = document.getElementById('a');
            if(node.value.match('^[a-zA-Z0-9_+-]+(\\.[a-zA-Z0-9_+-]+)*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\\.)+[a-zA-Z]{2,}$')) {
                document.form.submit();
            }
        }
    </script>
</body>
</html>