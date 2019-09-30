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

	$filteredFrends = array_filter($frends, function ($frend) { //фильтруем $frends по критерию 'female'
    	return $frend['gender'] == 'female';
	});
	return arrZero($filteredFrends);
}

function arrZero($arr){
	$result = [];
	foreach ($arr as $val){
		$result[] = $val;
	}
	return $result;
}

$girlfrends = getGirlFriends($usersGirls);

// echo "<pre>";// раскоментить посмотреть результат функции getGirlFriends()
// print_r($girlfrends);
// echo "</pre>";


//==========================================================
//работа функции reduce

$usersBirthday = [
    ['name' => 'Bronn', 'gender' => 'male', 'birthday' => '1973-03-23'],
    ['name' => 'Reigar', 'gender' => 'male', 'birthday' => '1973-11-03'],
    ['name' => 'Eiegon',  'gender' => 'male', 'birthday' => '1963-11-03'],
    ['name' => 'Sansa', 'gender' => 'female', 'birthday' => '2012-11-03'],
    ['name' => 'Jon', 'gender' => 'male', 'birthday' => '1980-11-03'],
    ['name' => 'Robb','gender' => 'male', 'birthday' => '1980-05-14'],
    ['name' => 'Tisha', 'gender' => 'female', 'birthday' => '2012-11-03'],
    ['name' => 'Rick', 'gender' => 'male', 'birthday' => '2012-11-03'],
    ['name' => 'Joffrey', 'gender' => 'male', 'birthday' => '1999-11-03'],
    ['name' => 'Edd', 'gender' => 'male', 'birthday' => '1973-11-03']
];

$filterusers = array_filter($users, function($user){
	
	return $user['gender'] == 'male';
});
// echo "<pre>";// раскоментить посмотреть результат функции array_filter()
// print_r($filterusers);
// echo "</pre>";

$sortBirthday = array_reduce($filterusers, function($acc, $user){
	$year = date('Y', strtotime($user['birthday']));
	if (!array_key_exists($year, $acc)) {
		$acc[$year] = 1;
	} else {
		$acc[$year] += 1;
	}
	return $acc;
}, []);

// echo "<pre>";// раскоментить посмотреть результат функции array_reduce()
// print_r($sortBirthday);
// echo "</pre>";

function getMenCountByYear($arr){
//фильтруем $usersBirthday чтоб остались только 'male'
	$filterusers = array_filter($arr, function($user){ 
		
		return $user['gender'] == 'male';
	});	
// считаем кол-во одинаковых др в отфильрованом $usersBirthday
	$sortBirthday = array_reduce($filterusers, function($acc, $user){ 
		$year = date('Y', strtotime($user['birthday']));
		if (!array_key_exists($year, $acc)) {
			$acc[$year] = 1;
		} else {
			$acc[$year] += 1;
		}
		return $acc;
	}, []);

	return $sortBirthday;
}

// print_r(getMenCountByYear($usersBirthday));