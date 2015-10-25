<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/SubjectDao.php";

$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$security->refreshUser($_SESSION['user_id']);
$title = "Delete";
$page_heading = "Delete Subject";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

header("Content-Type: application/json", true);
//if(!isset($_GET['id'], $_GET['confirmation'], $_GET['token'])){ echo "<script> window.location.href = \"/portal/subject/view/\";</script>"; }

if (!isset($_GET['id'], $_GET['token'], $_GET['subname'])) {
    echo json_encode(Array("response" => "error", "reason" => "A fatal error has occurred, please try again."));
} else {
    $subjectid = urldecode($_GET['id']);
    $subname = urldecode($_GET['subname']);
    $securitytoken = urldecode($_GET['token']);
    if (strlen($securitytoken) == 64) {
        $token = hash('sha256', $subjectid . $subname);
        if ($securitytoken == $token) {
            $subject = new SubjectDao();
            $array = array("subjectid" => $_GET['id']);
            //$result = $subject->deleteSubject($array);
            $result = 0;
            if ($result == 1) {
                echo json_encode(Array("response" => "success", "reason" => $subname . " has been deleted from the system along with all relevant data."));
            } else {
                echo json_encode(Array("response" => "error", "reason" => $subname . " could not be deleted from the system."));
            }
        } else {
            echo json_encode(Array("response" => "error", "reason" => "Invalid security token, please refresh and try again."));
        }
        //$tutsub = new TutorSubjectDao();
        //$tutsub->delete($array);

        //echo "<script> window.location.href = \"/portal/subject/view/\";</script>";
    } else {
        echo json_encode(Array("response" => "error", "reason" => "Invalid security token, please refresh and try again."));
    }
}


?>