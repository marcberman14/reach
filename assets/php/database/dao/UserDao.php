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
											m.active = :active,
                                            m.gender = :gender,
                                            s.streetnumber = :strno,
                                            s.streetname = :strname,
                                            s.suburb = :suburb,
                                            s.city = :city,
											s.country = :country,
                                            s.postalcode = :pcode,											
                                            s.homenumber = :homeno,
                                            s.cellnumber = :cellno,
                                            s.alternativenumber = :altno,
                                            s.parentnumber = :parno,
                                            s.schoolname = :school,
											s.grade = :grade
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
    
     public function studentProfileUpdate($values)
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
											m.active = :active,
                                            m.gender = :gender,	
											t.schoolemployed = :school,
                                            t.teachinggrade = :tgrade,	
											t.yearsexperience = :yearexp,
											t.cellnumber = :cellno,
                                            t.alternativenumber = :altno,	
											t.schooladdress = :schadd,
                                            t.schoolcontact = :schcon,								
                                            t.streetnumber = :strno,
                                            t.streetname = :strname,
                                            t.suburb = :suburb,
                                            t.city = :city,
											t.country = :country,
                                            t.postalcode = :pcode,                                                                     
											t.subjectstaught = :subjecttaught,
											t.personalemail = :pmail
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
    
    public function teacherProfileUpdate($values)
    {

        try {
            $temp = $this->db->query("UPDATE members m JOIN teacher t ON m.user_id = t.userId
                                        SET m.firstname = :fname,
                                            m.lastname = :sname,
                                            m.email = :mail,
											t.schoolemployed = :school,
                                            t.teachinggrade = :tgrade,	
											t.yearsexperience = :yearexp,
											t.cellnumber = :cellno,
                                            t.alternativenumber = :altno,								
                                            t.streetnumber = :strno,
                                            t.streetname = :strname,
                                            t.suburb = :suburb,
                                            t.city = :city,
                                            t.postalcode = :pcode                                                                     
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
											m.active = :active,
                                            m.gender = :gender,
                                            t.streetnumber = :strno,
                                            t.streetname = :strname,
                                            t.suburb = :suburb,
                                            t.city = :city,
                                            t.postalcode = :pcode,
                                            t.cellnumber = :cellno,
                                            t.alternativenumber = :altno,											
                                            t.studyarea = :studyarea,
                                            t.studyyear = :studyyear,
											t.country = :country,
											t.nationality = :nationality,
											t.countryresidence = :res,
											t.studentnumber = :tutstuno,
											t.monashemail = :mmail
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
    
    public function tutorProfileUpdate($values)
    {
        try {
            $temp = $this->db->query("UPDATE members m JOIN tutor t ON m.user_id = t.user_id
                                        SET m.firstname = :fname,
                                            m.lastname = :sname,
                                            m.email = :mail,
                                            t.streetnumber = :strno,
                                            t.streetname = :strname,
                                            t.suburb = :suburb,
                                            t.city = :city,
                                            t.postalcode = :pcode,
                                            t.cellnumber = :cellno,
                                            t.alternativenumber = :altno,											
                                            t.studyarea = :studyarea,
                                            t.studyyear = :studyyear
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
    
      public function adminProfileUpdate($values)
    {

        try {
            $temp = $this->db->query("UPDATE members m JOIN administrator a ON m.user_id = a.user_id
                                        SET m.firstname = :fname,
                                            m.lastname = :sname,
                                            m.email = :mail,
                                            a.streetnumber = :strno,
                                            a.streetname = :strname,
                                            a.suburb = :suburb,
                                            a.city = :city,
                                            a.postalcode = :pcode,
                                            a.cellnumber = :cellno,
                                            a.worknumber = :workno,	
                                            a.homenumber = :homeno,
                                            a.jobdepartment = :jobdept,											
                                            a.jobposition = :jobpos,
                                            a.alternativeemail = :altemail
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



    public function memberUpdate($values)
    {

        try {
            $temp = $this->db->query("UPDATE members  m
                                        SET m.firstname = :fname,
                                            m.lastname = :sname,
                                            m.email = :mail,
											m.active = :active,
											m.gender = :gender                                           
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


    public function tutors()
    {

        try {
            $temp = $this->db->query("SELECT m.user_id, m.firstname, m.lastname, m.email FROM members m join permission_group p
                                            ON m.permission_id = p.permission_id WHERE p.permission_id=2;");
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }


    public function password($values)
    {

        try {
            $temp = $this->db->row("SELECT salt, password from members where user_id = :user_id;", $values);
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
            $temp = $this->db->query("UPDATE members m
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
            $temp = $this->db->row("SELECT * FROM members where user_id =:userid;", $values);
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

    public function uploadpicurl($values)
    {
        try{
            $temp = $this->db->query("UPDATE members SET profilepicurl = :profilepicurl WHERE user_id= :user_id", $values);
            return $temp;

        }
        catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }

    }

    public function checkUser($values)
    {

        try
        {
            $temp = $this->db->row("SELECT * FROM members where email =:email;", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function insertUser($values)
    {
        try
        {
            $temp = $this->db->query("INSERT INTO members(permission_id, firstname, lastname, email, password, salt, active, profilepicurl, gender) values
            (:permissionid, :firstname, :lastname, :email, :password, : salt, :active, :profilepicurl, :gender)", $values);
            return $temp;
        }
        catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }

    }

    public function insertTutor($values)
    {
        try
        {
            $temp = $this->db->query("INSERT INTO tutor(user_id, dob, cellnumber, alternativenumber,
            streetnumber, streetname, suburb, city, country, postalcode, nationality,
            countryresidence, studyarea, studyyear, studentnumber,
            personalemail, monashemail) VALUES
        (:user_id,:dob,:cellnumber,:alternativenumber,
        :streetnumber,:streetname,:suburb,:city,:country,:postalcode,:nationality,
        :countryresidence,:studyarea,:studyyear,:studentnumber,
        :personalemail,:monashemail)", $values);
            return $temp;
        }
        catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function insertTeacher($values)
    {
        try
        {
            $temp = $this->db->query("INSERT INTO teacher(userId, schoolemployed, teachinggrade, yearsexperience, cellnumber, alternativenumber,
             personalemail, dob, schooladdress, schoolcontact, streetnumber, streetname, suburb, city, country, postalcode, subjectstaught)
            VALUES (:userId,:schoolemployed,:teachinggrade,:yearsexperience,:cellnumber,:alternativenumber,
            :personalemail,:dob,:schooladdress,:schoolcontact,:streetnumber,:streetname,:suburb,:city,:country,:postalcode,:sujectstaught)", $values);
            return $temp;
        }
        catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function insertStudent($values)
    {
        try
        {
            $temp = $this->db->query("INSERT INTO student( userId, streetnumber, streetname, suburb, city, country,
                        postalcode, homenumber, cellnumber, alternativenumber, parentnumber, dob, schoolname, grade)
                                          VALUES (:userId,:streetnumber,:streetname,:suburb,:city,:country,
                                          :postalcode,:homenumber,:cellnumber,:alternativenumber,:parentnumber,:dob,:schoolname,:grade)", $values);
            return $temp;
        }
        catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function updateActive($values)
    {
        try
        {
            $temp = $this->db->query("UPDATE members m
                                        SET m.active = :active
                                        WHERE m.user_id = :userid;", $values);
            return $temp;
        }
        catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function viewUsers(){
        try
        {
            $temp = $this->db->query("SELECT m.user_id, m.firstname, m.lastname, m.email, p.permission_name, m.active
FROM members m join permission_group p  ON m.permission_id = p.permission_id");
            return $temp;
        }
        catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }

    }
	
	
	
	public function deleteStudent($value){
        try
        {
            $temp = $this->db->query("DELETE FROM `reach`.`members` WHERE `members`.`user_id` =:userid;",$value);
			$temp = $this->db->query("DELETE FROM `reach`.`student` WHERE `student`.`userId` =:userid;",$value);
			$temp = $this->db->query("DELETE FROM `reach`.`teacher` WHERE `teacher`.`userId` =:userid;",$value);
			$temp = $this->db->query("DELETE FROM `reach`.`tutor` WHERE `tutor`.`user_id` =:userid;",$value);
            return $temp;
        }
        catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }

    }




}
