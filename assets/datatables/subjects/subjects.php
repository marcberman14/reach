<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/SubjectDao.php";

$subject = new SubjectDao();

session_cache_limiter('nocache');

header("Content-Type: application/json", true);
$result = $subject->getSubjectTut();
if ($result > 0) {
    $result_array = array();
    $aaData = array();
    $rowarray = array();
    //fetch associative array
    foreach ($result as $row) {
        $aaData["Subject ID"] = $row["subject_id"];
        //$subjectId = $row["subject_id"];
        $aaData["Subject Name"] = $row["subject_name"];
        $aaData["Subject Code"] = $row["subject_code"];
        $aaData["Subject Grade"] = $row["subject_grade"];
        $aaData["Subject Description"] = $row["subject_description"];
        $aaData["Subject Category"] = $row["subject_category"];
        $aaData["Subject Tutor"] = $row["firstname"] . ' ' . $row["lastname"];

        $token = hash('sha256', $row["subject_id"] . $row["subject_name"]);
        $aaData["Functions"] = '&nbsp;<a href="../viewer/index.php?id=' . urlencode($row["subject_id"]) . '&name=' . urlencode($row["subject_name"]) . '" class="on-default edit-row"  title="View"><i class="fa fa-2x fa-eye"></i></a>
        &nbsp;<a href="../edit/index.php?id=' . urlencode($row["subject_id"]) . '&code=' . urlencode($row["subject_code"]) . '" class="on-default edit-row" title="Edit"><i class="fa fa-2x fa-pencil"></i></a>
        &nbsp;<a href="/portal/subject/delete/index.php?id='. urlencode($row["subject_id"]). '&token=' . urlencode($token) . '&subname=' . urlencode($row["subject_name"]) .'" class="on-default delete-row" title="Edit"><i class="fa fa-2x fa-trash-o"></i></a>';

        array_push($rowarray, $aaData);
    }

    $result_array['aaData'] = $rowarray;
    echo json_encode($result_array);

} else {
    $aaData["Subject ID"] = "";
    $aaData["Subject Name"] = "";
    $aaData["Subject Code"] = "";
    $aaData["Subject Grade"] = "";
    $aaData["Subject Description"] = "";
    $aaData["Subject Category"] = "";
    $aaData["Subject Tutor"] = "";
    $aaData["Functions"] = "";
    array_push($rowarray, $aaData);
    echo json_encode($rowarray);
}

?>

