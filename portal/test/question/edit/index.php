<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/SubjectDao.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/QuestionDao.php";

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


$quizid = $_GET['id'];

$array = array("questid"=>$quizid);

$question = new QuestionDao();

$mdata = $question->getQuestion($array);

?>

            <!-- begin: breadcrumbs -->
            <section role="main" class="content-body">
                <header class="page-header">
                    <h2>Question Management</h2>

                    <div class="right-wrapper pull-right">
                        <ol class="breadcrumbs">
                            <li>
                                <a  class="sidebar-right-toggle" href="/portal/">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li><span>Subject</span></li>
                            <li><span>Test</span></li>
                            <li><span>Create Question</span></li>
                        </ol>

                        <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                    </div>
                </header>
                <!-- end: breadcrumbs -->

                <!-- start: page -->

                <div class="box-content">
                    <section class="panel">
                        <header class="panel-heading">

                            <h2 class="panel-title">Question Creation Wizard</h2>
                        </header>
                        <div class="panel-body">
                               <form class = form-horizontal action="/assets/includes/process_questionedit.php?testname=<?php echo urlencode($_GET["testname"]) ?>&id=<?php echo urlencode($_GET["id"]) ?>" method="post" name="test" id="test">

                                <div class="panel-body">
                                    <div class="alert alert-success hidden" id="contactSuccess">Success! A question has been successfully create and assigned to a subject.</div>
                                    <div class="alert alert-danger hidden" id="contactError">Error!</div>
                                <!-- start: page 1 -->
                                
                                <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="w3-question">Question:</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" value="" class="form-control" name="question" id="question" ><?php echo $mdata['question'] ?></textarea>
                                    </div>
                                </div>
                                </div>
                                
                                <br/>
                                
                                <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="answer1">Answer 1:</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $mdata['correctanswer'] ?>" class="form-control" name="answer1" id="answer1" >
                                    </div>
                                </div>
                                </div>
								
                                <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="answer2">Answer 2:</label>
                                    
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $mdata['wronganswer1'] ?>" class="form-control" name="answer2" id="answer2">
                                    </div>
                                </div>
                                </div>
                                
                                
                                <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="answer3">Answer 3:</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="answer3" id="answer3" value="<?php echo $mdata['wronganswer2'] ?>">
                                    </div>
                                </div>
                                </div>

								
                                <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="answer4">Answer 4:</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?php echo $mdata['wronganswer3'] ?>" class="form-control" name="answer4" id="answer4" >
                                    </div>
                                </div>
                                </div>
                                
                                 <div class="row">
                                <br/>
                                </div>
                                
                                
                                 <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="canswer">Please choose the correct answer:</label>
                                    <div class="col-md-8">
                                        <select name="canswer" id="canswer">
                                                      <option value="1">Answer 1</option>
                                                      <option value="2">Answer 2</option>
                                                      <option value="3">Answer 3</option>
                                                      <option value="4">Answer 4</option>
                                                  </select>
                                    </div>
                                </div>
                                </div>
                                
                                
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="submit" id="submit" name="submit" value="Edit Question" class="btn btn-primary push-bottom">
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
            "assets/vendor/jquery-datatables/media/js/jquery.dataTables.js",
            "/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"));
        echo $views->addStyle(Array("/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css",
            "/assets/vendor/select2/select2.css"));
     }else {
        ?>
        <script>
            window.location.href = "/user/login/";
        </script>
    <?php
    }
?>

</body>
</html>


