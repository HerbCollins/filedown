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
				<div class="download-content">
					<div class="row text-center">
						<div class="col-xs-12"><div class="download-img"><img src="<?php echo (getFirstImg($id)); ?>?	
imageMogr2/auto-orient/thumbnail/!20p/blur/1x0/quality/75|imageslim"></div></div>
						<div class="col-xs-12">
							<input type="hidden" name="param" value="<?php echo ($id); ?>" data-geturl="<?php echo U('toDown');?>">
							<h1>文件将在<span class="time-leave">5</span>秒后自动下载！</h1>
							<p>如果文件没有开始自动下载，请点击<a href="javascript:get2Down();">这里</a>手动下载。</p>
						</div>
					</div>
					<hr>
					<div class="recommend">
						<h2 class="text-center">为您推荐</h2>
						<div class="row">
							<?php if(is_array($recommend)): $i = 0; $__LIST__ = $recommend;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$file): $mod = ($i % 2 );++$i;?><div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
									<div class="box">
										<a href="<?php echo U('File/detail',array('id'=>encode($file['id'])));?>"  target="_blank"><img src="<?php echo (getImgPath($file["first_cover"])); ?>?	
				imageMogr2/auto-orient/thumbnail/!20p/blur/1x0/quality/75|imageslim"></a>
										<div class="mask text-center">
											<div class="row">
												<div class="col-xs-2">
													<span><i class="fa fa-fw fa-file-word-o"></i></span>
												</div>
												<div class="col-xs-5">
													<span><i class="fa fa-fw fa-heart"></i> 13k</span>
												</div>
												<div class="col-xs-5">
													<span><i class="fa fa-fw fa-cloud-download"></i> 25k</span>
												</div>
											</div>
										</div>
									</div>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>		
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

			var time = 6;
			var time_leave = setInterval(function(){
				
				$('.time-leave').text(--time);
				if(time == 0){
					get2Down();
					clearInterval(time_leave);
				}
			},1000);
			
		})
		
		function get2Down(){
			var param = $("input[name='param']").val();
			var _url  = $("input[name='param']").data('geturl');
			$.ajax({
				data:{'param':param},
				url:_url,
				type:"post",
				dataType:"json",
				success:function(data){
					if(data.status == 1){
						window.location.href = data.path;

					}
				},
				error:function(e){
					$('.error').html(e.responseText);
				}
			})
		}
		
	</script>

	
</body>
</html>