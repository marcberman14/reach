<?php

 error_reporting(E_ALL);
ini_set('display_errors',1);
 

require_once "Dao.php";


 final class SubjectLessonDao extends Dao {
    
    public function delete($values){

        try {
            //$temp = $this->db->query("DELETE FROM `lesson` WHERE `lesson_id` = :lessonid;", $values );
			$temp = $this->db->query("DELETE FROM reach.subjectlesson WHERE subjectlesson.lesson_id = :lessonid;", $values );
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
			$temp = $this->db->query("UPDATE  reach.subjectlesson
			                          SET  subject_id =  :subjectid
			                          WHERE  subjectlesson.lesson_id =:lessonid;", $values );
            return $temp;
        } catch (DBException $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
		}
	}
	
	public function add($value,$subjectid){

        try {
			$lessnid = $this->db->query("SELECT lesson_id
			                             FROM lesson
			                             WHERE lesson_title =:title", $value);
            //$temp = $this->db->query("DELETE FROM `lesson` WHERE `lesson_id` = :lessonid;", $values );
			
			//$lessnid = $lessnid['lesson_id'];
			
			$less = $lessnid[0];
			
			$less = $less['lesson_id'];
			
			$array = array("subjectid"=>$subjectid,"lessonid"=>$less);
			
			$temp = $this->db->query("INSERT INTO  reach.subjectlesson (subject_id ,lesson_id) VALUES (:subjectid, :lessonid);", $array);
            //$less = $lessnid[1];		
			
			
			return $less;
			
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