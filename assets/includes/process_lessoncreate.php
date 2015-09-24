<?php
include_once 'db_connect.php';
include_once 'functions.php';

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Lesson.php";

sec_session_start();

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

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
	
	
	$lesson = new Lesson();
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