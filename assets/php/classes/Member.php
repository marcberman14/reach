<?php

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";
$user = new UserDao();

class Member {

    private $user_id;
    private $userfirstname;
    private $userlastname;
    private $useremail;
	private $gender;
    private $useractive;
    private $permission_id;
    private $picurl;

    public function __construct(){//$user_id, $userfirstname, $userlastname, $useremail, $useractive, $permission_name, $picurl){
       $this-> user_id = "";//$user_id;
       $this-> userfirstname = "";//$userfirstname;
       $this-> userlastname = "";//$userlastname;
       $this-> useremail = "";//$useremail;
       $this-> useractive = "";//$useractive;
       $this-> permission_id = "";//$permission_name;
       $this-> picurl = "";//$picurl;
    }
	
	public function pullUser($value){
	$user = new UserDao();
	$userDetails = $user->allDetails(Array('userid'=>$value));
   // $currentUser = $_SESSION['user'];
        //$user->setUserID($userDetails['user_id']);
        $this->setUserfirstname($userDetails['firstname']);
        $this->setUserlastname( $userDetails['lastname']);
        $this->setUseremail($userDetails['email']);
        $this->setUseractive($userDetails['active']);
        $this->setPermissionId($userDetails['permission_id']);
		$this->setGender($userDetails['gender']);
     //$_SESSION['user'] = $currentUser;
	}
	
	
	public function updateTeacher($value){
	$user = new UserDao();
	$userDetails = $user->teacherUpdate($value);
   
	}
	
	public function updateTutor($value){
	$user = new UserDao();
	$userDetails = $user->tutorUpdate($value);
   
	}
	
	public function updateStudent($value){
	$user = new UserDao();
	$userDetails = $user->studentUpdate($value);
   
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
	
	
	public function getGender() {
        return $this -> gender;
    }

    public function setGender($gender) {
        $this -> gender = $gender;
    }

    public function getPermissionId() {
        return $this -> permission_id;
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

    public function setPermissionId($permission_id) {
        $this -> permission_id = $permission_id;
    }
}