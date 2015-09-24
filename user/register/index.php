<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/assets/includes/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/assets/includes/functions.php';

sec_session_start();
?>

<!DOCTYPE html>
<html>
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <title>Register | R.E.A.CH - Monash South Africa</title>
    <meta name="keywords" content="R.E.A.CH - Monash South Africa" />
    <meta name="description" content="Home | R.E.A.CH - Monash South Africa">
    <meta name="author" content="Monash South Africa">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/assets/home-site/vendor/bootstrap/bootstrap.css">
    <!-- Fancy icons by Google-->
    <link rel="stylesheet" href="/assets/home-site/vendor/fontawesome/css/font-awesome.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="/assets/home-site/css/theme.css">
    <link rel="stylesheet" href="/assets/home-site/css/theme-elements.css">

    <!-- Current Page CSS -->
    <!-- Revolution Slider css-->
    <link rel="stylesheet" href="/assets/home-site/vendor/rs-plugin/css/settings.css" media="screen">
    <!-- The cirles with the fancy flip -->
    <link rel="stylesheet" href="/assets/home-site/vendor/circle-flip-slideshow/css/component.css" media="screen">

    <!-- Skin CSS  -->
    <link rel="stylesheet" href="/assets/home-site/css/skins/default.css"/>

    <!-- Used for cross browser compatibility -->
    <script src="/assets/home-site/vendor/modernizr/modernizr.js"></script>

</head>
<body>

<div class="body">
    <header id="header" data-plugin-options='{"alwaysStickyEnabled": true}'>
        <div class="container">
            <div class="logo">
                <a href="/">
                    <img alt="Porto" width="332" height="53" src="/assets/home-site/img/logo.png">
                </a>
            </div>
            <div class="search">
                <form id="searchForm" action="page-search-results.html" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control search" name="q" id="q" placeholder="Search..." required>
								<span class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
								</span>
                    </div>
                </form>
            </div>
            <nav>
                <ul class="nav nav-pills nav-top">
                    <li>
                        <a href="http://www.monash.ac.za/">Monash South Africa</a>
                    </li>
                    <li>
                        <a href="http://www.laureate.net/">Laureate International Universities</a>
                    </li>
                    <li>
                        <a href="/portal/">R.E.A.CH. Portal</a>
                    </li>
                </ul>
            </nav>
            <button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <div class="navbar-collapse nav-main-collapse collapse">
            <div class="container">
                <nav class="nav-main mega-menu">
                    <ul class="nav nav-pills nav-main" id="mainMenu">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" href="/about-us/">About us <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li> <a href="/about-us/index.html">Who we are</a></li>
                                <li><a href="/about-us/courses.html">Courses Offered</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="shortcodes.html">Contact us</a>
                        </li>

                        <?php
                        $login = login_check($mysqli);
                        if ($login['response'] == 'success'|| $login['response'] == 'warning' || $login['response'] == 'deny'){?>
                            <li class="dropdown mega-menu-item mega-menu-signin signin logged" id="headerAccount">
                                <a class="dropdown-toggle" href="/portal/profile/index.php">
                                    <i class="fa fa-user"></i> <?php echo htmlentities($_SESSION['username']) .' ' . htmlentities($_SESSION['userlast']); ?>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="mega-menu-content">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="user-avatar">
                                                        <div class="img-thumbnail">
                                                            <figure class="profile-picture">
                                                                <img src="/bin/user-profile/<?php echo getProfilePic($mysqli)['url'];?>" alt="<?php echo htmlentities($_SESSION['username']) .' ' . htmlentities($_SESSION['userlast']);?>" class="img-circle" data-lock-picture="/bin/user-profile/<?php echo getProfilePic($mysqli)['url'];?>" />
                                                            </figure>
                                                        </div>
                                                        <p><strong><?php echo htmlentities($_SESSION['username']) .' ' . htmlentities($_SESSION['userlast']); ?></strong><span><?php echo htmlentities($_SESSION['usertype']); ?></span></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <ul class="list-account-options">
                                                        <li>
                                                            <a href="/portal/">My Account</a>
                                                        </li>
                                                        <li>
                                                            <a href="/assets/includes/logout.php">Log Out</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        <?php } else { ?>

                            <li class="dropdown">
                                <a class="dropdown-toggle" href="">Login/Register<i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li> <a href="/user/login/">Login</a></li>
                                    <li><a href="/user/register">Register</a></li>
                                </ul>
                            </li>
                        <?php }?>


                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div role="main" class="main push-top">

        <div class="container">

            <div class="row">
                <div class="col-md-12">

                    <div class="row featured-boxes register">
                        <div class="col-sm-12">

                            <div class="featured-box featured-box-secundary default info-content">
                                <div class="box-content">




                                    <?php
                                    $login = login_check($mysqli);
                                    if ($login['response'] == 'error') { ?>
                                        <div class="alert alert-success hidden" id="contactSuccess">Success! You will be
                                            redirected shortly.
                                        </div>
                                        <div class="alert alert-danger hidden" id="contactError">Error!</div>
                                        <h1>Register:</h1>

                                        <form action="/assets/includes/process_register.php" method="post" name="registrationform" id="registrationform">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>First Name:</label>
                                                        <input type="text" value="" class="form-control input-lg" name="firstname" id="firstname">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>Surname/Family Name:</label>
                                                        <input type="text" value="" class="form-control input-lg" name="surname" id="surname">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>Email Address:</label>
                                                        <input type="text" value="" class="form-control input-lg" name="email" id="email">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="usertype">User Group:</label>
                                                        <select class="form-control input-lg" name="usertype" id="usertype">
                                                            <option value="">Select one</option>
                                                            <option value="1">Student</option>
                                                            <option value="2">Tutor</option>
                                                            <option value="3">Teacher</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>Password:</label>
                                                        <input type="password" value="" class="form-control input-lg" name="password" id="password">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>Confirm password:</label>
                                                        <input type="password" value="" class="form-control input-lg" name="confirmpwd" id="confirmpwd">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="submit" id="submit" name="submit" value="Register" class="btn btn-lg btn-primary push-bottom">
                                                </div>
                                            </div>
                                        </form>
                                        <p>Already have an account? <a href="/user/login/" class="btn btn-primary btn-lg">Login now!</a></p>
                                    <?php
                                    } else if ($login['response'] == 'warning') { ?>

                                        <div class="alert alert-warning" id="contactWarning">Warning! You are required to
                                            complete your profile before you can access the system.<br>
                                            You will be redirected shortly.<br><br>
                                            Alternatively, you can log out and switch user? <a href="/assets/includes/logout.php" class="btn btn-primary btn-lg">Log out</a>

                                        </div>
                                        <script>
                                            window.setTimeout(function () {
                                                window.location.href = "/portal/profile/";
                                            }, 5000);
                                        </script>


                                    <?php
                                    } else if ($login['response'] == 'deny') { ?>

                                        <script>
                                                window.location.href = "/deny.php";
                                        </script>

                                    <?php
                                    } else if ($login['response'] == 'success') { ?>
                                        <div class="alert alert-info" id="contactInfo">You are already logged in.<br> You will
                                            be redirected to your portal shortly.
                                            <br><br>
                                            Alternatively, you can log out and switch user? <a href="/assets/includes/logout.php" class="btn btn-primary btn-lg">Log out</a>
                                        </div>
                                        <script>
                                            window.setTimeout(function () {
                                                window.location.href = "/portal/";
                                            }, 5000);
                                        </script>

                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div>
                        <h4>Quick Links</h4>
                        <ul class="contact">
                            <li><a href="/about-us/">About us</a></li>
                            <li><a href="/courses/">Courses</a></li>
                            <li><a href="/contact-us">Contact us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-details">
                        <h4>R.E.A.CH. Portal</h4>
                        <ul class="contact">
                            <li><a href="/portal/">My Account</a></li>
                            <li><a href="/portal/courses/">My Courses</a></li>
                            <li><a href="/portal/courses/report/">My Grades</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-details">
                        <h4>Contact Us</h4>
                        <ul class="contact">
                            <li><p><i class="fa fa-map-marker"></i> <strong>Address:</strong> 144 Peter Road, Ruimsig, South Africa 1714</p></li>
                            <li><p><i class="fa fa-phone"></i> <strong>Phone:</strong> 27 (11) 950-4000</p></li>
                            <li><p><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:inquiries@monash.ac.za">inquiries@monash.ac.za</a></p></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>Monash South Africa Incorporated in Australia, External Non-Profit Company (Registration number 2005/009321/12), is a campus of Monash University, a public university, incorporated by an Act of Parliament in Victoria, Australia.</p><br>

                        <p>Monash South Africa NPC is registered with the Department of Education as a private higher education institution under the Higher Education Act of 1997. Registration number 2000/HE10/002.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- Vendor -->
<script src="/assets/home-site/vendor/jquery/jquery.js"></script>

<script src="/assets/home-site/vendor/bootstrap/bootstrap.js"></script>
<script src="/assets/home-site/vendor/common/common.js"></script>
<script src="/assets/home-site/vendor/jquery.validation/jquery.validation.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="/assets/home-site/js/theme.js"></script>

<!-- Specific Page Vendor and Views -->
<!-- Revolution Slider -->
<script src="/assets/home-site/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="/assets/home-site/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

<!-- Theme Initialization Files -->
<script src="/assets/home-site/js/theme.init.js"></script>

<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-12345678-1']);
    _gaq.push(['_trackPageview']);

    (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
 -->
<!--AJAX Login View + validation-->
<script type="text/JavaScript" src="/assets/ajax/register/form-submit.js"></script>

<!-- Hashing JS -->
<script type="text/JavaScript" src="/assets/ajax/shared/sha512.js"></script>

</body>
</html>
