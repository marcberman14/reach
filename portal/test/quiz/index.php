<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TestDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/QuestionDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Test.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Question.php";

$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$security->refreshUser($_SESSION['user_id']);
$title = "Quiz";
$page_heading = "New Quiz";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

if($login['response'] != "error") {
include($_SERVER['DOCUMENT_ROOT'].$views->includeHeader($_SESSION['user']->getPermissionName()));

include($_SERVER['DOCUMENT_ROOT'].$views->includeLeftNav($_SESSION['user']->getPermissionName()));

$question = new QuestionDao();

$testid = $_GET['id'];

$mdata = $question->getTestQuestion(array("testid"=>$testid));

?>
<!doctype html>
<html class="fixed">
<head>
    <!-- Basic -->
    <meta charset="UTF-8">

    <title>Dashboard - Portal | R.E.A.CH - Monash South Africa</title>
    <meta name="description" content="Dashboard - Portal | R.E.A.CH - Monash South Africa">
    <meta name="author" content="Monash South Africa">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="/assets/stylesheets/theme.css" />
    <link rel="stylesheet" href="/assets/stylesheets/theme-admin-extension.css" />

    <link rel="stylesheet" href="/assets/vendor/morris/morris.css" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="/assets/stylesheets/colours/default.css" />

</head>
<body>
<!-- begin: breadcrumbs -->
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Quiz Management</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a class="sidebar-right-toggle" href="/portal/">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Subject</span></li>
                <li><span>Test</span></li>
                <li><span>Questions</span></li>
                <li><span>View</span></li>
            </ol>

            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- end: breadcrumbs -->
    <!--Quiz-->


                                        
                                        
                                        
                                        <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title"><?php echo $_REQUEST['testname']; ?>'s Questions</h2>
                    </header>
                    <div class="panel-body">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-md">
                                        <form method="POST" action="../new-question/question.php?testname=<?php echo $_GET['testname']; ?>&id=<?php echo $_GET['id']; ?>">
                                            <button class="btn btn-primary push-bottom">Add a question<i class="fa fa-plus"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <table class="table table-bordered table-striped" id="members" name="members">
                            <thead>
                            <tr>
                                <th width="5%">Question Number</th>
                                <th width="5%">Question</th>
                                <th width="5%">Question Marks</th>
                                <th width="5%">Correct Answer</th>
                                <th width="5%">Functions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                 //   $tablepop = Test::pullTestsBySubject(array(27, 29));
                                 //   for ($i=0; $i<count($tablepop); $i++){
                                  //      for($j=0; $j<count($tablepop[$i]); $j++){
                                  //          echo "<tr>";
                                   //         foreach($tablepop[$i][$j] as $value){
                                   //             echo "<td>" . $value ."</td>";
                                   //         }
                                  //          echo "<td><a href=" . "/portal/test/" . " class=" . "btn btn-primary" . ">Select Test</button></td>"; 
                                   //         echo "</tr>";
                                   //     }
                                   // }
                                ?> 
                            </tbody>
                        </table>
                    </div>
                    
                    </div>
                </section>

 
                                
                <div class="panel-panel-footer">
                   
                </div>


    <!--Quiz-->

           <?php
echo $views->addScript(Array("/assets/vendor/jquery/jquery.js",
    "/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js",
    "/assets/vendor/bootstrap/js/bootstrap.js",
    "/assets/vendor/nanoscroller/nanoscroller.js",
    "/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js",
    "/assets/vendor/magnific-popup/magnific-popup.js",
    "/assets/vendor/jquery-placeholder/jquery.placeholder.js",
    "/assets/vendor/modernizr/modernizr.js",
    "/assets/javascripts/theme.js",
    "/assets/javascripts/theme.init.js",
	"/assets/vendor/select2/select2.js",
	"/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js",
    "assets/vendor/jquery-datatables/media/js/jquery.dataTables.js",
	"/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"));
        echo $views->addStyle(Array("/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css",
            "/assets/vendor/select2/select2.css"));
    } else {
        ?>
        <script>
            window.location.href = "/user/login/";
        </script>
    <?php
    }
?>

            

<script>
   (function( $ ) {
        'use strict';
        var datatableInit = function() {
            var $table = $('#members');
            $table.dataTable({
                "language": {
                    "emptyTable": "There are no Questions available to view."
                },
                bProcessing: true,
                sAjaxSource:  "/assets/datatables/question/question.php?testname=<?php echo $_GET['testname'] ?>&testid=<?php echo $_GET['id'] ?>",
                "aoColumns": [
                    { "mData": "Question Number"},
					{ "mData": "Question"},
					{ "mData": "Question Marks"},
                    { "mData": "Correct Answer"},
					{ "mData": "Functions"}
					]

            });
        };
        $(function() {
            datatableInit();
        });
    }).apply( this, [ jQuery ]);
</script>            

</body>
</html>