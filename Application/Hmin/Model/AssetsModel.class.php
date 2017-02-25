<?php

/**
 * Description of AssetsModel
 * @version 2016-12-6 10:36:43
 * @author 画中浅笑
 */
namespace Hmin\Model;
class AssetsModel extends \Think\Model {

    public function getAssets($assetStr) {
        if (!$assetStr)return array();
        
        $assetList = M('Assets')->where(" id in (" . $assetStr . ") and isdel = 0 ")->field('id, domain,savepath,savename')->select();
        $srcArr = array();
        foreach ($assetList as $key => $info) {
//            $srcArr[] = array("src" => $info['domain'] . strtolower('/uploads/') . $info['savepath'] . $info['savename'], "id" => $info['id']);
            $srcArr[] = array("src" =>$info['domain'] . $info['savepath'] . $info['savename'], "id" => $info['id']);
        }
        return $srcArr;
    }

    /**
     * 查询图片的有关信息
     */
    public function getImgInformation($id){
        $data = M('assets')->where("id=".(int)$id)->select();
        if($data){
            foreach ($data as $key=>$val) {
                $data[$key]['author'] = M('users')->where("id=".(int)$val['uid'])->getField('contact');
                $data[$key]['title'] = M('article')->where("pic=".(int)$id)->getField('title');
            }
            return $data;
        }
        return array('');
    }

    
  /**
     * desc   上传图片
     */
    public function uploadImage(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     26145728 ;// 设置附件上传大小
        $upload->exts      =     array('gif','jpg','jpeg','bmp','png');// 设置附件上传类型
        $upload->rootPath  =     './Public/'; // 设置附件上传根目录
        $upload->savePath  =    'uploads/';           // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        return $info;
    }

    /**
     * desc   删除图片
     */
    public function delImage(){
        M('Assets')->where(" id = ".I('post.id')." ")->save(array('IsDel'=>1));
    }

}
