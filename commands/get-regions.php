<?php
header('Content-Type: text/html; charset=utf-8');
require_once '../db/DB.php';


DB::connect();
$regions = DB::getTable('regions');

foreach ($regions as $region) {
    ?>    
    <option value="<?= $region->id ?>"><?= $region->title ?></option>
    <?php
}
?>
