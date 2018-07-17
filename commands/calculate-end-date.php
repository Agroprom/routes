<?php

header('Content-Type: text/html; charset=utf-8');
require_once '../db/DB.php';


DB::connect();
$region_id = abs(intval($_POST['region_id']));
$start_date = $_POST['start_date'];
echo " " . DB::calculateEndDate($region_id, $start_date);

