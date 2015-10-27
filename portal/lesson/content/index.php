<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/LessonAssetDao.php";

$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$state = $security->userActiveState();
$title = "Dashboard";
$page_heading = "Dashboard";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

$asset = new LessonAssetDao();
$videoUrlArray = $asset->getAssetUrl(array("fileid"=>20));
$videoUrl = $videoUrlArray['url'];
urldecode($videoUrl);

$asset = new LessonAssetDao();
$pdfUrlArray = $asset->getAssetUrl(array("fileid"=>19));
$pdfUrl = $pdfUrlArray['url'];
urldecode($pdfUrl);

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
        
                <div class = "col-md-12">
	                <div class="embed-responsive embed-responsive-16by9">        
							<iframe title="YouTube video player" class="embed-responsive-item" type="text/html" src=" <?php echo $videoUrl ?>" allowFullScreen></iframe>
	            </div>
        		</div>
       

        <div class = "col-md-12">
	        	                <div class="embed-responsive embed-responsive-4by3">
        <iframe class="embed-responsive-item" src="/bin/lesson-content/<?php echo $pdfUrl; ?> " type="application/pdf">
  <p>Alternative text - include a link <a href="<?php echo $_SERVER['DOCUMENT_ROOT']."/bin/lesson-content/".$pdfUrl; ?>">to the PDF!</a></p>
</iframe>
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