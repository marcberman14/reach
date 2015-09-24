<?php
/**
 * Created by IntelliJ IDEA.
 * User: Suhasini
 * Date: 2015/08/20
 * Time: 3:12 PM
 */

class Admin extends User  {
    private $admindob;
    private $admingender;
    private $adminstreetnumber;
    private $adminstreetname;
    private $adminsuburb;
    private $admincity;
    private $admincountry;
    private $adminpostalcode;
    private $admincellnumber;
    private $adminhomenumber;
    private $adminworknumber;
    private $adminstaffnumber;
    private $adminjobdepartment;
    private $adminjobposition;
    private $adminmonashemail;
    private $adminalternativeemail;
    private $adminaltcontactnum;

  public function __construct()
    {
        $this->admindob = "Enter Details";
        $this->admingender="Enter Details";
        $this->adminstreetnumber ="Enter Details";
        $this->adminstreetname ="Enter Details";
        $this->adminsuburb ="Enter Details";
        $this->admincity ="Enter Details";
        $this->admincountry ="Enter Details";
        $this->adminpostalcode = "Enter Details";
        $this->admincellnumber ="Enter Details";
        $this->adminhomenumber ="Enter Details";
        $this->adminworknumber ="Enter Details";
        $this->adminstaffnumber = "Enter Details";
        $this->adminjobdepartment ="Enter Details";
        $this->adminjobposition ="Enter Details";
        $this->adminmonashemail ="Enter Details";
        $this->adminalternativeemail ="Enter Details";
        $this->adminaltcontactnum ="Enter Details";
    }
    public  function getAdmindob() {
        return $this -> admindob;
    }

    public function setAdmindob($admindob) {
        $this -> admindob = $admindob;
    }

    public  function getAdmingender() {
    return $this -> admingender;
}

    public  function setAdmingender($admingender) {
        $this -> admingender= $admingender;
    }

    public  function getAdminstreetnumber() {
        return $this -> adminstreetnumber;
    }

    public  function setAdminstreetnumber($adminstreetnumber) {
        $this -> adminstreetnumber= $adminstreetnumber;
    }

    public  function getAdminstreetname() {
        return $this -> adminstreetname;
    }

    public  function setAdminstreetname($adminstreetname) {
        $this -> adminstreetname= $adminstreetname;
    }

    public  function getAdminsuburb() {
    return $this -> adminsuburb;
}

    public function setAdminsuburb($adminsuburb) {
        $this -> adminsuburb= $adminsuburb;
    }

    public function getAdmincity() {
        return $this -> admincity;
    }

    public function setAdmincity($admincity) {
        $this -> admincity= $admincity;
    }

    public function getAdmincountry() {
        return $this -> admincountry;
    }

    public function setAdmincountry($admincountry) {
        $this -> admincountry= $admincountry;
    }

    public function getAdminpostalcode() {
        return $this -> adminpostalcode;
    }

    public  function setAdminpostalcode($adminpostalcode) {
        $this -> adminpostalcode= $adminpostalcode;
    }

    public  function getAdmincellnumber() {
        return $this -> admincellnumber;
    }

    public function setAdmincellnumber($admincellnumber) {
        $this -> admincellnumber= $admincellnumber;
    }

    public function getAdminhomenumber() {
        return $this -> adminhomenumber;
    }

    public  function setAdminhomenumber($adminhomenumber) {
        $this -> adminhomenumber= $adminhomenumber;
    }

    public  function getAdminworknumber() {
    return $this -> adminworknumber;
}

    public function setAdminworknumber($adminworknumber) {
        $this -> adminworknumber= $adminworknumber;
    }

    public function getAdminstaffnumber() {
        return $this -> adminstaffnumber;
    }

    public function setAdminstaffnumber($adminstaffnumber) {
        $this -> adminstaffnumber= $adminstaffnumber;
    }

    public function getAdminjobdepartment() {
    return $this -> adminjobdepartment;
}

    public function setAdminjobdepartment($adminjobdepartment) {
        $this -> adminjobdepartment= $adminjobdepartment;
    }

    public function getAdminjobposition() {
        return $this -> adminjobposition;
    }

    public function setAdminjobposition($adminjobposition) {
        $this -> adminjobposition= $adminjobposition;
    }

    public  function getAdminmonashemail() {
    return $this -> adminmonashemail;
}

    public  function setAdminmonashemail($adminmonashemail) {
        $this -> adminmonashemail= $adminmonashemail;
    }

    public  function getAdminalternativeemail() {
            return $this -> adminalternativeemail;
    }

    public function setAdminalternativeemail($adminalternativeemail) {
        $this -> adminalternativeemail= $adminalternativeemail;
    }

    public  function getAdminaltcontactnum() {
        return $this -> adminaltcontactnum;
    }

    public function setAdminaltcontactnum($adminaltcontactnum) {
        $this -> adminaltcontactnum = $adminaltcontactnum;
    }










} 