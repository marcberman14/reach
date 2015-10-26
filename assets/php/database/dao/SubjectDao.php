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
            $temp = $this->db->query("SELECT su.subject_id, su.subject_name, su.subject_code, su.subject_grade, su.subject_description, su.subject_category, m.firstname, m.lastname, m.user_id
                                      FROM subjects su join tutorsubject tu on su.subject_id = tu.subject_id
                                      join tutor t on tu.tutor_id = t.tutor_id
                                      join members m on t.user_id = m.user_id;");
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
            $temp = $this->db->query("UPDATE subjects SET  subject_code = :subject_code,subject_name = :subject_name,subject_grade = :subject_grade ,subject_description = :subject_description, subject_category = :subject_category  WHERE  subjects.subject_id =:subjectid;", $values );
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
            $temp = $this->db->query(
                "INSERT INTO subjects (subject_code, subject_name, subject_grade, subject_description, subject_category) VALUES (:subject_code, :subject_name, :subject_grade, :subject_description, :subject_category);",$values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
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



