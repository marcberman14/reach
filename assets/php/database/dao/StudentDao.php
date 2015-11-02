<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor. 16 fields
 */
 
 
 error_reporting(E_ALL);
ini_set('display_errors',1);
 

require_once "Dao.php";

final class StudentDao extends Dao {
	
	public function student($value){

        try {
            $temp = $this->db->row("SELECT studentId from student where userId =:user;", $value);
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
	
    
   	public function getStudent($value){

        try {
            $temp = $this->db->query("SELECT * 
FROM  student as s join enrolment as e on e.student_id = s.studentId join test as t on t.subject_id = e.subject_id WHERE e.student_id = :user;", $value);
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



