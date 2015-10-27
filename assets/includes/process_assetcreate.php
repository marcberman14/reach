<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/SubjectLessonDao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/LessonDao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/LessonAssetDao.php";
$security = new Security();
$security->sec_session_start();

session_cache_limiter('nocache');

header("Content-Type: application/json", true);
if(isset($_REQUEST['id'])){


if(isset($_POST['lesson_video_name'], $_POST['lesson_video_link']))
{
    $lesson_video = filter_input(INPUT_POST, 'lesson_video_link', FILTER_SANITIZE_URL);
    $lesson_id = $_REQUEST['id'];
    $video_name = filter_input(INPUT_POST, 'lesson_video_name', FILTER_SANITIZE_STRING); 
    
    $assets = new LessonAssetDao();
    
    $yArray = array("lessonid" => $lesson_id, "type" => 'video', "url" => $lesson_video, "filename" => $video_name);

    $check = $assets->getAsset(array("lessonid"=>$lesson_id));
  
    
    if($check <= 0){
           $result = $assets->addAsset($yArray);
        if($result == 1){
            $arrResult = array ('response'=>'success','reason'=>'The video content has been succesfully uploaded.');
            echo json_encode($arrResult);
        } else {
            $arrResult = array ('response'=>'error','reason'=>'The lesson could not be uploaded. Please try again.');
            echo json_encode($arrResult);
        } 
    }else{
       // $pdfUrlArray = $assets->getAssetUrl(array("lessonid"=>$lesson_id));
       // $pdfUrl = $pdfUrlArray['url'];
      //  urldecode($pdfUrl);
      //  $unlink_target = "../../bin/lesson-content/" . $pdfUrl;
      //  unlink($unlink_target);
        $assets->deleteVideo(array("lessonid"=>$lesson_id));

        $result = $assets->addAsset($yArray);
        if($result == 1){
            $arrResult = array ('response'=>'success','reason'=>'The video content has been succesfully uploaded.');
            echo json_encode($arrResult);
        } else {
            $arrResult = array ('response'=>'error','reason'=>'The lesson could not be uploaded. Please try again.');
            echo json_encode($arrResult);
        } 
    }

    
} else {
        $arrResult = array ('response'=>'error','reason'=>'Please ensure you have entered all the required fields.');
        echo json_encode($arrResult);
   }
} else {
    $arrResult = array ('response'=>'warning','reason'=>'Please select a subject before you continue. You will be redirected shortly.');
    echo json_encode($arrResult);
}
?>