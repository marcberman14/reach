<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/SubjectDao.php";

session_cache_limiter('nocache');

header("Content-Type: application/json", true);

if (isset($_POST['code'], $_POST['subject_id'], $_POST['subject_name'], $_POST['subject_description'], $_POST['subject_category'], $_POST['grade'], $_POST['selecttutor'])) {
    // Sanitize and validate the data passed in
    $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
    $subject_name = filter_input(INPUT_POST, 'subject_name', FILTER_SANITIZE_STRING);
    $subject_description = filter_input(INPUT_POST, 'subject_description', FILTER_SANITIZE_STRING);
    $subject_category = filter_input(INPUT_POST, 'subject_category', FILTER_SANITIZE_STRING);
    $grade = filter_input(INPUT_POST, 'grade', FILTER_SANITIZE_STRING);
    $selecttutor = filter_input(INPUT_POST, 'selecttutor', FILTER_SANITIZE_STRING);
    $subjectid = $_POST['subject_id'];

    $sub = array("subject_code" => $code,
        "subject_name" => $subject_name,
        "subject_grade" => $grade,
        "subject_description" => $subject_description,
        "subject_category" => $subject_category,
        "subjectid" => $subjectid);

    $subject = new SubjectDao();
    $result = $subject->editSubject($sub);
    if ($result > 0) {
        $tutsub = new TutorSubjectDao();
        $result = $tutsub->edit($selecttutor, $subjectid);
        if ($result > 0) {
            echo json_encode(Array("response" => "success", "reason" => $subject_name . " has been edit. You will be redirected shortly."));
        } else {
            echo json_encode(Array("response" => "error", "reason" => "Subject could not be edited, please refresh and try again."));
        }
    } else {
        echo json_encode(Array("response" => "error", "reason" => "Subject could not be added, please refresh and try again."));
    }
} else {
    $arrResult = array('response' => 'error', 'reason' => 'Please ensure you have entered all the required fields.');
    echo json_encode($arrResult);
}


?>