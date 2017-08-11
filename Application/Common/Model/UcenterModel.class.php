<?php
namespace Common\Model;
use Think\Model;

class UcenterModel extends Model{
	public function is_exist_email($email){
		$map['email'] = $email;
		return M('Ucenter')->where($map)->find();
	}

	public function is_uid($uid){
		$map['id'] = $uid;
		return M('Ucenter')->where($map)->find();
	}

	public function is_checked_uid($uid){
		$map['id'] = $uid;
		$map['status'] = 1;
		return M('Ucenter')->where($map)->find();
	}

	public function scoreAdd($uid , $score){
		if(!is_numeric($score)){
			return false;
		}
		$map['id'] = $uid;
		$rst = M('Ucenter')->where($map)->setInc('score',$score);
		if($rst){
			$user = S('userInfo_'.$uid);
			$user['score'] += $score;
			S('userInfo_'.$uid , $user);
			return true;
		}else{
			return false;
		}
	}

	public function query_user($uid ,$field){
		$user  = S('userInfo_'.$uid);
		return $user[$field];
	}
}
?>