<?php


require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TestDao.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/EnrolmentDao.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/StudentDao.php";

$student = new StudentDao();
	
$enrolment = new EnrolmentDao();
	
$test = new TestDao();
	

$user = $_GET['userid'];



session_cache_limiter('nocache');


header("Content-Type: application/json", true);

$array = array("user"=>$user);

$stuid = $student->student($array);

$array1 = array("user"=>$stuid);
	
//$testing = $student->getStudent($array1);


$array = array("user"=>13);
	
	$testing = $student->getStudent($array);



//var_dump($stuid);

if($testing > 0)
{
    $result_array= array();
    $aaData= array();
    $rowarray= array();
    //fetch associative array



    foreach($testing as $row){
		
		


		
		
        $aaData["Test Name"] = $row["test_name"];
		//$testid =  $row["test_id"];
		$aaData["Test Description"] = $row["test_description"];
		$aaData["Test Marks"] = $row["test_marks"];

        $aaData["Functions"] = '&nbsp;&nbsp;<a href="../question/question.php?id=' . urlencode($row["test_id"]) .'&quest=' . urlencode(0) .'" class="on-default remove-row" title="Take"><i class="fa fa-2x fa-comment"></i></a>';
		
       array_push($rowarray ,$aaData);
	   
	   
	   
    }
    $result_array['aaData'] = $rowarray;
    echo json_encode( $result_array );

} else{
    //$result_array['aaData'] = '';
    echo json_encode($result_array );
}







?>