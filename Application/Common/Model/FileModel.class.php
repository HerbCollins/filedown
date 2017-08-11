<?php
namespace Common\Model;
use Think\Model;
class FileModel extends Model{

	// 推荐
	public function recommend(){
		if(!APP_DEBUG){
			$info = S('recommend');
			if(!$info){
				$info = $this->recomNew();
				// 缓存24小时
				S('recommend',$info,86400);
			}
		}else{
			$info =  $this->recomNew();
		}

		return $info;
	}

	public function recomNew(){
		return M('File')->where('status = 1')->order('download DESC')->limit(0,8)->select();
	}

	public function add_heart($fid){
		$map['id'] = $fid;
		return $this->where($map)->setInc('heart');
	}

	public function remove_heart($fid){
		$map['id'] = $fid;
		return $this->where($map)->setDec('heart');
	}
}
?>