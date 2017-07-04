<?php 

define("LINK", 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=3');

// Ф-я красивого вывода массива
function print_arr($arr) {
	echo '<pre>' . print_r($arr, true) . '</pre>';
}

//Получаем курс 
function get_course($curr = 'USD') {

	$data = file_get_contents(LINK);
	if(!$data) {
		return false;
	}

	$courses = json_decode($data, true);
	$course_curr = false;

	foreach ($courses as $course) {
		if($course['ccy'] == $curr) {
			$course_curr = $course['buy'];
			break;
		}
	}
	return $course_curr;
}

//Получаем переменные
if (isset($_POST['name_val'])) {
	$name_val = $_POST['name_val'];
}
else {
	exit("Не выбрана валюта!"); 
}

if (isset($_POST['count_ua'])) {
	$count_ua = $_POST['count_ua'];
}
else {
	exit("Введите количество грн!"); 
}

//Считаем курс
$course_curr = get_course($name_val);
$result = $count_ua / $course_curr;	

$result = array(
	'kurs'  => $course_curr,
	'result' => $result
);

echo json_encode($result);



