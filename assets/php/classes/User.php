<?php

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";
$user = new UserDao();

class User {

    private $user_id;
    private $userfirstname;
    private $userlastname;
    private $useremail;
    private $useractive;
    private $permission_name;
    private $permission_id;
    private $picurl;
    private $gender;

    public function __construct($user_id, $userfirstname, $userlastname, $useremail, $useractive, $permission_name, $picurl, $gender){
       $this-> user_id = $user_id;
       $this-> userfirstname = $userfirstname;
       $this-> userlastname = $userlastname;
       $this-> useremail = $useremail;
       $this-> useractive = $useractive;
       $this-> permission_name = $permission_name;
       $this-> picurl = $picurl;
       $this-> gender = $gender;
    }
	
	public function pullUser($value){
	$user = new UserDao();
	$userDetails = $user->allDetails(Array('userid'=>$value));
    $currentUser = $_SESSION['user'];
        $currentUser->setUserID( $userDetails['user_id']);
        $currentUser->setUserfirstname($userDetails['firstname']);
        $currentUser->setUserlastname( $userDetails['lastname']);
        $currentUser->setUseremail($userDetails['email']);
        $currentUser->setUseractive($userDetails['active']);
        $currentUser->setPermissionName($userDetails['permission_name']);
     $_SESSION['user'] = $currentUser;
	}


    public function getUserID() {		
        return $this -> user_id;
    }
	
    public function getUserlastname() {
        return $this -> userlastname;
    }

    public function getUserfirstname() {
        return $this -> userfirstname;
    }

    public function getUseremail(){
        return $this -> useremail;
    }

    public function getUserActive() {
        return $this -> useractive;
    }

    public function getPermissionName() {
        return $this -> permission_name;
    }
    
     public function getPermissionID() {
        return $this -> permission_id;
    }

    public function getPicUrl() {
        return $this -> picurl;
    }

    public function getGender() {
        return $this -> gender;
    }

    public function setUserID($user_id) {
        $this -> user_id = $user_id;
    }

    public function setUserfirstname($userfirstname) {
        $this -> userfirstname = $userfirstname;
    }

    public function setUserlastname($userlastname) {
        $this -> userlastname = $userlastname;
    }

    public function setUseremail($useremail) {
        $this -> useremail = $useremail;
    }

    public function setUseractive($useractive) {
        $this -> useractive = $useractive;
    }

    public function setPermissionName($permission_name) {
        $this -> permission_name = $permission_name;
    }

    public function setPicUrl($picurl) {
        $this -> picurl = $picurl;
    }

    public function setGender($genderl) {
        $this -> genderl = $genderl;
    }

}