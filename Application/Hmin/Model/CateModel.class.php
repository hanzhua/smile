<?php
/**
 * Created by PhpStorm.
 * User: username
 * Date: 2017/1/5
 * Time: 14:43
 */
namespace Hmin\Model;
class CateModel extends BaseModel{

    /**
     * 修改文章分类名称
     */
    public function EditName(){
        $id = (int)I("id",0);
        $data["name"] = I("name");
        if($this->checkEmpty($data)){
            $rs = $this->where("isdel=0 and id=".$id)->save($data);
            if(false !== $rs){
                $json = 1;
            }
        }
        return $json;
    }
}