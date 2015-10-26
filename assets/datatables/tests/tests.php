<?php


require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TestDao.php";

$test = new TestDao();

session_cache_limiter('nocache');


header("Content-Type: application/json", true);

$subid = $_GET['subjectid'];

$array = array("subjectid"=>$subid);



$tests = $test->getSubjTest($array);


if($tests > 0)
{
    $result_array= array();
    $aaData= array();
    $rowarray= array();
    //fetch associative array



    foreach($tests as $row){
		
		
        $aaData["Test Name"] = $row["test_name"];
		//$testid =  $row["test_id"];
		$aaData["Test Description"] = $row["test_description"];
		$aaData["Test Marks"] = $row["test_marks"];

        $aaData["Functions"] = '
		&nbsp;<a href="../quiz/index.php?id=' . urlencode($row["test_id"]) .'&testname=' . urlencode($row["test_name"]) .'" class="on-default edit-row"  title="View"><i class="fa fa-2x fa-eye"></i></a>
		 &nbsp;<a href="../edit/index.php?id='. urlencode($row["test_id"]) .'" class="on-default edit-row" title="Edit"><i class="fa fa-2x fa-pencil"></i></a>
        &nbsp;&nbsp;<a href="../delete/index.php?id='. urlencode($row["test_id"]) .'" class="on-default remove-row" title="Delete"><i class="fa fa-2x fa-trash-o"></i></a>
		
		 &nbsp;&nbsp;<a href="../question/question.php?id=' . urlencode($row["test_id"]) .'&quest=' . urlencode(0) .'" class="on-default remove-row" title="Take"><i class="fa fa-2x fa-comment"></i></a>';
       array_push($rowarray ,$aaData);
    }
    $result_array['aaData'] = $rowarray;
    echo json_encode( $result_array );

} else{
    //$result_array['aaData'] = '';
    echo json_encode($result_array );
}


?>