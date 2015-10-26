<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/LessonDao.php";
$lesson = new LessonDao();

$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$state = $security->userActiveState();
$title = "Dashboard";
$page_heading = "Dashboard";
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
                    <h2>View Lessons</h2>
                    <div class="right-wrapper pull-right">
                        <ol class="breadcrumbs">
                            <li>
                                <a  class="sidebar-right-toggle" href="/portal/">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li><span>Subject</span></li>
                            <li><span>Lessons</span></li>
                            <li><span>View</span></li>
                        </ol>
                        <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                    </div>
                </header>
                <!-- end: breadcrumbs -->
                <!-- start: page -->
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">View Lessons</h2>
                    </header>
                    <div class="panel-body">
                    <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-md">
                    <form method="POST" action="../new/?id=<?php echo urlencode($_GET['id']); ?>&name=<?php urlencode($_GET['name']); ?>">
                    <button class="btn btn-primary push-bottom">Add a Lesson</button>
                </form>
                 </div>
                                </div>
                            </div>
                        <table class="table table-bordered table-striped" id="members">
                            <thead>
                            <tr>
                                <th width="10%">Lesson Id</th>
                                <th width="10%">Lesson Title</th>
                                <th width="20%">Lesson Name</th>
                                <th width="10%">Lesson Description</th>
                                <th width="20%">Lesson Concept</th>
                                <th width="20%">Lesson Material</th>
				<th width="20%">Lesson Subject</th>
                <th width="20%">Functions</th>
                
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </section>
                
        </div>
        
    </section>
<!-- Vendor -->
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
        $link = "\"/assets/datatables/lesson/lesson.php?identity=\"". $_GET['identity'] ."\"&name=\"".$_GET['name']."\"";
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
                    "emptyTable": "There are no Lessons available to view."
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