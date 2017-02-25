<?php
namespace Hmin\Controller;
use Think\Image;
use Think\Validate;

class AdminController extends SmileController {

    public function picker(){
        if($_FILES['picker']['tmp_name']!=''){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif','bmp', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath  =      './Uploads/assets/'; // 设置附件上传目录
            $upload->rootPath  =      './'; // 设置附件上传目录
            $info   = $upload->uploadOne($_FILES['picker']);
            if(!$info){
                $this->error($upload->getError());
            }else{
                //图片加水印
                $images = new Image();
                $images->open($info['savepath'].$info['savename']);//选择一张照片
                $images->thumb(480,320);//生成缩略图
                //水印标识  SMILEEX
                $images->text('SMILEEX','./ThinkPHP/Library/Think/Verify/ttfs/2.ttf',18,'#e494c3',\Think\Image::IMAGE_WATER_NORTH);
                //保存名称
                $images->save($info['savepath'].$info['savename']);
                //图片表中插入数据
                $assets['domain']   = SMLMain();
                $assets['uid']      = $this->Uid;
                $assets['savepath'] = $info['savepath'];
                $assets['savename'] = $info['savename'];
                $assets['name']     = $info['name'];
                $assets['createtime']=date('Y-m-d H:i:s');
                M('assets')->add($assets);
                $this->display('home');
            }
        }
    }
    public function index3(){
        dump(SMLMain());
        dump(SMLGetMain2());
        dump($_SERVER['HTTP_HOST']);
    }
    public function index2(){
        foreach (range('a', 'i') as $number) {
            echo $number;
        }
        dump(SMLGetIP());                               //127.0.0.1
        dump(get_client_ip(0, $adv=true));              //127.0.0.1
        dump(get_client_ip(1, $adv=true));              //2130706433
        dump(SMLGetOs());                               //Windows 10
        dump(SMLGetBrowser());
        dump(SMLIPAddress());                           //array(0){null}
        dump(get_current_user());                       //获取目前PC登录的username
        dump(gethostbyaddr($_SERVER['REMOTE_ADDR']));   //获取电脑的名称 Computer)

    }

    public function test(){
//        $url='hmin.php';
//        var_dump("http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/".$url);
//        exit;
//        var_dump($_SESSION);exit;//SESSION中获取验证码
        //验证码测试
        $Verify = new \Think\Verify();
        $Verify->fontSize = 30;   //验证码字体大小
        $Verify->length   = 4;    //验证码长度
        $Verify->useNoise = true;//背景杂点
        // 验证码字体使用 ThinkPHP/Library/Think/Verify/ttfs/5.ttf
        $Verify->fontttf = '5.ttf'; 
        // 开启验证码背景图片功能 随机使用 ThinkPHP/Library/Think/Verify/bgs 目录下面的图片
        $Verify->useImgBg = true;
        $Verify->entry();
        var_dump($_SESSION['verify_code']);
        exit;


        $ip = $_SERVER['REMOTE_ADDR'];//::1
//        $ip = getenv('REMOTE_ADDR');//::1
        $ip1 = get_client_ip(0, $adv=true);
        $ip2 = get_client_ip(1, $adv=true);
        $address = GetAddress($ip);
        $browser = GetBrowser();
        $browser2= get_browser(null, true);//array
        $lang = GetLang();
        var_dump($ip,$ip1,$ip2,$address,$browser,$browser2[browser],$lang,$lang2);
    }
    
    public function ipdz(){
        // 实例化类 参数表示IP地址库文件
        $Ip = new \Org\Net\IpLocation('UTFWry.dat');
        $area = $Ip->getlocation('127,0.0.1'); // 获取某个IP地址所在的位置
        var_dump($area);
    }
    
    /** 后台主页
     *  1. 登录次数  2. 上次登录IP地址  3. 上次登录时间
     */
    public function home(){
        //查询上传的图片
        $count = M('assets')->where("isdel=0")->count();
        $Page  = new \Think\Page($count, 12);
        $this->page   = $Page->show();
        $this->IMAGE = M('assets')->order('id desc')->limit($Page->firstRow.",".$Page->listRows)->select();

        $this->display();
    }
    public function homeSee(){
        if(I('get.id')){
            $data = D('Assets')->getImgInformation(I('get.id'));
            $data[0]['type'] = end(explode('.',$data[0]['name']));
            $this->img  = $data;
            $this->display('ImgSee');
        }else{
            $this->error('错误选择!!!');
        }
    }

    public function adminer(){
        $this->display();
    }
    public function adminset(){
        if(IS_POST){
            if(intval(I('post.id'))){
                if(M('setup')->where("id=".(int)I('id'))->save(I('post.'))){
                    $this->success('操作成功!', U('Hmin/home'));
                }else{
                    $this->error('操作失败！');
                }
            }else{
                if(M('setup')->add(I('post.'))){
                    $this->success('操作成功!', U('Hmin/home'));
                }
            }
        }
    }

    /**
     * 跳去后台首页
     */
    public function index(){
        $tabAct = M('action')->where("isdel=0 AND public='0'")->order("sort asc")->select();
        $this->actionList = SMLmenuTree($tabAct);
        $this->title = M('action')->where("public='main'")->getField('name');

        $this->display();
    }

    public function Log(){
        $this->Log = D('Logs')->getLogins();
        $this->display();
    }

    ////友情链接
    public function link(){
        $Fri   = M('frilink');
        $count = $Fri->count();
        $Page  = new \Think\Page($count, 15);
        $this->page   = $Page->show();
        $this->Friend = $Fri->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->display();
    }
    public function linkSort(){
        $link = D('Frilink');
        foreach ($_POST as $id => $sort) {
            $link->where(array('id'=>$id))->setField('sort',$sort);
        }
        $this->success('排序成功！');
    }
    public function linkde(){
        if(IS_POST){
            $data= I('post.');
            $data['ctime'] = date('Y-m-d H:i:s',time());
            if($data['id']){
                unset($data['ctime']);
                if(M('Frilink')->where("id='{$data['id']}'")->save($data)){
                    $this->ajaxReturn(11);
                }else{
                    $this->ajaxReturn(12);
                }
            }else{
                if(M('Frilink')->add($data)){
                    $this->ajaxReturn(1);
                }else{
                    $this->ajaxReturn(2);
                }
            }
        }
        $this->Fri = M('Frilink')->where("id=".(int)I('id'))->find();
        $this->display();
    }
    public function linkIsdel(){
        if(M('Frilink')->where("id=".(int)I('id'))->setField('isdel',(int)I('isdel'))){
            $this->success('操作成功！');
        }else{
            $this->error('操作失败！！！');
        }
    }
    ////友情链接删除
    public function linkdel(){
        if(M('Frilink')->where("id=".(int)I('id'))->delete()){
            $this->ajaxReturn(1);
        }else{
            $this->ajaxReturn(2);
        }
    }
    /**
     * 访客一览
     */
    public function  visit(){
        if(IS_POST){
            if(!empty(I('area'))){
                $where ="address LIKE'%".I('area')."%'";
            }else{$where = "1=1";}
            if(!empty(I('os'))){
                $where .=" AND os_name LIKE'%".I('os')."%'";
            }else{$where .=" AND 1=1";}
            if(!empty(I('stime'))){
               $where .=" AND(create_time>='".I('stime')."'";
            }else{$where .=" AND(1=1";}
            if(!empty(I('etime'))){
                $where .=" AND create_time<='".I('etime')."')";
            }else{$where .=" AND 1=1)";}
            //dump($where);
            $this->Visit = D("visit")->where($where)->select();
            $this->display();exit;
        }
        $this->count = $count = M('visit')->count(); //记录总数
        $Page = new \Think\Page($count, 15);
        $this->page = $Page->show();// 分页显示输出
        $firstRow       = $Page->firstRow;
        $listRows       = $Page->listRows;
        $this->firstRow = $firstRow + 1;
        $this->listRows = $listRows;
        $this->Visit = M('visit')->limit($firstRow.','.$listRows)->select();
        $this->display();
    }

    /**
     * 清除模板缓存
     */
    public function clearCache(){
        $path = "./Application/Runtime/Cache/";
        $this->dirDel($path);
        $this->success("清除模板缓存成功！");
    }
    /**
     * 清除数据缓存
     */
    public function clearData(){
        $path = "./Application/Runtime/Data/";
        $this->dirDel($path);
        $this->success("清除数据缓存成功！");
    }
    /**
     * 清除日志缓存
     * @param type $path
     */
    public function clearLogs(){
        $path = "./Application/Runtime/Logs/";
        $this->dirDel($path);
        $this->success("清除日志缓存成功！");
    }
    /**
     * 清除数据目录
     */
    public function clearTemp(){
        $path = "./Application/Runtime/Temp/";
        $this->dirDel($path);
        $this->success("清除数据目录成功!");
    }
    /**
     * 缓存清理调用
     * @param type $path
     */
    public function dirDel($path){
        if(!is_dir($path)){
            $this->error($path."并没有这个文件夹！");
        }
        $hand = opendir($path);
        while(($file = readdir($hand))!==false){
            if($file=="."||$file=="..")  continue;
            if(is_dir($path."/".$file)){
                $this->dirDel($path."/".$file);
            }else{
                @unlink($path."/".$file);
            }
        }
        closedir($hand);
        @rmdir($path);
    }
    
}