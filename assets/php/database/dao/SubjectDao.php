<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor. 16 fields
 */
 
 
 error_reporting(E_ALL);
ini_set('display_errors',1);
 

require_once "Dao.php";

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TutorSubjectDao.php";

final class SubjectDao extends Dao {
    
   	public function getSubject($values){

        try {
            $temp = $this->db->row("SELECT * from subjects WHERE subject_id = :subjectid;", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        }
	}
	
	
	public function editSubject($values){

        try {
            $temp = $this->db->query("UPDATE  `reach`.`subjects` SET  `subject_code` = :subject_code,`subject_name` = :subject_name,`subject_grade` = :subject_grade ,`subject_description` = :subject_description, `subject_category` = :subject_category  WHERE  `subjects`.`subject_id` =:subjectid;", $values );
            return $temp;
        } catch (DBException $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        }
	}
	
	
	public function addSubject($values){		

        try {
			$tutsub = new TutorSubjectDao();	
	
            $temp = $this->db->query("INSERT INTO `reach`.`subjects` (`subject_code`, `subject_name`, `subject_grade`, `subject_description`, `subject_category`) VALUES (:subject_code,:subject_name,:subject_grade,:subject_description,:subject_category);",$values);
			
			//$sub = $sublesson->add($values,$subjid);
			
			//$temp = $this->db->query("INSERT INTO `reach`.`subjectlesson` (`subject_id`, `lesson_id`) VALUES (".$selectsub.", ".$lessonid.");");
			
			//$array = array("selectsub" =>$selectsub, "lessonid" => $lessonid);
			
			
			
			
            return $temp;
        } catch (DBException $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        }
	}
	
	public function deleteSubject($values){

        try {
            $temp = $this->db->query("DELETE FROM `subjects` WHERE `subject_id` = :subjectid;", $values );
			//$temp = $this->db->query("DELETE FROM `reach`.`subjectlesson` WHERE `subjectlesson`.`lesson_id` = :lessonid;", $values );
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



