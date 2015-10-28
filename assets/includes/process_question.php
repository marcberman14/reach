<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/ProfileDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TestDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/QuestionDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Test.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Question.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/SubjectLessonDao.php";
$security = new Security();
$profiles = new ProfileDao();
$security->sec_session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);


session_cache_limiter('nocache');

header("Content-Type: application/json", true);

if(isset($_POST["question_id"],$_POST["question"],$_POST["wanswer"],$_POST["wanswer1"],$_POST["wanswer2"],$_POST["wanswer3"],$_POST["canswer"] )){
    $question=filter_input(INPUT_POST, 'question', FILTER_SANITIZE_STRING);
    $wanswer = filter_input(INPUT_POST, 'wanswer1', FILTER_SANITIZE_STRING);
    $wanswer1 = filter_input(INPUT_POST, 'wanswer2', FILTER_SANITIZE_STRING);
    $wanswer2 = filter_input(INPUT_POST, 'wanswer3', FILTER_SANITIZE_STRING);
    $wanswer3 = filter_input(INPUT_POST, 'wanswer4', FILTER_SANITIZE_STRING);
    $canswer = filter_input(INPUT_POST, 'canswer', FILTER_SANITIZE_STRING);


    $array = array("question" =>$question, "Wrong Answer" => $wanswer,"Wrong answer 1" => $wanswer1,"Wrong answer 2" => $wanswer2, "Wrong answer 3" =>$wanswer3,"Correct answer3" =>$canswer);



    $tester = new TestDao();
    $testobj = $tester->pullTest(array('testid' => $test_id));
    if($testobj != null){
        $questobj = new Question($question_text, $correct_answer, $wrong_answer1, $wrong_answer2, $wrong_answer3, $test_id);
        $questobj->insertQuestion();
		
		header('location:http://vps.bermanz.co.za/portal/test/new-test/index.php');
		

}


}else{
$arrResult = array ('response'=>'error','reason'=>'A fatal error has occurred, if this problem persists please contact an administrator.');
echo json_encode($arrResult);
}
?>