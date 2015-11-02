<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Subject.php";


$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$state = $security->userActiveState();
$title = "Enrol";
$page_heading = "Enrol in Subject";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

if($login['response'] != "error" && $state['response']== 'success') {
$acl = $security->accessRights(Array("Student","Tutor","Administrator"));
if($acl['response']== 'error') {
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
        <h2>Enrolment Dashboard</h2>

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
    </section>
    <!-- end: breadcrumbs -->
    <!-- Start- page -->
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">View Subjects</h2>
        </header>
        <div class="panel-body">

            <div class="alert alert-success hidden" id="contactSuccess">Success!</div>
            <div class="alert alert-danger hidden" id="contactError">Error!</div>

            <table class="table table-bordered table-striped mb-none" id="members">
                <thead>
                <tr>

                    <th width="1%">Subject Code</th>
                    <th width="2%">Subject Name</th>
                    <th width="1%">Subject Grade</th>
                    <th width="2%">Subject Description</th>
                    <th width="2%">Subject Category</th>


                </tr>
                </thead>

            </table>
        </div>
    </section>

    <!-- End-Page -->

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

