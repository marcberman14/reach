<?php

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/ProfileDao.php";
$security = new Security();
$profiles = new ProfileDao();
$security->sec_session_start();

session_cache_limiter('nocache');

header("Content-Type: application/json", true);
$user = new UserDao();

$target_dir = "../../bin/user-profile/";
$target_file = $target_dir . basename($_FILES["profileupload"]["name"][0]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["profileupload"]["tmp_name"][0]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo json_encode(Array("error" => "File is not an image.", "errorkeys"=>"[0]"));
        $uploadOk = 0;
        exit;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo json_encode(Array("error" => "The file already exists and could not be uploaded.", "errorkeys"=>"[0]"));
    $uploadOk = 0;
    exit;
}
// Check file size
if ($_FILES["profileupload"]["size"][0] > 500000) {
    $uploadOk = 0;
    echo json_encode(Array("error" => "Sorry, your file is too large.", "errorkeys"=>"[0]"));
    exit;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $uploadOk = 0;
    echo json_encode(Array("error" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed.", "errorkeys"=>"[0]"));
    exit;
}

// Hash Image Name
$ext = pathinfo(basename($_FILES["profileupload"]["name"][0]), PATHINFO_EXTENSION);
$random_salt = hash('sha256', uniqid(mt_rand(1, mt_getrandmax()), true));
$FILENAME = hash_file("sha256", $_FILES["profileupload"]["tmp_name"][0]).$random_salt.".".$ext;
$uploadOk = 1;


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo json_encode(Array("error" => "Sorry, your file was not uploaded.", "errorkeys"=>"[0]"));
    exit;
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["profileupload"]["tmp_name"][0], "../../bin/user-profile/".$FILENAME)) {


        $user_id = $_SESSION['user']->getUserID();
        $cur_pic = $_SESSION['user']->getPicUrl();
        if($cur_pic != "default.png") {
            $unlink_target = "../../bin/user-profile/" . $cur_pic;
            unlink($unlink_target);

            $array = array("profilepicurl"=>$FILENAME ,"user_id"=>$user_id);
            $result = $user->uploadpicurl($array);
            if($result == 1){
                echo json_encode(Array("success" => "Your profile picture has been uploaded."));
                exit;
            } else {
                $unlink_target = "../../bin/user-profile/" . $FILENAME;
                echo json_encode(Array("error" => "Your file could not be uploaded", "errorkeys"=>"[0]"));
                exit;
            }
        } else {
            $array = array("profilepicurl"=>$FILENAME ,"user_id"=>$user_id);
            $result = $user->uploadpicurl($array);
            if($result == 1){
                echo json_encode(Array("success" => "Your profile picture has been uploaded."));
                exit;
            } else {
                $unlink_target = "../../bin/user-profile/" . $FILENAME;
                echo json_encode(Array("error" => "Your file could not be uploaded", "errorkeys"=>"[0]"));
                exit;
            }
        }

    } else {
        echo json_encode(Array("error" => "Sorry, there was an error uploading your file.", "errorkeys"=>"[0]"));
        exit;
    }
}
?>