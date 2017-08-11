<?php
namespace Common\Model;
use Think\Model;

class CategoryModel extends Model{
	public function list_menus(){
		// S('web_menus',null);
		if(!($list = S('web_menus'))){
			$list = $this->where('status = 1')->select();
			S('web_menus',$list);
		}
		return $list;
	}
}
?>