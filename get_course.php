<?php 

define("LINK", 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=3');

function print_arr($arr) {
	echo '<pre>' . print_r($arr, true) . '</pre>';
}

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




