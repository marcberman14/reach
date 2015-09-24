<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';

header("Content-Type: application/json", true);

if($stmt = "SELECT * FROM lesson su join subjectlesson tu on su.lesson_id = tu.lesson_id join subjects s on s.subject_id = tu.subject_id ")
{
	
    if ($result = $mysqli->query($stmt)) {
        $result_array= array();
        $aaData= array();
        $rowarray= array();
        //fetch associative array
		
		while ($row = $result->fetch_assoc() ){
            $aaData["Lesson ID"] = $row["lesson_id"];
			$lessonId = $row["lesson_id"];
            $aaData["Lesson Title"] = $row["lesson_title"];
            $aaData["Lesson Name"] = $row["lesson_name"];
            $aaData["Lesson Description"] = $row["lesson_description"];
            $aaData["Lesson Concept"] = $row["lesson_concpet"];
            $aaData["Lesson Material"] = $row["lesson_material"];
	        $aaData["Lesson Subject"] = $row["subject_name"];
			$aaData["Functions"] = '<form action="../edit/index.php" maetho="POST">

<input type="hidden" name="id" id="id" value="'.$lessonId.'">
<button type="submit" class="btn btn-primary push-bottom"><i class="fa fa-pencil fa-lg"></i></button>

</form>'.' <hr/> '.'<form action="../delete/index.php" maetho="POST">

<input type="hidden" name="id" id="id" value="'.$lessonId.'">
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

