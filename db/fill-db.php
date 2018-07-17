<?php

require_once 'DB.php';


if ($_GET['pass'] != 'grD2bE') {
    echo 'Неправильный ключ';
    exit();
}

DB::connect();

$start_date = '2015-06-01';



while ($start_date < Date("Y-m-d")) {
    $start_date_arr = explode("-", $start_date);

    $start_date = date("Y-m-d", mktime(0, 0, 0, $start_date_arr[1], $start_date_arr[2] + rand(1, 10), $start_date_arr[0]));
    $region_id = rand(1, 10);
    $courier_id = rand(1, 10);
    $end_date = DB::calculateEndDate($region_id, $start_date);
    if (DB::createTrip($courier_id, $region_id, $start_date, $end_date)) {
        echo '<br>Запись создана:';
        $trip = DB::getTrip($courier_id, $region_id, $start_date, $end_date);
        echo "<br>ФИО: " . $trip->fio;
        echo "<br>Город: " . $trip->title;
        echo "<br>Дата выезда: " . $trip->start_date;
        echo "<br>Дата возвращения: " . $trip->return_date;
    } else {
        echo '<br>Не удалось создать запись';
    }
}