<?php

namespace Hmin\Model;
use Think\Model;

/* * *
 *   Author 画中浅笑
 *   DATE   2016-11-24
 * * */
class UsersModel extends Model {
    protected $tableName = 'users';

    /*     * *
     *   Date   2016-11-24
     *   DESC   管理员列表
     * * */
    public function getUserList($where = "1=1", $field = "*", $order = "id asc", $limit = "0") {
        $data = M($this->tableName)->where($where)->field($field)->order($order)->limit($limit)->select();
        if ($data) {
            foreach ($data as $key => $value) {
                $data[$key]['groupname'] = M("group")->where("id = '{$value['group']}' ")->getField("title");
            }
            return $data;
        } else {
            return array('');
        }
    }

    /**
     * 积分表
     */
    public function getSignScore($where='1=1',$field='*',$order='id asc',$limit='0'){
        $data = M('users_sign')->where($where)->field($field)->order($order)->limit($limit)->select();
        if($data){
            foreach ($data as $key => $value) {
                $data[$key]['uname'] = M("users")->where("id = '{$value['sign_uid']}' ")->getField("contact");
            }
            return $data;
        }else{
            return array('');
        }
    }

}
