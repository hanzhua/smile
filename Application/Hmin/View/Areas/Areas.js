/**
 * Created by username on 2017/1/1.
 */
$(function () {
    var AreasSel  = function (id,title) {
        layer.open({
            type:2,
            title:title,
            area:['50%','286px'],
            shade:0.8,
            shadeClose:true,
            content:"{:U(Areas/index)}&id="+id,
        });
    }
    var AreasEdit = function (id) {
        alert(id);
        layer.open({
            type: 2,
            title: "修改地区",
            area: ['50%', '286px'],
            shade: 0.8,
            shadeClose: true,
            content: '{:U("Areas/toEdit")}&id='+id,
        });
    }
});