<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";

$user = new UserDao();
session_cache_limiter('nocache');
header("Content-Type: application/json", true);

$users = $user->userApprovalList();

if($users != null || $users() != false)
{
    $result_array= array();
    $aaData= array();
    $rowarray= array();
    //fetch associative array

    foreach($users as $row){

        $aaData["User ID"] = $row["user_id"];
        $aaData["First Name"] = $row["firstname"];
        $aaData["Last Name"] = $row["lastname"];
        $aaData["Email"] = $row["email"];
        $aaData["User Type"] = $row["permission_name"];


        if($row["active"] == "active"){
            $approved = '<select class="form-control input" name="active" id="'.$row["user_id"].'" onchange="autosave(this.id,$(this).val( ))">
                      <option selected value="active">Activated</option>
                      <option value="noprofile">Approve - No Profile</option>
                      <option value="notapproved">Approval Pending</option>
                      <option value="inactive">Deactivated</option>
                      <option value="invalid">Deny User</option>
                      <option value="emailverify">Verify Email</option>
                  </select>';
        } elseif ($row["active"] == "inactive") {
            $approved = '<select class="form-control input" name="active" id="'.$row["user_id"].'" onchange="autosave(this.id,$(this).val( ))">
                      <option value="active">Activated</option>
                      <option value="noprofile">Approve - No Profile</option>
                      <option value="notapproved">Approval Pending</option>
                      <option selected value="inactive">Deactivated</option>
                      <option value="invalid">Deny User</option>
                      <option value="emailverify">Verify Email</option>
                  </select>';
        } elseif ($row["active"] == "noprofile") {
            $approved = '<select class="form-control input" name="active" id="'.$row["user_id"].'" onchange="autosave(this.id,$(this).val( ))">
                      <option value="active">Activated</option>
                      <option selected value="noprofile">Approve - No Profile</option>
                      <option value="notapproved">Approval Pending</option>
                      <option value="inactive">Deactivated</option>
                      <option value="invalid">Deny User</option>
                      <option value="emailverify">Verify Email</option>
                  </select>';
        } elseif ($row["active"] == "notapproved") {
            $approved = '<select class="form-control input" name="active" id="'.$row["user_id"].'" onchange="autosave(this.id,$(this).val( ))">
                      <option value="active">Activated</option>
                      <option value="noprofile">Approve - No Profile</option>
                      <option selected value="notapproved">Approval Pending</optionselected>
                      <option value="inactive">Deactivated</option>
                      <option value="invalid">Deny User</option>
                      <option value="emailverify">Verify Email</option>
                  </select>';
        } elseif ($row["active"] == "invalid") {
            $approved =  '<select class="form-control input" name="active" id="'.$row["user_id"].'" onchange="autosave(this.id,$(this).val( ))">
                      <option value="active">Activated</option>
                      <option value="noprofile">Approve - No Profile</option>
                      <option value="notapproved">Approval Pending</option>
                      <option value="inactive">Deactivate</option>
                      <option selected value="invalid">Deny User</option>
                      <option value="emailverify">Verify Email</option>
                  </select>';
        }else {
            $approved = '<select class="form-control input" name="active" id="'.$row["user_id"].'" onchange="autosave(this.id,$(this).val( ))">
                      <option value="active">Activated</option>
                      <option value="noprofile">Approve - No Profile</option>
                      <option value="notapproved">Approval Pending</option>
                      <option value="inactive">Deactivate</option>
                      <option value="invalid">Deny User</option>
                      <option selected value="emailverify">Verify Email</option>
                  </select>';
        }
        $aaData["Approve"] = $approved;

        array_push($rowarray ,$aaData);
    }
    $result_array['aaData'] = $rowarray;
    echo json_encode( $result_array );

} else{
    $result_array['aaData'] = '';
    echo json_encode( $result_array );
}

