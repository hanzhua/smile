<?php
namespace Home\Controller;
/**
 * Description of H5Controller
 * @version 2016-12-16 19:22:14
 * @author 画中浅笑
 */
class H5Controller extends SmileController {

    public function index() {
        $where = "isdel = 0 and cid = '" . C('H5') . "' ";

        $this->list = D("Article")->getArticleList($where);

        $this->type = M("cate")->where("id = '" . C('H5') . "'")->getField("name");

        $this->display(Template . '/H5/index');
    }
}