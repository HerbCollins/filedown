<?php
namespace Common\Widget;
use Think\Controller;

class MenuWidget extends Controller{
	public function menu($current){
		$menus = D('Common/Category')->list_menus();
		$this->assign('current' , $current);
		$this->assign('menus' , $menus);
		$this->display(T('Common@Public:menu'));
	}
}
?>