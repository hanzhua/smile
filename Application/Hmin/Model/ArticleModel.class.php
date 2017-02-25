<?php

namespace Hmin\Model;
use Think\Model;

class ArticleModel extends Model {
//    protected $tableName = 'users';

    /*     * *
     *   Date   2016-11-24
     *   DESC   管理员列表
     * * */
    public function getArticleList($where = "1=1", $field = "*", $order = "id asc", $limit = "0") {
        $data = M('article')->where($where)->field($field)->order($order)->limit($limit)->select();
        if ($data){
            foreach ($data as $key => $value) {
                $data[$key]['picurl'] = D("Assets")->getAssets($value['pic']);
                $data[$key]['cname'] = M("cate")->where("id = '{$value['cid']}' ")->getField("name");
            }
            return $data;
        } else {
            return array('');
        }
    }
}
