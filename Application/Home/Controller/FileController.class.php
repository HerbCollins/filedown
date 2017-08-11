<?php
namespace Home\Controller;
use Think\Controller;

class FileController extends Controller{
	public function detail(){
		$id = I('get.id','' , 'decode');
		if(empty($id)){
			$this->error($id.'参数错误');
		}

		$D = D('File');

		$info = $D->getBaseInfo($id);
		$full = C('DOWNLOAD_NUM_ALLOW');
		$is_vip = is_vip();
		$used = cookie('download_num_today_'.get_uid())?cookie('download_num_today_'.get_uid()):0;

		if($info){
			$this->assign('full',$full);
			$this->assign('used',$used);
			$this->assign('info' , $info);
			$this->assign('is_vip',$is_vip);
			$this->assign('is_heart',is_heart($id));
			$this->display();
		}else{
			$this->error('该文件不存在，可能被删除了！');
		}
	}

	public function toDown(){
		if(IS_AJAX){
			// 登录验证
			if(!($uid = get_uid())){
				$this->ajaxReturn(array('status'=>2,'message'=>"请登先录！",'path'=>U('Ucenter/Member/login')));
			}

			$id = I('post.param' , '' , 'decode');
			if(empty($id) || !is_numeric($id)){
				$this->ajaxReturn(array('status' => 0 , 'message' => '参数错误！'));
			}

			$D = D('File');
			$savepath = $D->getFileUrl($id);

			if($savepath){
				$realPath = Qiniu_Sign($savepath);

				//  下载次数加一
				D('File')->IncDown($id);
				
				//	用户下载数据记录

				// 判断下载次数是否已满
				if(!is_vip()){
					if(is_full_download($uid)){
						$this->ajaxReturn(array('status'=>0,'message'=>'今天下载次数已达到上限！','path'=>U('full_tips')));
					}
				}
				
				downloadLog($uid,$id);

				$this->ajaxReturn(array('status' => 1 , 'path' => $realPath));

			}else{
				$this->ajaxReturn(array('status' => 0 , 'message' => '抱歉，文件可能丢失！'));
			}

		}else{
			$this->error('参数错误');
		}
	}

	public function download(){
		// 登录验证
		if(!($uid = get_uid())){
			$this->redirect('Ucenter/Member/login');
		}

		// 判断下载次数是否已满
		if(!is_vip()){
			if(is_full_download($uid)){
				$this->redirect('full_tips');
			}
		}
			

		$id = I('get.param' ,'' , 'decode');
		if(empty($id) || !is_numeric($id)){
			$this->error('参数错误');
		}
		$recommend  = getRecommend();
		$this->assign('recommend',$recommend);
		$this->assign('id',encode($id));
		$this->display();
	}

	public function full_tips(){
		$full = C('DOWNLOAD_NUM_ALLOW');
		$this->assign('full',$full);
		$this->display();
	}

	public function heart(){
		if(IS_AJAX){
			$fid = I('post.param','','decode');
			$status = I('post.is_heart');
			if($status != 0 && $status != 1){
				$this->ajaxReturn(array('status' => 0 ,'message' =>'操作失败，请刷新页面重试！'));
			}
			if(!$fid || !is_numeric($fid)){
				$this->ajaxReturn(array('status' => 0 ,'message' =>'收藏失败，请刷新页面重试！'));
			}

			$uid = get_uid();
			if(!$uid){
				$this->ajaxReturn(array('status' => 0 ,'message' =>'请您先登录！','path'=>U('Ucenter/Member/login')));
			}
			if($status == 0){
				// 增加 File 收藏总数和收个人收藏记录
				$rst = add_heart_log($uid , $fid);
				$msg = '已收藏';
			}else{
				$rst = remove_heart_log($uid,$fid);
				$msg = "已取消收藏";
			}
				

			if($rst){
				$this->ajaxReturn(array('status' => 1,'message' => $msg));
			}else{
				$this->ajaxReturn(array('status' => 0,'message' => '收藏失败，请稍后重试！'));
			}
		}else{
			$this->error('404');
		}
	}

}

?>