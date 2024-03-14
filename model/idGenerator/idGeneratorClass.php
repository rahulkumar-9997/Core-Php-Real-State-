<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of idGeneratorClass
 *
 * @author Mr Jai WD
 */
class idGeneratorClass {
    //put your code here
    public function generateId($column, $table, $idPreFix){
        include '../../controller/config/dbConnection.php';
        $log = Logger::getLogger('|| 7DW ||');
        $selectLastId = "select $column from $table ORDER BY id DESC limit 1";
        $log->info("Query executed as : $selectLastId");
        $result = $con->query($selectLastId);
        while ($row = mysqli_fetch_array($result)) {
            $id = $row["$column"];
        }
        $pad_length = 3;
        $fId = substr($id, 3);
        $log->info("Id fetched : $fId");
        $nId = $fId+1;
        $log->info("New id generated : $nId");
        $id = $idPreFix.str_pad($nId, $pad_length, "0", STR_PAD_LEFT);
        return $id;
    }
    public function siteId($column, $table, $idPreFix){
        include '../../controller/config/dbConnection.php';
        $log = Logger::getLogger('|| 7DW ||');
        $selectLastId = "select $column from $table ORDER BY $column DESC limit 1";
        $log->info("Query executed as : $selectLastId");
        $result = $con->query($selectLastId);
        while ($row = mysqli_fetch_array($result)) {
            $id = $row[$column];
        }
        if(empty($id)){
                $id=0;
            }
        $pad_length = 4;
        $fId = substr($id, 4);
        $log->info("Id fetched : $fId");
        $nId = $fId+1;
        $log->info("New id generated : $nId");
        $id = $idPreFix.str_pad($nId, $pad_length, "0", STR_PAD_LEFT);
        return $id;
    }
}
