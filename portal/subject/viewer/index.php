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
$state = $security->userActiveState();
$title = "Subject Viewer";
$page_heading = "Subject Viewer";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

if($login['response'] != "error" && $state['response']== 'success') {
$security->refreshUser($_SESSION['user_id']);

if($state['response']== 'warning'){
    echo $state['script'];
}

include($_SERVER['DOCUMENT_ROOT'].$views->includeHeader($_SESSION['user']->getPermissionName()));
include($_SERVER['DOCUMENT_ROOT'].$views->includeLeftNav($_SESSION['user']->getPermissionName()));
?>

        <!-- begin: breadcrumbs -->
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Admin Dashboard</h2>

                <div class="right-wrapper pull-right">
                    <ol class="breadcrumbs">
                        <li>
                            <a  class="sidebar-right-toggle" href="/portal/">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <!--<li><span>Layouts</span></li>
                        <li><span>Default</span></li>-->
                    </ol>

                    <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                </div>
            </header>
            <!-- end: breadcrumbs -->

            <!-- start: page -->
            <div class="row">
                <div class="col-md-6">
                    <header>
                        <h1>
                            <?php echo urldecode($_GET['name']);?> Content
                        </h1>

                    </header>
                    <div class="container">
                        <h3></h3>
                        <ul class="nav nav-pills nav-stacked">

                            <li><a href="../../lesson/view/index.php?id=<?php echo urlencode($_GET['id']); ?>&name=<?php echo urlencode($_GET['name']); ?>">LESSONS</a></li>

                            <li><a href="/portal/test/view-tests/index.php?subjectid=<?php echo urlencode($_GET['id']); ?>">TEST</a></li>
                        </ul>
                    </div>
                    
                    <section role="main" class="content-body">
                <header class="page-header">
                    <h2>View Lessons</h2>

                    <div class="right-wrapper pull-right">
                        <ol class="breadcrumbs">
                            <li>
                                <a  class="sidebar-right-toggle" href="/portal/">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li><span>Subject</span></li>
                            <li><span>Contents</span></li>
                            <li><span>View</span></li>
                        </ol>

                        <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                    </div>
                </header>
                <!-- end: breadcrumbs -->

                <!-- start: page -->
                
        </div>
        
    </section>

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
                    "emptyTable": "There are no subjects available to view."
                },
                bProcessing: true,
                sAjaxSource: "/assets/datatables/lesson/lesson.php",
                "aoColumns": [
                    { "mData": "Lesson ID" },
                    { "mData": "Lesson Title" },
                    { "mData": "Lesson Name" },
                    { "mData": "Lesson Description" },
                    { "mData": "Lesson Concept" },
                    { "mData": "Lesson Material" },
                    { "mData": "Lesson Subject" },
                    { "mData": "Functions" }
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

