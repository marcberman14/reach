<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/QuestionDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TestDao.php";

$test = new TestDao();

$question = new QuestionDao();

session_cache_limiter('nocache');


header("Content-Type: application/json", true);

$testid = $_GET['testid'];



$array = array("testid"=>$testid);

$tdata = $test->test($array);



$questions = $question->getTestQuestion($array);


if($questions > 0)
{
    $result_array= array();
    $aaData= array();
    $rowarray= array();
    //fetch associative array
	$questionnumber = 1;
	$numberofquestions = 0;
	
	$testname = urlencode($_GET['testname']);

	foreach($questions as $count){
		
		$numberofquestions++;
		
	}
	
	$questionMarks = ($tdata['test_marks'] / $numberofquestions);

    foreach($questions as $row){
		 $aaData["Question Number"] = $questionnumber++;
        $aaData["Question"] = $row['question'];
        //$testid =  $row["test_id"];
		 $aaData["Question Marks"] = round($questionMarks);
		 
		  $aaData["Correct Answer"] = $row['correctanswer'];

        $aaData["Functions"] = '
		  
		 &nbsp;<a href="../question/edit/index.php?id='. urlencode($row["question_id"]) .'&testname='.$testname.'" class="on-default edit-row"><i class="fa fa-2x fa-pencil"></i></a>
        &nbsp;&nbsp;<a href="../delete/index.php?id='. urlencode($row["test_id"]) .'" class="on-default remove-row"><i class="fa fa-2x fa-trash-o"></i></a>';
        array_push($rowarray ,$aaData);
    }
    $result_array['aaData'] = $rowarray;
    echo json_encode( $result_array );

} else{
    //$result_array['aaData'] = '';
    echo json_encode($result_array );
}


?>