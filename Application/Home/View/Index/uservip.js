/**
 * Created by username on 2017/1/17.
 */
function vipEdit(){
    var params = {};
    params.contact      = $('#contact').val();
    params.password     = $('#password').val();
    if(params.contact == ''){
        $('.contact').html('用户昵称不能为空').show().addClass('red');
        $('.contact').val('').focus();
        return false;
    }
    if(params.contact.length > 15){
        $('.contact').html('昵称过长，请重新填写').show().addClass('red');
        $('.contact').val('').focus();
        return false;
    }
    if($('#password1').val() !== params.password){
        $('.password1').html('两次输入的密码不一致').show().addClass('red');
        $('#password1').val('').focus();
        return false;
    }
    $.post(SML.U('Index/vipEdit'),params, function (rs) {
        if(rs==1){
            layer.msg('修改成功!',{icon:1,time:2000}, function () {
                window.location.reload();
            })
        }else{
            layer.msg('修改失败!!!',{icon:2,time:2000})
        }
    })
}
