<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TestDao.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/QuestionDao.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Test.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Question.php";
//Test
    $views = new View();
    $security = new Security();
    $security->sec_session_start();
    $login = $security->login_check();
    $title = "Tests";
    $page_heading = "Tests";
    $keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
    $description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

    if($login['response'] != "error") {
        $security->refreshUser($_SESSION['user_id']);
        include($_SERVER['DOCUMENT_ROOT'].$views->includeHeader($_SESSION['user']->getPermissionName()));

        include($_SERVER['DOCUMENT_ROOT'].$views->includeLeftNav($_SESSION['user']->getPermissionName()));
?>
        <!-- begin: breadcrumbs -->
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Test Dashboard</h2>

                <div class="right-wrapper pull-right">
                    <ol class="breadcrumbs">
                        <li>
                            <a  class="sidebar-right-toggle" href="/portal/">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li><span>Tests</span></li>
                    </ol>

                    <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                </div>
            </header>
            <!-- end: breadcrumbs -->

            <!-- start: page -->
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-primary">


                                <div class = "panel panel-body">

                                <h6>Instructions to Take test</h6>
                                    <header>Take your time and think about your answers carefully!</header>



                                </div>
                                <div class="panel-panel-footer">
                                    <button type="button" class="btn btn-primary">Start Test</button>
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


