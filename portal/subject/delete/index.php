<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Subject.php";

$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$state = $security->userActiveState();
$title = "Subjects";
$page_heading = "Delete Subject";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

if($login['response'] != "error" && $state['response']== 'success') {
    $security->refreshUser($_SESSION['user_id']);

    $acl = $security->accessRights(Array("Administrator"));
    if($acl['response']== 'error'){
        echo $acl['script'];
    }

    if($state['response']== 'warning'){
        echo $state['script'];
    }

    include($_SERVER['DOCUMENT_ROOT'].$views->includeHeader($_SESSION['user']->getPermissionName()));
    include($_SERVER['DOCUMENT_ROOT'].$views->includeLeftNav($_SESSION['user']->getPermissionName()));
    ?>


    <!-- begin: breadcrumbs -->
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>View Subjects</h2>
            <div class="right-wrapper pull-right">
                <ol class="breadcrumbs">
                    <li>
                        <a  class="sidebar-right-toggle" href="/portal/">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li><span>Subjects</span></li>
                    <li><span>Delete</span></li>
                </ol>
                <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>
        <!-- end: breadcrumbs -->
        <!-- start: page -->
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">View Subjects</h2>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-md">
                            <div class="alert alert-success hidden" id="contactSuccess">Success! You will be redirected shortly.</div>
                            <div class="alert alert-danger hidden" id="contactError">Error!</div>
                            <?php
                            $results = Subject::pullSubject(urldecode($_GET["id"]));
                            ?>
                            <h2>You are about to delete <?php echo $results['subject_name']; ?></h2>
                            <p>Please confirm the details below before deleting this subject.</p>
                            <div class="alert alert-warning"><strong>Please note:</strong> This action cannot be undone and all data related to the below subject including tests, lessons and relevant content will be deleted.</div>
                            <p></p>
                            <h3>You are about to delete:</h3>
                            <p><strong>Name</strong>: <?php echo $results['subject_name']; ?></p>
                            <p><strong>Description</strong>: <?php echo $results['subject_description']; ?></p>
                            <p><strong>Grade</strong>: <?php echo $results['subject_grade']; ?></p>
                            <p><strong>Category</strong>: <?php echo $results['subject_category']; ?></p>
                            <form method="POST" id="deleteform" action="/assets/includes/process_subjectdelete.php?id=<?php echo urlencode($_GET["id"]) ?>&token=<?php echo urlencode($_GET["token"]) ?>&subname=<?php echo urlencode($_GET["subname"])?>">
                                <div class="form-group">
                                    <label class="checkbox-inline"><input type="checkbox" value="delete" id="confirm"  name="confirm">I confirm that the above details are correct.</label>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary push-bottom" id="submit">Delete Subject <i class="fa fa-plus"></i></button> <a class="btn btn-primary push-bottom" href="../view/">Cancel <i class="fa fa-close"></i></a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        </div>
    </section>
    <?php
    echo $views->addScript(Array("/assets/vendor/jquery/jquery.js",
        "/assets/vendor/jquery-validation/jquery.validate.min.js",
        "/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js",
        "/assets/vendor/bootstrap/js/bootstrap.js",
        "/assets/vendor/nanoscroller/nanoscroller.js",
        "/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js",
        "/assets/vendor/magnific-popup/magnific-popup.js",
        "/assets/vendor/jquery-placeholder/jquery.placeholder.js",
        "/assets/vendor/modernizr/modernizr.js",
        "/assets/javascripts/theme.js",
        "/assets/javascripts/theme.init.js",
        "/assets/ajax/subjectdelete/form-submit.js",
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
</body>
</html>