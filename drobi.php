<?php

// Реализуйте абстракцию для работы с рациональными числами включающую в себя следующие функции:

// Конструктор makeRational() - принимает на вход числитель и знаменатель, возвращает дробь. +
// Селектор getNumer() - возвращает числитель +
// Селектор getDenom() - возвращает знаменатель +
// Сложение add() - складывает переданные дроби 
// Вычитание sub() - находит разность между двумя дробями
// Не забудьте реализовать нормализацию дробей удобным для вас способом


// $rat1 = makeRational(3, 9);
// getNumer($rat1); // => 1
// getDenom($rat1); // => 3

// $rat2 = makeRational(10, 3);

// $rat3 = add($rat1, $rat2);
// RatToString($rat3); // => 11/3

// $rat4 = sub($rat1, $rat2);
// RatToString($rat4); // => -3/1

// Подсказки
// Функция gcd() находит наибольший общий делитель двух чисел
// Функция RatToString() возвращает строковое представление числа (используется для отладки)

//=========================================================================================
//=========================================================================================
//=========================================================================================


//======================hexlet assist function =============================================
function makeRational($numer, $denom)
{
	if (gcd($numer, $denom) >= 2)
	{
		$delnumer = $numer / gcd($numer, $denom);
		$deldenom = $denom / gcd($numer, $denom);
		return "{$delnumer}/{$deldenom}";
	}
    return "{$numer}/{$denom}";
}

function getNumer($rational)
{
    return explode('/', $rational)[0];
}

function getDenom($rational)
{
    return explode('/', $rational)[1];
}

function gcd($a, $b)
{
    return ($a % $b) ? gcd($b, $a % $b) : abs($b);
}

function ratToString($rat)
{
    return getNumer($rat) . '/' . getDenom($rat);
}


//======================hexlet assist function =============================================

//=======================my assist function ===============================================

// find наименьшее общее кратное
function nok($num1, $num2){

    $result=1;
    while (($result%$num1)!=0 or ($result%$num2)!=0) {
        $result++;
    }
    return $result;

}

//=======================my assist function ===============================================

//====================================my solution ======================================

function add($firstRat, $secondRat)
{
	if (getDenom($firstRat) == getDenom($secondRat)) {
		$sumNumber = (getNumer($firstRat) + getNumer($secondRat));
		$sumdenom = getDenom($firstRat);
		return "{$sumNumber}/{$sumdenom}";
	} 

	$firstDenom = getDenom($firstRat);
	$secondDenom = getDenom($secondRat);
	$totalDenom = nok($firstDenom, $secondDenom);

	$sumNumber = (getNumer($firstRat) * ($totalDenom / getDenom($firstRat))) + (getNumer($secondRat) * ($totalDenom / getDenom($secondRat)));
	return makeRational($sumNumber, $totalDenom);
}


function sub($firstRat, $secondRat)
{
	$firstDenom = getDenom($firstRat);
	$secondDenom = getDenom($secondRat);
	$totalDenom = nok($firstDenom, $secondDenom);

	$subNumber = (getNumer($firstRat) * ($totalDenom / getDenom($firstRat))) - (getNumer($secondRat) * ($totalDenom / getDenom($secondRat)));

	return makeRational($subNumber, $totalDenom);
}

// $gcd = gcd(10, 3);
// print_r($gcd);

// $rat1 = makeRational(3,9);
// print_r($rat1);
// echo "<br>";

// print_r(getNumer($rat1));
// echo "<br>";
// print_r(getDenom($rat1));
// echo "<br>";

// $rat2 = makeRational(10,3);
// print_r($rat2);
// echo "<br>";

// print_r(getNumer($rat2));
// echo "<br>";
// print_r(getDenom($rat2));
// echo "<br>";

// $addRat = add($rat1, $rat2);
// print_r($addRat);
// echo "<br>";

// $subRat = sub($rat1, $rat2);
// print_r($subRat);
// echo "<br>";



