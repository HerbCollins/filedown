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
	
	
	<div class="container detail">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
				<div class="detail-cover">
					<?php echo (getImages($info["cover"])); ?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="detail-infos">
					<div class="detail-title">
						<h1>编号：<?php echo ($info["id"]); ?></h1>
					</div>
					<div class="details">
						<div class="detail-down-heart">
							<div class="row">
								<div class="col-md-6">格式：<?php echo ($info["ext"]); ?></div>
								<div class="col-md-6">安全：<i class="safe"><img src="http://open.wawmam.com/save.png"></i></div>
							</div>
							<div class="row">
								<div class="col-md-4">大小：<?php echo (b2m($info["size"])); ?></div>
								<div class="col-md-4">下载：<?php echo ($info["download"]); ?></div>
								<div class="col-md-4">收藏：<?php echo ($info["heart"]); ?></div>
							</div>
							
						</div>
						<div class="detail-tags">
							<span><i class="fa fa-fw fa-tag"></i> <a href="">单页</a> <a href="">简约</a> <a href="">女生</a></span>
						</div>
						<div class="detail-options">
							<div class="row text-center">
								<div class="col-xs-7">
									<a href="<?php echo U('download',array('param'=>encode($info['id'])));?>" class="btn btn-primary btn-lg"><i class="fa fa-fw fa-cloud-download"></i> 免费下载</a>
								</div>
								<div class="col-xs-5">
								<?php if($is_heart == 0): ?><button type="button" onclick="heart(this)" data-param="<?php echo (encode($info[id])); ?>" title="收藏" data-status="<?php echo ($is_heart); ?>" data-heart="<?php echo U('Home/File/heart');?>" class="btn btn-info btn-lg"><i class="fa fa-fw fa-heart-o"></i> 收藏</button>
								<?php else: ?>
									<button type="button" onclick="heart(this)" data-param="<?php echo (encode($info[id])); ?>" data-heart="<?php echo U('Home/File/heart');?>" data-status="<?php echo ($is_heart); ?>" title="点击将取消收藏" class="btn btn-info btn-lg"><i class="fa fa-fw fa-heart"></i> 已收藏</button><?php endif; ?>
								</div>	
							</div>
						</div>	
						<div class="detail-options">
							<div class="row text-center">
								<div class="col-xs-12">
									<?php if((is_login()) and ($is_vip == '')): ?><hr />
										<div class="alert alert-warning text-left">
											<p>
												<i class="fa fa-fw fa-warning"></i>您当前还不是终身会员！
											</p>
											<p>每天可免费下载 <?php echo ($full); ?> 个文件。</p>
											<p>当前已下载 <?php echo ($used); ?> 个文件</p>
											<p><a href="<?php echo U('Home/File/full_tips');?>" title="加入2元终身会员计划，全站永久免费、无限下载" target="_blank"><i class="fa fa-fw fa-hand-o-right"></i>加入 2 元终身会员计划，全站永久免费、无限下载</a></p>
										</div><?php endif; ?>
									<hr>
									<h4>按`Ctrl`+`D`可收藏本站</h4>
								</div>	
							</div>
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
		function heart(k){
			var param = $(k).data('param');
			var _url  = $(k).data('heart');
			var is_heart = $(k).data('status');
			console.log(param);
			datas = {
				'param':param,
				'is_heart':is_heart
			}
			console.log(datas)
			$.ajax({
				data:datas,
				url: _url,
				dataType:"json",
				type:"post",
				success:function(data){
					console.log(data);
					if(data.status == 1){
						if(is_heart){
							$(k).data('status',0);
							var msg = '<i class="fa fa-fw fa-heart-o"></i> 收藏';
						}else{
							$(k).data('status',1);
							var msg = '<i class="fa fa-fw fa-heart"></i> 已收藏';
						}
						$(k).html(msg);
					}else{
						message(data.message , data.status);
						if(data.path !== 'undefined')
							setTimeout(function(){
								window.location.href = data.path;
							}, 2000);
					}
				}
			})
		}

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
				if(scroll > 30){
					detail_wid = $('.detail-infos').width();
					$('.detail-infos').addClass('detail-fixed').width(detail_wid);
				}else{
					if($('.detail-infos').hasClass('detail-fixed')){
						$('.detail-infos').removeClass('detail-fixed')
					}
				}
			});

			
		})
		
		
	</script>

	
</body>
</html>