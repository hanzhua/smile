<?php
/**
 * Created by PhpStorm.
 * User: username
 * Date: 2017/1/11
 * Time: 16:56
 */
function SMLMd6($str,$key='smile'){
    $str = $str.$key;
    return md5($str);
}