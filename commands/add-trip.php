<?php

header('Content-Type: text/html; charset=utf-8');
require_once '../db/DB.php';


DB::connect();


$courier_id = abs(intval($_POST['courier_id']));
$region_id = abs(intval($_POST['region_id']));
$start_date = $_POST['start_date'];



if (empty($courier_id) || empty($region_id) || empty($start_date)) {
    echo 'Не все данные введены';
    exit();
}

$end_date = DB::calculateEndDate($region_id, $start_date);

if (DB::createTrip($courier_id, $region_id, $start_date, $end_date)) {
    echo 'Запись добавлена';
} else {
    echo 'В указанную дату курьер уже занят';
}
