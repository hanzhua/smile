<?php
namespace Hmin\Controller;
use Think\Controller;
use Think\Model;

class IndexController extends Controller {
    /**
     * 获取验证码
     */
    public function getVerify(){
        SMLVerify();
    }

    /**
     * 跳去后台登录页面
     */
    public function index(){
        $this->title = M('action')->where("public='log'")->getField('name');
        $this->display('Login/login');
    }

    /**
     * 跳去后台主页
     */
    public function logindo(){
        $today['user'] = I('post.username');
        $password = SMLMd5(I('post.password'));
        $code     = I('post.code');
        //验证码验证
        if(!SMLCheckVerify($code, $id='')){
            echo json_encode(-2);exit;
        }
        //验证账号密码
        $where = "(tel='{$today['user']}' OR qq='{$today['user']}') AND password='{$password}'";
        $result = M('users')->where($where)->find();

        //停用用户
        if($result['flag']){
            echo json_encode(2);exit;
        }
        //非管理员用户
        if((int)$result['group']==4){
            echo json_encode(-3);exit;
        }

        if (!empty($result)) {
            unset($result['password']);
            session('SML_USER',$result);
            $_SESSION['SML_USER']['gname'] = M('group')->where("id=".(int)$result['group'])->getField('title');
            $_SESSION['SML_USER']['score'] = M('users_sign')->where("id=".(int)$result['id']." AND sign_mon=".(int)date('Ym',time()))->getField('sign_score');

            $today['username'] = $result['contact'];
            //更新本次登录ip
            $data['loginip']   = $today['ip'] = SMLGetIP();
            M('users')->where("id=".(int)$_SESSION['SML_USER']['id'])->setField('ip',$today['ip']);
            //更新最后一次登录时间
            $data['logintime'] = $today['time'] = date('Y-m-d H:i:s', time());
            M('users')->where("id=".(int)$_SESSION['SML_USER']['id'])->setField('lastdate',$today['time'] );
            session('SML_TODAY',$today);

            //添加登录日志
            $data['userid']     = $result['id'];
            M('log_logins')->add($data);

            $this->autoGetMySQLInfo();
            echo json_encode(1);
            //$this->success("登录成功",U('Admin/index'));
        } else {
            //$this->error('账号或密码错误！');
            echo json_encode(-1);
        }
    }

    public function logout(){
        session(null); // 清空当前的session
        session('[destroy]'); // 销毁session
        $this->success("欢迎回来",U('Hmin/Index/index'),3);
    }

    public function reg(){
        $this->title = M('action')->where("public='reg'")->getField('name');
        $this->display();
    }
    public function regdo(){
        $p = I('post.');
        $data = array();
        if(strlen($p['username'])== 11){
            $data['tel'] = $p['username'];
        }else{
            $data['qq'] = $p['username'];
        }
        $data['password']= SMLMd5($p['password']);
        $data['pic']     = "default.jpg";
        $data['createdate'] = date('Y-m-d H:i:s');
        $data['ip']     = SMLGetIP();

        $users = M('users');
        $distinct = $users->where("(tel='{$p['username']}' OR qq='{$p['username']}')")->select();

        // !empty($distinct) 等同于 is_array($distinct) && count($distinct)>0
        if (!empty($distinct)) {
            $this->error('该账号已经被注册');
        } else {
            $res = $users->add($users->create($data));
            if ($res>0) {
                $this->success('注册成功！', U('Index/index'));
            } else {
                $this->error('注册失败！');
            }
        }
    }

    public function autoGetMySQLInfo(){
        $Model          = new Model();
        $version        = $Model->query('select version() as ver');
        $SQL['MySQL_NAME']    = strtoupper(C('DB_TYPE'));
        $SQL['MySQL_VERSION'] = $version[0]['ver'];

        $sql    = "SHOW TABLE STATUS FROM ".C('DB_NAME');
        $prefix = C('DB_PREFIX');
        if($prefix!=null){
            $sql .= " LIKE '{$prefix}%'";
        }
        $row    = $Model->query($sql);
        $size   = 0;
        foreach ($row as $item) {
            $size += (int)$item['data_length'] + (int)$item['index_length'];
        }
        $SQL['MySQL_SIZE'] = round(($size/1048576),2).'M';
        session('SML_MySQL',$SQL);
    }
    
}