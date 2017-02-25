<?php if (!defined('THINK_PATH')) exit();?><!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="ThemeBucket">
	<link rel="shortcut icon" href="#" type="image/png">
	<title><?php echo ($title); ?> - <?php echo ($SETUP["title"]); ?></title>
	<!--common-->
	<link href="/smile/Public/bs/css/style.css" rel="stylesheet">
	<link href="/smile/Public/bs/css/style-responsive.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="/smile/Public/bs/js/html5shiv.js"></script>
	<script src="/smile/Public/bs/js/respond.min.js"></script>
	<![endif]-->
<!--</head>-->
<style>
	.left-side-inner{position: relative;
		top:-50px;}
</style>

<!--<body class="sticky-header">-->
<section>
    <!-- left side start-->
	<div class="left-side sticky-left-side">
		<!--logo and iconic logo start-->
		<div class="logo">
			<a href="<?php echo U('Admin/index');?>"><img src="/smile/Public/bs/images/logo.png" alt=""></a>
		</div>
		<!--<div class="logo-icon text-center">-->
			<!--<a href="<?php echo U('Admin/index');?>"><img src="/smile/Public/bs/images/logo_icon.png" alt=""></a>-->
		<!--</div>-->
		<!--logo and iconic logo end-->
		<div class="left-side-inner">
			<!--sidebar nav start-->
			<ul class="nav nav-pills nav-stacked custom-nav">
				<!--<li class="active"><a href="<?php echo U('Admin/index');?>"><i class="fa fa-home"></i> <span>后台主页</span></a></li>-->
				<?php if(is_array($actionList)): $i = 0; $__LIST__ = $actionList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($i == 1): ?><li class="active"><a href="<?php echo U('Admin/index');?>"><i class="fa fa-<?php echo ($vo["icon"]); ?>"></i> <span><?php echo ($vo["name"]); ?></span></a></li>
						<?php else: ?>
						<li class="menu-list"><a href="#"><i class="fa fa-<?php echo ($vo["icon"]); ?>"></i> <span><?php echo ($vo["name"]); ?></span></a>
							<ul class="sub-menu-list">
								<?php if(is_array($vo['child'])): foreach($vo['child'] as $key=>$v): ?><li><a href="/smile/indin.php/<?php echo ($v['url']); ?>" target="right"><i class="fa fa-<?php echo ($v["icon"]); ?>"></i> <?php echo ($v["name"]); ?></a></li><?php endforeach; endif; ?>
							</ul>
						</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<!--sidebar nav end-->
		</div>
	</div>
    <!-- left side end-->

    <!-- main content start-->
	<div class="main-content" >
		<!-- header section start-->
		<div class="header-section"style="background-color: #424f63;" >
			<a class="toggle-btn"><i class="fa fa-bars"></i></a>
			<form class="searchform" method="post">
				<input type="text" readonly class="form-control border-top " style="border: none;width: 340px;background-color:#424f63 ;"
					   placeholder="每一个你不满意的现在,都有一个你不努力的曾经..." />
			</form>

			<!--notification menu start -->
			<div class="menu-right">
				<ul class="notification-menu">
					<li>
						<a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
							<i class="fa fa-tasks"></i>
							<span class="badge">8</span>
						</a>
						<div class="dropdown-menu dropdown-menu-head pull-right">
							<h5 class="title">You have 8 pending task</h5>
							<ul class="dropdown-list user-list">
								<li class="new">
									<a href="#">
										<div class="task-info">
											<div>Database update</div>
										</div>
										<div class="progress progress-striped">
											<div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning">
												<span class="">40%</span>
											</div>
										</div>
									</a>
								</li>
								<li class="new">
									<a href="#">
										<div class="task-info">
											<div>Dashboard done</div>
										</div>
										<div class="progress progress-striped">
											<div style="width: 90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90" role="progressbar" class="progress-bar progress-bar-success">
												<span class="">90%</span>
											</div>
										</div>
									</a>
								</li>
								<li class="new"><a href="">See All Pending Task</a></li>
							</ul>
						</div>
					</li>
					<?php if($Sis == 1): else: ?>
						<li>
							<a href="javascript:sign()" class="btn btn-default dropdown-toggle info-number">
								<!--<i class="fa fa-envelope-o"></i>-->
								<i class="fa fa-thumbs-up"></i>
								<span class="badge">签</span>
							</a>
						</li><?php endif; ?>
					<li>
						<a href="#" title="未读消息" target="right" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i>
							<span class="badge"><?php echo ($newsnum); ?></span>
						</a>
						<div class="dropdown-menu dropdown-menu-head pull-right">
							<h5 class="title">未读消息通知</h5>
							<ul class="dropdown-list normal-list">
								<?php if(is_array($news)): foreach($news as $key=>$v): ?><li class="new">
										<a href="javascript:;" onclick="readArticle(<?php echo ($v['id']); ?>,1)" target="right">
											<span class="label label-danger"><i class="fa fa-bolt"></i></span>
											<span class="name"><?php echo ($v["title"]); ?></span>
											<span class="small"><?php echo ($v["ctime"]); ?></span>
										</a>
									</li><?php endforeach; endif; ?>
								<li class="new "><a class='btn btn-success' href="<?php echo U('Admin/readAll');?>">消息全部忽略</a></li>
							</ul>
						</div>
					</li>
					<!--清除缓存 start-->
					<li>
						<a href="#" title="清除缓存"class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
							<i class="fa fa-trash-o"></i>
							<span class="badge">清</span>
						</a>
						<ul class="dropdown-menu dropdown-menu-usermenu pull-right">
							<li class=""><a class="" href="<?php echo U('Admin/clearCache');?>">
								<i class="fa fa-minus-square-o"></i> 清除<b style="color: blueviolet;">模板</b>缓存</a></li>
							<li class=""><a class="" href="<?php echo U('Admin/clearData');?>">
								<i class="fa fa-minus-square"></i> 清除<b style="color: blueviolet;">数据</b>缓存</a></li>
							<li class=""><a class="" href="<?php echo U('Admin/clearLogs');?>">
								<i class="fa fa-bars"></i> 清除<b style="color: blueviolet;">日志</b>缓存</a></li>
							<li class=""><a class="" href="<?php echo U('Admin/clearTemp');?>">
								<i class="fa fa-warning"></i> 清除<b style="color: blueviolet;">数据目录</b></a></li>
						</ul>
					</li>
					<!--清除缓存 end-->
					<!--toHome START -->
					<li>
						<a title="前端" target="_blank" href="http://localhost/smile/index.php"class="btn btn-default dropdown-toggle info-number">
							<i class="fa fa-home"></i>
							<span class="badge">前</span>
						</a>
					</li>
					<!-- TO HOME END -->

					<li>
						<a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown" style="color:#ff0000;background-color: #424f63;">
							<img src="<?php echo ($_SESSION['SML_USER']['pic']); ?>" width="400" height="28" style="line-height: -2em;margin:0px;padding: 0px;"/>
							<?php echo ($_SESSION['SML_USER']['contact']); ?>
							<span class="caret"></span>
							<span class="ps badge">New</span>
						</a>
						<ul class="dropdown-menu dropdown-menu-usermenu pull-right">
							<li><a href="<?php echo U('Infor/toFontIcon');?>" target="right">
								<i class="fa fa-user"></i> ICON 图标
								<span class="badge badge-success">new</span></a></li>
							<li><a href="<?php echo U('Infor/toFontFa');?>" target="right">
								<i class="fa fa-user"></i> FA-- 图标
								<span class="badge badge-success">new</span></a></li>
							<!--<li><a href="<?php echo U('Infor/message');?>" target="right">-->
							<li><a href="javascript:;" onclick="inforMsg()" target="right">
								<i class="fa fa-user"></i>  个人信息
								<span class="badge badge-success">new</span></a></li>
							<li><a href="<?php echo U('Infor/perfect');?>" target="right">
								<i class="fa fa-cog"></i>  个人设置
								<input type="hidden" class="input-email" value="<?php echo ($_SESSION['SML_USER']['email']); ?>" required>
								<span class="ps badge badge-warning">请完善资料</span></a></li>
							<li><a href="javascript:;" onclick="logout()">
								<i class="fa fa-power-off"></i> 系统注销</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<!--notification menu end -->
		</div>
		<!-- header section end-->

		<!--iframe main start -->
		<div class="iframemain" style="height: 570px">
			<iframe name="right" src="<?php echo U('Admin/home');?>" width="100%" height="100%" align="center" scrolling="auto" marginheight="0" marginwidth="0" style="border: none; margin: 0; padding: 0;"></iframe>
		</div>
		<!--iframe main end-->

		<footer>
			2016 &copy; SmileEx By 画中浅笑
		</footer>
	</div>
    <!-- main content end-->
</section>

    <!--</body>-->
<!--</html>-->
    <!-- JAVASCRIPT CORE PAGE -->
    <script src="/smile/Public/bs/js/jquery-2.1.1.js"></script>
    <script src="/smile/Public/bs/js/jquery-1.10.2.min.js"></script>
    <script src="/smile/Public/bs/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="/smile/Public/bs/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="/smile/Public/bs/js/bootstrap.min.js"></script>
    <script src="/smile/Public/bs/js/modernizr.min.js"></script>

    <!--菜单展开项控制-->
    <script src="/smile/Public/bs/js/jquery.nicescroll.js"></script>
    <!-- JAVASCRIPT CORE PAGE -->

    <!--鼠标响应插件 配合tooltip-viewport.css使用 -->
    <script src="/smile/Public/bs/js/tooltip-viewport.js"></script>
    <!--表格-->
    <script src="/smile/Public/bs/js/data-tables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/smile/Public/bs/js/data-tables/DT_bootstrap.js" type="text/javascript"></script>

    <!--bootstrap 表单验证-->
    <link rel="stylesheet" href="/smile/Public/bs/js/bootstrap-formvalidation/formValidation.css">
    <script src="/smile/Public/bs/js/bootstrap-formvalidation/formValidation.js"></script>
    <script type="text/javascript" src="/smile/Public/bs/js/bootstrap-formvalidation/framework/bootstrap.js"></script>
    <script type="text/javascript" src="/smile/Public/bs/js/bootstrap-formvalidation/language/zh_CN.js"></script>

    <!--layer 弹层组件-->
    <script src="/smile/Public/select.js"></script>
    <script src="/smile/Public/layer/layer.js"></script>

    <!-- jQuery Flot Chart-->
    <script src="/smile/Public/bs/js/flot-chart/jquery.flot.js"></script>
    <script src="/smile/Public/bs/js/flot-chart/jquery.flot.tooltip.js"></script>
    <script src="/smile/Public/bs/js/flot-chart/jquery.flot.resize.js"></script>

    <!--common scripts for all pages-->
    <script src="/smile/Public/common.js"></script>
    <script src="/smile/Public/bs/js/scripts.js"></script>

<script type="text/javascript">
    $(function(){
		$('.js-tooltip').tooltip();
		var ps = $('.input-email').val();
		if(ps!==""){
			$('.ps').hide();
		}
    });
	var loadChildTree= function (obj,pid,objId) {
		var str = objId.split("_");
		level = (str.length-2);
		if($(obj).hasClass('fa-minus-circle')){
			$(obj).removeClass('fa-minus-circle').addClass('fa-plus-circle');
			$('tr[class^="'+objId+'"]').hide();
		}else{
			$(obj).removeClass('fa-plus-circle').addClass('fa-minus-circle');
			$('tr[class^="'+objId+'"]').show();
			$('tr[class^="'+objId+'"] > td >.fa-plus-circle').each(function(){
				$(this).removeClass('fa-plus-circle').addClass('fa-minus-circle');
			})
		}
	}
	var readArticle = function (id,is) {
		//window.location.href="<?php echo U('Article/read');?>&id="+id+"&isread="+is;
		$.post("<?php echo U('Article/read');?>",{id:id,isread:is}, function (rs) {
			var json = eval("("+rs+")");
			if(json.flag==1){
				window.location.reload();
				window.location.href="<?php echo U('Article/remark');?>";
			}else if(json.flag==-1){
				layer.msg("对不起，您不是管理员，无法查看!!!",{icon:2,time:3000});
			}
		})
	}
    function ClearCache(){
		var id = 1;
		layer.confirm('确认要清除缓存么?',{icon:5,title:""},function(index){
			$.post("<?php echo U('Index/logcache');?>",{id:id},function(rs){
			if(rs==1){
				SML.msg("清除缓存成功！",{icon:1}, function () {
					location.reload();
				});
//				setTimeout(function(){window.location.reload();},1000);
			}else{layer.msg('没有数据缓存可以清除');}
			},'json');
		});
    }
	var logout = function(){
		layer.confirm("确定要退出系统么?",{icon:3,title:"系统提示"},function(){
			location.href="<?php echo U('Index/logout');?>";
		});
	}
	var inforMsg = function () {
		layer.open({
			type:2,
			title:"个人信息",
			area:['560','308'],
			anim:6,
			shade:0.8,
			shadeClose:false,
			content:"<?php echo U('Infor/inforMsg');?>"
		});
	}
	var sign = function () {
		$.post("<?php echo U('Infor/sign');?>",{}, function (rs) {
			var json = eval("("+rs+")");
			if(json.signRs==1){
				layer.msg("签到成功,连续签到[<font color='red'>"+json.signNum+"</font>]次。您当前一共有:<font color='red'>"+json.signScore+"</font>积分!",{icon:1,time:4000}, function () {
					window.location.reload();
				})
			}else{
				layer.msg("今天已签到,您当前一共有:[<font color='red'>"+json.signScore+"</font>]积分!!!",{icon:2,time:3000});
			}
		});
	}

</script>