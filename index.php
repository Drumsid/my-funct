<?php
namespace index;

require_once 'vendor/autoload.php';

use function Funct\Collection\flatten;

// работа функции map

$users = [ //массив для теста
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


function getChildren($arr){
    
  $res = array_map(function($val){
      return $val['children'];
  }, $arr);
  return flatten($res);
}

$q = getChildren($users);

// echo "<pre>"; раскоментить посмотреть результат функции getChildren()
// print_r($q);
// echo "</pre>";


//==================================================================================
//работа функции filter

$usersGirls = [
    ['name' => 'Tirion', 'friends' => [
        ['name' => 'Mira', 'gender' => 'female'],
        ['name' => 'Ramsey', 'gender' => 'male']
    ]],
    ['name' => 'Bronn', 'friends' => []],
    ['name' => 'Sam', 'friends' => [
        ['name' => 'Aria', 'gender' => 'female'],
        ['name' => 'Keit', 'gender' => 'female']
    ]],
    ['name' => 'Rob', 'friends' => [
        ['name' => 'Taywin', 'gender' => 'male']
    ]],
];


function getFrends($arr){ // дублирую функцию из верехнего блока map но для параметра 'friends'
    
  $res = array_map(function($val){
      return $val['friends'];
  }, $arr);
  return flatten($res); // пока не совсем понял как эта flatten()  функция работает
}

$frends = getFrends($users);

// echo "<pre>";// раскоментить посмотреть результат функции getFrends()
// print_r($frends);
// echo "</pre>";

$filteredUsers = array_filter($frends, function ($frend) {
    return $frend['gender'] == 'female';
});

// echo "<pre>";// раскоментить посмотреть результат функции array_filter()
// print_r($filteredUsers);
// echo "</pre>";

function getGirlFriends($arr){

	$frends = getFrends($arr); // убираем из массива все лишнее кроме 'friends'

	$filteredUsers = array_filter($frends, function ($frend) { //фильтруем $frends по критерию 'female'
    	return $frend['gender'] == 'female';
	});
	return $filteredUsers;
}

$girlfrends = getGirlFriends($usersGirls);

echo "<pre>";// раскоментить посмотреть результат функции getGirlFriends()
print_r($girlfrends);
echo "</pre>";
