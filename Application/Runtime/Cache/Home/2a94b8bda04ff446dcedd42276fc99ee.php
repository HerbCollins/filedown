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
	
	
	<div class="container header">
		<div class="row">
			<div class="col-xs-12 text-center">
				<span><i class="fa fa-fw fa-yen"></i>2元 全站无限下载</span>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
				<span><i class="fa fa-fw fa-file-word-o"></i> 共有 <?php echo ($count); ?> 套简历</span>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
				<span><i class="fa fa-fw fa-heart"></i> 共被收藏 <?php echo ($heart); ?> 次</span>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
				<span><i class="fa fa-fw fa-cloud-download"></i> 共被下载 <?php echo ($download); ?> 次</span>
			</div>
		</div>
	</div>
	<div class="container boxs">
		<div class="row">
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$file): $mod = ($i % 2 );++$i;?><div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
					<div class="box">
						<a href="<?php echo U('File/detail',array('id'=>encode($file['id'])));?>"  target="_blank"><img src="<?php echo (getImgPath($file["first_cover"])); ?>?	
imageMogr2/auto-orient/thumbnail/!20p/blur/1x0/quality/75|imageslim" title="知图网简历模板" alt="知图网简历模板免费下载" ></a>
						<div class="mask text-center">
							<div class="row">
								<div class="col-xs-2">
									<span><i class="fa fa-fw fa-file-word-o"></i></span>
								</div>
								<div class="col-xs-5">
									<span><i class="fa fa-fw fa-heart"></i> <?php echo ($file["heart"]); ?></span>
								</div>
								<div class="col-xs-5">
									<span><i class="fa fa-fw fa-cloud-download"></i> <?php echo ($file["download"]); ?></span>
								</div>
							</div>
						</div>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>

	<div class="container page">
		<nav aria-label="Page navigation">
		  <?php echo ($page); ?>
		</nav>
	</div>
	

	
	
	<script type="text/javascript" src="/jianli/Public/js/modernizr.custom.js"></script>
	<script type="text/javascript" src="/jianli/Public/js/classie.js"></script>
	<script type="text/javascript" src="/jianli/Public/js/notificationFx.js"></script>
	<script src="http://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/jianli/Public/js/message.js"></script>

	
		<script type="text/javascript">
			$(document).ready(function(){
				var width = $(".box").find('img').height(
					$('.box').width()*1.4
					);


				var scroll = t = 0;
				$(window).scroll(function(){
					scroll = $(document).scrollTop();
					if(scroll > t){
						$('.navbar').addClass('navbar-mini');
					}else{
						if($('.navbar').hasClass('navbar-mini'))
							$('.navbar').removeClass('navbar-mini');
					}
					t = scroll;
				})
			})
			
			
		</script>
	
	
</body>
</html>