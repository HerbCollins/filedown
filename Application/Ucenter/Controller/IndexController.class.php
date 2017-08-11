<?php
namespace Ucenter\Controller;

class IndexController extends BaseController {
    public function index(){
    	if(($type = I('get.type')) == 'download'){
    		$this->download();
    	}else{
    		$this->heart();
    	}
		$this->display(); // 输出模板

    }

    private function heart(){
    	$map['uid'] = get_uid();
    	$map['status'] = 1;
    	$heart = D('Heart')->where($map)->order('updated_at DESC')->getField('fid',true);
    	if($heart){
    		
	    	$select['id'] = array('in',$heart);
	    	$select['status'] = 1;

	    	$file = M('File'); // 实例化User对象
			$count      = $file->where($select)->count();// 查询满足要求的总记录数

			$Page       = new \Think\Page($count,20);// 实例化分页类 
			$show       = $Page->show();// 分页显示输出
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $file->where($select)->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
    	}
    	$this->assign('type','我的收藏');
    }

    private function download(){
    	$this->assign('type','我的下载');
    	$map['uid'] = get_uid();
    	$map['status'] = 1;
    	$download = D('Download')->where($map)->getField('fid',true);
    	if($download){
    		
	    	$select['id'] = array('in',$download);
	    	$select['status'] = 1;

	    	$file = M('File'); // 实例化User对象
			$count      = $file->where($select)->count();// 查询满足要求的总记录数

			$Page       = new \Think\Page($count,20);// 实例化分页类 
			$show       = $Page->show();// 分页显示输出
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $file->where($select)->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
    	}
    }

    public function changepwd(){
		if(IS_AJAX){
			$org = I('post.orgpwd' , '' ,'encode');
			$new = I('post.newpwd' , '' , 'encode');
			$check = I('post.checkpwd' , '' , 'encode');
			if($new != $check){
				$this->ajaxReturn(array('status' => 0 ,'message'=>'新密码与确认密码不一致，请确认检查'));
			}

			if(strlen($new) < 6){
				$this->ajaxReturn(array('status' => 0 ,'message'=>'新密码长度太短，至少要6位'));
			}
			if(!(D('Ucenter')->check_org_pwd($org))){
				$this->ajaxReturn(array('status' => 0 ,'message'=>'原始密码错误，请修改重试！'));
			}


			if(D('Ucenter')->changepwd($new)){
				$this->ajaxReturn(array('status' => 1 ,'message'=>'密码修改成功，即将跳转至登录界面！' , 'path' => U('Ucenter/Member/login')));
			}else{
				$this->ajaxReturn(array('status' => 0 ,'message'=>'密码修改失败，请稍后重试！'));
			}
		}else{
			$this->display();
		}
	}

    public function _empty(){
    	$this->error('404');
    }

    public function config(){
    	$this->display();
    }
}