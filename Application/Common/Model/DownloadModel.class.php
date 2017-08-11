<?php
namespace Common\Model;
use Think\Model;

class DownloadModel extends Model{
	public function add_log($uid , $fid){
		$map['uid'] = $uid;
		$map['fid'] = $fid;
		$map['download_at'] = date('Y-m-d H:i:s');
		$map['status'] = 1;
		return $this->add($map);
	}
}
?>