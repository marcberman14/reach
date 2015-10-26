<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";

$users = new UserDao();

session_cache_limiter('nocache');

header("Content-Type: application/json", true);

$result = $users->tutors();
if($result > 0)
{
    $result_array= array();
    $aaData= array();
    $rowarray= array();
    //fetch associative array

    foreach($result as $row){
            $aaData["User ID"] = $row["user_id"];
            $subjectId = $row["user_id"];
            $aaData["First Name"] = $row["firstname"];
            $aaData["Last Name"] = $row["lastname"];
            $aaData["Email"] = $row["email"];
            $aaData["Select"] = '<label><input type="radio" value="'.$row["user_id"].'" name="selecttutor" id="selecttutor"></label>';
            array_push($rowarray ,$aaData);
        }


    $result_array['aaData'] = $rowarray;
    echo json_encode( $result_array );

} else {
    $aaData["User ID"] = "";
    $aaData["First Name"] = "";
    $aaData["Last Name"] = "";
    $aaData["Email"] = "";
    $aaData["Select"] = "";
    array_push($rowarray ,$aaData);
    echo json_encode( $rowarray );
}


?>

