<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/ProfileDao.php";
require_once $_SERVER['DOCUMENT_ROOT']. "/assets/php/database/dao/UserDao.php";
require_once $_SERVER['DOCUMENT_ROOT']. "/assets/php/database/dao/StudentSubjectDao.php";
$subj = new StudentSubjectDao();
$user = new UserDao();
$security = new Security();
$profiles = new ProfileDao();
$security->sec_session_start();

session_cache_limiter('nocache');
header("Content-Type: application/json", true);

if (isset( $_POST['studateofbirth'], $_POST['stustreetno'], $_POST['stustreetname'],
    $_POST['stusuburb'], $_POST['stucity'], $_POST['stupostcode'], $_POST['stucountry'], $_POST['stuhomeno'],
    $_POST['stucellno'], $_POST['stualtno'], $_POST['stuparentno'], $_POST['stuschoolname'], $_POST['stugrade'],
    $_POST['stusubjects'])) {

    $stugender = filter_input(INPUT_POST, 'stugender', FILTER_SANITIZE_STRING);
    $studateofbirth = $_POST['studateofbirth'];
    $stustreetno = filter_input(INPUT_POST, 'stustreetno', FILTER_SANITIZE_NUMBER_INT);
    $stustreetname = filter_input(INPUT_POST, 'stustreetname', FILTER_SANITIZE_STRING);
    $stusuburb = filter_input(INPUT_POST, 'stusuburb', FILTER_SANITIZE_STRING);
    $stucity = filter_input(INPUT_POST, 'stucity', FILTER_SANITIZE_STRING);
    $stupostcode = filter_input(INPUT_POST, 'stupostcode', FILTER_SANITIZE_STRING);
    $stucountry = filter_input(INPUT_POST, 'stucountry', FILTER_SANITIZE_STRING);
    $stuhomeno = filter_input(INPUT_POST, 'stuhomeno', FILTER_SANITIZE_NUMBER_INT);
    $stucellno = filter_input(INPUT_POST, 'stucellno', FILTER_SANITIZE_NUMBER_INT);
    $stualtno = filter_input(INPUT_POST, 'stualtno', FILTER_SANITIZE_NUMBER_INT);
    $stuparentno = filter_input(INPUT_POST, 'stuparentno', FILTER_SANITIZE_NUMBER_INT);
    $stuschoolname = filter_input(INPUT_POST, 'stuschoolname', FILTER_SANITIZE_STRING);
    $stugrade = filter_input(INPUT_POST, 'stugrade', FILTER_SANITIZE_STRING);
    $stusubjects = $_POST['stusubjects'];

    if (isset($_SESSION['user_id'], $_SESSION['login_string'])) {
        $studateofbirth = date("Y-m-d", strtotime($studateofbirth));
        $user_id = $_SESSION['user_id'];
        $flag = false;
		$array = array("userId"=>$user_id,"streetnumber"=>$stustreetno,"streetname"=>$stustreetname,"suburb"=>$stusuburb,
            "city"=>$stucity,"country"=>$stucountry,"postalcode"=>$stupostcode,"homenumber"=>$stuhomeno,
            "cellnumber"=>$stucellno,"alternativenumber"=>$stualtno,"parentnumber"=>$stuparentno,"dob"=>$studateofbirth,
            "schoolname"=>$stuschoolname,"grade"=>$stugrade);
		$result = $user->insertStudent($array);
            if ($result == 1) {
                foreach ($stusubjects as $subject) {
					$array = array("user_id"=>$user_id,"stusubjectname"=>$subject);
					$result = $subj->insertSubject($array);
                }//end for each

                if($result == 1){
                    $result = $user->updateActive(Array("active"=> "active", "userid"=>$user_id));

                }
                if($result == 1){
                    $arrResult = array ('response'=>'success');
                    echo json_encode($arrResult);
                } else {
                    $arrResult = array ('response'=>'error','reason'=>'An Error occured while updating your profile, please try again later.');
                    echo json_encode($arrResult);
                }

            } else {
                $arrResult = array ('response'=>'error','reason'=>'You have already completed your profile. Please proceed to your portal to continue.');
                echo json_encode($arrResult);
            }
       

    }else {
        $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
        echo json_encode($arrResult);
    }

} else {
    $arrResult = array ('response'=>'error','reason'=>'Please ensure you have entered all the required fields.');
    echo json_encode($arrResult);
}

?>