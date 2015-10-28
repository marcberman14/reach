<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";

$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$state = $security->userActiveState();
$title = "Approve Users";
$page_heading = "Approve users";
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
                        <li><span>User</span></li>
                        <li><span>User Approval</span></li>
                    </ol>

                    <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                </div>
            </header>
            <!-- end: breadcrumbs -->

            <!-- start: page -->

            <div class="box-content">
                <section class="panel">
                    <header class="panel-heading">

                        <h2 class="panel-title">User Approval</h2>
                    </header>
                    <div class="panel-body">
                        <div class="alert alert-success hidden" id="contactSuccess">Your request has been successfully processed.
                        </div>
                        <div class="alert alert-warning hidden" id="contactLoading">Please wait while your request is being processed.
                        </div>
                        <div class="alert alert-danger hidden" id="contactError">Error!</div>


                        <table class="table table-no-more table-bordered table-striped mb-none" id="members">
                            <thead>
                            <tr>
                                <th width="5%">User ID</th>
                                <th width="20%">First Name</th>
                                <th width="20%">Last Name</th>
                                <th width="20%">Email</th>
                                <th width="10%">User Type</th>
                                <th width="25%">Approve</th>
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
                sAjaxSource: "/assets/datatables/users/approve.php",
                "aoColumns": [
                    { "mData": "User ID" },
                    { "mData": "First Name" },
                    { "mData": "Last Name" },
                    { "mData": "Email" },
                    { "mData": "User Type" },
                    { "mData": "Approve" }
                ]
            });
        };

        $(function() {
            datatableInit();
        });

    }).apply( this, [ jQuery ]);
</script>

<script>
    function autosave(inputid,values) {
        var userdetails = {userid : inputid, active : values};

        $.ajax({
            url: '/assets/includes/user_activation.php',
            type: "POST",
            data: userdetails,

            beforeSend: function() {
                $('#contactLoading').removeClass('hidden');
                $('#contactSuccess').addClass('hidden');
                $('#contactError').addClass('hidden');

                if (($('#contactLoading').offset().top - 200) < $(window).scrollTop()) {
                    $('html, body').animate({
                        scrollTop: $('#contactLoading').offset().top - 200
                    }, 300);
                }
            },
            success: function(data) {
                if (data.response == 'success') {
                    $('#contactSuccess').html('<strong>Success!</strong> ' + data.reason);
                    $('#contactSuccess').removeClass('hidden');
                    $('#contactError').addClass('hidden');
                    $('#contactLoading').addClass('hidden');

                    $("#submit").prop('disabled', false); // disable button

                    if (($('#contactSuccess').offset().top - 200) < $(window).scrollTop()) {
                        $('html, body').animate({
                            scrollTop: $('#contactSuccess').offset().top - 200
                        }, 300);
                    }
                } else if (data.response == 'error') {
                    $('#contactError').html('<strong>Error!</strong> ' + data.reason);
                    $('#contactSuccess').addClass('hidden');
                    $('#contactError').removeClass('hidden');
                    $('#contactLoading').addClass('hidden');

                    if (($('#contactError').offset().top - 200) < $(window).scrollTop()) {
                        $('html, body').animate({
                            scrollTop: $('#contactError').offset().top - 200
                        }, 300);
                    }
                }
            }
        });
    }
</script>



</body>
</html>


