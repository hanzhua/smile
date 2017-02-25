<?php
/**
 * Created by PhpStorm.
 * User: username
 * Date: 2017/1/19
 * Time: 17:51
 */
namespace Hmin\Model;
use Think\Model\ViewModel;
class UsersViewModel extends ViewModel{
    public $viewFields = array(
        'Users' => array('*','_type'=>'LEFT'),
        'Group' => array('title','_on'=>'Users.group=Group.id'),
    );
}