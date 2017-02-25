<?php
namespace Home\Model;
use Think\Model;
/***
*   Date	 2016-01-22
***/
class RemarkModel extends Model{
    protected $tableName = 'remark';
    /***
    *   DESC   文章列表
    ***/
    public function getRemarkList($where = "1=1", $field = "*", $order = "id desc",$limit="0"){
        $data =  M($this->tableName)->where($where)->field($field)->order($order)->limit($limit)->select(); 
        if($data){
            foreach ($data as $key => $value) {
              # code...
               $data[$key]['picurl'] = D("Assets")->getAssets($value['pic']);
               $data[$key]['cname'] = M("cate")->where("id = '{$value['cid']}' ")->getField("name");
            }
            return $data;
        }else{
          return array('');
        }
    }
  /***
  *   DESC   获取分类标签
  ***/
  Public function getCateData(){
     
     $data = M("cate")->where("isdel = 0")->select();
     foreach ($data as $key => $value) {
       # code...
            $data[$key]['artnum'] = M($this->tableName)->where("cid = '{$value['id']}' ")->count();
     }
     return $data;
  }

 
   
}
