<?php
namespace Hmin\Controller;
use Think\Controller;
class SmileController extends Controller {
    public $Uid;
    function __construct(){
        if(!$_SESSION['SML_USER']['id']){
            $this->error('非法操作',U('Hmin/Index/index'));
        }
        parent::__construct();
        $this->Uid = (int)$_SESSION['SML_USER']['id'];
        $this->Gid = (int)$_SESSION['SML_USER']['group'];

        //签到
        if((int)date('d',time()) == (int)M('users_sign')->where("sign_uid=".$this->Uid." AND sign_mon=".(int)date('Ym',time()))->getField('sign_day')){
            $this->Sis = 1;
        };
        //当前功能的ID:$this->Aid
        $actionName = CONTROLLER_NAME.'/'.ACTION_NAME;
        $this->Aid = M('action')->where("url='".$actionName."'")->getField('id');

        //当前自身的权限ID
        $this->Gids = M('group')->where('id='.$this->Gid)->getField('rules');

//        if(strpos($this->Gids,$this->Aid)==false){
//            //$this->error('您没有权限访问该功能!!!',U('../'));
//            $this->display('Public/error');exit;
//        }
        //地区信息
        $this->Areas = M("Areas")->where("pid=0")->select();
        //网站信息
        $this->SETUP = M("setup")->where('id=1')->find();
        //文章类型
        $this->Cate = M("cate")->where("isdel=0")->select();
        //消息提醒  管理员查看
        //if($_SESSION['SML_USER']['group']==1){
            $w = "isread = 0";
            $this->news = M('news')->where($w)->select();
            $this->newsnum = M('news')->where($w)->count();
        //}

    }

    /**
     * 单个上传图片
     */
    public function uploadPic(){
        $config = array(
            'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
            'exts'          =>  array('jpg','png','gif','jpeg'), //允许上传的文件后缀
            'rootPath'      =>  './Uploads/assets', //保存根路径
            'driver'        =>  'LOCAL', // 文件上传驱动
            'subName'       =>  array('date', 'Y-m-d'),
            'savePath'      =>  "/"
        );

//        $dirs = explode(",",C("WST_UPLOAD_DIR"));
//        if(!in_array(I('dir','uploads'), $dirs)){
//            echo '非法文件目录！';
//            return false;
//        }
        $upload = new \Think\Upload($config);
        $rs = $upload->upload($_FILES);
        $Filedata = key($_FILES);
        if(!$rs){
            $this->error($upload->getError());
        }else{
            $images = new \Think\Image();
            $images->open('./Uploads/assets/'.$rs[$Filedata]['savepath'].$rs[$Filedata]['savename']);
            $newsavename = str_replace('.','_thumb.',$rs[$Filedata]['savename']);
            $vv = $images->thumb(I('width',300), I('height',300))->save('./Uploads/assets/'.$rs[$Filedata]['savepath'].$newsavename);
//            if(C('WST_M_IMG_SUFFIX')!=''){
//                $msuffix = C('WST_M_IMG_SUFFIX');
//                $mnewsavename = str_replace('.',$msuffix.'.',$rs[$Filedata]['savename']);
//                $mnewsavename_thmb = str_replace('.',"_thumb".$msuffix.'.',$rs[$Filedata]['savename']);
//                $images->open('./Uploads/assets/'.$rs[$Filedata]['savepath'].$rs[$Filedata]['savename']);
//                $images->thumb(I('width',700), I('height',700))->save('./Uploads/assets/'.$rs[$Filedata]['savepath'].$mnewsavename);
//                $images->thumb(I('width',250), I('height',250))->save('./Uploads/assets/'.$rs[$Filedata]['savepath'].$mnewsavename_thmb);
//            }
            $rs[$Filedata]['savepath'] = "Uploads/assets/".$rs[$Filedata]['savepath'];
            $rs[$Filedata]['savethumbname'] = $newsavename;
            $rs['status'] = 1;
            dump($rs);exit;
            echo json_encode($rs);
        }
    }
    /**
     * 上传文件
     * Enter description here ...
     */
    public function uploadFile(){

    }
    /**
     * 跳转权限操作
     */
    public function checkPrivelege($grant){
        $s = session('WST_STAFF.grant');
        if(IS_AJAX){
            if(empty($s) || !in_array($grant,$s))die("{status:-998}");
        }else{
            if(empty($s) || !in_array($grant,$s)){
                $this->display("/noprivelege");exit();
            }
        }
    }

    /**
     * 产生验证码图片
     */
    public function getVerify(){
        // 导入Image类库
        $Verify = new \Think\Verify();
        $Verify->length   = 4;
        $Verify->entry();
    }
    public function checkVerify(){
        $verify = new \Think\Verify();
        return $verify->check(I('verify'));
    }

    /**
     * 返回结果判断方法
     * @param $result
     */
    function is_Relust($result){
        if ($result == false) {
            $this->error("操作失败！");
        } else {
            $this->success("操作成功！");
        }
    }

}