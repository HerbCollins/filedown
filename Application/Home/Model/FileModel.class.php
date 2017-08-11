<?php
namespace Home\Model;
use Think\Model;

class FileModel extends Model{
	public function getBaseInfo($id){

		if(!APP_DEBUG){
			$info = S('getBaseInfo_'.$id);
			if(!$info){
				$info = $this->BaseInfo($id);
			}
			return $info;
		}else{
			return $this->BaseInfo($id);
		}

	}

	public function BaseInfo($id){
		$M = M('File');
		$map['id'] = $id;
		$map['status'] = 1;
		$info = $M->where($map)->field('id,cate_id , page ,first_cover,cover,filename , type , ext ,size , heart , download')->find();
		if(!APP_DEBUG){
			S('getBaseInfo_'.$id , $info);
		}
		return $info;
	}

	/**
	 *  下载次数加1
	 */
	public function IncDown($id){
		$M = M('File');

		$map['id'] = $id;
		$map['status'] = 1;
		$rst = $M->where($map)->setInc('download');
		if(!APP_DEBUG){
			// 更新缓存
			if($rst){
				$info = S('getBaseInfo_'.$id);
				$info['download']++;
				S('getBaseInfo_'.$id , $info );
				return true;
			}
		}
		return $rst;
	}

	public function IncHeart($id){
		$M = M('File');

		$map['id'] = $id;
		$map['status'] = 1;
		$rst = $M->where($map)->setInc('heart');
		if(!APP_DEBUG){
			// 更新缓存
			if($rst){
				$info = S('getBaseInfo_'.$id);
				$info['heart']++;
				S('getBaseInfo_'.$id , $info);
				return true;
			}
		}
		return $rst;
	}

	public function DecHeart($id){
		$M = M('File');

		$map['id'] = $id;
		$map['status'] = 1;
		$rst = $M->where($map)->setInc('heart');
		if(!APP_DEBUG){
			// 更新缓存
			if($rst){
				$info = S('getBaseInfo_'.$id);
				$info['heart']--;
				S('getBaseInfo_'.$id , $info);
				return true;
			}
		}
		return $rst;
	}

	public function getFileUrl($id){

		if(!APP_DEBUG){
			$url = S('fileSaveUrl_'.$id);
			if(!$url){
				$M = M('File');
				$map['id'] = $id;
				$map['status'] = 1;
				$url = $M->where($map)->field('savepath')->find();
				S('fileSaveUrl_'.$id , $url['savepath']);
				return $url['savepath'];
			}else{
				return $url;
			}
		}else{
			$M = M('File');
			$map['id'] = $id;
			$map['status'] = 1;
			$url = $M->where($map)->field('savepath')->find();
			return $url['savepath'];
		}
	}
}
?>