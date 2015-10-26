<?php
//include_once 'db_connect.php';
//include_once 'functions.php';

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/QuestionDao.php";

//require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TutorSubjectDao.php";

//sec_session_start();


header("Content-Type: application/json", true);

if (isset($_POST['question'],$_POST['answer1'], $_POST['answer2'], $_POST['answer3'], $_POST['answer4'],  $_POST['canswer'])) {
	
	$testid = $_GET['id'];
    // Sanitize and validate the data passed in
    $quest = filter_input(INPUT_POST, 'question', FILTER_SANITIZE_STRING);
	$answer1 = filter_input(INPUT_POST, 'answer1', FILTER_SANITIZE_STRING);
    $answer2 = filter_input(INPUT_POST, 'answer2', FILTER_SANITIZE_STRING);
    $answer3 = filter_input(INPUT_POST, 'answer3', FILTER_SANITIZE_STRING);
    $answer4 = filter_input(INPUT_POST, 'answer4', FILTER_SANITIZE_STRING);
    $canswer = filter_input(INPUT_POST, 'canswer', FILTER_SANITIZE_STRING);
	$bestanswer;
	
	$question = new QuestionDao();

    if($canswer == 1){
		
		$bestanswer = $answer1;
		
		$array = array("quiz"=>$quest,"correct"=>$bestanswer,"wrong1"=>$answer2,"wrong2"=>$answer3,"wrong3"=>$answer4,"testid"=>$testid);
		
		$question->addQuestion($array);
		
		
	}elseif($canswer == 2){
		
		$bestanswer = $answer2;
		
		$array = array("quiz"=>$quest,"correct"=>$bestanswer,"wrong1"=>$answer1,"wrong2"=>$answer3,"wrong3"=>$answer4,"testid"=>$testid);
		
		$question->addQuestion($array);
		
		
		
	}elseif($canswer == 3){
		
		$bestanswer = $answer3;
		
		$array = array("quiz"=>$quest,"correct"=>$bestanswer,"wrong1"=>$answer1,"wrong2"=>$answer2,"wrong3"=>$answer4,"testid"=>$testid);
		
		$question->addQuestion($array);
		
		
		
	}elseif($canswer == 4){
		
		$bestanswer = $answer4;
		
		$array = array("quiz"=>$quest,"correct"=>$bestanswer,"wrong1"=>$answer1,"wrong2"=>$answer2,"wrong3"=>$answer3,"testid"=>$testid);
		
		$question->addQuestion($array);
		
		
	}	
	
	
	header('location:http://vps.bermanz.co.za/portal/test/quiz/index.php?testname='.$_GET['testname'].'&id='.$_GET['id'].'');


} else {
    $arrResult = array ('response'=>'error','reason'=>'Please ensure you have entered all the required fields.');
    echo json_encode($arrResult);
}

?>