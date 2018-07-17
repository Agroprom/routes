<?php
header('Content-Type: text/html; charset=utf-8');
require_once '../db/DB.php';


DB::connect();
$trip_date = $_POST['start_date'];
$couriers = DB::getAvalCouriersForDate($trip_date);
echo $trip_date;
foreach ($couriers as $courier) {
    ?>    
    <option value="<?= $courier->id ?>"><?= $courier->fio ?></option>
    <?php
}
?>
