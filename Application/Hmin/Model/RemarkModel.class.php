<?php

namespace Hmin\Model;
use Think\Model;

/* * *
 *   Author 画中浅笑
 *   DATE   2016-11-24
 * * */
class RemarkModel extends Model {
//    protected $tableName = 'remark';

    /*     * *
     *   Date   2016-11-24
     *   DESC   管理员列表
     * * */
    public function getIdTitle($where = "1=1", $field = "*", $order = "id asc", $limit = "0"){
        $data = M('remark')->where($where)->field($field)->order($order)->limit($limit)->select();
        if($data){
            foreach ($data as $key => $value){
                //文章标题
                $data[$key]['title'] = M("article")->where("id='{$value['artid']}'")->getField("title");
                //文章类型id
//                $data[$key]['cid'] = M("article")->where("id={$value['artid']}")->getField("title");
                //文章类型name
//                $data[$key]['cname']= M('cate')->where("id={$data[$key]['cid']}")->getField("name");
            }
        }else{
            return array('');
        }
    }
}
