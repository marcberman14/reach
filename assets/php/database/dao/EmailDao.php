<?php
/**
 * Created by IntelliJ IDEA.
 * User: Suhasini
 * Date: 2015/09/10
 * Time: 4:52 PM
 */

require_once "Dao.php";

final class EmailDao extends Dao
{

    public function sendEmail( $email, $hash)
    {
        try {
            $insert = $this->db->query("INSERT INTO members (hash) VALUES(:hash) WHERE email=:email", Array("email"=> $email,"hash"=> $hash));
            return $insert;
        } catch (DBException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        } catch (Exeption $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }

    }

    public function verify($email, $hash)
    {
        try {
            $temp = $this->db->row("SELECT email, hash FROM members WHERE email=:email AND hash=:hash LIMIT 0 1", Array("email"=> $email,"hash"=> $hash));
            return $temp;
        } catch (DBException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }

    }

    public function updateMember($email, $hash)
    {
        try {
            $update = $this->db->query("UPDATE members SET active='noprofile' WHERE email=:email AND hash=:hash", Array("email"=> $email,"hash"=> $hash));
            return $update;
        } catch (DBException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }

    }
}