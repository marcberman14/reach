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
    <meta name="description" content="Home | R.E.A.CH - Monash South Africa">
    <meta name="author" content="Monash South Africa">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light"
          rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/assets/home-site/vendor/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap-datepicker/css/datepicker3.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css">

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

    <!-- Skin Colour CSS  -->
    <link rel="stylesheet" href="/assets/home-site/css/skins/default.css">

    <!-- Used for cross browser compatibility -->
    <script src="/assets/home-site/vendor/modernizr/modernizr.js"></script>


    <!-- JS -->
    <!-- Vendor -->
    <script src="/assets/home-site/vendor/jquery/jquery.js"></script>

    <script src="/assets/home-site/vendor/bootstrap/bootstrap.js"></script>
    <script src="/assets/home-site/vendor/common/common.js"></script>
    <script src="/assets/home-site/vendor/jquery.validation/jquery.validation.js"></script>
    <script src="/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>

    <!-- Theme Base, Components and Settings -->
    <script src="/assets/home-site/js/theme.js"></script>

    <!-- Theme Initialization Files -->
    <script src="/assets/home-site/js/theme.init.js"></script>
</head>
<body>

<div class="body">
    <header id="header" data-plugin-options='{"alwaysStickyEnabled": true}'>
        <div class="container">
            <div class="logo">
                <a href="index.html">
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
                        <a href="about-us.html">R.E.A.CH. Portal</a>
                    </li>
                    <li>
                        <a href="contact-us.html">Events</a>
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
                                <li><a href="/about-us/index.html">Who we are</a></li>
                                <li><a href="/about-us/courses.html">Courses Offered</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="/contact-us/">Contact Us</a>
                        </li>

                        <?php
                        $login = login_check($mysqli);
                        if ($login['response'] == 'success' || $login['response'] == 'warning' || $login['response'] == 'deny'){?>
                            <li class="dropdown mega-menu-item mega-menu-signin signin logged" id="headerAccount">
                                <a class="dropdown-toggle" href="/portal/profile/index.php">
                                    <i class="fa fa-user"></i> <?php echo htmlentities($_SESSION['username']) . ' ' . htmlentities($_SESSION['userlast']); ?>
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
                                                                <img
                                                                    src="/bin/user-profile/<?php echo getProfilePic($mysqli)['url'];?>"
                                                                    alt="<?php echo htmlentities($_SESSION['username']) . ' ' . htmlentities($_SESSION['userlast']);?>"
                                                                    class="img-circle"
                                                                    data-lock-picture="/bin/user-profile/<?php echo getProfilePic($mysqli)['url'];?>"/>
                                                            </figure>
                                                        </div>
                                                        <p>
                                                            <strong><?php echo htmlentities($_SESSION['username']) . ' ' . htmlentities($_SESSION['userlast']); ?></strong><span><?php echo htmlentities($_SESSION['usertype']); ?></span>
                                                        </p>
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
                                    <li><a href="/user/login/">Login</a></li>
                                    <li><a href="/user/register">Register</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div role="main" class="main push-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row featured-boxes login">
                        <div class="col-sm-12">
                            <div class="featured-box featured-box-secundary default info-content">
                                <div class="box-content">
                                    <?php
                                    $login = login_check($mysqli);
                                    if ($login['response'] == 'error') { ?>
                                        <div class="alert alert-danger" id="contactWarning">You are not authorised to
                                            access this page. You will be redirected to the login page shortly.
                                        </div>
                                        <script>
                                            window.setTimeout(function () {
                                                window.location.href = "/user/login/";
                                            }, 3000);
                                        </script>


                                        <?php
                                    } else if ($login['response'] == 'warning') {
                                    $usertype = getUserType($mysqli);
                                    if ($usertype['usertype'] == 'Student') { ?>

                                        <div class="alert alert-success hidden" id="contactSuccess">Success! Your
                                            profile has been updated. You will be redirected to you portal shortly.
                                        </div>
                                        <div class="alert alert-danger hidden" id="contactError">Error!</div>

                                        <form action="/assets/includes/process_studentprofile.php" method="post"
                                              name="studentprofile" id="studentprofile">

                                            <!-- begin: Personal -->
                                            <div class="panel panel-primary" id="school_panel" name="school_panel">
                                                <div class="panel-heading ">Personal Details</div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Gender</label>

                                                                <div class="radio-group">
                                                                    <label class="radio-inline">
                                                                        <input type="radio" value="Male" id="stugender"
                                                                               name="stugender">
                                                                        Male</label>
                                                                    <label class="radio-inline">
                                                                        <input type="radio" value="Female"
                                                                               id="stugender" name="stugender">
                                                                        Female</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Date of Birth:</label>

                                                                <div id="studateofbirth">
                                                                    <div class="input-group date">
                                                                        <input type="text" class="form-control"
                                                                               id="studateofbirth" name="studateofbirth"
                                                                               placeholder="Select your date of birth">
                                                                        <span class="input-group-addon"><i
                                                                                class="glyphicon glyphicon-th"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end: Personal -->

                                            <!-- begin: Address -->
                                            <div class="panel panel-primary" id="school_panel" name="school_panel">
                                                <div class="panel-heading ">Home Address</div>
                                                <div class="panel-body">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Street Number:</label>
                                                                <input type="text" value="" class="form-control "
                                                                       name="stustreetno" id="stustreetno"
                                                                       placeholder="Please enter your street number">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Street Name:</label>
                                                                <input type="text" value="" class="form-control "
                                                                       name="stustreetname" id="stustreetname"
                                                                       placeholder="Please enter your street name">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Suburb:</label>
                                                                <input type="text" value="" class="form-control "
                                                                       name="stusuburb" id="stusuburb"
                                                                       placeholder="Please enter your home address">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>City:</label>
                                                                <input type="text" value="" class="form-control "
                                                                       name="stucity" id="stucity"
                                                                       placeholder="Please enter your home address">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Postal Code:</label>
                                                                <input type="text" value="" class="form-control "
                                                                       name="stupostcode" id="stupostcode"
                                                                       placeholder="Please enter your home address">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div class="multiselect-group" style="width: 100%">
                                                                    <label>Country:</label>
                                                                    <br>
                                                                    <select class="form-control" data-plugin-multiselect
                                                                            data-plugin-options='{ "enableCaseInsensitiveFiltering": true }'
                                                                            name="stucountry" id="stucountry">
                                                                        <option value="">Select a country</option>
                                                                        <option value="South Africa">South Africa
                                                                        </option>
                                                                        <option value="Afghanistan">Afghanistan</option>
                                                                        <option value="Aland Islands">Aland Islands
                                                                        </option>
                                                                        <option value="Albania">Albania</option>
                                                                        <option value="Algeria">Algeria</option>
                                                                        <option value="American Samoa">American Samoa
                                                                        </option>
                                                                        <option value="Andorra">Andorra</option>
                                                                        <option value="Angola">Angola</option>
                                                                        <option value="Anguilla">Anguilla</option>
                                                                        <option value="Antarctica">Antarctica</option>
                                                                        <option value="Antigua and Barbuda">Antigua and
                                                                            Barbuda
                                                                        </option>
                                                                        <option value="Argentina">Argentina</option>
                                                                        <option value="Armenia">Armenia</option>
                                                                        <option value="Aruba">Aruba</option>
                                                                        <option value="Australia">Australia</option>
                                                                        <option value="Austria">Austria</option>
                                                                        <option value="Azerbaijan">Azerbaijan</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                        <option value="Bahrain">Bahrain</option>
                                                                        <option value="Bangladesh">Bangladesh</option>
                                                                        <option value="Barbados">Barbados</option>
                                                                        <option value="Belarus">Belarus</option>
                                                                        <option value="Belgium">Belgium</option>
                                                                        <option value="Belize">Belize</option>
                                                                        <option value="Benin">Benin</option>
                                                                        <option value="Bermuda">Bermuda</option>
                                                                        <option value="Bhutan">Bhutan</option>
                                                                        <option value="Bolivia">Bolivia</option>
                                                                        <option value="Bosnia and Herzegovina">Bosnia
                                                                            and Herzegovina
                                                                        </option>
                                                                        <option value="Botswana">Botswana</option>
                                                                        <option value="Bouvet Island">Bouvet Island
                                                                        </option>
                                                                        <option value="Brazil">Brazil</option>
                                                                        <option value="British Indian Ocean Territory">
                                                                            British Indian Ocean Territory
                                                                        </option>
                                                                        <option value="Brunei Darussalam">Brunei
                                                                            Darussalam
                                                                        </option>
                                                                        <option value="Bulgaria">Bulgaria</option>
                                                                        <option value="Burkina Faso">Burkina Faso
                                                                        </option>
                                                                        <option value="Burundi">Burundi</option>
                                                                        <option value="Cambodia">Cambodia</option>
                                                                        <option value="Cameroon">Cameroon</option>
                                                                        <option value="Canada">Canada</option>
                                                                        <option value="Cape Verde">Cape Verde</option>
                                                                        <option value="Cayman Islands">Cayman Islands
                                                                        </option>
                                                                        <option value="Central African Republic">Central
                                                                            African Republic
                                                                        </option>
                                                                        <option value="Chad">Chad</option>
                                                                        <option value="Chile">Chile</option>
                                                                        <option value="China">China</option>
                                                                        <option value="Christmas Island">Christmas
                                                                            Island
                                                                        </option>
                                                                        <option value="Cocos (Keeling) Islands">Cocos
                                                                            (Keeling) Islands
                                                                        </option>
                                                                        <option value="Colombia">Colombia</option>
                                                                        <option value="Comoros">Comoros</option>
                                                                        <option value="Congo">Congo</option>
                                                                        <option
                                                                            value="Congo, The Democratic Republic of The">
                                                                            Congo, The Democratic Republic of The
                                                                        </option>
                                                                        <option value="Cook Islands">Cook Islands
                                                                        </option>
                                                                        <option value="Costa Rica">Costa Rica</option>
                                                                        <option value="Cote D'ivoire">Cote D'ivoire
                                                                        </option>
                                                                        <option value="Croatia">Croatia</option>
                                                                        <option value="Cuba">Cuba</option>
                                                                        <option value="Cyprus">Cyprus</option>
                                                                        <option value="Czech Republic">Czech Republic
                                                                        </option>
                                                                        <option value="Denmark">Denmark</option>
                                                                        <option value="Djibouti">Djibouti</option>
                                                                        <option value="Dominica">Dominica</option>
                                                                        <option value="Dominican Republic">Dominican
                                                                            Republic
                                                                        </option>
                                                                        <option value="Ecuador">Ecuador</option>
                                                                        <option value="Egypt">Egypt</option>
                                                                        <option value="El Salvador">El Salvador</option>
                                                                        <option value="Equatorial Guinea">Equatorial
                                                                            Guinea
                                                                        </option>
                                                                        <option value="Eritrea">Eritrea</option>
                                                                        <option value="Estonia">Estonia</option>
                                                                        <option value="Ethiopia">Ethiopia</option>
                                                                        <option value="Falkland Islands (Malvinas)">
                                                                            Falkland Islands (Malvinas)
                                                                        </option>
                                                                        <option value="Faroe Islands">Faroe Islands
                                                                        </option>
                                                                        <option value="Fiji">Fiji</option>
                                                                        <option value="Finland">Finland</option>
                                                                        <option value="France">France</option>
                                                                        <option value="French Guiana">French Guiana
                                                                        </option>
                                                                        <option value="French Polynesia">French
                                                                            Polynesia
                                                                        </option>
                                                                        <option value="French Southern Territories">
                                                                            French Southern Territories
                                                                        </option>
                                                                        <option value="Gabon">Gabon</option>
                                                                        <option value="Gambia">Gambia</option>
                                                                        <option value="Georgia">Georgia</option>
                                                                        <option value="Germany">Germany</option>
                                                                        <option value="Ghana">Ghana</option>
                                                                        <option value="Gibraltar">Gibraltar</option>
                                                                        <option value="Greece">Greece</option>
                                                                        <option value="Greenland">Greenland</option>
                                                                        <option value="Grenada">Grenada</option>
                                                                        <option value="Guadeloupe">Guadeloupe</option>
                                                                        <option value="Guam">Guam</option>
                                                                        <option value="Guatemala">Guatemala</option>
                                                                        <option value="Guernsey">Guernsey</option>
                                                                        <option value="Guinea">Guinea</option>
                                                                        <option value="Guinea-bissau">Guinea-bissau
                                                                        </option>
                                                                        <option value="Guyana">Guyana</option>
                                                                        <option value="Haiti">Haiti</option>
                                                                        <option
                                                                            value="Heard Island and Mcdonald Islands">
                                                                            Heard Island and Mcdonald Islands
                                                                        </option>
                                                                        <option value="Holy See (Vatican City State)">
                                                                            Holy See (Vatican City State)
                                                                        </option>
                                                                        <option value="Honduras">Honduras</option>
                                                                        <option value="Hong Kong">Hong Kong</option>
                                                                        <option value="Hungary">Hungary</option>
                                                                        <option value="Iceland">Iceland</option>
                                                                        <option value="India">India</option>
                                                                        <option value="Indonesia">Indonesia</option>
                                                                        <option value="Iran, Islamic Republic of">Iran,
                                                                            Islamic Republic of
                                                                        </option>
                                                                        <option value="Iraq">Iraq</option>
                                                                        <option value="Ireland">Ireland</option>
                                                                        <option value="Isle of Man">Isle of Man</option>
                                                                        <option value="Israel">Israel</option>
                                                                        <option value="Italy">Italy</option>
                                                                        <option value="Jamaica">Jamaica</option>
                                                                        <option value="Japan">Japan</option>
                                                                        <option value="Jersey">Jersey</option>
                                                                        <option value="Jordan">Jordan</option>
                                                                        <option value="Kazakhstan">Kazakhstan</option>
                                                                        <option value="Kenya">Kenya</option>
                                                                        <option value="Kiribati">Kiribati</option>
                                                                        <option
                                                                            value="Korea, Democratic People's Republic of">
                                                                            Korea, Democratic People's Republic of
                                                                        </option>
                                                                        <option value="Korea, Republic of">Korea,
                                                                            Republic of
                                                                        </option>
                                                                        <option value="Kuwait">Kuwait</option>
                                                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                                        <option
                                                                            value="Lao People's Democratic Republic">Lao
                                                                            People's Democratic Republic
                                                                        </option>
                                                                        <option value="Latvia">Latvia</option>
                                                                        <option value="Lebanon">Lebanon</option>
                                                                        <option value="Lesotho">Lesotho</option>
                                                                        <option value="Liberia">Liberia</option>
                                                                        <option value="Libyan Arab Jamahiriya">Libyan
                                                                            Arab Jamahiriya
                                                                        </option>
                                                                        <option value="Liechtenstein">Liechtenstein
                                                                        </option>
                                                                        <option value="Lithuania">Lithuania</option>
                                                                        <option value="Luxembourg">Luxembourg</option>
                                                                        <option value="Macao">Macao</option>
                                                                        <option
                                                                            value="Macedonia, The Former Yugoslav Republic of">
                                                                            Macedonia, The Former Yugoslav Republic of
                                                                        </option>
                                                                        <option value="Madagascar">Madagascar</option>
                                                                        <option value="Malawi">Malawi</option>
                                                                        <option value="Malaysia">Malaysia</option>
                                                                        <option value="Maldives">Maldives</option>
                                                                        <option value="Mali">Mali</option>
                                                                        <option value="Malta">Malta</option>
                                                                        <option value="Marshall Islands">Marshall
                                                                            Islands
                                                                        </option>
                                                                        <option value="Martinique">Martinique</option>
                                                                        <option value="Mauritania">Mauritania</option>
                                                                        <option value="Mauritius">Mauritius</option>
                                                                        <option value="Mayotte">Mayotte</option>
                                                                        <option value="Mexico">Mexico</option>
                                                                        <option value="Micronesia, Federated States of">
                                                                            Micronesia, Federated States of
                                                                        </option>
                                                                        <option value="Moldova, Republic of">Moldova,
                                                                            Republic of
                                                                        </option>
                                                                        <option value="Monaco">Monaco</option>
                                                                        <option value="Mongolia">Mongolia</option>
                                                                        <option value="Montenegro">Montenegro</option>
                                                                        <option value="Montserrat">Montserrat</option>
                                                                        <option value="Morocco">Morocco</option>
                                                                        <option value="Mozambique">Mozambique</option>
                                                                        <option value="Myanmar">Myanmar</option>
                                                                        <option value="Namibia">Namibia</option>
                                                                        <option value="Nauru">Nauru</option>
                                                                        <option value="Nepal">Nepal</option>
                                                                        <option value="Netherlands">Netherlands</option>
                                                                        <option value="Netherlands Antilles">Netherlands
                                                                            Antilles
                                                                        </option>
                                                                        <option value="New Caledonia">New Caledonia
                                                                        </option>
                                                                        <option value="New Zealand">New Zealand</option>
                                                                        <option value="Nicaragua">Nicaragua</option>
                                                                        <option value="Niger">Niger</option>
                                                                        <option value="Nigeria">Nigeria</option>
                                                                        <option value="Niue">Niue</option>
                                                                        <option value="Norfolk Island">Norfolk Island
                                                                        </option>
                                                                        <option value="Northern Mariana Islands">
                                                                            Northern Mariana Islands
                                                                        </option>
                                                                        <option value="Norway">Norway</option>
                                                                        <option value="Oman">Oman</option>
                                                                        <option value="Pakistan">Pakistan</option>
                                                                        <option value="Palau">Palau</option>
                                                                        <option value="Palestinian Territory, Occupied">
                                                                            Palestinian Territory, Occupied
                                                                        </option>
                                                                        <option value="Panama">Panama</option>
                                                                        <option value="Papua New Guinea">Papua New
                                                                            Guinea
                                                                        </option>
                                                                        <option value="Paraguay">Paraguay</option>
                                                                        <option value="Peru">Peru</option>
                                                                        <option value="Philippines">Philippines</option>
                                                                        <option value="Pitcairn">Pitcairn</option>
                                                                        <option value="Poland">Poland</option>
                                                                        <option value="Portugal">Portugal</option>
                                                                        <option value="Puerto Rico">Puerto Rico</option>
                                                                        <option value="Qatar">Qatar</option>
                                                                        <option value="Reunion">Reunion</option>
                                                                        <option value="Romania">Romania</option>
                                                                        <option value="Russian Federation">Russian
                                                                            Federation
                                                                        </option>
                                                                        <option value="Rwanda">Rwanda</option>
                                                                        <option value="Saint Helena">Saint Helena
                                                                        </option>
                                                                        <option value="Saint Kitts and Nevis">Saint
                                                                            Kitts and Nevis
                                                                        </option>
                                                                        <option value="Saint Lucia">Saint Lucia</option>
                                                                        <option value="Saint Pierre and Miquelon">Saint
                                                                            Pierre and Miquelon
                                                                        </option>
                                                                        <option
                                                                            value="Saint Vincent and The Grenadines">
                                                                            Saint Vincent and The Grenadines
                                                                        </option>
                                                                        <option value="Samoa">Samoa</option>
                                                                        <option value="San Marino">San Marino</option>
                                                                        <option value="Sao Tome and Principe">Sao Tome
                                                                            and Principe
                                                                        </option>
                                                                        <option value="Saudi Arabia">Saudi Arabia
                                                                        </option>
                                                                        <option value="Senegal">Senegal</option>
                                                                        <option value="Serbia">Serbia</option>
                                                                        <option value="Seychelles">Seychelles</option>
                                                                        <option value="Sierra Leone">Sierra Leone
                                                                        </option>
                                                                        <option value="Singapore">Singapore</option>
                                                                        <option value="Slovakia">Slovakia</option>
                                                                        <option value="Slovenia">Slovenia</option>
                                                                        <option value="Solomon Islands">Solomon
                                                                            Islands
                                                                        </option>
                                                                        <option value="Somalia">Somalia</option>
                                                                        <option
                                                                            value="South Georgia and The South Sandwich Islands">
                                                                            South Georgia and The South Sandwich Islands
                                                                        </option>
                                                                        <option value="Spain">Spain</option>
                                                                        <option value="Sri Lanka">Sri Lanka</option>
                                                                        <option value="Sudan">Sudan</option>
                                                                        <option value="Suriname">Suriname</option>
                                                                        <option value="Svalbard and Jan Mayen">Svalbard
                                                                            and Jan Mayen
                                                                        </option>
                                                                        <option value="Swaziland">Swaziland</option>
                                                                        <option value="Sweden">Sweden</option>
                                                                        <option value="Switzerland">Switzerland</option>
                                                                        <option value="Syrian Arab Republic">Syrian Arab
                                                                            Republic
                                                                        </option>
                                                                        <option value="Taiwan, Province of China">
                                                                            Taiwan, Province of China
                                                                        </option>
                                                                        <option value="Tajikistan">Tajikistan</option>
                                                                        <option value="Tanzania, United Republic of">
                                                                            Tanzania, United Republic of
                                                                        </option>
                                                                        <option value="Thailand">Thailand</option>
                                                                        <option value="Timor-leste">Timor-leste</option>
                                                                        <option value="Togo">Togo</option>
                                                                        <option value="Tokelau">Tokelau</option>
                                                                        <option value="Tonga">Tonga</option>
                                                                        <option value="Trinidad and Tobago">Trinidad and
                                                                            Tobago
                                                                        </option>
                                                                        <option value="Tunisia">Tunisia</option>
                                                                        <option value="Turkey">Turkey</option>
                                                                        <option value="Turkmenistan">Turkmenistan
                                                                        </option>
                                                                        <option value="Turks and Caicos Islands">Turks
                                                                            and Caicos Islands
                                                                        </option>
                                                                        <option value="Tuvalu">Tuvalu</option>
                                                                        <option value="Uganda">Uganda</option>
                                                                        <option value="Ukraine">Ukraine</option>
                                                                        <option value="United Arab Emirates">United Arab
                                                                            Emirates
                                                                        </option>
                                                                        <option value="United Kingdom">United Kingdom
                                                                        </option>
                                                                        <option value="United States">United States
                                                                        </option>
                                                                        <option
                                                                            value="United States Minor Outlying Islands">
                                                                            United States Minor Outlying Islands
                                                                        </option>
                                                                        <option value="Uruguay">Uruguay</option>
                                                                        <option value="Uzbekistan">Uzbekistan</option>
                                                                        <option value="Vanuatu">Vanuatu</option>
                                                                        <option value="Venezuela">Venezuela</option>
                                                                        <option value="Viet Nam">Viet Nam</option>
                                                                        <option value="Virgin Islands, British">Virgin
                                                                            Islands, British
                                                                        </option>
                                                                        <option value="Virgin Islands, U.S.">Virgin
                                                                            Islands, U.S.
                                                                        </option>
                                                                        <option value="Wallis and Futuna">Wallis and
                                                                            Futuna
                                                                        </option>
                                                                        <option value="Western Sahara">Western Sahara
                                                                        </option>
                                                                        <option value="Yemen">Yemen</option>
                                                                        <option value="Zambia">Zambia</option>
                                                                        <option value="Zimbabwe">Zimbabwe</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end: Address -->

                                            <!-- begin: contact -->
                                            <div class="panel panel-primary" id="school_panel" name="school_panel">
                                                <div class="panel-heading ">Contact Details</div>
                                                <div class="panel-body">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Home Number:</label>
                                                                <input type="text" value="" class="form-control "
                                                                       name="stuhomeno" id="stuhomeno"
                                                                       placeholder="Please enter your home phone number">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Cell Phone Number:</label>
                                                                <input type="text" value="" class="form-control "
                                                                       name="stucellno" id="stucellno"
                                                                       placeholder="Please enter your cell-phone number">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Alternative Contact Number:</label>
                                                                <input type="text" value="" class="form-control "
                                                                       name="stualtno" id="stualtno"
                                                                       placeholder="Please enter an alternative phone number">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Parent Cell Phone Number:</label>
                                                                <input type="text" value="" class="form-control "
                                                                       name="stuparentno" id="stuparentno"
                                                                       placeholder="Please enter your cell-phone number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end: contact -->


                                            <!--end personal details-->
                                            <!--end personal details panel-->

                                            <div class="panel panel-primary" id="school_panel" name="school_panel">
                                                <div class="panel-heading ">School Details</div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label>Current School Name:</label>
                                                                <input type="text" value="" class="form-control "
                                                                       name='stuschoolname' id='stuschoolname'
                                                                       placeholder="Please enter your school name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label>Current Grade:</label>
                                                                <input type="text" value="" class="form-control "
                                                                       name="stugrade" id="stugrade"
                                                                       placeholder="Please enter your grade">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="subjects">School Subject list: (Please
                                                                    select 7)</label>
                                                                <br>
                                                                <select class="form-control" data-plugin-multiselect
                                                                        data-plugin-options='{ "enableCaseInsensitiveFiltering": true }'
                                                                        name="stusubjects[]" id="stusubjects"
                                                                        multiple="multiple">
                                                                    <option value="Math Literacy">Math Literacy</option>
                                                                    <option value="Math Core">Math Core</option>
                                                                    <option value="Life Orientation">Life Orientation
                                                                    </option>
                                                                    <option value="English">English</option>
                                                                    <option value="Biology">Biology</option>
                                                                    <option value="Afrikaans">Afrikaans</option>
                                                                    <option value="Physical Sciences">Physical
                                                                        Sciences
                                                                    </option>
                                                                    <option value="Computer Sciences">Computer
                                                                        Sciences
                                                                    </option>
                                                                    <option value="Agricultural Science">Agricultural
                                                                        Sciences
                                                                    </option>
                                                                    <option value="Business and Economics">Business and
                                                                        Economics
                                                                    </option>
                                                                    <option value="Accounting">Accounting</option>
                                                                    <option value="Visual Art">Visual Art</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- End school details -->
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel panel-primary" id="school_panel"
                                                         name="school_panel">
                                                        <div class="panel-body">
                                                            <input type="submit" id="submit" name="submit"
                                                                   value="Submit"
                                                                   class="btn btn-lg btn-primary push-bottom">

                                                            <p class="pull-right">Return to the <a
                                                                    class="btn btn-lg btn-primary " href="index.php">login
                                                                    page</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <!--AJAX Login View + validation-->
                                        <script type="text/JavaScript"
                                                src="/assets/ajax/profile/student-submit.js"></script>

                                        <!-- Hashing JS -->
                                        <script type="text/JavaScript" src="/assets/ajax/shared/sha512.js"></script>


                                        <script type="text/javascript">
                                            // When the document is ready
                                            $(document).ready(function () {

                                                $('#studateofbirth .input-group.date').datepicker({
                                                    format: "yyyy-mm-dd",
                                                    startView: 2,
                                                    calendarWeeks: true,
                                                    autoclose: true,
                                                    todayHighlight: true,
                                                    endDate: "today"
                                                });
                                            });
                                        </script>

                                        <script type="text/javascript">
                                            $('#stusubjects').multiselect({
                                                maxHeight: 300,
                                                enableCaseInsensitiveFiltering: true,
                                                numberDisplayed: 1,
                                                buttonClass: 'form-control',
                                                onChange: function (option, checked) {
                                                    // Get selected options.
                                                    var selectedOptions = $('#stusubjects option:selected');

                                                    if (selectedOptions.length >= 9) {
                                                        // Disable all other checkboxes.
                                                        var nonSelectedOptions = $('#stusubjects option').filter(function () {
                                                            return !$(this).is(':selected');
                                                        });

                                                        var dropdown = $('#stusubjects').siblings('.multiselect-container');
                                                        nonSelectedOptions.each(function () {
                                                            var input = $('input[value="' + $(this).val() + '"]');
                                                            input.prop('disabled', true);
                                                            input.parent('li').addClass('disabled');
                                                        });
                                                    }
                                                    else {
                                                        // Enable all checkboxes.
                                                        var dropdown = $('#stusubjects').siblings('.multiselect-container');
                                                        $('#stusubjects option').each(function () {
                                                            var input = $('input[value="' + $(this).val() + '"]');
                                                            input.prop('disabled', false);
                                                            input.parent('li').addClass('disabled');
                                                        });
                                                    }
                                                }
                                            });

                                        </script>

                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $('#stucountry').multiselect({
                                                    maxHeight: 300,
                                                    enableCaseInsensitiveFiltering: true,
                                                    numberDisplayed: 1
                                                });
                                            });
                                        </script>
                                    <?php }
                                    elseif ($usertype['usertype'] == 'Tutor') { ?>

                                    <div class="alert alert-success hidden" id="contactSuccess">Success! Your profile
                                        has been updated. You will be redirected to you portal shortly.
                                    </div>
                                    <div class="alert alert-danger hidden" id="contactError">Error!</div>

                                    <form action="/assets/includes/process_tutorprofile.php" method="post"
                                          name="tutorprofile" id="tutorprofile">

                                        <!-- begin: Personal -->
                                        <div class="panel panel-primary" id="school_panel" name="school_panel">
                                            <div class="panel-heading ">Personal Details</div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Gender</label>

                                                        <div class="radio-group">
                                                            <label class="radio-inline">
                                                                <input type="radio" value="Male" id="tutgender"
                                                                       name="tutgender">
                                                                Male</label>
                                                            <label class="radio-inline">
                                                                <input type="radio" value="Female" id="tutgender"
                                                                       name="tutgender">
                                                                Female</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label">Date of Birth:</label>

                                                        <div id="tutdob">
                                                            <div class="input-group date">
                                                                <input type="text" class="form-control" id="tutdob"
                                                                       name="tutdob"
                                                                       placeholder="Select your date of birth">
                                                                <span class="input-group-addon"><i
                                                                        class="glyphicon glyphicon-th"></i></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end: Personal -->

                                        <!-- begin: Address -->
                                        <div class="panel panel-primary" id="school_panel" name="school_panel">
                                            <div class="panel-heading ">Home Address</div>
                                            <div class="panel-body">

                                                <div class="row">

                                                    <div class="col-md-6 form-group">
                                                        <label>Street Number:</label>
                                                        <input type="text" value="" class="form-control "
                                                               name="tutstreetno" id="tutstreetno"
                                                               placeholder="Please enter your street number">
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label>Street Name:</label>
                                                        <input type="text" value="" class="form-control "
                                                               name="tutstreetname" id="tutstreetname"
                                                               placeholder="Please enter your street name">
                                                    </div>

                                                </div>
                                                <div class="row">

                                                    <div class="col-md-6 form-group">
                                                        <label>Suburb:</label>
                                                        <input type="text" value="" class="form-control "
                                                               name="tutsuburb" id="tutsuburb"
                                                               placeholder="Please enter your home address">
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label>City:</label>
                                                        <input type="text" value="" class="form-control " name="tutcity"
                                                               id="tutcity"
                                                               placeholder="Please enter your home address">
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label>Postal Code:</label>
                                                        <input type="text" value="" class="form-control "
                                                               name="tutpostcode" id="tutpostcode"
                                                               placeholder="Please enter your home address">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Country:</label>
                                                        <br>
                                                        <select class="form-control" data-plugin-multiselect
                                                                data-plugin-options='{ "enableCaseInsensitiveFiltering": true }'
                                                                name="tutcountry" id="tutcountry">
                                                            <option value="">Select a country</option>
                                                            <option value="South Africa">South Africa
                                                            </option>
                                                            <option value="Afghanistan">Afghanistan</option>
                                                            <option value="Aland Islands">Aland Islands
                                                            </option>
                                                            <option value="Albania">Albania</option>
                                                            <option value="Algeria">Algeria</option>
                                                            <option value="American Samoa">American Samoa
                                                            </option>
                                                            <option value="Andorra">Andorra</option>
                                                            <option value="Angola">Angola</option>
                                                            <option value="Anguilla">Anguilla</option>
                                                            <option value="Antarctica">Antarctica</option>
                                                            <option value="Antigua and Barbuda">Antigua and
                                                                Barbuda
                                                            </option>
                                                            <option value="Argentina">Argentina</option>
                                                            <option value="Armenia">Armenia</option>
                                                            <option value="Aruba">Aruba</option>
                                                            <option value="Australia">Australia</option>
                                                            <option value="Austria">Austria</option>
                                                            <option value="Azerbaijan">Azerbaijan</option>
                                                            <option value="Bahamas">Bahamas</option>
                                                            <option value="Bahrain">Bahrain</option>
                                                            <option value="Bangladesh">Bangladesh</option>
                                                            <option value="Barbados">Barbados</option>
                                                            <option value="Belarus">Belarus</option>
                                                            <option value="Belgium">Belgium</option>
                                                            <option value="Belize">Belize</option>
                                                            <option value="Benin">Benin</option>
                                                            <option value="Bermuda">Bermuda</option>
                                                            <option value="Bhutan">Bhutan</option>
                                                            <option value="Bolivia">Bolivia</option>
                                                            <option value="Bosnia and Herzegovina">Bosnia
                                                                and Herzegovina
                                                            </option>
                                                            <option value="Botswana">Botswana</option>
                                                            <option value="Bouvet Island">Bouvet Island
                                                            </option>
                                                            <option value="Brazil">Brazil</option>
                                                            <option value="British Indian Ocean Territory">
                                                                British Indian Ocean Territory
                                                            </option>
                                                            <option value="Brunei Darussalam">Brunei
                                                                Darussalam
                                                            </option>
                                                            <option value="Bulgaria">Bulgaria</option>
                                                            <option value="Burkina Faso">Burkina Faso
                                                            </option>
                                                            <option value="Burundi">Burundi</option>
                                                            <option value="Cambodia">Cambodia</option>
                                                            <option value="Cameroon">Cameroon</option>
                                                            <option value="Canada">Canada</option>
                                                            <option value="Cape Verde">Cape Verde</option>
                                                            <option value="Cayman Islands">Cayman Islands
                                                            </option>
                                                            <option value="Central African Republic">Central
                                                                African Republic
                                                            </option>
                                                            <option value="Chad">Chad</option>
                                                            <option value="Chile">Chile</option>
                                                            <option value="China">China</option>
                                                            <option value="Christmas Island">Christmas
                                                                Island
                                                            </option>
                                                            <option value="Cocos (Keeling) Islands">Cocos
                                                                (Keeling) Islands
                                                            </option>
                                                            <option value="Colombia">Colombia</option>
                                                            <option value="Comoros">Comoros</option>
                                                            <option value="Congo">Congo</option>
                                                            <option
                                                                value="Congo, The Democratic Republic of The">
                                                                Congo, The Democratic Republic of The
                                                            </option>
                                                            <option value="Cook Islands">Cook Islands
                                                            </option>
                                                            <option value="Costa Rica">Costa Rica</option>
                                                            <option value="Cote D'ivoire">Cote D'ivoire
                                                            </option>
                                                            <option value="Croatia">Croatia</option>
                                                            <option value="Cuba">Cuba</option>
                                                            <option value="Cyprus">Cyprus</option>
                                                            <option value="Czech Republic">Czech Republic
                                                            </option>
                                                            <option value="Denmark">Denmark</option>
                                                            <option value="Djibouti">Djibouti</option>
                                                            <option value="Dominica">Dominica</option>
                                                            <option value="Dominican Republic">Dominican
                                                                Republic
                                                            </option>
                                                            <option value="Ecuador">Ecuador</option>
                                                            <option value="Egypt">Egypt</option>
                                                            <option value="El Salvador">El Salvador</option>
                                                            <option value="Equatorial Guinea">Equatorial
                                                                Guinea
                                                            </option>
                                                            <option value="Eritrea">Eritrea</option>
                                                            <option value="Estonia">Estonia</option>
                                                            <option value="Ethiopia">Ethiopia</option>
                                                            <option value="Falkland Islands (Malvinas)">
                                                                Falkland Islands (Malvinas)
                                                            </option>
                                                            <option value="Faroe Islands">Faroe Islands
                                                            </option>
                                                            <option value="Fiji">Fiji</option>
                                                            <option value="Finland">Finland</option>
                                                            <option value="France">France</option>
                                                            <option value="French Guiana">French Guiana
                                                            </option>
                                                            <option value="French Polynesia">French
                                                                Polynesia
                                                            </option>
                                                            <option value="French Southern Territories">
                                                                French Southern Territories
                                                            </option>
                                                            <option value="Gabon">Gabon</option>
                                                            <option value="Gambia">Gambia</option>
                                                            <option value="Georgia">Georgia</option>
                                                            <option value="Germany">Germany</option>
                                                            <option value="Ghana">Ghana</option>
                                                            <option value="Gibraltar">Gibraltar</option>
                                                            <option value="Greece">Greece</option>
                                                            <option value="Greenland">Greenland</option>
                                                            <option value="Grenada">Grenada</option>
                                                            <option value="Guadeloupe">Guadeloupe</option>
                                                            <option value="Guam">Guam</option>
                                                            <option value="Guatemala">Guatemala</option>
                                                            <option value="Guernsey">Guernsey</option>
                                                            <option value="Guinea">Guinea</option>
                                                            <option value="Guinea-bissau">Guinea-bissau
                                                            </option>
                                                            <option value="Guyana">Guyana</option>
                                                            <option value="Haiti">Haiti</option>
                                                            <option
                                                                value="Heard Island and Mcdonald Islands">
                                                                Heard Island and Mcdonald Islands
                                                            </option>
                                                            <option value="Holy See (Vatican City State)">
                                                                Holy See (Vatican City State)
                                                            </option>
                                                            <option value="Honduras">Honduras</option>
                                                            <option value="Hong Kong">Hong Kong</option>
                                                            <option value="Hungary">Hungary</option>
                                                            <option value="Iceland">Iceland</option>
                                                            <option value="India">India</option>
                                                            <option value="Indonesia">Indonesia</option>
                                                            <option value="Iran, Islamic Republic of">Iran,
                                                                Islamic Republic of
                                                            </option>
                                                            <option value="Iraq">Iraq</option>
                                                            <option value="Ireland">Ireland</option>
                                                            <option value="Isle of Man">Isle of Man</option>
                                                            <option value="Israel">Israel</option>
                                                            <option value="Italy">Italy</option>
                                                            <option value="Jamaica">Jamaica</option>
                                                            <option value="Japan">Japan</option>
                                                            <option value="Jersey">Jersey</option>
                                                            <option value="Jordan">Jordan</option>
                                                            <option value="Kazakhstan">Kazakhstan</option>
                                                            <option value="Kenya">Kenya</option>
                                                            <option value="Kiribati">Kiribati</option>
                                                            <option
                                                                value="Korea, Democratic People's Republic of">
                                                                Korea, Democratic People's Republic of
                                                            </option>
                                                            <option value="Korea, Republic of">Korea,
                                                                Republic of
                                                            </option>
                                                            <option value="Kuwait">Kuwait</option>
                                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                            <option
                                                                value="Lao People's Democratic Republic">Lao
                                                                People's Democratic Republic
                                                            </option>
                                                            <option value="Latvia">Latvia</option>
                                                            <option value="Lebanon">Lebanon</option>
                                                            <option value="Lesotho">Lesotho</option>
                                                            <option value="Liberia">Liberia</option>
                                                            <option value="Libyan Arab Jamahiriya">Libyan
                                                                Arab Jamahiriya
                                                            </option>
                                                            <option value="Liechtenstein">Liechtenstein
                                                            </option>
                                                            <option value="Lithuania">Lithuania</option>
                                                            <option value="Luxembourg">Luxembourg</option>
                                                            <option value="Macao">Macao</option>
                                                            <option
                                                                value="Macedonia, The Former Yugoslav Republic of">
                                                                Macedonia, The Former Yugoslav Republic of
                                                            </option>
                                                            <option value="Madagascar">Madagascar</option>
                                                            <option value="Malawi">Malawi</option>
                                                            <option value="Malaysia">Malaysia</option>
                                                            <option value="Maldives">Maldives</option>
                                                            <option value="Mali">Mali</option>
                                                            <option value="Malta">Malta</option>
                                                            <option value="Marshall Islands">Marshall
                                                                Islands
                                                            </option>
                                                            <option value="Martinique">Martinique</option>
                                                            <option value="Mauritania">Mauritania</option>
                                                            <option value="Mauritius">Mauritius</option>
                                                            <option value="Mayotte">Mayotte</option>
                                                            <option value="Mexico">Mexico</option>
                                                            <option value="Micronesia, Federated States of">
                                                                Micronesia, Federated States of
                                                            </option>
                                                            <option value="Moldova, Republic of">Moldova,
                                                                Republic of
                                                            </option>
                                                            <option value="Monaco">Monaco</option>
                                                            <option value="Mongolia">Mongolia</option>
                                                            <option value="Montenegro">Montenegro</option>
                                                            <option value="Montserrat">Montserrat</option>
                                                            <option value="Morocco">Morocco</option>
                                                            <option value="Mozambique">Mozambique</option>
                                                            <option value="Myanmar">Myanmar</option>
                                                            <option value="Namibia">Namibia</option>
                                                            <option value="Nauru">Nauru</option>
                                                            <option value="Nepal">Nepal</option>
                                                            <option value="Netherlands">Netherlands</option>
                                                            <option value="Netherlands Antilles">Netherlands
                                                                Antilles
                                                            </option>
                                                            <option value="New Caledonia">New Caledonia
                                                            </option>
                                                            <option value="New Zealand">New Zealand</option>
                                                            <option value="Nicaragua">Nicaragua</option>
                                                            <option value="Niger">Niger</option>
                                                            <option value="Nigeria">Nigeria</option>
                                                            <option value="Niue">Niue</option>
                                                            <option value="Norfolk Island">Norfolk Island
                                                            </option>
                                                            <option value="Northern Mariana Islands">
                                                                Northern Mariana Islands
                                                            </option>
                                                            <option value="Norway">Norway</option>
                                                            <option value="Oman">Oman</option>
                                                            <option value="Pakistan">Pakistan</option>
                                                            <option value="Palau">Palau</option>
                                                            <option value="Palestinian Territory, Occupied">
                                                                Palestinian Territory, Occupied
                                                            </option>
                                                            <option value="Panama">Panama</option>
                                                            <option value="Papua New Guinea">Papua New
                                                                Guinea
                                                            </option>
                                                            <option value="Paraguay">Paraguay</option>
                                                            <option value="Peru">Peru</option>
                                                            <option value="Philippines">Philippines</option>
                                                            <option value="Pitcairn">Pitcairn</option>
                                                            <option value="Poland">Poland</option>
                                                            <option value="Portugal">Portugal</option>
                                                            <option value="Puerto Rico">Puerto Rico</option>
                                                            <option value="Qatar">Qatar</option>
                                                            <option value="Reunion">Reunion</option>
                                                            <option value="Romania">Romania</option>
                                                            <option value="Russian Federation">Russian
                                                                Federation
                                                            </option>
                                                            <option value="Rwanda">Rwanda</option>
                                                            <option value="Saint Helena">Saint Helena
                                                            </option>
                                                            <option value="Saint Kitts and Nevis">Saint
                                                                Kitts and Nevis
                                                            </option>
                                                            <option value="Saint Lucia">Saint Lucia</option>
                                                            <option value="Saint Pierre and Miquelon">Saint
                                                                Pierre and Miquelon
                                                            </option>
                                                            <option
                                                                value="Saint Vincent and The Grenadines">
                                                                Saint Vincent and The Grenadines
                                                            </option>
                                                            <option value="Samoa">Samoa</option>
                                                            <option value="San Marino">San Marino</option>
                                                            <option value="Sao Tome and Principe">Sao Tome
                                                                and Principe
                                                            </option>
                                                            <option value="Saudi Arabia">Saudi Arabia
                                                            </option>
                                                            <option value="Senegal">Senegal</option>
                                                            <option value="Serbia">Serbia</option>
                                                            <option value="Seychelles">Seychelles</option>
                                                            <option value="Sierra Leone">Sierra Leone
                                                            </option>
                                                            <option value="Singapore">Singapore</option>
                                                            <option value="Slovakia">Slovakia</option>
                                                            <option value="Slovenia">Slovenia</option>
                                                            <option value="Solomon Islands">Solomon
                                                                Islands
                                                            </option>
                                                            <option value="Somalia">Somalia</option>
                                                            <option
                                                                value="South Georgia and The South Sandwich Islands">
                                                                South Georgia and The South Sandwich Islands
                                                            </option>
                                                            <option value="Spain">Spain</option>
                                                            <option value="Sri Lanka">Sri Lanka</option>
                                                            <option value="Sudan">Sudan</option>
                                                            <option value="Suriname">Suriname</option>
                                                            <option value="Svalbard and Jan Mayen">Svalbard
                                                                and Jan Mayen
                                                            </option>
                                                            <option value="Swaziland">Swaziland</option>
                                                            <option value="Sweden">Sweden</option>
                                                            <option value="Switzerland">Switzerland</option>
                                                            <option value="Syrian Arab Republic">Syrian Arab
                                                                Republic
                                                            </option>
                                                            <option value="Taiwan, Province of China">
                                                                Taiwan, Province of China
                                                            </option>
                                                            <option value="Tajikistan">Tajikistan</option>
                                                            <option value="Tanzania, United Republic of">
                                                                Tanzania, United Republic of
                                                            </option>
                                                            <option value="Thailand">Thailand</option>
                                                            <option value="Timor-leste">Timor-leste</option>
                                                            <option value="Togo">Togo</option>
                                                            <option value="Tokelau">Tokelau</option>
                                                            <option value="Tonga">Tonga</option>
                                                            <option value="Trinidad and Tobago">Trinidad and
                                                                Tobago
                                                            </option>
                                                            <option value="Tunisia">Tunisia</option>
                                                            <option value="Turkey">Turkey</option>
                                                            <option value="Turkmenistan">Turkmenistan
                                                            </option>
                                                            <option value="Turks and Caicos Islands">Turks
                                                                and Caicos Islands
                                                            </option>
                                                            <option value="Tuvalu">Tuvalu</option>
                                                            <option value="Uganda">Uganda</option>
                                                            <option value="Ukraine">Ukraine</option>
                                                            <option value="United Arab Emirates">United Arab
                                                                Emirates
                                                            </option>
                                                            <option value="United Kingdom">United Kingdom
                                                            </option>
                                                            <option value="United States">United States
                                                            </option>
                                                            <option
                                                                value="United States Minor Outlying Islands">
                                                                United States Minor Outlying Islands
                                                            </option>
                                                            <option value="Uruguay">Uruguay</option>
                                                            <option value="Uzbekistan">Uzbekistan</option>
                                                            <option value="Vanuatu">Vanuatu</option>
                                                            <option value="Venezuela">Venezuela</option>
                                                            <option value="Viet Nam">Viet Nam</option>
                                                            <option value="Virgin Islands, British">Virgin
                                                                Islands, British
                                                            </option>
                                                            <option value="Virgin Islands, U.S.">Virgin
                                                                Islands, U.S.
                                                            </option>
                                                            <option value="Wallis and Futuna">Wallis and
                                                                Futuna
                                                            </option>
                                                            <option value="Western Sahara">Western Sahara
                                                            </option>
                                                            <option value="Yemen">Yemen</option>
                                                            <option value="Zambia">Zambia</option>
                                                            <option value="Zimbabwe">Zimbabwe</option>
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label>Country of Residency:</label>
                                                        <br>
                                                        <select class="form-control" data-plugin-multiselect
                                                                data-plugin-options='{ "enableCaseInsensitiveFiltering": true }'
                                                                name="tutresidence" id="tutresidence">
                                                            <option value="">Select a country of residence</option>
                                                            <option value="South Africa">South Africa</option>
                                                            <option value="Afghanistan">Afghanistan</option>
                                                            <option value="Aland Islands">Aland Islands</option>
                                                            <option value="Albania">Albania</option>
                                                            <option value="Algeria">Algeria</option>
                                                            <option value="American Samoa">American Samoa</option>
                                                            <option value="Andorra">Andorra</option>
                                                            <option value="Angola">Angola</option>
                                                            <option value="Anguilla">Anguilla</option>
                                                            <option value="Antarctica">Antarctica</option>
                                                            <option value="Antigua and Barbuda">Antigua and Barbuda
                                                            </option>
                                                            <option value="Argentina">Argentina</option>
                                                            <option value="Armenia">Armenia</option>
                                                            <option value="Aruba">Aruba</option>
                                                            <option value="Australia">Australia</option>
                                                            <option value="Austria">Austria</option>
                                                            <option value="Azerbaijan">Azerbaijan</option>
                                                            <option value="Bahamas">Bahamas</option>
                                                            <option value="Bahrain">Bahrain</option>
                                                            <option value="Bangladesh">Bangladesh</option>
                                                            <option value="Barbados">Barbados</option>
                                                            <option value="Belarus">Belarus</option>
                                                            <option value="Belgium">Belgium</option>
                                                            <option value="Belize">Belize</option>
                                                            <option value="Benin">Benin</option>
                                                            <option value="Bermuda">Bermuda</option>
                                                            <option value="Bhutan">Bhutan</option>
                                                            <option value="Bolivia">Bolivia</option>
                                                            <option value="Bosnia and Herzegovina">Bosnia and
                                                                Herzegovina
                                                            </option>
                                                            <option value="Botswana">Botswana</option>
                                                            <option value="Bouvet Island">Bouvet Island</option>
                                                            <option value="Brazil">Brazil</option>
                                                            <option value="British Indian Ocean Territory">British
                                                                Indian Ocean Territory
                                                            </option>
                                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                            <option value="Bulgaria">Bulgaria</option>
                                                            <option value="Burkina Faso">Burkina Faso</option>
                                                            <option value="Burundi">Burundi</option>
                                                            <option value="Cambodia">Cambodia</option>
                                                            <option value="Cameroon">Cameroon</option>
                                                            <option value="Canada">Canada</option>
                                                            <option value="Cape Verde">Cape Verde</option>
                                                            <option value="Cayman Islands">Cayman Islands</option>
                                                            <option value="Central African Republic">Central African
                                                                Republic
                                                            </option>
                                                            <option value="Chad">Chad</option>
                                                            <option value="Chile">Chile</option>
                                                            <option value="China">China</option>
                                                            <option value="Christmas Island">Christmas Island</option>
                                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling)
                                                                Islands
                                                            </option>
                                                            <option value="Colombia">Colombia</option>
                                                            <option value="Comoros">Comoros</option>
                                                            <option value="Congo">Congo</option>
                                                            <option value="Congo, The Democratic Republic of The">Congo,
                                                                The Democratic Republic of The
                                                            </option>
                                                            <option value="Cook Islands">Cook Islands</option>
                                                            <option value="Costa Rica">Costa Rica</option>
                                                            <option value="Cote D'ivoire">Cote D'ivoire</option>
                                                            <option value="Croatia">Croatia</option>
                                                            <option value="Cuba">Cuba</option>
                                                            <option value="Cyprus">Cyprus</option>
                                                            <option value="Czech Republic">Czech Republic</option>
                                                            <option value="Denmark">Denmark</option>
                                                            <option value="Djibouti">Djibouti</option>
                                                            <option value="Dominica">Dominica</option>
                                                            <option value="Dominican Republic">Dominican Republic
                                                            </option>
                                                            <option value="Ecuador">Ecuador</option>
                                                            <option value="Egypt">Egypt</option>
                                                            <option value="El Salvador">El Salvador</option>
                                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                            <option value="Eritrea">Eritrea</option>
                                                            <option value="Estonia">Estonia</option>
                                                            <option value="Ethiopia">Ethiopia</option>
                                                            <option value="Falkland Islands (Malvinas)">Falkland Islands
                                                                (Malvinas)
                                                            </option>
                                                            <option value="Faroe Islands">Faroe Islands</option>
                                                            <option value="Fiji">Fiji</option>
                                                            <option value="Finland">Finland</option>
                                                            <option value="France">France</option>
                                                            <option value="French Guiana">French Guiana</option>
                                                            <option value="French Polynesia">French Polynesia</option>
                                                            <option value="French Southern Territories">French Southern
                                                                Territories
                                                            </option>
                                                            <option value="Gabon">Gabon</option>
                                                            <option value="Gambia">Gambia</option>
                                                            <option value="Georgia">Georgia</option>
                                                            <option value="Germany">Germany</option>
                                                            <option value="Ghana">Ghana</option>
                                                            <option value="Gibraltar">Gibraltar</option>
                                                            <option value="Greece">Greece</option>
                                                            <option value="Greenland">Greenland</option>
                                                            <option value="Grenada">Grenada</option>
                                                            <option value="Guadeloupe">Guadeloupe</option>
                                                            <option value="Guam">Guam</option>
                                                            <option value="Guatemala">Guatemala</option>
                                                            <option value="Guernsey">Guernsey</option>
                                                            <option value="Guinea">Guinea</option>
                                                            <option value="Guinea-bissau">Guinea-bissau</option>
                                                            <option value="Guyana">Guyana</option>
                                                            <option value="Haiti">Haiti</option>
                                                            <option value="Heard Island and Mcdonald Islands">Heard
                                                                Island and Mcdonald Islands
                                                            </option>
                                                            <option value="Holy See (Vatican City State)">Holy See
                                                                (Vatican City State)
                                                            </option>
                                                            <option value="Honduras">Honduras</option>
                                                            <option value="Hong Kong">Hong Kong</option>
                                                            <option value="Hungary">Hungary</option>
                                                            <option value="Iceland">Iceland</option>
                                                            <option value="India">India</option>
                                                            <option value="Indonesia">Indonesia</option>
                                                            <option value="Iran, Islamic Republic of">Iran, Islamic
                                                                Republic of
                                                            </option>
                                                            <option value="Iraq">Iraq</option>
                                                            <option value="Ireland">Ireland</option>
                                                            <option value="Isle of Man">Isle of Man</option>
                                                            <option value="Israel">Israel</option>
                                                            <option value="Italy">Italy</option>
                                                            <option value="Jamaica">Jamaica</option>
                                                            <option value="Japan">Japan</option>
                                                            <option value="Jersey">Jersey</option>
                                                            <option value="Jordan">Jordan</option>
                                                            <option value="Kazakhstan">Kazakhstan</option>
                                                            <option value="Kenya">Kenya</option>
                                                            <option value="Kiribati">Kiribati</option>
                                                            <option value="Korea, Democratic People's Republic of">
                                                                Korea, Democratic People's Republic of
                                                            </option>
                                                            <option value="Korea, Republic of">Korea, Republic of
                                                            </option>
                                                            <option value="Kuwait">Kuwait</option>
                                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                            <option value="Lao People's Democratic Republic">Lao
                                                                People's Democratic Republic
                                                            </option>
                                                            <option value="Latvia">Latvia</option>
                                                            <option value="Lebanon">Lebanon</option>
                                                            <option value="Lesotho">Lesotho</option>
                                                            <option value="Liberia">Liberia</option>
                                                            <option value="Libyan Arab Jamahiriya">Libyan Arab
                                                                Jamahiriya
                                                            </option>
                                                            <option value="Liechtenstein">Liechtenstein</option>
                                                            <option value="Lithuania">Lithuania</option>
                                                            <option value="Luxembourg">Luxembourg</option>
                                                            <option value="Macao">Macao</option>
                                                            <option value="Macedonia, The Former Yugoslav Republic of">
                                                                Macedonia, The Former Yugoslav Republic of
                                                            </option>
                                                            <option value="Madagascar">Madagascar</option>
                                                            <option value="Malawi">Malawi</option>
                                                            <option value="Malaysia">Malaysia</option>
                                                            <option value="Maldives">Maldives</option>
                                                            <option value="Mali">Mali</option>
                                                            <option value="Malta">Malta</option>
                                                            <option value="Marshall Islands">Marshall Islands</option>
                                                            <option value="Martinique">Martinique</option>
                                                            <option value="Mauritania">Mauritania</option>
                                                            <option value="Mauritius">Mauritius</option>
                                                            <option value="Mayotte">Mayotte</option>
                                                            <option value="Mexico">Mexico</option>
                                                            <option value="Micronesia, Federated States of">Micronesia,
                                                                Federated States of
                                                            </option>
                                                            <option value="Moldova, Republic of">Moldova, Republic of
                                                            </option>
                                                            <option value="Monaco">Monaco</option>
                                                            <option value="Mongolia">Mongolia</option>
                                                            <option value="Montenegro">Montenegro</option>
                                                            <option value="Montserrat">Montserrat</option>
                                                            <option value="Morocco">Morocco</option>
                                                            <option value="Mozambique">Mozambique</option>
                                                            <option value="Myanmar">Myanmar</option>
                                                            <option value="Namibia">Namibia</option>
                                                            <option value="Nauru">Nauru</option>
                                                            <option value="Nepal">Nepal</option>
                                                            <option value="Netherlands">Netherlands</option>
                                                            <option value="Netherlands Antilles">Netherlands Antilles
                                                            </option>
                                                            <option value="New Caledonia">New Caledonia</option>
                                                            <option value="New Zealand">New Zealand</option>
                                                            <option value="Nicaragua">Nicaragua</option>
                                                            <option value="Niger">Niger</option>
                                                            <option value="Nigeria">Nigeria</option>
                                                            <option value="Niue">Niue</option>
                                                            <option value="Norfolk Island">Norfolk Island</option>
                                                            <option value="Northern Mariana Islands">Northern Mariana
                                                                Islands
                                                            </option>
                                                            <option value="Norway">Norway</option>
                                                            <option value="Oman">Oman</option>
                                                            <option value="Pakistan">Pakistan</option>
                                                            <option value="Palau">Palau</option>
                                                            <option value="Palestinian Territory, Occupied">Palestinian
                                                                Territory, Occupied
                                                            </option>
                                                            <option value="Panama">Panama</option>
                                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                                            <option value="Paraguay">Paraguay</option>
                                                            <option value="Peru">Peru</option>
                                                            <option value="Philippines">Philippines</option>
                                                            <option value="Pitcairn">Pitcairn</option>
                                                            <option value="Poland">Poland</option>
                                                            <option value="Portugal">Portugal</option>
                                                            <option value="Puerto Rico">Puerto Rico</option>
                                                            <option value="Qatar">Qatar</option>
                                                            <option value="Reunion">Reunion</option>
                                                            <option value="Romania">Romania</option>
                                                            <option value="Russian Federation">Russian Federation
                                                            </option>
                                                            <option value="Rwanda">Rwanda</option>
                                                            <option value="Saint Helena">Saint Helena</option>
                                                            <option value="Saint Kitts and Nevis">Saint Kitts and
                                                                Nevis
                                                            </option>
                                                            <option value="Saint Lucia">Saint Lucia</option>
                                                            <option value="Saint Pierre and Miquelon">Saint Pierre and
                                                                Miquelon
                                                            </option>
                                                            <option value="Saint Vincent and The Grenadines">Saint
                                                                Vincent and The Grenadines
                                                            </option>
                                                            <option value="Samoa">Samoa</option>
                                                            <option value="San Marino">San Marino</option>
                                                            <option value="Sao Tome and Principe">Sao Tome and
                                                                Principe
                                                            </option>
                                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                                            <option value="Senegal">Senegal</option>
                                                            <option value="Serbia">Serbia</option>
                                                            <option value="Seychelles">Seychelles</option>
                                                            <option value="Sierra Leone">Sierra Leone</option>
                                                            <option value="Singapore">Singapore</option>
                                                            <option value="Slovakia">Slovakia</option>
                                                            <option value="Slovenia">Slovenia</option>
                                                            <option value="Solomon Islands">Solomon Islands</option>
                                                            <option value="Somalia">Somalia</option>
                                                            <option
                                                                value="South Georgia and The South Sandwich Islands">
                                                                South Georgia and The South Sandwich Islands
                                                            </option>
                                                            <option value="Spain">Spain</option>
                                                            <option value="Sri Lanka">Sri Lanka</option>
                                                            <option value="Sudan">Sudan</option>
                                                            <option value="Suriname">Suriname</option>
                                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan
                                                                Mayen
                                                            </option>
                                                            <option value="Swaziland">Swaziland</option>
                                                            <option value="Sweden">Sweden</option>
                                                            <option value="Switzerland">Switzerland</option>
                                                            <option value="Syrian Arab Republic">Syrian Arab Republic
                                                            </option>
                                                            <option value="Taiwan, Province of China">Taiwan, Province
                                                                of China
                                                            </option>
                                                            <option value="Tajikistan">Tajikistan</option>
                                                            <option value="Tanzania, United Republic of">Tanzania,
                                                                United Republic of
                                                            </option>
                                                            <option value="Thailand">Thailand</option>
                                                            <option value="Timor-leste">Timor-leste</option>
                                                            <option value="Togo">Togo</option>
                                                            <option value="Tokelau">Tokelau</option>
                                                            <option value="Tonga">Tonga</option>
                                                            <option value="Trinidad and Tobago">Trinidad and Tobago
                                                            </option>
                                                            <option value="Tunisia">Tunisia</option>
                                                            <option value="Turkey">Turkey</option>
                                                            <option value="Turkmenistan">Turkmenistan</option>
                                                            <option value="Turks and Caicos Islands">Turks and Caicos
                                                                Islands
                                                            </option>
                                                            <option value="Tuvalu">Tuvalu</option>
                                                            <option value="Uganda">Uganda</option>
                                                            <option value="Ukraine">Ukraine</option>
                                                            <option value="United Arab Emirates">United Arab Emirates
                                                            </option>
                                                            <option value="United Kingdom">United Kingdom</option>
                                                            <option value="United States">United States</option>
                                                            <option value="United States Minor Outlying Islands">United
                                                                States Minor Outlying Islands
                                                            </option>
                                                            <option value="Uruguay">Uruguay</option>
                                                            <option value="Uzbekistan">Uzbekistan</option>
                                                            <option value="Vanuatu">Vanuatu</option>
                                                            <option value="Venezuela">Venezuela</option>
                                                            <option value="Viet Nam">Viet Nam</option>
                                                            <option value="Virgin Islands, British">Virgin Islands,
                                                                British
                                                            </option>
                                                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.
                                                            </option>
                                                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                            <option value="Western Sahara">Western Sahara</option>
                                                            <option value="Yemen">Yemen</option>
                                                            <option value="Zambia">Zambia</option>
                                                            <option value="Zimbabwe">Zimbabwe</option>
                                                        </select>

                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Nationality:</label>
                                                        <br>
                                                        <select class="form-control" data-plugin-multiselect
                                                                data-plugin-options='{ "enableCaseInsensitiveFiltering": true }'
                                                                name="tutnationality" id="tutnationality">
                                                            <option value="">Select a nationality</option>
                                                            <option value="South african">South African</option>
                                                            <option value="Afghan">Afghan</option>
                                                            <option value="Albanian">Albanian</option>
                                                            <option value="Algerian">Algerian</option>
                                                            <option value="American">American</option>
                                                            <option value="Andorran">Andorran</option>
                                                            <option value="Angolan">Angolan</option>
                                                            <option value="Antiguans">Antiguans</option>
                                                            <option value="Argentinean">Argentinean</option>
                                                            <option value="Armenian">Armenian</option>
                                                            <option value="Australian">Australian</option>
                                                            <option value="Austrian">Austrian</option>
                                                            <option value="Azerbaijani">Azerbaijani</option>
                                                            <option value="Bahamian">Bahamian</option>
                                                            <option value="Bahraini">Bahraini</option>
                                                            <option value="Bangladeshi">Bangladeshi</option>
                                                            <option value="Barbadian">Barbadian</option>
                                                            <option value="Barbudans">Barbudans</option>
                                                            <option value="Batswana">Batswana</option>
                                                            <option value="Belarusian">Belarusian</option>
                                                            <option value="Belgian">Belgian</option>
                                                            <option value="Belizean">Belizean</option>
                                                            <option value="Beninese">Beninese</option>
                                                            <option value="Bhutanese">Bhutanese</option>
                                                            <option value="Bolivian">Bolivian</option>
                                                            <option value="Bosnian">Bosnian</option>
                                                            <option value="Brazilian">Brazilian</option>
                                                            <option value="British">British</option>
                                                            <option value="Bruneian">Bruneian</option>
                                                            <option value="Bulgarian">Bulgarian</option>
                                                            <option value="Burkinabe">Burkinabe</option>
                                                            <option value="Burmese">Burmese</option>
                                                            <option value="Burundian">Burundian</option>
                                                            <option value="Cambodian">Cambodian</option>
                                                            <option value="Cameroonian">Cameroonian</option>
                                                            <option value="Canadian">Canadian</option>
                                                            <option value="Cape verdean">Cape Verdean</option>
                                                            <option value="Central african">Central African</option>
                                                            <option value="Chadian">Chadian</option>
                                                            <option value="Chilean">Chilean</option>
                                                            <option value="Chinese">Chinese</option>
                                                            <option value="Colombian">Colombian</option>
                                                            <option value="Comoran">Comoran</option>
                                                            <option value="Congolese">Congolese</option>
                                                            <option value="Costa rican">Costa Rican</option>
                                                            <option value="Croatian">Croatian</option>
                                                            <option value="Cuban">Cuban</option>
                                                            <option value="Cypriot">Cypriot</option>
                                                            <option value="Czech">Czech</option>
                                                            <option value="Danish">Danish</option>
                                                            <option value="Djibouti">Djibouti</option>
                                                            <option value="Dominican">Dominican</option>
                                                            <option value="Dutch">Dutch</option>
                                                            <option value="East timorese">East Timorese</option>
                                                            <option value="Ecuadorean">Ecuadorean</option>
                                                            <option value="Egyptian">Egyptian</option>
                                                            <option value="Emirian">Emirian</option>
                                                            <option value="Equatorial guinean">Equatorial Guinean
                                                            </option>
                                                            <option value="Eritrean">Eritrean</option>
                                                            <option value="Estonian">Estonian</option>
                                                            <option value="Ethiopian">Ethiopian</option>
                                                            <option value="Fijian">Fijian</option>
                                                            <option value="Filipino">Filipino</option>
                                                            <option value="Finnish">Finnish</option>
                                                            <option value="French">French</option>
                                                            <option value="Gabonese">Gabonese</option>
                                                            <option value="Gambian">Gambian</option>
                                                            <option value="Georgian">Georgian</option>
                                                            <option value="German">German</option>
                                                            <option value="Ghanaian">Ghanaian</option>
                                                            <option value="Greek">Greek</option>
                                                            <option value="Grenadian">Grenadian</option>
                                                            <option value="Guatemalan">Guatemalan</option>
                                                            <option value="Guinea-bissauan">Guinea-Bissauan</option>
                                                            <option value="Guinean">Guinean</option>
                                                            <option value="Guyanese">Guyanese</option>
                                                            <option value="Haitian">Haitian</option>
                                                            <option value="Herzegovinian">Herzegovinian</option>
                                                            <option value="Honduran">Honduran</option>
                                                            <option value="Hungarian">Hungarian</option>
                                                            <option value="Icelander">Icelander</option>
                                                            <option value="Indian">Indian</option>
                                                            <option value="Indonesian">Indonesian</option>
                                                            <option value="Iranian">Iranian</option>
                                                            <option value="Iraqi">Iraqi</option>
                                                            <option value="Irish">Irish</option>
                                                            <option value="Israeli">Israeli</option>
                                                            <option value="Italian">Italian</option>
                                                            <option value="Ivorian">Ivorian</option>
                                                            <option value="Jamaican">Jamaican</option>
                                                            <option value="Japanese">Japanese</option>
                                                            <option value="Jordanian">Jordanian</option>
                                                            <option value="Kazakhstani">Kazakhstani</option>
                                                            <option value="Kenyan">Kenyan</option>
                                                            <option value="Kittian and nevisian">Kittian and Nevisian
                                                            </option>
                                                            <option value="Kuwaiti">Kuwaiti</option>
                                                            <option value="Kyrgyz">Kyrgyz</option>
                                                            <option value="Laotian">Laotian</option>
                                                            <option value="Latvian">Latvian</option>
                                                            <option value="Lebanese">Lebanese</option>
                                                            <option value="Liberian">Liberian</option>
                                                            <option value="Libyan">Libyan</option>
                                                            <option value="Liechtensteiner">Liechtensteiner</option>
                                                            <option value="Lithuanian">Lithuanian</option>
                                                            <option value="Luxembourger">Luxembourger</option>
                                                            <option value="Macedonian">Macedonian</option>
                                                            <option value="Malagasy">Malagasy</option>
                                                            <option value="Malawian">Malawian</option>
                                                            <option value="Malaysian">Malaysian</option>
                                                            <option value="Maldivan">Maldivan</option>
                                                            <option value="Malian">Malian</option>
                                                            <option value="Maltese">Maltese</option>
                                                            <option value="Marshallese">Marshallese</option>
                                                            <option value="Mauritanian">Mauritanian</option>
                                                            <option value="Mauritian">Mauritian</option>
                                                            <option value="Mexican">Mexican</option>
                                                            <option value="Micronesian">Micronesian</option>
                                                            <option value="Moldovan">Moldovan</option>
                                                            <option value="Monacan">Monacan</option>
                                                            <option value="Mongolian">Mongolian</option>
                                                            <option value="Moroccan">Moroccan</option>
                                                            <option value="Mosotho">Mosotho</option>
                                                            <option value="Motswana">Motswana</option>
                                                            <option value="Mozambican">Mozambican</option>
                                                            <option value="Namibian">Namibian</option>
                                                            <option value="Nauruan">Nauruan</option>
                                                            <option value="Nepalese">Nepalese</option>
                                                            <option value="New zealander">New Zealander</option>
                                                            <option value="Ni-vanuatu">Ni-Vanuatu</option>
                                                            <option value="Nicaraguan">Nicaraguan</option>
                                                            <option value="Nigerien">Nigerien</option>
                                                            <option value="North korean">North Korean</option>
                                                            <option value="Northern irish">Northern Irish</option>
                                                            <option value="Norwegian">Norwegian</option>
                                                            <option value="Omani">Omani</option>
                                                            <option value="Pakistani">Pakistani</option>
                                                            <option value="Palauan">Palauan</option>
                                                            <option value="Panamanian">Panamanian</option>
                                                            <option value="Papua new guinean">Papua New Guinean</option>
                                                            <option value="Paraguayan">Paraguayan</option>
                                                            <option value="Peruvian">Peruvian</option>
                                                            <option value="Polish">Polish</option>
                                                            <option value="Portuguese">Portuguese</option>
                                                            <option value="Qatari">Qatari</option>
                                                            <option value="Romanian">Romanian</option>
                                                            <option value="Russian">Russian</option>
                                                            <option value="Rwandan">Rwandan</option>
                                                            <option value="Saint lucian">Saint Lucian</option>
                                                            <option value="Salvadoran">Salvadoran</option>
                                                            <option value="Samoan">Samoan</option>
                                                            <option value="San marinese">San Marinese</option>
                                                            <option value="Sao tomean">Sao Tomean</option>
                                                            <option value="Saudi">Saudi</option>
                                                            <option value="Scottish">Scottish</option>
                                                            <option value="Senegalese">Senegalese</option>
                                                            <option value="Serbian">Serbian</option>
                                                            <option value="Seychellois">Seychellois</option>
                                                            <option value="Sierra leonean">Sierra Leonean</option>
                                                            <option value="Singaporean">Singaporean</option>
                                                            <option value="Slovakian">Slovakian</option>
                                                            <option value="Slovenian">Slovenian</option>
                                                            <option value="Solomon islander">Solomon Islander</option>
                                                            <option value="Somali">Somali</option>
                                                            <option value="South korean">South Korean</option>
                                                            <option value="Spanish">Spanish</option>
                                                            <option value="Sri lankan">Sri Lankan</option>
                                                            <option value="Sudanese">Sudanese</option>
                                                            <option value="Surinamer">Surinamer</option>
                                                            <option value="Swazi">Swazi</option>
                                                            <option value="Swedish">Swedish</option>
                                                            <option value="Swiss">Swiss</option>
                                                            <option value="Syrian">Syrian</option>
                                                            <option value="Taiwanese">Taiwanese</option>
                                                            <option value="Tajik">Tajik</option>
                                                            <option value="Tanzanian">Tanzanian</option>
                                                            <option value="Thai">Thai</option>
                                                            <option value="Togolese">Togolese</option>
                                                            <option value="Tongan">Tongan</option>
                                                            <option value="Trinidadian or tobagonian">Trinidadian or
                                                                Tobagonian
                                                            </option>
                                                            <option value="Tunisian">Tunisian</option>
                                                            <option value="Turkish">Turkish</option>
                                                            <option value="Tuvaluan">Tuvaluan</option>
                                                            <option value="Ugandan">Ugandan</option>
                                                            <option value="Ukrainian">Ukrainian</option>
                                                            <option value="Uruguayan">Uruguayan</option>
                                                            <option value="Uzbekistani">Uzbekistani</option>
                                                            <option value="Venezuelan">Venezuelan</option>
                                                            <option value="Vietnamese">Vietnamese</option>
                                                            <option value="Welsh">Welsh</option>
                                                            <option value="Yemenite">Yemenite</option>
                                                            <option value="Zambian">Zambian</option>
                                                            <option value="Zimbabwean">Zimbabwean</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end: Address -->

                                        <!-- begin: contact -->
                                        <div class="panel panel-primary" id="school_panel" name="school_panel">
                                            <div class="panel-heading ">Contact Details</div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Cell Phone Number:</label>
                                                        <input type="text" value="" class="form-control "
                                                               name="tutcellno" id="tutcellno"
                                                               placeholder="Please enter your cell-phone number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Alternative Contact Number:</label>
                                                        <input type="text" value="" class="form-control "
                                                               name="tutaltno" id="tutaltno"
                                                               placeholder="Please enter an alternative phone number">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Personal Email Address:</label>
                                                        <input type="text" value="" class="form-control "
                                                               name="tutpemail" id="tutpemail"
                                                               placeholder="Please enter your personal email address">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- end: contact -->


                                        <!--end personal details-->
                                        <!--end personal details panel-->

                                        <div class="panel panel-primary" id="school_panel" name="school_panel">
                                            <div class="panel-heading ">Monash University Details</div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Student Number:</label>
                                                        <input type="text" value="" class="form-control "
                                                               name="tutstunum" id="tutstunum"
                                                               placeholder="Please enter your Student Number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Year of Study</label>
                                                        <input type="text" value="" class="form-control "
                                                               name='tutstudyyear' id='tutstudyyear'
                                                               placeholder="Please enter your year of study at Monash">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Monash Email Address</label>
                                                        <input type="text" value="" class="form-control "
                                                               name='tutmemail' id='tutmemail'
                                                               placeholder="Please enter your Monash Email Address">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="subjects">Area of Study</label>
                                                        <br>
                                                        <select class="form-control" data-plugin-multiselect
                                                                data-plugin-options='{ "enableCaseInsensitiveFiltering": true }'
                                                                name="tutareastud"
                                                                id="tutareastud">
                                                            <option value="">Select a Courses</option>
                                                            <option value="MSA Foundation Programme (HCHES)">Foundation
                                                                Programme: Higher Certificate in
                                                                Higher Education Studies(HCHES)
                                                            </option>
                                                            <option value="Bachelor-Business Science">Bachelor of
                                                                Business Science
                                                            </option>
                                                            <option value="Bachelor-Business Science (Accounting)">
                                                                Bachelor of Business Science
                                                                (Accounting)
                                                            </option>
                                                            <option value="Bachelor-Public Health">Bachelor of Public
                                                                Health
                                                            </option>
                                                            <option value="Bachelor-Computer &amp; Info Sciences">
                                                                Bachelor of Computer and Information
                                                                Sciences
                                                            </option>
                                                            <option value="Bachelor-Social Science">Bachelor of Social
                                                                Science
                                                            </option>
                                                            <option value="Honours-Bachelor of Business Science">Honours
                                                                degree of Bachelor of Business
                                                                Science
                                                            </option>
                                                            <option value="Honours-Bachelor of Comp &amp; Info Science">
                                                                Honours degree of Bachelor of
                                                                Computer and Information Sciences
                                                            </option>
                                                            <option value="Honours in Public Health">Honours degree of
                                                                Bachelor of Public Health
                                                            </option>
                                                            <option value="Honours-Bachelor of Social Science">Honours
                                                                degree of Bachelor of Social
                                                                Sciences
                                                            </option>
                                                            <option value="MIB">Master of International Business
                                                            </option>
                                                            <option value="Master of Philosophy">Master of Philosophy
                                                            </option>
                                                            <option value="Master of Philosophy in IWM">Master of
                                                                Philosophy in Integrated Water
                                                                Management
                                                            </option>
                                                            <option value="Master of Philosophy in CIS">Master of
                                                                Philosophy in Computer and Information
                                                                Science
                                                            </option>
                                                            <option value="PDM Accounting (CTA)">PGD Accounting in
                                                                Accounting (CTA)
                                                            </option>
                                                            <option value="PDM Corporate Governance">PGDM specialising
                                                                in Corporate Governance
                                                            </option>
                                                            <option value="PDM HIV/AIDS and Health">PGDM specialising in
                                                                HIV/AIDS and Health
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <!-- End Monash details -->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel panel-primary" id="school_panel" name="school_panel">
                                                    <div class="panel-body">
                                                        <input type="submit" id="submit" name="submit" value="Submit"
                                                               class="btn btn-lg btn-primary push-bottom">

                                                        <p class="pull-right">Return to the <a
                                                                class="btn btn-lg btn-primary " href="index.php">login
                                                                page</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            </form>

                            <!--AJAX Login View + validation-->
                            <script type="text/JavaScript" src="/assets/ajax/profile/tutor-submit.js"></script>

                            <!-- Hashing JS -->
                            <script type="text/JavaScript" src="/assets/ajax/shared/sha512.js"></script>


                            <script type="text/javascript">
                                // When the document is ready
                                $(document).ready(function () {

                                    $('#tutdob .input-group.date').datepicker({
                                        format: "yyyy-mm-dd",
                                        startView: 2,
                                        calendarWeeks: true,
                                        autoclose: true,
                                        todayHighlight: true,
                                        endDate: "today"
                                    });
                                });
                            </script>


                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $('#tutcountry').multiselect({
                                        maxHeight: 300,
                                        enableCaseInsensitiveFiltering: true,
                                        numberDisplayed: 1
                                    });
                                });
                            </script>

                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $('#tutresidence').multiselect({
                                        maxHeight: 300,
                                        enableCaseInsensitiveFiltering: true,
                                        numberDisplayed: 1
                                    });
                                });
                            </script>

                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $('#tutnationality').multiselect({
                                        maxHeight: 300,
                                        enableCaseInsensitiveFiltering: true,
                                        numberDisplayed: 1
                                    });
                                });
                            </script>
                            <?php
                            }
                            elseif ($usertype['usertype'] == 'Teacher') { ?>
                                <div class="alert alert-success hidden" id="contactSuccess">Success! Your profile has
                                    been updated. You will be redirected to you portal shortly.
                                </div>
                                <div class="alert alert-danger hidden" id="contactError">Error!</div>
                                <form action="/assets/includes/process_teacherprofile.php" method="post"
                                      name="teacherprofile" id="teacherprofile">

                                    <!-- begin: Personal -->
                                    <div class="panel panel-primary" id="school_panel" name="school_panel">
                                        <div class="panel-heading ">Personal Details</div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Gender</label>

                                                    <div class="radio-group">
                                                        <label class="radio-inline">
                                                            <input type="radio" value="Male" id="teagender"
                                                                   name="teagender">
                                                            Male</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" value="Female" id="teagender"
                                                                   name="teagender">
                                                            Female</label>
                                                    </div>

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Date of Birth:</label>

                                                    <div id="teadateofbirth">
                                                        <div class="input-group date">
                                                            <input type="text" class="form-control" id="teadateofbirth"
                                                                   name="teadateofbirth"
                                                                   placeholder="Select your date of birth">
                                                            <span class="input-group-addon"><i
                                                                    class="glyphicon glyphicon-th"></i></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end: Personal -->

                                    <!-- begin: Address -->
                                    <div class="panel panel-primary" id="school_panel" name="school_panel">
                                        <div class="panel-heading ">Home Address</div>
                                        <div class="panel-body">
                                            <div class="row">

                                                <div class="col-md-6 form-group">
                                                    <label>Street Number:</label>
                                                    <input type="text" value="" class="form-control " name="teastreetno"
                                                           id="teastreetno"
                                                           placeholder="Please enter your street number">
                                                </div>


                                                <div class="col-md-6 form-group">
                                                    <label>Street Name:</label>
                                                    <input type="text" value="" class="form-control "
                                                           name="teastreetname" id="teastreetname"
                                                           placeholder="Please enter your street name">
                                                </div>

                                            </div>
                                            <div class="row">

                                                <div class="col-md-6 form-group">
                                                    <label>Suburb:</label>
                                                    <input type="text" value="" class="form-control " name="teasuburb"
                                                           id="teasuburb" placeholder="Please enter your home address">
                                                </div>


                                                <div class="col-md-6 form-group">
                                                    <label>City:</label>
                                                    <input type="text" value="" class="form-control " name="teacity"
                                                           id="teacity" placeholder="Please enter your home address">
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <label>Postal Code:</label>
                                                        <input type="text" value="" class="form-control "
                                                               name="teapostcode" id="teapostcode"
                                                               placeholder="Please enter your home address">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Country:</label>
                                                        <br>
                                                        <select class="form-control" data-plugin-multiselect
                                                                data-plugin-options='{ "enableCaseInsensitiveFiltering": true }'
                                                                name="teacountry" id="teacountry">
                                                            <option value="">Select a country</option>
                                                            <option value="South Africa">South Africa
                                                            </option>
                                                            <option value="Afghanistan">Afghanistan</option>
                                                            <option value="Aland Islands">Aland Islands
                                                            </option>
                                                            <option value="Albania">Albania</option>
                                                            <option value="Algeria">Algeria</option>
                                                            <option value="American Samoa">American Samoa
                                                            </option>
                                                            <option value="Andorra">Andorra</option>
                                                            <option value="Angola">Angola</option>
                                                            <option value="Anguilla">Anguilla</option>
                                                            <option value="Antarctica">Antarctica</option>
                                                            <option value="Antigua and Barbuda">Antigua and
                                                                Barbuda
                                                            </option>
                                                            <option value="Argentina">Argentina</option>
                                                            <option value="Armenia">Armenia</option>
                                                            <option value="Aruba">Aruba</option>
                                                            <option value="Australia">Australia</option>
                                                            <option value="Austria">Austria</option>
                                                            <option value="Azerbaijan">Azerbaijan</option>
                                                            <option value="Bahamas">Bahamas</option>
                                                            <option value="Bahrain">Bahrain</option>
                                                            <option value="Bangladesh">Bangladesh</option>
                                                            <option value="Barbados">Barbados</option>
                                                            <option value="Belarus">Belarus</option>
                                                            <option value="Belgium">Belgium</option>
                                                            <option value="Belize">Belize</option>
                                                            <option value="Benin">Benin</option>
                                                            <option value="Bermuda">Bermuda</option>
                                                            <option value="Bhutan">Bhutan</option>
                                                            <option value="Bolivia">Bolivia</option>
                                                            <option value="Bosnia and Herzegovina">Bosnia
                                                                and Herzegovina
                                                            </option>
                                                            <option value="Botswana">Botswana</option>
                                                            <option value="Bouvet Island">Bouvet Island
                                                            </option>
                                                            <option value="Brazil">Brazil</option>
                                                            <option value="British Indian Ocean Territory">
                                                                British Indian Ocean Territory
                                                            </option>
                                                            <option value="Brunei Darussalam">Brunei
                                                                Darussalam
                                                            </option>
                                                            <option value="Bulgaria">Bulgaria</option>
                                                            <option value="Burkina Faso">Burkina Faso
                                                            </option>
                                                            <option value="Burundi">Burundi</option>
                                                            <option value="Cambodia">Cambodia</option>
                                                            <option value="Cameroon">Cameroon</option>
                                                            <option value="Canada">Canada</option>
                                                            <option value="Cape Verde">Cape Verde</option>
                                                            <option value="Cayman Islands">Cayman Islands
                                                            </option>
                                                            <option value="Central African Republic">Central
                                                                African Republic
                                                            </option>
                                                            <option value="Chad">Chad</option>
                                                            <option value="Chile">Chile</option>
                                                            <option value="China">China</option>
                                                            <option value="Christmas Island">Christmas
                                                                Island
                                                            </option>
                                                            <option value="Cocos (Keeling) Islands">Cocos
                                                                (Keeling) Islands
                                                            </option>
                                                            <option value="Colombia">Colombia</option>
                                                            <option value="Comoros">Comoros</option>
                                                            <option value="Congo">Congo</option>
                                                            <option
                                                                value="Congo, The Democratic Republic of The">
                                                                Congo, The Democratic Republic of The
                                                            </option>
                                                            <option value="Cook Islands">Cook Islands
                                                            </option>
                                                            <option value="Costa Rica">Costa Rica</option>
                                                            <option value="Cote D'ivoire">Cote D'ivoire
                                                            </option>
                                                            <option value="Croatia">Croatia</option>
                                                            <option value="Cuba">Cuba</option>
                                                            <option value="Cyprus">Cyprus</option>
                                                            <option value="Czech Republic">Czech Republic
                                                            </option>
                                                            <option value="Denmark">Denmark</option>
                                                            <option value="Djibouti">Djibouti</option>
                                                            <option value="Dominica">Dominica</option>
                                                            <option value="Dominican Republic">Dominican
                                                                Republic
                                                            </option>
                                                            <option value="Ecuador">Ecuador</option>
                                                            <option value="Egypt">Egypt</option>
                                                            <option value="El Salvador">El Salvador</option>
                                                            <option value="Equatorial Guinea">Equatorial
                                                                Guinea
                                                            </option>
                                                            <option value="Eritrea">Eritrea</option>
                                                            <option value="Estonia">Estonia</option>
                                                            <option value="Ethiopia">Ethiopia</option>
                                                            <option value="Falkland Islands (Malvinas)">
                                                                Falkland Islands (Malvinas)
                                                            </option>
                                                            <option value="Faroe Islands">Faroe Islands
                                                            </option>
                                                            <option value="Fiji">Fiji</option>
                                                            <option value="Finland">Finland</option>
                                                            <option value="France">France</option>
                                                            <option value="French Guiana">French Guiana
                                                            </option>
                                                            <option value="French Polynesia">French
                                                                Polynesia
                                                            </option>
                                                            <option value="French Southern Territories">
                                                                French Southern Territories
                                                            </option>
                                                            <option value="Gabon">Gabon</option>
                                                            <option value="Gambia">Gambia</option>
                                                            <option value="Georgia">Georgia</option>
                                                            <option value="Germany">Germany</option>
                                                            <option value="Ghana">Ghana</option>
                                                            <option value="Gibraltar">Gibraltar</option>
                                                            <option value="Greece">Greece</option>
                                                            <option value="Greenland">Greenland</option>
                                                            <option value="Grenada">Grenada</option>
                                                            <option value="Guadeloupe">Guadeloupe</option>
                                                            <option value="Guam">Guam</option>
                                                            <option value="Guatemala">Guatemala</option>
                                                            <option value="Guernsey">Guernsey</option>
                                                            <option value="Guinea">Guinea</option>
                                                            <option value="Guinea-bissau">Guinea-bissau
                                                            </option>
                                                            <option value="Guyana">Guyana</option>
                                                            <option value="Haiti">Haiti</option>
                                                            <option
                                                                value="Heard Island and Mcdonald Islands">
                                                                Heard Island and Mcdonald Islands
                                                            </option>
                                                            <option value="Holy See (Vatican City State)">
                                                                Holy See (Vatican City State)
                                                            </option>
                                                            <option value="Honduras">Honduras</option>
                                                            <option value="Hong Kong">Hong Kong</option>
                                                            <option value="Hungary">Hungary</option>
                                                            <option value="Iceland">Iceland</option>
                                                            <option value="India">India</option>
                                                            <option value="Indonesia">Indonesia</option>
                                                            <option value="Iran, Islamic Republic of">Iran,
                                                                Islamic Republic of
                                                            </option>
                                                            <option value="Iraq">Iraq</option>
                                                            <option value="Ireland">Ireland</option>
                                                            <option value="Isle of Man">Isle of Man</option>
                                                            <option value="Israel">Israel</option>
                                                            <option value="Italy">Italy</option>
                                                            <option value="Jamaica">Jamaica</option>
                                                            <option value="Japan">Japan</option>
                                                            <option value="Jersey">Jersey</option>
                                                            <option value="Jordan">Jordan</option>
                                                            <option value="Kazakhstan">Kazakhstan</option>
                                                            <option value="Kenya">Kenya</option>
                                                            <option value="Kiribati">Kiribati</option>
                                                            <option
                                                                value="Korea, Democratic People's Republic of">
                                                                Korea, Democratic People's Republic of
                                                            </option>
                                                            <option value="Korea, Republic of">Korea,
                                                                Republic of
                                                            </option>
                                                            <option value="Kuwait">Kuwait</option>
                                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                            <option
                                                                value="Lao People's Democratic Republic">Lao
                                                                People's Democratic Republic
                                                            </option>
                                                            <option value="Latvia">Latvia</option>
                                                            <option value="Lebanon">Lebanon</option>
                                                            <option value="Lesotho">Lesotho</option>
                                                            <option value="Liberia">Liberia</option>
                                                            <option value="Libyan Arab Jamahiriya">Libyan
                                                                Arab Jamahiriya
                                                            </option>
                                                            <option value="Liechtenstein">Liechtenstein
                                                            </option>
                                                            <option value="Lithuania">Lithuania</option>
                                                            <option value="Luxembourg">Luxembourg</option>
                                                            <option value="Macao">Macao</option>
                                                            <option
                                                                value="Macedonia, The Former Yugoslav Republic of">
                                                                Macedonia, The Former Yugoslav Republic of
                                                            </option>
                                                            <option value="Madagascar">Madagascar</option>
                                                            <option value="Malawi">Malawi</option>
                                                            <option value="Malaysia">Malaysia</option>
                                                            <option value="Maldives">Maldives</option>
                                                            <option value="Mali">Mali</option>
                                                            <option value="Malta">Malta</option>
                                                            <option value="Marshall Islands">Marshall
                                                                Islands
                                                            </option>
                                                            <option value="Martinique">Martinique</option>
                                                            <option value="Mauritania">Mauritania</option>
                                                            <option value="Mauritius">Mauritius</option>
                                                            <option value="Mayotte">Mayotte</option>
                                                            <option value="Mexico">Mexico</option>
                                                            <option value="Micronesia, Federated States of">
                                                                Micronesia, Federated States of
                                                            </option>
                                                            <option value="Moldova, Republic of">Moldova,
                                                                Republic of
                                                            </option>
                                                            <option value="Monaco">Monaco</option>
                                                            <option value="Mongolia">Mongolia</option>
                                                            <option value="Montenegro">Montenegro</option>
                                                            <option value="Montserrat">Montserrat</option>
                                                            <option value="Morocco">Morocco</option>
                                                            <option value="Mozambique">Mozambique</option>
                                                            <option value="Myanmar">Myanmar</option>
                                                            <option value="Namibia">Namibia</option>
                                                            <option value="Nauru">Nauru</option>
                                                            <option value="Nepal">Nepal</option>
                                                            <option value="Netherlands">Netherlands</option>
                                                            <option value="Netherlands Antilles">Netherlands
                                                                Antilles
                                                            </option>
                                                            <option value="New Caledonia">New Caledonia
                                                            </option>
                                                            <option value="New Zealand">New Zealand</option>
                                                            <option value="Nicaragua">Nicaragua</option>
                                                            <option value="Niger">Niger</option>
                                                            <option value="Nigeria">Nigeria</option>
                                                            <option value="Niue">Niue</option>
                                                            <option value="Norfolk Island">Norfolk Island
                                                            </option>
                                                            <option value="Northern Mariana Islands">
                                                                Northern Mariana Islands
                                                            </option>
                                                            <option value="Norway">Norway</option>
                                                            <option value="Oman">Oman</option>
                                                            <option value="Pakistan">Pakistan</option>
                                                            <option value="Palau">Palau</option>
                                                            <option value="Palestinian Territory, Occupied">
                                                                Palestinian Territory, Occupied
                                                            </option>
                                                            <option value="Panama">Panama</option>
                                                            <option value="Papua New Guinea">Papua New
                                                                Guinea
                                                            </option>
                                                            <option value="Paraguay">Paraguay</option>
                                                            <option value="Peru">Peru</option>
                                                            <option value="Philippines">Philippines</option>
                                                            <option value="Pitcairn">Pitcairn</option>
                                                            <option value="Poland">Poland</option>
                                                            <option value="Portugal">Portugal</option>
                                                            <option value="Puerto Rico">Puerto Rico</option>
                                                            <option value="Qatar">Qatar</option>
                                                            <option value="Reunion">Reunion</option>
                                                            <option value="Romania">Romania</option>
                                                            <option value="Russian Federation">Russian
                                                                Federation
                                                            </option>
                                                            <option value="Rwanda">Rwanda</option>
                                                            <option value="Saint Helena">Saint Helena
                                                            </option>
                                                            <option value="Saint Kitts and Nevis">Saint
                                                                Kitts and Nevis
                                                            </option>
                                                            <option value="Saint Lucia">Saint Lucia</option>
                                                            <option value="Saint Pierre and Miquelon">Saint
                                                                Pierre and Miquelon
                                                            </option>
                                                            <option
                                                                value="Saint Vincent and The Grenadines">
                                                                Saint Vincent and The Grenadines
                                                            </option>
                                                            <option value="Samoa">Samoa</option>
                                                            <option value="San Marino">San Marino</option>
                                                            <option value="Sao Tome and Principe">Sao Tome
                                                                and Principe
                                                            </option>
                                                            <option value="Saudi Arabia">Saudi Arabia
                                                            </option>
                                                            <option value="Senegal">Senegal</option>
                                                            <option value="Serbia">Serbia</option>
                                                            <option value="Seychelles">Seychelles</option>
                                                            <option value="Sierra Leone">Sierra Leone
                                                            </option>
                                                            <option value="Singapore">Singapore</option>
                                                            <option value="Slovakia">Slovakia</option>
                                                            <option value="Slovenia">Slovenia</option>
                                                            <option value="Solomon Islands">Solomon
                                                                Islands
                                                            </option>
                                                            <option value="Somalia">Somalia</option>
                                                            <option
                                                                value="South Georgia and The South Sandwich Islands">
                                                                South Georgia and The South Sandwich Islands
                                                            </option>
                                                            <option value="Spain">Spain</option>
                                                            <option value="Sri Lanka">Sri Lanka</option>
                                                            <option value="Sudan">Sudan</option>
                                                            <option value="Suriname">Suriname</option>
                                                            <option value="Svalbard and Jan Mayen">Svalbard
                                                                and Jan Mayen
                                                            </option>
                                                            <option value="Swaziland">Swaziland</option>
                                                            <option value="Sweden">Sweden</option>
                                                            <option value="Switzerland">Switzerland</option>
                                                            <option value="Syrian Arab Republic">Syrian Arab
                                                                Republic
                                                            </option>
                                                            <option value="Taiwan, Province of China">
                                                                Taiwan, Province of China
                                                            </option>
                                                            <option value="Tajikistan">Tajikistan</option>
                                                            <option value="Tanzania, United Republic of">
                                                                Tanzania, United Republic of
                                                            </option>
                                                            <option value="Thailand">Thailand</option>
                                                            <option value="Timor-leste">Timor-leste</option>
                                                            <option value="Togo">Togo</option>
                                                            <option value="Tokelau">Tokelau</option>
                                                            <option value="Tonga">Tonga</option>
                                                            <option value="Trinidad and Tobago">Trinidad and
                                                                Tobago
                                                            </option>
                                                            <option value="Tunisia">Tunisia</option>
                                                            <option value="Turkey">Turkey</option>
                                                            <option value="Turkmenistan">Turkmenistan
                                                            </option>
                                                            <option value="Turks and Caicos Islands">Turks
                                                                and Caicos Islands
                                                            </option>
                                                            <option value="Tuvalu">Tuvalu</option>
                                                            <option value="Uganda">Uganda</option>
                                                            <option value="Ukraine">Ukraine</option>
                                                            <option value="United Arab Emirates">United Arab
                                                                Emirates
                                                            </option>
                                                            <option value="United Kingdom">United Kingdom
                                                            </option>
                                                            <option value="United States">United States
                                                            </option>
                                                            <option
                                                                value="United States Minor Outlying Islands">
                                                                United States Minor Outlying Islands
                                                            </option>
                                                            <option value="Uruguay">Uruguay</option>
                                                            <option value="Uzbekistan">Uzbekistan</option>
                                                            <option value="Vanuatu">Vanuatu</option>
                                                            <option value="Venezuela">Venezuela</option>
                                                            <option value="Viet Nam">Viet Nam</option>
                                                            <option value="Virgin Islands, British">Virgin
                                                                Islands, British
                                                            </option>
                                                            <option value="Virgin Islands, U.S.">Virgin
                                                                Islands, U.S.
                                                            </option>
                                                            <option value="Wallis and Futuna">Wallis and
                                                                Futuna
                                                            </option>
                                                            <option value="Western Sahara">Western Sahara
                                                            </option>
                                                            <option value="Yemen">Yemen</option>
                                                            <option value="Zambia">Zambia</option>
                                                            <option value="Zimbabwe">Zimbabwe</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end: Address -->

                                    <!-- begin: contact -->
                                    <div class="panel panel-primary" id="school_panel" name="school_panel">
                                        <div class="panel-heading ">Contact Details</div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Home Number:</label>
                                                    <input type="text" value="" class="form-control "
                                                           name="teahomeno" id="teahomeno"
                                                           placeholder="Please enter your home phone number">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Cell Phone Number:</label>
                                                    <input type="text" value="" class="form-control "
                                                           name="teacellno" id="teacellno"
                                                           placeholder="Please enter your cell-phone number">

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Alternative Contact Number:</label>
                                                    <input type="text" value="" class="form-control "
                                                           name="teaaltno" id="teaaltno"
                                                           placeholder="Please enter an alternative phone number">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>E-mail Address:</label>
                                                    <input type="text" value="" class="form-control " name="teamail"
                                                           id="teamail"
                                                           placeholder="Please enter your e-mail address">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end: contact -->

                                    <div class="panel panel-primary " id="school_panel" name="school_panel">
                                        <div class="panel-heading ">Qualification Details</div>
                                        <div class="panel-body">

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>Area Of Study:</label>
                                                        <input type="text" value="" class="form-control "
                                                               name='teastudy' id='teastudy'
                                                               placeholder="Please enter your area of study">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="panel panel-primary" id="school_panel" name="school_panel">
                                        <div class="panel-heading ">School Details</div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>School Employed At:</label>
                                                    <input type="text" value="" class="form-control "
                                                           name='teaschoolemp' id='teaschoolemp'
                                                           placeholder="Please enter the school you are employed at">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Years Of Experience:</label>
                                                    <input type="text" value="" class="form-control " name="teaexper"
                                                           id="teaexper" placeholder="Please enter years of experience">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>School Address:</label>
                                                    <input type="text" value="" class="form-control "
                                                           name="teaschooladdress" id="teaschooladdress"
                                                           placeholder="Please enter the grade you are teaching">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>School Contact:</label>
                                                    <input type="text" value="" class="form-control " name="teaschcon"
                                                           id="teaschcon"
                                                           placeholder="Please enter the grade you are teaching">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Grade Taught:</label>
                                                    <input type="text" value="" class="form-control "
                                                           name="teagrataught" id="teagrataught"
                                                           placeholder="Please enter the grade you are teaching">
                                                </div>
                                            </div>
                                            <!-- End school details -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-primary" id="school_panel" name="school_panel">
                                                <div class="panel-body">
                                                    <input type="submit" id="submit" name="submit" value="Submit"
                                                           class="btn btn-lg btn-primary push-bottom">

                                                    <p class="pull-right">Return to the <a
                                                            class="btn btn-lg btn-primary " href="index.php">login
                                                            page</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!--AJAX Login View + validation-->
                                <script type="text/JavaScript" src="/assets/ajax/profile/teacher-submit.js"></script>

                                <!-- Hashing JS -->
                                <script type="text/JavaScript" src="/assets/ajax/shared/sha512.js"></script>
                                <script type="text/javascript">
                                    // When the document is ready
                                    $(document).ready(function () {

                                        $('#teadateofbirth .input-group.date').datepicker({
                                            format: "yyyy-mm-dd",
                                            startView: 2,
                                            calendarWeeks: true,
                                            autoclose: true,
                                            todayHighlight: true,
                                            endDate: "today"
                                        });
                                    });
                                </script>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $('#teacountry').multiselect({
                                            maxHeight: 300,
                                            enableCaseInsensitiveFiltering: true,
                                            numberDisplayed: 1
                                        });
                                    });
                                </script>
                            <?php }
                            elseif ($usertype['usertype'] == 'Administrator') { ?>


                                <div class="alert alert-success hidden" id="contactSuccess">Success! Your profile has
                                    been updated. You will be redirected to you portal shortly.
                                </div>
                                <div class="alert alert-danger hidden" id="contactError">Error!</div>
                                <form action="/assets/includes/process_adminprofile.php" method="post"
                                      name="adminprofile" id="adminprofile">

                                    <!-- begin: Personal -->
                                    <div class="panel panel-primary" id="school_panel" name="school_panel">
                                        <div class="panel-heading ">Personal Details</div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>Gender</label>

                                                        <div class="radio-group">
                                                            <label class="radio-inline">
                                                                <input type="radio" value="Male" id="admgender"
                                                                       name="admgender">
                                                                Male</label>
                                                            <label class="radio-inline">
                                                                <input type="radio" value="Female" id="admgender"
                                                                       name="admgender">
                                                                Female</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label class="control-label">Date of Birth:</label>

                                                        <div id="admdateofbirth">
                                                            <div class="input-group date">
                                                                <input type="text" class="form-control"
                                                                       id="admdateofbirth" name="admdateofbirth"
                                                                       placeholder="Select your date of birth">
                                                                <span class="input-group-addon"><i
                                                                        class="glyphicon glyphicon-th"></i></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end: Personal -->

                                    <!-- begin: Address -->
                                    <div class="panel panel-primary" id="school_panel" name="school_panel">
                                        <div class="panel-heading ">Home Address</div>
                                        <div class="panel-body">
                                            <div class="row">

                                                <div class="col-md-6 form-group">
                                                    <label>Street Number:</label>
                                                    <input type="text" value="" class="form-control " name="admstreetno"
                                                           id="admstreetno"
                                                           placeholder="Please enter your street number">
                                                </div>


                                                <div class="col-md-6 form-group">
                                                    <label>Street Name:</label>
                                                    <input type="text" value="" class="form-control "
                                                           name="admstreetname" id="admstreetname"
                                                           placeholder="Please enter your street name">
                                                </div>

                                            </div>
                                            <div class="row">

                                                <div class="col-md-6 form-group">
                                                    <label>Suburb:</label>
                                                    <input type="text" value="" class="form-control " name="admsuburb"
                                                           id="admsuburb" placeholder="Please enter your home address">
                                                </div>


                                                <div class="col-md-6 form-group">
                                                    <label>City:</label>
                                                    <input type="text" value="" class="form-control " name="admcity"
                                                           id="admcity" placeholder="Please enter your home address">
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <label>Postal Code:</label>
                                                        <input type="text" value="" class="form-control "
                                                               name="admpostcode" id="admpostcode"
                                                               placeholder="Please enter your home address">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Country:</label>
                                                        <br>
                                                        <select class="form-control" data-plugin-multiselect
                                                                data-plugin-options='{ "enableCaseInsensitiveFiltering": true }'
                                                                name="admcountry" id="admcountry">
                                                            <option value="">Select a country</option>
                                                            <option value="Afghan">Afghan</option>
                                                            <option value="Albanian">Albanian</option>
                                                            <option value="Algerian">Algerian</option>
                                                            <option value="American">American</option>
                                                            <option value="Andorran">Andorran</option>
                                                            <option value="Angolan">Angolan</option>
                                                            <option value="Antiguans">Antiguans</option>
                                                            <option value="Argentinean">Argentinean</option>
                                                            <option value="Armenian">Armenian</option>
                                                            <option value="Australian">Australian</option>
                                                            <option value="Austrian">Austrian</option>
                                                            <option value="Azerbaijani">Azerbaijani</option>
                                                            <option value="Bahamian">Bahamian</option>
                                                            <option value="Bahraini">Bahraini</option>
                                                            <option value="Bangladeshi">Bangladeshi</option>
                                                            <option value="Barbadian">Barbadian</option>
                                                            <option value="Barbudans">Barbudans</option>
                                                            <option value="Batswana">Batswana</option>
                                                            <option value="Belarusian">Belarusian</option>
                                                            <option value="Belgian">Belgian</option>
                                                            <option value="Belizean">Belizean</option>
                                                            <option value="Beninese">Beninese</option>
                                                            <option value="Bhutanese">Bhutanese</option>
                                                            <option value="Bolivian">Bolivian</option>
                                                            <option value="Bosnian">Bosnian</option>
                                                            <option value="Brazilian">Brazilian</option>
                                                            <option value="British">British</option>
                                                            <option value="Bruneian">Bruneian</option>
                                                            <option value="Bulgarian">Bulgarian</option>
                                                            <option value="Burkinabe">Burkinabe</option>
                                                            <option value="Burmese">Burmese</option>
                                                            <option value="Burundian">Burundian</option>
                                                            <option value="Cambodian">Cambodian</option>
                                                            <option value="Cameroonian">Cameroonian</option>
                                                            <option value="Canadian">Canadian</option>
                                                            <option value="Cape verdean">Cape Verdean</option>
                                                            <option value="Central african">Central African</option>
                                                            <option value="Chadian">Chadian</option>
                                                            <option value="Chilean">Chilean</option>
                                                            <option value="Chinese">Chinese</option>
                                                            <option value="Colombian">Colombian</option>
                                                            <option value="Comoran">Comoran</option>
                                                            <option value="Congolese">Congolese</option>
                                                            <option value="Costa rican">Costa Rican</option>
                                                            <option value="Croatian">Croatian</option>
                                                            <option value="Cuban">Cuban</option>
                                                            <option value="Cypriot">Cypriot</option>
                                                            <option value="Czech">Czech</option>
                                                            <option value="Danish">Danish</option>
                                                            <option value="Djibouti">Djibouti</option>
                                                            <option value="Dominican">Dominican</option>
                                                            <option value="Dutch">Dutch</option>
                                                            <option value="East timorese">East Timorese</option>
                                                            <option value="Ecuadorean">Ecuadorean</option>
                                                            <option value="Egyptian">Egyptian</option>
                                                            <option value="Emirian">Emirian</option>
                                                            <option value="Equatorial guinean">Equatorial Guinean
                                                            </option>
                                                            <option value="Eritrean">Eritrean</option>
                                                            <option value="Estonian">Estonian</option>
                                                            <option value="Ethiopian">Ethiopian</option>
                                                            <option value="Fijian">Fijian</option>
                                                            <option value="Filipino">Filipino</option>
                                                            <option value="Finnish">Finnish</option>
                                                            <option value="French">French</option>
                                                            <option value="Gabonese">Gabonese</option>
                                                            <option value="Gambian">Gambian</option>
                                                            <option value="Georgian">Georgian</option>
                                                            <option value="German">German</option>
                                                            <option value="Ghanaian">Ghanaian</option>
                                                            <option value="Greek">Greek</option>
                                                            <option value="Grenadian">Grenadian</option>
                                                            <option value="Guatemalan">Guatemalan</option>
                                                            <option value="Guinea-bissauan">Guinea-Bissauan</option>
                                                            <option value="Guinean">Guinean</option>
                                                            <option value="Guyanese">Guyanese</option>
                                                            <option value="Haitian">Haitian</option>
                                                            <option value="Herzegovinian">Herzegovinian</option>
                                                            <option value="Honduran">Honduran</option>
                                                            <option value="Hungarian">Hungarian</option>
                                                            <option value="Icelander">Icelander</option>
                                                            <option value="Indian">Indian</option>
                                                            <option value="Indonesian">Indonesian</option>
                                                            <option value="Iranian">Iranian</option>
                                                            <option value="Iraqi">Iraqi</option>
                                                            <option value="Irish">Irish</option>
                                                            <option value="Israeli">Israeli</option>
                                                            <option value="Italian">Italian</option>
                                                            <option value="Ivorian">Ivorian</option>
                                                            <option value="Jamaican">Jamaican</option>
                                                            <option value="Japanese">Japanese</option>
                                                            <option value="Jordanian">Jordanian</option>
                                                            <option value="Kazakhstani">Kazakhstani</option>
                                                            <option value="Kenyan">Kenyan</option>
                                                            <option value="Kittian and nevisian">Kittian and Nevisian
                                                            </option>
                                                            <option value="Kuwaiti">Kuwaiti</option>
                                                            <option value="Kyrgyz">Kyrgyz</option>
                                                            <option value="Laotian">Laotian</option>
                                                            <option value="Latvian">Latvian</option>
                                                            <option value="Lebanese">Lebanese</option>
                                                            <option value="Liberian">Liberian</option>
                                                            <option value="Libyan">Libyan</option>
                                                            <option value="Liechtensteiner">Liechtensteiner</option>
                                                            <option value="Lithuanian">Lithuanian</option>
                                                            <option value="Luxembourger">Luxembourger</option>
                                                            <option value="Macedonian">Macedonian</option>
                                                            <option value="Malagasy">Malagasy</option>
                                                            <option value="Malawian">Malawian</option>
                                                            <option value="Malaysian">Malaysian</option>
                                                            <option value="Maldivan">Maldivan</option>
                                                            <option value="Malian">Malian</option>
                                                            <option value="Maltese">Maltese</option>
                                                            <option value="Marshallese">Marshallese</option>
                                                            <option value="Mauritanian">Mauritanian</option>
                                                            <option value="Mauritian">Mauritian</option>
                                                            <option value="Mexican">Mexican</option>
                                                            <option value="Micronesian">Micronesian</option>
                                                            <option value="Moldovan">Moldovan</option>
                                                            <option value="Monacan">Monacan</option>
                                                            <option value="Mongolian">Mongolian</option>
                                                            <option value="Moroccan">Moroccan</option>
                                                            <option value="Mosotho">Mosotho</option>
                                                            <option value="Motswana">Motswana</option>
                                                            <option value="Mozambican">Mozambican</option>
                                                            <option value="Namibian">Namibian</option>
                                                            <option value="Nauruan">Nauruan</option>
                                                            <option value="Nepalese">Nepalese</option>
                                                            <option value="New zealander">New Zealander</option>
                                                            <option value="Ni-vanuatu">Ni-Vanuatu</option>
                                                            <option value="Nicaraguan">Nicaraguan</option>
                                                            <option value="Nigerien">Nigerien</option>
                                                            <option value="North korean">North Korean</option>
                                                            <option value="Northern irish">Northern Irish</option>
                                                            <option value="Norwegian">Norwegian</option>
                                                            <option value="Omani">Omani</option>
                                                            <option value="Pakistani">Pakistani</option>
                                                            <option value="Palauan">Palauan</option>
                                                            <option value="Panamanian">Panamanian</option>
                                                            <option value="Papua new guinean">Papua New Guinean</option>
                                                            <option value="Paraguayan">Paraguayan</option>
                                                            <option value="Peruvian">Peruvian</option>
                                                            <option value="Polish">Polish</option>
                                                            <option value="Portuguese">Portuguese</option>
                                                            <option value="Qatari">Qatari</option>
                                                            <option value="Romanian">Romanian</option>
                                                            <option value="Russian">Russian</option>
                                                            <option value="Rwandan">Rwandan</option>
                                                            <option value="Saint lucian">Saint Lucian</option>
                                                            <option value="Salvadoran">Salvadoran</option>
                                                            <option value="Samoan">Samoan</option>
                                                            <option value="San marinese">San Marinese</option>
                                                            <option value="Sao tomean">Sao Tomean</option>
                                                            <option value="Saudi">Saudi</option>
                                                            <option value="Scottish">Scottish</option>
                                                            <option value="Senegalese">Senegalese</option>
                                                            <option value="Serbian">Serbian</option>
                                                            <option value="Seychellois">Seychellois</option>
                                                            <option value="Sierra leonean">Sierra Leonean</option>
                                                            <option value="Singaporean">Singaporean</option>
                                                            <option value="Slovakian">Slovakian</option>
                                                            <option value="Slovenian">Slovenian</option>
                                                            <option value="Solomon islander">Solomon Islander</option>
                                                            <option value="Somali">Somali</option>
                                                            <option value="South african">South African</option>
                                                            <option value="South korean">South Korean</option>
                                                            <option value="Spanish">Spanish</option>
                                                            <option value="Sri lankan">Sri Lankan</option>
                                                            <option value="Sudanese">Sudanese</option>
                                                            <option value="Surinamer">Surinamer</option>
                                                            <option value="Swazi">Swazi</option>
                                                            <option value="Swedish">Swedish</option>
                                                            <option value="Swiss">Swiss</option>
                                                            <option value="Syrian">Syrian</option>
                                                            <option value="Taiwanese">Taiwanese</option>
                                                            <option value="Tajik">Tajik</option>
                                                            <option value="Tanzanian">Tanzanian</option>
                                                            <option value="Thai">Thai</option>
                                                            <option value="Togolese">Togolese</option>
                                                            <option value="Tongan">Tongan</option>
                                                            <option value="Trinidadian or tobagonian">Trinidadian or
                                                                Tobagonian
                                                            </option>
                                                            <option value="Tunisian">Tunisian</option>
                                                            <option value="Turkish">Turkish</option>
                                                            <option value="Tuvaluan">Tuvaluan</option>
                                                            <option value="Ugandan">Ugandan</option>
                                                            <option value="Ukrainian">Ukrainian</option>
                                                            <option value="Uruguayan">Uruguayan</option>
                                                            <option value="Uzbekistani">Uzbekistani</option>
                                                            <option value="Venezuelan">Venezuelan</option>
                                                            <option value="Vietnamese">Vietnamese</option>
                                                            <option value="Welsh">Welsh</option>
                                                            <option value="Yemenite">Yemenite</option>
                                                            <option value="Zambian">Zambian</option>
                                                            <option value="Zimbabwean">Zimbabwean</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end: Address -->

                                    <!-- begin: contact -->
                                    <div class="panel panel-primary" id="school_panel" name="school_panel">
                                        <div class="panel-heading ">Contact Details</div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <label>Home Number:</label>
                                                        <input type="text" value="" class="form-control "
                                                               name="admhomeno" id="admhomeno"
                                                               placeholder="Please enter your home phone number">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Cell Phone Number:</label>
                                                        <input type="text" value="" class="form-control "
                                                               name="admcellno" id="admcellno"
                                                               placeholder="Please enter your cell-phone number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <label>Alternative Contact Number:</label>
                                                        <input type="text" value="" class="form-control "
                                                               name="admaltno" id="admaltno"
                                                               placeholder="Please enter an alternative phone number">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label>Personal E-mail:</label>
                                                        <input type="text" value="" class="form-control " name="admmail"
                                                               id="admmail"
                                                               placeholder="Please enter your e-mail address">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end: contact -->

                                    <!--end personal details-->
                                    <!--end personal details panel-->


                                    <div class="panel panel-primary" id="school_panel" name="school_panel">
                                        <div class="panel-heading ">Employment Details</div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label>Work E-mail:</label>
                                                    <input type="text" value="" class="form-control " name="admwmail"
                                                           id="admwmail" placeholder="Please enter your e-mail address">
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Work Contact Number:</label>
                                                    <input type="text" value="" class="form-control " name='admworknum'
                                                           id='admworknum'
                                                           placeholder="Please enter the school you are employed at">
                                                </div>


                                                <div class="col-md-6 form-group">
                                                    <label>Staff Number:</label>
                                                    <input type="text" value="" class="form-control " name='admstaffnum'
                                                           id='admstaffnum'
                                                           placeholder="Please enter the school you are employed at">
                                                </div>


                                                <div class="col-md-6 form-group">
                                                    <label>Work Department:</label>
                                                    <input type="text" value="" class="form-control "
                                                           name="admworkdepart" id="admworkdepart"
                                                           placeholder="Please enter years of experience">
                                                </div>


                                                <div class="col-md-6 form-group">
                                                    <label>Work Position:</label>
                                                    <input type="text" value="" class="form-control " name="admworkpos"
                                                           id="admworkpos"
                                                           placeholder="Please enter the grade you are teaching">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-primary" id="school_panel" name="school_panel">
                                                <div class="panel-body">
                                                    <input type="submit" id="submit" name="submit" value="Submit"
                                                           class="btn btn-lg btn-primary push-bottom">

                                                    <p class="pull-right">Return to the <a
                                                            class="btn btn-lg btn-primary " href="index.php">login
                                                            page</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!--AJAX Login View + validation-->
                                <script type="text/JavaScript" src="/assets/ajax/profile/admin-submit.js"></script>

                                <!-- Hashing JS -->
                                <script type="text/JavaScript" src="/assets/ajax/shared/sha512.js"></script>
                                <script type="text/javascript">
                                    // When the document is ready
                                    $(document).ready(function () {

                                        $('#admindateofbirth .input-group.date').datepicker({
                                            format: "yyyy-mm-dd",
                                            startView: 2,
                                            calendarWeeks: true,
                                            autoclose: true,
                                            todayHighlight: true,
                                            endDate: "today"
                                        });
                                    });
                                </script>

                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $('#teacountry').multiselect({
                                            maxHeight: 300,
                                            enableCaseInsensitiveFiltering: true,
                                            numberDisplayed: 1
                                        });
                                    });
                                </script>
                            <?php }
                            } else if ($login['response'] == 'deny') { ?>
                                <script>
                                    window.location.href = "/deny.php";
                                </script>
                            <?php }else if ($login['response'] == 'success') { ?>
                                <div class="alert alert-info text-center" id="contactInfo">You are already logged in and
                                    you have completed your profile.<br> You will be redirected to your portal shortly.
                                </div>

                                <script>
                                    window.setTimeout(function () {
                                        window.location.href = "/portal/";
                                    }, 3000);
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
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Courses</a></li>
                        <li><a href="#">The Team</a></li>
                        <li><a href="#">Contact us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-details">
                    <h4>R.E.A.CH. Portal</h4>
                    <ul class="contact">
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">My Courses</a></li>
                        <li><a href="#">My Events</a></li>
                        <li><a href="#">My Grades</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-details">
                    <h4>Contact Us</h4>
                    <ul class="contact">
                        <li><p><i class="fa fa-map-marker"></i> <strong>Address:</strong> 144 Peter Road, Ruimsig, South
                                Africa 1714</p></li>
                        <li><p><i class="fa fa-phone"></i> <strong>Phone:</strong> 27 (11) 950-4000</p></li>
                        <li><p><i class="fa fa-envelope"></i> <strong>Email:</strong> <a
                                    href="mailto:inquiries@monash.ac.za">inquiries@monash.ac.za</a></p></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Monash South Africa Incorporated in Australia, External Non-Profit Company (Registration number
                        2005/009321/12), is a campus of Monash University, a public university, incorporated by an Act
                        of Parliament in Victoria, Australia.</p><br>

                    <p>Monash South Africa NPC is registered with the Department of Education as a private higher
                        education institution under the Higher Education Act of 1997. Registration number
                        2000/HE10/002.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
</body>
</html>
