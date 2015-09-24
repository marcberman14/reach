<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';

header("Content-Type: application/json", true);

if($stmt = "SELECT m.user_id, m.firstname, m.lastname, m.email, p.permission_name, m.active FROM members m join permission_group p  ON m.permission_id = p.permission_id")
{
    if ($result = $mysqli->query($stmt)) {
        $result_array= array();
        $aaData= array();
        $rowarray= array();
        //fetch associative array
        while ($row = $result->fetch_assoc() ){
            $aaData["User ID"] = $row["user_id"];
            $aaData["First Name"] = $row["firstname"];
            $aaData["Last Name"] = $row["lastname"];
            $aaData["Email"] = $row["email"];
            $aaData["User Type"] = $row["permission_name"];
            $aaData["Active"] = $row["active"];
            array_push($rowarray ,$aaData);
        }
        $result_array['aaData'] = $rowarray;
        echo json_encode( $result_array );
    }
} else{
    $result_array['aaData'] = '';
    echo json_encode( $result_array );
}

