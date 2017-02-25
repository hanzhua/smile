<?php
namespace Home\Controller;
/**
 * Description of JavaController
 * @version 2016-12-16 19:21:28
 * @author 画中浅笑
 */
class JavaController extends SmileController{
    
    public function index(){
        $where = "isdel = 0 and cid = '" . C('Java') . "' ";

        $this->list = D("Article")->getArticleList($where);

        $this->type = M("cate")->where("id = '" . C('Java') . "'")->getField("name");

        $this->display(Template . '/Java/index');
    }
}
