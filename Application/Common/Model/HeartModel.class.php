<?php
namespace Common\Model;
use Think\Model;

class HeartModel extends Model{
	public function add_heart($uid , $fid){
		$map['uid'] = $uid;
		$map['fid'] = $fid;
		// 如果已经存在
		if($info = $this->where($map)->find()){
			if($info['status'] == 1){
				return true;
			}
			$update['updated_at'] = date("Y-m-d H:i:s");
			$update['status'] = 1;
			return $this->where($map)->save($update);
		}else{
			$map['created_at'] = $map['updated_at'] = date('Y-m-d H:i:s');
			$map['status'] = 1;
			return $this->add($map);
		}
		
	}

	public function remove_heart($uid , $fid){
		$map['uid'] = $uid;
		$map['fid'] = $fid;
		if($info = $this->where($map)->find()){
			if($info['status'] == 0){
				return true;
			}
			$update['updated_at'] = date("Y-m-d H:i:s");
			$update['status'] = 0;
			return $this->where($map)->save($update);
		}else{
			return false;
		}
		
	}

	public function is_heart($fid){
		if(!($uid = get_uid())){
			return 0;
		}
		$map['uid'] = $uid;
		$map['fid'] = $fid;
		$map['status'] = 1;
		if($this->where($map)->find()){
			return 1;
		}else{
			return 0;
		}
	}
}
?>