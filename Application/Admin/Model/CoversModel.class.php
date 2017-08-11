<?php
namespace Admin\Model;
use Think\Model;

class CoversModel extends Model{
	public function coverSave($map){
        return M('Covers')->add($map);
	}
}
?>