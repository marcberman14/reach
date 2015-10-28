<!doctype html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <title><?php echo $title; ?> | R.E.A.CH - Monash South Africa</title>
    <meta name="keywords" content="<?php echo $keywords; ?>" />
    <meta name="description" content="<?php echo $description; ?>">

    <?php $views = new View();
    echo $views->addMeta(Array("width=device-width, initial-scale=1.0"));
    echo $views->addStyle(Array("http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light",
        "/assets/home-site/vendor/bootstrap/bootstrap.css",
        "/assets/home-site/vendor/fontawesome/css/font-awesome.css",
        "/assets/home-site/css/theme.css",
        "/assets/home-site/css/theme-elements.css",
        "/assets/home-site/vendor/rs-plugin/css/settings.css",
        "/assets/home-site/vendor/circle-flip-slideshow/css/component.css",
        "/assets/home-site/css/skins/default.css"));

    echo $views->addScript(Array("/assets/home-site/vendor/modernizr/modernizr.js"));
    ?>
    <link rel="shortcut icon" href="/assets/img/favicon.ico">
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
                        if ($login['response'] == 'success'|| $login['response'] == 'warning'|| $login['response'] == 'noprofile'|| $login['response'] == 'deny' || $login['response'] == 'emailverify'){?>
                            <li class="dropdown mega-menu-item mega-menu-signin signin logged" id="headerAccount">
                                <a class="dropdown-toggle" href="/portal/profile/">
                                    <i class="fa fa-user"></i> <?php echo htmlentities($_SESSION['user']->getUserfirstname()) .' ' . htmlentities($_SESSION['user']->getUserlastname());?>
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
                                                                <img src="/bin/user-profile/<?php echo $_SESSION['user']->getPicUrl();?>" alt="<?php echo htmlentities($_SESSION['user']->getUserfirstname()) .' ' . htmlentities($_SESSION['user']->getUserlastname());?>" class="img-circle" data-lock-picture="/bin/user-profile/<?php echo $_SESSION['user']->getPicUrl();?>" />
                                                            </figure>
                                                        </div>
                                                        <p><strong><?php echo htmlentities($_SESSION['user']->getUserfirstname()) .' ' . htmlentities($_SESSION['user']->getUserlastname());?></strong><span><?php echo htmlentities($_SESSION['user']->getPermissionName()); ?></span></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <ul class="list-account-options">
                                                        <li>
                                                            <a href="/portal/">My R.E.A.CH</a>
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
                                <a class="dropdown-toggle" href="#">Login/Register <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li> <a href="/user/login/">Login</a></li>
                                    <li><a href="/user/register/">Register</a></li>
                                </ul>
                            </li>
                        <?php } ?>


                    </ul>
                </nav>
            </div>
        </div>
    </header>