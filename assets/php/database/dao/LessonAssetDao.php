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

final class LessonAssetDao extends Dao {
    
   	public function getAsset($values){

        try {
            $temp = $this->db->row("SELECT * from lesson_assets WHERE file_id = :fileid;", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        }
	}
    
    public function getAssetUrl($values){

        try {
            $temp = $this->db->row("SELECT url from lesson_assets WHERE file_id = :fileid;", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        }
	}
	
	
	public function editAsset($values){

        try {
            $temp = $this->db->query("UPDATE  lesson_assets SET 
            file_id =:fileid,
            lesson_id = :lesson_id,
            type = :type,
            url = :url", $values );
            return $temp;
        } catch (DBException $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        }
	}
	
	
	public function addAsset($values){		

        try {
            $temp = $this->db->query("INSERT INTO lesson_assets (lesson_id, type, url, file_name) VALUES (:lessonid, :type, :url, :filename) ;",$values);
            return $temp;
        } catch (DBException $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        }
	}
	
	public function deleteAsset($values){

        try {
            $temp = $this->db->query("DELETE FROM lesson_assets WHERE file_id = :fileid;", $values );
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
            $temp = $this->db->query("SELECT * FROM lesson_assets;");
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

