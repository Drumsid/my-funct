<?php

class Point
{
    public $x;
    public $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
}
class Segment
{
	public $beginPoint;
	public $endPoint;

	public function __construct($beginPoint, $endPoint)
	{
		$this->beginPoint = $beginPoint;
		$this->endPoint = $endPoint;
	}
}

$point1 = new Point(1, 10);
$point2 = new Point(11, -3);

$segment = new Segment($point1, $point2);

// print_r($point1);
// echo "<br>";

// print_r($point2);
// echo "<br>";

// print_r($segment);
// echo "<br>";
// Segment Object ( [beginPoint] => Point Object ( [x] => 1 [y] => 10 ) [endPoint] => Point Object ( [x] => 10 [y] => 1 ) ) 
function reverse($segment)
{
	$tmpX1 = $segment->beginPoint->x;
	$tmpY1 = $segment->beginPoint->y;

	$tmpX2 = $segment->endPoint->x;
	$tmpY2 = $segment->endPoint->y;

	$revPoint1 = new Point($tmpX2, $tmpY2);
	$revPoint2 = new Point($tmpX1, $tmpY1);

	$reverse = new Segment($revPoint1, $revPoint2);

	return $reverse;
}

$reversed = reverse($segment);

print_r($reversed);
echo "<br>";
print_r($reversed->beginPoint);
echo "<br>";
print_r($reversed->endPoint);
echo "<br>";


///=============hexlet solution========

// BEGIN
function reverse($segment)
{

    $startP = $segment->beginPoint;
    $finishP = $segment->endPoint;
    $endPoint = new Point($startP->x, $startP->y);
    $beginPoint = new Point($finishP->x, $finishP->y);

    return new Segment($beginPoint, $endPoint);
}
// END