<?php
namespace Admin\Controller;

class UcenterController extends BaseController{

	public function config(){
		
	}

	public function search(){
		if(IS_AJAX){
			$email = I('post.email');
			$map['email'] = $email;
			$rst = D('Ucenter')->where($map)->find();
			if($rst){
				$this->ajaxReturn(array('status' => 1 , 'data' => $rst));
			}else{
				$this->ajaxReturn(array('status' => 0 , 'message' => '没找到'));
			}
		}else{
			$this->display();
		}
	}


	public function toVip(){
		if(IS_AJAX){

			$id 		= I('post.id');
			$email 		= I('post.email');
			$nickname 	= I('post.nickname');
			// if(!is_login() || 1 != get_uid()){
			// 	$this->ajaxReturn(array('status' => 0 ,'message' => '没有权限'));
			// }
			$map['id'] 	= $id;
			$set['vip'] = 1;
			$rst = M('Ucenter')->where($map)->save($set);
			if($rst){
				//  发送升级邮件
				$emailsend = $this->sendEmail($email , $nickname );
				if($emailsend){
					$this->ajaxReturn(array('status' => 1 ,'message' => '升级成功'));
				}else{
					$this->ajaxReturn(array('status' => 0 ,'message' => '升级成功，但邮件发送失败'));
				}

			}else{
				$this->ajaxReturn(array('status' => 0 , 'message' => '升级失败'));
			}
		}else{
			$this->error('404');
		}
	}

		private function sendEmail($email , $nickname){
			$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<title>知图网终身会员升级成功告知函</title>
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
												<td style="color:#153643;padding-bottom:25px; text-align:center; font-size: 18px;line-height:20px">知图网终身会员升级成功告知函</td>
											</tr>
											<tr>
												<td style="color: #153643; font-family: Arial, sans-serif; font-size: 18px;line-height: 20px;">
													<span>尊敬的'.$nickname.'：</span>
												</td>
											</tr>
											<tr>
												<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 14px; line-height: 20px;">
													<p>恭喜您已成功升级成为知图网终身会员，从这一刻开始，您可以尽享全站资源永久无限下载，我们将定期更新网站内容，并开放其他功能模块，以备您将来工作需要。</p>
													<p>关于其他模块，将包括PPT模块、PSD素材模块以及KeyNote模块，如果您希望我们开设其他的模块供您使用，您可以发送邮件到open@wawmam.com告知我们，我们尽快进行处理并向您回复。</p>

												</td>
											</tr>
											<tr>
												<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 14px; line-height: 20px;text-align:right;">
													<p>知图网团队 敬上</p>
													<p>'.date("Y年m月d日").'</p>
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
		return think_send_mail($email , $nickname , '知图网终身会员升级成功告知函' , $html);
		}
}
?>