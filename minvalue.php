<?php

namespace minvalue;

require_once 'vendor/autoload.php';

// use function Funct\Collection\minValue;
use Funct\Collection;


$users = [
    ['name' => 'Tirion', 'friends' => [
        ['name' => 'Mira', 'gender' => 'female']
    ]],
    ['name' => 'Sam', 'friends' => [
        ['name' => 'Aria', 'gender' => 'female'],
        ['name' => 'Keit', 'gender' => 'female'],
        ['name' => 'Tanisha', 'gender' => 'female']
    ]],
    ['name' => 'Bronn', 'friends' => [
        ['name' => 'Taywin', 'gender' => 'male']
    ]],
    ['name' => 'Rob', 'friends' => [
        ['name' => 'Taywin', 'gender' => 'male'],
        ['name' => 'Keit', 'gender' => 'female'],
        ['name' => 'Ramsey', 'gender' => 'male']
    ]],
];

function getManWithLeastFriends(array $arr){
	if (empty($arr)) {
		return null;
	}

	$res = Collection\minValue($arr, function($user){
		return count($user['friends']);
	});

	return $res;

}



// var_dump(getManWithLeastFriends($users));

// var_dump(empty([]));