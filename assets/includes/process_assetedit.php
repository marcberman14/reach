<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/LessonDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/SubjectLessonDao.php";

header("Content-Type: application/json", true);

var_dump($_POST['fileToUpload'],$_POST['lesson_video_link'],$_POST['id']);

if (isset($_POST['fileToUpload'],$_POST['lesson_video_link'],)) {

    // Sanitize and validate the data passed in  
	$lesson_file = filter_input(INPUT_POST, 'fileToUpload', FILTER_SANITIZE_STRING); 
	$lesson_video = filter_input(INPUT_POST, 'lesson_video_link', FILTER_SANITIZE_STRING);  
	$lesson_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
	
	$array = array("fileid" =>$lesson_file, "name" => $lesson_name,"description" => $lesson_description,"concept" => $lesson_concept, "material" =>$lesson_material,"file"=>$lesson_file,"video"=>$lesson_video,"lessonid" =>$lesson_id);

	
	$asset= new AssetDao();
	
	$lesson->editLesson($array);
	
	header('location:http://vps.bermanz.co.za/portal/lesson/view/');
	
}else{

echo  "Nothing";
	
}
?>