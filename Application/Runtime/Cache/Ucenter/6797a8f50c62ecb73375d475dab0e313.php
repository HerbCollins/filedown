<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title></title>
	
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/jianli/Public/css/ns-default.css" />
    <link rel="stylesheet" type="text/css" href="/jianli/Public/css/ns-style-bar.css" />
	<link href="http://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
	<link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/jianli/Public/css/style.css">

	
</head>
<body class="pc_browser">
	
	<?php echo W('Common/Menu/menu',array('current'=>$key));?>
	
	
	
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
				<form class="account-form" action="<?php echo U();?>" method="post">
					<div class="form-group">
						<input type="email" name="email" class="form-control" placeholder="请输入您的邮箱" />
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="请输入您的密码" />
					</div>
					<div class="form-group">
						<input type="text" name="checkcode" class="form-control" placeholder="请输入验证码" />
					</div>
					<div class="form-group">
						<img src="<?php echo U('verify');?>" data-verify="<?php echo U('verify');?>" id="verify" title="点击刷新" alt="">
					</div>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary">登录</button>
					</div>
				</form>
				<hr>
				<div class="traggle">
					<div class="row">
						<div class="col-md-6 text-center ">
							<p><a href="">忘记密码？</a></p>
						</div>
						<div class="col-md-6 text-left">
							<p>还没有账号？<a href="<?php echo U('register');?>">注册</a>一个</p>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>


	
	
	<script type="text/javascript" src="/jianli/Public/js/modernizr.custom.js"></script>
	<script type="text/javascript" src="/jianli/Public/js/classie.js"></script>
	<script type="text/javascript" src="/jianli/Public/js/notificationFx.js"></script>
	<script src="http://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/jianli/Public/js/message.js"></script>

	
	<script type="text/javascript">
		$('#verify').on('click',function(){
				var src = $(this).data('verify');
				$(this).attr('src',src+"?"+1000*Math.random())
			});
		$("form").submit(function(){
			var _url = $(this).attr('action');
			var method = $(this).attr('method');
			var datas = $(this).serialize();
			$.ajax({
				data:datas,
				type:method,
				dataType:"json",
				url:_url,
				success:function(data){
					message(data.message , data.status)
					if(data.status == 1){
						setTimeout(function(){window.location.href=data.path;},2000);
					}
				},
				error:function(e){
					message('error' ,0);
					console.log(e.responseText);
				}
			});
			return false;
		})
	</script>

	
</body>
</html>