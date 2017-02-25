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
<body style='background-color: #fff;'>
    <form class="navbar-form" action="<?php echo U('Article/lst');?>" method="POST">
    <div class="panel-heading"><b>文章列表管理</b>
        <div class="pull-right" >
            分类：
            <select name="cid" class="" style="width:120px;height: 26px">
                <option value="0">请选择</option>
                <?php if(is_array($Cate)): foreach($Cate as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
            </select>
            <input type="text" name="keyName" placeholder="Search...">
            <button type="submit" style="padding:2px 4px; " ><i class="fa fa-search"></i></button>
            <a href="javascript:ArtiAdd();"><button type="button"><span class="fa fa-plus-circle"></span> 添加文章</button></a>
            <script type="text/javascript">
                function ArtiAdd(){
                    window.location.href="<?php echo U('Article/add');?>";
                }
            </script>
        </div>
    </div>
    </form>
    <table class="table table-hover text-center">
        <tr align="center">
            <td width="50" title="置顶顺序,Enter确认修改"><b>置顶</b></td>
            <td><b>序 号</b></td>
            <td><b>标 题</b></td>
            <td><b>图 片</b></td>
            <td><b>类 型</b></td>
            <td><b>热 度</b></td>
            <td><b>评论</b></td>
            <td><b>轮播图</b></td>
            <td><b>添加时间</b></td>
            <td><b>操 作</b></td>
        </tr>
        <?php if(is_array($Arti)): foreach($Arti as $key=>$v): if($v["id"] == ''): else: ?>
             <tr>
                 <td title="置顶顺序,Enter确认修改">
                     <form action="<?php echo U('Article/EditTOP');?>" method="post">
                         <input name="<?php echo ($v["id"]); ?>" value="<?php echo ($v["istop"]); ?>" type="text" style="width: 40px" title="置顶顺序,Enter确认修改" >
                     </form>
                 </td>
                 <td><?php echo ($v["id"]); ?></td>
                 <td width="200px"><?php echo ($v["title"]); ?></td><!-- |msubstr=0,12 -->
                 <td><img src="<?php echo ($v['picurl'][0]['src']); ?>" width='120px;'height='44px;'/></td>
                 <td><font color="#00CC99"><?php echo ($v["cname"]); ?></font></td>
                 <td>
                     <?php if($v['viewnum'] > 99): ?><span style="color:red;"><?php echo ($v["viewnum"]); ?></span>
                         <?php else: echo ($v["viewnum"]); endif; ?>℃
                 </td>
                 <td>评论</td>
                 <td>
                     <?php if($v['indeximg'] == 1): ?><a href="javascript:void(0);" onclick="delimg(<?php echo ($v['id']); ?>);"><font color="red">已设置</font></a>
                         <?php else: ?>
                         <a href="javascript:void(0);" onclick="doimg(<?php echo ($v['id']); ?>);"><font color="#00CC99">设置</font></a><?php endif; ?>
                 </td>
                 <td width="100px"><?php echo ($v["createtime"]); ?></td>
                 <td width="180px">
                     <?php if($v["istop"] != 1): ?><!-- gt >,egt >=,lt < ,eq =,neq <> -->
                         <a class="btn btn-xs btn-success" href="<?php echo U('Article/is_top',array('id'=>$v['id'],'istop'=>1));?>">
                             <span class="fa fa-edit"></span> 置顶</a>
                         <?php else: ?>
                         <a class="btn btn-xs btn-success" href="<?php echo U('Article/is_top',array('id'=>$v['id'],'istop'=>0));?>">
                             <span class="fa fa-edit"></span> 取消</a><?php endif; ?>
                     <a class="btn btn-xs btn-info" href="<?php echo U('Article/remark',array('id'=>$v['id']));?>">
                         <span class="fa fa-edit"></span> 评论列表</a>
                     <a class="btn btn-xs btn-warning" href="<?php echo U('Article/add',array('id'=>$v['id']));?>">
                         <span class="fa fa-edit"></span> 修改</a>
                     <a class="btn btn-xs btn-danger" href="<?php echo U('Article/is_del',array('id'=>$v['id'],'isdel'=>1));?>">
                         <span class="fa fa-edit"></span> 文章回收</a>
                 </td>
             </tr><?php endif; endforeach; endif; ?>
    </table>
    <div class="btn-group"><?php echo ($page); ?></div>
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

<script>
//    var IS_Del = function (id,isdel) {
//        var params = {
//            id      : id,
//            isdel   : isdel
//        };
//        layer.confirm("确定要回收该篇文章么?",{icon:3,title:'系统提示'}, function (index) {
//            $.post("<?php echo U('Article/is_del');?>",{data:params}, function (rs) {
//                if(rs==1){
//                    layer.close(index);
//                    layer.msg("回收成功!",{icon:1,time:2000}, function () {
//                        window.location.reload();
//                    });
//                }else{
//                    layer.close(index);
//                    layer.msg('回收失败!',{icon:2,time:2000});
//                }
//            });
//        });
//    }
    //分类 Cate
    function ArtiCate(id){
        var loading = layer.msg("请等候...",{icon:16,time:600000});
        $.post("<?php echo U('Article/selcate');?>",{}, function (data) {
            alert(data);
            if(data==1){
                layer.close(loading);
                window.location.reload();
            }
        });
//        window.location.href="<?php echo U('Article/selcate');?>&id="+id;
    }

    //设置轮播图
    function doimg(id){
        layer.confirm('确定要<span style="color:red;">设置</span>该轮播图么？',{icon:3,title:'设置轮播图'},function(index){
            var loading = layer.msg("请稍后...",{icon:16,time:600000});
            $.post('<?php echo U("Article/doimg");?>',{id:id},function(rs){
                if (rs ==1){
                    layer.close(loading);
                    layer.msg("设置成功！")
                    setTimeout(function(){window.location.reload();},1500);
                }else{
                    layer.close(loading);
                    setTimeout(function(){layer.msg("设置失败！");},1500);
                }
            },'json');
        });
    }
    //取消轮播图
    function delimg(id){
        layer.confirm('确定要<span style="color:red">取消</span>该轮播图么？',{icon:5,title:'取消轮播图'},function(index){
            var loading = layer.msg("请稍后...",{icon:16,time:600000});
            $.post('<?php echo U("Article/delimg");?>',{id:id},function(rs){
                if (rs ==1){
                    layer.close(loading);
                    layer.msg("取消成功");
                    setTimeout(function(){window.location.reload();},1500);
                }else{
                    layer.msg("取消失败");
                }
            },'json');
        });
    }
</script>