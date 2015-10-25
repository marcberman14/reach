<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor. 16 fields
 */
 
 
 error_reporting(E_ALL);
ini_set('display_errors',1);
 

require_once "Dao.php";
//require_once "../classes/User.php";

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/SubjectLessonDao.php";

final class LessonDao extends Dao {
    
   	public function getLesson($values){

        try {
            $temp = $this->db->row("SELECT * from lesson WHERE lesson_id = :lessonid;", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        }
	}
	
	
	public function editLesson($values){

        try {
            $temp = $this->db->query("UPDATE  lesson SET  lesson_title =:title,lesson_name = :name,lesson_description = :description,lesson_concpet=:concept,lesson_material=:material, lesson_content=:file, lesson_video=:video WHERE  lesson_id = :lessonid;", $values );
            return $temp;
        } catch (DBException $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        }
	}
	
	
	public function addLesson($values){		

        try {
			$sublesson = new SubjectLessonDao();	
	
            $temp = $this->db->query("INSERT INTO reach.lesson (lesson_title, lesson_name, lesson_description, lesson_concpet, lesson_material, lesson_content, lesson_video) VALUES (:title, :name, :description, :concept, :material,:file, :video);",$values);
			
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
	
	public function deleteLesson($values){

        try {
            $temp = $this->db->query("DELETE FROM lesson WHERE lesson_id = :lessonid;", $values );
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

    public function allLessons(){

        try {
            $temp = $this->db->query("SELECT * FROM lesson su join subjectlesson tu on su.lesson_id = tu.lesson_id join subjects s on s.subject_id = tu.subject_id ;");
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



