<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Lesson.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/SubjectLessonDao.php";

header("Content-Type: application/json", true);

if (isset($_POST['id'],$_POST['lesson_title'],$_POST['lesson_name'], $_POST['lesson_description'], $_POST['lesson_material'], $_POST['lesson_concept'],  $_POST['selectsub'])) {

    // Sanitize and validate the data passed in   
	$lesson_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
	$lesson_title = filter_input(INPUT_POST, 'lesson_title', FILTER_SANITIZE_STRING); 
	$lesson_name = filter_input(INPUT_POST, 'lesson_name', FILTER_SANITIZE_STRING); 
	$lesson_description = filter_input(INPUT_POST, 'lesson_description', FILTER_SANITIZE_STRING);
    $lesson_concept = filter_input(INPUT_POST, 'lesson_concept', FILTER_SANITIZE_STRING);
    $lesson_material = filter_input(INPUT_POST, 'lesson_material', FILTER_SANITIZE_STRING);
    $selectsub = filter_input(INPUT_POST, 'selectsub', FILTER_SANITIZE_STRING);
	
	
	$array = array("title" =>$lesson_title, "name" => $lesson_name,"description" => $lesson_description,"concept" => $lesson_concept, "material" =>$lesson_material,"lessonid" =>$lesson_id);

	$lessub = new SubjectLessonDao();
	
	Lesson::editLesson($array);
	$array1 = array("subjectid"=>$selectsub,"lessonid" =>$lesson_id);
	$lessub->edit($array1);
	
	header('location:http://vps.bermanz.co.za/portal/lesson/view/');
	
}
?>