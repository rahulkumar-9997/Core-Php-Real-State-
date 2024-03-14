<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of commonfn
 *
 * @author FF Software
 */
class commoncls {
    //put your code here
    public function create($query) {
        include '../../controller/config/dbConnection.php';
        $log = Logger::getLogger('|| 7DW ||');
        $log->info("Common class create function query arg === $query");
        $result = $con->query($query);
        if($result){
            return 1;
        }else{
            return 0;
        }
    }
    
    public function update($query) {
        
    }
    public function delete($query){
        
    }
}
