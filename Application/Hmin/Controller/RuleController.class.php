<?php

namespace Hmin\Controller;
use Hmin\Model\RuleModel;
use Think\Model;

class RuleController extends SmileController{
    //菜单栏管理
    public function action(){
        $this->actionList = SMLmenuTree(M('action')->where("isdel=0 AND public='0'")->order("id asc")->select());
        $this->display();
    }

    public function actionAdd(){
        if(IS_POST){
            $data = I('post.data');
            if((int)$data['pid']){
                $Inid = M('action')->where("id=" . (int)$data['pid'])->getField("Inid");
                $Inid += 1;
                $data['id']  = (int)($data['pid'] * 100 + $Inid);
                $data['sort']= $data['id'];
            }else{
                $MaxId = M('action')->where("pid=0 AND Inid!=0")->field('MAX(id)')->select();
                /**
                 * 等价于
                 * $Model = new Model();
                 * $MaxId  = $Model->query("SELECT MAX(id) FROM blog_action WHERE pid=0 AND Inid!=0");
                 */
                foreach ($MaxId as $key => $val) {
                    foreach ($val as $item) {
                        $item;
                    }
                }
                $data['id']  = (int)$item+1;
                $data['sort']= $data['id'];
            }
            if(M('action')->add($data)){
                M('action')->where("id=".$data['pid'])->setInc('Inid',1);
                $this->ajaxReturn(1);
            }else{
                $this->ajaxReturn(-1);
            }
        }
        $this->id = (int)I('get.id');
        if($this->id!==0){
            $this->name = M("action")->where("id=".(int)$this->id)->getField('name');
        }
        $this->display();
    }

    //菜单栏管理--1.添加 2.修改
    public function actionde(){
        if (IS_POST) {
            $data = I('post.data');
            if (M('action')->where("id=" . (int)$data['id'])->save($data)) {
                echo json_encode(1);
                exit;
            } else {
                echo json_encode(-1);
                exit;
            }
        }
        //本级 ID NAME
        $this->id = (int)I('get.id');
        if($this->id!==0){
            $this->name = M("action")->where("id=".$this->id)->getField('name');
        }
        $this->edit = I('get.type');

        //获取父级 ID NAME
        $this->pid = M("action")->where("id = '{$this->id}' and isdel= 0")->getField("pid");
        $this->pname = M("action")->where("id=" . (int)$this->pid)->getField("name");

        if ($this->edit == 'edit') {
            $this->data = M("action")->where("id = '{$this->id}' and isdel= 0")->find();
        }
        $this->mark = I('get.mark');
        if ($this->mark == 2) {
            $this->data = M("action")->where("id = '{$this->id}' and isdel= 0")->find();
            $this->name = M("action")->where("id = '{$this->data['pid']}' and isdel= 0")->getField("name");
        }
        $this->display();
    }

    public function actiondel(){
        if (IS_POST) {
            $id = I('id');
            $count = M("action")->where("pid=".(int)$id)->count();
            if ($count > 0) {
                $this->ajaxReturn(0);     // 0 无法删除 存在子菜单返回
            } else {
                $pid = M('action')->where("id=".(int)$id)->getField('pid');
                M('action')->where("id=".(int)$pid)->setDec('Inid');

                $res = M("action")->where("id = {$id}")->delete();
                if ($res > 0) {
                    $this->ajaxReturn(1); // 1 删除成功
                } else {
                    $this->ajaxReturn(2); // 2 删除失败
                }
            }
        }
    }

    //admin 用户组管理
    public function group(){
        $this->groupList = M('group')->where("isdel=0")->select();
        $this->display();
    }

    public function groupde(){
        if (IS_POST) {
            $data = I('post.');
            $data['ctime'] = date("Y-m-d H:i:s");
            if ($data['id']) {
                if (M('group')->where("id = '{$data['id']}'")->save($data)) {
                    echo json_encode(1);
                    exit;
                } else {
                    echo json_encode(2);
                    exit;
                }
            } else {
                if (M('group')->add($data)) {
                    echo json_encode(1);
                    exit;
                } else {
                    echo json_encode(2);
                    exit;
                }
            }
        }
        $id = I('id', '', intval);
        $this->data = M('group')->where("id = '{$id}'")->find();
        $this->display();
    }

    public function groupdel(){
        $res = M('group')->where("id={$_POST['id']}")->delete();
        if ($res > 0) {
            echo json_encode(1);
            exit;
        } else {
            echo json_encode(2);
            exit;
        }
    }

    //desc  分配权限
    public function grouprule(){
        if (IS_POST) {
            $data = I('post.');
            unset($data['com']['menu'][0]);
            $actionid1 = implode(',', $data['com']['menu']);
            // $array = array_merge($data['data']['menu'],$data['data']['method'],$data['data']['action']);
            $actionid2 = implode(',', $data['data']['menu']);
            $actionid = $actionid1 . ',' . $actionid2;
            if (M("group")->where("id =" . (int)$data['id'])->save(array('rules' => $actionid))) {
                $this->success('分配权限成功! 建议重新登录系统...', U('Rule/group'));exit;
            } else {
                $this->error('分配权限失败!', U('Rule/group'));exit;
            }
        }
        $this->id = (int)I('get.id');
        $actionid = M("group")->where("isdel = 0 and id =".$this->id)->getField("rules");
        $this->actionList = D('Rule')->actionStatus($actionid);
        $this->commonList = M('action')->where("public!='0' AND isdel=0")->select();
        $this->display();
    }

    //管理员设置
    public function user(){
        if (IS_POST) {
            if (!empty(I('user'))) {
                $where = "contact LIKE '%" . I('user') . "%'";
            } else {
                $where = "1=1";
            }
            if (!empty(I('tel'))) {
                $where .= " AND tel LIKE'%" . I('tel') . "%'";
            } else {
                $where .= " AND 1=1";
            }
            if (!empty(I('qq'))) {
                $where .= " AND qq LIKE'%" . I('qq') . "%'";
            } else {
                $where .= " AND 1=1";
            }
            if (!empty(I('stime'))) {
                $where .= " AND ( createdate>='" . I('stime') . "'";
            } else {
                $where .= " AND( 1=1";
            }
            if (!empty(I('etime'))) {
                $where .= " AND createdate<='" . I('etime') . "')";
            } else {
                $where .= " AND 1=1)";
            }
            //dump($where);
            $this->userlist = D('Users')->getUserList($where, "*", "id desc");
            //dump($this->userlist);exit;
            $this->display();
            exit;
        }
        $where = "flag=0 and id >1";
        $count = D('Users')->where($where)->count(); //分页
        $Page = new \Think\Page($count, 15);
        $this->page = $Page->show();// 分页显示输出

        $this->userlist = D('Users')->getUserList($where, "*", "id desc", $Page->firstRow . ',' . $Page->listRows);
        $this->grouplist = M("group")->where("isdel =0 ")->select();

        $this->display();
    }

    //管理员设置--添加修改
    public function userde(){
        if (IS_POST) {
            $data = I("post.");
            $data['createdate'] = date('Y-m-d H:i:s', time());
            if (I("post.id")) {    //Update
                if ($data['password']) {
                    $data['password'] = SMLMd5($data['password']);
                } else {
                    $data['password'] = M("users")->where("id = '{$data['id']}' ")->getField('password');
                }
                if (M('users')->where("id = '{$data['id']}'")->save($data)) {
                    $this->ajaxReturn(1);
                } else {
                    $this->ajaxReturn(2);
                }
            } else {              //Add
                if ($data['password']) {
                    $data['password'] = SMLMd5($data['password']);
                }
                if (M('users')->add($data)) {
                    $this->ajaxReturn(1);
                } else {
                    $this->ajaxReturn(2);
                }
            }
        }
        $id = I('get.id');
        $this->data = M('users')->where("id = '{$id}' ")->find();
        $this->grouplist = M("group")->where("isdel =0 ")->select();
        $this->display();
    }

    //管理员设置--批量删除
    public function userdel(){
        if (IS_POST) {
            $where['id'] = array('in', $_POST['id']);
            $res = M("users")->where($where)->delete();
            if ($res > 0) {
                echo json_encode(1);
                exit;
            } else {
                echo json_encode(2);
                exit;
            }
        }
    }

    //管理员--搜索
    public function usersearch(){
        if (IS_POST) {
            $name = I("post.keys");
            $res = M("users")->where("contact like '%{$name}%'")->select();
            if ($res) {
                $this->ajaxReturn($res);
            }
        }
    }

    //管理员设置--排序
    public function usersorts(){
        $where = "flag=0";
        $count = D('Users')->where($where)->count(); //分页
        $Page = new \Think\Page($count, 15);
        $this->page = $Page->show();// 分页显示输出
        if (I('sort', '', intval) == 1) {
            $this->userlist = D('Users')->getUserList($where, "*", "id asc", $Page->firstRow . ',' . $Page->listRows);
            $this->display('user');
        } else if (I('sort', '', intval) == 2) {
            $this->userlist = D('Users')->getUserList($where, "*", "contact desc", $Page->firstRow . ',' . $Page->listRows);
            $this->display('user');
        } else if (I('sort', '', intval) == 3) {
            $this->userlist = D('Users')->getUserList($where, "*", "createdate desc", $Page->firstRow . ',' . $Page->listRows);
            $this->display('user');
            //echo json_encode(2);exit;
        }
    }
}
