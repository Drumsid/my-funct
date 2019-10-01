<?php

// Реализуйте абстракцию (набор функций) для работы с прямоугольниками, стороны которого всегда параллельны осям. 
// Прямоугольник может располагаться в любом месте координатной плоскости.

// При такой постановке, достаточно знать только три параметра для однозначного задания прямоугольника на плоскости: 
// координаты левой-верхней точки, ширину и высоту. Зная их, мы всегда можем построить прямоугольник одним единственным способом.

//       |
//     4 |    точка   ширина
//       |       *-------------
//     3 |       |            |
//       |       |            | высота
//     2 |       |            |
//       |       --------------
//     1 |
//       |
// ------|---------------------------
//     0 |  1   2   3   4   5   6   7
//       |
//       |
//       |
// Основной интерфейс:

// makeRectangle (конструктор) – создает прямоугольник. Принимает параметры: левую-верхнюю точку, ширину и высоту. 
// Ширина и высота – положительные числа.

// Селекторы getStartPoint, getWidth и getHeight

// containsOrigin – проверяет, принадлежит ли центр координат прямоугольнику (не лежит на границе прямоугольника, а находится внутри). 
// Чтобы в этом убедиться, достаточно проверить, что все точки прямоугольника лежат в разных квадрантах (их можно высчитать в момент проверки).


// Создание прямоугольника:
// p - левая верхняя точка
// 4 - ширина
// 5 - высота
//
// p    4
// -----------
// |         |
// |         | 5
// |         |
// -----------


// $p = makeDecartPoint(0, 1);
// $rectangle = makeRectangle($p, 4, 5);

// containsOrigin($rectangle); // false

// $rectangle2 = makeRectangle(makeDecartPoint(-4, 3), 5, 4);
// containsOrigin($rectangle2); // true

//====================================================================================
//====================================================================================
//====================================================================================


//======================my solution ==================================================

//================ assist hexlet function ===================================================

function makeDecartPoint($x, $y)
{
    return [
        'x' => $x,
        'y' => $y
    ];
}

function getX($point)
{
    return $point['x'];
}

function getY($point)
{
    return $point['y'];
}

function getQuadrant($point)
{
    $x = getX($point);
    $y = getY($point);

    if ($x > 0 && $y > 0) {
        return 1;
    } elseif ($x < 0 && $y > 0) {
        return 2;
    } elseif ($x < 0 && $y < 0) {
        return 3;
    } elseif ($x > 0 && $y < 0) {
        return 4;
    }

    return null;
}

//================ assist hexlet function ===================================================

//================ assist my function ===================================================


function setRightUpPoint($point, $valX){
    $point['x'] += $valX;
    return $point;
}

function setRightDownPoint($point, $valY){
    $point['y'] -= $valY;
    return $point;
}

function setLeftDownPoint($point, $valY){
    $point['y'] -= $valY;
    return $point;
}

//================ assist my function ===================================================

$p1 = makeDecartPoint(-4, 3);
// print_r($p1);

$width = 4;
$height = 3;

// make rectangle
function makeRectangle($startPoint, $width, $height){
	$rightUpPoint = setRightUpPoint($startPoint, $width);
	$rightDownPoint = setRightDownPoint($rightUpPoint, $height);
	$leftDownPoint = setLeftDownPoint($startPoint, $height);

	$result = [];
	$result['leftUpPoint'] = $startPoint;
	$result['rightUpPoint'] = $rightUpPoint;
	$result['rightDownPoint'] = $rightDownPoint;
	$result['leftDownPoint'] = $leftDownPoint;
	return $result;
}

// print_r(makeRectangle($p1, $width, $height));

// print_r($p1);

// $rightUpPoint = setRightUpPoint($p1, $width);
// print_r($rightUpPoint);

// $rightDownPoint = setRightDownPoint($rightUpPoint, $height);
// print_r($rightDownPoint);

// $leftDownPoint = setLeftDownPoint($p1, $height);
// print_r($leftDownPoint);

$rect1 = makeRectangle($p1, $width, $height);
print_r($rect1);

// chaeck rectangle on descart space
function containsOrigin($rectangle){
	$leftUpPoint = getQuadrant($rectangle['leftUpPoint']);
	$rightUpPoint = getQuadrant($rectangle['rightUpPoint']);
	$rightDownPoint = getQuadrant($rectangle['rightDownPoint']);
	$leftDownPoint = getQuadrant($rectangle['leftDownPoint']);

	$str = "";
	$str .= $leftUpPoint . $rightUpPoint . $rightDownPoint . $leftDownPoint;

	$arrStr = str_split($str);

	$result = array_reduce($arrStr, function($acc, $item){
		if (!array_key_exists($item, $acc)) {
			$acc[$item] = 1;
		} else {
			$acc[$item] += 1;
		}
		return $acc;
	}, []);

	if (count($result) == 4) {
		return true;
	} else {
		return false;
	}
	
}

echo "<br>";
var_dump(containsOrigin($rect1));

//======================my solution ==================================================