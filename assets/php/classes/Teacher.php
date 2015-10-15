<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/UserDao.php";
require_once "User.php";

class Teacher extends User {
    
private  $teacher_id;
private  $schoolemployed;
private  $teachinggrade;
private  $yearsexperience;
private  $cellnumber;
private  $alternativenumber;
private  $personalemail;
private  $dob;
private  $schooladdress;
private  $schoolcontact;
private  $streetnumber;
private  $streetname;
private  $suburb;
private  $city;
private  $country;
private  $postalcode;
private  $subjecttaught;



	public function __construct($user_id, $teacher_id, $userfirstname, $userlastname, $useremail, $useractive, $permission_name, $picurl, $gender,
                                $schoolemployed, $teachinggrade, $yearsexperience, $cellnumber, $alternativenumber, $personalemail, $dob,
                                $schooladdress, $schoolcontact, $streetnumber, $streetname, $suburb, $city, $country, $postalcode, $subjecttaught)  {
        parent::__construct($user_id, $userfirstname, $userlastname, $useremail, $useractive, $permission_name, $picurl, $gender);
        $this-> teacher_id = $teacher_id;
        $this-> schoolemployed = $schoolemployed;
        $this-> teachinggrade = $teachinggrade;
        $this-> yearsexperience = $yearsexperience;
        $this-> cellnumber = $cellnumber;
        $this-> alternativenumber = $alternativenumber;
        $this-> personalemail = $personalemail;
        $this-> dob = $dob;
        $this-> schooladdress = $schooladdress;
        $this-> schoolcontact = $schoolcontact;
        $this-> streetnumber = $streetnumber;
        $this-> streetname = $streetname;
        $this-> suburb = $suburb;
        $this-> city = $city;
        $this-> country = $country;
        $this-> cellnumber = $postalcode;
        $this-> postalcode = $subjecttaught;
    }
    
    public function pullTeacher($value){
	$teacher = new UserDao();
	$teacherDetails = $teacher->allTeachers(Array('userid'=>$value));
	//$firstname = $userDetails['firstname'];	
	return $teacherDetails;
	}

    public function getTeacherID() {
        return $this -> teacher_id;
    }

	public function getSchoolemployed() {
        return $this -> schoolemployed;
    }

    public function setSchoolemployed($schoolemployed) {
        $this -> schoolemployed = $schoolemployed;
    }
	
	public function getTeachingGrade() {
        return $this -> teachinggrade;
    }

    public function setTeachingGrade($teachinggrade) {
        $this -> teachinggrade = $teachinggrade;
    }
	
	public function getYearsExperience() {
        return $this -> yearsexperience;
    }

    public function setYearsExperience($yearsexperience) {
        $this -> yearsexperience = $yearsexperience;
    }
	
	public function getCellNumber() {
        return $this -> cellnumber;
    }

    public function setCellNumber($cellnumber) {
        $this -> yearsexperience = $cellnumber;
    }
	
	public function getAlternativeNumber() {
        return $this -> cellnumber;
    }

    public function setAlternativeNumbe($alternativenumber) {
        $this -> yearsexperience = $alternativenumber;
    }
	
	public function getPersonalEmail() {
        return $this -> personalemail;
    }

    public function setPersonalEmail($personalemail) {
        $this -> personalemail = $personalemail;
    }
	
	public function getDob() {
        return $this -> dob;
    }

    public function setDob($dob) {
        $this -> dob = $dob;
    }

    public function getSchoolAddress() {
        return $this -> schooladdress;
    }

    public function setSchoolAddress($schooladdress) {
        $this -> schooladdress = $schooladdress;
    }
	
	public function getSchoolContact() {
        return $this -> schoolcontact;
    }

    public function setSchoolContact($schoolcontact) {
        $this -> schoolcontact = $schoolcontact;
    }
	
	public function getStreetNumber() {
        return $this -> streetnumber;
    }

    public function setStreetNumber($streetnumber) {
        $this -> streetnumber = $streetnumber;
    }
	
	public function getStreetName() {
        return $this -> streetname;
    }

    public function setStreetName($streetname) {
        $this -> streetname = $streetname;
    }
	
	public function getSuburb() {
        return $this -> suburb;
    }

    public function setSuburb($suburb) {
        $this -> suburb = $suburb;
    }
	
	public function getCity() {
        return $this -> city;
    }
	
	public function setCity($city) {
        $this -> city = $city;
    }
	
	public function getCountry() {
        return $this -> country;
    }
	
	public function setCountry($country) {
        $this -> country = $country;
    }
	
	public function getPostalCode() {
        return $this -> country;
    }
	
	public function setPostalCode($postalcode) {
        $this -> postalcode = $postalcode;
    }
	
	public function getSubjectTaught() {
        return $this -> country;
    }
	
	public function setSubjectTaught($subjecttaught) {
        $this -> subjecttaught = $subjecttaught;
    }
}