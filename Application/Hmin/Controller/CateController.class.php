<?php
namespace Hmin\Controller;
use Hmin\Model\CateModel;
class CateController extends SmileController {
    //列表
    public function cate(){
        $this->cate = SMLmenuTree($this->Cate);
        $this->display();
    }
    //添加、修改
    public function catede(){
        if(IS_POST){
            if(I('post.id')){    //dump('Update');
                dump(I('get.'));
//                dump(I('post.'));exit;
                $data['pid']     = I('post.pid');
                $data['name']    = I('post.name');
                $res = M('cate')->where("id=".(int)I('post.id'))->save($data);
                if($res){
                    echo json_encode(1);exit;
                }else{
                    $this->ajaxReturn(2);//修改失败
                }
            }else{         //dump('Add');
                $data['name'] = I('post.name');
                $data['url']  = I('post.url');
                if(empty(I('post.pid'))){
                    $data['pid']    = 0;
                }else{
                    $data['pid']    = I('post.pid');
                }
//                dump($data);exit;
                if(M("cate")->add($data)){
                    $this->success('添加成功!');
                }else{
                    $this->error('添加失败！！！');//添加失败
                    exit;
                }
            }
        }
//        dump(I('get.'));
//        dump(I('post.'));exit;
        $this->id  = (int)I('id');
            $this->pid = M("cate")->where("id=".$this->id)->getField('pid');
            //父类名称
            $this->pname= M("cate")->where("isdel=0 AND id=".(int)$this->pid)->getField("name");

        $this->type = (int)I('type');//1-Add; 2-Update;
        if ($this->type) {
            $this->data = M("cate")->where("id =".(int)$this->id." AND isdel= 0")->find();
        }
        $this->display();
    }

    public function EditName(){
        if(I('id',0)>0){
            $json = D('Hmin/Cate')->editName();
        }
        echo json_encode($json);
    }

    //删除
    public function catedel(){
        if(IS_POST){
            $id = I('id');
            $where = "pid ={$id}";
            $pid = M("cate")->where($where)->count();
            if($pid > 0){
                $this->ajaxReturn(0);     // 0 无法删除 存在子菜单返回
            }else{
                $res = M("cate")->where("id = {$id}")->delete();
                if($res > 0){
                    $this->ajaxReturn(1); // 1 删除成功
                }else{
                    $this->ajaxReturn(2); // 2 删除失败
                }
            }
        }
    }
   
}