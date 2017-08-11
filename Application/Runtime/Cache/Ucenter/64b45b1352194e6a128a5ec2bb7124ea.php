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
	<div class="container" style="padding:20px">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
				<div class="row">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center" style="color:#009688;padding:20px 0px">
						<span><i class="fa fa-fw fa-check-circle fa-3x" ></i></span>
					</div>
					<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<h2>确认邮件已发送至您的邮箱<span>(<?php echo ($email); ?>)</span>！</h2>
						<h3><a href="http://<?php echo ($emailhost); ?>" class="btn btn-primary" target="_blank">去验证</a></h3>
						<p>未收到邮件？<button type="button" class="btn-primary btn-link">重新发送</button></p>
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
				
				if(nickname.length < 6 || nickname.length >20){
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
							setTimeout(function(){window.location.href=data.url;},1000);
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