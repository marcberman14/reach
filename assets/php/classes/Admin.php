<?php
/**
 * Created by IntelliJ IDEA.
 * User: Suhasini
 * Date: 2015/08/20
 * Time: 3:12 PM
 */

class Admin extends User {
    private $admin_id;
    private $dob;
    private $streetnumber;
    private $streetname;
    private $suburb;
    private $city;
    private $country;
    private $postalcode;
    private $cellnumber;
    private $homenumber;
    private $worknumber;
    private $staffnumber;
    private $jobdepartment;
    private $jobposition;
    private $monashemail;
    private $alternativeemail;
    private $altcontactnum;

  public function __construct($user_id, $admin_id, $userfirstname, $userlastname, $useremail, $useractive, $permission_name, $picurl, $gender,
                              $dob, $streetnumber, $streetname, $suburb, $city, $country, $postalcode,
                              $cellnumber, $homenumber, $worknumber, $staffnumber, $jobdepartment, $jobposition,
                              $monashemail, $alternativeemail, $altcontactnum)
    {
        parent::__construct($user_id, $userfirstname, $userlastname, $useremail, $useractive, $permission_name, $picurl, $gender);
        $this->admin_id = $admin_id;
        $this->dob = $dob;
        $this->streetnumber = $streetnumber;
        $this->streetname = $streetname;
        $this->suburb = $suburb;
        $this->city = $city;
        $this->country = $country;
        $this->postalcode = $postalcode;
        $this->cellnumber = $cellnumber;
        $this->homenumber = $homenumber;
        $this->worknumber = $worknumber;
        $this->staffnumber = $staffnumber;
        $this->jobdepartment = $jobdepartment;
        $this->jobposition = $jobposition;
        $this->monashemail = $monashemail;
        $this->alternativeemail = $alternativeemail;
        $this->altcontactnum = $altcontactnum;
    }

    public  function getAdminID() {
        return $this -> admin_id;
    }

    public  function getDob() {
        return $this -> dob;
    }

    public function setDob($dob) {
        $this -> dob = $dob;
    }

    public  function getAdminstreetnumber() {
        return $this -> streetnumber;
    }

    public  function setAdminstreetnumber($streetnumber) {
        $this -> streetnumber= $streetnumber;
    }

    public  function getAdminstreetname() {
        return $this -> streetname;
    }

    public  function setAdminstreetname($streetname) {
        $this -> streetname= $streetname;
    }

    public  function getAdminsuburb() {
    return $this -> suburb;
}

    public function setAdminsuburb($suburb) {
        $this -> suburb= $suburb;
    }

    public function getAdmincity() {
        return $this -> city;
    }

    public function setAdmincity($city) {
        $this -> city= $city;
    }

    public function getAdmincountry() {
        return $this -> country;
    }

    public function setAdmincountry($country) {
        $this -> country= $country;
    }

    public function getAdminpostalcode() {
        return $this -> postalcode;
    }

    public  function setAdminpostalcode($postalcode) {
        $this -> postalcode= $postalcode;
    }

    public  function getAdmincellnumber() {
        return $this -> cellnumber;
    }

    public function setAdmincellnumber($cellnumber) {
        $this -> cellnumber= $cellnumber;
    }

    public function getAdminhomenumber() {
        return $this -> homenumber;
    }

    public  function setAdminhomenumber($homenumber) {
        $this -> homenumber= $homenumber;
    }

    public  function getAdminworknumber() {
    return $this -> worknumber;
}

    public function setAdminworknumber($worknumber) {
        $this -> worknumber= $worknumber;
    }

    public function getAdminstaffnumber() {
        return $this -> staffnumber;
    }

    public function setAdminstaffnumber($staffnumber) {
        $this -> staffnumber= $staffnumber;
    }

    public function getAdminjobdepartment() {
    return $this -> jobdepartment;
}

    public function setAdminjobdepartment($jobdepartment) {
        $this -> jobdepartment= $jobdepartment;
    }

    public function getAdminjobposition() {
        return $this -> jobposition;
    }

    public function setAdminjobposition($jobposition) {
        $this -> jobposition= $jobposition;
    }

    public  function getAdminmonashemail() {
    return $this -> monashemail;
}

    public  function setAdminmonashemail($monashemail) {
        $this -> monashemail= $monashemail;
    }

    public  function getAdminalternativeemail() {
            return $this -> alternativeemail;
    }

    public function setAdminalternativeemail($alternativeemail) {
        $this -> alternativeemail= $alternativeemail;
    }

    public  function getAdminaltcontactnum() {
        return $this -> altcontactnum;
    }

    public function setAdminaltcontactnum($altcontactnum) {
        $this -> altcontactnum = $altcontactnum;
    }










} 