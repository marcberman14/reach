<?php


require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/ResultDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/QuestionDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/AnswerDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TestDao.php";

$answer = new AnswerDao();

$question = new QuestionDao();

$res = new ResultDao();

$test = new TestDao();

session_cache_limiter('nocache');


header("Content-Type: application/json", true);

$testid = $_REQUEST['testid'];

$user = $_SESSION['user']->getUserID();


$array1 = array("testid"=>$testid);

$array2 = array("testid"=>$testid,"user"=>$user);



//$array = array("$questionid"=>$question_id);

//$qdata = $question->test($array);

$quest = $question->getTestQuestion($array1);

$te = $test->test($array1);
	
$ans = $answer->getAnswers($array2);

 $questions = 0;



$result = $res->viewTestResult($array2);


if($quest > 0)
{
    $result_array= array();
    $aaData= array();
    $rowarray= array();
    //fetch associative array
    $questionnumber = 1;
    $numberofquestions = 0;

    //$correctanswer = urlencode($_GET['correctanswer']);

    foreach($quest as $count){

        $questions++;

    }

    //$questionMarks = ($qdata['test_marks'] / $numberofquestions);
	$quizmarks = $te['test_marks'] / $questions;

    foreach($quest as $row){
        $aaData["Question Number"] = $questionnumber;
        $aaData["Question"] = $row['question'];
        //$testid =  $row["test_id"];
        $aaData["Correct Answer"] = $row['correctanswer'];
        $aaData["Your Answer"] = $ans[$numberofquestions]['answer'];

        if($row['correctanswer'] == $ans[$numberofquestions]['answer']){
		$aaData["Marks"] = round($quizmarks);
		}else{
			$aaData["Marks"] = 0;
		}

        array_push($rowarray ,$aaData);
		
		$questionnumber++;
		$numberofquestions++;
		
    }
    $result_array['aaData'] = $rowarray;
    echo json_encode( $result_array );

} else{ 
    //$result_array['aaData'] = '';
    echo json_encode($result_array );
}


?>