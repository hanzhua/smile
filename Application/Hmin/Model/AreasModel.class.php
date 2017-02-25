<?php

/**
 * Description of AreasModel
 * @version 2017-01-01 10:04:00
 * @author 画中浅笑
 */
namespace Hmin\Model;
use Think\Model;

class AreasModel extends Model{

    public function saveIsShow($id,$isshow){
        $idstr = ''; // 初始化ID字符串
        $AreasId = M('areas')->where("id like '".$id."%'")->field('id')->select();
        foreach ($AreasId as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $idstr .= $value2.',';
            }
        }
        $idstr .= '00';
        if($idstr){
            //UPDATE
            $Model = new Model();
            $data = $Model->execute("UPDATE blog_areas SET isshow = ".$isshow." WHERE id in (".$idstr.")");
            return $data;
        }
        return array('');
    }
}
