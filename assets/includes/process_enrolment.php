<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/SubjectDao.php";

$security = new Security();
//$profiles = new ProfileDao();
$security->sec_session_start();

session_cache_limiter('nocache');

header("Content-Type: application/json", true);

if (isset($_GET['id'],$_GET['studentid'])) {
    $subid = urldecode($_GET['id']);
    $userid = urldecode($_GET['studentid']);
    $array = array("subid"=>$subid,"studentid"=>$userid);

    $subject = new SubjectDao();

    $result = $subject->enrolStudent($array);

    if($result > 0){
        header('location:http://vps.bermanz.co.za/portal/?outcome=success');
    } else {
        header('location:http://vps.bermanz.co.za/portal/?outcome=failure');
    }
    $enrolment = $subject->myEnrolments($array);
    if($enrolment > 0){
        header('location:http://vps.bermanz.co.za/portal/?outcome=success');
    } else {
        header('location:http://vps.bermanz.co.za/portal/?outcome=failure');
    }


}

else {
    header('location:http://vps.bermanz.co.za/portal/?outcome=failure');
}



//$test_name = $_POST['testname'];
//$test_subject = $_POST['testsubject'];

/*if($test_name != null and $test_subject != null){
    $testobj = new Test($test_name, $test_subject);
    $testobj->insertTest();
}*/

?>