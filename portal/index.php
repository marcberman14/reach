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
    include($_SERVER['DOCUMENT_ROOT'].$views->dashboard($_SESSION['user']->getPermissionName()));
?>
    </div>
    </section>


<?php
echo $views->addStyle(Array("/assets/vendor/bootstrap-fileinput-master/css/fileinput.css"));

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
        "/assets/vendor/bootstrap-fileinput-master/js/fileinput.min.js",
        "/assets/ajax/shared/sha512.js",
        "/assets/javascripts/theme.init.js"));


    } else {
        ?>
        <script>
            window.location.href = "/user/login/";
        </script>
    <?php
    }
?>
<script>
    $("#profileupload").fileinput({
        uploadUrl: "/assets/includes/upload.php", // server upload action
        uploadAsync: true,
        maxFileCount: 1,
        maxFileSize: 500000,
        allowedFileTypes: ['image'],
        allowedFileExtensions: ['jpg', 'gif', 'png', 'jpeg'],
        dropZoneTitle : "Drag and Drop",
        indicatorSuccessTitle: "Successfully uploaded!",
        dropZoneEnabled : false,
        fileActionSettings: {
            removeIcon: '<i class="glyphicon glyphicon-trash text-danger"></i>',
            removeClass: 'btn btn-xs btn-default',
            removeTitle: 'Remove file',
            uploadIcon: '<i class="glyphicon glyphicon-upload text-info"></i>',
            uploadClass: 'btn btn-xs btn-default',
            uploadTitle: 'Upload file',
            indicatorNew: '<i class="glyphicon glyphicon-hand-down text-warning"></i>',
            indicatorSuccess: '<i class="glyphicon glyphicon-ok-sign file-icon-large text-success"></i> Your profile picture has been changed.',
            indicatorError: '<i class="glyphicon glyphicon-exclamation-sign text-danger"></i>',
            indicatorLoading: '<i class="glyphicon glyphicon-hand-up text-muted"></i>',
            indicatorNewTitle: 'Not uploaded yet',
            indicatorSuccessTitle: 'Uploaded',
            indicatorErrorTitle: 'Upload Error',
            indicatorLoadingTitle: 'Uploading ...'
        }
    });

</script>

<style>
    body .btn {
        white-space: nowrap;
    }

</style>

</body>
</html>