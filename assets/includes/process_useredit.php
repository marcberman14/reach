<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/UserDao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/ProfileDao.php";
$security = new Security();
$profiles = new ProfileDao();
$security->sec_session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


session_cache_limiter('nocache');

header("Content-Type: application/json", true);


$type = $_GET['type'];//$_SESSION['user']->getPermissionName();
$id = $_GET['id'];//$_SESSION['user']->getUserID();


header("Content-Type: application/json", true);

// $f = $_POST['firstname'];
//$s = $_POST['surname'];
//$e = $_POST['email'];


echo $type;

if (isset($_POST['firstname'], $_POST['surname'], $_POST['email'], $_POST['active'], $_POST['gender'])) {

    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
    $active = filter_input(INPUT_POST, 'active', FILTER_SANITIZE_STRING);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);


    if ($type == 1) {

        if (isset($_POST['stustreetno'], $_POST['stustreetname'], $_POST['stusuburb'], $_POST['stucity'], $_POST['stupostcode'], $_POST['stuhomeno'], $_POST['stucountry'], $_POST['stugrade'], $_POST['stucellno'], $_POST['stualtno'], $_POST['stuparentno'], $_POST['stuschoolname'])) {


            // Sanitize and validate the data passed in

            $streetnumber = filter_input(INPUT_POST, 'stustreetno', FILTER_SANITIZE_NUMBER_INT);
            $streetname = filter_input(INPUT_POST, 'stustreetname', FILTER_SANITIZE_STRING);
            $suburb = filter_input(INPUT_POST, 'stusuburb', FILTER_SANITIZE_STRING);
            $city = filter_input(INPUT_POST, 'stucity', FILTER_SANITIZE_STRING);
            $postalcode = filter_input(INPUT_POST, 'stupostcode', FILTER_SANITIZE_NUMBER_INT);
            $country = filter_input(INPUT_POST, 'stucountry', FILTER_SANITIZE_STRING);
            $grade = filter_input(INPUT_POST, 'stugrade', FILTER_SANITIZE_STRING);
            $homenumber = filter_input(INPUT_POST, 'stuhomeno', FILTER_SANITIZE_NUMBER_INT);
            $cellnumber = filter_input(INPUT_POST, 'stucellno', FILTER_SANITIZE_NUMBER_INT);
            $altnumber = filter_input(INPUT_POST, 'stualtno', FILTER_SANITIZE_NUMBER_INT);
            $parentno = filter_input(INPUT_POST, 'stuparentno', FILTER_SANITIZE_NUMBER_INT);
            $schoolname = filter_input(INPUT_POST, 'stuschoolname', FILTER_SANITIZE_STRING);

            //$subjectid = $_POST['subject_id'];
            $array = array("fname" => $firstname, "sname" => $lastname, "mail" => $email, "active" => $active, "gender" => $gender, "strno" => $streetnumber, "strname" => $streetname, "suburb" => $suburb, "city" => $city, "country" => $country, "pcode" => $postalcode, "homeno" => $homenumber, "cellno" => $cellnumber, "altno" => $altnumber, "parno" => $parentno, "school" => $schoolname, "grade" => $grade, "userid" => $id);


            $result = $user->studentUpdate($array);
            if ($result > 1) {
                $arrResult = array('response' => 'Success', 'reason' => 'User has been successfully updated. You will be redirected shortly.');
                echo json_encode($arrResult);
            } else {
                $arrResult = array('response' => 'error', 'reason' => 'This user could not be updated.');
                echo json_encode($arrResult);
            }


        } else {
            $arrResult = array('response' => 'error', 'reason' => 'Please ensure you have entered all the required fields.');
            echo json_encode($arrResult);
        }
    } elseif ($type == 2) {


        if (isset($_POST['tutcellno'], $_POST['tutaltno'], $_POST['tutstreetno'], $_POST['tutstreetname'], $_POST['tutsuburb'], $_POST['tutcity'], $_POST['tutcountry'], $_POST['tutpostcode'], $_POST['tutnationality'], $_POST['tutcountryofres'], $_POST['tutsarea'], $_POST['tutsyear'], $_POST['tutstudentnumber'], $_POST['tutmonashemail'])) {

            $cellnumber = filter_input(INPUT_POST, 'tutcellno', FILTER_SANITIZE_NUMBER_INT);
            $altnumber = filter_input(INPUT_POST, 'tutaltno', FILTER_SANITIZE_NUMBER_INT);
            $streetnumber = filter_input(INPUT_POST, 'tutstreetno', FILTER_SANITIZE_NUMBER_INT);
            $streetname = filter_input(INPUT_POST, 'tutstreetname', FILTER_SANITIZE_STRING);

            $suburb = filter_input(INPUT_POST, 'tutsuburb', FILTER_SANITIZE_STRING);
            $city = filter_input(INPUT_POST, 'tutcity', FILTER_SANITIZE_STRING);
            $country = filter_input(INPUT_POST, 'tutcountry', FILTER_SANITIZE_STRING);
            $postalcode = filter_input(INPUT_POST, 'tutpostcode', FILTER_SANITIZE_NUMBER_INT);

            $nationality = filter_input(INPUT_POST, 'tutnationality', FILTER_SANITIZE_STRING);
            $countryres = filter_input(INPUT_POST, 'tutcountryofres', FILTER_SANITIZE_STRING);
            $studyarea = filter_input(INPUT_POST, 'tutsarea', FILTER_SANITIZE_STRING);
            $studyyear = filter_input(INPUT_POST, 'tutsyear', FILTER_SANITIZE_NUMBER_INT);

            $studentno = filter_input(INPUT_POST, 'tutstudentnumber', FILTER_SANITIZE_NUMBER_INT);
            $mail = filter_input(INPUT_POST, 'tutmonashemail', FILTER_SANITIZE_EMAIL);


            $array = array("fname" => $firstname, "sname" => $lastname, "mail" => $email, "active" => $active, "gender" => $gender, "strno" => $streetnumber, "strname" => $streetname, "suburb" => $suburb, "city" => $city, "pcode" => $postalcode, "cellno" => $cellnumber, "altno" => $altnumber, "studyarea" => $studyarea, "studyyear" => $studyyear, "country" => $country, "nationality" => $nationality, "res" => $countryres, "tutstuno" => $studentno, "mmail" => $mail, "userid" => $id);

            $result = $user->tutorUpdate($array);
            if ($result > 1) {
                $arrResult = array('response' => 'Success', 'reason' => 'User has been successfully updated. You will be redirected shortly.');
                echo json_encode($arrResult);
            } else {
                $arrResult = array('response' => 'error', 'reason' => 'This user could not be updated.');
                echo json_encode($arrResult);
            }
        } else {
            $arrResult = array('response' => 'error', 'reason' => 'Please ensure you have entered all the required fields.');
            echo json_encode($arrResult);
        }


    } elseif ($type == 3) {
        if (isset($_POST['teaschoolemp'], $_POST['teagradtaught'], $_POST['teayearsofexperience'], $_POST['teacellno'], $_POST['teaaltno'], $_POST['teapersonalemail'], $_POST['teaschooladdress'], $_POST['teaschoolcontact'], $_POST['teastreetno'], $_POST['teastreetname'], $_POST['teasuburb'], $_POST['teacity'], $_POST['teacountry'], $_POST['teapostcode'], $_POST['teasubtaught'])) {

            $cellnumber = filter_input(INPUT_POST, 'teacellno', FILTER_SANITIZE_NUMBER_INT);
            $alternativenumber = filter_input(INPUT_POST, 'teaaltno', FILTER_SANITIZE_NUMBER_INT);
            $streetnumber = filter_input(INPUT_POST, 'teastreetno', FILTER_SANITIZE_NUMBER_INT);
            $streetname = filter_input(INPUT_POST, 'teastreetname', FILTER_SANITIZE_STRING);
            $suburb = filter_input(INPUT_POST, 'teasuburb', FILTER_SANITIZE_STRING);
            $city = filter_input(INPUT_POST, 'teacity', FILTER_SANITIZE_STRING);
            $postalcode = filter_input(INPUT_POST, 'teapostcode', FILTER_SANITIZE_NUMBER_INT);
            $subjecttaught = filter_input(INPUT_POST, 'teasubtaught', FILTER_SANITIZE_STRING);
            $country = filter_input(INPUT_POST, 'teacountry', FILTER_SANITIZE_STRING);
            $schoolcon = filter_input(INPUT_POST, 'teaschoolcontact', FILTER_SANITIZE_NUMBER_INT);
            $schooladdress = filter_input(INPUT_POST, 'teaschooladdress', FILTER_SANITIZE_STRING);
            $mail = filter_input(INPUT_POST, 'teapersonalemail', FILTER_SANITIZE_EMAIL);
            // Sanitize and validate the data passed in
            $experience = filter_input(INPUT_POST, 'teayearsofexperience', FILTER_SANITIZE_NUMBER_INT);
            $schoolemployed = filter_input(INPUT_POST, 'teaschoolemp', FILTER_SANITIZE_STRING);
            $teachinggrade = filter_input(INPUT_POST, 'teagradtaught', FILTER_SANITIZE_NUMBER_INT);
            //$subjectid = $_POST['subject_id'];

            $array = array("fname" => $firstname, "sname" => $lastname, "mail" => $email, "active" => $active, "gender" => $gender, "school" => $schoolemployed, "tgrade" => $teachinggrade, "yearexp" => $experience, "cellno" => $cellnumber, "altno" => $alternativenumber, "schadd" => $schooladdress, "schcon" => $schoolcon, "strno" => $streetnumber, "strname" => $streetname, "suburb" => $suburb, "city" => $city, "country" => $country, "pcode" => $postalcode, "subjecttaught" => $subjecttaught, "pmail" => $mail, "userid" => $id);
            $result = $user->teacherUpdate($array);
            if ($result > 1) {
                $arrResult = array('response' => 'Success', 'reason' => 'User has been successfully updated. You will be redirected shortly.');
                echo json_encode($arrResult);
            } else {
                $arrResult = array('response' => 'error', 'reason' => 'This user could not be updated.');
                echo json_encode($arrResult);
            }
        } else {
            $arrResult = array('response' => 'error', 'reason' => 'Please ensure you have entered all the required fields.');
            echo json_encode($arrResult);
        }
    }



} else {// echo $f;
    //echo $s;
    //echo $e;
}

?>