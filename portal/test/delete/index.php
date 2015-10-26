<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TestDao.php";


$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$security->refreshUser($_SESSION['user_id']);
$title = "Dashboard";
$page_heading = "Dashboard";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";



header("Content-Type: application/json", true);

$test = new TestDao();
$test->deleteTest(Array("test_id"=>$_GET['id']));
header('location:http://vps.bermanz.co.za/portal/test/view-tests/');

?>