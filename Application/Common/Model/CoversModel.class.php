<?php
namespace Common\Model;
use Think\Model;
class CoversModel extends Model{
	public function getImgPath($id){
		$map['id'] = $id;
		$img = M('Covers')->where($map)->field('savepath')->find();
		return $img['savepath'];
	}

	public function getImages($ids){
		$arr = explode(',', $ids);
		$map['id'] = array('in',$arr);
		$img = M('Covers')->where($map)->field('savepath')->select();
		return $img;
	}

	public function getFirstImgPath($id){
		$map['id'] = $id;
		$img = M('File')->where($map)->field('first_cover')->find();
		$map['id'] = $img['first_cover'];
		$path = M('Covers')->where($map)->field('savepath')->find();
		return $path['savepath'];
	}
}
?>