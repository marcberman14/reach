<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/LessonAssetDao.php";
$security = new Security();
$lesson = new LessonAssetDao();
$security->sec_session_start();

session_cache_limiter('nocache');

header("Content-Type: application/json", true);
$user = new UserDao();

$target_dir = "../../bin/lesson-content/";
$target_file = $target_dir . basename($_FILES["documentupload"]["name"][0]);
$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["documentupload"]["tmp_name"][0]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo json_encode(Array("error" => "File is not an PDF document.", "errorkeys"=>"[0]"));
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
if ($_FILES["documentupload"]["size"][0] > 4000000) {
    $uploadOk = 0;
    echo json_encode(Array("error" => "Sorry, your file is too large.".$_FILES["documentupload"]["size"][0]."lol", "errorkeys"=>"[0]"));
    exit;
}
// Allow certain file formats
if($fileType != "pdf") {
    $uploadOk = 0;
    echo json_encode(Array("error" => "Sorry, only PDF documents are allowed.".$fileType."lol", "errorkeys"=>"[0]"));
    exit;
}

// Hash Image Name
$ext = pathinfo(basename($_FILES["documentupload"]["name"][0]), PATHINFO_EXTENSION);
$random_salt = hash('sha256', uniqid(mt_rand(1, mt_getrandmax()), true));
$FILENAME = hash_file("sha256", $_FILES["documentupload"]["tmp_name"][0]).$random_salt.".".$ext;
$uploadOk = 1;


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo json_encode(Array("error" => "Sorry, your file was not uploaded.", "errorkeys"=>"[0]"));
    exit;
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["documentupload"]["tmp_name"][0], "../../bin/lesson-content/".$FILENAME)) {
        $assets = new LessonAssetDao();

        $lesson_id = $_GET['id'];
        $array = array("lessonid"=>$lesson_id ,"type"=>$fileType, "url"=> $FILENAME, "filename" => $_FILES["documentupload"]["name"][0]);
        
        $check = $assets->getAsset(array("lessonid"=>$lesson_id));
        if($check <= 0)
        {
            
            $result = $lesson->addAsset($array);
            if($result == 1)
            {
                echo json_encode(Array("success" => "Your document successfully uploaded has been uploaded."));
                exit;
            }else 
            {
                $unlink_target = "../../bin/lesson-content/" . $FILENAME;
                echo json_encode(Array("error" => "Your file could not be uploaded", "errorkeys"=>"[0]"));
                exit;
            }
            
        }else
        {
            $pdfUrlArray = $assets->getPdfUrl(array("lessonid"=>$lesson_id));
            $pdfUrl = $pdfUrlArray['url'];
            urldecode($pdfUrl);
            $unlink_target = "../../bin/lesson-content/" . $pdfUrl;
            unlink($unlink_target);
            $assets->deletePdf(array("lessonid"=>$lesson_id));
            
            $result = $lesson->addAsset($array);
            if($result == 1){
                echo json_encode(Array("success" => "Your document successfully uploaded has been uploaded."));
                exit;
        } else 
            {
                $unlink_target = "../../bin/lesson-content/" . $FILENAME;
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
