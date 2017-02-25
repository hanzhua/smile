<?php

/**
 * Description of ArticleController
 * @version 2016-12-13 11:04:05
 * @author 画中浅笑
 */
namespace Home\Controller;
class ArticleController extends SmileController {
    //文章查看
    public function index(){
        if(I('id')){
            $id = I('id');
            $where = "id={$id}";
            $this->title = M('article')->where($where)->getField('title');
            //$this->content = D('article')->where($where)->select();
            $this->content = D('article')->getArticleList($where);
            $this->display();
        }else{
            $this->error("数据获取失败！");
        }
    }
    //访问量 操作
    public function viewnum(){
        $id = I('id');
        $this->title = M('article')->where("id={$id}")->getField('title');
        $this->content = D('article')->getArticleList("id={$id}");
        
        $this->mark = SMLmenuTree( M('remark')->where("artid ={$id}")->select());
//        var_dump($this->mark);exit;
        $prefix  = C('DB_PREFIX');
        $this->article =M('article')->field("ar.*,(SELECT count(id) FROM {$prefix}remark WHERE artid={$id}) as re")->table("{$prefix}article as ar")->where("isdel=0 AND id={$id}")->find();
//        var_dump($this->article);exit;
        if($this->article){
            //热度添加
            M('article')->where("id={$id}")->setInc('viewnum',1);
            //文章用户信息获取
            $this->user = D('users')->find($this->article['uid']);
            //类别
            $this->cate = M('cate')->where("id={$this->article['cid']}")->find();
            $this->ctitle   = $this->cate['name'];
            $this->is_active = $this->cate['id'];
            
            //最新
            $this->zuixin = M('article')->where("uid={$this->article['id']} AND isdel=0")->order("id desc")->limit(5)->select();
            //喜欢
            $this->love = M('article')->where("isdel=0")->order("rand()")->limit(5)->select();
            //主题
//            $theme = C('DEFAULT_THEME');
//            $file = "./Application/Home/View/{$theme}/index{$this->article['type']}.html";
//            if(file_exists($file)){
//                $this->display("index{$this->article['type']}");
//            }else{
                $this->display("Article/index");
//            }
        }else{
            $this->error('该文章正在审核中',U('Article/index'));
        }
    }
    //键入文章加密码  查看文章
    public function EnterRecode(){
        $id = I('get.id');
        $password = I('post.code');
        $_SESSION["article_{$id}"] = $password;
        $this->success('输入成功');
    }
    //文章评论提交
    public function remark(){
        $userid = $_SESSION['user']['id'];

        $m =M("remark");
        $data = $m->create();
        $data['artid'] = I("get.id",'',"intval");
        $data['ctime']=date('Y-m-d H:i:s',time());
        if($_SESSION['user']['contact']!=null || $_SESSION['user']['contact']!= ''){
            $data['uid'] = $userid;
        }
        $result = $m->add($data);
        if($result>0){
//            $mm = M("article");
//            if(!$this->email_set['comment_set']){
//                $m = M('email_type');
//                $info= $m->find(1);
//                $article= $mm->find($artid);
//                $info['send_comment_content'] = $info['send_comment_content']."<br/>回复帖子标题：<a href = '".$_SERVER['HTTP_REFERER']."' target = '_blank'>{$article['title']}</a><br/>回复署名：{$_POST['name']}<br/>回复内容：{$_POST['content']}";
//                $this->MySmtp($this->admin_email,$info['send_comment_title'],$info['send_comment_content']);
//            }
            $this->mark = M('remark')->where("id ={$data['artid']}")->select();
            if($_SESSION['user']['email']==''){
                M('users')->where("id={$userid}")->setField('email',I('post.email'));
                $_SESSION['user']['email'] = I('email');
            }
            $this->success("操作成功！");
        }else{
            $this->error("操作失败！");
        }
    }
    //文章评论下的回复操作
    public function replay(){

        $data = array();
        $data['artid']   = I('get.artid');//所在文章{ID} 下的回复
        $data['author']  = I('get.author');//上级ID
        $data['content'] = I('post.content');//回复内容
        if($_SESSION['user']['id']==''||$_SESSION['user']['id']==NULL){
            $this->error('请先登录，在进行回复');
        }
        $data['uid']     = $_SESSION['user']['id']; //回复者ID
        $data['name']    = $_SESSION['user']['contact'];//回复者昵称
        $data['email']   = $_SESSION['user']['email'];//回复者邮箱
        $data['ctime']   = date('Y-m-d H:i:s',  time());//回复时间
        $result= M('remark')->add($data);
        $this->is_Result($result);
    }
}
