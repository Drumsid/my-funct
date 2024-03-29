<?php

// Реализуйте абстракцию для работы с урлами. Она должна извлекать и менять части адреса. Интерфейс:

// make($url) - Конструктор. Создает урл.
// setScheme($data, $scheme) - Сеттер. Меняет схему.
// getScheme($data) - Селектор (геттер). Извлекает схему.
// setHost($data, $host) - Сеттер. Меняет хост.
// getHost($data) - Геттер. Извлекает хост.
// setPath($data, $path) - Сеттер. Меняет строку запроса.
// getPath($data) - Геттер. Извлекает строку запроса.
// setQueryParam($data, $key, $value) - Сеттер. Устанавливает значение для параметра запроса.
// getQueryParam($data, $paramName, $default = null) - Геттер. Извлекает значение для параметра запроса. Третьим параметром функция принимает значение по умолчанию, которое возвращается тогда, когда в запросе не было такого параметра
// toString($data) - Геттер. Преобразует урл в строковой вид.


// $url = Url\make('https://hexlet.io/community?q=low');

// $url = Url\setScheme($url, 'http');
// Url\toString($url); // 'http://hexlet.io/community?q=low'

// $url = Url\setPath($url, '/404');
// Url\toString($url); // 'http://hexlet.io/404?q=low'

// $url = Url\setQueryParam($url, 'page', 5);
// Url\toString($url); // 'http://hexlet.io/404?q=low&page=5'

// $url = Url\setQueryParam($url, 'q', 'high');
// Url\toString($url); // 'http://hexlet.io/404?q=high&page=5'

// $url = Url\setQueryParam($url, 'q', null);
// Url\toString($url); // 'http://hexlet.io/404?page=5'
// Подсказки
// Парсинг урла - parse_url()
// Парсинг параметров запроса - parse_str()
// Формирование строки запроса - http_build_query()
// Собирать данные в url придется самостоятельно

// ==== my solution =================================================

function make($url)
{
	return $url;
}

function toString($url)
{
	print_r($url);
}

function setScheme ($data, $scheme)
{
	$arrUrl = parse_url($data);

	$arrUrl['scheme'] = $scheme;

	return generateUrlArrToString($arrUrl);
}

function getScheme ($data)
{
	$arrUrl = parse_url($data);

	return $arrUrl['scheme'];
}

function setHost ($data, $host)
{
	$arrUrl = parse_url($data);

	$arrUrl['host'] = $host;

	return generateUrlArrToString($arrUrl);
}

function getHost ($data)
{
	$arrUrl = parse_url($data);

	return $arrUrl['host'];
}

function setPath($data, $path)
{
	$arrUrl = parse_url($data);

	$arrUrl['path'] = $path;

	return generateUrlArrToString($arrUrl);	
}

function getPath ($data)
{
	$arrUrl = parse_url($data);

	return $arrUrl['path'];
}

function generateUrlArrToString($arrUrl){

	$urlStr = "";

	$urlStr = $arrUrl['scheme'] . "://" . $arrUrl['host'] . $arrUrl['path'] . "?" . $arrUrl['query'];

	return $urlStr;
}

function setQueryParam($data, $key, $value)
{
	$arrUrl[$key] = $value; // заносим в пустой массив полученные в функцию аргументы, ключ и значение
	$result = http_build_query($arrUrl); // делаем из полученного выше массива строку в виде гет запроса

	$arrUrlData = parse_url($data); // создаем массив из строки полученой из входящего аргумента $data

	parse_str($arrUrlData['query'], $strQuery); // создаем массив гет запроса из строки $arrUrlData['query'] 

	// if (!array_key_exists($key, $strQuery) && $strQuery[$key] == null) {
	// 	return $data;
	// }
	if (array_key_exists($key, $strQuery) && $strQuery[$key] == null){// проверяем есть ли ключ аргумента $key в созданном массиве запроса и равен ли он null
		unset($strQuery[$key]); // удаляем если null
		$tmp = http_build_query($strQuery); // опять делаем из массива строку в виде гет запроса 
		$arrUrlData['query'] = $tmp; // и заносим эту строку в общий массив сделаный из аргумента $data
	}
	else if(array_key_exists($key, $strQuery)){ // проверяем есть ли ключ аргумента $key в созданном массиве запроса
		$strQuery[$key] = $value;           // если есть заносим в него новое значение
		$tmp = http_build_query($strQuery); // опять делаем из массива строку в виде гет запроса
		$arrUrlData['query'] = $tmp; // и заносим эту строку в общий массив сделаный из аргумента $data
	}
	else if (empty($arrUrlData['query'])) { //если строка пока без гет запроса добавим первый запрос.
		$arrUrlData['query'] = $result;
		
	} 
	else if (!empty($arrUrlData['query']) && $value == null) { // проверка на null
		$arrUrlData['query'] .= $result;
	} 
	else {                                  // если запрос есть, добавим новый в конец строки
		$arrUrlData['query'] .= "&" . $result;
	}
	
	return generateUrlArrToString($arrUrlData);	

}

function getQueryParam($data, $paramName, $default = null){
	$arrUrlData = parse_url($data);
	parse_str($arrUrlData['query'], $strQuery);
	if (!array_key_exists($paramName, $strQuery)) {
		return $default;
	} else {
		return $strQuery[$paramName];
	}

}
// ==== my solution =================================================

//=========================================
$scheme = 'http';
$host = 'test.ru';
$path = '/404';

$queryArr = [
	'page' => 5,
];

$url1 = make('https://hexlet.io/community?q=low');

// print_r(parse_url($url1));
// echo "<br>";

print_r($url1);
echo "<br><br>";

$changeScheme = setScheme($url1, $scheme);
print_r($changeScheme);
echo "<br><br>";

// $getScheme = getScheme($changeScheme);
// print_r($getScheme);
// echo "<br>";

// $setHost = setHost($url1, $host);
// print_r($setHost);
// echo "<br><br>";

// $getHost = getHost($setHost);
// print_r($getHost);
// echo "<br><br>";

$setPath = setPath($changeScheme, $path);
print_r($setPath);
echo "<br><br>";

// $getPath = getPath($setPath);
// print_r($getPath);
// echo "<br><br>";

// print_r(http_build_query($queryArr));
$key = 'page';
$value = 6;

$setQueryParam = setQueryParam($setPath, 'page', 5); // закончил тут
print_r($setQueryParam);
echo "<br><br>";

$setQueryParam2 = setQueryParam($setQueryParam, 'q', 'high'); // закончил тут
print_r($setQueryParam2);
echo "<br><br>";

$setQueryParam3 = setQueryParam($setQueryParam2, 'q', null); // закончил тут
print_r($setQueryParam3);
echo "<br><br>";

$setQueryParam4 = setQueryParam($setQueryParam3, 'q', null); // закончил тут
print_r($setQueryParam4);
echo "<br><br>";
