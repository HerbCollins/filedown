<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>简历</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="/jianli/Public/css/ns-default.css" />
    <link rel="stylesheet" type="text/css" href="/jianli/Public/css/ns-style-bar.css" />
	<link href="http://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
	<link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/jianli/Public/css/style.css">
</head>
<body class="pc_browser login-register">
	<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">简历模板</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
				<form class="account-form" action="<?php echo U();?>" method="post">
					<div class="form-group">
						<input type="text" name="nickname" class="form-control" placeholder="请输入您的昵称" />
					</div>
					<div class="form-group">
						<input type="email" name="email" class="form-control" placeholder="请输入您的邮箱" />
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="请输入您的密码" />
					</div>
					<div class="form-group">
						<input type="password" name="checkPwd" class="form-control" placeholder="请再次输入您的密码" />
					</div>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary">注册</button>
					</div>
				</form>
				<hr>
				<div class="traggle">
					<div class="row">
						<div class="col-md-12 text-center">
							<p>已有账号？<a href="<?php echo U('login');?>">登录</a></p>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid footer">
		
	</div>
	<script type="text/javascript" src="/jianli/Public/js/modernizr.custom.js"></script>
	<script type="text/javascript" src="/jianli/Public/js/classie.js"></script>
	<script type="text/javascript" src="/jianli/Public/js/notificationFx.js"></script>
	<script src="http://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/jianli/Public/js/message.js"></script>
	<script type="text/javascript">
		$(window).ready(function(){
			$("form").submit(function(){
				var password = $("input[name='password']").val();
				var checkPwd = $("input[name='checkPwd']").val();
				var nickname = $("input[name='nickname']").val();
				var datas = $(this).serialize();
				var method = $(this).attr('method');
				var _url  = $(this).attr('action');
				
				if(nickname.length <=0 || nickname.length >20){
					message('用户名长度请在6至20位之间',0);
					return false;
				}
				if(password !== checkPwd){
					message('两次密码不一致，请重新输入！',0);
					return false;
				}
				$.ajax({
					data:datas,
					url:_url,
					dataType:"json",
					type:method,
					success:function(data){
						message(data.message,data.status);
						if(data.status == 1){
							setTimeout(function(){window.location.href=data.path;},1000);
						}
					},
					error:function(e){
						message('error',0);
						console.log(e.responseText);
					}
				})
				return false;
			})
		})
	</script>
</body>
</html>