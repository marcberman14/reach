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
    
   	public function getSubject($id){

        try {
            $temp = $this->db->row("SELECT subject_code, subject_name, subject_grade, subject_description, subject_category from subjects WHERE subject_id = :subjectid;", Array("subjectid"=>$id));
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
	
	
	public function getSubjectTut(){

        try {
            $temp = $this->db->query("SELECT * FROM subjects su join tutorsubject tu on su.subject_id = tu.subject_id join members m on tu.tutor_id = m.user_id;");
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
            $temp = $this->db->query("UPDATE  'reach'.'subjects' SET  'subject_code' = :subject_code,'subject_name' = :subject_name,'subject_grade' = :subject_grade ,'subject_description' = :subject_description, 'subject_category' = :subject_category  WHERE  'subjects'.'subject_id' =:subjectid;", $values );
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
	
            $temp = $this->db->query("INSERT INTO 'reach'.'subjects' ('subject_code', 'subject_name', 'subject_grade', 'subject_description', 'subject_category') VALUES (:subject_code,:subject_name,:subject_grade,:subject_description,:subject_category);",$values);
			
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
            $temp = $this->db->query("DELETE FROM subjects WHERE subject_id =:subjectid;", $values );
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



