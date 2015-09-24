<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/assets/includes/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/assets/includes/functions.php';

sec_session_start();

?>
<!doctype html>
<html class="fixed">
<head>
    <!-- Basic -->
    <meta charset="UTF-8">

    <title>User Groups - Portal | R.E.A.CH - Monash South Africa</title>
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
                                    <a href="/portal/">
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                        <span>Dashboard</span>
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
                                        <span>User Management</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="/portal/users/view/">View Users</a>
                                        </li>
                                        <li>
                                            <a href="/portal/users/new/">New Users</a>
                                        </li>
                                        <li>
                                            <a href="/portal/users/edit/">Edit Users</a>
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
                                        <span>Settings and Permissions</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="/portal/settings/user-groups/">User Groups</a>
                                        </li>
                                        <li>
                                            <a href="/portal/settings/page-view/">Page View Permissions</a>
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
                    <h2>User Groups</h2>

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
                    <div class="col-md-6">
                        <p>This is column 1. More can be added. adjust the values above. Remember they must all equal 12 in the end.</p>
                    </div>

                    <div class="col-md-6">
                        <p>This is column 2. More can be added. adjust the values above. Remember they must all equal 12 in the end.</p>
                    </div>


                    <div class="col-md-4">
                        <p>This is column 1. More can be added. adjust the values above. Remember they must all equal 12 in the end.</p>
                    </div>

                    <div class="col-md-4">
                        <p>This is column 2. More can be added. adjust the values above. Remember they must all equal 12 in the end.</p>
                    </div>
                    <div class="col-md-4">
                        <p>This is column 3. More can be added. adjust the values above. Remember they must all equal 12 in the end.</p>
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


