<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/SecurityDao.php";
$security = new Security();
$security->sec_session_start();

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";
$user = new UserDao();

header("Content-Type: application/json", true);

if (isset($_POST['firstname'],$_POST['surname'], $_POST['email'], $_POST['usertype'],  $_POST['gender'])) {
    // Sanitize and validate the data passed in
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
	$gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
	
	
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $arrResult = array ('response'=>'error','reason'=>'Invalid email address, please try again.');
        echo json_encode($arrResult);
    }
    $usertype = filter_input(INPUT_POST, 'usertype', FILTER_SANITIZE_STRING);

    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
	
	$array = array("email"=>$email);
	
	$check = $user->checkUser($array);

    //$prep_stmt = "SELECT user_id FROM members WHERE email = ? LIMIT 1";
    //$stmt = $mysqli->prepare($prep_stmt);

    // check existing email
   

        if ($check == true) {
            // A user with this email address already exists
            $arrResult = array ('response'=>'error','reason'=>'A user with this email address already exists.');
            echo json_encode($arrResult);
            $stmt->close();
            exit;
        }
    


    if (empty($arrResult)) {
        //generate password
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for($i = 0; $i < 20; $i++){
            $randomString .= $characters[rand(0, $charactersLength -1)];
        }
        
        // Create a random salt
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

        // Create salted password 
        $password = hash('sha512', $randomString . $random_salt);
        $active = "emailverify";
        $profilepic = "default.png";
        // Insert the new user into the database
		
		$array = array("permissionid"=>$usertype,"firstname"=>$firstname,"lastname"=>$surname,"email"=>$email,"password"=>$password,"salt"=>$random_salt,"active"=>$active,"profilepicurl"=>$profilepic,"gender"=>$gender);
		
		$results = $user->insertUser($array);
		
       
           
            // Execute the prepared query.
            if ($results == false) {
                $arrResult = array ('response'=>'error','reason'=>'"Registration failed, if this problem persists please contact an administrator.');
                echo json_encode($arrResult);
            } else {
                $to = $email;
                $subject = 'Reach account created';
                $message = "
                From: Reach
                Sent by mar@bermanz.co.za";
                $header = "From: marc@bermanz.co.za";
                
                
                if(mail($email, $subject, $message, $header)){
                    $feedback = 'Your message has been successfully sent';
                    $headerRep = "From: marc@bermanz.co.za <marc@bermanz.co.za>";
                    $subjectRep = "Reach Account Creation";
                    $messageRep = "Your Account has been created. Your password is: " . $randomString;
                    mail($email, $subject, $message, $header);

                    $hash = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
                    $sec_login = new SecurityDao();
                    $sec_login->insertHash($email, $hash);
                    $emailsent = $security->sendEmail($email, $hash);
                    if($emailsent){
                        $arrResult = array ('response'=>'success','reason'=>'User has been succesfully created.');
                        echo json_encode($arrResult);
                    }
                    else{
                        $arrResult = array ('response'=>'error','reason'=>'Activation email failed to send.');
                        echo json_encode($arrResult);
                    }
                }
                else{
                    $arrResult = array ('response'=>'error','reason'=>'Notification Email failed to send.');
                    echo json_encode($arrResult);
                }
            }
    }else {
        $arrResult = array ('response'=>'error','reason'=>'A fatal error has occurred, if this problem persists please contact an administrator.');
        echo json_encode($arrResult);
    }
} else {
    $arrResult = array ('response'=>'error','reason'=>'Please ensure you have entered all the required fields.');
    echo json_encode($arrResult);
}

?>