<?php

echo "######################################### Tumisang #######################################################" . "\xA";

error_reporting(E_ALL);
ini_set('display_errors',1);

	//require_once 'database/dao/SecurityDao.php';
    //$tester = new SecurityDao();
	//var_dump($tester->loginSecurity("marc@bermanz.co.za"));
    //var_dump($tester->checkbrute("10",time()));

//echo "######################################### Marc Test ##########################################################" . "\xA";

	require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/AnswerDao.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TestDao.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/EnrolmentDao.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/StudentDao.php";
	//require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TutorSubjectDao.php";
	//require_once $_SERVER['DOCUMENT_ROOT']."/assets-new/php/database/dao/UserDao.php";
	//$subject = new Subject();
	//$tutsubject = new TutorSubjectDao();
	//$tes = new TestDao();
	
	//$ans = new AnswerDao();
	
	//$que = new QuestionDao();
	
	//$res = new ResultDao();
	
	//$array1 = array("testid"=>56);
	
	//$array2 = array("testid"=>56,"user"=>107);
	
	//$question = $que->getTestQuestion($array1);
	
	//$answer = $ans->getAnswers($array2);
	
	//$result = $res->viewTestResult($array2);
	
	//$test = $tes->test($array1);
	//$subid = 81;
	
	$student = new StudentDao();
	
	$enrolment = new EnrolmentDao();
	
	$test = new TestDao();
	
	

$array = array("user"=>100);



$tests = $student->getStudent($array);

$studentid = $tests['studentId'];

$array = array("user"=>$studentid);


$enrol = $enrolment->getEnrol($array);


$subjectid = $enrol[0]['subject_id'];

$array = array("subjectid"=>$subjectid);

$testing = $test->getSubjTest($array);


	
	//$userDetails -> firstname;
	
	
	//$tutsub = '45';
	
	
	
	//allTutors, allTeachers, allStudents
	
	//$mdata = $ques->viewQuestions($array);
	
	//var_dump($mdata);
	
	
	
	//$marks = $test['test_marks'];
	
	//var_dump($question);
	
	//var_dump($answer);
	
	//var_dump($result);
	
	var_dump($testing);
	
	//var_dump($mdata[0]['test_name']);
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