<?php
if(!defined('IN_SMILE')) {
	exit('Access Denied');
}
define('CHARSET', 'utf-8');
define('DBCHARSET', 'utf8');
define('TABLEPRE', 'sml_');

$env_items = array
(
	'os' => array(''),
	'php' => array(''),
	'attachmentupload' => array(),
	'gdversion' => array(),
	'diskspace' => array(),
);
$dir_items = array
(
  'install' => array('path' => '/Install'),
  'runtime' => array('path' => '/Application/runtime'),
  'upload' => array('path' => '/Uploads'),
  'conf' => array('path' => '/Application/common/conf')
);
$func_items = array(
  'mysql_connect'=>array(),
  'file_get_contents'=>array(),
  'curl_init'=>array(),
  'mb_strlen'=>array(),
  //'finfo_open'=>array()
);
?>