<?php
include_once 'db_connect.php';
include_once 'functions.php';

session_cache_limiter('nocache');

header("Content-Type: application/json", true);
 
sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['email'], $_POST['hashedPassword'])) {
    $email = $_POST['email'];
    $password = $_POST['hashedPassword']; // The hashed password.
    $login = login($email, $password, $mysqli);
    echo json_encode($login);

} else {
    // The correct POST variables were not sent to this page. 
    $arrResult = array ('response'=>'error','reason'=>'An unknown error occurred.');
    echo json_encode($arrResult);
}

?>