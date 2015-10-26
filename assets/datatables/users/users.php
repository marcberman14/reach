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

        $aaData["First Name"] = $row["firstname"];

        $aaData["Last Name"] = $row["lastname"];
        $aaData["Email"] = $row["email"];
        $aaData["User Type"] = $row["permission_name"];
        $aaData["Active"] = ucfirst($row["active"]);
        $aaData["Functions"] = '&nbsp;<a href="../viewer/index.php?type='.$row["permission_name"].'&identity='.$row["user_id"].'&name='.$row["firstname"].'" class="on-default edit-row"  title="View"><i class="fa fa-2x fa-eye"></i></a>
        &nbsp;<a href="../edit/index.php?id='.urlencode($row["user_id"]).'&type='.urlencode($row["permission_name"]).'" class="on-default edit-row" title="Edit"><i class="fa fa-2x fa-pencil"></i></a>
        &nbsp;<a href="../delete/index.php?id='.$row["user_id"].'" class="on-default delete-row" title="Edit"><i class="fa fa-2x fa-trash-o"></i></a>';

        array_push($rowarray ,$aaData);
    }
    $result_array['aaData'] = $rowarray;
    echo json_encode( $result_array );

} else{
    $result_array['aaData'] = '';
    echo json_encode( $result_array );
}

