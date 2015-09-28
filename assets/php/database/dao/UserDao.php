<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor. 16 fields
 */

require_once "Dao.php";

final class UserDao extends Dao
{
    public function studentUpdate($values)
    {

        try {
            $temp = $this->db->query("UPDATE members m JOIN student s ON m.user_id = s.userId
                                        SET m.firstname = :fname,
                                            m.lastname = :sname,
                                            m.email = :mail,
                                            s.streetnumber = :strno,
                                            s.streetname = :strname,
                                            s.suburb = :suburb,
                                            s.city = :city,
                                            s.postalcode = :pcode,
                                            s.homenumber = :homeno,
                                            s.cellnumber = :cellno,
                                            s.alternativenumber = :altno,
                                            s.parentnumber = :parno,
                                            s.schoolname = :school
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

    public function teacherUpdate($values)
    {

        try {
            $temp = $this->db->query("UPDATE members m JOIN teacher t ON m.user_id = t.userId
                                        SET m.firstname = :fname,
                                            m.lastname = :sname,
                                            m.email = :mail,
                                            t.streetnumber = :strno,
                                            t.streetname = :strname,
                                            t.suburb = :suburb,
                                            t.city = :city,
                                            t.postalcode = :pcode,
                                            t.schoolcontact = :schcont,
                                            t.cellnumber = :cellno,
                                            t.alternativenumber = :altno,
                                            t.schoolemployed = :school,
                                            t.teachinggrade = :tgrade
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

    public function tutorUpdate($values)
    {

        try {
            $temp = $this->db->query("UPDATE members m JOIN tutor t ON m.user_id = t.user_id
                                        SET m.firstname = :fname,
                                            m.lastname = :sname,
                                            m.email = :mail,
                                            s.streetnumber = :strno,
                                            t.streetname = :strname,
                                            t.suburb = :suburb,
                                            t.city = :city,
                                            t.postalcode = :pcode,
                                            t.cellnumber = :cellno,
                                            t.alternativenumber = :altno,
                                            t.studyarea = :parno,
                                            t.studyyear = :school
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


    public function passwordUpdate($values)
    {
        try {
            $temp = $this->db->query("UPDATE members
                                        SET m.password = :pass,
                                            m.salt = :salt
                                        WHERE user_id = :userid;", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }


    public function allDetails($values)
    {

        try {
            $temp = $this->db->row("SELECT m.user_id, m.firstname, m.lastname, p.permission_name, m.active, m.email
             FROM members m join permission_group p ON p.permission_id = m.permission_id WHERE user_id = :userid;", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function allStudents($values)
    {

        try {
            $temp = $this->db->row("SELECT * from student WHERE userId = :userid;", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function allTeachers($values)
    {

        try {
            $temp = $this->db->row("SELECT * from teacher WHERE userId = :userid;", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function allTutors($values)
    {

        try {
            $temp = $this->db->row("SELECT * from tutor WHERE user_id = :userid;", $values);
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
