<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/ProfileDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TestDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/QuestionDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Test.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Question.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/AnswerDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/QuestionDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TestDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/ResultDao.php";
$security = new Security();
$profiles = new ProfileDao();
$security->sec_session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);


session_cache_limiter('nocache');

header("Content-Type: application/json", true);

if(isset($_POST["questid"],$_POST["optradio1"])){
    $questid=filter_input(INPUT_POST, 'questid', FILTER_SANITIZE_STRING);
    $optradio1 = filter_input(INPUT_POST, 'optradio1', FILTER_SANITIZE_STRING);

	$testid= $_GET['id'];
	
	$user = $_SESSION['user']->getUserID();

    $array = array("question_id" =>$questid, "answer" => $optradio1, "test_id" => $testid, "user" => $user);

	
	$number = 0;
	$countCorrect = 0;
	
	$result = new ResultDao();
	
    $answer = new AnswerDao();
	
	$ques = new QuestionDao();
	
	$answer->createAnswer($array);
	
	
	
   $test = new TestDao();
   
   
	
    $button = $_POST['button'];
		
		if($button == 'next'){
			
		header('location:http://vps.bermanz.co.za/portal/test/question/question.php?quest='.urlencode($_GET['quest']).'&id='.urlencode($_GET['id']).'');
		
		
		}elseif($button == 'submit'){
			
			 $array1 = array( "testid" => $testid, "user" => $user);
			
			$array = array("testid"=>$testid);
			
			$test = $test->getSingleTest($array);
			
			$tdata = $answer->getAnswers($array1);
	
			$mdata = $ques->getTestQuestion($array);
			
			foreach($mdata as $correct){
				
					$correct =  $mdata[$number]['correctanswer'];
					
					$given =  $tdata[$number]['answer'];
					
					
					if($given == $correct){
						
						$countCorrect++;
						
						
						echo "Correct Answer";
						
					}else{
						
						echo "Wrong Answer";	
					}					
					
					//var_dump($correct);
					//var_dump($given);
					$number++;
				
			}
			
			$mark = ($test['test_marks'] / $number);
			
			$marks = ($mark * $countCorrect);
			
			$arrayR = array("testid"=>$testid,"userid"=>$user,"grade"=>$marks);
			
			$result->enterResults($arrayR);
			
			//echo $marks;
			
			header('location:http://vps.bermanz.co.za/portal/test/result/index.php?marks='.urlencode($marks).'&testid='.urlencode($testid).'');
			
			
		}
		
    



}else{
$arrResult = array ('response'=>'error','reason'=>'A fatal error has occurred, if this problem persists please contact an administrator.');
echo json_encode($arrResult);
}
?>