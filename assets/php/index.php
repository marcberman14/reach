<?php

 error_reporting(E_ALL);
 ini_set('display_errors', 1);

echo "######################################### Byron $ Kutlwano Test ##########################################################" . "\xA";

 

	require_once $_SERVER['DOCUMENT_ROOT']."/assets-new/php/classes/Student.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets-new/php/classes/User.php";

$user = new User();
$data = $user->pullUser(20);

	$student = new Student();
$sdata = $student->pullStudent(20);

var_dump($data);
	var_dump($sdata);
	
?>