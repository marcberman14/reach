<?php

require_once "Dao.php";

final class QuestionDao extends Dao {
    
    public function addQuestion($values)
    {
        try {
              $temp = $this->db->query("INSERT INTO question
                                        (question, 
                                        correctanswer, 
                                        wronganswer1,
                                        wronganswer2,
                                        wronganswer3,
                                        test_id
                                        )                                        
                                        VALUES( 
                                        :quiz,
                                        :correct,
                                        :wrong1,
                                        :wrong2,
                                        :wrong3,
                                        :testid);", $values);
                                     
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }
	
	
	

    public function updateQuestion($values)
    {
        try {
            $temp = $this->db->query("UPDATE  question SET  question =:question,
correctanswer =  :correctanswer,
wronganswer1 =  :wronganswer1,
wronganswer2 =  :wronganswer2,
wronganswer3 =  :wronganswer3 WHERE question_id = :questid;", $values);

            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

   

    public function getTestQuestion($values){
        try {
            $temp = $this->db->query("select * from question where test_id =:testid", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }
	
	
	public function getQuestion($values){
        try {
            $temp = $this->db->row("select * from question where question_id =:questid", $values);
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