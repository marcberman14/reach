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
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// Hash Image Name
$ext = pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION);
$FILENAME = hash_file("sha256", $_FILES["fileToUpload"]["tmp_name"] ).".".$ext;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
       
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "../../bin/user-profile/".$FILENAME)) {
        
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $user_id = $_SESSION['user']->getUserID();
        $cur_pic = $_SESSION['user']->getPicUrl();
        if($cur_pic != "default.png")
        {
            $unlink_target = "../../bin/user-profile/" . $cur_pic;
            unlink($unlink_target);
        }
		
		$array = array("profilepicurl"=>$FILENAME ,"user_id"=>$user_id);
		
		$user->uploadpicurl($array);
        
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

//don't know how to redirect back to page :/

?>