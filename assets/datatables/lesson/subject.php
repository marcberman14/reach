<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/SubjectDao.php";

$subject = new SubjectDao();

session_cache_limiter('nocache');

header("Content-Type: application/json", true);

$result = $subject->getSubjectTut();
if($result > 0)
{
    $result_array= array();
    $aaData= array();
    $rowarray= array();
    //fetch associative array

    foreach($result as $row){
        $aaData["Subject ID"] = $row["subject_id"];
        $subjectId = $row["subject_id"];
        $aaData["Subject Name"] = '<form action="" method="POST">

<input type="hidden" name="id" id="id" value="'.$row["subject_name"].'">
<a href="../viewer/index.php?identity='.$row["subject_id"].'&name='.$row["subject_name"].'">'.$row["subject_name"].'</a>

</form>';
        $aaData["Subject Code"] = $row["subject_code"];
        $aaData["Subject Grade"] = $row["subject_grade"];
        $aaData["Subject Description"] = $row["subject_description"];
        $aaData["Subject Category"] = $row["subject_category"];
        $aaData["Subject Tutor"] = $row["firstname"].' '.$row["lastname"];
        $aaData["Select Subject"] = '<label><input type="radio" value="'.$subjectId.'" name="selectsub" id="selectsub"></label>';
        array_push($rowarray ,$aaData);
    }


    $result_array['aaData'] = $rowarray;
    echo json_encode( $result_array );

} else {
    $aaData["Subject ID"] = "";
    $aaData["Subject Name"] = "";
    $aaData["Subject Code"] = "";
    $aaData["Subject Grade"] = "";
    $aaData["Subject Description"] = "";
    $aaData["Subject Category"] = "";
    $aaData["Subject Tutor"] = "";
    $aaData["Select Subject"] = "";
    array_push($rowarray ,$aaData);
    echo json_encode( $rowarray );
}


?>

