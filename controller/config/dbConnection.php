<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dbConnection
 *
 * @author Mr Jai WD
 */
        $dbHost = 'localhost';
        $dbUser = 'root';
        $dbPass = '';
        $dbName = 'real_state';
        $log = Logger::getLogger('|| 7DW ||');
        $con = new mysqli($dbHost, $dbUser, $dbPass, $dbName); 

    /*  $dbHost = 'localhost';
        $dbUser = 'figmarke_fig';
        $dbPass = 'figmpl@987';
        $dbName = 'figmarke_db';
        $log = Logger::getLogger('|| 7DW ||');
        $con = new mysqli($dbHost, $dbUser, $dbPass, $dbName) or die(); 
     * 
     */