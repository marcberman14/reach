<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";


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
            <h2>Subject Management</h2>

            <div class="right-wrapper pull-right">
                <ol class="breadcrumbs">
                    <li>
                        <a class="sidebar-right-toggle" href="/portal/">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li><span>Subject</span></li>
                    <li><span>Create Subject</span></li>
                </ol>

                <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>
        <!-- end: breadcrumbs -->

        <!-- start: page -->

        <div class="box-content">
            <section class="panel">
                <header class="panel-heading">

                    <h2 class="panel-title">Subject Creation Wizard</h2>
                </header>
                <div class="panel-body">
                    <form action="/assets/includes/process_subcreate.php" method="post" name="subcreateform"
                          id="subcreateform">

                        <div class="panel-body">
                            <div class="alert alert-success hidden" id="contactSuccess">Success! A subject has been
                                successfully create and assigned to a tutor.
                            </div>
                            <div class="alert alert-danger hidden" id="contactError">Error!</div>
                            <!-- start: page 1 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Subject Code:</label>

                                <div class="col-sm-9">
                                    <input type="text" value="" class="form-control" name="code" id="code"
                                           placeholder="Enter the name of the subject to create">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="subject_name">Subject Name:</label>

                                <div class="col-sm-9">
                                    <input type="text" value="" class="form-control" name="subject_name"
                                           id="subject_name" placeholder="Enter the name of the subject to create">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="subject_name">Subject Description:</label>

                                <div class="col-sm-9">
                                    <textarea class="form-control" name="subject_description" id="subject_description"
                                              placeholder="Enter the description of the subject here"></textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="subject_name">Subject Category:</label>

                                <div class="col-sm-9">
                                    <input type="text" value="" class="form-control" name="subject_category"
                                           id="subject_category" placeholder="Enter the name of the subject to create">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="subject_name">Subject Grade:</label>

                                <div class="col-sm-9">
                                    <select class=" input-sm" name="grade" id="grade">
                                        <option value="">Select a grade</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                            </div>
                            <!-- end: page 1 -->

                            <!-- start: page 2 -->
                           <div class="form-group">
                                    <label class="col-sm-3 control-label" for="members">Please 'Select' a tutor for your subject:</label>
                                    <table class="table table-bordered table-striped" id="members">
                                        <thead>
                                        <tr>
                                            <th width="10%">User ID</th>
                                            <th width="10%">First Name</th>
                                            <th width="20%">Last Name</th>
                                            <th width="45%">Email</th>
                                            <th width="45%">Select</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                            <div class="row">

                                <div class="form-group">
                                
                                <div class="col-md-12">

                                        <input type="submit" id="submit" name="submit" value="Create Subject"class="btn btn-primary push-bottom">

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
    "/assets/javascripts/theme.js",
    "/assets/javascripts/theme.init.js",
	"/assets/vendor/select2/select2.js",
	"/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js",
    "/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js",
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


<script>
    (function ($) {
        'use strict';
        var datatableInit = function () {
            var $table = $('#members');
            $table.dataTable({
                "language": {
                    "emptyTable": "There are no tutors available to view."
                },
                bProcessing: true,
                sAjaxSource: "/assets/datatables/subjects/tutor.php",
                "aoColumns": [
                    {"mData": "User ID"},
                    {"mData": "First Name"},
                    {"mData": "Last Name"},
                    {"mData": "Email"},
                    {"mData": "Select"}
                ]
            });
        };
        $(function () {
            datatableInit();
        });
    }).apply(this, [jQuery]);
</script>


</body>
</html>
