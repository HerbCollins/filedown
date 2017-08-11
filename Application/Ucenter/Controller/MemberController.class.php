<?php
namespace Ucenter\Controller;
use Think\Controller;
class MemberController extends Controller{
	public function index(){
		$info = S('userInfo_'.get_uid());
		print_r($info);
	}
	public function login(){
		if(IS_AJAX){
			$email = I('post.email' , '' , 'htmlspecialchars');
			$password = I('post.password' , '' , 'encode');
			$check   = I('post.checkcode','');
			if(!$this->checkVerify($check)){
				$this->ajaxReturn(array('status' => 0,'message'=>'验证码错误'));
			}
			$rst = D('Ucenter')->doLogin($email , $password);
			if($rst){
				if($rst['first']){
					if(scoreAdd($rst['id'] , C('SCORE.LOGIN'))){
						$this->ajaxReturn(array('status' => 1, 'message' => "欢迎回来！今天首次登录积分+".C('SCORE.LOGIN') , 'path'=>U('Home/Index/index')));
					}else{
						$this->ajaxReturn(array('status' => 1, 'message' => "欢迎回来！", 'path'=>U('Home/Index/index')));
					}
				}else{
					$this->ajaxReturn(array('status' => 1, 'message' => "欢迎回来！", 'path'=>U('Home/Index/index')));
				}
			}else{
				$this->ajaxReturn(array('status'=>0,'message'=>"账号或密码错误，请重试！"));
			}
		}else{
			$this->display();
		}
	}

	public function verify(){
		$Verify = new \Think\Verify();
		$Verify->fontSize = 32;
		$Verify->length   = 5;
		$Verify->useNoise = false;
		$Verify->entry();
	}

	private function checkVerify($code){
	    $verify = new \Think\Verify();
	    return $verify->check($code);
	}

	public function register(){
		if(IS_AJAX){
			$nickname = I('post.nickname' , '' ,'htmlspecialchars');
			if(!$nickname){
				$this->ajaxReturn(array('status' => 0 ,'message' => '请正确填写昵称！'));
			}
			$email = I('post.email');
			if(!is_email($email)){
				$this->ajaxReturn(array('status' => 0 ,'message' => '邮箱格式不正确！'));
			}

			if(is_exist_email($email)){
				$this->ajaxReturn(array('status' => 0 ,'message' => '邮箱已存在，请更换其他邮箱！'));
			}
			$password  = I('post.password' ,'' ,'encode');
			$checkPwd  = I('post.checkPwd' ,'' ,'encode');
			if($password !== $checkPwd){
				$this->ajaxReturn(array('status' => 0 ,'message' => '密码不一致'));
			}
			$map['nickname'] = $nickname;
			$map['email'] = $email;
			$map['password'] = $password;
			$rst = D('Ucenter')->doRegister($map);
			if($rst){

				// 
				$url = U('emailChecked',array('param'=>encode($rst)),true,true);
				$em_send = $this->sendEmail($email , $nickname , $url);
				if($em_send){
					$this->ajaxReturn(array('status' => 1,'message'=>'确认邮件已发送！','path'=>U('checkEmail',array('param'=>encode($rst),'email'=>encode($email)))));
				}else{
					$this->ajaxReturn(array('status' => 0,'message'=>'验证邮箱发送失败！','param'=>encode($rst)));
				}
			}else{
				$this->ajaxReturn(array('status' => 0,'message'=>'服务器繁忙，请稍后重试！'));
			}

		}else{
			$this->display();
		}
	}
	
	private function sendEmail($email , $nickname , $url){
		$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>午马网注册邮箱确认函</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<!-- w3cplus.com Baidu tongji analytics -->

</head>
<body style="margin: 0; padding: 0;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">	
		<tr>
			<td style="padding: 10px 0 30px 0;">
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #f3f4f5; border-collapse: collapse;">
					<tr>
						<td bgcolor="#009688"  style="text-align:left;padding:10px 20px;">
							<p><img src="http://open.wawmam.com/wm.png" style="width:40px;float: left; "><span style="vertical-align: middle; color:#ffffff;display: inline-block;padding:10px;">知图</span></p>
							
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 20px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color:#153643;padding-bottom:25px; text-align:center; font-size: 18px;">请验证您的电子邮件地址</td>
								</tr>
								<tr>
									<td style="color: #153643; font-family: Arial, sans-serif; font-size: 18px;line-height: 2;">
										<span>尊敬的'.$nickname.'：</span>
									</td>
								</tr>
								<tr>
									<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 14px; line-height: 20px;">
										欢迎您注册 <a href="https://www.wawmam.com" style="color:#153643;" target="_blank">知图网</a>，在这里有数千款简历、PPT模板、PSD文件、Keynote模板等资源供您下载使用，现在您需要点击下方的按钮或者链接验证您的邮箱（如果不是您本人操作，请忽略此邮件）。
									</td>
								</tr>
								<tr>
									<td><a href="'.$url.'" style="display:inline-block;padding:10px 28px; background-color: #009688;color:#ffffff;text-decoration: none;" target="_blank">点击验证</a></td>

								</tr>
								<tr>
									<td style="padding:10px 0px;">
										<p>如果上方按钮点击无效，请点击下面的链接或复制到浏览器地址栏访问。</p>
										<a href="'.$url.'" style="display:inline-block;background-color: #f3f3f3; width:100%;padding:10px;color:#009688;text-decoration: none;" target="_blank">'.$url.'</a>
									</td>
								</tr>
								<tr>
									<td style="text-align:center;">(请不要回复此邮件)</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#009688" style="padding: 30px 30px 30px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
										&reg; 知图网 '.date("Y").'
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>';
		return think_send_mail($email , $nickname , '知图网注册确认函' , $html);
	}

	public function fogetPass(){

	}

	public function edit_birthday(){
		if(IS_AJAX){

			$value = I('post.value','');
			if(!$value || strtotime($value) >= time()){
				$this->ajaxReturn(array('status'=>0,'message'=>'不是生日'));
			}

			if(D('Ucenter')->save_birthday($value)){
				$this->ajaxReturn(array('status'=>1 , 'message'=>'生日更新成功'));
			}else{
				$this->ajaxReturn(array('status'=>0 , 'message'=>'生日更新失败，请稍后重试！'));
			}
		}else{
			$this->error('404');
		}
	}

	public function edit_nickname(){
		if(IS_AJAX){
			$value = I('post.value','');
			if(!$value){
				$this->ajaxReturn(array('status'=>0,'message'=>'昵称不能为空'));
			}

			if(D('Ucenter')->save_nickname($value)){
				$this->ajaxReturn(array('status'=>1 , 'message'=>'昵称更新成功'));
			}else{
				$this->ajaxReturn(array('status'=>0 , 'message'=>'昵称更新失败，请稍后重试！'));
			}
		}else{
			$this->error('404');
		}
	}

	public function edit_sex(){
		if(IS_AJAX){
			$value = I('post.value','');
			if(!$value){
				$this->ajaxReturn(array('status'=>0,'message'=>'昵称不能为空'));
			}

			if($value == "男"){
				$v = 1;
			}elseif($value == "女"){
				$v = 2;
			}else{
				$v = 0;
			}

			if(D('Ucenter')->save_sex($v)){
				$this->ajaxReturn(array('status'=>1 , 'message'=>'性别更新成功'));
			}else{
				$this->ajaxReturn(array('status'=>0 , 'message'=>'性别更新失败，请稍后重试！'));
			}
		}else{
			$this->error('404');
		}
	}

	public function edit_avatar(){
		if(IS_AJAX){
			$value = I('post.avatar','');
			if(!$value){
				$this->ajaxReturn(array('status'=>0,'message'=>'参数错误，请刷新页面重试！'));
			}
			if($value < 1 || $value > 10 || !is_numeric($value)){
				$this->ajaxReturn(array('status'=>0 , 'message' => '参数错误，请刷新页面重试！'));
			}

			if( !( $uid = get_uid() )){
				$this->ajaxReturn(array('status' => 0 , 'message' => '您需要先登录！'));
			}
			$userInfo =S('userInfo_'.$uid);

			if($value == $userInfo['ava_id']){
				$this->ajaxReturn(array('status' => 1 , 'message' => '头像未修改'));
			}

			if(D('Ucenter')->save_avatar($value)){
				$this->ajaxReturn(array('status'=>1 , 'message'=>'头像更新成功'));
			}else{
				$this->ajaxReturn(array('status'=>0 , 'message'=>'头像更新失败，请稍后重试！'));
			}
		}else{
			$this->error('404');
		}
	}

	public function emailChecked(){
		$id = I('get.param' , '' , 'decode');
		if(!$id || !is_numeric($id) || !is_uid($id)){
			$this->error('404');
		}

		if(is_checked_uid($id)){
			$this->error('邮箱已经验证',U('Ucenter/Member/login'));
		}

		$map['id'] = $id;
		$map['status']  = 1;
		$rst = D('Ucenter')->checkEmail($map);
		if($rst){
			$this->success('<i class="fa fa-fw fa-check-circle"></i>验证成功',U('Ucenter/Member/login'));
		}else{
			$this->error('<i class="fa fa-fw fa-check-circle"></i>验证成功',U('Ucenter/Member/login'));
		}

	}

	public function checkEmail(){
		$param = I('get.param','','decode');
		$email = I('get.email' ,'','decode');
		if(!$param || !is_numeric($param) || !is_uid($param)){
			$this->error(404);
		}
		if(!is_email($email) || !is_exist_email($email)){
			$this->error(404);
		}
		$e = explode('@', $email);
		$emailhost = "mail.".$e[1];
		$this->assign('email' , $email);
		$this->assign('emailhost',$emailhost);
		$this->display();
	}


}
?>