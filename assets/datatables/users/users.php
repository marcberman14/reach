<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";

$user = new UserDao();
session_cache_limiter('nocache');
header("Content-Type: application/json", true);

$users = $user->viewUsers();

if($users != null || $users() != false)
{
    $result_array= array();
    $aaData= array();
    $rowarray= array();
    //fetch associative array



    foreach($users as $row){
        $aaData["User ID"] = $row["user_id"];
		
		$usertype = $row["permission_name"];

        $aaData["First Name"] = '<form action="" method="POST">

<input type="hidden" name="id" id="id" value="'.$row["firstname"].'">
<a href="../viewer/index.php?type='.$usertype.'&identity='.$row["user_id"].'&name='.$row["firstname"].'">'.$row["firstname"].'</a>

</form>';

        $aaData["Last Name"] = $row["lastname"];
        $aaData["Email"] = $row["email"];
        $aaData["User Type"] = $row["permission_name"];
        $aaData["Active"] = $row["active"];
        array_push($rowarray ,$aaData);
    }
    $result_array['aaData'] = $rowarray;
    echo json_encode( $result_array );

} else{
    $result_array['aaData'] = '';
    echo json_encode( $result_array );
}

