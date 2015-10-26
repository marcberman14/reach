<?php


require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/QuestionDao.php";

$question = new QuestionDao();

session_cache_limiter('nocache');


header("Content-Type: application/json", true);

$testid = $_GET['testid'];

$array = array("testid"=>$testid);



$questions = $question->getTestQuestion($array);


if($questions > 0)
{
    $result_array= array();
    $aaData= array();
    $rowarray= array();
    //fetch associative array



    foreach($questions as $row){
        $aaData["Question"] = '<a href="../question/question.php?id=' . urlencode($row["question_id"]) .'&testid='.urlencode($row["test_id"]).'">'.$row["question_text"].'</a>';
        //$testid =  $row["test_id"];

        $aaData["Functions"] = '
		  &nbsp;<a href="../question/question.php?id=' . urlencode($row["test_id"]) .'&quest=' . urlencode(0) .'"class="on-default edit-row"  title="View"><i class="fa fa-2x fa-eye"></i></a>
		 &nbsp;<a href="../edit/index.php?id='. urlencode($row["test_id"]) .'" class="on-default edit-row"><i class="fa fa-2x fa-pencil"></i></a>
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