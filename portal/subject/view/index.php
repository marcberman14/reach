<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";

$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$state = $security->userActiveState();
$title = "Subjects";
$page_heading = "View Subjects";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

if($login['response'] != "error" && $state['response']== 'success') {

    $acl = $security->accessRights(Array("Tutor","Administrator"));
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
                    <h2>View Subjects</h2>
                    <div class="right-wrapper pull-right">
                        <ol class="breadcrumbs">
                            <li>
                                <a  class="sidebar-right-toggle" href="/portal/">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li><span>Subjects</span></li>
                            <li><span>View</span></li>
                        </ol>
                        <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                    </div>
                </header>
                <!-- end: breadcrumbs -->
                <!-- start: page -->
                
               <!--End: page -->
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
        "/assets/vendor/select2/select2.js",
        "/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js",
        "/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js",
        "/assets/javascripts/theme.js",
        "/assets/javascripts/theme.init.js"));
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
                    "emptyTable": "There are no subjects available to view."
                },
                bProcessing: true,
                sAjaxSource: "/assets/datatables/subjects/subjects.php",
                "aoColumns": [

                    { "mData": "Subject Code" },
                    { "mData": "Subject Name" },
                    { "mData": "Subject Grade" },
                    { "mData": "Subject Description" },
                    { "mData": "Subject Category" },
                    { "mData": "Subject Tutor" },
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