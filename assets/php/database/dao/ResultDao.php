<?php

require_once "Dao.php";

final class ResultDao extends Dao {
	
	public function enterResults($values)
    {
        try {
            $temp = $this->db->query("INSERT INTO result ( user_id, test_id, grade) VALUES (:userid, :testid, :grade);
", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function viewResults($values)
    {
        try {
            $temp = $this->db->query("SELECT *
                                      FROM result
                                      WHERE user_id=:user_id && test_id=:test_id;", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function viewAllResults($values)
{
    try {
        $temp = $this->db->query("SELECT *
                                  FROM result
                                  WHERE user_id=:user_id, test_id=:test_id, question_id=:question_id, grade=:grade", $values);
        return $temp;
    } catch (DBException $e) {
        echo "Error:<br/>" . $e->getMessage();
        return null;
    } catch (Exception $e) {
        echo "Error:<br/>" . $e->getMessage();
        return null;
    }
}

    public function viewUserResult($values)
{
    try {
        $temp = $this->db->query("SELECT *
                                  FROM result
                                  WHERE user_id=:user_id", $values);
        return $temp;
    } catch (DBException $e) {
        echo "Error:<br/>" . $e->getMessage();
        return null;
    } catch (Exception $e) {
        echo "Error:<br/>" . $e->getMessage();
        return null;
    }
}
    public function viewTestResult($values)
    {
        try {
            $temp = $this->db->query("SELECT *
                                  FROM result
                                  WHERE test_id=:testid && user_id =:user;", $values);
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





