<?php


class Teacher extends Member {
    
private  $user_id;
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

	public function __construct()  {
		
      $this-> user_id = "";    
      $this-> schoolemployed = 'Enter Details';
	  $this-> teachinggrade = 'Enter Details';
	  $this-> yearsexperience = 'Enter Details';
	  $this-> cellnumber = 'Enter Details';
	  $this-> alternativenumber = 'Enter Details';
	  $this-> personalemail = 'Enter Details';
	  $this-> dob = 'Enter Details';
	  $this-> schooladdress = 'Enter Details';
	  $this-> schoolcontact = 'Enter Details';
	  $this-> streetnumber = 'Enter Details';
	  $this-> streetname = 'Enter Details';
	  $this-> suburb = 'Enter Details';
	  $this-> city = 'Enter Details';
	  $this-> country = 'Enter Details';
	  $this-> cellnumber = 'Enter Details';
	  $this-> postalcode = 'Enter Details';
    }
    
    public function pullTeacher($value){
	$teacher = new UserDao();
	$teacherDetails = $teacher->allTeachers(Array('userid'=>$value));
	//$firstname = $userDetails['firstname'];	
	return $teacherDetails;
	}
    
    
    public function getUserID() {		
        return $this -> user_id;
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

    public function setStreetNumber($treetnumber) {
        $this -> streetnumber = $streetnumber;
    }
	
	public function getStreetName() {
        return $this -> streetname;
    }

    public function setStreetName($streetname) {
        $this -> streetname = $treetname;
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

$obj = new User();
var_dump($obj);