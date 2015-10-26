<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";

    $views = new View();
    $security = new Security();
    $security->sec_session_start();
    $login = $security->login_check();
    $security->refreshUser($_SESSION['user_id']);
    $title = "Users";
    $page_heading = "View Users";
    $keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
    $description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

    if($login['response'] != "error") {
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
                                <a  class="sidebar-right-toggle" href="/portal">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li><span>Users</span></li>
                            <li><span>View Users</span></li>
                        </ol>

                        <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                    </div>
                </header>
                <!-- end: breadcrumbs -->

                <!-- start: page -->
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">Users Summary</h2>
                    </header>
                    <div class="panel-body">
                    <table class="table table-bordered table-striped" id="members">
                        <thead>
                        <tr>
                            <th>User ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Active</th>
                            <th>Functions</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    </div>
                </section>

                <!-- end: page -->
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
	"/assets/vendor/select2/select2.js",
 	"/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js",
	"/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js",
    "/assets/javascripts/theme.js",
    "/assets/javascripts/theme.init.js"));
    echo $views->addStyle(Array("/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css",
    "/assets/vendor/select2/select2.css"));
    }  else {
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
                bProcessing: true,
                sAjaxSource: "/assets/datatables/users/users.php",
                "aoColumns": [
                    { "mData": "User ID" },
                    { "mData": "First Name" },
                    { "mData": "Last Name" },
                    { "mData": "Email" },
                    { "mData": "User Type" },
                    { "mData": "Active" },
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


