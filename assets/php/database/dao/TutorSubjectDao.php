<?php

 error_reporting(E_ALL);
ini_set('display_errors',1);
 

require_once "Dao.php";


 final class TutorSubjectDao extends Dao {
    
    public function delete($values){

        try {
            //$temp = $this->db->query("DELETE FROM `lesson` WHERE `lesson_id` = :lessonid;", $values );
			$temp = $this->db->query("DELETE FROM `reach`.`tutorsubject` WHERE `tutorsubject`.`subject_id` = :subjectid;", $values );
            return $temp;
        } catch (DBException $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
		}
	}
	
	public function edit($values){		

        try {
            //$temp = $this->db->query("DELETE FROM `lesson` WHERE `lesson_id` = :lessonid;", $values );
			$temp = $this->db->query("UPDATE  `reach`.`tutorsubject` SET  `tutor_id` =  :tutorid WHERE  `tutorsubject`.`subject_id` =:subjectid;", $values );
            return $temp;
        } catch (DBException $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
		}
	}
	
	public function add($value,$tutorid){

        try {
			$subjectid = $this->db->query("SELECT subject_id from subjects WHERE `subject_code` =:subject_code", $value);
            //$temp = $this->db->query("DELETE FROM `lesson` WHERE `lesson_id` = :lessonid;", $values );
			
			//$lessnid = $lessnid['lesson_id'];
			
			$sub = $subjectid[0];
			
			$sub = $sub['subject_id'];
			
			$array = array("tutorid"=>$tutorid,"subjectid"=>$sub);
			
			$temp = $this->db->query("INSERT INTO  `reach`.`tutorsubject` (`tutor_id` ,`subject_id`) VALUES (:tutorid, :subjectid);", $array);
            //$less = $lessnid[1];		
			
			
			return $sub;
			
        } catch (DBException $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
		}
	}
	
	
	//$temp = $this->db->query("INSERT INTO `reach`.`subjectlesson` (`subject_id` ,`lesson_id`) VALUES (14,54);");
 }

?>