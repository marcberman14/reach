<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();

session_cache_limiter('nocache');

header("Content-Type: application/json", true);

if (isset($_POST['firstname'],$_POST['surname'], $_POST['email'], $_POST['hashedPassword'], $_POST['usertype'], $_POST['gender'])) {
    // Sanitize and validate the data passed in
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $arrResult = array ('response'=>'error','reason'=>'Invalid email address, please try again.');
        echo json_encode($arrResult);
        exit;
    }
    $usertype = filter_input(INPUT_POST, 'usertype', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'hashedPassword', FILTER_SANITIZE_STRING);

    echo json_encode($security->register($firstname, $lastname, $email, $password, $usertype, $gender));

} else {
    $arrResult = array ('response'=>'error','reason'=>'Please ensure you have entered all the required fields.');
    echo json_encode($arrResult);
}

?>