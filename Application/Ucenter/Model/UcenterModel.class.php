<?php
namespace Ucenter\Model;
use Think\Model;

class UcenterModel extends Model{
	protected $_auto = array ( 
         array('status','0',1),  
         array('sex','0',1) , 
         array('login_num','0',1), 
         array('level','0',1), 
         array('vip','0',1),
         array('score','0',1), 
         array('birthday','date',1,'function'), // 对update_time字段在更新的时候写入当前时间戳
         array('lastip','get_client_ip',3,'function'),
         array('avatar' , 'default_avatar' , 1 , 'function'),
         array('lastlogin','date',3,'function'),
         array('created_at','date',1,'function'),
     );

	protected $_field_get = array('id','nickname','avatar','email','birthday','sex','score','level','vip','lastlogin','status'); 

	protected $_avatar_man = array(
		'1' => 'http://open.wawmam.com/avatar/avatar_man_1.jpg',
		'2' => 'http://open.wawmam.com/avatar/avatar_man_2.jpg',
		'3' => 'http://open.wawmam.com/avatar/avatar_man_3.jpg',
		'4' => 'http://open.wawmam.com/avatar/avatar_man_4.jpg',
		'5' => 'http://open.wawmam.com/avatar/avatar_man_5.jpg',
		'6' => 'http://open.wawmam.com/avatar/avatar_man_6.jpg',
		'7' => 'http://open.wawmam.com/avatar/avatar_man_7.jpg',
		'8' => 'http://open.wawmam.com/avatar/avatar_man_8.jpg',
		'9' => 'http://open.wawmam.com/avatar/avatar_man_9.jpg',
		'10' => 'http://open.wawmam.com/avatar/avatar_man_10.jpg'
		);
	protected $_avatar_woman = array(
		'1' => 'http://open.wawmam.com/avatar/avatar_woman_1.jpg',
		'2' => 'http://open.wawmam.com/avatar/avatar_woman_2.jpg',
		'3' => 'http://open.wawmam.com/avatar/avatar_woman_3.jpg',
		'4' => 'http://open.wawmam.com/avatar/avatar_woman_4.jpg',
		'5' => 'http://open.wawmam.com/avatar/avatar_woman_5.jpg',
		'6' => 'http://open.wawmam.com/avatar/avatar_woman_6.jpg',
		'7' => 'http://open.wawmam.com/avatar/avatar_woman_7.jpg',
		'8' => 'http://open.wawmam.com/avatar/avatar_woman_8.jpg',
		'9' => 'http://open.wawmam.com/avatar/avatar_woman_9.jpg',
		'10' => 'http://open.wawmam.com/avatar/avatar_woman_10.jpg',
		);

	public function doRegister($map){
		$this->create($map);
		return $this->add();
	}

	public function checkEmail($map){
		return $this->save($map);
	}

	public function doLogin($email , $password){
		$map['email'] = $email;
		$map['password'] = $password;
		$map['status']  = 1;
		$user = M('Ucenter')->where($map)->field($this->_field_get)->find();
		if($user){
			// 判断是否当天首次登录
			$lastTime = $user['lastlogin'];
			$last = strtotime($lastTime);
			$now = time();
			if($now > $last){
				$diff = floor(($now - $last) / 86400);
				if($diff == 0){
					$rst['first'] = false;
				}else{
					$rst['first'] = true;
				}
			}else{
				$rst['first'] = false;
			}

			// 头像处理
			$sex = $user['sex'];
			$user['ava_id'] = $user['avatar'];
			if($sex == 0 || $sex == 1){
				$avatar = $this->_avatar_man;
				$user['avatar'] = $avatar[$user['avatar']];
			}else{
				$avatar = $this->_avatar_woman;
				$user['avatar'] = $avatar[$user['avatar']];
			}

			if($user['vip']){
				session('is_vip',1);
			}else{
				session('is_vip',0);
			}

			// 更新最后登录
			$this->update_lastlogin($user['id']);
			// 写入缓存
			$this->write_cache($user);

			session('user_id',$user['id']);
			$rst['id'] = $user['id'];
			return $rst;
		}else{
			return false;
		}
	}

	private function update_lastlogin($uid){
		$now = date('Y-m-d H:i:s');
		$save['id'] = $uid;
		$save['lastlogin'] = $now;
		$save['lastip'] = get_client_ip();

		if(M('Ucenter')->save($save)){
			M('Ucenter')->where('id = '.$uid)->setInc('login_num');
			return true;
		}else{
			return date('Y-m-d H:i:s');
		}
	}

	private function write_cache($user ){
		return S('userInfo_'.$user['id'] , $user);
	}

	private function update_cache($uid , $field , $value ){
		$userInfo = S('userInfo_'.$uid);
		$userInfo[$field] = $value;
		return S('userInfo_'.$uid , $userInfo);
	}
	public function save_birthday($birthday){
		$map['birthday'] = $birthday;
		$uid = get_uid();
		$map['id'] = $uid;
		if($this->save($map)){
			return $this->update_cache($uid , 'birthday' , $birthday);
		}else{
			return false;
		}
	}
	public function save_nickname($nickname){
		$map['nickname'] = $nickname;
		$uid = get_uid();
		$map['id'] = $uid;
		if($this->save($map)){
			return $this->update_cache($uid , 'nickname' , $nickname);
		}else{
			return false;
		}
	}


	public function save_sex($sex){
		$map['sex'] = $sex;
		$uid = get_uid();
		$map['id'] = $uid;
		if($this->save($map)){			
			$this->update_cache($uid , 'sex' , $sex);
			$u = S('userInfo_'.$uid);
			if($sex == 0 || $sex == 1){
				$avatars = $this->_avatar_man;
			}else{
				$avatars = $this->_avatar_woman;
			}
			$avatar = $avatars[$u['ava_id']];
			$this->update_cache($uid , 'avatar' , $avatar);
			return true;
		}else{
			return false;
		}
	}

	public function save_avatar($avatar){
		$map['avatar'] = $avatar;
		$uid = get_uid();
		$map['id'] = $uid;
		if($this->save($map)){			
			$this->update_cache($uid , 'ava_id' , $avatar);
			$u = S('userInfo_'.$uid);
			$sex = $u['sex'];
			if($sex == 0 || $sex == 1){
				$avatars = $this->_avatar_man;
				$avatar_url = $avatars[$avatar];
			}else{
				$avatars = $this->_avatar_woman;
				$avatar_url = $avatars[$avatar];
			}

			$this->update_cache($uid , 'avatar' , $avatar_url);
			return true;
		}else{
			return false;
		}
	}

	public function check_org_pwd($org){
		$uid = get_uid();
		$map['id'] = $uid;
		$map['password'] = $org;
		$map['status'] = 1;
		return M('Ucenter')->where($map)->find();
	}

	public function changepwd($pwd){
		$uid = get_uid();
		$map['id'] = $uid;
		$save['password'] = $pwd;
		$map['status'] = 1;
		if(M('Ucenter')->where($map)->save($save)){
			session('user_id',null);
			return true;
		}else{
			return false;
		}
	}
}
?>