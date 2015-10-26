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
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
		}
	}
	
	public function edit($userid,$subid){

        try {
            $tutorid = $this->db->row("SELECT t.tutor_id FROM tutor t JOIN members m ON m.user_id = t.user_id WHERE m.user_id = :user_id;", array("user_id"=>$userid));
            $values = array("tutorid"=>$tutorid['tutor_id'],"subjectid"=>$subid);
			$temp = $this->db->query("UPDATE tutorsubject SET tutor_id =  :tutorid WHERE subject_id =:subjectid;", $values );
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
		}
	}
	
	public function add($userid,$subject){

        try {
			$subjectid = $this->db->row("SELECT subject_id from subjects WHERE subject_code =:subject_code", $subject);
			$sub = $subjectid['subject_id'];
            $tutorid = $this->db->row("SELECT t.tutor_id FROM tutor t JOIN members m ON m.user_id = t.user_id WHERE m.user_id = :user_id;", array("user_id"=>$userid));
            $tutor = array("tutor_id"=>$tutorid['tutor_id'],"subject_id"=>$sub);
			$temp = $this->db->query("INSERT INTO tutorsubject (tutor_id ,subject_id) VALUES (:tutor_id, :subject_id);", $tutor);
			return $temp;
			
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