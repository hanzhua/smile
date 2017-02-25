<?php
namespace Home\Controller;
/**
 * Description of CssController
 * @version 2016-12-16 19:20:41
 * @author 画中浅笑
 */
class CssController extends SmileController {

    public function index() {
        $where = "isdel = 0 and cid = '" . C('Css') . "' ";

        $this->list = D("Article")->getArticleList($where);

        $this->type = M("cate")->where("id = '" . C('Css') . "'")->getField("name");

        $this->display(Template . '/Css/index');
    }
    
}
