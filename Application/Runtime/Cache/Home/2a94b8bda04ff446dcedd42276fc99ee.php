<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>首页 - <?php echo ($SETUP["title"]); ?></title>
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title></title>
    <!--bootstrap-->
    <!--<link rel="stylesheet" href="/smile/Public/bs/css/bootstrap.css"/>-->
    <link rel="stylesheet" href="/smile/Public/bs/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/smile/Public/bs/css/bootstrap-theme.min.css"/>

    <!--jquery-->
    <link href="/smile/Public/bs/css/jquery-ui-1.10.3.css" rel="stylesheet">
    
    <!--fonts-->
    <link href="/smile/Public/bs/fonts/css/font-awesome.css" rel="stylesheet">
    <link href="/smile/Public/bs/fonts/css/font-awesome.min.css" rel="stylesheet">
    
  <!--icheck-->
  <!--<link href="/smile/Public/bs/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">-->
  <!--<link href="/smile/Public/bs/js/iCheck/skins/square/square.css" rel="stylesheet">-->
  <!--<link href="/smile/Public/bs/js/iCheck/skins/square/red.css" rel="stylesheet">-->
  <!--<link href="/smile/Public/bs/js/iCheck/skins/square/blue.css" rel="stylesheet">-->

  <!--dashboard calendar-->
  <!--<link href="/smile/Public/bs/css/clndr.css" rel="stylesheet">-->

  <!--Morris Chart CSS -->
  <link rel="stylesheet" href="/smile/Public/bs/js/morris-chart/morris.css">

  <!--common-->
  <link href="/smile/Public/bs/css/style.css" rel="stylesheet">
  <link href="/smile/Public/bs/css/style-responsive.css" rel="stylesheet">

	<style type="text/css">
		.row .page-header h3{color: #ffffff}
		.container-fluid .row-fluid .col-lg-8{color: #000000;}
		.container-fluid{margin-top: 50px;}
		.bg-color{background-color: #ffffff;}
		.icon-img>img{width: 40px;height: 40px;margin: 2px 2px;}
	</style>
</head>
<body>
<!--//特效-->
<!--<div id="loader-wrapper">-->
	<!--<div id="loader"></div>-->
	<!--<div class="loader-section section-left"></div>-->
	<!--<div class="loader-section section-right"></div>-->
<!--</div>-->

<!--nav start-->
    <nav class="navbar navbar-fixed-top navbar-inverse " role="navigation">
	<!--container start-->
	<div class="container">
	    <div class="navbar-header">
    <a class="navbar-brand" href="#">SmileEx</a>
</div>
<div>
    <ul class="nav navbar-nav navbar-static-top">
		<li class="active"><a class="" href="" onclick="SML.ToHome()">首页</a></li>
		<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><li class="">
			<a <?php if($v['child'] != ''): ?>class="dropdown-toggle" data-toggle="dropdown"<?php endif; ?> href="/smile/index.php/<?php echo ($v["url"]); ?>"><?php echo ($v["name"]); ?>
			<?php if($v['child'] != ''): ?><b class="caret"></b><?php endif; ?></a>
			<ul class="dropdown-menu">
				<?php if(is_array($v['child'])): foreach($v['child'] as $key=>$v2): ?><li class=""><a class="" href="/smile/index.php/<?php echo ($v2['url']); ?>"><?php echo ($v2['name']); ?></a></li>
				<li class="divider"></li><?php endforeach; endif; ?>
			</ul>
		</li><?php endforeach; endif; ?>
    </ul>
    <ul class="nav navbar-nav navbar-static-top">
	<form action="<?php echo U('Index/Search');?>" method="post" class="navbar-form" role="search">
	    <div class="form-group">
		<input type="text" class="form-control" name="search" placeholder="Search...">
	    </div>
	    <button type="submit" class="btn btn-default">搜一下</button>
	</form>
    </ul>
    <ul class="nav navbar-nav navbar-static-top pull-right">
	<?php if($_SESSION['user']['id']!= ''): ?><!-- gt >,egt >=,lt < ,eq =,neq <> -->
	    <li class="dropdown">
		<a class="dropdown-toggle count-info" data-toggle="dropdown" href="javascript:void(0);">欢迎，
		    <font color="red"><?php echo ($_SESSION['user']['contact']); ?></font> 回来!</a>
		<ul class="dropdown-menu dropdown-messages">
		    <li><!--  data-toggle="modal" -->
			<a href="<?php echo U('Index/uservip');?>"><strong style="color: blueviolet;">进入会员中心</strong></a>
		    </li>
		    <li class="divider"></li>
		    <li>
			<a href="javascript:;" onclick="LogOut()"><strong style="color: blueviolet;">退出登陆</strong></a>
		    </li>
		    <li class="divider"></li>
		    <li>
			<a><i class="fa fa-envelope"></i> <strong style="color: gray;">Smile[微笑]将和你同行...</strong></a>
		    </li>
		</ul>
	    </li>
	    <?php else: ?>
	    <li class=""><a data-toggle="modal" href="#myModal6">注册</a></li>
	    <li class=""><a data-toggle="modal" href="#modal-form">登陆</a></li><?php endif; ?>
    </ul>
</div>

	</div>
	<!--container end-->
    </nav>
<!--nav end-->
<!--container-fluid start-->
    <div class="container-fluid">
	<div class="row-fluid">
	    <div class="container">
	    <!--col-lg-9 start-->
		<div class="col-lg-8">
		    <style type="text/css">
	#carousel_box{height: 320px;}
	.lunbotu{top: 10px; position: relative;}
	/*取消包含框overflow的限制*/
	/*.carousel-inner{overflow: visible;}*/
	.carousel-caption h2, .carousel-caption p{line-height: 20px; color: #bfbfbf;}
	.carousel-inner .item>a>img{width: 880px;height: 330px;}
	.carousel-indicators li{background-color: #d4d5d6;}
	.carousel-indicators .active{background-color: #209e85;}
	/*文字背景*/
	#carousel_box a.left{left:40px;background:url(/smile/Public/bs/images/prev.png) center center no-repeat;}
	#carousel_box a.right{right:40px;background:url(/smile/Public/bs/images/next.png) center center no-repeat;}
</style>

<div class="row lunbotu">
    <div id="carousel_box" class="carousel slide">
		<ol class="carousel-indicators">
			<!--<li data-toggle="#carousel_box" class="active"></li>-->
			<?php if(is_array($PICKER)): foreach($PICKER as $i=>$v): ?><li <?php if($i == 0): ?>class="active"<?php endif; ?> data-target="#carousel_box" data-slide-to="<?php echo ($v["id"]); ?>"></li><?php endforeach; endif; ?>
		</ol>
		<div class="carousel-inner">
			<?php if(is_array($PICKER)): foreach($PICKER as $i=>$v): ?><div <?php if($i == 0): ?>class="item active"<?php else: ?>class="item"<?php endif; ?> >
					<a href="javascript:ArtiContent(<?php echo ($v["id"]); ?>);" target="_blank">
						<img alt="<?php echo ($v["title"]); ?>" src="<?php echo ($v['picurl'][0]['src']); ?>"/>
					</a>
					<div class="carousel-caption">
						<div class="slide-col2">
							<h3><b style="color: orangered;font-family: '楷体';font-size: 24px;"><?php echo ($v["title"]); ?></b></h3>
							<div class="row"></div>
						</div>
					</div>
				</div><?php endforeach; endif; ?>
		</div>
		<a class="left carousel-control" href="#carousel_box"data-slide="prev"></a>
		<a class="right carousel-control" href="#carousel_box"data-slide="next"></a>
    </div>
</div>
<!--轮播图 end-->
<style>
	.button_link{display:inline-block;position:relative;text-decoration:none;font-size:15px;color:#33ab6a;font-weight:bold;width:100%;height:100%;border:2px solid rgba(225,255,255,.8);-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-transition:0.4s;-o-transition:0.4s;transition:0.4s;}
	.button_link:hover{border:3px solid rgba(255,255,255,1);}
	.button_link .line{display:inline-block;background-color:#23C6C8 ;position:absolute;-webkit-transition:0.5s ease;-o-transition:0.5s ease;transition:0.5s ease;}
	.button_link .line_top{height:2px;width:0;left:-50%;top:-2px;}
	.button_link:hover .line_top{width:100%;left:-2px;}
	.button_link .line_right{height:0;width:2px;top:-50%;right:-2px;}
	.button_link:hover .line_right{height:100%;top:-2px;}
	.button_link .line_bottom{width:2px;height:0;bottom:-50%;left:-2px;}
	.button_link:hover .line_bottom{height:100%;bottom:-2px;}
	.button_link .line_left{height:2px;width:0;right:-50%;bottom:-2px;}
	.button_link:hover .line_left{width:100%;right:-2px;}
</style>
<div class="row" id="article">
    <div class="page-header"><h3>本周热门排行</h3></div>
    <?php if(is_array($article)): foreach($article as $key=>$v): ?><div class="row" style="margin:10px 5px; padding:5px 10px;background-color:#FFF">
	    <div class="col-md-3">
		<div class="button_link"><!-- <?php echo U('Article/viewnum',array('id'=>$v['id']));?> -->
			<a href="javascript:void(0);" target="_blank" onclick="ArtiContent(<?php echo ($v["id"]); ?>);" class="button-link">
		    <img class="img-responsive" src="<?php echo ($v['picurl'][0]['src']); ?>" title="<?php echo ($v["title"]); ?>" style="max-height:150px;min-height:120px;"/></a>
		    <span class="line line_top"></span>
		    <span class="line line_right"></span>
		    <span class="line line_bottom"></span>
		    <span class="line line_left"></span>
		</div>
	    </div>
	    <div class="col-md-9">
		<div class="header">
		    <h4>
				<?php if($v["istop"] != 0): ?><a class="badge badge-warning ">TOP</a><?php endif; ?>
				<a class="badge badge-success"><?php echo ($v["cname"]); ?></a>
				<a href="javascript:void(0);" target="_blank" onclick="ArtiContent(<?php echo ($v["id"]); ?>);"><?php echo ($v["title"]); ?></a>
			</h4>
		    <?php echo (msubstr($v["desc"],0,100)); ?>
		    <div class="content pull-right"style="color:#999;position: absolute;margin-left:200px; ">发布时间：<?php echo ($v["createtime"]); ?> 热度：<?php if($v["viewnum"] >= 100): ?><!-- gt替换> ,lt替换< ,eq替换= neq替换<> -->
			<liu style='color:red;'><?php echo ($v["viewnum"]); ?></liu>
			<?php else: echo ($v["viewnum"]); endif; ?> ℃</div>
		</div>
	    </div>
	</div><?php endforeach; endif; ?>
    <div class="col-md-12 text-center"><?php echo ($page); ?></div>
</div>

		</div>
	    <!--col-lg-9 end-->
		<div class="col-lg-1"></div>
	    <!--col-lg-3 start-->
		<div class="col-lg-3">
		    <div class="row" style="height:160px;margin-bottom: 13px;">
			            <style>
                *{margin:0; padding:0; list-style:none;}
                .canvas{position:relative;
                    top: 10px;}
                .clock{
                    width: 100px;
                    height: 100px;
                    margin:0px auto 5px;
                    margin-top: -1em;
                    margin-left: 40px;
                }
            </style>
            <div class="canvas">
                <div class="clock">
                    <canvas id="cvs" width="200" height="200"></canvas>
                </div>
            </div>

		    </div>
		    <div class="row icon-xtweq">
    <div class="span3">
	<div class="panel-body">
		<style>
			.span3{position: relative;margin-top: 10px}
			.panel-body>a>img{width: 40px;height: 40px}
		</style>
	    <a class="icon-img js-tooltip" href="http://weibo.com/smilelcf1320" rel="external nofollow" title="新浪微博" target="_blank">
			<img src="/smile/Public/bs/images/icon-href/xl.png">
		</a>
	    <a class="icon-img js-tooltip" href="http://t.qq.com/hzh973244962?preview" rel="external nofollow" title="腾讯微博" target="_blank">
			<img src="/smile/Public/bs/images/icon-href/tx.png">
		</a>
	    <a class="icon-img js-tooltip" title="关注微信" href="javascript:wxin();"><!--  data-toggle="modal" data-target="#wexin" -->
			<img src="/smile/Public/bs/images/icon-href/wx.png">
	    </a>
	    <a class="icon-img js-tooltip" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=h7axtL_yt7e2tLHH9vap5Ojq" rel="external nofollow" title="Email" target="_blank">
		<img src="/smile/Public/bs/images/icon-href/em.png"></a>
	    <!--			<a class="icon-img js-tooltip" href="http://yusi123.com/go/add_qq" rel="external nofollow" title="联系QQ" target="_blank">
					<img src="/smile/Public/bs/images/icon-href/qq.png"></a>-->
	    <a class="icon-img js-tooltip" href="http://user.qzone.qq.com/2505855078" rel="external nofollow" title="QQ空间" target="_blank">
		<img src="/smile/Public/bs/images/icon-href/kj.png"></a>
	</div>
    </div>
</div>
<div class="row">
    <div class="page-header"><h3>邮件订阅</h3></div>
    <form class="form-group" action="" method="post" onsubmit="">
	<hua style="color: #999">请填写你的邮件地址，订阅更多精彩内容：</hua>
	<div class="input-group">
	    <input type="hidden" class="" name="" placeholder="">
	    <input type="hidden" class="" name="" placeholder="">
	    <input type="email" name="to" class="form-control" placeholder="your@email.com" value="" required />
	    <span class="input-group-addon btn-warning">订阅</span></div>
    </form>
</div>
<div class="row">
    <div class="page-header"><h3>标签云</h3></div>
	<?php if(is_array($cate)): foreach($cate as $i=>$v): ?><a class="js-tooltip" href="/smile/index.php/<?php echo ($v["url"]); ?>" title="(<?php echo ($v["artnum"]); ?>)个话题" target="_blank">
		<div class="col-md-5 pull-left"
			<?php if($i == 0): ?>style="margin: 2px 4px;background-color:#15a287;"<?php endif; ?>
			<?php if($i == 1): ?>style="margin: 2px 4px;background-color:#5cb85c;"<?php endif; ?>
			<?php if($i == 2): ?>style="margin: 2px 4px;background-color:#d9534f;"<?php endif; ?>
			<?php if($i == 3): ?>style="margin: 2px 4px;background-color:#567e95;"<?php endif; ?>
			<?php if($i == 4): ?>style="margin: 2px 4px;background-color:#b433ff;"<?php endif; ?>
			<?php if($i == 5): ?>style="margin: 2px 4px;background-color:#00a67c;"<?php endif; ?>
		>
			<?php echo ($v["name"]); ?>(<?php echo ($v["artnum"]); ?>)
		</div>
		</a><?php endforeach; endif; ?>
</div>
<div class="row">
    <div class="page-header"><h3>猜你喜欢</h3></div>
    <?php if(is_array($Cnxh)): foreach($Cnxh as $key=>$v): ?><div class="row" style="margin:5px 5px; padding: 7px 0px;background-color:#FFF">
	    <div class="col-md-3">
			<div class="">
				<a class="" href="javascript:void(0)" onclick="ArtiContent(<?php echo ($v['id']); ?>);" >
				<img src="<?php echo ($v['picurl'][0]['src']); ?>" title="<?php echo ($v["title"]); ?>" style="max-width: 80px;min-height: 60px"/></a>
			</div>
	    </div>
	    <div class="col-md-8" style="position: relative;margin-left: 18px">
		<a class="" href="javascript:void(0)" onclick="ArtiContent(<?php echo ($v['id']); ?>);" ><?php echo ($v["title"]); ?></a>
		<p class="pull-right pageon"><?php echo ($v["createtime"]); ?></p>
	    </div>
	</div><?php endforeach; endif; ?>
</div>

<div class="row">
	<div class="page-header"><h3>最新发表</h3></div>
	<?php if(is_array($News)): foreach($News as $key=>$v): ?><div class="row" style="margin:5px 5px; padding: 7px 0px;background-color:#FFF">
			<div class="col-md-3">
				<div class="">
					<a class="" href="javascript:void(0)" onclick="ArtiContent(<?php echo ($v['id']); ?>);" >
						<img src="<?php echo ($v['picurl'][0]['src']); ?>" title="<?php echo ($v["title"]); ?>" style="max-width: 80px;min-height: 60px"/></a>
				</div>
			</div>
			<div class="col-md-8" style="position: relative;margin-left: 18px">
				<a class="" href="javascript:void(0)" onclick="ArtiContent(<?php echo ($v['id']); ?>);" ><?php echo ($v["title"]); ?></a>
				<p class="pull-right pageoff"><?php echo ($v["createtime"]); ?></p>
			</div>
		</div><?php endforeach; endif; ?>
</div>

<div class="row">
    <div class="page-header"><h3>友情链接</h3></div>
    <?php if(is_array($link)): foreach($link as $key=>$v): ?><a class="" href="<?php echo ($v["url"]); ?>" target="_blank">
			<div class="col-md-5 pull-left" style="margin: 2px 4px;background-color:pink;">
	    		<?php echo ($v["title"]); ?>
			</div>
		</a><?php endforeach; endif; ?>
</div>

		</div>
	    <!--col-lg-3 end-->
	    </div>
	</div>
    </div>
<!--container-fluid end-->

<!--footer start-->
<div class="text-center" style="margin-top:10px;">
    <footer style="background-color:#999; margin: 0 0; padding: 0 0;">
	<pre><?php echo htmlspecialchars_decode($SETUP['foot']); ?></pre>
    </footer>
</div>

<!--登录==注册 strat-->
<!-- 登陆在这里开始 -->
<div style="display: none;" class="modal inmodal fade in" id="modal-form" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
	<div class="modal-content">
	    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">
		    <span aria-hidden="true">×</span><span class="sr-only">Close</span>
		</button>
		<h4 class="modal-title">登陆中心</h4>
	    </div>
	    <div class="modal-body">
		<form class="form-horizontal" action="<?php echo U('Index/logdo');?>" method="post">
		    <p>没有账号可不要乱登陆哦!^0^</p>
		    <div class="form-group"><label class="col-lg-2 control-label">账号</label>
				<div class="col-lg-10">
					<input id="loginName" placeholder="请输入账号" class="form-control" type="text" name="username" onblur="SML.checkVal(this.id)">
					<span class="loginName tips">登录账号不能为空</span>
				</div>
		    </div>
		    <div class="form-group"><label class="col-lg-2 control-label">密码</label>
				<div class="col-lg-10">
					<input id="loginPwd" placeholder="请输入密码" class="form-control" type="password" name="password" onblur="SML.checkVal(this.id)">
					<span class="loginPwd tips">登录密码不能为空</span>
				</div>
		    </div>
		    <div class="form-group">
				<div class="col-lg-offset-5 col-lg-7">
					<button class="btn btn-sm btn-white" type="button" onclick="login();">点击登陆</button>
				</div>
		    </div>
		</form>
	    </div>
	</div>
    </div>
</div>
<!-- 登陆结束 -->
<!-- 注册开始 -->
<div style="display: none;" class="modal inmodal fade in" id="myModal6" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
	<div class="modal-content">
	    <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title">注册中心</h4>
	    </div>
	    <div class="modal-body">
			<form class="form-horizontal" action="<?php echo U('Home/Index/regdo');?>" method="post">
				<p>欢迎加入:</p><style>.red{color:red;}</style>
				<div class="form-group"><label class="col-lg-2 control-label">用户账号</label>
					<div class="col-lg-10">
						<input id="username" placeholder="请输入账号" class="form-control" type="text" name = "username" onblur="SML.checkVal(this.id)">
						<span class='username tips'>用户账号不能为空</span>
					</div>
				</div>
				<div class="form-group"><label class="col-lg-2 control-label">用户密码</label>
					<div class="col-lg-10">
						<input id="password" placeholder="请输入密码" class="form-control" type="password" name = "password" onblur="SML.checkVal(this.id)">
						<span class='password tips'>用户密码不能为空</span>
					</div>
				</div>
				<div class="form-group"><label class="col-lg-2 control-label">重复密码</label>
				<div class="col-lg-10">
					<input id="repassword" placeholder="请重复输入密码" class="form-control" type="password" name = "repassword" onblur="SML.checkVal(this.id)">
					<span class="repassword tips">请再次输入密码</span>
				</div>
				</div>
				<div class="form-group"><label class="col-lg-2 control-label" >用户昵称</label>
					<div class="col-lg-10">
						<input id="contact" placeholder="请输入昵称" class="form-control" type="text" name = "contact" onblur="SML.checkVal(this.id)">
						<span class="contact tips">用户昵称不能为空</span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-5 col-lg-7">
						<input class="btn btn-sm btn-white" type="button" onclick="regist();" value="点击注册"/>
					</div>
				</div>
			</form>
		</div>
	</div>
	</div>
</div>
<!-- 注册结束 -->
<!--登录==注册 end-->
<!--footer end-->
    </body>
</html>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="/smile/Public/bs/js/jquery-2.1.1.js"></script>
<script src="/smile/Public/bs/js/jquery-1.8.3.min.js"></script>
<script src="/smile/Public/bs/js/jquery-1.10.2.min.js"></script>
<script src="/smile/Public/bs/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/smile/Public/bs/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/smile/Public/bs/js/bootstrap.min.js"></script>
<script src="/smile/Public/bs/js/modernizr.min.js"></script>
<script src="/smile/Public/bs/js/jquery.nicescroll.js"></script>

<!--bootstrap 表单验证-->
<script src="/smile/Public/bs/js/formValidation.js"></script>

<!--layer 弹层组件-->
<script src="/smile/Public/common.js"></script>
<script src="/smile/Public/select.js"></script>
<script src="/smile/Public/layer/layer.js"></script>

<!--icheck -->
<!--<script src="/smile/Public/bs/js/iCheck/jquery.icheck.js"></script>-->
<!--<script src="/smile/Public/bs/js/icheck-init.js"></script>-->

<!-- jQuery Flot Chart-->
<script src="/smile/Public/bs/js/flot-chart/jquery.flot.js"></script>
<script src="/smile/Public/bs/js/flot-chart/jquery.flot.tooltip.js"></script>
<script src="/smile/Public/bs/js/flot-chart/jquery.flot.resize.js"></script>


<!--Morris Chart-->
<script src="/smile/Public/bs/js/morris-chart/morris.js"></script>
<script src="/smile/Public/bs/js/morris-chart/raphael-min.js"></script>

<!--<script src="http://cdnjs.cloudflare.com/ajax/libs/js/underscore.js/1.5.2/underscore-min.js"></script>-->

<!--common scripts for all pages-->
<script src="/smile/Public/bs/js/scripts.js"></script>
    <script>
        $(function () {
            aclock();
            $('.js-tooltip').tooltip();
            $('.tips').hide().addClass('red');
        });
        var LogOut = function () {
            layer.confirm("确定要退出么?",{icon:3,title:"系统提示"},function(){
                window.location.href="<?php echo U('Index/logout');?>";
            });
        }
        function wxin(){
            layer.open({
                type:1,
                title:'扫码关注【<font color="red">画中浅笑个人博客</font>】',
                area:['460px','360px'],
                anim:6,
                shade:0.8,
                shadeClose:true,
                //maxmin:true,
                content:'<div style="padding: 50px 0px;" align="center"><img src="/smile/Public/bs/images/icon-href/wexin.png" width="200" height="200"></div>'
            });
        }
        function ArtiContent(id){
            window.location.href="<?php echo U('Article/viewnum');?>&id="+id;
        }
        function relay() {
            layer.open({
                type:1,
                title:'转发',
                area:['460px','260px'],
                anim:6,
                shade:0.8,
                shadeClose:true,
                //maxmin:true,
                content:
                '<div align="center" class=""><ul class="pull-left">'
                +'<a class="" href="http://www.tenxun.com" target="_blank" style="padding: 20px 30px;"><img width="120" height="28" src="/smile/Public/bs/images/icon-href/txwb.png" alt="腾讯微博"/></a>'
                +'<a class="" href="http://www.zqone.com" target="_blank" style="padding: 20px 30px;"><img width="120" height="28" src="/smile/Public/bs/images/icon-href/qzone.png" alt="腾讯空间"/></a>'
                +'<a class="" href="http://www.sina.com" target="_blank" style="padding: 20px 30px;"><img width="120" height="28" src="/smile/Public/bs/images/icon-href/sina.png" alt="新浪微博"/></a>'
                +'<a class="" href="http://www.sohu.com" target="_blank" style="padding: 20px 30px;"><img width="120" height="28" src="/smile/Public/bs/images/icon-href/sohu.png" alt="搜狐微博"/></a>'
                +'</ul></div>'
            });
        }
        function login() {
            var check = true;
            var params = {};
            params.username		= $('#loginName').val();
            params.password		= $('#loginPwd').val();
            if(params.username == ''){
                $('.loginName').show().addClass('red');
                check = false;
            }
            var reg = /^[a-zA-Z0-9_]{1,16}$/;
            if(!reg.test(params.username)){
                $('.loginName').html('用户账号只能在1到16位之间数字或字母以及下划线，不能含有特殊字符').show().addClass('red');
                check = false;
            }
            if(params.password == ''){
                $('.loginPwd').show().addClass('red');
                check = false;
            }
            if(check==false){return false;}
            $.post("<?php echo U('Home/Index/logdo');?>",params, function (rs) {
                if(rs==1){
                    layer.msg('登录成功!',{icon:1,time:3000}, function () {
                        window.location.reload();
                    });
                }else if(rs==-2){
                    layer.msg('账号已锁定，请联系管理员解锁!',{icon:2,time:2000});
                    $('#loginName').val('');
                    $('#loginName').focus();
                }else{
                    layer.msg('账号或密码错误!!!',{icon:2,time:2000});
                    $('#loginName').val('');
                    $('#loginName').focus();
                    $('#loginPwd').val('');
                }
            });
        }
        function regist() {
            var check = true;
            var params = {};
            params.username		= $('#username').val();
            params.password		= $('#password').val();
            params.contact		= $('#contact').val();
            if(params.username == ''){
                $('.username').show().addClass('red');
                check = false;
            }
            var reg = /^[a-zA-Z0-9_]{1,16}$/;
            if(!reg.test(params.username)){
                $('.username').html('用户账号只能在1到16位之间数字或字母以及下划线，不能含有特殊字符').show().addClass('red');
                check = false;
            }
            if(params.password == ''){
                $('.password').show().addClass('red');
                check = false;
            }
            if( $('#repassword').val() == ''){
                $('.repassword').html('请再次输入密码').show().addClass('red');
                check = false;
            }
            if($('#repassword').val() != params.password){
                $('.repassword').html('两次输入的密码不一致').show().addClass('red');
                check = false;
            }
            if(params.contact == ''){
                $('.contact').show().addClass('red');
                check = false;
            }
            if(check==false){return false;}
            $.post("<?php echo U('Home/Index/regdo');?>",params, function (rs) {
                if(rs==1){
                    layer.msg('注册成功,请登录...',{icon:1,time:2000});
                }else if(rs==-3){
                    layer.msg('你今天已经注册过了,请明天再来!',{icon:2,time:2000});
                }else if(rs==-2){
                    layer.msg('账号已存在!',{icon:2,time:2000});
                    $('#username').val('');
                    $('#username').focus();
                }else{
                    layer.msg('注册失败!!!',{icon:2,time:2000});
                }
            });
        }
        //时钟
        var aclock = function () {
            var cvs = document.getElementById('cvs');
            var ctx = cvs.getContext('2d');
            function Clock() {
                // 时钟背景图
                var Img = document.createElement('img');
                Img.src = "/smile/Public/bs/images/blog/clock.png";
                // Img.onload=function (){
                ctx.drawImage(Img, 0, 0, 200, 200);
                // }

                // 时钟圆盘
                ctx.beginPath();
                // ctx.strokeStyle='#60D9F8';
                ctx.lineWidth = 3; //圆盘边缘宽度
                ctx.arc(100, 100, 87, 0, 2 * Math.PI, true);
                // ctx.arc(100,100,90,0,2*Math.PI,true);
                ctx.clip();
                ctx.stroke();
                ctx.closePath();

                // 分刻度  360/60=6
                for (var i = 0; i < 60; i++) {
                    ctx.save();
                    ctx.beginPath();
                    // ctx.translate(100,100);
                    ctx.translate(100, 100);
                    ctx.rotate(i * 6 * Math.PI / 180);
                    ctx.strokeStyle = '#FEF319';
                    ctx.lineWidth = 3;
                    ctx.moveTo(0, -78);
                    ctx.lineTo(0, -84);
                    ctx.stroke();
                    ctx.closePath();
                    ctx.restore();
                }
                ;

                // 时刻度  360/12=30
                for (var i = 0; i < 12; i++) {
                    ctx.save();
                    ctx.beginPath();
                    ctx.translate(100, 100);
                    ctx.rotate(i * 30 * Math.PI / 180);
                    ctx.strokeStyle = 'blue';
                    ctx.lineWidth = 4;
                    ctx.moveTo(0, -74);
                    ctx.lineTo(0, -84);
                    ctx.stroke();
                    ctx.closePath();
                    ctx.restore();
                }
                ;

                // 获取当前时间
                var dates = new Date();
                var h = dates.getHours();
                var m = dates.getMinutes();
                var s = dates.getSeconds();
                h = h + m / 60;//3.5
                m = m + s / 60;
                // 画时间
                var h2 = dates.getHours();
                var m2 = dates.getMinutes();
                var str1 = h2 > 9 ? h2 : ('0' + h2);
                var str2 = m2 > 9 ? m2 : ('0' + m2);
                ctx.beginPath();
                ctx.fillStyle = 'blueviolet';
                ctx.font = '24px 微软雅黑';
                ctx.fillText(str1 + ':' + str2, 69, 160);
                ctx.closePath();

                // 时针
                ctx.save();
                ctx.beginPath();
                ctx.translate(100, 100);
                ctx.rotate(h * 30 * Math.PI / 180);
                ctx.strokeStyle = 'blue';
                ctx.lineWidth = 3;
                ctx.moveTo(0, 7);
                ctx.lineTo(0, -48);
                ctx.stroke();
                ctx.closePath();
                ctx.restore();

                // 分钟
                ctx.save();
                ctx.beginPath();
                ctx.translate(100, 100);
                ctx.rotate(m * 6 * Math.PI / 180);
                ctx.strokeStyle = '#FEF319';
                ctx.lineWidth = 2;
                ctx.moveTo(0, 7);
                ctx.lineTo(0, -56);
                ctx.stroke();
                ctx.closePath();
                ctx.restore();

                // 秒针
                ctx.save();
                ctx.beginPath();
                ctx.translate(100, 100);
                ctx.rotate(s * 6 * Math.PI / 180);
                ctx.strokeStyle = '#FB1F11';
                ctx.lineWidth = 1;
                ctx.moveTo(0, 7);
                ctx.lineTo(0, -75);
                ctx.stroke();
                ctx.closePath();
                //秒针上的圆
                ctx.beginPath();
                ctx.fillStyle = '#000000';
                ctx.strokeStyle = '#FB1F11';
                ctx.lineWidth = 3;
                ctx.arc(0, -48, 2, 0, 2 * Math.PI, true);
                ctx.fill();
                ctx.stroke();
                ctx.closePath();
                //中心圆
                ctx.beginPath();
                ctx.fillStyle = '#60D9F8';
                ctx.strokeStyle = '#FB1F11';
                ctx.lineWidth = 2;
                ctx.arc(0, 0, 4, 0, 2 * Math.PI, true);
                ctx.fill();
                ctx.stroke();
                ctx.closePath();

                ctx.restore();
            }
            Clock();
            setInterval(Clock, 1000);
        }
    </script>