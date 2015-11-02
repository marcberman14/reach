<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/LessonDao.php";

$security = new Security();
$security->sec_session_start();

session_cache_limiter('nocache');


$stulesson = new LessonDao();

header("Content-Type: application/json", true);
$result = $stulesson->allLessons();

if($result > 0)
{
    $result_array= array();
    $aaData= array();
    $rowarray= array();
    //fetch associative array

    foreach($result as $row){
        $aaData["Lesson ID"] = $row["lesson_id"];
        $lessonId = $row["lesson_id"];
        $aaData["Lesson Title"] = $row["lesson_title"];
        $aaData["Lesson Name"] = $row["lesson_name"];
        $aaData["Lesson Description"] = $row["lesson_description"];
        $aaData["Lesson Concept"] = $row["lesson_concpet"];
        $aaData["Lesson Material"] = $row["lesson_material"];
        $aaData["Lesson Subject"] = $row["subject_name"];
        $aaData["Functions"] = ' &nbsp;<a href="../view/index.php?id='.$lessonId.'" class="on-default view-row"><i class="fa fa-2x fa-folder-o"></i></a>



		&nbsp;&nbsp;<a href="../view/index.php?id='.$lessonId.'" class="on-default view-row"><i class="fa fa-2x fa-folder-o"></i></a>';
        array_push($rowarray ,$aaData);
    }


    $result_array['aaData'] = $rowarray;
    echo json_encode( $result_array );

} else {
    $aaData["Lesson ID"] = "";
    $lessonId = "";
    $aaData["Lesson Title"] = "";
    $aaData["Lesson Name"] = "";
    $aaData["Lesson Description"] = "";
    $aaData["Lesson Concept"] = "";
    $aaData["Lesson Material"] = "";
    $aaData["Lesson Subject"] = "";
    $aaData["Functions"] = "";
    array_push($rowarray ,$aaData);
    echo json_encode( $rowarray );
}

?>
