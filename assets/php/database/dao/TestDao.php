<?php

require_once "Dao.php";

final class TestDao extends Dao {
    
    public function createTest($values)	
    {
        try {
            $temp = $this->db->query("INSERT INTO test (test_name,test_description,test_marks,subject_id) VALUES (:testname,:testdecr, :testmark,:subjectid);", $values);
                                     
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }
	
	  public function updateTest($values)	
    {
        try {
            $temp = $this->db->query("UPDATE test SET  test_name =:testname,test_description =:testdesc,test_marks =:testmarks WHERE test_id =:testid;", $values);
                                     
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }
    
    
    public function allTest(){
        try {
            $temp = $this->db->query("Select * from test");                                     
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }
    
    public function TestsBySubject($values){
        try {
            $temp = $this->db->query("Select t.test_name, s.subject_name, s.subject_description 
                                    FROM test AS t
                                    INNER JOIN subjects AS s ON s.subject_id = t.subject_id
                                    WHERE t.subject_id = :subj_id", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }
    
    public function viewTests($values){
        try {
            $temp = $this->db->query("Select t.test_name, s.subject_name, s.subject_description 
                                    FROM test AS t
                                    INNER JOIN subjects AS s ON s.subject_id = t.subject_id", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function insertQuestion($values){
        try {
            $temp = $this->db->query("INSERT INTO test
                                      values(question,wanswer,wanswer1,wanswer2,wanswer3,canswer,s.subject
                                       WHERE s.subject = t.subject_id", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function deleteTest($values){
        try {
            $temp = $this->db->query("DELETE FROM test WHERE test_id = :test_id", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }
	
	
	 public function getTest($values){
        try {
            $temp = $this->db->query("select * from test where test_id =:testid", $values);
            return $temp;
} catch (DBException $e) {
    echo "Error:<br/>" . $e->getMessage();
    return null;
} catch (Exception $e) {
    echo "Error:<br/>" . $e->getMessage();
    return null;
}
    }
	
	
	 public function getSubjTest($values){
        try {
            $temp = $this->db->query("select * from test where subject_id =:subjectid", $values);
            return $temp;
} catch (DBException $e) {
    echo "Error:<br/>" . $e->getMessage();
    return null;
} catch (Exception $e) {
    echo "Error:<br/>" . $e->getMessage();
    return null;
}
    }



    public function test($values){
        try {
            $temp = $this->db->row("select * from test where test_id =:testid", $values);
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