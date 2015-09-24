<?php

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";
//$student = new UserDao();



class Student{

private  $user_id;
private  $streetnumber;
private  $streetname;
private  $suburb;
private  $city;
private  $country;
private  $postalcode;
private  $homenumber;
private  $cellnumber;
private  $alternativenumber;
private  $parentnumber;
private  $dob;
private  $schoolname;
private  $grade;

	public function __construct(){
		
        $this-> user_id = "";
		$this-> streetnumber = "";
		$this-> streetname = "";
		$this-> suburb = "";
		$this-> city = "";
		$this-> country = "";
		$this-> postalcode = "";
		$this-> homenumber = "";
		$this-> cellnumber = "";
		$this-> alternativenumber = "";
		$this-> parentnumber = "";
		$this-> dob = "";
		$this-> schoolname = "";
		$this-> grade = "";
		
		
		
	}
	
	
	public function pullStudent($value){
	$student = new UserDao();
	$studentDetails = $student->allStudents(Array('userid'=>$value));
	//$firstname = $userDetails['firstname'];	
	return $studentDetails;
	}
    
    public function getUserID() {		
        return $this -> user_id;
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
        return $this -> postalcode;
    }

    public function setPostalCode($postalcode) {
        $this -> postalcode = $postalcode;
    }
	
	public function getHomeNumber() {
        return $this -> homenumber;
    }

    public function setHomeNumber($homenumber) {
        $this -> homenumber = $homenumber;
    }
	
	public function getCellNumber() {
        return $this -> cellnumber;
    }

    public function setCellNumber($cellnumber) {
        $this -> cellnumber = $cellnumber;
    }
	
	public function getAlternativeNumber() {
        return $this -> alternativenumber;
    }

    public function setAlternativeNumber($alternativenumber) {
        $this -> alternativenumber = $alternativenumber;
    }
	
	public function getParentNumber() {
        return $this -> parentnumber;
    }

    public function setParentNumber($parentnumber) {
        $this -> parentnumber = $parentnumber;
    }
	
	public function getDob() {
        return $this -> parentnumber;
    }

    public function setDob($dob) {
        $this -> parentnumber = $dob;
    }
	
	public function getSchoolName() {
        return $this -> parentnumber;
    }

    public function setSchoolName($schoolname) {
        $this -> schoolname = $schoolname;
    }
	
	public function getGrade() {
        return $this -> grade;
    }

    public function setGrade($grade) {
        $this -> grade = $grade;
    }

}
