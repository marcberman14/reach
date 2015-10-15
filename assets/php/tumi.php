<?php

echo "######################################### Tumisang #######################################################" . "\xA";

error_reporting(E_ALL);
ini_set('display_errors',1);

	//require_once 'database/dao/SecurityDao.php';
    //$tester = new SecurityDao();
	//var_dump($tester->loginSecurity("marc@bermanz.co.za"));
    //var_dump($tester->checkbrute("10",time()));

//echo "######################################### Marc Test ##########################################################" . "\xA";

	require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";
	//require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TutorSubjectDao.php";
	//require_once $_SERVER['DOCUMENT_ROOT']."/assets-new/php/database/dao/UserDao.php";
	//$subject = new Subject();
	//$tutsubject = new TutorSubjectDao();
	$user = new UserDao();

	
	//$userDetails -> firstname;
	
	
	//$tutsub = '45';
	
	$array = array("userid"=>12);
	
	//allTutors, allTeachers, allStudents
	
	$mdata = $user->allDetails($array);
	
	if($mdata!=false){
	
		$more1=$user->allTutors($array);
		$more2=$user->allTeachers($array);
		$more3=$user->allStudents($array);
		
		var_dump($mdata);
		
	
			if($more1!=false){				
				
				var_dump($more1);
				
			}elseif($more2!=false){
				
				var_dump($more2);
				
			}elseif($more3!=false){
				
				var_dump($more3);
				
				}else{
					
					echo "This has not completed their profile";
					
				}
	
	}else{
		
		echo "No data found";
	}
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