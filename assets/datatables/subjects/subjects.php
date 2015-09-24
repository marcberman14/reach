<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';

header("Content-Type: application/json", true);

if($stmt = "SELECT * FROM subjects su join tutorsubject tu on su.subject_id = tu.subject_id join members m on tu.tutor_id = m.user_id")
{
	
    if ($result = $mysqli->query($stmt)) {
        $result_array= array();
        $aaData= array();
        $rowarray= array();
        //fetch associative array
        while ($row = $result->fetch_assoc() ){
            $aaData["Subject ID"] = $row["subject_id"];
			$subjectId = $row["subject_id"];
            $aaData["Subject Name"] = $row["subject_name"];
            $aaData["Subject Code"] = $row["subject_code"];
            $aaData["Subject Grade"] = $row["subject_grade"];
            $aaData["Subject Description"] = $row["subject_description"];
            $aaData["Subject Category"] = $row["subject_category"];
	        $aaData["Subject Tutor"] = $row["firstname"].' '.$row["lastname"];
			
			$aaData["Functions"] = '<form action="../edit/index.php" maetho="POST">

<input type="hidden" name="id" id="id" value="'.$subjectId.'">
<button type="submit" class="btn btn-primary push-bottom"><i class="fa fa-pencil fa-lg"></i></button>

</form>'.' <hr/> '.'<form action="../delete/index.php" maetho="POST">

<input type="hidden" name="id" id="id" value="'.$subjectId.'">
<button type="submit" class="btn btn-primary push-bottom"><i class="fa fa-trash-o fa-lg"></i></button>

</form>';
			
			
            array_push($rowarray ,$aaData);
        }
        $result_array['aaData'] = $rowarray;
        echo json_encode( $result_array );
    }
} else{
    $result_array['aaData'] = '';
    echo json_encode( $result_array );
}

