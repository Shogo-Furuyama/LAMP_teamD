<?php
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link href="css/main.css" rel="stylesheet" type="text/css">
<title>メインメニュー</title>
<script type="text/javascript">
<!--


// -->
</script>
</head>
<body>
<!-- 全体コンテナ　-->
<div id="container">
<?php require_once("gmenu.php"); ?>
<div id="headTitle">
<h2>メインメニュー</h2>
</div>
<!-- コンテンツ　-->
<div id="contents">
<br />
<table >
<tr>
<td ><a href="member_list.php">会員一覧</a></td>
</tr>
<tr>
<td><a href="prefecture_list.php">本一覧</a></td>
</tr>
<tr>
<td><a href="member_list_smarty.php">購入履歴</a></td>
</tr>
<tr>
<td class="nobottom"><a href="prefecture_list_json.html">問い合わせ一覧</a></td>
</tr>
</table>
<p>&nbsp;</p>
</div>
<!-- /コンテンツ　-->
</div>
<!-- /全体コンテナ　-->
</body>
</html>

