<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/util/Db.class.php";

abstract class Dao {
    protected $db;
    
    public function __construct() {
        // echo "Constructing DB.<br/>";
        $this->db = new DB();
    }
    
    public function __destruct() {
        // echo "Destroying DB.<br/>";
        $this->db = null;
    }
    
    public function setDB($dbname) {
        $this->db->setDB($dbname);
    }
}