<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/UserDao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/ProfileDao.php";
$security = new Security();
$profiles = new ProfileDao();
$security->sec_session_start();

session_cache_limiter('nocache');

header("Content-Type: application/json", true);

$type = $_SESSION['user']->getPermissionName();
$id = $_SESSION['user']->getUserID();
header("Content-Type: application/json", true);

if (isset($_POST['firstname'], $_POST['surname'], $_POST['email'])) {

    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);


    if ($type == "Student") {

        if (isset($_POST['stustreetno'], $_POST['stustreetname'], $_POST['stusuburb'], $_POST['stucity'], $_POST['stupostcode'], $_POST['stuhomeno'], $_POST['stucellno'], $_POST['stualtno'], $_POST['stuparentno'], $_POST['stuschoolname'])) {


            // Sanitize and validate the data passed in

            $streetnumber = filter_input(INPUT_POST, 'stustreetno', FILTER_SANITIZE_NUMBER_INT);
            $streetname = filter_input(INPUT_POST, 'stustreetname', FILTER_SANITIZE_STRING);

            $suburb = filter_input(INPUT_POST, 'stusuburb', FILTER_SANITIZE_STRING);
            $city = filter_input(INPUT_POST, 'stucity', FILTER_SANITIZE_STRING);
            $postalcode = filter_input(INPUT_POST, 'stupostcode', FILTER_SANITIZE_NUMBER_INT);


            $homenumber = filter_input(INPUT_POST, 'stuhomeno', FILTER_SANITIZE_NUMBER_INT);
            $cellnumber = filter_input(INPUT_POST, 'stucellno', FILTER_SANITIZE_NUMBER_INT);

            $altnumber = filter_input(INPUT_POST, 'stualtno', FILTER_SANITIZE_NUMBER_INT);

            $parentno = filter_input(INPUT_POST, 'stuparentno', FILTER_SANITIZE_NUMBER_INT);
            $schoolname = filter_input(INPUT_POST, 'stuschoolname', FILTER_SANITIZE_STRING);


            //$subjectid = $_POST['subject_id'];


            $array = array("fname" => $firstname, "sname" => $lastname, "mail" => $email, "strno" => $streetnumber, "strname" => $streetname, "suburb" => $suburb, "city" => $city, "pcode" => $postalcode, "homeno" => $homenumber, "cellno" => $cellnumber, "altno" => $altnumber, "parno" => $parentno, "school" => $schoolname, "userid" => $id);

            $result = $user->studentProfileUpdate($array);

            if($result > 0){
                $arrResult = array('response' => 'success', 'reason' => 'Your profile has been updated');
                echo json_encode($arrResult);
            } else {
                $arrResult = array('response' => 'error', 'reason' => 'Your profile could not be updated.');
                echo json_encode($arrResult);
            }


        } else {
            $arrResult = array('response' => 'error', 'reason' => 'Please ensure you have entered all the required fields.');
            echo json_encode($arrResult);
        }
    } elseif ($type == "Tutor") {


        if (isset($_POST['tutcellno'], $_POST['tutaltno'], $_POST['tutstreetno'], $_POST['tutstreetname'], $_POST['tutsuburb'], $_POST['tutcity'], $_POST['tutpostcode'], $_POST['tutsarea'], $_POST['tutsyear'])) {

            $cellnumber = filter_input(INPUT_POST, 'tutcellno', FILTER_SANITIZE_NUMBER_INT);
            $altnumber = filter_input(INPUT_POST, 'tutaltno', FILTER_SANITIZE_NUMBER_INT);
            $streetnumber = filter_input(INPUT_POST, 'tutstreetno', FILTER_SANITIZE_NUMBER_INT);
            $streetname = filter_input(INPUT_POST, 'tutstreetname', FILTER_SANITIZE_STRING);

            $suburb = filter_input(INPUT_POST, 'tutsuburb', FILTER_SANITIZE_STRING);
            $city = filter_input(INPUT_POST, 'tutcity', FILTER_SANITIZE_STRING);
            $postalcode = filter_input(INPUT_POST, 'tutpostcode', FILTER_SANITIZE_NUMBER_INT);

            $studyarea = filter_input(INPUT_POST, 'tutsarea', FILTER_SANITIZE_STRING);
            $studyyear = filter_input(INPUT_POST, 'tutsyear', FILTER_SANITIZE_NUMBER_INT);


            $array = array("fname" => $firstname, "sname" => $lastname, "mail" => $email, "strno" => $streetnumber, "strname" => $streetname, "suburb" => $suburb, "city" => $city, "pcode" => $postalcode, "cellno" => $cellnumber, "altno" => $altnumber, "studyarea" => $studyarea, "studyyear" => $studyyear, "userid" => $id);


            $result = $user->tutorProfileUpdate($array);
            if($result > 0){
                $arrResult = array('response' => 'success', 'reason' => 'Your profile has been updated');
                echo json_encode($arrResult);
            } else {
                $arrResult = array('response' => 'error', 'reason' => 'Your profile could not be updated.');
                echo json_encode($arrResult);
            }

        } else {
            $arrResult = array('response' => 'error', 'reason' => 'Please ensure you have entered all the required fields.');
            echo json_encode($arrResult);
        }


    } elseif ($type == "Teacher") {


        if (isset($_POST['teaschoolemp'], $_POST['teagradtaught'], $_POST['teacellno'], $_POST['teaaltno'], $_POST['teastreetno'], $_POST['teastreetname'], $_POST['teasuburb'], $_POST['teacity'], $_POST['teapostcode'], $_POST['teasubtaught'])) {

            $cellnumber = filter_input(INPUT_POST, 'teacellno', FILTER_SANITIZE_NUMBER_INT);
            $alternativenumber = filter_input(INPUT_POST, 'teaaltno', FILTER_SANITIZE_NUMBER_INT);
            $streetnumber = filter_input(INPUT_POST, 'teastreetno', FILTER_SANITIZE_NUMBER_INT);
            $streetname = filter_input(INPUT_POST, 'teastreetname', FILTER_SANITIZE_STRING);
            $suburb = filter_input(INPUT_POST, 'teasuburb', FILTER_SANITIZE_STRING);
            $city = filter_input(INPUT_POST, 'teacity', FILTER_SANITIZE_STRING);
            $postalcode = filter_input(INPUT_POST, 'teapostcode', FILTER_SANITIZE_NUMBER_INT);
            $subjecttaught = filter_input(INPUT_POST, 'teasubtaught', FILTER_SANITIZE_STRING);


            $schoolemployed = filter_input(INPUT_POST, 'teaschoolemp', FILTER_SANITIZE_STRING);

            $teachinggrade = filter_input(INPUT_POST, 'teagradtaught', FILTER_SANITIZE_NUMBER_INT);

            //$subjectid = $_POST['subject_id'];


            $array = array("fname" => $firstname, "sname" => $lastname, "mail" => $email, "school" => $schoolemployed, "tgrade" => $teachinggrade, "cellno" => $cellnumber, "altno" => $alternativenumber, "strno" => $streetnumber, "strname" => $streetname, "suburb" => $suburb, "city" => $city, "pcode" => $postalcode, "subjecttaught" => $subjecttaught, "userid" => $id);

            $result = $user->teacherProfileUpdate($array);
            if($result > 0){
                $arrResult = array('response' => 'success', 'reason' => 'Your profile has been updated');
                echo json_encode($arrResult);
            } else {
                $arrResult = array('response' => 'error', 'reason' => 'Your profile could not be updated.');
                echo json_encode($arrResult);
            }


        } else {
            $arrResult = array('response' => 'error', 'reason' => 'Please ensure you have entered all the required fields.');
            echo json_encode($arrResult);
        }


    } elseif ($type == "Administrator") {

        if (isset($_POST['admstreetno'], $_POST['admstreetname'], $_POST['admsuburb'], $_POST['admcity'], $_POST['admpostcode'], $_POST['admcellno'], $_POST['admhomeno'], $_POST['admworkno'], $_POST['admjobdept'], $_POST['admjobpos'], $_POST['admaltemail'])) {

            $cellnumber = filter_input(INPUT_POST, 'admcellno', FILTER_SANITIZE_NUMBER_INT);
            $worknumber = filter_input(INPUT_POST, 'admworkno', FILTER_SANITIZE_NUMBER_INT);
            $homenumber = filter_input(INPUT_POST, 'admhomeno', FILTER_SANITIZE_NUMBER_INT);
            $streetnumber = filter_input(INPUT_POST, 'admstreetno', FILTER_SANITIZE_NUMBER_INT);
            $streetname = filter_input(INPUT_POST, 'admstreetname', FILTER_SANITIZE_STRING);
            $suburb = filter_input(INPUT_POST, 'admsuburb', FILTER_SANITIZE_STRING);
            $city = filter_input(INPUT_POST, 'admcity', FILTER_SANITIZE_STRING);
            $postalcode = filter_input(INPUT_POST, 'admpostcode', FILTER_SANITIZE_NUMBER_INT);
            $jobdepartment = filter_input(INPUT_POST, 'admjobdept', FILTER_SANITIZE_STRING);


            $jobposition = filter_input(INPUT_POST, 'admjobpos', FILTER_SANITIZE_STRING);

            $alternativeemail = filter_input(INPUT_POST, 'admaltemail', FILTER_SANITIZE_STRING);

            $array = array("fname" => $firstname, "sname" => $lastname, "mail" => $email, "workno" => $worknumber, "strno" => $streetnumber, "strname" => $streetname, "suburb" => $suburb, "city" => $city, "pcode" => $postalcode, "homeno" => $homenumber , "cellno" => $cellnumber, "jobdept" => $jobdepartment, "jobpos" => $jobposition, "altemail" => $alternativeemail, "userid" => $id);
            

            $result = $user->adminProfileUpdate($array);
            if($result > 0){
                $arrResult = array('response' => 'success', 'reason' => 'Your profile has been updated');
                echo json_encode($arrResult);
            } else {
                $arrResult = array('response' => 'error', 'reason' => 'Your profile could not be updated.');
                echo json_encode($arrResult);
            }

        } else {
            $arrResult = array('response' => 'error', 'reason' => 'Please ensure you have entered all the required fields.');
            echo json_encode($arrResult);
        }
    }
} else {// echo $f;
    $arrResult = array('response' => 'error', 'reason' => 'Please ensure you have entered all the required fields.');
    echo json_encode($arrResult);
}

?>