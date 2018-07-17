<?php
header('Content-Type: text/html; charset=utf-8');
require_once '../db/DB.php';


DB::connect();

if (empty($start_date = $_POST['start_date'])) {
    $start_date = '0000-00-00';
}

if (empty($end_date = $_POST['end_date'])) {
    $end_date = '2050-01-01';
}


$trips = DB::getTrips($start_date, $end_date);
?>

<table class="table table-striped table-bordered">
    <tr>
        <th>№</th>
        <th>Курьер</th>
        <th>Регион</th>
        <th>Дата Выезда из Москвы</th>
        <th>Дата возвращения</th>        
    </tr>    
    <?php
    foreach ($trips as $key => $trip) {
        ?>
        <tr>
            <td><?= $key + 1 ?></td>
            <td><?= $trip->fio ?></td>
            <td><?= $trip->title ?></td>
            <td><?= $trip->start_date ?></td>
            <td><?= $trip->return_date ?></td>
        </tr>
        <?php
    }
    ?>
</table>