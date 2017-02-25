<?php
namespace Home\Controller;

class IndexController extends SmileController {

    //前台搜索
    public function Search(){
        $search = I('post.search');
        if($search=='后台登录'||$search=='进入后台'){
            header('Location:'.__WEBROOT__.'indin.php');exit;
        }
        $where = "title like '%{$search}%'";
        $this->content = D('article')->getSearch($where);
        $this->display();
    }
    //进入会员中心
    public function uservip(){
        $this->vip = M('users')->where("id=".$this->MyId)->find();
        $this->display();
    }
    public function vipEdit(){
        if(IS_POST){
            if($this->MyId){
                //print_r($this->MyId);
                //print_r(I('post.'));exit();
                $data['contact']        = I('post.contact');
                if(!empty(I('post.password'))){
                    $data['password']   = SMLMd6(I('post.password'));
                }
                $data['id']             = $this->MyId;
                if(M('users')->save($data)){
                    $_SESSION['user']['contact']  = $data['contact'];
                    $this->ajaxReturn(1);
                }else{
                    $this->ajaxReturn(-1);
                }
            }
        }
    }
    //前台登录
    public function logdo(){
        $Login = D('UsersView');
        if(IS_POST){
            $user = I('username');
            $pass = SMLMd6(I('password'));              // flag 0;正常 1；禁用
            $where = "(tel='{$user}' OR qq='{$user}') AND password='{$pass}' AND flag=0";
            $res = M('users')->where($where)->find();
            if($res['flag']){
                $this->ajaxReturn(-2);//error("该用户已锁定，请找管理员...");
                exit();
            }
            if($res>0){
                unset($res['password']);
                session('user',$res);
                $data['logintime']   = $lastdate = date('Y-m-d H:i:s',time());
                $_SESSION['user']['lastdate'] = $lastdate;
                M('users')->save(array('id'=>$res['id'],'lastdate'=>$lastdate));

                //记录登录日志
                $data['loginip']     = SMLGetIP();
                $data['userid']      = $res['id'];
                if(M('log_logins')->add($data)){
                    $this->ajaxReturn(1);
                }else{
                    $this->ajaxReturn(-1);
                }
            }else{
                $this->ajaxReturn(-1);
            }
        }
    }
    //前台注册
    public function regdo(){
        if(IS_POST){
            $ip=  get_client_ip();//获取用户的ip地址  0.0.0.0
            $addr = SMLIPAddr($ip);
            $p = I('post.');
            
////========昨天结束 -- 今天开始============
            $startday = date('Y-m-d 23:59:59', time() - 24 * 60 * 60);
            $start_time = strtotime($startday) + 1; //2016-11-30 00:00:00
////========今天结束 -- 明天开始============
            $nightime = date('Y-m-d 23:59:59',time());
            $night_time = strtotime($nightime); //2016-11-30 23:59:59
////========现在时间 -- 签到时间
            $today   = date('Y-m-d',time());
            $nowtime = date('Y-m-d H:i:s', time());
            $now_time=strtotime($nowtime);
////========================================
            
            //同一个ip地址, 卟能连续注册
            $cretime = M('users')->where("ip='{$ip}'")->order("id desc")->find();
//            $cretime = M('users')->where("ip='{$ip}'and createdate='%{today}%' ")->field('createdate')->select();
//            var_dump($cretime['createdate']);exit;
            $cre_time=  strtotime($cretime['createdate']);
            if($cre_time<$night_time && $cre_time >$start_time){
                $this->ajaxReturn(-3);//"你今天已经注册过了,请明天再来！");
                exit();
            }

            $data['city']=$addr;
            if(strlen(intval($p['username']))== 11){
                $data['tel'] = $p['username'];
            }else{
                $data['qq'] = $p['username'];
            }
            $data['password']= SMLMd6($p['password']);
            $data['pic']    = "./Uploads/assets/default.jpg";
            $data['createdate'] = date('Y-m-d H:i:s');
            $data['ip']     = $ip;
            $data['contact']= $p['contact'];
            
            $users = M('users');
            $distinct = $users->where("(tel='{$p['username']}' OR qq='{$p['username']}')")->select();

            // !empty($distinct) 等同于 is_array($distinct) && count($distinct)>0
            if (!empty($distinct)) {
                $this->ajaxReturn(-2);//账号已存在
                exit();
            } else {
                $res = $users->add($users->create($data));
                if ($res>0) {
                    //$this->success('注册成功！', U('Index/index'));
                    $this->ajaxReturn(1);
                } else {
                    //$this->error('注册失败！');
                    $this->ajaxReturn(-1);
                }
            }
        }
    }
    //轮播图  文章分页
    public function index(){
        //获取文章
        $where = 'isdel=0';
        $count = D('Article')->where($where)->count(); //分页
        $Page = new \Think\Page($count, 8);
        $this->page = $Page->show();// 分页显示输出
        $this->article = D("Article")->getArticleList($where, "*", "istop desc", $Page->firstRow . ',' . $Page->listRows);
        
        $this->display();
    }
    //退出登录
    public function logout(){
        session('user',null);$_SESSION[]=array('');
        session_destroy();
        $this->success("只有登录才会有更多权限哦^0^!!!",U('Home/Index/index'),3);
    }
}