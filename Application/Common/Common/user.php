<?php
function downloadLog($uid , $fid){
	return D('Common/Download')->add_log($uid , $fid);
}

function add_heart_log($uid , $fid){
	if(D('Common/Heart')->add_heart($uid , $fid))
		return D('Common/File')->add_heart($fid);
	else
		return false;
}

function remove_heart_log($uid , $fid){
	if(D('Common/Heart')->remove_heart($uid , $fid))
		return D('Common/File')->remove_heart($fid);
	else
		return false;
}
function is_heart($fid){
	return D('Common/Heart')->is_heart($fid);
}

function get_avatar_path($uid){
	return query_user($uid,'avatar');
}

function get_nickname($uid){
	return query_user($uid , 'nickname');
}
function get_user_birthday($uid){
	return query_user($uid,'birthday');
}

function get_user_email($uid){
	return query_user($uid , 'email');
}
function get_user_sex($uid){
	$sex = query_user($uid ,'sex');
	if($sex){
		if($sex== 1){
			return "男";
		}else{
			return "女";
		}
	}else{
		return "未知";
	}
}

function get_user_score($uid){
	return query_user($uid , 'score');
}

function get_user_vip($uid){
	if(is_vip($uid)){
		return "终身会员";
	}else{
		return "普通会员";
	}
}
function query_user($uid , $field){
	return D('Common/Ucenter')->query_user($uid,$field);
}
?>