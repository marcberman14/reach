<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";

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

    $acl = $security->accessRights(Array("Student","Tutor","Teacher","Administrator"));
    if($acl['response']== 'error'){
        echo $acl['script'];
    }

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
                </ol>

                <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>
        <!-- end: breadcrumbs -->

        <!-- start: page -->
        <?php include($_SERVER['DOCUMENT_ROOT'].$views->dashboard($_SESSION['user']->getPermissionName())); ?>

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
    "/assets/vendor/jquery-easypiechart/jquery.easypiechart.js",
    "/assets/javascripts/theme.js",
    "/assets/javascripts/theme.init.js"));
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