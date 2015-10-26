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

$users = new UserDao();

$user_id = $_SESSION['user']->getUserID();
$flag = false;

$oldpassword = $_POST['oldpassword']; 
$password = $_POST['password'];
$confirmpasword = $_POST['confirmpwd']; 

$setvaluespass = array();

$setvaluespass["userid"] = $user_id;    

if(isset($_POST['password']) and isset($_POST['confirmpwd']) and isset($_POST['oldpassword'])){
	$oldpassword = $_POST['oldpassword']; 
	$password = $_POST['password'];
	$confirmpasword = $_POST['confirmpwd'];
    if($confirmpasword == $password){  
		 
		
	  	//THIS LINE IS DONE BY THE AJAX FILE NB!!!!!!!!!!!!! remove once the ajax is working
        $password = hash('sha512', $password);
		
        $array = array("user_id"=>$user_id);
        $saltst = $users->password($array);
		//user salt from db
        $usersalt = $saltst['salt'];
		//user password from db
        $curpass = $saltst['password'];
		
		//THIS LINE IS DONE BY THE AJAX FILE NB!!!!!!!!!!!!! remove once the ajax is working
		$oldpassword = hash('sha512', $oldpassword);
        $saltypass = hash('sha512', $oldpassword . $usersalt);
        //$saltyold = hash('sha512', $curpass . $usersalt);
        if($saltypass == $curpass){
            $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
            $newhashedpassword = hash('sha512', $password . $random_salt);
            $setvaluespass["pass"] = $newhashedpassword;
            $setvaluespass["salt"] = $random_salt; 
            $users -> passwordUpdate ($setvaluespass);
        }        
        else{
             echo "error: the old password you entered is incorrect";
        }
    }
    else{
        echo "error: ensure new password matches confirm password"; //error reporting here
    }
}
else{
    echo "error: ensure all fields are complete"; //error reporting here
}


//if($password != null and $confirmpaswd != null and $oldpassword !=null and $confirmpaswd = $password){   //potentially separate ifs for error handling

//$array = array("user_id"=>$user_id);



//    $saltst = $tester->passwprd($array);
	  
//    $saltst->bind_result($salt);
//    $saltst->fetch();
//    $saltypass = hash('sha512', $oldpassword . $salt);//retrieve password salt from database
 //   if($saltypass == $oldpassword){  //if statement to compare old password----give error
//        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
//        $newhashedpassword = hash('sha512', $password . $random_salt);     //hash new password
 //       $setvaluespass["pass"] = $random_salt;
 //       $setvaluespass["salt"] = $newhashedpassword; 
  //  }  
//
//}




?>