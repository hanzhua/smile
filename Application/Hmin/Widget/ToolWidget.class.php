<?php
namespace Hmin\Widget;
use Think\Controller;
class ToolWidget extends Controller {
    /**
     * author 画中浅笑
     * desc   上传单重插件
     * date   2016-10-23
     */
    public function multUploadImages($param){
        $this->param = $param;
        $this->display('Tool:BootUploadImages');
    }

    /**
     * author  画中浅笑
     * desc   上传多张图片插件
     * date   2016-10-23
     */
    public function ClassMultUploadImages(){
        $this->display('Tool:multUploadImages');
    }
}