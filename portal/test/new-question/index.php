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
$title = "Quiz";
$page_heading = "New Quiz";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

if($login['response'] != "error") {
include($_SERVER['DOCUMENT_ROOT'].$views->includeHeader($_SESSION['user']->getPermissionName()));

include($_SERVER['DOCUMENT_ROOT'].$views->includeLeftNav($_SESSION['user']->getPermissionName()));
?>
<!doctype html>
<html class="fixed">
<head>
    <!-- Basic -->
    <meta charset="UTF-8">

    <title>Dashboard - Portal | R.E.A.CH - Monash South Africa</title>
    <meta name="description" content="Dashboard - Portal | R.E.A.CH - Monash South Africa">
    <meta name="author" content="Monash South Africa">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="/assets/stylesheets/theme.css" />
    <link rel="stylesheet" href="/assets/stylesheets/theme-admin-extension.css" />

    <link rel="stylesheet" href="/assets/vendor/morris/morris.css" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="/assets/stylesheets/colours/default.css" />

</head>
<body>

            <!-- begin: breadcrumbs -->
            <section role="main" class="content-body">
                <header class="page-header">
                    <h2>Quiz Management</h2>

                    <div class="right-wrapper pull-right">
                        <ol class="breadcrumbs">
                            <li>
                                <a class="sidebar-right-toggle" href="/portal/">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li><span>Test</span></li>
                            <li><span>Create Questions</span></li>
                        </ol>

                        <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                    </div>
                </header>
                <!-- end: breadcrumbs -->

                <!-- start: page -->

                <div class="row">
                    <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Test Creation</div>
                                <form class = form-horizontal action="../view-tests/index.php?subjectid=<?php echo urlencode($_GET["subjectid"]) ?> " method="post" name="test" id="test">
                                  <div class = "panel panel-body">
                                      ?>
                                      <!--NEW STUFF-->
                                      <form method="post"">
                                      <table>
                                          <tr><td colspan="2" id="heading"> Test</td>
                                          </tr>
                                          <tr>
                                              <td>Enter Question here :</td>
                                              <td><input type="text" name="question" id="question"/></td>
                                          </tr>
                                          <tr>
                                              <td>Enter First option (A) :</td>
                                              <td><input type="text" name="wanswer" id="wanswer" /></td>
                                          </tr>
                                          <tr>
                                              <td>Enter Second option (B) : </td>
                                              <td><input type="text" name="wanswer1" id="wanswer1" /></td>
                                          </tr>
                                          <tr>
                                              <td>Enter Third option (C) :</td>
                                              <td><input type="text" name="wanswer2" id="wanswer2" /></td>
                                          </tr>
                                          <tr>
                                              <td>Enter Fourth option (D) :</td>
                                              <td><input type="text" name="wanswer3" id="wanswer3" /></td>
                                          </tr>
                                          <tr>
                                              <td>Select Right Option code</td>
                                              <td><select name="canswer" id="canswer">
                                                      <option value="a">A</option>
                                                      <option value="b">B</option>
                                                      <option value="c">C</option>
                                                      <option value="d">D</option>
                                                  </select>
                                              </td>

                                          </tr>
                                      </table>
                                      
                                      <button class="btn btn-primary push-bottom">Save Test <i class="fa "></i></button>

                                </form>

                                <!--NEW STUFF-->

                                

                                         </div>
                                         
                                          


                         </form>
                         
                         

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- end: page -->
            </section>
        </div>
    </section>
<?php } ?>
<!-- Vendor -->
<script src="/assets/vendor/jquery/jquery.js"></script>
<script src="/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="/assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="/assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/assets/vendor/magnific-popup/magnific-popup.js"></script>
<script src="/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
<script src="/assets/vendor/modernizr/modernizr.js"></script>

<!-- Specific Page Vendor -->

<!-- Theme Base, Components and Settings -->
<script src="/assets/javascripts/theme.js"></script>

<!-- Theme Initialization Files -->
<script src="/assets/javascripts/theme.init.js"></script>

</body>
</html>


