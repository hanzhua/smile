<?php

/**
 * Description of SbController
 * @version 2016-12-16 19:23:04
 * @author 画中浅笑
 */

namespace Home\Controller;

class SbController extends SmileController {

    public function index() {
        $where = "isdel = 0 and cid = '" . C('Sb') . "' ";

        $this->list = D("Article")->getArticleList($where);

        $this->type = M("cate")->where("id = '" . C('Sb') . "'")->getField("name");

        $this->display(Template . '/Sb/index');
    }

}
