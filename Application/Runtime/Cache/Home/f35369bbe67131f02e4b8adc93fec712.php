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
	
	
	<div class="container download">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="full-content">
					<div class="row text-center">
						<div class="col-xs-12">
							<h1><i class="fa fa-fw fa-warning"></i>您当前身份为普通用户，每天最多下载 <?php echo ($full); ?> 份文件。</h1>
							<hr>
						</div>
		
						<div class="col-xs-12">

							<div class="row">
								<div class="col-xs-12">
									<table class="table table-bordered">
										<tr>
											<td colspan="5">
												<big><b>加入终身会员计划，只需要 2 元，即可永久、无限下载全站资源</b></big>
											</td>
										</tr>
										<tr>
											<td>简历模板</td>
											<td>PPT模板</td>
											<td>PSD素材</td>
											<td>Keynote</td>
											<td>...</td>
										</tr>
										<tr>
											<td>
												<p>10000+份简历模板</p>
												<p>持续更新</p>
												<p>随意下载</p>
												<p>(求职必备)</p>
											</td>
											<td>
												<p>3000+份PPT模板</p>
												<p>持续更新</p>
												<p>随意下载</p>
												<p>(入职必备)</p>
											</td>
											<td>
												<p>12000+份PSD源文件</p>
												<p>持续更新</p>
												<p>随意下载</p>
												<p>(设计师必备)</p>
											</td>
											<td>
												<p>1000+份KeyNote文件</p>
												<p>持续更新</p>
												<p>随意下载</p>
												<p>(入职必备)</p>
											</td>
											<td>...</td>
										</tr>
										<tr>
											<td>现已开放</td>
											<td>即将开放（2个月以内）</td>
											<td>即将开放（2个月以内）</td>
											<td>即将开放（2个月以内）</td>
											<td>...</td>
										</tr>
									</table>
								</div>
								<div class="col-xs-12">
									<p>注：当前加入终身会员计划只需2元，以后不需续费即可下载全站资源；后期每开放一个模块将增加2元（同样，以后不需续费即可下载全站资源）。</p>		
								</div>
								<div class="col-xs-12">
									<p><button class="btn btn-primary btn-lg">加入 2 元计划</button></p>		
								</div>

							</div>	
							
						</div>
					</div>
				</div>
				<div class="error">
					
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
		$(document).ready(function(){
			var scroll = t = detail_wid = 0;
			$(window).scroll(function(){
				scroll = $(document).scrollTop();
				if(scroll > t){
					$('.navbar').addClass('navbar-mini');
				}else{
					if($('.navbar').hasClass('navbar-mini'))
						$('.navbar').removeClass('navbar-mini');
				}
				t = scroll;
			});
		});
	</script>

	
</body>
</html>