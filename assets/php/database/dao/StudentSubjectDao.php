<?php

error_reporting(E_ALL);
ini_set('display_errors',1);


require_once "Dao.php";


final class StudentSubjectDao extends Dao {

    public function insertSubject($values){

        try {

            $temp = $this->db->query("INSERT INTO studentsubject(user_id, stusubjectname) VALUES (:user_id,:stusubjectname)", $values );
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

?>