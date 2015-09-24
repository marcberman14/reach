<?php
include_once 'db_connect.php';
include_once 'functions.php';

header("Content-Type: application/json", true);

sec_session_start();

if (isset($_POST['admgender'],$_POST['admdateofbirth'], $_POST['admstreetno'], $_POST['admstreetname'], $_POST['admsuburb'],
$_POST['admcity'], $_POST['admpostcode'], $_POST['admcountry'], $_POST['admhomeno'], $_POST['admcellno'], $_POST['admaltno'],
$_POST['admmail'], $_POST['admwmail'], $_POST['admworknum'], $_POST['admstaffnum'], $_POST['admworkdepart'], $_POST['admworkpos'])) {

    $admgender = filter_input(INPUT_POST, 'admgender', FILTER_SANITIZE_STRING);
    $admdateofbirth = filter_input(INPUT_POST, 'admdateofbirth', FILTER_SANITIZE_STRING);
    $admstreetno = filter_input(INPUT_POST, 'admstreetno', FILTER_SANITIZE_NUMBER_INT) ;
    $admstreetname = filter_input(INPUT_POST, 'admstreetname', FILTER_SANITIZE_STRING);
    $admsuburb = filter_input(INPUT_POST, 'admsuburb', FILTER_SANITIZE_STRING);
    $admcity = filter_input(INPUT_POST, 'admcity', FILTER_SANITIZE_STRING);
    $admpostcode = filter_input(INPUT_POST, 'admpostcode', FILTER_SANITIZE_NUMBER_INT);
    $admcountry = filter_input(INPUT_POST, 'admcountry', FILTER_SANITIZE_EMAIL);
    $admhomeno = filter_input(INPUT_POST, 'admhomeno', FILTER_SANITIZE_NUMBER_INT);
    $admcellno = filter_input(INPUT_POST, 'admcellno', FILTER_SANITIZE_NUMBER_INT);
    $admaltno = filter_input(INPUT_POST, 'admaltno', FILTER_SANITIZE_NUMBER_INT);
    $admmail = filter_input(INPUT_POST, 'admmail', FILTER_VALIDATE_EMAIL);
    $admwmail = filter_input(INPUT_POST, 'admwmail', FILTER_VALIDATE_EMAIL);
    $admworknum = filter_input(INPUT_POST, 'admworknum', FILTER_SANITIZE_NUMBER_INT);
    $admstaffnum = filter_input(INPUT_POST, 'admstaffnum', FILTER_SANITIZE_NUMBER_INT);
    $admworkdepart = filter_input(INPUT_POST, 'admworkdepart', FILTER_SANITIZE_STRING);
    $admworkpos = filter_input(INPUT_POST, 'admworkpos', FILTER_SANITIZE_STRING);

    if (isset($_SESSION['user_id'], $_SESSION['username'],$_SESSION['login_string'])) {
        $admdateofbirth = date("Y-m-d", strtotime($admdateofbirth));
        $user_id = $_SESSION['user_id'];

        if ($insert_stmt = $mysqli->prepare("INSERT INTO adminstrator(user_id, gender, dob, streetnumber,
                                                          streetname, suburb, city, country, postalcode, homenumber,
                                                           cellphone, worknumber, staffnumber, jobdepartment,
                                                            jobposition, monashmail, alternativeemail, altcontactnum)
                                                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"))
        {

            $insert_stmt->bind_param('isssssssssssssssss',$user_id, $admgender, $admdateofbirth, $admstreetno,
                $admstreetname, $admsuburb, $admcity, $admcountry, $admpostcode,
                $admhomeno, $admcellno, $admworknum, $admstaffnum, $admworkdepart,
                $admworkpos, $admwmail, $admmail, $admaltno);

            if ($insert_stmt->execute()) {
                if ($insert_stmt = $mysqli->prepare("UPDATE members SET active=? WHERE user_id=?")) {
                    $active ="active";
                    $insert_stmt->bind_param('si', $active, $user_id);
                    if ($insert_stmt->execute()) {
                        $arrResult = array ('response'=>'success');
                        echo json_encode($arrResult);
                    } else {
                        $arrResult = array('response' => 'error', 'reason' => 'An error occured while activating your profile, please contact an administrator to have it activated manually.');
                        echo json_encode($arrResult);
                    }
                } else {
                    echo mysqli_error($mysqli);
                    $arrResult = array('response' => 'error', 'reason' => 'A fatal error occurred. Please try again later.');
                    echo json_encode($arrResult);
                }
            } else {
                echo mysqli_error($mysqli);
                $arrResult = array ('response'=>'error','reason'=>'You have already completed your profile. Please proceed to your portal to continue.');
                echo json_encode($arrResult);
            }
        } else {
            echo mysqli_error($mysqli);
            $arrResult = array('response' => 'error', 'reason' => 'A fatal error occurred. Please try again later.');
            echo json_encode($arrResult);
        }
    }
    else {
        echo mysqli_error($mysqli);
        $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
        echo json_encode($arrResult);
    }

}


else {
    $arrResult = array ('response'=>'error','reason'=>'Please ensure you have entered all the required fields.');
    echo json_encode($arrResult);
}

?>