<?php
/*!
@file member_list_smarty.php
@brief �����o�[�ꗗ(Smarty��)
@copyright Copyright (c) 2021 Yamanoi Yasushi.
*/

/////////////////////////////////////////////////////////////////
/// ���s�u���b�N
/////////////////////////////////////////////////////////////////

//���C�u�������C���N���[�h
require_once("inc_base.php");
require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
require_once("inc_smarty.php");
require_once($CMS_COMMON_INCLUDE_DIR . 'auth_member.php');
require_once($CMS_COMMON_INCLUDE_DIR . "submitcheck.php");

$submit_index = 'submit_inquiry';

if(!isset($_GET['subid'])) {
	cutil::redirect_exit($_SERVER['PHP_SELF'] . '?subid=' . submitcheck::generate_id(false,$submit_index));
}else if(!submitcheck::check(false,$_GET['subid'],$submit_index)) {
	cutil::redirect_exit('index.php');
}else {
	$smarty->assign('subid', $_GET['subid']);
}

$show_mode = '';
$ERR_STR = '';

//�y�[�W�̐ݒ�
//�f�t�H���g��1
$page = 1;
//�����y�[�W���w�肳��Ă�����
if (
	isset($_GET['page'])
	//�Ȃ����A������������
	&& cutil::is_number($_GET['page'])
	//�Ȃ����A0���傫��������
	&& $_GET['page'] > 0
) {
	//�p�����[�^��ݒ�
	$page = $_GET['page'];
}

//1�y�[�W�̃��~�b�g
$limit = 20;
$rows = array();

if (is_func_active()) {
	if (param_chk()) {
		switch ($_POST['func']) {
			case "del":
				$show_mode = 'del';
				//�폜����
				deljob();
				//���_�C���N�g����y�[�W�̌v�Z
				$re_page = $page;
				$obj = new cmember();
				$allcount = $obj->get_all_count(false);
				$last_page = (int) ($allcount / $limit);
				if ($allcount % $limit) {
					$last_page++;
				}
				if ($re_page > $last_page) {
					$re_page = $last_page;
				}
				//�ēǂݍ��݂̂��߂Ƀ��_�C���N�g
				cutil::redirect_exit($_SERVER['PHP_SELF']
					. '?page=' . $re_page);
				break;
			default:
				break;
		}
	}
}
$show_mode = 'edit';
//�f�[�^�̓ǂݍ���
readdata();

/////////////////////////////////////////////////////////////////
/// �֐��u���b�N
/////////////////////////////////////////////////////////////////

//--------------------------------------------------------------------------------------
/*!
@brief	�R�}���h���n���ꂽ���ǂ���
@return	�n���ꂽ��true
*/
//--------------------------------------------------------------------------------------
function is_func_active()
{
	if (isset($_POST['func']) && $_POST['func'] != "") {
		return true;
	}
	return false;
}


//--------------------------------------------------------------------------------------
/*!
@brief	�p�����[�^�̃`�F�b�N
@return	�G���[����������false
*/
//--------------------------------------------------------------------------------------
function param_chk()
{
	global $ERR_STR;
	if (
		!isset($_POST['param'])
		|| !cutil::is_number($_POST['param'])
		|| $_POST['param'] <= 0
	) {
		$ERR_STR .= "�p�����[�^���擾�ł��܂���ł���\n";
		return false;
	}
	return true;
}


//--------------------------------------------------------------------------------------
/*!
@brief	�f�[�^�ǂݍ���
@return	�Ȃ�
*/
//--------------------------------------------------------------------------------------
function readdata()
{
	global $limit;
	global $rows;
	global $page;
	$obj = new cmember();
	$from = ($page - 1) * $limit;
	$rows = $obj->get_all(false, $from, $limit);
}

//--------------------------------------------------------------------------------------
/*!
@brief	�폜
@return	�Ȃ�
*/
//--------------------------------------------------------------------------------------
function deljob()
{
	$chenge = new cchange_ex();
	if ($_POST['param'] > 0) {
		$chenge->delete(false, "member", "member_id=" . $_POST['param']);
	}
}
$str = 'Hello,World!';

//--------------------------------------------------------------------------------------
/*!
@brief	�y�[�W���̃A�T�C��
@return	�Ȃ�
*/
//--------------------------------------------------------------------------------------
function assign_str()
{
	global $str;
	global $smarty;
	$smarty->assign('str', $str);
}
function assign_page_block()
{
	//$smarty���O���[�o���錾�i�K�{�j
	global $smarty;
	global $limit;
	global $page;
	$retstr = '';
	$obj = new cmember();
	$allcount = $obj->get_all_count(false);
	$ctl = new cpager($_SERVER['PHP_SELF'], $allcount, $limit);
	$smarty->assign('pager_arr', $ctl->get('page', $page));
}


//--------------------------------------------------------------------------------------
/*!
@brief	�ꗗ�̃A�T�C��
@return	�Ȃ�
*/
//--------------------------------------------------------------------------------------
function assign_member_list()
{
	//$smarty���O���[�o���錾�i�K�{�j
	global $smarty;
	global $rows;
	$smarty->assign('rows', $rows);
}

//--------------------------------------------------------------------------------------
/*!
@brief	URI�̃A�T�C��
@return	�Ȃ�
*/
//--------------------------------------------------------------------------------------
function assign_tgt_uri()
{
	//$smarty���O���[�o���錾�i�K�{�j
	global $smarty;
	global $page;
	$smarty->assign('tgt_uri', $_SERVER['PHP_SELF'] . '?page=' . $page);
}


/////////////////////////////////////////////////////////////////
/// �֐��Ăяo���u���b�N
/////////////////////////////////////////////////////////////////
$smarty->assign('ERR_STR', $ERR_STR);
assign_page_block();
assign_member_list();
assign_tgt_uri();
assign_str();

/* データベースへ登録 */
if (!empty($_POST['inquiry_name']) && !empty($_POST['inquiry_kana']) && !empty($_POST['inquiry_mail'])
    && !empty($_POST['inquiry_tel'])  && !empty($_POST['inquiry_comment'])) {
	$dataarr = array();
	$dataarr['inquiry_name'] = (string)$_POST['inquiry_name'];
	$dataarr['inquiry_kana'] = (string)$_POST['inquiry_kana'];
	$dataarr['inquiry_mail'] = (string)$_POST['inquiry_mail'];
	$dataarr['inquiry_tel'] = (int)$_POST['inquiry_tel'];
	
	$comment = (string)$_POST['inquiry_comment'];
    preg_match("/^.{0,49}\n?/u",$comment,$match);
    $dataarr['inquiry_title'] = $match[0];
	$dataarr['inquiry_comment'] = $comment;

	$ccheng = new cchange_ex();

	$ccheng->insert(false,'inquiry_table',$dataarr);
	submitcheck::delete(false,$submit_index);
	cutil::redirect_exit('inquiry_end.php');
}



//Smarty���g�p�����\��(�e���v���[�g�t�@�C���̎w��)
$smarty->display('inquiry_form.tmpl');


?>