<?php

//461. 程序prog2.php的内容如下：
$a = 26;
$b = (int)$a/10; print_r($b); // ①
//$b = intval($a/10); print_r($b); // ②
switch ($b) {
    case 1: echo "[one]";
    case 2: echo "[two]";
    case 3: echo "[three]";
    default: echo "[other integer]";
}exit;//此程序的输出结果是：① default ② 2,3,default

//45
$d = date("Y-m-d h:i:s a");
echo $d;exit; //2017-02-23 03:57:21 pm

//44 （60）
$s = 1; $k=3;
while ($k<6) {
    $s=$s * $k;
    $k++;
}
echo $s ;exit;

//43、打印出第一个字母
$a = 'abcdef';
echo $a[0];echo($a{0});echo substr($a,0,1);exit;

//42、请将41题的数组的值用','号分隔并合并成字串输出(1分)
$arr = array('james', 'tom', 'symfony');
for($i=0;$i<count($arr);$i++){
    $arrexp = implode(',',$arr);
}
print_r($arrexp);exit;

//41、请打印出第一个元素的值 (1分)
$arr = array('james', 'tom', 'symfony');
print_r($arr);
echo $arr[0];exit;

//3. 请写一个函数，实现以下功能：字符串“open_door” 转换成 “OpenDoor”、”make_by_id” 转换成 ”MakeById”。
$str = 'make_by_id';
function str_change($str) {
    $str = str_replace ( '_',' ',$str);
    $str = ucwords ($str);
    $str = str_replace (' ', '', $str);
    return $str;
}
var_dump(str_change($str));
exit;

//13.
$s = '12345';
var_dump($s[1]);
$s[$s[1]] = '2';
var_dump($s);exit;//12245

//12.  NULL
class my_class{
    var $my_var;

    function _my_class($value){
        return $this->my_var = $value;
    }
}
$a = new my_class(10);
var_dump($a->my_var);exit;

//10. B
$users[] = 'john'; var_dump('A:');print_r($users);
//array_add($users,'john');var_dump('B:');print_r($users);
array_push($users,'john');var_dump('C:');print_r($users);
$users = 'john';var_dump('D:');print_r($users);
exit;

//8, 什么都没有
$gobal_obj = null;
class my_class{
    public $value;
    function my_class(){
        global $global_obj;
        $global_obj = &$this;
    }
}
$a = new my_class();
$a->my_class();
$global_obj->my_value=10; echo $a->my_value;
exit;

//5. dog
define(value,'10');
$arr[10] = 'dog';
$arr[] = 'human';
$arr["value"] = "cat";
echo "this value is:".$arr[value];
exit;

//4.D
//A $_10 = 10;
//B ${'var'} = 10;
//C &$something = 10;
//D $10_somethings ;
exit;

//1. array(1,2);
$array = array('1','2');
foreach ($array as $k=>$v) {
    $v  = 2;
}
var_dump($array);
exit;

$A = Array ( 
    '0' => '8a3b8725b080d5da0b8fea60f0521a37',
    '1' => '4b8af08e011c961d9e86a11ab12b673f', 
    '2' => '466d4a1803d3b263c3ce8d0cbe808566', 
    '3' => '466d4a1803d3b263c3ce8d0cbe808566', 
    '4' => '466d4a1803d3b263c3ce8d0cbe808566', 
    '5' => '4d733146526755d5dad070e7f941a863',
    '6' => '',
    );

print_r($A);
exit;
$Aid = '13';
$Bid = 2;
$Gids= '1,2,3,12,13,123,23';
$id = array(
        '0' => 1,
        '1' => 2,
        '3' => 3,
        '4' => 13,
    );
var_dump(strpos($Gids,$Aid));
var_dump(strpos($Gids,$Bid));
var_dump(in_array($Aid, $id));
exit;
$MaxId = Array (Array ( 'id' => 6 ) );
foreach ($MaxId as $key => $val) {
    foreach ($val as $item) {
        $item;
    }
}
print_r($item);
$q = 0;
if($q==0){
    print_r(1);
}else{
    print_r(2);
}
exit;
$Arrid = Array(
    Array
    (
        'id' => 110000,
        'name' => '数据11' ,
    ),

    Array
    (
        'id' => 110100,
        'name' => '数据1101'  ,
    ),

    Array
    (
        'id' => 110101,
        'name' => '数据110101'  ,
    ),
);
//print_r($Arrid);
$Aid = array();
foreach ($Arrid as $k => $v) {
    foreach ($v as $vk => $v2) {
        if($vk=='id'){
            $Aid['id'] .= $v2.',';
        }
        if($vk=='name'){
            $Aid['name'] .= $v2.',';
        }
    }
}
print_r($Aid);



exit;

//销毁数组里的个别元素
$Arr = array(
    'id'    => 1001,
    'name'  => '李四',
    'age'   => 18,
    'sex'   => 'GG',
);
print_r($Arr);
foreach ($Arr as $key =>$value) {
    if($key=='sex'){
        // 销毁单个数组元素
        unset ($Arr[$key]);
    }
}
unset($Arr['id']);
print_r($Arr);// name, age
echo('-------------------------');

$Arr2 = array(1,2,8,3,4,6);
echo count($Arr2);
echo('-------------------------');
unset($Arr2[3-1],$Arr2[6-1]);
print_r($Arr2);

