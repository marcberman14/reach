<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";

    include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
    $views = new View();
    $security = new Security();
    $security->sec_session_start();
    $login = $security->login_check();

    if($login['response'] != "error") {
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
                <p>This is column 1. More can be added. adjust the values above. Remember they must all equal 12 in the end.</p>
            </div>

            <div class="col-md-6">
                <p>This is column 2. More can be added. adjust the values above. Remember they must all equal 12 in the end.</p>
            </div>


            <div class="col-md-4">
                <p>This is column 1. More can be added. adjust the values above. Remember they must all equal 12 in the end.</p>
            </div>

            <div class="col-md-4">
                <p>This is column 2. More can be added. adjust the values above. Remember they must all equal 12 in the end.</p>
            </div>
            <div class="col-md-4">
                <p>This is column 3. More can be added. adjust the values above. Remember they must all equal 12 in the end.</p>
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