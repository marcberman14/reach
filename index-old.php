<?php
include_once 'assets/includes/db_connect.php';
include_once 'assets/includes/functions.php';
sec_session_start();
?>

<!DOCTYPE html>
<html>
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <title>Home | R.E.A.CH - Monash South Africa</title>
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
    <link rel="stylesheet" href="/assets/home-site/css/skins/default.css" />

    <!-- Used for cross browser compatibility -->
    <script src="/assets/home-site/vendor/modernizr/modernizr.js"></script>

</head>
<body>

<div class="body">
    <header id="header" data-plugin-options='{"alwaysStickyEnabled": true}'>
        <div class="container">
            <div class="logo">
                <a href="/">
                    <img alt="Monash South Africa R.E.A.CH Programme" src="/assets/home-site/img/logo.png">
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
                        <a href="http://www.msa.ac.za/">Monash South Africa</a>
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
                                <li> <a href="/about-us/who-we-are/">Who we are</a></li>
                                <li><a href="/about-us/courses/">Courses Offered</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="/contact-us/">Contact us</a>
                        </li>

                        <?php
                        $login = login_check($mysqli);
                        if ($login['response'] == 'success'|| $login['response'] == 'warning'){?>
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

                            <li class="dropdown mega-menu-item mega-menu-signin signin" id="headerAccount">
                                <a class="dropdown-toggle" href="/user/login/index.php">
                                    <i class="fa fa-user"></i> Sign In
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="mega-menu-content">
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <div class="signin-form">
                                                        <div class="alert alert-success hidden" id="contactSuccess">Success! You will be redirected shortly.</div>
                                                        <div class="alert alert-danger hidden" id="contactError">Error! </div>

                                                        <span class="mega-menu-sub-title">Sign In</span>

                                                        <form action="/assets/includes/process_login.php" method="POST" name="loginform" id="loginform">
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-12">
                                                                        <label>E-mail Address</label>
                                                                        <input type="text" value="" class="form-control input-lg" name="email" id="email">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-12">
                                                                        <label>Password</label>
                                                                        <input type="password" value="" class="form-control input-lg" id="password" name="password">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="submit"  value="Login" class="btn btn-lg btn-primary push-bottom" id="submit" name="submit">
                                                                </div>
                                                            </div>

                                                        </form>

                                                        <p class="sign-up-info">Don't have an account yet? <a href="/user/register/index.php">Sign Up</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        <?php }?>


                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div role="main" class="main">
        <div class="slider-container">
            <div class="slider" id="revolutionSlider" data-plugin-revolution-slider data-plugin-options='{"startheight": 500}'>
                <ul>
                    <li data-transition="fade" data-slotamount="13" data-masterspeed="300" >

                        <img src="assets/home-site/img/slides/slide-bg.jpg" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

                        <div class="tp-caption sft stb visible-lg"
                             data-x="177"
                             data-y="180"
                             data-speed="300"
                             data-start="1000"
                             data-easing="easeOutExpo"><img src="assets/home-site/img/slides/slide-title-border.png" alt=""></div>

                        <div class="tp-caption top-label lfl stl"
                             data-x="227"
                             data-y="180"
                             data-speed="300"
                             data-start="500"
                             data-easing="easeOutExpo">START YOUR FUTURE</div>

                        <div class="tp-caption sft stb visible-lg"
                             data-x="477"
                             data-y="180"
                             data-speed="300"
                             data-start="1000"
                             data-easing="easeOutExpo"><img src="assets/home-site/img/slides/slide-title-border.png" alt=""></div>

                        <div class="tp-caption main-label sft stb"
                             data-x="235"
                             data-y="210"
                             data-speed="300"
                             data-start="1500"
                             data-easing="easeOutExpo">TODAY</div>

                        <div class="tp-caption bottom-label sft stb"
                             data-x="168"
                             data-y="280"
                             data-speed="500"
                             data-start="2000"
                             data-easing="easeOutExpo">With the Monash R.E.A.CH. Programme.</div>

                        <div class="tp-caption randomrotate"
                             data-x="905"
                             data-y="248"
                             data-speed="500"
                             data-start="2500"
                             data-easing="easeOutBack"><img src="assets/home-site/img/slides/slide-concept-2-1.png" alt=""></div>

                        <div class="tp-caption sfb"
                             data-x="955"
                             data-y="200"
                             data-speed="400"
                             data-start="3000"
                             data-easing="easeOutBack"><img src="assets/home-site/img/slides/slide-concept-2-2.png" alt=""></div>

                        <div class="tp-caption sfb"
                             data-x="925"
                             data-y="170"
                             data-speed="700"
                             data-start="3150"
                             data-easing="easeOutBack"><img src="assets/home-site/img/slides/slide-concept-2-3.png" alt=""></div>

                        <div class="tp-caption sfb"
                             data-x="875"
                             data-y="130"
                             data-speed="1000"
                             data-start="3250"
                             data-easing="easeOutBack"><img src="assets/home-site/img/slides/slide-concept-2-4.png" alt=""></div>

                        <div class="tp-caption sfb"
                             data-x="605"
                             data-y="80"
                             data-speed="600"
                             data-start="3450"
                             data-easing="easeOutExpo"><img src="assets/home-site/img/slides/slide-concept-2-5.png" alt=""></div>

                        <div class="tp-caption blackboard-text lfb "
                             data-x="635"
                             data-y="300"
                             data-speed="500"
                             data-start="3450"
                             data-easing="easeOutExpo" style="font-size: 37px;">Open your mind</div>

                        <div class="tp-caption blackboard-text lfb "
                             data-x="660"
                             data-y="350"
                             data-speed="500"
                             data-start="3650"
                             data-easing="easeOutExpo" style="font-size: 47px;">to the world</div>

                        <div class="tp-caption blackboard-text lfb "
                             data-x="685"
                             data-y="400"
                             data-speed="500"
                             data-start="3850"
                             data-easing="easeOutExpo" style="font-size: 32px;">of education</div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="home-intro" id="home-intro">
            <div class="container">

                <div class="row">
                    <div class="col-md-8">
                        <p>
                            Take the first steps to building a brighter future with the <span><em>Monash R.E.A.CH. Programme</em></span>

                        </p>
                    </div>
                    <div class="col-md-4">
                        <div class="get-started">
                            <a href="/user/register/index.php" class="btn btn-lg btn-primary">Register Now!</a><br>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="container">

            <div class="row center">
                <div class="col-md-12">
                    <h1 class="short">
                        Monash South Africa R.E.A.CH. Programme is Lorem ipsum dolor sit amet
                    </h1>
                    <p class="featured lead">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce elementum, nulla vel pellentesque consequat, ante nulla hendrerit arcu, ac tincidunt mauris lacus sed leo. vamus suscipit molestie vestibulum.
                    </p>
                </div>
            </div>

            <div class="row featured-boxes">
                <div class="col-md-6 col-sm-6">
                    <div class="featured-box featured-box-secundary">
                        <div class="box-content">
                            <i class="icon-featured fa fa-book"></i>
                            <a href="/portal/"><h4><strong>R.E.A.CH.</strong> OUT AND <strong>ADVANCE</strong> YOUR SKILLS</h4></a>
                            <div class="feature-box-info">
                                <p class="tall">Pick your subject, grade and study material</p>
                            </div>


                            <div class="feature-box-info">
                                <p class="tall">Read instructions, watch video's and complete exercises</p>
                            </div>

                            <div class="feature-box-info">
                                <p class="tall">Test your skills and check what you need to improve</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="featured-box featured-box-secundary">
                        <div class="box-content">
                            <i class="icon-featured fa fa-video-camera"></i>
                            <a href="/portal/"><h4><em>Online <strong>Live</strong> tutoring sessions</h4></a>
                            <div class="feature-box-info">
                                <p class="tall">Check the calendar for the next <strong>LIVE</strong> tutoring session</p>
                            </div>
                            <div class="feature-box-info">
                                <p class="tall">Have an interactive tutoring session with one of our Volunteer Tutors</p>
                            </div>
                            <div class="feature-box-info">
                                <p class="tall">Test your knowledge after the tutorial session</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="home-concept">
            <div class="container">

                <div class="row center">
                    <span class="sun"></span>
                    <span class="cloud"></span>
                    <div class="col-md-2 col-md-offset-1">
                        <div class="process-image">
                            <img src="assets/home-site/img/home-concept-item-1.png" alt="" />
                            <strong>Online Lectures</strong>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="process-image">
                            <img src="assets/home-site/img/home-concept-item-2.png" alt="" />
                            <strong>Tutors</strong>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="process-image">
                            <img src="assets/home-site/img/home-concept-item-3.png" alt="" />
                            <strong>Online Exercises</strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="project-image">
                            <div id="fcSlideshow" class="fc-slideshow">
                                <ul class="fc-slides">
                                    <li><a href="portfolio-single-project.html"><img class="img-responsive" src="assets/home-site/img/projects/project-home-1.jpg" /></a></li>
                                    <li><a href="portfolio-single-project.html"><img class="img-responsive" src="assets/home-site/img/projects/project-home-2.jpg" /></a></li>
                                    <li><a href="portfolio-single-project.html"><img class="img-responsive" src="assets/home-site/img/projects/project-home-3.jpg" /></a></li>
                                </ul>
                            </div>
                            <strong class="our-work">A brighter you</strong>
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
<script src="/assets/home-site/vendor/circle-flip-slideshow/js/jquery.flipshow.js"></script>
<script src="/assets/home-site/js/views/view.home.js"></script>


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
<script type="text/JavaScript" src="/assets/ajax/login/form-submit.js"></script>

<!-- Hashing JS -->
<script type="text/JavaScript" src="/assets/ajax/shared/sha512.js"></script>

</body>
</html>
