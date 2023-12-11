<?php
class submitcheck {
	//--------------------------------------------------------------------------------------
	/*!
	@brief	2重サブミットでないかチェック
	@param[in] $flg	管理者画面は true それ以外は false 
	@param[in] $id	比較するsubmit_id
	@param[in] $submit_index 設定した添え字
	@return	2重サブミットの場合false
	*/
	//--------------------------------------------------------------------------------------
	public static function check($flg,$id,$submit_index = 'submit_id'){
		if(isset($_SESSION[$flg?'tmD2023_adm':'tmD2023_mem'][$submit_index])) {
			return $_SESSION[$flg?'tmD2023_adm':'tmD2023_mem'][$submit_index] == $id;
		} 
		return false;
	}

	//--------------------------------------------------------------------------------------
	/*!
	@brief	サブミットIDを削除
	@param[in] $flg	管理者画面は true それ以外は false
	@param[in] $submit_index 設定する添え字
	@return	なし
	*/
	//--------------------------------------------------------------------------------------
	public static function delete($flg,$submit_index = 'submit_id'){
		unset($_SESSION[$flg?'tmD2023_adm':'tmD2023_mem'][$submit_index]);
	}

	//--------------------------------------------------------------------------------------
	/*!
	@brief	サブミットIDを生成
	@param[in] $flg	管理者画面は true それ以外は false
	@param[in] $submit_index 設定する添え字
	@return	生成したID
	*/
	//--------------------------------------------------------------------------------------
	public static function generate_id($flg,$submit_index = 'submit_id') {
		$id = mt_rand();
		$_SESSION[$flg?'tmD2023_adm':'tmD2023_mem'][$submit_index] = $id;
		return $id;
	}
}

