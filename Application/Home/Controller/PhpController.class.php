<?php
namespace Home\Controller;
/**
 * Description of PhpController
 * @version 2016-12-16 19:21:28
 * @author 画中浅笑
 */
class PhpController extends SmileController{
    
    public function index(){
        $where = "isdel = 0 and cid = '" . C('Php') . "' ";

        $this->list = D("Article")->getArticleList($where);

        $this->type = M("cate")->where("id = '" . C('Php') . "'")->getField("name");

        $this->display(Template . '/Php/index');
    }
}
