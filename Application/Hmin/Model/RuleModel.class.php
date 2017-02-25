<?php

/**
 * Description of RuleModel
 * @version 2016-12-5 21:30:26
 * @author 画中浅笑
 */
namespace Hmin\Model;
class RuleModel extends \Think\Model{
    protected $tableName = 'action';
    
    public function actionStatus($data = array()){
    $actionList = SMLmenuTree(M($this->tableName)->where(" IsDel=0 AND public='0'")->order("sort asc")->select());
        foreach ($actionList as $k => $v) {

            //判断是否被选中
            $actionList[$k]['checked'] = in_array($v['id'], explode(",", $data)) ? 'checked' : '';
            foreach ($v['child'] as $ck => $cv) {
                //判断是否被选中
                $actionList[$k]['child'][$ck]['checked'] = in_array($cv['id'], explode(",", $data)) ? 'checked' : '';
                foreach ($cv['child'] as $cck => $ccv) {
                    //判断是否被选中
                    $actionList[$k]['child'][$ck]['child'][$cck]['checked'] = in_array($ccv['id'], explode(",", $data)) ? 'checked' : '';
                }
            }
        }
        return $actionList;
  }
}
