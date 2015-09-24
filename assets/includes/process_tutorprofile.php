<?php
include_once 'db_connect.php';
include_once 'functions.php';

header("Content-Type: application/json", true);

sec_session_start();

if (isset($_POST['tutgender'], $_POST['tutdob'], $_POST['tutstreetno'], $_POST['tutstreetname'],
    $_POST['tutsuburb'], $_POST['tutcity'], $_POST['tutpostcode'], $_POST['tutcountry'],$_POST['tutresidence'], $_POST['tutnationality'],
    $_POST['tutcellno'], $_POST['tutaltno'], $_POST['tutpemail'], $_POST['tutstunum'], $_POST['tutstudyyear'],
    $_POST['tutmemail'], $_POST['tutareastud'])) {

    $tutgender = filter_input(INPUT_POST, 'tutgender', FILTER_SANITIZE_STRING);
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

    if (isset($_SESSION['user_id'], $_SESSION['username'],$_SESSION['login_string'])) {
        $tutdob = date("Y-m-d", strtotime($tutdob));
        $user_id = $_SESSION['user_id'];

        if ($stmt = $mysqli->prepare("INSERT INTO tutor(userId, dob, cellnumber, alternativenumber, streetnumber,
                                                            streetname, suburb, city, country, postalcode, nationality,
                                                            countryresidence, studyarea, studyyear, studentnumber,
                                                            personalemail, gender, monashemail) VALUES
                                                            (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")) {
            $stmt->bind_param('isssssssssssssssss', $user_id, $tutdob, $tutcellno,  $tutaltno, $tutstreetno,
                                                    $tutstreetname, $tutsuburb, $tutcity, $tutcountry, $tutpostcode, $tutnationality,
                                                    $tutresidence, $tutareastud, $tutstudyyear,  $tutstunum,
                                                    $tutpmail, $tutgender, $tutmemmail);
            if ($stmt->execute()) {
                if ($stmt = $mysqli->prepare("UPDATE members SET active=? WHERE user_id=?")) {
                    $active ="active";
                    $stmt->bind_param('si', $active, $user_id);
                    if ($stmt->execute()) {
                        $arrResult = array ('response'=>'success');
                        echo json_encode($arrResult);
                    } else {
                        $arrResult = array('response' => 'error', 'reason' => 'An error occured while activating your profile, please contact an administrator to have it activated manually.');
                        echo json_encode($arrResult);
                    }
                } else {
                    $arrResult = array('response' => 'error', 'reason' => 'A fatal error occurred. Please try again later.');
                    echo json_encode($arrResult);
                }
            } else {
                $arrResult = array ('response'=>'error','reason'=>'You have already completed your profile. Please proceed to your portal to continue.');
                echo json_encode($arrResult);
            }
        } else {
            $arrResult = array('response' => 'error', 'reason' => 'A fatal error occurred. Please try again later.');
            echo json_encode($arrResult);
        }
    }
    else {
        $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
        echo json_encode($arrResult);
    }

}


else {
    $arrResult = array ('response'=>'error','reason'=>'Please ensure you have entered all the required fields.');
    echo json_encode($arrResult);
}

?>