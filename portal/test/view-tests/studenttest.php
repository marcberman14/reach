<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TestDao.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/QuestionDao.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Test.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Question.php";
	
    $views = new View();
    $security = new Security();
    $security->sec_session_start();
    $login = $security->login_check();
    $security->refreshUser($_SESSION['user_id']);
    $title = "Dashboard";
    $page_heading = "Dashboard";
    $keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
    $description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

    if($login['response'] != "error") {
        include($_SERVER['DOCUMENT_ROOT'].$views->includeHeader($_SESSION['user']->getPermissionName()));

        include($_SERVER['DOCUMENT_ROOT'].$views->includeLeftNav($_SESSION['user']->getPermissionName()));
?>

            <!-- begin: breadcrumbs -->
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>View Tests</h2>
                <div class="right-wrapper pull-right">
                    <ol class="breadcrumbs">
                        <li>
                            <a  class="sidebar-right-toggle" href="/portal/">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li><span>Subject</span></li>
                        <li><span>Tests</span></li>
                        <li><span>View</span></li>
                    </ol>
                    <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                </div>
            </header>
                <!-- end: breadcrumbs -->

                <!-- start: page -->
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">View Tests</h2>
                    </header>
                    <div class="panel-body">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-md">
                                       
                                    </div>
                                </div>
                            </div>
                        <table class="table table-bordered table-striped" id="members" name="members">
                            <thead>
                            <tr>
                                <th width="5%">Test Name</th>
                                <th width="5%">Test Description</th>
                                <th width="5%">Test Marks</th>
                                <th width="5%">Functions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                 //   $tablepop = Test::pullTestsBySubject(array(27, 29));
                                 //   for ($i=0; $i<count($tablepop); $i++){
                                  //      for($j=0; $j<count($tablepop[$i]); $j++){
                                  //          echo "<tr>";
                                   //         foreach($tablepop[$i][$j] as $value){
                                   //             echo "<td>" . $value ."</td>";
                                   //         }
                                  //          echo "<td><a href=" . "/portal/test/" . " class=" . "btn btn-primary" . ">Select Test</button></td>"; 
                                   //         echo "</tr>";
                                   //     }
                                   // }
                                ?> 
                            </tbody>
                        </table>
                    </div>
                    
                    </div>
                </section>
                
               

                <!-- end: page -->
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
    "/assets/javascripts/theme.init.js",
	"/assets/vendor/select2/select2.js",
	"/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js",
    "assets/vendor/jquery-datatables/media/js/jquery.dataTables.js",
	"/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"));
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
                    "emptyTable": "There are no Tests available to view."
                },
                bProcessing: true,
                sAjaxSource:  "/assets/datatables/tests/student.php?userid=<?php echo urlencode($_SESSION['user']->getUserID()); ?>",
                "aoColumns": [
                    { "mData": "Test Name"},
					{ "mData": "Test Description"},
					{ "mData": "Test Marks"},
                    { "mData": "Functions"}
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

