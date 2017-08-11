<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title>简历后台</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="ThemeBucket">

<link rel="stylesheet" type="text/css" href="/jianli/Public/css/ns-default.css" />
<link rel="stylesheet" type="text/css" href="/jianli/Public/css/ns-style-bar.css" />

<!--icheck-->
<link href="/jianli/Public/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
<link href="/jianli/Public/js/iCheck/skins/square/square.css" rel="stylesheet">
<link href="/jianli/Public/js/iCheck/skins/square/red.css" rel="stylesheet">
<link href="/jianli/Public/js/iCheck/skins/square/blue.css" rel="stylesheet">

<!--dashboard calendar-->
<link href="/jianli/Public/css/clndr.css" rel="stylesheet">

<!--Morris Chart CSS -->
<link rel="stylesheet" href="/jianli/Public/js/morris-chart/morris.css">

<!--common-->
<link href="/jianli/Public/css/admin-style.css" rel="stylesheet">
<link href="/jianli/Public/css/style-responsive.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="/jianli/Public/js/html5shiv.js"></script>
<script src="/jianli/Public/js/respond.min.js"></script>
<![endif]-->


	
</head>
<body>
<section>
	<!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="index.html"><img src="/jianli/Public/images/logo.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="index.html"><img src="/jianli/Public/images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="/jianli/Public/images/photos/user-avatar.png" class="media-object">
                    <div class="media-body">
                        <h4><a href="#"><?php echo (get_nickname($uid)); ?></a></h4>
                        <span>"Hello There..."</span>
                    </div>
                </div>

                <h5 class="left-nav-title">账号信息</h5>
                <ul class="nav nav-pills nav-stacked custom-nav">
                  <li><a href=""><i class="fa fa-user"></i> <span>个人信息</span></a></li>
                  <li><a href=""><i class="fa fa-cog"></i> <span>设置</span></a></li>
                  <li><a href=""><i class="fa fa-sign-out"></i> <span>退出</span></a></li>
                </ul>
            </div>

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li><a href="<?php echo U('Index/index');?>"><i class="fa fa-home"></i> <span>控制板</span></a></li>
                <li class="menu-list"><a href=""><i class="fa fa-file"></i> <span>文件</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo U('File/statistics');?>"> 统计</a></li>
                        <li><a href="<?php echo U('File/add');?>"> 添加</a></li>
                        <li><a href="<?php echo U('File/config');?>"> 管理</a></li>
                        <li><a href="<?php echo U('File/tags');?>"> 标签</a></li>
                        <li><a href="<?php echo U('File/category');?>"> 分类</a></li>
                    </ul>
                </li>
                <li class="menu-list"><a href=""><i class="fa fa-user"></i> <span>用户中心</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo U('Ucenter/behavior');?>"> 行为</a></li>
                        <li><a href="<?php echo U('Ucenter/config');?>"> 管理</a></li>
                        <li><a href="<?php echo U('Ucenter/search');?>"> 查找</a></li>
                        <li><a href="<?php echo U('Ucenter/notchecked');?>"> 未确认</a></li>
                        <li><a href="<?php echo U('Ucenter/download');?>"> 下载记录</a></li>
                        <li><a href="<?php echo U('Ucenter/heart');?>"> 收藏记录</a></li>
                    </ul>
                </li>

                <li><a href="<?php echo U('Config/index');?>"><i class="fa fa-cogs"></i> <span>网站设置</span></a></li>
            </ul>
            <!--sidebar nav end-->

        </div>
    </div>
    <!-- left side end-->

    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->

            <!--search start-->
            <form class="searchform" action="index.html" method="post">
                <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
            </form>
            <!--search end-->

            <!--notification menu start -->
            <div class="menu-right">
                <ul class="notification-menu">
              
                    <!-- 消息 -->
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge">5</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">You have 5 Mails </h5>
                            <ul class="dropdown-list normal-list">
                                <li class="new">
                                    <a href="">
                                        <span class="thumb"><img src="images/photos/user1.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">John Doe <span class="badge badge-success">new</span></span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="thumb"><img src="images/photos/user2.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Jonathan Smith</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="thumb"><img src="images/photos/user3.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Jane Doe</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="thumb"><img src="images/photos/user4.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Mark Henry</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="thumb"><img src="images/photos/user5.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Jim Doe</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="new"><a href="">Read All Mails</a></li>
                            </ul>
                        </div>
                    </li>
                    <!-- 纸条 -->
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="badge">4</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">Notifications</h5>
                            <ul class="dropdown-list normal-list">
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">Server #1 overloaded.  </span>
                                        <em class="small">34 mins</em>
                                    </a>
                                </li>
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">Server #3 overloaded.  </span>
                                        <em class="small">1 hrs</em>
                                    </a>
                                </li>
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">Server #5 overloaded.  </span>
                                        <em class="small">4 hrs</em>
                                    </a>
                                </li>
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">Server #31 overloaded.  </span>
                                        <em class="small">4 hrs</em>
                                    </a>
                                </li>
                                <li class="new"><a href="">See All Notifications</a></li>
                            </ul>
                        </div>
                    </li>
                    <!-- 个人信息 -->
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo (get_avatar_path($uid)); ?>" alt="" />
                            <?php echo (get_nickname($uid)); ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="#"><i class="fa fa-user"></i> 个人信息</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i>  设置</a></li>
                            <li><a href="#"><i class="fa fa-sign-out"></i> 退出</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--notification menu end -->

        </div>
        <!-- header section end-->

        
	<div class="page-heading">
		<h3>
            搜索
        </h3>
        <ul class="breadcrumb">
            <li>
                <a href="#">搜索</a>
            </li>
        </ul>
	</div>
    <div class="wrapper">
        <div class="row">
        	<div class="col-xs-12">
        		<div class="panel">
        			<div class="panel-body">
        				<div class="row">
        					<form action="" method="post" id="search">
	        					<div class="col-xs-8">
	        						<input type="email" class="form-control" name="email" />
	        					</div>
	        					<div class="col-xs-4">
	        						<button type="submit" class="btn btn-primary">提交</button>
	        					</div>
        					</form>
        				</div>
        			</div>
        		</div>
        	</div>
        	<div class="col-xs-12">

        		<div class="panel panel-primary">
        			<div class="panel-heading">
        				搜索结果
        			</div>
        			<div class="panel-body">
        				<table class="table table-hover">
        					<thead>
	        					<tr>
	        						<th>ID</th>
	        						<th>邮箱</th>
	        						<th>昵称</th>
	        						<th>VIP</th>
	        						<th>操作</th>
	        					</tr>	
        					</thead>
        					<tbody id="result"></tbody>
        				</table>
        			</div>
        		</div>

        	</div>
        </div>
    </div>


        <!--footer section start-->
        <footer>
            2014 &copy; AdminEx by ThemeBucket
        </footer>
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>

	<!-- Placed js at the end of the document so the pages load faster -->
<script src="http://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery.form/4.2.1/jquery.form.min.js"></script>
<script src="/jianli/Public/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/jianli/Public/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/jianli/Public/js/bootstrap.min.js"></script>
<script src="/jianli/Public/js/modernizr.min.js"></script>
<script src="/jianli/Public/js/jquery.nicescroll.js"></script>

<!--easy pie chart-->
<script src="/jianli/Public/js/easypiechart/jquery.easypiechart.js"></script>
<script src="/jianli/Public/js/easypiechart/easypiechart-init.js"></script>

<!--Sparkline Chart-->
<script src="/jianli/Public/js/sparkline/jquery.sparkline.js"></script>
<script src="/jianli/Public/js/sparkline/sparkline-init.js"></script>


<!-- jQuery Flot Chart-->
<script src="/jianli/Public/js/flot-chart/jquery.flot.js"></script>
<script src="/jianli/Public/js/flot-chart/jquery.flot.tooltip.js"></script>
<script src="/jianli/Public/js/flot-chart/jquery.flot.resize.js"></script>


<!--Morris Chart-->
<script src="/jianli/Public/js/morris-chart/morris.js"></script>
<script src="/jianli/Public/js/morris-chart/raphael-min.js"></script>


<!--common scripts for all pages-->
<script src="/jianli/Public/js/scripts.js"></script>

<!--Dashboard Charts-->
<script src="/jianli/Public/js/dashboard-chart-init.js"></script>

	<script type="text/javascript" src="/jianli/Public/js/modernizr.custom.js"></script>
	<script type="text/javascript" src="/jianli/Public/js/classie.js"></script>
	<script type="text/javascript" src="/jianli/Public/js/notificationFx.js"></script>
	
	<script type="text/javascript" src="/jianli/Public/js/message.js"></script>
	
	<script type="text/javascript">
		$("#search").submit(function(){
			var _email = $("input[name='email']").val();
			var _url   = $(this).attr('action');
			var _method= $(this).attr('method');

			if(_email.length == 0){
				message('email不能为空' , 0);
				return false;
			}
			datas = {
				'email' : _email
			}
			$.ajax({
				url:_url,
				type:_method,
				dataType:"json",
				data:datas,
				success:function(data){
					if(data.status == 1){
						var da = data.data;
						var tr = '<tr><td>'+da.id+'</td><td>'+da.email+'</td><td>'+da.nickname+'</td><td>'+ da.vip +'</td><td><button type="button" class="btn btn-primary" onclick="tovip(this)" data-id="'+da.id+'" data-email="'+da.email+'" data-nickname="'+da.nickname+'">升级VIP</button></td></tr>';
						$('#result').html(tr);
					}else{
						message(data.message , data.status);
					}
				},
				error:function(){
					message('连接失败' , 0);
				}
			})
			return false;
		});

		function tovip(obj){
			var _id 		= $(obj).data('id');
			var _email 		= $(obj).data('email');
			var _nickname 	= $(obj).data('nickname');
			var _data = {
				'id' 		: _id,
				'email' 	: _email,
				'nickname' 	: _nickname
			}
			$.ajax({
				url:"<?php echo U('tovip');?>",
				data:_data,
				type:"post",
				dataType:"json",
				success:function(data){
					message(data.message , data.status);
				}
			})
		}
	</script>

</body>
</html>