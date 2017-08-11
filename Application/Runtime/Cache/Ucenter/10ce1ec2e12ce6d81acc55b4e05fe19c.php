<?php if (!defined('THINK_PATH')) exit();?><nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">菜单</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo U('Home/Index/index');?>">WAWMAM</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; if($menu['id'] == $current): ?><li class="active"><a href="javascript:void(0);"><?php echo ($menu["category"]); ?></a></li>
            <?php else: ?>

              <li><a href="<?php echo U('Home/Index/index',array('key'=>$menu['id']));?>"><?php echo ($menu["category"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if(is_login()): ?><li class="dropdown userinfo">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo (get_avatar_path($uid)); ?>" class="user_avatar"> <span><?php echo (get_nickname($uid)); ?></span> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo U('Ucenter/Index/index');?>">个人中心</a></li>
              <li><a href="<?php echo U('Ucenter/Index/index');?>">我的收藏</a></li>
              <li><a href="<?php echo U('Ucenter/Index/index',array('type'=>'download'));?>" target="_blank">我的下载</a></li>
              <li><a href="<?php echo U('Ucenter/Index/changepwd');?>">修改密码</a></li>
              <li><a href="javascript:void(0);" onclick="logout()">退出</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li><a href="<?php echo U('Ucenter/Member/login');?>" target="_blank">登录</a></li>
          <li><a href="<?php echo U('Ucenter/Member/register');?>" target="_blank">注册</a></li><?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>