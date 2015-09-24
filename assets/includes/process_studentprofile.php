<?php
include_once 'db_connect.php';
include_once 'functions.php';

header("Content-Type: application/json", true);

sec_session_start();

if (isset($_POST['stugender'], $_POST['studateofbirth'], $_POST['stustreetno'], $_POST['stustreetname'],
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

    if (isset($_SESSION['user_id'], $_SESSION['username'],$_SESSION['login_string'])) {
        $studateofbirth = date("Y-m-d", strtotime($studateofbirth));
        $user_id = $_SESSION['user_id'];
        $flag = false;

        if ($stmt = $mysqli->prepare("INSERT INTO student( userId, streetnumber, streetname, suburb, city, country,
 postalcode, homenumber, cellnumber, alternativenumber, parentnumber, dob, schoolname, grade)
  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)")) {
            $stmt->bind_param('isssssssssssss', $user_id, $stustreetno, $stustreetname, $stusuburb, $stucity,
                $stucountry ,$stupostcode, $stuhomeno, $stucellno, $stualtno, $stuparentno, $studateofbirth,
                $stuschoolname, $stugrade);
            if ($stmt->execute()) {

                foreach ($stusubjects as $subject) {
                    if ($stmt = $mysqli->prepare("INSERT INTO studentsubject(user_id, stusubjectname) VALUES (?,?)")) {
                        $stmt->bind_param('is', $user_id, $subject);
                        if ($stmt->execute()) {
                            if ($stmt = $mysqli->prepare("UPDATE members SET active=? WHERE user_id=?")) {
                                $active ="active";
                                $stmt->bind_param('si', $active, $user_id);
                                if ($stmt->execute()) {

                                    $flag = true;
                                } else {
                                    $flag = false;
                                }
                            } else {
                                $flag = false;
                            }

                            $flag = true;
                        } else {
                            $flag = false;
                        }
                    } else {
                        $flag = false;
                    }

                }//end for each
                if($flag == true){
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
        } else {
            // Could not prepare statement
            $arrResult = array('response' => 'error', 'reason' => 'A fatal error occurred. Please try again later.');
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