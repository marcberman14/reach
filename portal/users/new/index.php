<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";

$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$state = $security->userActiveState();
$title = "User Management";
$page_heading = "New User";
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
                <h2>User Management</h2>
                <div class="right-wrapper pull-right">
                    <ol class="breadcrumbs">
                        <li>
                            <a  class="sidebar-right-toggle" href="/portal/">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li><span>Users</span></li>
                        <li><span>New Users</span></li>
                    </ol>
                    <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                </div>
            </header>
            <!-- end: breadcrumbs -->
            <!-- start: page -->
            <div class="alert alert-danger hidden" id="contactError">Error!</div>
                <header class="panel-heading">
                    <h2 class="panel-title">New Users</h2>
                </header>
                <div class="panel-body">
                    <div class="alert alert-success hidden" id="contactSuccess">Success! </div>
                    <div class="alert alert-danger hidden" id="contactError">Error!</div>
                    <form action="/assets/includes/process_newuser.php" method="post" name="newuserform" id="newuserform">

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="w3-email">First Name:</label>
                        <div class="col-sm-9">
                            <input type="text" value="" class="form-control" name="firstname" id="firstname" placeholder="Please enter First Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="w3-email">Surname/Family Name:</label>
                        <div class="col-sm-9">
                            <input type="text" value="" class="form-control" name="surname" id="surname" placeholder="Please enter First Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="w3-email">Email Address:</label>
                        <div class="col-sm-9">
                            <input type="text" value="" class="form-control" name="email" id="email" placeholder="Please enter email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="w3-email">Gender:</label>
                        <div class="col-sm-9">
                            <select class="form-control input" name="gender" id="gender">
                                <option value="">Your gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="w3-email">User Group:</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="usertype" id="usertype">
                                <option value="">Select one</option>
                                <option value="1">Student</option>
                                <option value="2">Tutor</option>
                                <option value="3">Teacher</option>
                                <option value="4">Administrator</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-sm-9">
                            <input type="submit" id="submit" name="submit" value="Register" class="btn btn-primary">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- end: page -->
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
    "/assets/ajax/newuser/form-submit.js"));
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