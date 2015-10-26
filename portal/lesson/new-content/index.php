<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/SubjectDao.php";

$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$state = $security->userActiveState();
$title = "New Lesson";
$page_heading = "New Lesson";
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

<?php if(!isset($_GET['id'])){ echo "<script> window.location.href = \"/portal/subject/view/\";</script>"; } ?>
            <!-- begin: breadcrumbs -->
            <section role="main" class="content-body">
                <header class="page-header">
                    <h2>Lesson Management</h2>

                    <div class="right-wrapper pull-right">
                        <ol class="breadcrumbs">
                            <li>
                                <a  class="sidebar-right-toggle" href="/portal/">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li><span>Lesson</span></li>
                            <li><span>Create Lesson</span></li>
                        </ol>

                        <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                    </div>
                </header>
                <!-- end: breadcrumbs -->

                <!-- start: page -->

                <div class="box-content">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">Lesson Asset Creation Wizard</h2>
                        </header>
                        <div class="panel-body">
                            <h2>Lesson content</h2>
                            <p>Please upload the lesson content below. The content should be uploaded in a single pdf document that is no larger than 40MB.</p>
                            <hr style="margin-top: 20px;">
                            <form class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="sr-only" for="documentupload">Select document to upload:</label>
                                    <div class="col-sm-12">
                                        <input id="documentupload" name="documentupload[]" type="file" class="file-loading">
                                    </div>
                                </div>
                            </form>

                            <form action="/assets/includes/process_assetcreate.php?id=<?php echo $_GET['id']; ?>" method="post" name="lessoncontent" id="lessoncontent">
                                <!-- start: page 1 -->
                            <div class="alert alert-success hidden" id="contactSuccess">Success!</div>
                            <div class="alert alert-warning hidden" id="contactWarning"><strong>Error!</strong></div>
                            <div class="alert alert-danger hidden" id="contactError"><strong>Error!</strong></div>
                                <h2>Live Tutoring Session Link</h2>
                                <p>Please enter a link below to the video that is being hosted on Youtube. Below the a preview of the video you have entered will be generated. Please ensure you verify the link is correct before submitting the lesson content.</p>
                                <hr style="margin-top: 20px;">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="lesson_video_link">YouTube Link:</label>
                                    <div class="col-sm-7">
                                        <input type="text" value="" class="form-control" name="lesson_video_link" id="lesson_video_link" placeholder="Enter the video link of the lesson to create">
                                    </div>
                                    <div class="col-sm-2">
                                        <a onclick="loadIframe('ytpreview', $('#lesson_video_link').val())" class="btn btn-primary push-bottom">Preview Video</a>
                                    </div>
                                </div>

                                <div class="form-group" >
                                    <label class="col-sm-3 control-label">Video Preview:<p>Please ensure the video link is correct before submitting the video </p></label>

                                    <div class="col-md-9">
                                        <div id="vidpreview" class="embed-responsive embed-responsive-16by9" style="display: none;">
                                           <iframe id="ytpreview" id="ytpreview" class="embed-responsive-item" src="" frameborder="0" allowfullscreen>Loading...</iframe>
                                        </div>
                                        <div class="alert alert-danger" id="errorvideo" ><strong>Error!</strong> No video to preview, please enter a valid YouTube link to the space above.</div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Video Name:
                                    <p>Please enter a name for the video. This is the name that will be displayed to the students.</p></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" class="form-control" name="lesson_video_name" id="lesson_video_name" placeholder="Enter the name of the video">
                                    </div>
                                </div>
                                <!-- end: page 1 -->

                                <!-- start: page 2 -->
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="submit" id="submit" name="submit" value="Add Lesson Content" class="btn btn-primary push-bottom">
                                        </div>
                                    </div>
                                </div>
                            </form>
                       </div>
                    </section>
                </div>
                    <!-- end: page -->
            </section>
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
        "/assets/javascripts/theme.init.js",
        "/assets/ajax/lessonassets/form-submit.js"));
        ?>
         <script>
         $.urlParam = function(name){
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            return results[1] || 0;
        }

        $("#documentupload").fileinput({
            uploadUrl: "/assets/includes/uploadpdf.php?id=<?php echo urldecode($_REQUEST['id'])?>", // server upload action
            uploadAsync: true,
            maxFileCount: 1,
            maxFileSize: 500000,
            allowedFileExtensions: ['pdf'],
            dropZoneTitle : "Drag and Drop",
            indicatorSuccessTitle: "Successfully uploaded!",
            fileActionSettings: {
                removeIcon: '<i class="glyphicon glyphicon-trash text-danger"></i>',
                removeClass: 'btn btn-xs btn-default',
                removeTitle: 'Remove file',
                uploadIcon: '<i class="glyphicon glyphicon-upload text-info"></i>',
                uploadClass: 'btn btn-xs btn-default',
                uploadTitle: 'Upload file',
                indicatorNew: '<i class="glyphicon glyphicon-hand-down text-warning"></i> Not uploaded yet',
                indicatorSuccess: '<i class="glyphicon glyphicon-ok-sign file-icon-large text-success"></i> Your file has been uploaded.',
                indicatorError: '<i class="glyphicon glyphicon-exclamation-sign text-danger"></i>',
                indicatorLoading: '<i class="glyphicon glyphicon-hand-up text-muted"></i>',
                indicatorNewTitle: 'Not uploaded yet',
                indicatorSuccessTitle: 'Uploaded',
                indicatorErrorTitle: 'Upload Error',
                indicatorLoadingTitle: 'Uploading ...'
            }
        });

        function loadIframe(iframeName, url) {
            var $iframe = $('#' + iframeName);
            if ( $iframe.length ) {
                $iframe.attr('src',$.YouTubeUrlNormalize(url));
                try{
                    if($('iframe').attr('src').length){
                        if($iframe.contents().find("body").length == 0) {
                            $('#vidpreview').hide();
                            $('#errorvideo').show();
                        } else if ($iframe.contents().find("body").length == 1) {
                            $('#vidpreview').show();
                            $('#errorvideo').hide();
                            $('#lesson_video_link').val($('iframe').attr('src'));
                        }
                    }
                } catch (e){
                   $('#vidpreview').hide();
                   $('#errorvideo').show();
                }
                return false;
            }
            return true;
        }

        $.YouTubeUrlNormalize = function(url)
        {
            var rtn = url;
            if(url)
            {
                var vidId;
                if(url.indexOf("youtube.com/watch?v=") !== -1)
                {
                    vidId = url.substr(url.indexOf("youtube.com/watch?v=") + 20);
                    rtn = "https://www.youtube.com/embed/"+vidId;
                }
                else if(url.indexOf("youtube.com/watch/?v=") !== -1)
                {
                    vidId = url.substr(url.indexOf("youtube.com/watch/?v=") + 21);
                    rtn = "https://www.youtube.com/embed/"+vidId;
                }
                else if(url.indexOf("youtu.be") !== -1)
                {
                    vidId = url.substr(url.indexOf("youtu.be") + 9);
                    rtn = "https://www.youtube.com/embed/"+vidId;
                }
                else if(url.indexOf("www.youtube.com/embed/") !== -1)
                {
                    rtn = url;
                }
                else
                {
                    rtn = null;
                }
            }
            return rtn;
        };

    </script>

    <style>
        body .btn {
            white-space: nowrap;
        }

        @media only screen and (max-width: 767px) {
            .file-object {
            width: auto;
            height: 300px;
        }
        }

        @media only screen and (min-width: 768px) {
            .file-object {
            width: auto;
            height: 400px;
        }
        }

        @media only screen and (min-width: 992px) {
            .file-object {
            width:600px;
            height: 600px;
        }
        }

        @media only screen and (min-width: 1200px) {
            .file-object {
            width: 800px;
            height: 600px;
        }
        }
    </style>
         <?php
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


