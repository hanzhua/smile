<?php

namespace Home\Controller;

use Think\Controller;

/**
 * Description of SmileController
 * @version 2016-12-16 19:24:01
 * @author 画中浅笑
 */
class SmileController extends Controller {
    public $MyId;
    public $domain;
//    protected $CAPTCHA_ID = "c6a8f518771d8ea164fd92890d5685b7";
//    protected $PRIVATE_KEY = "5eff47a446c7f4958cef79f9e16b16c7";
    function __construct() {
        parent::__construct();
        $this->MyId = (int)session('user')['id'];
        if (SMLGetMain2() == 'admin') {
            $url = 'http://' . $_SERVER['HTTP_HOST'] . __ROOT__ . '/indin.php';
            header("Location:$url");
            exit;
        }
        /**
         * common 公用信息
         */
        $this->SETUP = M("setup")->where("id=1")->cache(0)->find();

        //轮播图
        $img = 'isdel = 0 and indeximg = 1';
        $this->PICKER = D('Article')->getArticleList($img,"id,title,pic,indeximg",'sort asc');

        //获取分类
        $this->cate = SMLmenuTree(D("Article")->getCateData());
        
        //最新发表的文章
        $where = "isdel=0";
        $this->News = D('Article')->getArticleList($where,'id,title,pic,viewnum,createtime','createtime desc',3);
        
        //猜你喜欢  随机4条数据 热度不小于100℃
        $randwhere = "isdel = 0 AND viewnum > 100 ";
      	$this->Cnxh = D("Article")->getArticleList($randwhere,'','rand()',4);
        
        //友情链接
        $this->link = M("frilink")->order("sort asc")->cache(846000)->select();

        $this->ac_name = CONTROLLER_NAME;
        $this->acname = D("cate")->where("url like '%{$this->ac_name}%' ")->cache(864000)->field("name")->find(); //getCateData();
    }
    
    function is_Result($result){
        if($result ==false ){
            $this->error("操作失败");
        }else{
            $this->success('操作成功');
        }
    }

    /**
     * 文件上传
     */
    public function Uploads(){
        if($_FILES['pic']['tmp_name']!=''){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif','bmp', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath  =      './Uploads/assets/'; // 设置附件上传目录
            $upload->rootPath  =      './'; // 设置附件上传目录
            $info   = $upload->uploadOne($_FILES['pic']);
            if(!$info){
                $this->error($upload->getError());
            }else{
                //图片加水印
                $images = new \Think\Image();
                //$images->open($info['savepath'].$info['savename'])->text('SMILEEX','./ThinkPHP/Library/Think/Verify/ttfs/2.ttf',24,'#FF0000',\Think\Image::IMAGE_WATER_NORTH)->save($info['savepath'].$info['savename']);
                $images->open($info['savepath'].$info['savename'])->water('./Public/logo.png')->save($info['savepath'].$info['savename']);
                //图片表中插入数据
                $assets['domain']   = SMLMain();
                $assets['uid']      = $this->MyId;
                $assets['savepath'] = $info['savepath'];
                $assets['savename'] = $info['savename'];
                $assets['name']     = $info['name'];
                $assets['createtime']=date('Y-m-d H:i:s');
                $assetid = M('assets')->add($assets);//return @int id
                $data['pic']     = $info['savepath'].$info['savename'];
            }
        }
        $data['id']      = $this->MyId;
        if($assetid){
            if(M('users')->save($data)){
                $_SESSION['user']['pic']    = $data['pic'];
                $this->success('上传成功!');
            }
        }else{
            $this->error('上传失败!');
        }
    }
}
