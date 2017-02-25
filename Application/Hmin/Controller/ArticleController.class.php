<?php

/**
 * Description of AritController
 * @version 2016-12-4 18:15:59
 * @author 画中浅笑
 */
namespace Hmin\Controller;
use Think\Controller;
class ArticleController extends SmileController {
    //文章列表
    public function lst(){
        $d = D('Article');
        if(IS_POST){
            if(!empty(I('cid'))){
                $where = "cid=".(int)I('cid');
            }else{$where = "1=1";}

            if(!empty(I('keyName'))){
                $where .= " AND title LIKE'%".I('keyName')."%'";
            }else{$where .= " AND 1=1";}

            $this->Arti = $d->getArticleList($where, "*", "id desc");
            $this->display();
            exit;
        }else {
            $where = "isdel = 0";
        }
        $count = $d->where($where)->count(); //分页
        $Page = new \Think\Page($count, 15);
        $this->page = $Page->show();// 分页显示输出

        $this->Arti = $d->getArticleList($where, "*", "viewnum desc", $Page->firstRow . ',' . $Page->listRows);
        $this->display();
    }

    //文章评论列表
    public function remark(){
        $data = M('Remark')->where("1=1")->select();
        foreach ($data as $key => $value) {
            //文章题目
            $data[$key]['title'] = M("article")->where("id='{$data[$key]['artid']}'")->getField('title');
            //文章作者
            $data[$key]['user'] = M("users")->where("id='{$data[$key]['author']}'")->getField('contact');
        }
        $this->remark = $data;
        $this->display();
    }
    public function relay(){
        dump(I('post.'));
        dump(I('get.'));
        $this->display('HF');
    }
    ////未读消息 单个查看
    public function read(){
        if($_SESSION['SML_USER']['group']==1){
            $rs['flag'] = 1;
        }else{
            $rs['flag']=-1;
            echo json_encode($rs);exit();
        }
        M('news')->where("id=".(int)I('id'))->setField('isread',(int)I('isread'));
        $data = M('remark')->where("id=".(int)I('id'))->select();
        foreach ($data as $key => $value) {
            //文章题目
            $data[$key]['title'] = M("article")->where("id='{$data[$key]['artid']}'")->getField('title');
            //文章作者
            $data[$key]['user'] = M("users")->where("id='{$data[$key]['author']}'")->getField('contact');
        }
        $this->remark = $data;
        echo json_encode($rs);
    }
    ////未读消息全部忽略
    public function readAll(){
        $where = "isread = 0";
        $data = M('news')->where($where)->select();
        $res = M('news')->setField('isread',1);
        $this->is_Relust($res);
    }

    //回收站列表
    public function recovery(){
        $where = "isdel = 1";
        $d = D('Article');
        $count = $d->where($where)->count(); //分页
        $Page = new \Think\Page($count, 4);
        $this->page = $Page->show();// 分页显示输出
        
        $this->article = $d->getArticleList($where, "*", "id desc", $Page->firstRow . ',' . $Page->listRows); 
        $this->display();
    }
    //增-改
    public function add(){
        $arid = I('id','','intval');
        if($arid){
            $data = D('article')->where("id={$arid}")->find();
            //取出图片
            $Assets = M("assets")->where("id=".$data['pic'])->find();
            $data['pic'] = $Assets['domain'].$Assets['savepath'].$Assets['savename'];
            $this->data = $data;
        }
        $this->display();
    }
    //增 -> 改  保存数据操作
    public function addde(){
        if(IS_POST){
            $data = I('post.');
            $data['uid']= $this->Uid;

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
                    $assets['uid']      = $this->Uid;
                    $assets['savepath'] = $info['savepath'];
                    $assets['savename'] = $info['savename'];
                    $assets['name']     = $info['name'];
                    $assets['createtime']=date('Y-m-d H:i:s');

                    $assetid = M('assets')->add($assets);
                    $data['pic'] = $assetid;
                }
            }
            $data['createtime'] = date("Y-m-d H:i:s");

            if($data['id']){ //Update
                unset($data['createtime']);
                if(M('article')->where("id=".(int)$data['id'])->save($data)){
                    $this->success('文章修改成功!', U('Article/lst'));
                }
            }else{             //Add
                if(M('article')->create($data)){
                    $this->success('文章添加成功!', U('Article/lst'));
                }
            }
        }
    }
    //文章置顶
    public function is_top(){
        $id = I('id');
        $istop = I('istop');
        $result = M('article')->where("id = {$id}")->setField('istop',$istop);
        $this->is_Relust($result);
    }
    public function EditTOP(){
        $art = D('Article');
        foreach ($_POST as $id => $istop) {
            $art->where(array('id'=>$id))->setField('istop',$istop);
        }
        $this->success('排序成功！',U('lst'));
    }

    //文章回收，彻底删除
    public function is_del(){
//        $data = I('post.data');
//        $id = $data['id'];
//        $isdel = $data['isdel'];
        $id = I('id');
        $isdel = I('isdel');
        if($isdel=='del'){
            $result=M("article")->where("id={$id}")->delete();
            $this->is_Relust($result);
        }
        $result = M("article")->where("id = {$id}")->setField('isdel',$isdel);
        $this->is_Relust($result);
    }

    //设置轮播图
    public function doimg(){
        if(IS_POST){
            $id = I("post.id",'0','intval');
            $res = M("Article")->where("id = '{$id}' ")->save(array('indeximg'=>1));
            if($res){
                echo json_encode(1);
            }else{
                echo json_encode(2);
            }
        }
    }
    //取消轮播图
    public function delimg(){
        if(IS_POST){
            $id = I("post.id",0,'intval');
            $res = M("Article")->where("id={$id}")->save(array('indeximg'=>0));
            if($res){
                echo json_encode(1);
            }else{
                echo json_encode(2);
            }
        }
    }
    

}
