<?php

namespace Hmin\Model;
use Think\Model;
class LogsModel extends BaseModel {
    protected $tableName = 'log_logins';
    /*     * *
     *   Date   2016-11-24
     *   DESC   管理员列表
     * * */
    public function getLogins($where = "1=1", $field = "*", $order = "id desc", $limit = "0"){
        $data = M($this->tableName)->where($where)->field($field)->order($order)->limit($limit)->select();
        if($data){
            foreach ($data as $key => $value) {
                $data[$key]['contact'] = M("users")->where("id=".(int)$value['userid'])->getField("contact");
                $data[$key]['phone'] = M("users")->where("id=".(int)$value['userid'])->getField("tel");
                $data[$key]['qq'] = M("users")->where("id=".(int)$value['userid'])->getField("qq");
            }
            return $data;
        }else{
            return array('');
        }
    }
}