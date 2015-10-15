<?php
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/ProfileDao.php";
$security = new Security();
$profiles = new ProfileDao();
$security->sec_session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);


session_cache_limiter('nocache');

header("Content-Type: application/json", true);

$tester = new UserDao();

$user_id = $_SESSION['user']->getUserID();
$flag = false;

$firstname =$_POST['firstname'];
$surname = $_POST['surname']; 

$email = $_POST['email'];

$stustreetno = $_POST['stustreetno'];//capturing details from HTML form
$stustreetname = $_POST['stustreetname'];
$stusuburb = $_POST['stusuburb'];
$stucity = $_POST['stucity'] ;
$stupostcode = $_POST['stupostcode'];
$stuhomeno = $_POST['stuhomeno'];
$stucellno = $_POST['stucellno'];
$stualtno = $_POST['stualtno'];
$stuparentno = $_POST['stuparentno'];
$stuschoolname = $_POST['stuschoolname'];

$oldpassword = $_POST['oldpassword']; 
$password = $_POST['password'];
$confirmpaswd = $_POST['confirmpwd']; 

$setvalues = array();
$setvaluespass = array();

$setvalues["userid"] = $user_id;    


if($firstname != null){
    //validtion happens here
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    //databaseing happens here
    $setvalues["fname"] = $firstname;
    
}

if($surname != null){
    $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
    $setvalues["sname"] = $surname;
}

if($email != null){
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $arrResult = array ('response'=>'error','reason'=>'Invalid email address, please try again.');
        echo json_encode($arrResult);
    }
    
     $setvalues["mail"] = $email ;
}


if($stustreetno != null){
    $stustreetno = filter_input(INPUT_POST, 'stustreetno', FILTER_SANITIZE_STRING);
    $setvalues["strno"] = $stustreetno; 
}

if($stustreetname != null){
    $stustreetname = filter_input(INPUT_POST, 'stustreetname', FILTER_SANITIZE_STRING);
    $setvalues["strname"] = $stustreetname; 
}

if($stusuburb != null){
    $stusuburb = filter_input(INPUT_POST, 'stusuburb', FILTER_SANITIZE_STRING);
    $setvalues["suburb"] = $stusuburb; 
}

if($stucity != null){
    $stucity = filter_input(INPUT_POST, 'stucity', FILTER_SANITIZE_STRING);
    $setvalues["city"] = $stucity;  
}

if($stupostcode != null){
    $stupostcode = filter_input(INPUT_POST, 'stupostcode', FILTER_SANITIZE_STRING);
    $setvalues["pcode"] = $stupostcode; 
}

if($stuhomeno  != null){
    $stuhomeno = filter_input(INPUT_POST, 'stuhomeno', FILTER_SANITIZE_NUMBER_INT);
    $setvalues["homeno"] = $stuhomeno;
}

if($stucellno != null){
    $stucellno = filter_input(INPUT_POST, 'stucellno', FILTER_SANITIZE_NUMBER_INT);
    $setvalues["cellno"] = $stucellno; 
}

if($stualtno != null){
    $stualtno = filter_input(INPUT_POST, 'stualtno', FILTER_SANITIZE_NUMBER_INT);
    $setvalues["altno"] = $stualtno;  
}

if($stuparentno != null){
    $stuparentno = filter_input(INPUT_POST, 'stuparentno', FILTER_SANITIZE_NUMBER_INT);
    $setvalues["parno"] = $stuparentno; 
}

if($stuschoolname != null){
    $stuschoolname = filter_input(INPUT_POST, 'stuschoolname', FILTER_SANITIZE_STRING);
    $setvalues["school"] = $stuschoolname; 
}

if($password != null and $confirmpaswd != null and $oldpassword !=null and $confirmpaswd = $password){   //potentially separate ifs for error handling

$array = array("user_id"=>$user_id);



    $saltst = $tester->passwprd($array);
	  
    $saltst->bind_result($salt);
    $saltst->fetch();
    $saltypass = hash('sha512', $oldpassword . $salt);//retrieve password salt from database
    if($saltypass == $oldpassword){  //if statement to compare old password----give error
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
        $newhashedpassword = hash('sha512', $password . $random_salt);     //hash new password
        $setvaluespass["pass"] = $random_salt;
        $setvaluespass["salt"] = $newhashedpassword; 
    }  

}
   
//var_dump($setvalues);

$tester -> studentUpdate ($setvalues);

echo "Jet fuel can't melt steel beams";




?>