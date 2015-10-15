<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/ProfileDao.php";

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";
$user = new UserDao();
$security = new Security();
$profiles = new ProfileDao();
$security->sec_session_start();
session_cache_limiter('nocache');

header("Content-Type: application/json", true);

if (!empty($_POST['teacountry'])) {
    if (isset($_POST['teadateofbirth'], $_POST['teastreetno'], $_POST['teastreetname'], $_POST['teasuburb'],
        $_POST['teacity'], $_POST['teapostcode'], $_POST['teacountry'], $_POST['teahomeno'], $_POST['teacellno'], $_POST['teaaltno'],
        $_POST['teamail'], $_POST['teastudy'], $_POST['teaschoolemp'], $_POST['teaexper'], $_POST['teaschooladdress'], $_POST['teaschcon'],
        $_POST['teagrataught'])) {

        // Sanitize and validate the data passed in
        $teadateofbirth = $_POST['teadateofbirth'];
        $teastreetno = filter_input(INPUT_POST, 'teastreetno', FILTER_SANITIZE_NUMBER_INT);
        $teastreetname = filter_input(INPUT_POST, 'teastreetname', FILTER_SANITIZE_STRING);
        $teasuburb = filter_input(INPUT_POST, 'teasuburb', FILTER_SANITIZE_STRING);
        $teacity = filter_input(INPUT_POST, 'teacity', FILTER_SANITIZE_STRING);
        $teapostcode = filter_input(INPUT_POST, 'teapostcode', FILTER_SANITIZE_NUMBER_INT);
        $teacountry = filter_input(INPUT_POST, 'teacountry', FILTER_SANITIZE_STRING);
        $teahomeno = filter_input(INPUT_POST, 'teahomeno', FILTER_SANITIZE_NUMBER_INT);
        $teacellno = filter_input(INPUT_POST, 'teacellno', FILTER_SANITIZE_NUMBER_INT);
        $teaaltno = filter_input(INPUT_POST, 'teaaltno', FILTER_SANITIZE_NUMBER_INT);
        $teamail = filter_input(INPUT_POST, 'teamail', FILTER_SANITIZE_EMAIL);
        $teastudy = filter_input(INPUT_POST, 'teastudy', FILTER_SANITIZE_STRING);
        $teaschoolemp = filter_input(INPUT_POST, 'teaschoolemp', FILTER_SANITIZE_STRING);
        $teaexper = filter_input(INPUT_POST, 'teaexper', FILTER_SANITIZE_NUMBER_INT);
        $teaschooladdress = filter_input(INPUT_POST, 'teaschooladdress', FILTER_SANITIZE_STRING);
        $teaschcon = filter_input(INPUT_POST, 'teaschcon', FILTER_SANITIZE_NUMBER_INT);
        $teagrataught = filter_input(INPUT_POST, 'teagrataught', FILTER_SANITIZE_NUMBER_INT);


        if (isset($_SESSION['user_id'], $_SESSION['login_string'])) {
            $profiles = new ProfileDao();
            $user = new UserDao();

            $teadateofbirth = date("Y-m-d", strtotime($teadateofbirth));
            $user_id = $_SESSION['user_id'];
            $flag = false;

            $array = array("userId"=>$user_id,"schoolemployed"=>$teaschoolemp,"teachinggrade"=>$teagrataught,
                "yearsexperience"=>$teaexper,"cellnumber"=>$teacellno,"alternativenumber"=>$teaaltno,
                "personalemail"=>$teamail,"dob"=>$teadateofbirth,"schooladdress"=>$teaschooladdress,
                "schoolcontact"=>$teaschcon,"streetnumber"=>$teastreetno,"streetname"=>$teastreetname,
                "suburb"=>$teasuburb,"city"=>$teacity,"country"=>$teacountry,"postalcode"=>$teapostcode,
                "sujectstaught"=>$teagrataught);
            if ($user->updateActive(Array("active"=> "active", "userid"=>$user_id)) == 1 && $user->insertTeacher($array) == 1) {
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
        $arrResult = array ('response'=>'error','reason'=>'Please ensure you have entered all the required fields.');
        echo json_encode($arrResult);
    }
} else {
    $arrResult = array ('response'=>'error','reason'=>'Please ensure you have selected a country.');
    echo json_encode($arrResult);
}
?>