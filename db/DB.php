<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


        const DB_NAME = "routes";
        const DB_USER = "root";
        const DB_HOST = "localhost";
        const DB_PASS = "";

class DB {

    public static $dbh;

    public static function connect() {

        try {
            self::$dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function showTable($table) {
        foreach (self::$dbh->query("SELECT * from $table") as $row) {
            print_r($row);
        }
    }

    public static function getTable($table) {
        $result_pdo = self::$dbh->query("SELECT * from $table");
        return $result_pdo->FETCHALL(PDO::FETCH_OBJ);
    }

    public static function getTrips($start_date, $end_date) {
        $sql = "SELECT title, fio, start_date, return_date FROM `couriers_regions`INNER join `couriers` on couriers_regions.courier_id=couriers.id INNER Join `regions` on couriers_regions.region_id=regions.id where couriers_regions.start_date BETWEEN \"$start_date\" AND \"$end_date\" order by start_date";
        $result_pdo = self::$dbh->query($sql);
        return $result_pdo->FETCHALL(PDO::FETCH_OBJ);
    }
    
    public static function getTrip($courier_id,$region_id,$start_date,$end_date){
        $sql = "SELECT title, fio, start_date, return_date FROM `couriers_regions`INNER join `couriers` on couriers_regions.courier_id=couriers.id INNER Join `regions` on couriers_regions.region_id=regions.id where couriers_regions.start_date = \"$start_date\" AND couriers_regions.return_date=\"$end_date\" AND couriers_regions.courier_id=$courier_id AND couriers_regions.region_id=$region_id";                                          
        $result_pdo = self::$dbh->query($sql);
        return $result_pdo->FETCH(PDO::FETCH_OBJ);       
        
    }

    public static function createTrip($courier_id, $region_id, $start_date, $end_date) {

        if (self::checkCourierAval($courier_id, $start_date)) {
            $db = self::$dbh->prepare("INSERT INTO `couriers_regions`( `courier_id`, `region_id`, `start_date`, `return_date`) VALUES (:courier_id,:region_id,:start_date,:end_date)");
            $db->bindParam(':courier_id', $courier_id);
            $db->bindParam(':region_id', $region_id);
            $db->bindParam(':start_date', $start_date);
            $db->bindParam(':end_date', $end_date);
            $db->execute();
            return true;
        } else {
            return false;
        }
    }

    public static function calculateEndDate($region_id, $start_date) {
        $region_pdo = self::$dbh->query("SELECT * from `regions` where id=$region_id");
        $region = $region_pdo->FETCH(PDO::FETCH_OBJ);
        $start_date_arr = explode('-', $start_date);
        $end_date = date("Y-m-d", mktime(0, 0, 0, intval($start_date_arr[1]), intval($start_date_arr[2]) + $region->goto_days + $region->goto_days, intval($start_date_arr[0])));
        return $end_date;
    }

    public static function checkCourierAval($courier_id, $trip_date) {
        //Проверяем что курьер не находится в поездке в дату $trip_date 
        $res = self::$dbh->query("SELECT * from `couriers_regions` where courier_id=$courier_id and start_date<=\"$trip_date\" and return_date>=\"$trip_date\"");
        $result = $res->FETCH(PDO::FETCH_NUM);
        if (empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAvalCouriersForDate($trip_date) {
        //Возвращает список курьеров доступных для поездки в дату $trip_date
        $res = self::$dbh->query("SELECT couriers.id as id, couriers.fio as fio FROM `couriers` WHERE id NOT IN (SELECT couriers_regions.courier_id from couriers_regions WHERE couriers_regions.start_date<=\"$trip_date\" AND couriers_regions.return_date>=\"$trip_date\") ORDER BY `couriers`.`fio` ASC  ");
        return $res->FETCHALL(PDO::FETCH_OBJ);
    }

}
