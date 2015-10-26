//Edit Question
<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Test.php";

$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$state = $security->userActiveState();
$title = "Edit Question";
$page_heading = "Edit Question";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

if($login['response'] != "error" && $state['response']== 'success') {
    $security->refreshUser($_SESSION['user_id']);

    if($state['response']== 'warning'){
        echo $state['script'];
    }

    include($_SERVER['DOCUMENT_ROOT'].$views->includeHeader($_SESSION['user']->getPermissionName()));
    include($_SERVER['DOCUMENT_ROOT'].$views->includeLeftNav($_SESSION['user']->getPermissionName()));

    $questiondao = new QuestionDao();
    if (isset($_GET['id']) && isset($_GET['code'])) {
        $data = $questiondao->getQuestion($_GET['id']);
        $question = new Question($data['question'], $data['wanswer'], $data['wanswer1'], $data['wanswer2'], $data['wanswer3'], $data['cnaswer']);
    }else{
        ?>
        <script>
            window.location.href = "/portal/test/question/";
        </script>
    <?php
    }
    ?>
    <!-- begin: breadcrumbs -->
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Subject Management</h2>

            <div class="right-wrapper pull-right">
                <ol class="breadcrumbs">
                    <li>
                        <a  class="sidebar-right-toggle" href="/portal/">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li><span>Test</span></li>
                    <li><span></span></li>
                </ol>

                <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>
        <!-- end: breadcrumbs -->

        <!-- start: page -->

        <div class="box-content">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Test Creation Wizard</h2>
                </header>
                <div class="panel-body">
                    <form action="/assets/includes/process_questionedit.php" method="post" name="questioneditform" id="questioneditform">
                        <div class="alert alert-success hidden" id="contactSuccess">Success! A Question has been successfully create and assigned to a test.</div>
                        <div class="alert alert-danger hidden" id="contactError">Error!</div>
                        <!-- start: page 1 -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="question">Question:</label>
                            <div class="col-sm-9">
                                <input type="text"  class="form-control" name="question" id="question" value="<?php echo $question->getQuestion_question(); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="wanswer">Option A: </label>
                            <div class="col-sm-9">
                                <input type="text"  class="form-control" name="wanswer" id="wanswer" value="<?php echo $question->getQuestion_wanswer(); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="wanswer1">Option B</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="wanswer1" id="wanswer1" ><?php echo $question->getSubject_wanswer1(); ?> </textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="wanswer2">Option C:</label>
                            <div class="col-sm-9">
                                <input type="text"  class="form-control" name="wanswer2" id="wanswer2" value="<?php echo $question->getSubject_wanswer2(); ?>">
                            </div>


                            <div class="col-sm-9">
                                <input type="hidden"   name="question_id" id="question_id" value="<?php echo $_REQUEST['id']; ?>">
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="wanswer3">Subject Category:</label>
                            <div class="col-sm-9">
                                <input type="text"  class="form-control" name="wanswer3" id="wanswer3" value="<?php echo $question->getSubject_wanswer3(); ?>">
                            </div>


                            <div class="col-sm-9">
                                <input type="hidden"   name="question_id" id="question_id" value="<?php echo $_REQUEST['id']; ?>">
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="canswer">Correct Answer:</label>
                            <div class="col-sm-9">
                                <select class=" input-sm" name="canswer" id="canswer" >
                                    <option value="<?php echo $question->getSubject_canswer(); ?>">Correct Answer <?php echo $subject->getSubject_canswer(); ?></option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>
                        </div>
                        <!-- end: page 1 -->


                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="submit" id="submit" name="submit" value="Edit Question" class="btn btn-primary push-bottom">
                                </div>
                            </div>
                        </div>
                </div>
                </form>
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
    (function( $ ) {
        'use strict';
        var datatableInit = function() {
            var $table = $('#members');
            $table.dataTable({
                "language": {
                    "emptyTable": "There are no Questions available to view."
                },
                bProcessing: true,
                sAjaxSource:  "/assets/datatables/tests/questions.php?testid=<?php echo $_GET['testid'] ?>",
                "aoColumns": [
                    { "mData": "Question"},
                    { "mData": "Option A: "},
                    { "mData": "Option B:"},
                    { "mData": "Option C:"},
                    { "mData": "Option D:"},
                    { "mData": "Option D:"},
                    { "mData": "Right Answer:"}

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



