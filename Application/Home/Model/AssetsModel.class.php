<?php

/**
 * Description of AssetsModel
 * @version 2016-12-6 10:36:43
 * @author 画中浅笑
 */

namespace Home\Model;

class AssetsModel extends \Think\Model {

    public function getAssets($assetStr) {
        if (!$assetStr)return array();
        
        $assetList = M('Assets')->where(" id in (" . $assetStr . ") and IsDel = 0 ")->field('id, domain,savepath,savename')->select();
        $srcArr = array();
        foreach ($assetList as $key => $info) {
            $srcArr[] = array("src" =>$info['domain'] . $info['savepath'] . $info['savename'], "id" => $info['id']);
        }
        return $srcArr;
    }
    
  /**
     * desc   上传图片
     */
    public function uploadImage(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     26145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'assets/'; // 设置附件上传（子）目录
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
