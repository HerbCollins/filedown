<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	
    	$array = array(1,2,3,4,5);
    	$key = I('get.key' , '1');
    	if(!in_array($key , $array)){
    		$key = 1;
    	}

    	if($key == 1){
    		$lists = $this->all();
    	}else{
    		$lists = $this->key_lists($key);
    	}
    	$count = count($lists);

    	$p = I('get.p')?I('get.p'):1;
    	if(!is_numeric($p)){
    		$p = 1;
    	}
    	$p_number = 24;

    	if( ($p - 1) * $p_number > $count ){
    		$this->error("404");
    	}

    	if(!S('heart_sum')){
    		S('heart_sum' , sum_arraykey($lists,'heart'));
    	}
    	if(!S('download_sum')){
    		S('download_sum' , sum_arraykey($lists,'download'));
    	}

    	$this->assign('count',$count);
    	$this->assign('heart',S('heart_sum'));
    	$this->assign('download',S('download_sum'));

    	$start = ( $p - 1 )* $p_number;
    	$end   = ( $p * $p_number ) <= $count ? ( $p * $p_number -1 ) : $count - 1;

    	$list = array();
    	for ($i = $start; $i <= $end ; $i++) { 
    		$list[] = $lists[$i];
    	}
    	$this->assign('list',$list);


    	$page_class = new \Think\Page($count , $p_number);
    	$show = $page_class->show();
    	$this->assign('page',$show);
        $this->display();
    }

    private function all(){
    	// $lists = S('Jianli_list');
    	// if(!$lists){
    		$lists = D('File')->where('status = 1')->field('id,cate_id,page,first_cover,heart,download')->select();
    		$lists = array_values($lists);
    		// S('Jianli_list' , $lists);
    	// }
    	return $lists;
    }

    private function key_lists($key){
    	$lists = S('Jianli_'.$key.'_list');
    	$map['status'] = 1;
    	$map['cate_id'] = 2;
    	if(!$lists){
    		$lists = D('File')->where($map)->field('id,cate_id,page,first_cover,heart,download')->select();
    		$lists = array_values($lists);
    		S('Jianli_'.$key.'_list' , $lists);
    	}
    	return $lists;
    }

    public function _empty(){
    	$this->error('404');
    }
}