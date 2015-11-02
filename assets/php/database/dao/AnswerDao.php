<?php

require_once "Dao.php";

final class AnswerDao extends Dao {
    
    public function createAnswer($values)	
    {
        try {
            $temp = $this->db->query("INSERT INTO takentest (question_id,answer,test_id,user_id) VALUES (:question_id,:answer,:test_id,:user);", $values);
                                     
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }
	
	public function getAnswers($values)	
    {
        try {
            $temp = $this->db->query("SELECT answer FROM takentest WHERE test_id =:testid && user_id =:user;", $values);
                                     
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }
	
}


?>