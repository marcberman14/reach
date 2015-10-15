<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/UserDao.php";
require_once "User.php";

//$student = new UserDao();


class Student extends User
{
    private $studentID;
    private $streetnumber;
    private $streetname;
    private $suburb;
    private $city;
    private $country;
    private $postalcode;
    private $homenumber;
    private $cellnumber;
    private $alternativenumber;
    private $parentnumber;
    private $dob;
    private $schoolname;
    private $grade;

    public function __construct($user_id, $studentID,  $userfirstname, $userlastname, $useremail, $useractive, $permission_name, $picurl, $gender,
                                $streetnumber, $streetname, $suburb, $city, $country, $postalcode,
                                $homenumber, $cellnumber, $alternativenumber, $parentnumber,
                                $dob, $schoolname, $grade)
    {
        parent::__construct($user_id, $userfirstname, $userlastname, $useremail, $useractive, $permission_name, $picurl, $gender);
        $this->studentID = $studentID;
        $this->streetnumber = $streetnumber;
        $this->streetname = $streetname;
        $this->streetname = $streetname;
        $this->suburb = $suburb;
        $this->city = $city;
        $this->country = $country;
        $this->postalcode = $postalcode;
        $this->homenumber = $homenumber;
        $this->cellnumber = $cellnumber;
        $this->alternativenumber = $alternativenumber;
        $this->parentnumber = $parentnumber;
        $this->dob = $dob;
        $this->schoolname = $schoolname;
        $this->grade = $grade;
    }


    public function pullStudent($value)
    {
        $student = new UserDao();
        $studentDetails = $student->allStudents(Array('userid' => $value));
        return $studentDetails;
    }

    public function getStudentID()
    {
        return $this->studentID;
    }

    public function setStudentID($studentID)
    {
        $this->studentID = $studentID;
    }

    public function getStreetNumber()
    {
        return $this->streetnumber;
    }

    public function setStreetNumber($streetnumber)
    {
        $this->streetnumber = $streetnumber;
    }


    public function getStreetName()
    {
        return $this->streetname;
    }

    public function setStreetName($streetname)
    {
        $this->streetname = $streetname;
    }

    public function getSuburb()
    {
        return $this->suburb;
    }

    public function setSuburb($suburb)
    {
        $this->suburb = $suburb;
    }


    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getPostalCode()
    {
        return $this->postalcode;
    }

    public function setPostalCode($postalcode)
    {
        $this->postalcode = $postalcode;
    }

    public function getHomeNumber()
    {
        return $this->homenumber;
    }

    public function setHomeNumber($homenumber)
    {
        $this->homenumber = $homenumber;
    }

    public function getCellNumber()
    {
        return $this->cellnumber;
    }

    public function setCellNumber($cellnumber)
    {
        $this->cellnumber = $cellnumber;
    }

    public function getAlternativeNumber()
    {
        return $this->alternativenumber;
    }

    public function setAlternativeNumber($alternativenumber)
    {
        $this->alternativenumber = $alternativenumber;
    }

    public function getParentNumber()
    {
        return $this->parentnumber;
    }

    public function setParentNumber($parentnumber)
    {
        $this->parentnumber = $parentnumber;
    }

    public function getDob()
    {
        return $this->parentnumber;
    }

    public function setDob($dob)
    {
        $this->parentnumber = $dob;
    }

    public function getSchoolName()
    {
        return $this->parentnumber;
    }

    public function setSchoolName($schoolname)
    {
        $this->schoolname = $schoolname;
    }

    public function getGrade()
    {
        return $this->grade;
    }

    public function setGrade($grade)
    {
        $this->grade = $grade;
    }

}
