<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/SecurityDao.php";
$security = new Security();
$security->sec_session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/UserDao.php";
$user = new UserDao();

header("Content-Type: application/json", true);

if (isset($_POST['userid'], $_POST['active'])) {
    // Sanitize and validate the data passed in
    $userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_NUMBER_INT);
    $active = filter_input(INPUT_POST, 'active', FILTER_SANITIZE_STRING);

    $result = $user->userApprovalUpdate(Array("active" => $active, "userid" => $userid));
    if ($result > 0) {
        $arrResult = array('response' => 'success', 'reason' => 'User has been updated.');
        echo json_encode($arrResult);
    } else {
        $arrResult = array('response' => 'error', 'reason' => 'Your request could not be compelted safely. Userid: '.$userid.' Active: '.$active. ' Result: '.$result);
        echo json_encode($arrResult);
    }
} else {
    $arrResult = array('response' => 'error', 'reason' => 'Please ensure you have entered all the required fields.');
    echo json_encode($arrResult);
}

?>