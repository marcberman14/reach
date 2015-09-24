<?php
include_once 'db_connect.php';
include_once 'functions.php';

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Lesson.php";



ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

header("Content-Type: application/json", true);
	
	
	$lesson = new Lesson();
	
	$lesson->deleteLesson($_REQUEST['id']);
	
	header('location:http://vps.bermanz.co.za/portal/lesson/view/');

?>