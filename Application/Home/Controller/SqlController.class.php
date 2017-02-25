<?php

namespace Home\Controller;

/**
 * Description of SqlController
 * @version 2016-12-16 19:20:22
 * @author 画中浅笑
 */
class SqlController extends SmileController {

    public function index() {
        $where = "isdel = 0 and cid = '" . C('Sql') . "' ";
        $this->list = D("Article")->getArticleList($where);

        $this->type = M("cate")->where("id = '" . C('Sql') . "'")->getField("name");
        $this->display(Template . '/Sql/index');
    }

}
