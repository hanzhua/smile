<?php
namespace Home\Model;
use Think\Model;
/***
*   Date	 2016-01-22
***/
class ArticleModel extends Model{
    protected $tableName = 'Article';
    
  /***
  *   DESC   文章列表
  ***/
    public function getArticleList($where = "1=1", $field = "*", $order = "id desc",$limit="0"){
        $data =  M($this->tableName)->where($where)->field($field)->order($order)->limit($limit)->select();
        if($data){
            foreach ($data as $key => $value) {
              # code...
               $data[$key]['picurl'] = D("Assets")->getAssets($value['pic']);
               $data[$key]['cname'] = M("cate")->where("id = '{$value['cid']}' ")->getField("name");
               $data[$key]['uname'] = M('users')->where("id='{$data[$key]['uid']}'")->getField("contact");
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
    /**
     *  获取文章的作者
     * @param type $where
     * @param type $field
     * @param type $order
     * @param type $limit
     */
    public function getSearch($where = "1=1", $field = "*", $order = "id desc",$limit="0"){
        $data =  M($this->tableName)->where($where)->field($field)->order($order)->limit($limit)->select(); 
        if($data){
            foreach ($data as $key => $value){
                $data[$key]['picurl'] = D("Assets")->getAssets($value['pic']);
                $data[$key]['uname'] = M('users')->where("id='{$data[$key]['uid']}'")->getField("contact");
            }
            return $data;
        }else{
            return array('');
        }
    }
   
}
