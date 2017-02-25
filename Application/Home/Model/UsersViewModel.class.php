<?php
/**
 * Created by PhpStorm.
 * User: username
 * Date: 2017/1/19
 * Time: 10:56
 */
namespace Home\Model;
use Think\Model\ViewModel;
class UsersViewModel extends ViewModel{
    public $viewFields = array(
        'Log_logins'=>array('id','userid','logintime','loginip','loginsrc','_type'=>'LEFT'),
        'Users'=>array('contact','_on'=>'Log_logins.userid=Users.id'),
    );
}