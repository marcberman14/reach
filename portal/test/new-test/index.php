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
    $title = "Test";
    $page_heading = "New Test";
    $keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
    $description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

    if($login['response'] != "error") {
        include($_SERVER['DOCUMENT_ROOT'].$views->includeHeader($_SESSION['user']->getPermissionName()));

        include($_SERVER['DOCUMENT_ROOT'].$views->includeLeftNav($_SESSION['user']->getPermissionName()));
?>

        <!-- begin: breadcrumbs -->
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Test Management</h2>

                <div class="right-wrapper pull-right">
                    <ol class="breadcrumbs">
                        <li>
                            <a class="sidebar-right-toggle" href="/portal/">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li><span>Test</span></li>
                        <li><span>Create Test</span></li>
                    </ol>

                    <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                </div>
            </header>
            <!-- end: breadcrumbs -->
                <!--Start Page 1-->
            <div class="box-content">
                <section class="panel">
                    <header class="panel-heading">

                        <h2 class="panel-title">Test Creation Wizard</h2>
                    </header>
                    <div class="panel-body">
                    
                    <form class = form-horizontal action="/assets/includes/process_test.php" method="post" name="test" id="testcreateform">   
                    
                                <div class="panel-body">
                                <div class="alert alert-success hidden" id="contactSuccess">Success! A Test has been
                                    successfully created and assigned to a subject.
                                </div>
                                <div class="alert alert-danger hidden" id="contactError">Error!</div>
                 <!--End Start Page 1-->
                <!-- start: page -->
                <div class="row">
                    <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-primary">

                                
                                    <div class = "panel panel-body">
                                        
                                        <fieldset>
                                        <div class="col-md-12 col-md-offset-0.5">                                            
                                            <div class="form-group">
                                            <input type="hidden" value="<?php echo $_REQUEST['id'] ?>"  name="subid" id="subid">
                                            
                                                <label class="col-md-3 control-label" for="profileLastName">Enter Test Name</label>
                                                    <div class="col-md-8">
                                                        <input type="text" value="" placeholder="Enter test name" class="form-control" name="test_name" id="test_name">
                                                    </div>              
                                            </div>
                                            <div class="form-group">
                                            <input type="hidden" value="<?php echo $_REQUEST['id'] ?>"  name="subid" id="subid">
                                            
                                                <label class="col-md-3 control-label" for="test_description">Enter Test Description</label>
                                                    <div class="col-md-8">
                                                        <input type="text" value="" placeholder="Enter description"class="form-control" name="test_description" id="test_description">
                                                    </div>              
                                            </div>
                                            <div class="form-group">
                                            <input type="hidden" value="<?php echo $_REQUEST['id'] ?>"  name="subid" id="subid">
                                            
                                                <label class="col-md-3 control-label" for="test_marks">Enter Test Marks</label>
                                                    <div class="col-md-8">
                                                        <input type="text" value="" placeholder="Enter marks" class="form-control" name="test_marks" id="test_marks">
                                                    </div>              
                                            </div>
                                        </div>
                                        </fieldset>                                            

        
                                    </div>
                                    <div class="panel-panel-footer">
                                                <button type="submit" class="btn btn-primary">Create Test</button>
                                    </div>
    
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- end: page -->
            </section>
        </div>
    </section>
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


