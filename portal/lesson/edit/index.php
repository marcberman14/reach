<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/SubjectDao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/LessonDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Lesson.php";

$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$state = $security->userActiveState();
$title = "Edit Lesson";
$page_heading = "Edit Lesson";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

if($login['response'] != "error" && $state['response']== 'success') {
$security->refreshUser($_SESSION['user_id']);

if($state['response']== 'warning'){
    echo $state['script'];
}

include($_SERVER['DOCUMENT_ROOT'].$views->includeHeader($_SESSION['user']->getPermissionName()));
include($_SERVER['DOCUMENT_ROOT'].$views->includeLeftNav($_SESSION['user']->getPermissionName()));

$data = array();
$lesson = new LessonDao();
$lessonDetails = $lesson->getLesson(Array('lessonid'=>$_GET['id']));

$lesson = new Lesson($lessonDetails['lesson_title'], $lessonDetails['lesson_name'], $lessonDetails['lesson_description'], $lessonDetails['lesson_concpet'], $lessonDetails['lesson_material'],$lessonDetails['lesson_content'], $lessonDetails['lesson_video']);
?>


            <!-- begin: breadcrumbs -->
            <section role="main" class="content-body">
                <header class="page-header">
                    <h2>Lesson Management</h2>

                    <div class="right-wrapper pull-right">
                        <ol class="breadcrumbs">
                            <li>
                                <a  class="sidebar-right-toggle" href="/portal/">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li><span>Lesson</span></li>
                            <li><span>Edit Lesson</span></li>
                        </ol>

                        <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                    </div>
                </header>
                <!-- end: breadcrumbs -->

                <!-- start: page -->

                <div class="box-content">
                    <section class="panel">
                        <header class="panel-heading">

                            <h2 class="panel-title">Lesson Modification Wizard</h2>
                        </header>
                        <div class="panel-body">
                                <form action="/assets/includes/process_lessonedit.php" method="post" name="lessoneditform" id="lessoneditform">
                                
                                <input type="hidden" name="id" id="id" value="<?php echo $_REQUEST['id'];?>">

                                <div class="panel-body">
                                    <div class="alert alert-success hidden" id="contactSuccess">Success! A lesson has been successfully edited.</div>
                                    <div class="alert alert-danger hidden" id="contactError">Error!</div>
                                <!-- start: page 1 -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-lesson_title">Lesson Title:</label>
                                    <div class="col-sm-9">
                                        <input type="text"class="form-control" name="lesson_title" id="lesson_title" value="<?php echo $lesson->getLesson_title(); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-lesson_name">Lesson Name:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="lesson_name" id="lesson_name" value="<?php echo $lesson->getLesson_name();?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-lesson_description">Lesson Description:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="lesson_description" id="lesson_description"><?php echo $lesson->getLesson_description(); ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-lesson_material">Lesson Material:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="lesson_material" id="lesson_material"><?php echo $lesson->getLesson_material(); ?></textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-lesson_concept">Lesson Concept:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="lesson_concept" id="lesson_concept" value="<?php echo $lesson->getLesson_concept(); ?>">
                                    </div>
                                </div>
                                
                                <!-- end: page 1 -->

                                <!-- start: page 2 -->
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="selectsub">Please 'Select' a subject for your lesson:</label>
                                    <table class="table table-bordered table-striped" id="selectsub" name="selectsub">
                                        <thead>
                                        <tr>
                                            <th width="10%">Subject ID</th>
                                            <th width="10%">Subject Code</th>
                                            <th width="20%">Subject Name</th>
                                            <th width="10%">Subject Grade</th>
                                            <th width="25%">Subject Description</th>
                                            <th width="20%">Subject Category</th>
                                            <th width="20%">Subject Tutor</th>
                                            <th width="10%">Select Subject</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="submit" id="submit" name="submit" value="Edit Lesson" class="btn btn-primary push-bottom">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                    <!-- end: page -->
            </section>
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
    (function ($) {
        'use strict';
        var datatableInit = function () {
            var $table = $('#selectsub');
            $table.dataTable({
                "language": {
                    "emptyTable": "There are no Lessons available to view."
                },
                bProcessing: true,
                sAjaxSource: "/assets/datatables/lesson/subject.php",
                "aoColumns": [
					{"mData": "Subject ID"},
                    {"mData": "Subject Code"},
                    {"mData": "Subject Name"},
                    {"mData": "Subject Grade"},
                    {"mData": "Subject Description"},
                    {"mData": "Subject Category"},
					{"mData": "Subject Tutor"},
					{"mData": "Select Subject"}				 
					
                ]
            });
        };
        $(function () {
            datatableInit();
        });
    }).apply(this, [jQuery]);
</script>



</body>
</html>


