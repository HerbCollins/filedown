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


	<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	
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

        
	<style type="text/css">
		.img_cover img{
			width:18px;
			transition: all .5s;
		}
		.img_cover img:hover{
			transform: scale(8); 
		}
	</style>
	<!-- page heading start-->
    <div class="page-heading">
        <h3>
            文件统计
        </h3>
    </div>
    <!-- page heading end-->

    <!--body wrapper start-->
    <div class="wrapper">
    	<div class="row">
    		<div class="col-xs-12">
    			<div class="panel">
    				<div class="panel-heading">
    					一键上传 <button type="button" class="btn btn-primary" onclick="uploadAll()">上传</button>
    				</div>
	    			<div class="panel-body">
	    				<table class="table table-bordered">
	    					<?php if(is_array($files)): $i = 0; $__LIST__ = $files;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?><tr id="tr_<?php echo ($i); ?>">
									<td>
										<form action="<?php echo U('uploadCover');?>" id="c_<?php echo ($i); ?>" method="post" enctype="multipart/form-data" >
	    									<input type="file" name="cover" value="<?php echo ($f["cover"]); ?>" />
	    								</form>
	    							</td>
	    							<td>
	    								<form action="<?php echo U('uploadFile');?>" method="post" id="f_<?php echo ($i); ?>" enctype="multipart/form-data" >
	    									<input type="text" name="first_cover" id="first_cover_<?php echo ($i); ?>">
											<input type="text" name="cover"  id="file_cover_<?php echo ($i); ?>"  />
	    									<input type="hidden" name="cate_id" value="2" />
	    									<input type="hidden" name="page" value="1">
	    									<input type="file" name="file" value="<?php echo ($f["doc"]); ?>" />
	    								</form>
	    							</td>  							
	    						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	    				</table>
	    			</div>
    			</div>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-xs-12">
    			<div class="panel">
    				<div class="panel-heading">
    					文件中心
    				</div>
    				<div class="panel-body">
    					<table class="table">
    						<thead>
    							<tr>
    								<th>ID</th>
    								<th>Cover</th>
    								<th>File</th>
    								<th>Category</th>
    								<th>Download</th>
    								<th>Heart</th>
    								<th>OPTIONS</th>
    							</tr>
    						</thead>
    						<tbody>
    							<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$file): $mod = ($i % 2 );++$i;?><tr>
    									<td><?php echo ($file["id"]); ?></td>
    									<td class="img_cover"><img src="<?php echo (getImgPath($file["first_cover"])); ?>?	
imageMogr2/auto-orient/thumbnail/!20p/blur/1x0/quality/75|imageslim"></td>
    									<td><?php echo ($file["filename"]); ?></td>
    									<td><?php echo ($file["cate_id"]); ?></td>
    									<td><?php echo ($file["download"]); ?></td>
    									<td><?php echo ($file["heart"]); ?></td>
    									<td><button type="button" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i></button></td>
    								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
    						</tbody>
    					</table>
    					<?php echo ($page); ?>
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
	<script type="text/javascript" src="/jianli/Public/js/message.js"></script>
	
	
	<script type="text/javascript">
		function uploadAll(){

			for (var i = 1; i <= 72; i++) {
				$("#c_"+i).submit();

				$("#c_"+i).on('submit',function(){
					var datas = $(this).serialize();
					var _url  = $(this).attr('action');
					var method= $(this).attr('method');
					console.log(datas)
					return false;
					$(this).ajaxSubmit({
						data:datas,
						url:_url,
						dataType:"json",
						type:method,
						success:function(data){
							console.log(i);
							if(data.status == 1){
								$("#f_"+i).submit();
								var covers = $('#file_cover_'+i).val();
								if(covers.length > 0){
									$('#file_cover_'+i).val(covers+","+data.id);
									
								}else{
									$('#first_cover_'+i).val(data.id);
									$('#file_cover_'+i).val(data.id);
								}
							}
						},
						error:function(e){
							consloe.log('error_'+i);
						}
					})
					return false;
				})

				$("#f_"+i).on('submit' ,function(){
					var datas = $(this).serialize();
					var _url  = $(this).attr('action');
					var method= $(this).attr('method');
					$(this).ajaxSubmit({
						data:datas,
						url : _url,
						dataType:"json",
						type:method,
						success:function(data){
							if(data.status == 1){
								$("#tr_"+i).addClass('success');
							}
						}
					});
					return false;
				});
			}
		}
	</script>

</body>
</html>