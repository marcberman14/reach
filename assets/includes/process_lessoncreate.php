<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/SubjectLessonDao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/LessonDao.php";
$security = new Security();
$security->sec_session_start();

session_cache_limiter('nocache');

header("Content-Type: application/json", true);


if (isset($_POST['lesson_title'],$_POST['lesson_name'], $_POST['lesson_description'], $_POST['lesson_material'], $_POST['lesson_concept'],  $_POST['selectsub'])) {

    // Sanitize and validate the data passed in   
	$lesson_title = filter_input(INPUT_POST, 'lesson_title', FILTER_SANITIZE_STRING); 
	$lesson_name = filter_input(INPUT_POST, 'lesson_name', FILTER_SANITIZE_STRING); 
	$lesson_description = filter_input(INPUT_POST, 'lesson_description', FILTER_SANITIZE_STRING);
    $lesson_concept = filter_input(INPUT_POST, 'lesson_concept', FILTER_SANITIZE_STRING);
    $lesson_material = filter_input(INPUT_POST, 'lesson_material', FILTER_SANITIZE_STRING);
    $selectsub = filter_input(INPUT_POST, 'selectsub', FILTER_SANITIZE_STRING);
	
	
	$array = array("title"=>$lesson_title,"name"=>$lesson_name,"description"=>$lesson_description,"concept"=>$lesson_concept,"material"=>$lesson_material);
	
	
	$lesson = new LessonDao();
	$lessonsub = new SubjectLessonDao();
	 $array1 = array("title" =>$lesson_title);
	 $lesson->addLesson($array);
	 
	 $lessonsub->add($array1,$selectsub);
	
	
	header('location:http://vps.bermanz.co.za/portal/lesson/view/');

    
} else {
    $arrResult = array ('response'=>'error','reason'=>'Please ensure you have entered all the required fields.');
    echo json_encode($arrResult);
}
?>