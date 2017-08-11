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

	
	<link rel="stylesheet" type="text/css" href="/jianli/Public/css/dcalendar.picker.css" />

</head>
<body class="pc_browser">
	
	<?php echo W('Common/Menu/menu',array('current'=>$key));?>
	
	
	<div class="container ucenter">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
				<h2 class="ucenter-nickname">
					<div class="avatar_zone">
						<div class="avatar_current">
							<img src="<?php echo (get_avatar_path($uid)); ?>" class="ucenter_avatar" id="current_avatar_img">
							<div class="mask">
								<a href="javascript:void(0);" onclick="edit_avatar()"><i class="fa fa-fw fa-edit"></i></a>
							</div>
						</div>
						<div class="avatar_select_zone">
							<img src="http://open.wawmam.com/avatar/avatar_woman_1.jpg" data-avatar="1" data-save="<?php echo U('Ucenter/Member/edit_avatar');?>"/>
							<img src="http://open.wawmam.com/avatar/avatar_woman_2.jpg" data-avatar="2" data-save="<?php echo U('Ucenter/Member/edit_avatar');?>"/>
							<img src="http://open.wawmam.com/avatar/avatar_woman_3.jpg" data-avatar="3" data-save="<?php echo U('Ucenter/Member/edit_avatar');?>"/>
							<img src="http://open.wawmam.com/avatar/avatar_woman_4.jpg" data-avatar="4" data-save="<?php echo U('Ucenter/Member/edit_avatar');?>"/>
							<img src="http://open.wawmam.com/avatar/avatar_woman_5.jpg"  data-avatar="5" data-save="<?php echo U('Ucenter/Member/edit_avatar');?>" />
							<img src="http://open.wawmam.com/avatar/avatar_woman_6.jpg" data-avatar="6" data-save="<?php echo U('Ucenter/Member/edit_avatar');?>" />
						</div>
					</div>
					<span><?php echo (get_nickname($uid)); ?></span>
				</h2>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
				<table class="table">
					<tr>
						<td class="profile-title"><i class="fa fa-fw fa-user"></i> 昵称</td>
						<td class="edit-zone">
							<span class="current-value"><?php echo (get_nickname($uid)); ?></span>
							<input type="text" class="get_new" value="<?php echo (get_nickname($uid)); ?>" data-save="<?php echo U('Ucenter/Member/edit_nickname');?>" name="nickname"> 
							<span class="options">
								<a href="javascript:void(0);" onclick="edit(this)"><i class="fa fa-fw fa-edit"></i></a>
							</span>
						</td>
						<td class="profile-title"><i class="fa fa-fw fa-gift"></i> 生日</td>
						<td class="edit-zone">
							<span class="current-value"><?php echo (get_user_birthday($uid)); ?></span>
							<input type="date" id="datepicker" class="get_new" value="" data-save="<?php echo U('Ucenter/Member/edit_birthday');?>" name="birthday"> 
							<span class="options">
								<a href="javascript:void(0);" onclick="edit(this)"><i class="fa fa-fw fa-edit"></i></a>
							</span>
						</td>
					</tr><tr>
						<td class="profile-title"><i class="fa fa-fw fa-envelope"></i> 邮箱</td>
						<td><?php echo (get_user_email($uid)); ?> </td>
						<td class="profile-title"><i class="fa fa-fw fa-database"></i> 积分</td>
						<td><?php echo (get_user_score($uid)); ?></td>
					</tr><tr>
						<td class="profile-title"><i class="fa fa-fw fa-venus-mars"></i> 性别</td>
						<td class="edit-zone">
							<span class="current-value"><?php echo (get_user_sex($uid)); ?></span>
							<select class="get_new" data-save="<?php echo U('Ucenter/Member/edit_sex');?>" name="sex">
								<option value="男">男</option>
								<option value="女">女</option>
							</select> 
							<span class="options">
								<a href="javascript:void(0);" onclick="edit(this)"><i class="fa fa-fw fa-edit"></i></a>
							</span>
						</td>
						<td class="profile-title"><i class="fa fa-fw fa-vcard"></i> 会员</td>
						<td><?php echo (get_user_vip($uid)); ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="container ucenter" style="margin-top:10px;">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2 text-right uc-leftbar">
				<ul>
<li><a href="<?php echo U('index');?>">我的收藏</a></li>
<li><a href="<?php echo U('index',array('type'=>'download'));?>">我的下载</a></li>
<li><a href="<?php echo U('changepwd');?>">修改密码</a></li>
<li><a href="<?php echo U('config');?>">设置</a></li>
</ul>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-5 col-lg-8">
						<h3>配置信息</h3>
						<hr>
						
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

	
	<script type="text/javascript" src="/jianli/Public/js/dcalendar.picker.js"></script>
	<script type="text/javascript" src="/jianli/Public/js/ucenter.js"></script>

	
</body>
</html>