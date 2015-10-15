<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/ProfileDao.php";
$security = new Security();
$profiles = new ProfileDao();
$security->sec_session_start();

session_cache_limiter('nocache');

header("Content-Type: application/json", true);

if (isset($_POST['admdateofbirth'], $_POST['admstreetno'], $_POST['admstreetname'], $_POST['admsuburb'],
$_POST['admcity'], $_POST['admpostcode'], $_POST['admcountry'], $_POST['admhomeno'], $_POST['admcellno'], $_POST['admaltno'],
$_POST['admmail'], $_POST['admwmail'], $_POST['admworknum'], $_POST['admstaffnum'], $_POST['admworkdepart'], $_POST['admworkpos'])) {

    $admdateofbirth = filter_input(INPUT_POST, 'admdateofbirth', FILTER_SANITIZE_STRING);
    $admstreetno = filter_input(INPUT_POST, 'admstreetno', FILTER_SANITIZE_NUMBER_INT) ;
    $admstreetname = filter_input(INPUT_POST, 'admstreetname', FILTER_SANITIZE_STRING);
    $admsuburb = filter_input(INPUT_POST, 'admsuburb', FILTER_SANITIZE_STRING);
    $admcity = filter_input(INPUT_POST, 'admcity', FILTER_SANITIZE_STRING);
    $admpostcode = filter_input(INPUT_POST, 'admpostcode', FILTER_SANITIZE_NUMBER_INT);
    $admcountry = filter_input(INPUT_POST, 'admcountry', FILTER_SANITIZE_EMAIL);
    $admhomeno = filter_input(INPUT_POST, 'admhomeno', FILTER_SANITIZE_NUMBER_INT);
    $admcellno = filter_input(INPUT_POST, 'admcellno', FILTER_SANITIZE_NUMBER_INT);
    $admaltno = filter_input(INPUT_POST, 'admaltno', FILTER_SANITIZE_NUMBER_INT);
    $admmail = filter_input(INPUT_POST, 'admmail', FILTER_VALIDATE_EMAIL);
    $admwmail = filter_input(INPUT_POST, 'admwmail', FILTER_VALIDATE_EMAIL);
    $admworknum = filter_input(INPUT_POST, 'admworknum', FILTER_SANITIZE_NUMBER_INT);
    $admstaffnum = filter_input(INPUT_POST, 'admstaffnum', FILTER_SANITIZE_NUMBER_INT);
    $admworkdepart = filter_input(INPUT_POST, 'admworkdepart', FILTER_SANITIZE_STRING);
    $admworkpos = filter_input(INPUT_POST, 'admworkpos', FILTER_SANITIZE_STRING);

    if (isset($_SESSION['user_id'], $_SESSION['login_string'])) {
        $admdateofbirth = date("Y-m-d", strtotime($admdateofbirth));
        $user_id = $_SESSION['user_id'];
        $values = Array ("user_id"=>$user_id,"dob"=>$admdateofbirth,"streetnumber"=>$admstreetno,
            "streetname"=>$admstreetname,"suburb"=>$admsuburb,"city"=>$admcity,"country"=>$admcountry,"postalcode"=>$admpostcode,"homenumber"=>$admhomeno,
            "cellphone"=>$admcellno,"worknumber"=>$admworknum,"staffnumber"=>$admstaffnum,"jobdepartment"=>$admworkdepart,
            "jobposition"=>$admworkpos,"monashmail"=>$admwmail,"alternativeemail"=>$admmail,"altcontactnum"=>$admaltno);

        $result = $profiles->insertAdminProfile($values);
        if($result > 0){
            $active ="active";
            $values = Array ("user_id"=>$user_id,"active"=>$active);
            $result = $profiles->updateProfileStatus($values);

            if($result > 0){
                    $arrResult = array ('response'=>'success', 'reason'=>'Your profile has been successfully update, please wait while you are redirected to your portal.');
                    echo json_encode($arrResult);
                } else {
                    $arrResult = array('response' => 'error', 'reason' => 'An error occured while activating your profile, please contact an administrator to have it activated manually or try again.');
                    echo json_encode($arrResult);
                }
            } else {
                $arrResult = array ('response'=>'error','reason'=>'Oops, something has happened. Please try again.');
                echo json_encode($arrResult);
            }
    }
    else {
        $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
        echo json_encode($arrResult);
    }

}
else {
    $arrResult = array ('response'=>'error','reason'=>'Please ensure you have entered all the required fields.');
    echo json_encode($arrResult);
}

?>