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


if (isset($_POST['question'],$_GET['id'],$_POST['answer1'], $_POST['answer2'],  $_POST['answer3'],  $_POST['answer4'],  $_POST['canswer'])) {
    // Sanitize and validate the data passed in
    $question1 = filter_input(INPUT_POST, 'question', FILTER_SANITIZE_STRING);
    $answer1 = filter_input(INPUT_POST, 'answer1', FILTER_SANITIZE_STRING);
    $answer2 = filter_input(INPUT_POST, 'answer2', FILTER_SANITIZE_STRING);
    $answer3 = filter_input(INPUT_POST, 'answer3', FILTER_SANITIZE_STRING);
    $answer4 = filter_input(INPUT_POST, 'answer4', FILTER_SANITIZE_STRING);
	$canswer = filter_input(INPUT_POST, 'canswer', FILTER_SANITIZE_STRING);
	$bestanswer;


    $question_id = $_REQUEST['id'];
	
	$question = new QuestionDao();

    $testid = $question->getQuestion(array("questid"=>$question_id));

    $testid = $testid['test_id'];
	
	
	
	if($canswer == 1){
		
		$bestanswer = $answer1;
		
		 $array = array("question"=>$question1,"correctanswer"=>$bestanswer,"wronganswer1" => $answer2, "wronganswer2"=>$answer3,"wronganswer3"=>$answer4,"questid"=>$question_id);
		
		$question->updateQuestion($array);
		
		
	}elseif($canswer == 2){
		
		$bestanswer = $answer2;
		
		$array = array("question"=>$question1,"correctanswer"=>$bestanswer,"wronganswer1" => $answer1, "wronganswer2"=>$answer3,"wronganswer3"=>$answer4,"questid"=>$question_id);
		
		$question->updateQuestion($array);
		
		
		
	}elseif($canswer == 3){
		
		$bestanswer = $answer3;
		
		$array = array("question"=>$question1,"correctanswer"=>$bestanswer,"wronganswer1" => $answer1, "wronganswer2"=>$answer2,"wronganswer3"=>$answer4,"questid"=>$question_id);
		
		$question->updateQuestion($array);
		
		
		
	}elseif($canswer == 4){
		
		$bestanswer = $answer4;
		
		$array = array("question"=>$question1,"correctanswer"=>$bestanswer,"wronganswer1" => $answer1, "wronganswer2"=>$answer2,"wronganswer3"=>$answer3,"questid"=>$question_id);
		
		$question->updateQuestion($array);
		
		
	}	
	
	

   

    

    $testname = $_GET['testname'];




    header('location:http://vps.bermanz.co.za/portal/test/quiz/index.php?id='.$testid.'&testname='.$testname.'');


} else {
    $arrResult = array ('response'=>'error','reason'=>'Please ensure you have entered all the required fields.');
    echo json_encode($arrResult);
}




//$test_name = $_POST['testname'];
//$test_subject = $_POST['testsubject'];

/*if($test_name != null and $test_subject != null){
    $testobj = new Test($test_name, $test_subject);
    $testobj->insertTest();
}*/

?>