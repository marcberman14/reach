<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor. 16 fields
 */
 
 
 error_reporting(E_ALL);
ini_set('display_errors',1);
 

require_once "Dao.php";

final class EnrolmentDao extends Dao {
    
   	public function getEnrol($value){

        try {
            $temp = $this->db->query("SELECT * 
FROM  enrolment WHERE student_id = :user;", $value);
            //$subject_code, $subject_name, $subject_grade, $subject_description, $subject_category
            return $temp;
        } catch (DBException $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        }
	}
	
		
}



