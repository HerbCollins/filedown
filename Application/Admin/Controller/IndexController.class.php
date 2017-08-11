<?php
namespace Admin\Controller;

class IndexController extends BaseController {
    public function index(){
    	// echo decode('kuDXWdVsT1dyWJul3Vwjp9q4DLN7clH-gz0lhRmDzw8');
    	$this->income();
    	$this->usercount();
    	$this->heart();
    	$this->download();

		$this->display();
    }

    private function usercount(){
    	$count = D('Ucenter')->where(' status = 1')->count();
    	$this->assign('usercount' , $count);
    }

    private function income(){
    		$income = D('Ucenter')->where(' vip = 1 and status = 1')->count();
    		$income *= 2;

    	$this->assign('income' , $income);
    }

    private function heart(){
    	$heart = D('File')->where('status = 1')->sum('heart');
    	$this->assign('heart' , $heart);
    }

    private function download(){
    	$download = D('File')->where('status = 1')->sum('download');
    	$this->assign('download' , $download);
    }

    public function user_present(){
    	if(IS_AJAX){
    		$common = D('Ucenter')->where('vip = 0 and status = 1')->count();
    		$vip    = D('Ucenter')->where('vip = 1 and status = 1')->count();
    		$not_check=D('Ucenter')->where('vip = 0 and status = 0')->count();
    		$data = array(
    			array('value'=>$common,'label'=>'普通会员','formatted'=>'共'.$common),
    			array('value'=>$vip,'label'=>'终身会员','formatted'=>'共'.$vip),
    			array('value'=>$not_check,'label'=>'未确认邮件','formatted'=>'共'.$not_check),
    			);
    		$this->ajaxReturn(array('status' => 1 , 'data' => $data));
    	}else{
    		$this->error('404');
    	}
    }

    public function download_file(){
    	if(IS_AJAX){
    		$word = D('File')->where('cate_id = 2 and status = 1')->sum('download');
    		$psd  = D('File')->where('cate_id = 3 and status = 1')->sum('download');
    		$ppt  = D('File')->where('cate_id = 5 and status = 1')->sum('download');
    		$excel  = D('File')->where('cate_id = 4 and status = 1')->sum('download');
    		$word = $word ? $word : 0;
    		$psd  = $psd  ? $psd  : 0;
    		$ppt  = $ppt  ? $ppt  : 0;
    		$excel= $excel? $excel: 0;
    		$data = array(
    			array('value'=>$word,'label'=>'WORD','formatted'=>'共下载'.$word),
    			array('value'=>$psd,'label'=>'PSD','formatted'=>'共下载'.$psd),
    			array('value'=>$ppt,'label'=>'PPT','formatted'=>'共下载'.$ppt),
    			array('value'=>$excel,'label'=>'EXCEL','formatted'=>'共下载'.$excel),
    			);
    		$this->ajaxReturn(array('status' => 1 , 'data' => $data));
    	}else{
    		$this->error('404');
    	}
    }

    public function heart_download(){
    	if(IS_AJAX){

    		$sql_download = "SELECT month(download_at) as month ,COUNT(*) as c FROM wm_download WHERE year(download_at) = DATE_FORMAT(NOW(), '%Y') GROUP BY month(download_at);";
    		$download = D('Download')->query($sql_download);

    		$sql_heart = "SELECT month(updated_at) as month ,COUNT(*) as c FROM wm_heart WHERE year(updated_at) = DATE_FORMAT(NOW(), '%Y') AND status = 1 GROUP BY month(updated_at);";
    		$heart = D('Download')->query($sql_heart);

    		$get_down = array();
    		foreach ($download as $k => $v) {
    			$m = $v['month'];
    			$get_down[$m] = $v['c'];
    		}

    		$get_heart = array();
    		foreach ($heart as $k  => $v ) {
    			$m = $v['month'];
    			$get_heart[$m] = $v['c'];
    		}

    		for ($i=1; $i <= date('m') ; $i++) { 
    			if(isset($get_down[$i])){
    				$new_down[$i] = array($i , $get_down[$i]);
    			}else{
    				$new_down[$i] = array($i , 0);
    			}
    		}

    		for ($i=1; $i <= date('m') ; $i++) { 
    			if(isset($get_heart[$i])){
    				$new_heart[$i] = array($i,$get_heart[$i]);
    			}else{
    				$new_heart[$i] = array($i , 0);
    			}
    		}

    		$this->ajaxReturn(array('status' => 1 , 'heart' => $new_heart , 'download' => $new_down));
    	}else{
    		$this->error('404');
    	}
    }
}