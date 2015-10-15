<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();

session_cache_limiter('nocache');

header("Content-Type: application/json", true);

if (isset($_POST['email'], $_POST['hashedPassword'])) {
    $email = $_POST['email'];
    $password = $_POST['hashedPassword']; // The hashed password.
    $login = $security->login($email, $password);

    echo json_encode($login);

} else {
    // The correct POST variables were not sent to this page. 
    $arrResult = array ('response'=>'error','reason'=>'An unknown error occurred.');
    echo json_encode($arrResult);
}

?>