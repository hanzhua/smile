<?php
// +----------------------------------------------------------------------
// | @Version: 2016-12-3 14:17:01 @Author: 画中浅笑
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huazhongsmile <javahanmr@163.com>
// +----------------------------------------------------------------------
/**
 * 判断是否手机访问
 */
function SMLisMobile() {
    $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
    $mobile_browser = '0';
    if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
        $mobile_browser++;
    if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))
        $mobile_browser++;
    if(isset($_SERVER['HTTP_X_WAP_PROFILE']))
        $mobile_browser++;
    if(isset($_SERVER['HTTP_PROFILE']))
        $mobile_browser++;
    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
    $mobile_agents = array(
        'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
        'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
        'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
        'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
        'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
        'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
        'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
        'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
        'wapr','webc','winw','winw','xda','xda-'
    );
    if(in_array($mobile_ua, $mobile_agents))$mobile_browser++;
    if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)$mobile_browser++;
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)$mobile_browser=0;
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)$mobile_browser++;
    if($mobile_browser>0){
        return true;
    }else{
        return false;
    }
}
/**
 * 中国网建短信服务商
 * @param string $phoneNumer  手机号码
 * @param string $content     短信内容
 */
function SMLSendSMS3($phoneNumer,$content){
    $url = 'http://utf8.sms.webchinese.cn/?Uid='.SMLConf("CONF.smsKey").'&Key='.SMLConf("CONF.smsPass").'&smsMob='.$phoneNumer.'&smsText='.$content;
    $ch=curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//设置否输出到页面
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30 ); //设置连接等待时间
    curl_setopt($ch, CURLOPT_ENCODING, "gzip" );
    $data=curl_exec($ch);
    curl_close($ch);
    return $data;
}
/**
 * 发送短信
 * 此接口要根据不同的短信服务商去写，这里只是一个参考
 * @param string $phoneNumer  手机号码
 * @param string $content     短信内容
 */
function SMLSendSMS2($phoneNumer,$content){
    $url = 'http://223.4.21.214:8180/service.asmx/SendMessage?Id='.$GLOBALS['CONFIG']['smsOrg']."&Name=".$GLOBALS['CONFIG']['smsKey']."&Psw=".$GLOBALS['CONFIG']['smsPass']."&Timestamp=0&Message=".$content."&Phone=".$phoneNumer;
    $ch=curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//设置否输出到页面
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30 ); //设置连接等待时间
    curl_setopt($ch, CURLOPT_ENCODING, "gzip" );
    $data=curl_exec($ch);
    curl_close($ch);
    return "$data";
}
/**
 * @param unknown_type $phoneNumer
 * @param unknown_type $content
 */
function SMLSendSMS($phoneNumer,$content){
    $url = 'http://utf8.sms.webchinese.cn/?Uid='.$GLOBALS['CONFIG']['smsKey'].'&Key='.$GLOBALS['CONFIG']['smsPass'].'&smsMob='.$phoneNumer.'&smsText='.$content;
    $ch=curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//设置否输出到页面
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30 ); //设置连接等待时间
    curl_setopt($ch, CURLOPT_ENCODING, "gzip" );
    $data=curl_exec($ch);
    curl_close($ch);
    return $data;
}
//================================================
/**
 * 建立文件夹
 * @param string $aimUrl
 * @return viod
 */
function SMLCreateDir($aimUrl) {
    $aimUrl = str_replace('', '/', $aimUrl);
    $aimDir = '';
    $arr = explode('/', $aimUrl);
    $result = true;
    foreach ($arr as $str) {
        $aimDir .= $str . '/';
        if (!file_exists_case($aimDir)) {
            $result = mkdir($aimDir,0777);
        }
    }
    return $result;
}
/**
 * 建立文件
 * @param string $aimUrl
 * @param boolean $overWrite 该参数控制是否覆盖原文件
 * @return boolean
 */
function SMLCreateFile($aimUrl, $overWrite = false) {
    if (file_exists_case($aimUrl) && $overWrite == false) {
        return false;
    } elseif (file_exists_case($aimUrl) && $overWrite == true) {
        SMLDelFile($aimUrl);
    }
    $aimDir = dirname($aimUrl);
    SMLCreateDir($aimDir);
    touch($aimUrl);
    return true;
}/**
 * 删除文件
 * @param string $aimUrl
 * @return boolean
 */
function SMLDelFile($aimUrl) {
    if (file_exists_case($aimUrl)) {
        unlink($aimUrl);
        return true;
    } else {
        return false;
    }
}
function SMLLog($filepath,$word){
    if(!file_exists_case($filepath)){
        SMLCreateFile($filepath);
    }
    $fp = fopen($filepath,"a");
    flock($fp, LOCK_EX) ;
    fwrite($fp,$word);
    flock($fp, LOCK_UN);
    fclose($fp);
}
//================================================================
/**
 * 判断手机号格式是否正确
 */
function SMLisPhone($phoneNo){
    $reg = "/^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$/";
    $rs = \think\Validate::regex($phoneNo,$reg);
    return $rs;
}


/**
 * 图片上传
 * @return type
 */
function SML_File_Uploads(){
    $upload = new \Think\Upload();        // 实例化上传类
    $upload->maxSize   =     26145728 ;   // 设置附件上传大小
    $upload->exts      =     array('gif','jpg','jpeg','bmp','png');// 设置附件上传类型
    $upload->rootPath  =     './Uploads/assets/'; // 设置附件上传根目录
    $upload->savePath  =    './';   // 设置附件上传（子）目录
    // 上传文件
    $info   = $upload->upload();
    return $info;
}

/**
 *  生成验证码
 */
function SMLVerify(){
    //验证码测试
    $Verify = new \Think\Verify();
    $Verify->fontSize = 18;   //验证码字体大小
    $Verify->length   = 4;    //验证码长度
    $Verify->useNoise = true;//背景杂点
    // 验证码字体使用 ThinkPHP/Library/Think/Verify/ttfs/5.ttf
    $Verify->fontttf = '5.ttf';
    // 开启验证码背景图片功能 随机使用 ThinkPHP/Library/Think/Verify/bgs 目录下面的图片
    $Verify->useImgBg = true;

    //设置验证码字符为纯数字
//    $Verify->codeSet  = '1234567890';

    //中文验证==================
//    $Verify->useZh    = true;//开启中文验证
//    //设置中文验证码字符
//    $Verify->zhSet    = '们以我到他会作时要动国产的一是工就年阶义发成部民可出能方进在了不和有大这';
    //==========================
    $Verify->entry();
}
/**
 * 检测输入的验证码是否正确
 * @param type $code   用户输入的验证码字符串
 * @param type $id
 * @return type
 */
function SMLCheckVerify($code, $id = ''){
    $verify = new \Think\Verify();    
    return $verify->check($code, $id);
}

/**
 * desc   无限极分类目录树
 * @param $items 多为数组
 * @param $id
 * @param $pid   父类ID
 * @param $son   子类
 * @return array
 */
function SMLmenuTree($items, $id = 'id', $pid = 'pid', $son = 'child') {
    $tree = array(); //格式化的树
    $tmpMap = array();  //临时扁平数据
    foreach ($items as $item) {
        $tmpMap[$item[$id]] = $item;
    }
    foreach ($items as $item) {
        if (isset($tmpMap[$item[$pid]])) {
            $tmpMap[$item[$pid]][$son][] = &$tmpMap[$item[$id]];
        } else {
            $tree[] = &$tmpMap[$item[$id]];
        }
    }
    return $tree;
}
/**
* 邮件发送函数
*/
function sendMail($to, $title, $content) {
    Vendor('PHPMailer.PHPMailerAutoload');     
    $mail = new PHPMailer(); //实例化
    $mail->IsSMTP(); // 启用SMTP
    $mail->Host=C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
    $mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
    $mail->Username = C('MAIL_USERNAME'); //你的邮箱名
    $mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
    $mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
    $mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
    $mail->AddAddress($to,"您好");
    $mail->WordWrap = 50; //设置每行字符长度
    $mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
    $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
    $mail->Subject =$title; //邮件主题
    $mail->Body = $content; //邮件内容
    $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
    return($mail->Send());

    //临时解决邮箱发送邮件问题
    //getHttpResponseGET("http://code.yaopengtao.com/2016/maill/sendmail.php?to={$to}&title={$title}&content={$content}");
    //return true;
}

/**
 * 验证签名
 * @param type $str 需要签名的字符串
 * @param type $key
 */
function SMLMd5($str, $key = 'huazhongsmile') {
    $str = $str . $key;
    return md5($str);
}
/**
 * 获取二级域名
 * smile
 * @return string
 */
function SMLGetMain2(){
    $domain     = $_SERVER['HTTP_HOST'];//smile.com
    $domain_arr = explode('.',$domain); //array([0]=>'smile' [1]=>'com')
    $count      = count($domain_arr);   //2
    //if ($count < 3){
      //  return 'www';
    //}
    return $domain_arr[0];
}
/**
 * 获取系统根目录
 * E:\xampp\htdocs\smile
 */
function SMLRootPath(){
    return dirname(dirname(dirname(dirname(__File__))));
}
/**
 * 获取网站域名
 * http://smile.com/smile
 */
function SMLMain(){
    $server = $_SERVER['HTTP_HOST'];
    $http = is_ssl()?'https://':'http://';
    return $http.$server.__ROOT__;
}
/**
 * 获取网站根域名
 * http://smile.com
 */
function SMLRootMain(){
    $server = $_SERVER['HTTP_HOST'];
    $http = is_ssl()?'https://':'http://';
    return $http.$server;
}
/**
 * 获取一级域名后缀
 * @return string
 */
function SMLGetMainFix(){
    $arr = explode(".", SMLMain());//Array ( [0] => http://smile [1] => com/smile )
    return $arr[1];
}

/**
 * 获取一级域名长度
 * @return string
 */
function SMLGetMainLength($domain){
    $arr = explode(".", SMLMain());
    return strlen($arr[0]);
}
/**
 * 计算二维数组某个值的合
 * @param $arr
 * @param $key
 * @param string $keys
 * @return int 返回和
 */
function SMLArraySUM($arr, $key, $keys = '') {
    if ($arr) {
        $sum_no = 0;
        foreach ($arr as $v) {
            if ($keys) {
                $sum_no += $v[$key][$keys];
            } else {
                $sum_no += $v[$key];
            }
        }
        return $sum_no;
    } else {
        return 0;
    }
}
/**
 * 获取ip
 * @return   [type]                   [description]
 */
function SMLGetIP(){
    if (getenv('HTTP_CLIENT_IP')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } else if (getenv('HTTP_X_FORWARDED_FOR')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } else if (getenv('REMOTE_ADDR')) {
        $ip = getenv('REMOTE_ADDR');
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
/**
 * 根据IP获取城市
 */
function SMLIPAddr(){
    $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.get_client_ip();
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_ENCODING ,'utf8');
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $location = curl_exec($ch);
    curl_close($ch);
    if(is_array($location)){
        $location = json_decode($location);
        return array('province'=>$location->province,'city'=>$location->city,'district'=>$location->district);
    }
    return 'NULL!';
}
////获取访客的地理位置
function SMLGetAddr($ip=''){
    if(empty($ip)){
        //$ip = SMLGetIP();
        $ip = get_client_ip(0, $adv=true);//0->返回IP地址； $adv=true 进行高级获取，排除伪装
    }
    //根据新浪api接口获取
    $ipadd = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?ip=".$ip);
    if($ipadd){
        $charset = iconv("gbk", "utf-8", $ipadd);
        preg_match_all("/[x{4e00}-x{9fa5}]+/u", $charset, $ipadds);
        return $ipadds;//返回一个二维数组
    } else{
        return "NULL!";
    }
}

//获得访客浏览器
function SMLGetBrowser(){
    $agent = $_SERVER["HTTP_USER_AGENT"];
    if (strpos($agent, 'MSIE') !== false || strpos($agent, 'rv:11.0')) //ie11判断
    {
        return "ie";
    } else if (strpos($agent, 'Firefox') !== false) {
        return "firefox";
    } else if (strpos($agent, 'Chrome') !== false) {
        return "chrome";
    } else if (strpos($agent, 'Opera') !== false) {
        return 'opera';
    } else if ((strpos($agent, 'Chrome') == false) && strpos($agent, 'Safari') !== false) {
        return 'safari';
    } else if (strpos($agent, 'MicroMessenger') !== false) {
        return 'weixin';
    } else {
        return 'NULL!';
    }

}

/**
 * 获取浏览器版本号
 * @return   [type]                   [description]
 */
function SMLGetBrowserVer(){
    if (empty($_SERVER['HTTP_USER_AGENT'])) {
        //当浏览器没有发送访问者的信息的时候
        return 'NULL!';
    }
    $agent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('/MSIE\s(\d+)\..*/i', $agent, $regs)) {
        return $regs[1];
    } elseif (preg_match('/FireFox\/(\d+)\..*/i', $agent, $regs)) {
        return $regs[1];
    } elseif (preg_match('/Opera[\s|\/](\d+)\..*/i', $agent, $regs)) {
        return $regs[1];
    } elseif (preg_match('/Chrome\/(\d+)\..*/i', $agent, $regs)) {
        return $regs[1];
    } elseif ((strpos($agent, 'Chrome') == false) && preg_match('/Safari\/(\d+)\..*$/i', $agent, $regs)) {
        return $regs[1];
    } else {
        return 'NULL!';
    }
}

////获得访客浏览器语言
function SMLGetLang() {
    if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $lang = substr($lang, 0, 5);
        if (preg_match("/zh-cn/i", $lang)) {
            $lang = "简体中文";
        } elseif (preg_match("/zh/i", $lang)) {
            $lang = "繁体中文";
        } else {
            $lang = "English";
        }
        return $lang;
    } else {
        return "NONE!";
    }
}

////获取访客操作系统
/**
 * 获取用户系统  echo php_uname();
 * @return   [type]                   [description]
 */
function SMLGetOS(){
    $agent = $_SERVER['HTTP_USER_AGENT'];
    $os    = false;

    if (preg_match('/win/i', $agent) && strpos($agent, '95')) {
        $os = 'Windows 95';
    } else if (preg_match('/win 9x/i', $agent) && strpos($agent, '4.90')) {
        $os = 'Windows ME';
    } else if (preg_match('/win/i', $agent) && preg_match('/98/i', $agent)) {
        $os = 'Windows 98';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 6.0/i', $agent)) {
        $os = 'Windows Vista';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 6.1/i', $agent)) {
        $os = 'Windows 7';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 6.2/i', $agent)) {
        $os = 'Windows 8';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 10.0/i', $agent)) {
        $os = 'Windows 10'; #添加win10判断
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 5.1/i', $agent)) {
        $os = 'Windows XP';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 5/i', $agent)) {
        $os = 'Windows 2000';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt/i', $agent)) {
        $os = 'Windows NT';
    } else if (preg_match('/win/i', $agent) && preg_match('/32/i', $agent)) {
        $os = 'Windows 32';
    } else if (preg_match('/linux/i', $agent)) {
        $os = 'Linux';
    } else if (preg_match('/unix/i', $agent)) {
        $os = 'Unix';
    } else if (preg_match('/sun/i', $agent) && preg_match('/os/i', $agent)) {
        $os = 'SunOS';
    } else if (preg_match('/ibm/i', $agent) && preg_match('/os/i', $agent)) {
        $os = 'IBM OS/2';
    } else if (preg_match('/Mac/i', $agent) && preg_match('/PC/i', $agent)) {
        $os = 'Macintosh';
    } else if (preg_match('/PowerPC/i', $agent)) {
        $os = 'PowerPC';
    } else if (preg_match('/AIX/i', $agent)) {
        $os = 'AIX';
    } else if (preg_match('/HPUX/i', $agent)) {
        $os = 'HPUX';
    } else if (preg_match('/NetBSD/i', $agent)) {
        $os = 'NetBSD';
    } else if (preg_match('/BSD/i', $agent)) {
        $os = 'BSD';
    } else if (preg_match('/OSF1/i', $agent)) {
        $os = 'OSF1';
    } else if (preg_match('/IRIX/i', $agent)) {
        $os = 'IRIX';
    } else if (preg_match('/FreeBSD/i', $agent)) {
        $os = 'FreeBSD';
    } else if (preg_match('/teleport/i', $agent)) {
        $os = 'teleport';
    } else if (preg_match('/flashget/i', $agent)) {
        $os = 'flashget';
    } else if (preg_match('/webzip/i', $agent)) {
        $os = 'webzip';
    } else if (preg_match('/offline/i', $agent)) {
        $os = 'offline';
    } else {
        $os = 'NULL!';
    }
    return $os;
}

/**
 * 截取字符串
 * @param $str          传入字符串
 * @param int $start    开始截取位置
 * @param $length       截取长度
 * @param string $charset 编码方式
 * @param bool $suffix
 * @return string       返回截取的字符串
 */
function SMLmsubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {
    $newStr = '';
    if (function_exists ( "mb_substr" )) {
        if ($suffix)
            $newStr = mb_substr ( $str, $start, $length, $charset );
        else
            $newStr = mb_substr ( $str, $start, $length, $charset );
    } elseif (function_exists ( 'iconv_substr' )) {
        if ($suffix)
            $newStr = iconv_substr ( $str, $start, $length, $charset );
        else
            $newStr = iconv_substr ( $str, $start, $length, $charset );
    }
    if($newStr==''){
        $re ['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re ['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re ['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re ['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all ( $re [$charset], $str, $match );
        $slice = join ( "", array_slice ( $match [0], $start, $length ) );
        if ($suffix)
            $newStr = $slice;
    }
    return (strlen($str)>strlen($newStr))?$newStr."...":$newStr;
}

/**
 * 获取中文字符拼音首字母
 * @param $str
 * @return string
 */
function SMLGetFirstCharter($str){
    if(empty($str)){
        return '';
    }
    $fchar=ord($str{0});
    if($fchar>=ord('A')&&$fchar<=ord('z')) return strtoupper($str{0});
    $s1=iconv('UTF-8','gb2312',$str);
    $s2=iconv('gb2312','UTF-8',$s1);
    $s=$s2==$str?$s1:$str;
    $asc=ord($s{0})*256+ord($s{1})-65536;
    if($asc>=-20319 && $asc<=-20284) return 'A';
    if($asc>=-20283 && $asc<=-19776) return 'B';
    if($asc>=-19775 && $asc<=-19219) return 'C';
    if($asc>=-19218 && $asc<=-18711) return 'D';
    if($asc>=-18710 && $asc<=-18527) return 'E';
    if($asc>=-18526 && $asc<=-18240) return 'F';
    if($asc>=-18239 && $asc<=-17923) return 'G';
    if($asc>=-17922 && $asc<=-17418) return 'H';
    if($asc>=-17417 && $asc<=-16475) return 'J';
    if($asc>=-16474 && $asc<=-16213) return 'K';
    if($asc>=-16212 && $asc<=-15641) return 'L';
    if($asc>=-15640 && $asc<=-15166) return 'M';
    if($asc>=-15165 && $asc<=-14923) return 'N';
    if($asc>=-14922 && $asc<=-14915) return 'O';
    if($asc>=-14914 && $asc<=-14631) return 'P';
    if($asc>=-14630 && $asc<=-14150) return 'Q';
    if($asc>=-14149 && $asc<=-14091) return 'R';
    if($asc>=-14090 && $asc<=-13319) return 'S';
    if($asc>=-13318 && $asc<=-12839) return 'T';
    if($asc>=-12838 && $asc<=-12557) return 'W';
    if($asc>=-12556 && $asc<=-11848) return 'X';
    if($asc>=-11847 && $asc<=-11056) return 'Y';
    if($asc>=-11055 && $asc<=-10247) return 'Z';
    return '';
}

/**
 * 路由URL
 * @param $type     URL地址
 * @param $id       是否存在id
 * @return string   返回路由规则
 */
function SMLUrl($type, $id) {
    if ($id) {
        return "/$type/{$id}";
    } else {
        return '';
    }
}

/**
 * 删除目录及目录下所有文件或删除指定文件
 * @param str $path   待删除目录路径
 * @param int $delDir 是否删除目录，1或true删除目录，0或false则只删除文件保留目录（包含子目录）
 * @return bool 返回删除状态
 */
function delDirAndFile($path, $delDir = FALSE) {
    $handle = opendir($path);
    if ($handle) {
        while (false !== ( $item = readdir($handle) )) {
            if ($item != "." && $item != "..")
                is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
        }
        closedir($handle);
        if ($delDir)
            return rmdir($path);
    }else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return FALSE;
        }
    }
}
