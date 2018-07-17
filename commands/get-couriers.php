<?php
header('Content-Type: text/html; charset=utf-8');
require_once '../db/DB.php';


DB::connect();
$couriers = DB::getTable('couriers');

foreach ($couriers as $courier) {
    ?>    
    <option value="<?= $courier->id ?>"><?= $courier->fio ?></option>
    <?php
}
?>
