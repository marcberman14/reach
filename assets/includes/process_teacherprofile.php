<?php
include_once 'db_connect.php';
include_once 'functions.php';

sec_session_start();

header("Content-Type: application/json", true);

if (!empty($_POST['teacountry'])) {
    if (isset($_POST['teagender'],$_POST['teadateofbirth'], $_POST['teastreetno'], $_POST['teastreetname'], $_POST['teasuburb'],
        $_POST['teacity'], $_POST['teapostcode'], $_POST['teacountry'], $_POST['teahomeno'], $_POST['teacellno'], $_POST['teaaltno'],
        $_POST['teamail'], $_POST['teastudy'], $_POST['teaschoolemp'], $_POST['teaexper'], $_POST['teaschooladdress'], $_POST['teaschcon'],
        $_POST['teagrataught'])) {

        // Sanitize and validate the data passed in
        $teagender = filter_input(INPUT_POST, 'teagender', FILTER_SANITIZE_STRING);
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

        if (isset($_SESSION['user_id'], $_SESSION['username'],$_SESSION['login_string'])) {
            $teadateofbirth = date("Y-m-d", strtotime($teadateofbirth));
            $user_id = $_SESSION['user_id'];
            // Insert the new user into the database
            if ($stmt = $mysqli->prepare("INSERT INTO teacher(userId, schoolemployed, teachinggrade, yearsexperience, cellnumber, alternativenumber, personalemail, dob, schooladdress, schoolcontact, streetnumber, streetname, suburb, city, country, postalcode, sujectstaught) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")) {
                $stmt->bind_param('issssssssssssssss', $user_id, $teaschoolemp, $teagrataught, $teaexper, $teacellno, $teaaltno, $teamail, $teadateofbirth, $teaschooladdress, $teaschcon, $teastreetno, $teastreetname, $teasuburb, $teacity, $teacountry, $teapostcode, $teagrataught);
                // Execute the prepared query.
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
                $arrResult = array ('response'=>'error','reason'=>'Teacher Registration failed, if this problem persists please contact an administrator.');
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