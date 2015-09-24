<?php
include_once 'db_connect.php';
include_once 'functions.php';
header("Content-Type: application/json", true);

error_reporting(E_ALL);
ini_set('display_errors',1);

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";
$tester = new UserDao();

sec_session_start();

error_reporting(E_ALL);
ini_set('display errors', 1);


$user_id = $_SESSION['user_id'];
$flag = false;

$firstname =$_POST['firstname'];
$surname = $_POST['surname']; 

$email = $_POST['email'];

$teastreetno = $_POST['teastreetno'];//capturing details from HTML form
$teastreetname = $_POST['teastreetname'];
$teasuburb = $_POST['teasuburb'];
$teacity = $_POST['teacity'] ;
$teapostcode = $_POST['teapostcode'];
$teahomeno = $_POST['teahomeno'];
$teacellno = $_POST['teacellno'];
$teaaltno = $_POST['teaaltno'];
$teaschoolemp = $_POST['teaschoolemp'];
$teagratuaght = $_POST['teagratuaght'];

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


if($teastreetno != null){
    $teastreetno = filter_input(INPUT_POST, 'teastreetno', FILTER_SANITIZE_STRING);
    $setvalues["strno"] = $teastreetno; 
}

if($teastreetname != null){
    $teastreetname = filter_input(INPUT_POST, 'teastreetname', FILTER_SANITIZE_STRING);
    $setvalues["strname"] = $teastreetname; 
}

if($teasuburb != null){
    $teasuburb = filter_input(INPUT_POST, 'teasuburb', FILTER_SANITIZE_STRING);
    $setvalues["suburb"] = $teasuburb; 
}

if($teacity != null){
    $teacity = filter_input(INPUT_POST, 'teacity', FILTER_SANITIZE_STRING);
    $setvalues["city"] = $teacity;  
}

if($teapostcode != null){
    $teapostcode = filter_input(INPUT_POST, 'teapostcode', FILTER_SANITIZE_STRING);
    $setvalues["pcode"] = $teapostcode; 
}

if($teahomeno  != null){
    $teahomeno = filter_input(INPUT_POST, 'teahomeno', FILTER_SANITIZE_NUMBER_INT);
    $setvalues["homeno"] = $teahomeno;
}

if($teacellno != null){
    $teacellno = filter_input(INPUT_POST, 'teacellno', FILTER_SANITIZE_NUMBER_INT);
    $setvalues["cellno"] = $teacellno; 
}

if($teaaltno != null){
    $teaaltno = filter_input(INPUT_POST, 'teaaltno', FILTER_SANITIZE_NUMBER_INT);
    $setvalues["altno"] = $teaaltno;  
}

if($teaschoolname != null){
    $teaschoolname = filter_input(INPUT_POST, 'teaschoolname', FILTER_SANITIZE_STRING);
    $setvalues["school"] = $teaschoolname; 
}

if($teagratuaght != null){
    $teagratuaght = filter_input(INPUT_POST, 'teagratuaght', FILTER_SANITIZE_NUMBER_INT);
    $setvalues["tgrade"] = $teagratuaght; 
}

if($password != null and $confirmpaswd != null and $oldpassword !=null and $confirmpaswd = $password){   //potentially separate ifs for error handling
    $saltst = $mysqli->prepare("SELECT salt from members where user_id = ?");
    $saltst->bind_param('s', $user_id);
    $saltst->execute();
    $saltst->store_result();
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
   
var_dump($setvalues);
$tester -> teacherUpdate ($setvalues);






?>