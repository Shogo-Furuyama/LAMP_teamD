<?php

////////////////////////////////////
//クラスブロック

class fileupload {
//--------------------------------------------------------------------------------------
/*!
@brief  ファイルのアップロード
@param[in]  $imagefile  イメージ変数名
@param[in]  $imagesize  最大ファイルサイズ（byte単位な為注意 1MB -> 1024 * 1024 ）
@param[in]  $pathext  アップロードを許可する拡張子名（ドットも含める。半角小文字で記述）
@param[in]  $subdir  サブディレクトリ('2017/')など
@param[in]  $headstr  先頭につける文字列
@param[in]  $FILEUP_DIR  アップロード先のディレクトリパス
@param[in]  $err_array 必要ならつっこめ
@return 成功すればファイルパスを返す 失敗すればfalse
*/
//--------------------------------------------------------------------------------------
public function upload($imagefile,$imagesize,$pathext,$subdir,$headstr,$FILEUP_DIR,$err_array = null){
    if(!isset($_FILES[$imagefile]['name']) || $_FILES[$imagefile]['name'] == ""){
        return false;
    }
    if($_FILES[$imagefile]['error'] == 0){
        if($_FILES[$imagefile]['size'] > $imagesize) {
			if(!is_null($err_array)) {
				$err_array[$imagefile] = "アップロードファイルのサイズが超過しています";
			}
			return false;
        }
        $ext_dot_str = strtolower(strrchr($_FILES[$imagefile]['name'],"."));
		$okflg = false;
		foreach($pathext as $key => $val){
			if($ext_dot_str == $val){
				$okflg = true;
				break;
			}
		}
		if(!$okflg){
			if(!is_null($err_array)) {
				$err_array[$imagefile] = "アップロードファイルの種類が許可されてません";
			}
			return false;
		}
        //保存されるファイル名は目的に合わせて変更する
        $datastr = $subdir . $headstr . date("YmdHis") . strrchr($_FILES[$imagefile]['name'],".");
        $uppath = $FILEUP_DIR . $datastr;
        if (!move_uploaded_file($_FILES[$imagefile]['tmp_name'],
            $uppath)) {				
			if(!is_null($err_array)) {
				$err_array[$imagefile] .= "アップロードに失敗しました";
			}
            return false;
        }
        else{
            chmod($uppath,0646);
            return $datastr;
        }
    }
    else{
		if(!is_null($err_array)) {
			$err_array[$imagefile] = get_upload_err($imagefile);
		}
        return false;
    }
}

//--------------------------------------------------------------------------------------
/*!
@brief  ファイルアップエラーの取得
@param[in]  $upfile  イメージ変数名
@return エラー文字列
*/
//--------------------------------------------------------------------------------------
function get_upload_err($upfile){
	$str = '';
    switch($_FILES[$upfile]['error']){
        case 1:
        case 2:
            $str = "アップロードされたファイルサイズが上限を越えています。\n";
        break;
        case 3:
            $str = "アップロードされたファイルは一部しかアップロードされませんでした。\n";
        break;
        case 4:
            $str = "画像ファイルはアップロードされませんでした\n";
        break;
        case 6:
            $str = "テンポラリフォルダがありません。管理者に連絡して下さい。\n";
        break;
        case 7:
            $str = "テンポラリファイルへのディスク書き込みに失敗しました。管理者に連絡して下さい。\n";
        break;
        default:
            $str = "原因不明のエラーです。管理者に連絡して下さい。\n";
        break;
    }
    return $str;
}
}

