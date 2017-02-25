$.browser = {};
$.browser.mozilla = /firefox/.test(navigator.userAgent.toLowerCase());
$.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase());
$.browser.opera = /opera/.test(navigator.userAgent.toLowerCase());
$.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());
var SML = SML?SML:{};
SML.v = '1.0.0';
SML.pageHeight = function(){
    if($.browser.msie){
        return document.compatMode == "CSS1Compat"? document.documentElement.clientHeight :
            document.body.clientHeight;
    }else{
        return self.innerHeight;
    }
};
//返回当前页面宽度
SML.pageWidth = function(){
    if($.browser.msie){
        return document.compatMode == "CSS1Compat"? document.documentElement.clientWidth :
            document.body.clientWidth;
    }else{
        return self.innerWidth;
    }
};
SML.msg = function(msg, options, func){
    var opts = {};
    //有抖動的效果,第二位是函數
    if(typeof(options)!='function'){
        opts = $.extend(opts,{time:2000,shade: [0.4, '#000000']},options);
        return layer.msg(msg, opts, func);
    }else{
        return layer.msg(msg, options);
    }
}
//用户名判断 （可输入"_",".","@", 数字，字母）
SML.isUserName = function(evt){
    var evt = evt || window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if((charCode==95 || charCode==46 || charCode==64) || (charCode>=48 && charCode<=57) || (charCode>=65 && charCode<=90) || (charCode>=97 && charCode<=122) || charCode==8){
        return true;
    }else{
        return false;
    }
}

SML.isEmail =function(v){
    var tel = new RegExp("^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$");
    return(tel.test(v));
}
//判断是否电话
SML.isTel = function(v){
    var tel = new RegExp("^[[0-9]{3}-|\[0-9]{4}-]?(\[0-9]{8}|[0-9]{7})?$");
    return(tel.test(v));
}
SML.isPhone = function(v){
    var tel = new RegExp("^[1][0-9]{10}$");
    return(tel.test(v));
}
/**
 * 检查字符串是否为合法QQ号码
 * @param {String} 字符串
 * @return {bool} 是否为合法QQ号码
 */
SML.isQQ = function (aQQ) {
    var bValidate = RegExp(/^[1-9][0-9]{4,10}$/).test(aQQ);
    if (bValidate) {
        return true;
    }
    else{
        return false;
    }
}
SML.checkQQ = function(QQ) {
    var reg = /^[1-9]{1}[0-9]{4,8}$/;
    if( reg.test(QQ) ) { return true;}
    return false;
}
//判断url
SML.isUrl = function(str){
    if(str==null||str=="") return false;
    var result=str.match(/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\’:+!]*([^<>\"])*$/);
    if(result==null)return false;
    return true;
}
//公共函数，是否为空
SML.isBlank = function( s ){
    var len=s.length;
    for( i = 0; i < len; i ++ ){
        if( s.charAt(i) != " " )
            return false;
    }
    return true;
}

SML.toJson = function(str){
    var json = {};
    try{
        if(typeof(str )=="object"){
            json = str;
        }else{
            json = eval("("+str+")");
        }
        if(json.status && json.status=='-999'){
            layer.msg('对不起，您已经退出系统！请重新登录',{icon:5},function(){
                if(window.parent){
                    window.parent.location.reload();
                }else{
                    location.reload();
                }
            });
        }else if(json.status && json.status=='-998'){
            layer.msg('对不起，您没有操作权限，请与管理员联系');
            return;
        }
    }catch(e){
        layer.msg("系统发生错误:"+e.getMessage,{icon:5});
        json = {};
    }
    return json;
}
//form表单控件是否为空
SML.checkVal = function (name){
    if( $('#'+name).val() == ''){
        $('.'+name).show().addClass('red');
    }else{
        $('.'+name).hide().removeClass('red');
    }
}
//防重复提交
SML.submit = function( id ) {
    $('#' + id).attr("disabled", true);
    $('#' + id).text("正在提交....");
}
//jquery验证手机号码 
SML.checkMobil = function(val) {
	if (!val.match(/^[(86)|0]?(13\d{9})|(15\d{9})|(18\d{9})|(17\d{9})|(14\d{9})$/)) {
		return false;
	} 
	return true; 
}

//验证码 6位数字
SML.checkCode = function (val) {
	if (!val.match(/^\d{6}$/)) {
		return false; 
	} 
	return true; 
}

//验证密码 字母，数字 6-18位
SML.checkPassword = function(val) {
	//if (!val.match(/^[\\~!@#$%^&*()-_=+|{}\[\],.?\/:;\'\"\d\w]{6,18}$/)) {
	if (!val.match(/^[\d\w]{6,18}$/)) {
		return false; 
	} 
	return true; 

} 
//是否为空验证
SML.isEmpty = function(val){
	//alert(val);
    if(val==null||$.trim(val).length==0||val=='null'){
        return true;
    }else{
    	return false;    	
    }
}
//jquery验证邮箱
SML.checkEmail = function(val) {
	if (!val.match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)) {
		//msg = '邮箱错误，请重新输入!';
		return false;
	}else{
	    return true;
	}
}
//身份证验证
SML.IdentityCodeValid = function (code) {
    var city={11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江 ",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北 ",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏 ",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外 "};
    var tip = "";
    var pass= true;
    var code= code.toUpperCase(code);
    // if(!code || !/^\d{6}(18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i.test(code)){
    //     //tip = "身份证号格式错误";
    //     pass = false;
    // }
    if (!code || !/^[1-9][0-9]{5}(19[0-9]{2}|200[0-9]|2010)(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01])[0-9]{3}[0-9xX]$/i.test(code)) {
        //tip = "身份证号格式错误";
        pass = false;
    }
   else if(!city[code.substr(0,2)]){
        //tip = "地址编码错误";
        pass = false;
    }
    else{
        //18位身份证需要验证最后一位校验位
        if(code.length == 18){
            code = code.split('');
            //∑(ai×Wi)(mod 11)
            //加权因子
            var factor = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2 ];
            //校验位
            var parity = [ 1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2 ];
            var sum = 0;
            var ai = 0;
            var wi = 0;
            for (var i = 0; i < 17; i++)
            {
                ai = code[i];
                wi = factor[i];
                sum += ai * wi;
            }
            var last = parity[sum % 11];
            if(parity[sum % 11] != code[17]){
                //tip = "校验位错误";
                pass =false;
            }
        }
    }
    //if(!pass) alert(tip);
    return pass;
}

//判断有没有在数组中存在
SML.contains = function(arr, obj) {
    var i = arr.length;  
    while (i--) {  
        if (arr[i] === obj) {  
            return true;  
        }  
    }  
    return false;  
}

/*
** randomWord 产生任意长度随机字母数字组合
** randomFlag-是否任意长度 min-任意长度最小位[固定位数] max-任意长度最大位
** xuanfeng 2014-08-28
*/
SML.randomWord = function(randomFlag, min, max){
    var str = "",
        range = min,
        arr = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

    // 随机产生
    if(randomFlag){
        range = Math.round(Math.random() * (max-min)) + min;
    }
    for(var i=0; i<range; i++){
        pos = Math.round(Math.random() * (arr.length-1));
        str += arr[pos];
    }
    return str;
}
$(function () {
    SML.conf = window.conf;
    /**
     * 解析URL
     * @param  {string} url 被解析的URL
     * @return {object}     解析后的数据
     */
    SML.parse_url = function(url){
        var parse = url.match(/^(?:([a-z]+):\/\/)?([\w-]+(?:\.[\w-]+)+)?(?::(\d+))?([\w-\/]+)?(?:\?((?:\w+=[^#&=\/]*)?(?:&\w+=[^#&=\/]*)*))?(?:#([\w-]+))?$/i);
        parse || $.error("url格式不正确！");
        return {
            "scheme"   : parse[1],
            "host"     : parse[2],
            "port"     : parse[3],
            "path"     : parse[4],
            "query"    : parse[5],
            "fragment" : parse[6]
        };
    }

    SML.parse_str = function(str){
        var value = str.split("&"), vars = {}, param;
        for(var i=0;i<value.length;i++){
            param = value[i].split("=");
            vars[param[0]] = param[1];
        }
        return vars;
    }
    SML.U = function(url, vars){
        if(!url || url=='')return '';
        var info = this.parse_url(url), path = [], reg;
        /* 验证info */
        info.path || $.error("url格式错误！");
        url = info.path;
        /* 解析URL */
        path = url.split("/");
        path = [path.pop(), path.pop(), path.pop()].reverse();
        path[1] || $.error("SML.U(" + url + ")没有指定控制器");

        /* 解析参数 */
        if(typeof vars === "string"){
            vars = this.parse_str(vars);
        }
        /* 解析URL自带的参数 */
        info.query && $.extend(vars, this.parse_str(info.query));
        if(false !== SML.conf.SUFFIX){
            url += "." + SML.conf.SUFFIX;
        }
        if($.isPlainObject(vars)){
            url += "?" + $.param(vars);
        }
        //url = url.replace(new RegExp("%2F","gm"),"+");
        url = SML.conf.APP + "/"+url;
        return url;
    }
});



