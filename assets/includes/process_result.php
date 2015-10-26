<?php
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/ProfileDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TestDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/QuestionDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/ResultDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Test.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Question.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Result.php";

$security = new Security();
//$profiles = new ProfileDao();
$security->sec_session_start();

error_reporting(E_ALL);
ini_set('display_errors',1);


session_cache_limiter('nocache');

header("Content-Type: application/json", true);


if (isset($_POST['grade'])) {
    // Sanitize and validate the data passed in
    $grade = filter_input(INPUT_POST, 'grade', FILTER_SANITIZE_STRING);


    $user_id = $_POST['user_id'];
    $test_id = $_POST['test_id'];
    $question_id = $_POST['question_id'];

    $array = array("grade"=>$grade,"user_id"=>$user_id,"test_id"=>$test_id,"question_id"=> $question_id);

    $question = new QuestionDao();

    $result->viewResult($array);




    header('location:http://vps.bermanz.co.za/portal/test/result/index.php?user_id=.$user_id,test_id=.$test_id, question_id=.question_id');


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