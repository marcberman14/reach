<?php

echo "######################################### Tumisang #######################################################" . "\xA";

error_reporting(E_ALL);
ini_set('display_errors',1);

	//require_once 'database/dao/SecurityDao.php';
    //$tester = new SecurityDao();
	//var_dump($tester->loginSecurity("marc@bermanz.co.za"));
    //var_dump($tester->checkbrute("10",time()));

//echo "######################################### Marc Test ##########################################################" . "\xA";

	require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TestDao.php";
	//require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TutorSubjectDao.php";
	//require_once $_SERVER['DOCUMENT_ROOT']."/assets-new/php/database/dao/UserDao.php";
	//$subject = new Subject();
	//$tutsubject = new TutorSubjectDao();
	$user = new TestDao();

	
	//$userDetails -> firstname;
	
	
	//$tutsub = '45';
	
	$array = array("testid"=>33);
	
	//allTutors, allTeachers, allStudents
	
	$mdata = $user->getTest($array);
	
	var_dump($mdata);
	
	var_dump($mdata[0]['test_name']);
	//$hi = $data['firstname'];	
	
	
	
	//$array = array("subject_code" =>$subject->getSubject_code(), "subject_name" => $subject->getSubject_name(),"subject_grade" => $subject->getSubject_grade(),"subject_description" => $subject->getSubject_description(), "subject_category" =>$subject->getSubject_category());
	
	 //$arr = array("subject_code" =>$subject->getSubject_code());
	 
	 //$title = "slow";
	 
	 //$array1 = array("title" =>$title);
	
	//$res = $subject->addSubject($array);
	//$results = $tutsubject->add($arr,$tutsub);
	
    
	//var_dump($res);
    //var_dump($security->login("marc@berDmanz.co.za","Em1cr4m747#"));
	
	




?>