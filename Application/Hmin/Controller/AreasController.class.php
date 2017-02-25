<?php
/**
 * Created by PhpStorm.
 * User: username
 * Date: 2017/1/1
 * Time: 0:13
 */
namespace Hmin\Controller;
use Hmin\Model\AreasModel;
class AreasController extends SmileController{
    public function index(){
        if(I('get.id')){
            $pid = (int)I('get.id');
            $this->areaName = I('get.title');
            $this->Areas = M("Areas")->where("pid=".$pid)->select();
        }
        $this->display();
    }
    public function AreasShow(){
        $id = mb_substr(I('id'),0,2);
        $data = D('Areas')->saveIsShow($id,(int)I('isshow'));
        if($data){
            $this->ajaxReturn(1);
        }else{
            $this->ajaxReturn(-1);
        }
    }
    public function AreasAdd(){
        if(IS_POST){
            $data['areaName'] = I('areaName');
            $data['isShow']   = I('isShow');
            $data['areaSort'] = I('sreaSort');
            $data['areaKey']  = I('areaKey');
            if(M("areas")->add($data)){
                $this->ajaxReturn(1);
            }else{
                $this->ajaxReturn(-1);
            }
        }
        if((int)I('get.id')!==0){
            $this->data = M('areas')->where("id=".(int)I('get.id'))->find();
        }
        $this->display('Add');
    }
    public function AreasEdit(){
        if(IS_POST){
            if(M('areas')->where("id=".(int)I('post.id'))->save(I('post.'))){
                $this->ajaxReturn(1);
            }else{
                $this->ajaxReturn(-1);
            }
        }
        $this->data = M('areas')->where("id=".(int)I('get.id'))->find();
        $this->display('Edit');
    }
    public function AreasDel(){
        if(M("areas")->where("id=".(int)I('post.id'))->delete()){
            echo json_encode(1);
        }else{
            echo json_encode(2);
        }
    }
}