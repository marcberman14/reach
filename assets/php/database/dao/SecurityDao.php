<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor. 16 fields
 */


error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once "Dao.php";

final class SecurityDao extends Dao
{

    public function loginSecurity($email)
    {

        try {
            $temp = $this->db->row("SELECT m.user_id, m.firstname, m.lastname, p.permission_name, m.password, m.salt, m.active FROM members m join permission_group p ON p.permission_id = m.permission_id WHERE m.email = :email;", Array('email' => $email));
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function logincheck($user_id)
    {

        try {
            $temp = $this->db->row("SELECT m.password, p.permission_name, m.active, m.firstname, m.lastname FROM members m join permission_group p  ON p.permission_id = m.permission_id  WHERE m.user_id = :userid;", Array('userid' => $user_id));
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function profilePic($user_id)
    {

        try {
            $temp = $this->db->row("SELECT m.profilepicurl FROM members m join permission_group p  ON p.permission_id = m.permission_id  WHERE m.user_id = :userid;", Array('userid' => $user_id));
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function userType($user_id)
    {

        try {
            $temp = $this->db->row("SELECT p.permission_name FROM members m join permission_group p  ON p.permission_id = m.permission_id  WHERE m.user_id = :userid;", Array('userid' => $user_id));
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }


    public function checkBrute($user_id, $now)
    {

        try {
            $temp = $this->db->query("SELECT time FROM login_attempts WHERE user_id = :userid AND time > :now;", Array('userid' => $user_id, 'now' => $now));
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }


    public function removeFailedLogin($user_id)
    {

        try {
            $temp = $this->db->query("DELETE FROM login_attempts WHERE user_id = :userid;", Array('userid' => $user_id));
            return $temp;
        } catch (DBException $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding member by code:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function invalidLoginInsert($user_id, $now)
    {

        try {
            $temp = $this->db->query("INSERT INTO login_attempts(user_id, time) VALUES (:userid, :now);", Array('userid' => $user_id, 'now' => $now));
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function registerEmailCheck($email)
    {

        try {
            $temp = $this->db->row("SELECT user_id FROM members WHERE email = :email;", Array('email' => $email));
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function registerInsert($values)
    {

        try {
            $temp = $this->db->query("INSERT INTO members(permission_id, firstname, lastname, email, password, salt, active, profilepicurl) VALUES (:permissionid,:firstname,:lastname,:email,:password,:salt,:active,:profilepicurl);", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function approveCount($values)
    {

        try {
            $temp = $this->db->row("SELECT COUNT(m.user_id) FROM members m  WHERE m.permission_id = :permid AND m.active = :approved;", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function studentDetails($values)
    {

        try {
            $temp = $this->db->row("SELECT m.user_id, m.firstname, m.lastname, p.permission_name, m.active, m.email, s.studentId ,
            s.streetnumber, s.streetname, s.suburb, s.city, s.country, s.postalcode, s.homenumber, s.cellnumber, s.alternativenumber,
            s.parentnumber, s.schoolname, s.grade, s.dob
            FROM members AS m
            INNER JOIN permission_group AS p ON p.permission_id = m.permission_id
            INNER JOIN student AS s ON s.userId = m.user_id
            WHERE m.user_id = :userid;", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function tutorDetails($values)
    {

        try {
            $temp = $this->db->row("SELECT m.user_id, t.tutor_id, m.firstname, m.lastname, m.email, m.active, p.permission_name,
            t.streetnumber, t.streetname, t.suburb, t.city, t.country, t.postalcode, t.nationality, t.countryresidence,
            t.studyarea, t.studyyear, t.studentnumber, t.personalemail, t.gender, t.monashemail,
            t.cellnumber, t.alternativenumber, t.dob
            FROM members AS m
            INNER JOIN permission_group AS p ON p.permission_id = m.permission_id
            INNER JOIN tutor AS t ON t.user_id = m.user_id
            WHERE m.user_id = :userid;", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function teacherDetails($values)
    {

        try {
            $temp = $this->db->row("SELECT m.user_id, t.teacherId, m.firstname, m.lastname, m.email, m.active, p.permission_name,
            t.schoolemployed, t.teachinggrade, t.yearsexperience, t.cellnumber, t.alternativenumber, t.personalemail, t.dob,
            t.schooladdress, t.schoolcontact, t.streetnumber, t.streetname, t.suburb, t.city, t.country, t.postalcode, t.subjectstaught
            FROM members AS m
            INNER JOIN permission_group AS p ON p.permission_id = m.permission_id
            INNER JOIN teacher AS t ON t.userId = m.user_id
            WHERE m.user_id = :userid;", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function adminDetails($values)
    {

        try {
            $temp = $this->db->row("SELECT m.user_id, a.adminId, m.firstname, m.lastname, m.email, m.active, p.permission_name,
            a.gender, a.dob, a.streetnumber, a.streetname, a.suburb, a.city, a.country, a.postalcode,
            a.homenumber, a.cellphone, a.worknumber, a.staffnumber, a.jobdepartment, a.jobposition,
            a.monashmail, a.alternativeemail, a.altcontactnum
            FROM members AS m
            INNER JOIN permission_group AS p ON p.permission_id = m.permission_id
            INNER JOIN administrator AS a ON a.user_id = m.user_id
            WHERE m.user_id = :userid;", $values);
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



