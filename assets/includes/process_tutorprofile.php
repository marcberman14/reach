<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/ProfileDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";

$security = new Security();
$security->sec_session_start();

header("Content-Type: application/json", true);
session_cache_limiter('nocache');

if (isset($_POST['tutdob'], $_POST['tutstreetno'], $_POST['tutstreetname'],
    $_POST['tutsuburb'], $_POST['tutcity'], $_POST['tutpostcode'], $_POST['tutcountry'],$_POST['tutresidence'], $_POST['tutnationality'],
    $_POST['tutcellno'], $_POST['tutaltno'], $_POST['tutpemail'], $_POST['tutstunum'], $_POST['tutstudyyear'],
    $_POST['tutmemail'], $_POST['tutareastud'])) {

    $tutdob = $_POST['tutdob'];
    $tutstreetno = filter_input(INPUT_POST, 'tutstreetno', FILTER_SANITIZE_NUMBER_INT);
    $tutstreetname = filter_input(INPUT_POST, 'tutstreetname', FILTER_SANITIZE_STRING);
    $tutsuburb = filter_input(INPUT_POST, 'tutsuburb', FILTER_SANITIZE_STRING);
    $tutcity = filter_input(INPUT_POST, 'tutcity', FILTER_SANITIZE_STRING);
    $tutpostcode = filter_input(INPUT_POST, 'tutpostcode', FILTER_SANITIZE_STRING);
    $tutcountry = filter_input(INPUT_POST, 'tutcountry', FILTER_SANITIZE_STRING);
    $tutresidence = filter_input(INPUT_POST, 'tutresidence', FILTER_SANITIZE_STRING);
    $tutnationality = filter_input(INPUT_POST, 'tutnationality', FILTER_SANITIZE_STRING);
    $tutcellno = filter_input(INPUT_POST, 'tutcellno', FILTER_SANITIZE_NUMBER_INT);
    $tutaltno = filter_input(INPUT_POST, 'tutaltno', FILTER_SANITIZE_NUMBER_INT);
    $tutpmail = filter_input(INPUT_POST, 'tutpemail', FILTER_SANITIZE_EMAIL);
    $tutstunum = filter_input(INPUT_POST, 'tutstunum', FILTER_SANITIZE_STRING);
    $tutstudyyear = filter_input(INPUT_POST, 'tutstudyyear', FILTER_SANITIZE_NUMBER_INT);
    $tutmemmail = filter_input(INPUT_POST, 'tutmemail', FILTER_SANITIZE_EMAIL);
    $tutareastud = filter_input(INPUT_POST, 'tutareastud', FILTER_SANITIZE_STRING);

    if (isset($_SESSION['user_id'], $_SESSION['login_string'])) {
        $profiles = new ProfileDao();
        $user = new UserDao();

        $tutdob = date("Y-m-d", strtotime($tutdob));
        $user_id = $_SESSION['user_id'];
        $flag = false;

        $array = array("user_id"=>$user_id,"dob"=>$tutdob,"cellnumber"=>$tutcellno,"alternativenumber"=> $tutaltno,
            "streetnumber"=>$tutstreetno,"streetname"=>$tutstreetname,"suburb"=>$tutsuburb,"city"=>$tutcity,
            "country"=>$tutcountry,"postalcode"=>$tutpostcode,"nationality"=>$tutnationality,
            "countryresidence"=>$tutresidence,"studyarea"=>$tutareastud,"studyyear"=>$tutstudyyear,
            "studentnumber"=>$tutstunum,"personalemail"=>$tutpmail,"monashemail"=>$tutmemmail);
        $result = $user->insertTutor($array);
        $resultUpdate = $user->updateActive(Array("active"=> "active", "userid"=>$user_id));
        if ($result == 1 && $resultUpdate == 1) {
            $arrResult = array ('response'=>'success');
            echo json_encode($arrResult);

        } else {
            $arrResult = array ('response'=>'error','reason'=>'You have already completed your profile. Please proceed to your portal to continue.');
            echo json_encode($arrResult);
        }
    } else {
        $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
        echo json_encode($arrResult);
    }

} else {
    $arrResult = array('response' => 'error', 'reason' => 'Please ensure you have completed all the required fields.');
    echo json_encode($arrResult);
}
?>