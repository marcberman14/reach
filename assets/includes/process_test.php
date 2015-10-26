<?php
 require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/ProfileDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TestDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/QuestionDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Test.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Question.php";

$security = new Security();
//$profiles = new ProfileDao();
$security->sec_session_start();

error_reporting(E_ALL);
ini_set('display_errors',1);


session_cache_limiter('nocache');

header("Content-Type: application/json", true);


if (isset($_POST['test_name'],$_POST['test_description'],$_POST['test_marks'])) {
    // Sanitize and validate the data passed in
    $test_name = filter_input(INPUT_POST, 'test_name', FILTER_SANITIZE_STRING);
	$test_description = filter_input(INPUT_POST, 'test_description', FILTER_SANITIZE_STRING);
	$test_marks = filter_input(INPUT_POST, 'test_marks', FILTER_SANITIZE_NUMBER_INT);



    $subjectid = $_POST['subid'];

    $array = array("testname"=>$test_name,"testdecr"=>$test_description,"testmark"=>$test_marks,"subjectid"=> $subjectid);

    $test = new TestDao();
    
    $test->createTest($array);
	
	


   header('location:http://vps.bermanz.co.za/portal/test/view-tests/index.php?subjectid='.$subjectid);


} else {
    $arrResult = array ('response'=>'error','reason'=>'Please ensure you have entered all the required fields.');
    //echo json_encode($arrResult);
}




//$test_name = $_POST['testname'];
//$test_subject = $_POST['testsubject'];

/*if($test_name != null and $test_subject != null){
    $testobj = new Test($test_name, $test_subject);
    $testobj->insertTest();
}*/

?>