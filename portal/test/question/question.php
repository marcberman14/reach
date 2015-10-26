<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/SubjectDao.php";

$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$state = $security->userActiveState();
$title = "New Lesson";
$page_heading = "New Lesson";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

if($login['response'] != "error" && $state['response']== 'success') {
$security->refreshUser($_SESSION['user_id']);

if($state['response']== 'warning'){
    echo $state['script'];
}

include($_SERVER['DOCUMENT_ROOT'].$views->includeHeader($_SESSION['user']->getPermissionName()));
include($_SERVER['DOCUMENT_ROOT'].$views->includeLeftNav($_SESSION['user']->getPermissionName()));
	
	require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/QuestionDao.php";
	
	
	$questionnumber = $_GET['quest'];
	
	$pagenumber = 1;
	
	
	$ques = new QuestionDao();
	
	$testid = $_GET['id'];
	
	$array = array("testid"=>$testid);
	
	$mdata = $ques->getTestQuestion($array);
	
	
	
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
            </ol>

            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- end: breadcrumbs -->
<!--Questions to Answer-->

<div class="panel-body">


    <fieldset>
        <div class="col-md-12 col-md-offset-0.5">
            <div class="form-group">
                
                <fieldset>
                <legend>Question <?php echo ($questionnumber+1);?></legend>
                <h4><?php echo $mdata[$questionnumber]['question'] ;?></h4>
                </fieldset>
                <div class="radio">
                    <label for="optradio1"></label>
                    <input type="radio" name="optradio1">1.<?php echo $mdata[$questionnumber]['correctanswer'] ;?></input>
                </div>
                <div class="radio">
                    <label for="optradio2"></label>
                    <input type="radio" name="optradio2">2.<?php echo $mdata[$questionnumber]['wronganswer1'] ;?></input>
                </div>
                <div class="radio">
                    <label for="optradio3"></label>
                    <input type="radio" name="optradio3">3.<?php echo $mdata[$questionnumber]['wronganswer2'] ;?></input>
                </div>
                <div class="radio">
                    <label for="optradio4"></label>
                    <input type="radio" name="optradio4">4.<?php echo $mdata[$questionnumber]['wronganswer3'] ;?></input>
                </div>
            </div>
        </div>
    </fieldset>

    <form method="POST" action="../question/question.php?id=<?php echo $_GET['id'];  ?>&quest=<?php echo ($questionnumber+1);?>">
        <button class="btn btn-primary push-bottom">Next Question <i class="fa fa-plus"></i></button>
    </form>
    
    </div>
    
    <?php 
	
	
	$testid = $_GET['id'];
	
	foreach($mdata as $data){
		
		echo '<ul class="pagination pagination-lg">

        <li><a href="../question/question.php?id='.$testid.'&quest='.($pagenumber-1).'">'.$pagenumber.'</a></li>


    </ul>';
	
	$pagenumber++;
	
	}
	
	?>
    
 <!--Questions to Answer-->




    <?php } ?>
    <!-- Vendor -->
    <script src="/assets/vendor/jquery/jquery.js"></script>
    <script src="/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="/assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="/assets/vendor/magnific-popup/magnific-popup.js"></script>
    <script src="/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
    <script src="/assets/vendor/modernizr/modernizr.js"></script>

    <!-- Specific Page Vendor -->

    <!-- Theme Base, Components and Settings -->
    <script src="/assets/javascripts/theme.js"></script>

    <!-- Theme Initialization Files -->
    <script src="/assets/javascripts/theme.init.js"></script>

</body>
</html>