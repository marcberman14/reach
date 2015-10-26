<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();

session_cache_limiter('nocache');

header("Content-Type: application/json", true);

if (isset($_POST['action'])) {
    echo json_encode($security->resendEmail());
} else {
    $arrResult = array ('response'=>'error','reason'=>'An unknown error occurred.');
    echo json_encode($arrResult);
}

?>