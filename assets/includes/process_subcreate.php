<?php
include_once 'db_connect.php';
include_once 'functions.php';

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Subject.php";

sec_session_start();


header("Content-Type: application/json", true);

if (isset($_POST['code'],$_POST['subject_name'], $_POST['subject_description'], $_POST['subject_category'], $_POST['grade'],  $_POST['selecttutor'])) {
    // Sanitize and validate the data passed in
    $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
	$subject_name = filter_input(INPUT_POST, 'subject_name', FILTER_SANITIZE_STRING);
    $subject_description = filter_input(INPUT_POST, 'subject_description', FILTER_SANITIZE_STRING);
    $subject_category = filter_input(INPUT_POST, 'subject_category', FILTER_SANITIZE_STRING);
    $grade = filter_input(INPUT_POST, 'grade', FILTER_SANITIZE_STRING);
    $selecttutor = filter_input(INPUT_POST, 'selecttutor', FILTER_SANITIZE_STRING);

    $array = array("subject_code"=>$code,"subject_name"=>$subject_name,"subject_description"=>$subject_description,"subject_category"=>$subject_category,"subject_grade"=>$grade);
	
	
	$subject = new Subject();
	$tutsub = new TutorSubjectDao();
	
	 $array1 = array("subject_code" =>$code);
	 
	 $subject->addSubject($array);
	 
	 $tutsub->add($array1,$selecttutor);
	
	
	header('location:http://vps.bermanz.co.za/portal/subject/view/');


} else {
    $arrResult = array ('response'=>'error','reason'=>'Please ensure you have entered all the required fields.');
    echo json_encode($arrResult);
}

?>