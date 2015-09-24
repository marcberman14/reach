<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/assets/includes/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/assets/includes/functions.php';

sec_session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

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
<?php

$login = login_check($mysqli);
if ($login['response'] == 'error') {?>

    <script>
        window.location.href = "/user/login/";
    </script>

<?php } else if ($login['response'] == 'warning') { ?>

    <script>
        window.location.href = "/portal/profile/";
    </script>
<?php
} else if ($login['response'] == 'deny') { ?>
    <script>
        window.location.href = "/deny.php";
    </script>
<?php } else if($login['response'] == 'success') { ?>

    <section class="body">
        <!-- start: header -->
        <header class="header">
            <div class="logo-container">
                <a href="/" class="logo">
                    <img src="/assets/img/logo.png" height="35" alt="Monash South Africa" />
                </a>
                <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>

            <!-- start: search & user box -->
            <div class="header-right">
                <ul class="notifications">

                    <li>
                        <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            <span class="badge"><?php
                                $tutorCount = tutorCount($mysqli);
                                $teacherCount = teacherCount($mysqli);
                                $adminCount = adminCount($mysqli);
                                print_r($tutorCount + $teacherCount + $adminCount); ?></span>
                        </a>

                        <div class="dropdown-menu notification-menu">
                            <div class="notification-title">
                                <span class="pull-right label label-default"><?php print_r($tutorCount + $teacherCount + $adminCount); ?></span>
                                Pending Approvals
                            </div>

                            <div class="content">
                                <ul>
                                    <li>
                                        <a href="#" class="clearfix">
                                            <div class="image">
                                                <i class="fa fa-graduation-cap bg-info"></i>
                                            </div>
                                            <span class="title">Tutors</span>
                                            <span class="message">Awaiting approval: <?php print_r($tutorCount); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="clearfix">
                                            <div class="image">
                                                <i class="fa fa-book bg-info"></i>
                                            </div>
                                            <span class="title">Teachers</span>
                                            <span class="message">Awaiting approval: <?php print_r($teacherCount); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="clearfix">
                                            <div class="image">
                                                <i class="fa fa-star bg-info"></i>
                                            </div>
                                            <span class="title">Administrator</span>
                                            <span class="message">Awaiting approval: <?php print_r($adminCount); ?></span>
                                        </a>
                                    </li>
                                </ul>

                                <hr />

                                <div class="text-right">
                                    <a href="/portal/users/approve/" class="view-more">View All</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <span class="separator"></span>
                <div id="userbox" class="userbox">

                    <a href="#" data-toggle="dropdown">
                        <figure class="profile-picture">
                            <img src="/bin/user-profile/<?php echo getProfilePic($mysqli)['url'];?>" alt="<?php echo htmlentities($_SESSION['username']) .' ' . htmlentities($_SESSION['userlast']);?>" class="img-circle" data-lock-picture="/bin/user-profile/<?php echo getProfilePic($mysqli)['url'];?>" />
                        </figure>
                        <div class="profile-info">
                            <span class="name"><?php echo htmlentities($_SESSION['username']) .' ' . htmlentities($_SESSION['userlast']);?></span>
                            <span class="role"><?php echo htmlentities($_SESSION['usertype']); ?></span>
                        </div>

                        <i class="fa custom-caret"></i>
                    </a>

                    <div class="dropdown-menu">
                        <ul class="list-unstyled">
                            <li class="divider"></li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="/portal/profile/"><i class="fa fa-user"></i> My Profile</a>
                            </li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="/assets/includes/logout.php"><i class="fa fa-power-off"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end: search & user box -->
        </header>
        <!-- end: header -->

        <div class="inner-wrapper">
            <!-- start: sidebar -->
            <aside id="sidebar-left" class="sidebar-left">

                <div class="sidebar-header">
                    <div class="sidebar-title">
                        My R.E.A.CH
                    </div>
                    <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>

                <div class="nano">
                    <div class="nano-content">
                        <nav id="menu" class="nav-main" role="navigation">
                            <ul class="nav nav-main">
                                <li>
                                    <a href="/portal/userprofile/">
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>

                                <li class="nav-parent">
                                    <a>
                                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                                        <span>Subject Management</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="/portal/subject/view/">View Subjects</a>
                                        </li>
                                        <li>
                                            <a href="/portal/subject/new/">New Subject</a>
                                        </li>
                                        <li>
                                            <a href="/portal/subject/edit/">Edit Subject</a>
                                        </li>
                                        <li>
                                            <a href="/portal/subject/delete/">Delete Subject</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-parent">
                                    <a>
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                        <span>Tests</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="/portal/users/view/">View Tests</a>
                                        </li>
                                        <li>
                                            <a href="/portal/users/new/">View Results</a>
                                        </li>
                                        <li>
                                            <a href="/portal/userprofile/edit">Edit Users</a>
                                        </li>
                                        <li>
                                            <a href="/portal/users/activate/">Activate/Deactivate Users</a>
                                        </li>
                                        <li>
                                            <a href="/portal/users/approve/">User Approval</a>
                                        </li>
                                        <li>
                                            <a href="/portal/users/password-reset/">Reset Users Password</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-parent">
                                    <a>
                                        <i class="fa fa-gears" aria-hidden="true"></i>
                                        <span>Settings</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="/portal/settings/user-groups/">Setting1?</a>
                                        </li>
                                        <li>
                                            <a href="/portal/settings/page-view/">Setting2?</a>
                                        </li>

                                    </ul>
                                </li>


                            </ul>
                        </nav>

                        <hr class="separator" />
                    </div>
                </div>
            </aside>
            <!-- end: sidebar -->

            <!-- begin: breadcrumbs -->
            <section role="main" class="content-body">
                <header class="page-header">
                    <h2>User Profile</h2>

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
                <div class="row">
                <div class="col-md-4 col-lg-3">

                    <section class="panel">
                        <div class="panel-body">
                            <div class="thumb-info mb-md">
                                <img src="/bin/user-profile/<?php echo getProfilePic($mysqli)['url'];?>" class="rounded img-responsive" alt="John Doe">
                                <div class="thumb-info-title">
                                    <span class="thumb-info-inner">John Doe</span>
                                    <span class="thumb-info-type">Student</span>
                                </div>
                            </div>

                            <div class="widget-toggle-expand mb-md">
                                <div class="widget-header">
                                    <h6>Profile Completion</h6>
                                    <div class="widget-toggle">+</div>
                                </div>
                                <div class="widget-content-collapsed">
                                    <div class="progress progress-xs light">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            60%
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-expanded">
                                    <ul class="simple-todo-list">
                                        <li class="completed">Update Profile Picture</li>
                                        <li class="completed">Change Personal Information</li>
                                        <li>Update Social Media</li>
                                        <li>Follow Someone</li>
                                    </ul>
                                </div>
                            </div>

                            <hr class="dotted short">

                            <h6 class="text-muted">About</h6>
                            <p>Scholar currently in matric at Maragon. Will be attending Monash South Africa.</p>
                            <div class="clearfix">
                                <a class="text-uppercase text-muted pull-right" href="#">(View All)</a>
                            </div>

                            <hr class="dotted short">

                            <div class="social-icons-list">
                                <a rel="tooltip" data-placement="bottom" target="_blank" href="http://www.facebook.com" data-original-title="Facebook"><i class="fa fa-facebook"></i><span>Facebook</span></a>
                                <a rel="tooltip" data-placement="bottom" href="http://www.twitter.com" data-original-title="Twitter"><i class="fa fa-twitter"></i><span>Twitter</span></a>
                                <a rel="tooltip" data-placement="bottom" href="http://www.linkedin.com" data-original-title="Linkedin"><i class="fa fa-linkedin"></i><span>Linkedin</span></a>
                            </div>

                        </div>
                    </section>


                   

                   
                </div>
                <div class="col-md-8 col-lg-6">

                    <div class="tabs">
                        <ul class="nav nav-tabs tabs-primary">
                            <li class="active">
                                <a href="#overview" data-toggle="tab">Overview</a>
                            </li>
                            <li>
                                <a href="#edit" data-toggle="tab">Edit</a>
                            </li>
                            <li class="active">
                                <a href="#results" data-toggle="tab">Results</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div id="overview" class="tab-pane active">                      

                                <h4 class="mb-xlg">Timeline</h4>

                                <div class="timeline timeline-simple mt-xlg mb-md">
                                    <div class="tm-body">
                                        <div class="tm-title">
                                            <h3 class="h5 text-uppercase">September 2015</h3>
                                        </div>
                                        <ol class="tm-items">
                                            <li>
                                                <div class="tm-box">
                                                    <p class="text-muted mb-none">7 hours ago.</p>
                                                    <p>
                                                        Enrolled in English.                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="tm-box">
                                                    <p class="text-muted mb-none">8 hours ago.</p>
                                                    <p>
                                                        Enrolled in Mathematics.
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="tm-box">
                                                    <p class="text-muted mb-none">7 months ago.</p>
                                                    <p>
                                                        Checkout! How cool is that!
                                                    </p>
                                                    <div class="thumbnail-gallery">
                                                        <a class="img-thumbnail lightbox" href="assets/images/projects/project-4.jpg" data-plugin-options='{ "type":"image" }'>
                                                            <img class="img-responsive" width="215" src="assets/images/projects/project-4.jpg">
																	<span class="zoom">
																		<i class="fa fa-search"></i>
																	</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="results" class="tab-pane">
	                             <ul class="simple-bullet-list mb-xlg">
                        <li class="red">
                            <span class="title">Mathematics</span>
                            <span class="description truncate">55%</span>
                        </li>
                        <li class="green">
                            <span class="title">Science</span>
                            <span class="description truncate">60%</span>
                        </li>
                        <li class="blue">
                            <span class="title">English</span>
                            <span class="description truncate">70%</span>
                        </li>
                        <li class="orange">
                            <span class="title">Geography</span>
                            <span class="description truncate">65%</span>
                        </li>
                    </ul>
	                            
                            </div>
                            
                            <div id="edit" class="tab-pane">

                                <form class="form-horizontal" action="/assets/includes/process_editstudent.php" method="post" name="studentprofile" id="studentprofile">
                                    <h4 class="mb-xlg">Personal Information</h4>
                                    <fieldset>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="firstname">First Name</label>
                                            <div class="col-md-8">
                                                <input type="text" value="" class="form-control" name="firstname" id="firstname" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="profileLastName">Last Name</label>
                                            <div class="col-md-8">
                                                <input type="text" value="" class="form-control" name="surname" id="surname">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="profileAddress">Email Address</label>
                                            <div class="col-md-8">
                                                <input type="text" value="" class="form-control" name="email" id="email">
                                            </div>
                                        </div>
                                    </fieldset>
                                    
                                    <hr class="dotted tall">
                                    <h4 class="mb-xlg">Student Information</h4>
                                    
                                    <fieldset>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="profileAddress">Street Name</label>
                                            <div class="col-md-8">
                                                <input type="text" value="" class="form-control" name="stustreetname" id="stustreetname">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="profileAddress">Suburb</label>
                                            <div class="col-md-8">
                                                <input type="text" value="" class="form-control" name="stusuburb" id="stusuburb">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="profileAddress">City</label>
                                            <div class="col-md-8">
                                                <input type="text" value="" class="form-control" name="stucity" id="stucity">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="profileAddress">Postal Code</label>
                                            <div class="col-md-8">
                                                <input type="text" value="" class="form-control" name="stupostcode" id="stupostcode">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="profileAddress">Home Number</label>
                                            <div class="col-md-8">
                                                <input type="text" value="" class="form-control" name="stuhomeno" id="stuhomeno">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="profileAddress">Cell Phone Number</label>
                                            <div class="col-md-8">
                                                <input type="text" value="" class="form-control" name="stucellno" id="stucellno">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="profileAddress">Alternative Contact Number</label>
                                            <div class="col-md-8">
                                                <input type="text" value="" class="form-control" name="stualtno" id="stualtno">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="profileAddress">Parent Cell Phone Number</label>
                                            <div class="col-md-8">
                                                <input type="text" value="" class="form-control" name="stuparenttno" id="stuparentno">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="profileAddress">Current School Name</label>
                                            <div class="col-md-8">
                                                <input type="text" value="" class="form-control" name="stuschoolname" id="stuschoolname">
                                            </div>
                                        </div>
                                        
                                    </fieldset>
                                    
                                    <hr class="dotted tall">
                                    <h4 class="mb-xlg">Change Password</h4>
                                    <fieldset class="mb-xl">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="profileNewPassword">New Password</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="profileNewPassword">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="profileNewPasswordRepeat">Repeat New Password</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="profileNewPasswordRepeat">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="col-md-9 col-md-offset-3">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-default">Reset</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-3">

             

                    <h4 class="mb-md">Subjects</h4>
                    <ul class="simple-bullet-list mb-xlg">
                        <li class="red">
                            <span class="title">Mathematics</span>
                            <span class="description truncate">Lorem ipsom dolor sit.</span>
                        </li>
                        <li class="green">
                            <span class="title">Science</span>
                            <span class="description truncate">Lorem ipsom dolor sit amet</span>
                        </li>
                        <li class="blue">
                            <span class="title">English</span>
                            <span class="description truncate">Lorem ipsom dolor sit.</span>
                        </li>
                        <li class="orange">
                            <span class="title">Geography</span>
                            <span class="description truncate">Lorem ipsom dolor sit.</span>
                        </li>
                    </ul>

                    <h4 class="mb-md">Badges</h4>
                    <ul class="simple-user-list mb-xlg">
                        <li>
                            <figure class="image rounded">
                                <img src="/assets/img/badge.png" alt="Joseph Doe Junior" class="img-circle">
                            </figure>
                            <span class="title">Start the Journey</span>
                            <span class="message">Enrolled in first subject.</span>
                        </li>
                        <li>
                            <figure class="image rounded">
                                <img src="/assets/img/badge.png" alt="Joseph Junior" class="img-circle">
                            </figure>
                            <span class="title">Finisher</span>
                            <span class="message">Completed first subject course.</span>
                        </li>
                        <li>
                            <figure class="image rounded">
                                <img src="/assets/img/badge.png" alt="Joe Junior" class="img-circle">
                            </figure>
                            <span class="title">Hundred</span>
                            <span class="message">Achieve full marks in any subject test.</span>
                        </li>
                        <li>
                            <figure class="image rounded">
                                <img src="/assets/img/badge.png" alt="Joseph Doe Junior" class="img-circle">
                            </figure>
                            <span class="title">Team Player</span>
                            <span class="message">Refer a friend.</span>
                        </li>
                    </ul>
                </div>

                </div>

                <aside id="sidebar-right" class="sidebar-right">
                    <div class="nano">
                        <div class="nano-content">
                            <a href="#" class="mobile-close visible-xs">
                                Collapse <i class="fa fa-chevron-right"></i>
                            </a>

                            <div class="sidebar-right-wrapper">

                                <div class="sidebar-widget widget-calendar">
                                    <h6>Upcoming Tasks</h6>
                                    <div data-plugin-datepicker data-plugin-skin="dark" ></div>

                                    <ul>
                                        <li>
                                            <time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
                                            <span>Company Meeting</span>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </aside>



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


