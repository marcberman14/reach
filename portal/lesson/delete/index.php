 <?php
    include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
	
    $views = new View();
    $security = new Security();
    $security->sec_session_start();
    $login = $security->login_check();
    $security->refreshUser($_SESSION['user_id']);
    $title = "Dashboard";
    $page_heading = "Dashboard";
    $keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
    $description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

   

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Lesson.php";

header("Content-Type: application/json", true);

	$lesson = new Lesson();
	$lesson->deleteLesson($_REQUEST['id']);
	header('location:http://vps.bermanz.co.za/portal/lesson/view/');

?>