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

//$testid = $_GET['testid'];

$user = $_SESSION['user']->getUserID();

$array = array("user"=>$user);
	


$te = $test->getTesting($array);



//$array = array("$questionid"=>$question_id);

//$qdata = $question->test($array);


	
//$ans = $answer->getAnswers($array2);

 $questions = 0;



//$result = $res->viewTestResult($array2);


if($te > 0)
{
    $result_array= array();
    $aaData= array();
    $rowarray= array();
    //fetch associative array
    $questionnumber = 1;
    $numberofquestions = 0;

    //$correctanswer = urlencode($_GET['correctanswer']);

   
		

    //$questionMarks = ($qdata['test_marks'] / $numberofquestions);
	//$quizmarks = $te[0]['test_marks'] / $questions;

    foreach($te as $row){
		
		 $id =$row['test_id'];
        $aaData["Test Number"] = $questionnumber;
        $aaData["Test Name"] = $row['test_name'];
        //$testid =  $row["test_id"];
        $aaData["Test Description"] = $row['test_description'];
        $aaData["Total Mark"] = $row['test_marks'];        
		$aaData["Your Mark"] = $row['grade']; 
		

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