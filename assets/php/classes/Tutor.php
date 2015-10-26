<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/UserDao.php";
require_once "User.php";

//$student = new UserDao();


class Tutor extends User
{

    private $tutor_id;
    private $streetNumber;
    private $streetName;
    private $suburb;
    private $city;
    private $country;
    private $postalCode;
    private $nationality;
    private $countryResidence;
    private $studyArea;
    private $studyYear;
    private $studentNo;
    private $personalEmail;
    private $monashEmail;
    private $cellNumber;
    private $alternativeNumber;
    private $dob;


    public function __construct($user_id, $tutor_id, $userfirstname, $userlastname, $useremail, $useractive, $permission_name, $picurl, $gender,
                                $streetNumber, $streetName, $suburb, $city, $country, $postalCode, $nationality, $countryResidence,
                                $studyArea, $studyYear, $studentNo, $personalEmail, $monashEmail, $cellNumber, $alternativeNumber, $dob)
    {
        parent::__construct($user_id, $userfirstname, $userlastname, $useremail, $useractive, $permission_name, $picurl, $gender);
        $this->tutor_id = $tutor_id;
        $this->streetNumber = $streetNumber;
        $this->streetName = $streetName;
        $this->suburb = $suburb;
        $this->city = $city;
        $this->country = $country;
        $this->postalCode = $postalCode;
        $this->nationality = $nationality;
        $this->countryResidence = $countryResidence;
        $this->studyArea = $studyArea;
        $this->studyYear = $studyYear;
        $this->studentNo = $studentNo;
        $this->personalEmail = $personalEmail;
        $this->monashEmail = $monashEmail;
        $this->cellNumber = $cellNumber;
        $this->alternativeNumber = $alternativeNumber;
        $this->dob = $dob;
    }

    public function pullStudent($value)
    {
        $student = new UserDao();
        $studentDetails = $student->allStudents(Array('userid' => $value));
        return $studentDetails;
    }

    public function getMonashEmail()
    {
        return $this->monashEmail;
    }

    public function setMonashEmail($monashEmail)
    {
        $this->monashEmail = $monashEmail;
    }

    public function getPersonalEmail()
    {
        return $this->personalEmail;
    }

    public function setPersonalEmail($personalEmail)
    {
        $this->personalEmail = $personalEmail;
    }

    public function getStudentNo()
    {
        return $this->studentNo;
    }

    public function setStudentNo($studentNo)
    {
        $this->studentNo = $studentNo;
    }

    public function getTutorID()
    {
        return $this->tutor_id;
    }

    public function setTutorID($tutor_id)
    {
        $this->tutor_id = $tutor_id;
    }

    public function getStudyYear()
    {
        return $this->studyYear;
    }

    public function setStudyYear($studyYear)
    {
        $this->studyYear = $studyYear;
    }

    public function getStudyArea()
    {
        return $this->studyArea;
    }

    public function setStudyArea($studyArea)
    {
        $this->studyArea = $studyArea;
    }

    public function getCountryResidence()
    {
        return $this->countryResidence;
    }

    public function setCountryResidence($countryResidence)
    {
        $this->countryResidence = $countryResidence;
    }

    public function getNationality()
    {
        return $this->nationality;
    }

    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }

    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;
    }


    public function getStreetName()
    {
        return $this->streetName;
    }

    public function setStreetName($streetName)
    {
        $this->streetName = $streetName;
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
        return $this->postalCode;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

   // public function getHomeNumber()
   // {
       // return $this->homenumber;
    //}

   // public function setHomeNumber($homenumber)
   // {
   //     $this->homenumber = $homenumber;
  //  }

    public function getCellNumber()
    {
        return $this->cellNumber;
    }

    public function setCellNumber($cellNumber)
    {
        $this->cellNumber = $cellNumber;
    }

    public function getAlternativeNumber()
    {
        return $this->alternativeNumber;
    }

    public function setAlternativeNumber($alternativeNumber)
    {
        $this->alternativeNumber = $alternativeNumber;
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
