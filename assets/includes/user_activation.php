<?php
include_once 'db_connect.php';
include_once 'functions.php';

header("Content-Type: application/json", true);

if (isset($_POST['userid'],$_POST['active'])) {
    // Sanitize and validate the data passed in
    $userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_NUMBER_INT);
    $active = filter_input(INPUT_POST, 'active', FILTER_SANITIZE_STRING);

        if ($update_stmt = $mysqli->prepare("UPDATE members SET active = ? WHERE user_id = ? ")) {
            $update_stmt->bind_param('si',$active, $userid);
            // Execute the prepared query.
            if (! $update_stmt->execute()) {
                $arrResult = array ('response'=>'error','reason'=>'Your request could not be compelted safely.');
                echo json_encode($arrResult);
            } else {
                $arrResult = array ('response'=>'success');
                echo json_encode($arrResult);
            }
        } else {
            $arrResult = array ('response'=>'error','reason'=>"Registration failed, if the problem persists please contact an administrator.");
            echo json_encode($arrResult);
        }


} else {
    $arrResult = array ('response'=>'error','reason'=>'Please ensure you have entered all the required fields.');
    echo json_encode($arrResult);
}

?>