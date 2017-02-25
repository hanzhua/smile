<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
        <title></title>
            <!--配合tooltip-viewport.js使用-->
    <link href="/smile/Public/bs/css/tooltip-viewport.css" rel="stylesheet">

    <!--common-->
    <link href="/smile/Public/bs/css/style.css" rel="stylesheet">
    <link href="/smile/Public/bs/css/style-responsive.css" rel="stylesheet">

    <link href="/smile/Public/bs/css/table-responsive.css" />
    <link href="/smile/Public/bs/js/data-tables/DT_bootstrap.css" />

    <!--[if lt IE 9]>
    <script src="/smile/Public/bs/js/html5shiv.js"></script>
    <script src="/smile/Public/bs/js/respond.min.js"></script>
    <![endif]-->

    </head>
<body class="sticky-header" style="background-color: #eff0f4;">
<body style="background-color: #ffffff">
    <div class="wrapper ">
		<div class="row">
		<div class="col-md-12">
			<section class="panel">
				<header class="panel-heading custom-tab ">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#home1" data-toggle="tab"><i class="fa fa-home"></i> 我的桌面</a></li>
					<li class=""><a href="#home2" data-toggle="tab">网站配置</a></li>
					<li class=""><a href="#home3" data-toggle="tab">Picker浏览</a></li>
					<li class=""><a href="#home4" data-toggle="tab">图片上传</a></li>
				</ul>
				</header>
				<div class="panel-body text-center">
					<div class="tab-content">
					<div class="tab-pane active" id="home1">
						<table class="table text-center">
    <tr><td colspan="3"><strong>欢迎SMILE-Ex后台模板！</strong></td></tr>
    <tr>
        <td>前台浏览次数：4444</td>
        <td>上次登录IP：<?php echo ($_SESSION['SML_TODAY']['ip']); ?></td>
        <td>上次登录时间：<?php echo ($_SESSION['SML_TODAY']['time']); ?></td>
    </tr>
</table>
<table class="table table-bordered table-condensed text-center">
    <tr>
        <td colspan="2" align="left"><strong>服务器信息：</strong></td>
    </tr>
    <tr>
        <td align="right">服务器系统：</td>
        <td align="left"><?php echo SMLGetOS(); ?></td>
    </tr>
    <tr>
        <td align="right" width="300px;">服务器地址：</td>
        <td align="left"><?php echo SMLMain(); ?></td>
    </tr>
    <tr>
        <td align="right" width="300px;">服务器端口：</td>
        <td align="left"><?php echo ($_SERVER['SERVER_PORT']); ?></td>
    </tr>
    <tr>
        <td align="right" width="300px;">服务器语言：</td>
        <td align="left"><?php echo ($_SERVER['HTTP_ACCEPT_LANGUAGE']); ?></td>
    </tr>
    <tr>
        <td align="right" width="300px;">WEB 服务器：</td>
        <td align="left"><?php echo ($_SERVER['SERVER_SOFTWARE']); ?></td>
    </tr>
    <tr>
        <td align="right" width="300px;">PHP 版本号：</td>
        <td align="left"><?php echo (PHP_VERSION); ?></td>
    </tr>
    <tr>
        <td align="right"><a title="官方网站" href="http://www.thinkphp.cn">ThinkPHP版本：</a></td>
        <td align="left">ThinkPHP<sup><?php echo THINK_VERSION ?></sup></td>
    </tr>
    <tr>
        <td align="right" width="300px;">数据库信息：</td>
        <td align="left"><?php echo ($_SESSION['SML_MySQL']['MySQL_NAME']); ?><sup><?php echo ($_SESSION['SML_MySQL']['MySQL_VERSION']); ?></sup> [<font color="red"><?php echo(strtoupper(C('DB_NAME')));?></font>]内存占用: <font color="#4b0082"><?php echo ($_SESSION['SML_MySQL']['MySQL_SIZE']); ?></font></td>
    </tr>
</table>
					</div>
					<div class="tab-pane" id="home2">
						<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
        <title></title>
            <!--配合tooltip-viewport.js使用-->
    <link href="/smile/Public/bs/css/tooltip-viewport.css" rel="stylesheet">

    <!--common-->
    <link href="/smile/Public/bs/css/style.css" rel="stylesheet">
    <link href="/smile/Public/bs/css/style-responsive.css" rel="stylesheet">

    <link href="/smile/Public/bs/css/table-responsive.css" />
    <link href="/smile/Public/bs/js/data-tables/DT_bootstrap.css" />

    <!--[if lt IE 9]>
    <script src="/smile/Public/bs/js/html5shiv.js"></script>
    <script src="/smile/Public/bs/js/respond.min.js"></script>
    <![endif]-->

    </head>
<body class="sticky-header" style="background-color: #eff0f4;">
<body style="background-color: #ffffff">
    <div class="panel">
	<div class="panel-heading">网站信息</div>
	<div class="panel-body">
	    <form id="form" method="post" class="form-group" action="<?php echo U('Admin/adminset');?>" onsubmit="return AdminCheck();">
			<input type="hidden" name="id" value="<?php echo ($SETUP['id']); ?>">
		<div class="row">
		    <div class="col-xs-1"></div>
		    <div class="col-xs-2"><label class="control-label"> 网站标题:<font color="red">*</font></label></div>
		    <div class="col-xs-8">
			<input type="text" class="form-control" id='title' name="title" value="<?php echo ($SETUP['title']); ?>" />
			<div class="tips"></div></div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-2"><label class="control-label"> 网站地址:<font color="red">*</font></label></div>
			<div class="col-xs-8">
				<input type="text" class="form-control" id='url' name="url" value="<?php echo ($SETUP['url']); ?>" />
				<div class="tips"></div></div>
		</div>
		<div class="row">
		    <div class="col-xs-1"></div>
		    <!-- <div class="input-group">
		    <span class="input-group-addon">网站关键字：</span> -->
		    <div class="col-xs-2"><label class="control-label"> 网站关键字:<font color="red">*</font></label>
		    </div>
		    <div class="col-xs-8">
			<textarea rows="3" class="form-control" id='keyword' name="keyword" ><?php echo ($SETUP['keyword']); ?></textarea>
			<div class="tips"></div>
		    </div>
		</div>
		<div class="row">
		    <div class="col-xs-1"></div>
		    <div class="col-xs-2"><label class="control-label">网站描述:<font color="red">*</font></label>
		    </div>
		    <div class="col-xs-8">
			<textarea rows="3" class="form-control" id='descript' name="descript"><?php echo ($SETUP['descript']); ?></textarea>
			<div class="tips"></div>
		    </div>
		</div>
		<div class="row">
		    <div class="col-xs-1"></div>
		    <div class="col-xs-2"><label class="control-label">网站联系人:<font color="red">*</font></label>
		    </div>
		    <div class="col-xs-8">
			<input class="form-control" id='name' name="name" value="<?php echo ($SETUP['name']); ?>">
			<div class="tips"></div>
		    </div>
		</div>
		<div class="row">
		    <div class="col-xs-1"></div>
		    <div class="col-xs-2"><label class="control-label">联系方式:</label>
		    </div>
		    <div class="col-xs-8">
			<input class="form-control" id='tel' name="tel" value="<?php echo ($SETUP['tel']); ?>">
			<div class="tips"></div>
		    </div>
		</div>
		<div class="row">
		    <div class="col-xs-1"></div>
		    <div class="col-xs-2"><label class="control-label">Q Q号码:</label>
		    </div>
		    <div class="col-xs-8">
			<input class="form-control" id='qq' name="qq" value="<?php echo ($SETUP['qq']); ?>">
			<div class="tips"></div>
		    </div>
		</div>
		<div class="row">
		    <div class="col-xs-1"></div>
		    <div class="col-xs-2"><label class="control-label">底部信息:<font color="red">*</font></label>
		    </div>
		    <div class="col-xs-8">
			<textarea rows="3" class="form-control" id='foot' name="foot"><?php echo ($SETUP['foot']); ?></textarea>
			<div class="tips"></div>
		    </div>
		</div>
		<div class="row">
		    <div class="col-xs-12">
			<input  class="btn btn-success form-control" type="submit" value="提交">
		    </div>
		</div>
	    </form>
        </div>
    </div>
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

	</body>
</html>
<script type="text/javascript">
    function AdminCheck() {
		if ($('#title').val() == '') {
			layer.msg("请输入标题");
			$('#title').focus();
			return false;
		}
		if ($('#keyword').val() == '') {
			layer.msg("请输入网站关键字");
			$('#keyword').focus();
			return false;
		}
		if ($('#descript').val() == '') {
			layer.msg("请输入网站描述");
			$('#descript').focus();
			return false;
		}
		if ($('#name').val() == '') {
			$('#name').focus();
			layer.msg("请输入网站联系人");
			return false;
		}
		if ($('#foot').val() == '') {
			$('#foot').focus();
			layer.msg("请输入底部信息");
			return false;
		}
		return true;
    }


</script>
					</div>
					<div class="tab-pane" id="home3">
						<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Media Manager
                    <!--<span class="tools pull-right">-->
                        <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
                        <!--<a href="javascript:;" class="fa fa-times"></a>-->
                     <!--</span>-->
            </header>
            <div class="panel-body">

                <!--<ul id="filters" class="media-filter">-->
                    <!--<li><a href="#" data-filter="*"> All</a></li>-->
                    <!--<li><a href="#" data-filter=".images">Images</a></li>-->
                    <!--<li><a href="#" data-filter=".audio">Audio</a></li>-->
                    <!--<li><a href="#" data-filter=".video">Video</a></li>-->
                    <!--<li><a href="#" data-filter=".documents">Documents</a></li>-->
                <!--</ul>-->

                <!--<div class="btn-group pull-right">-->
                    <!--<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-check-square-o"></i> Select all</button>-->
                    <!--<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-folder-open"></i> Add New</button>-->
                    <!--<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-trash-o"></i> Delete</button>-->
                    <!--<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> Upload New File</button>-->
                <!--</div>-->

                <div id="gallery" class="media-gal">
                    <?php if(is_array($IMAGE)): foreach($IMAGE as $key=>$v): ?><div class="images item " >
                        <!--<a href="#myModal" data-toggle="modal">-->
                        <a href="javascript:See(<?php echo ($v['id']); ?>);">
                            <img title="<?php echo ($v["id"]); ?>" src="<?php echo ($v["savepath"]); echo ($v["savename"]); ?>" width="420px" height="290px"/>
                        </a>
                        <p><?php echo ($v["name"]); ?></p>
                    </div><?php endforeach; endif; ?>
                </div>

                <div class="col-md-12 text-center clearfix">
                    <?php echo ($page); ?>
                </div>
            </div>
        </section>
    </div>
</div>
					</div>
					<div class="tab-pane" id="home4">
						<form id="formPic" action="<?php echo U('Admin/picker');?>" onsubmit="return checkPic();" method="post" enctype="multipart/form-data">
							<input type="file" id="picker" name="picker">
							<!--<input type="submit" value="上传">-->
						</form>
					</div>
				</div>
				</div>
			</section>
		</div>
		</div>
    </div>
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

</body>
</html>
<script>
	var checkPic = function(){
		$($('#picker').val()).change(function (){
			return true;
			alert(123);
			exit;
		});
		return false;
	}
	var See = function (id) {
		layer.open({
			type: 2,
			title: "图片详情",
			area: ['610px', '458px'],
			anim:6,
			shade: 0.8, //透明度
			shadeClose: true,
			maxmin:true,
			content: '<?php echo U("Admin/homeSee");?>&id='+id,
		});
	}
</script>