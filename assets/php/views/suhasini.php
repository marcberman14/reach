<?php

//echo "######################################### Suhasini #######################################################" . "\xA";

//error_reporting(E_ALL);
//ini_set('display_errors',1);

	//require_once 'database/dao/SecurityDao.php';
  //  $tester = new SecurityDao();
	//var_dump($tester->loginSecurity("marc@bermanz.co.za"));
    //var_dump($tester->checkbrute("10",time()));

echo "######################################### Suhasini  Test ##########################################################" . "\xA";

	require_once $_SERVER['DOCUMENT_ROOT']."/assets-new/php/classes/User.php";
	$user = new User();
    var_dump($user->getUserID(user_id));
    //var_dump($security->login("marc@berDmanz.co.za","Em1cr4m747#"));




?>