<?php
namespace index;

require_once 'vendor/autoload.php';

use function Funct\Collection\flatten;


$users = [
    ['name' => 'Tirion', 'children' => [
        ['name' => 'Mira', 'birdhday' => '1983-03-23']
    ]],
    ['name' => 'Bronn', 'children' => []],
    ['name' => 'Sam', 'children' => [
        ['name' => 'Aria', 'birdhday' => '2012-11-03'],
        ['name' => 'Keit', 'birdhday' => '1933-05-14']
    ]],
    ['name' => 'Rob', 'children' => [
        ['name' => 'Tisha', 'birdhday' => '2012-11-03']
    ]],
];


$a = 'HgYgjTIUjgh';

echo "<pre>";
// print_r(flatten($users, 3));
echo "</pre>";

function getChildren($arr){
    
  $res = array_map(function($val){
      return $val['children'];
  }, $arr);
  return flatten($res);
}

$q = getChildren($users);

echo "<pre>";
print_r(flatten($q));
echo "</pre>";