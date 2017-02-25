<?php
/**
 * Created by PhpStorm.
 * User: username
 * Date: 2016/12/29
 * Time: 14:24
 */
namespace Home\Model;
use Think\Model;

class CateModel extends Model{

    public function getCatePID($where="1=1",$field="*",$order="id desc",$limit="0"){
        $data =  SMLmenuTree(M("cate")->where($where)->field($field)->order($order)->limit($limit)->select());
        if($data){
            foreach ($data as $key => $value) {
                $data[$key]['artnum'] = M("article")->where("cid = '{$value['id']}' ")->count();
            }
            return $data;
        }else{
            return array();
        }
    }
}