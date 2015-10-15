<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$title = "Register";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
include($_SERVER['DOCUMENT_ROOT'] . "/assets/php/views/header-home-login.php");
?>
<div role="main" class="main push-top">

    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="row featured-boxes register">
                    <div class="col-sm-12">

                        <div class="featured-box featured-box-secundary default info-content">
                            <div class="box-content">

                                <?php
                                if ($login['response'] == 'error') { ?>
                                    <div class="alert alert-success hidden" id="contactSuccess">Success! You will be
                                        redirected shortly.
                                    </div>
                                    <div class="alert alert-danger hidden" id="contactError">Error!</div>
                                    <h1>Register:</h1>

                                    <form action="/assets/includes/process_register.php" method="post"
                                          name="registrationform" id="registrationform">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>First Name:</label>
                                                    <input type="text" value="" class="form-control input-lg"
                                                           name="firstname" id="firstname">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Surname/Family Name:</label>
                                                    <input type="text" value="" class="form-control input-lg"
                                                           name="surname" id="surname">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Gender:</label>

                                                    <select class="form-control input-lg" name="gender" id="gender">
                                                        <option value="">Select your gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Email Address:</label>
                                                    <input type="text" value="" class="form-control input-lg"
                                                           name="email" id="email">
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
                                                    <input type="password" value="" class="form-control input-lg"
                                                           name="password" id="password">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Confirm password:</label>
                                                    <input type="password" value="" class="form-control input-lg"
                                                           name="confirmpwd" id="confirmpwd">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="submit" id="submit" name="submit" value="Register"
                                                       class="btn btn-lg btn-primary push-bottom">
                                            </div>
                                        </div>
                                    </form>
                                    <p>Already have an account? <a href="/user/login/" class="btn btn-primary btn-lg">Login
                                            now!</a></p>
                                <?php
                                } else if ($login['response'] == 'warning') { ?>

                                    <div class="alert alert-warning" id="contactWarning">Warning! You are required to
                                        complete your profile before you can access the system.<br>
                                        You will be redirected shortly.<br><br>
                                        Alternatively, you can log out and switch user? <a
                                            href="/assets/includes/logout.php" class="btn btn-primary btn-lg">Log
                                            out</a>

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
                                    <div class="alert alert-info" id="contactInfo">You are already logged in.<br> You
                                        will
                                        be redirected to your portal shortly.
                                        <br><br>
                                        Alternatively, you can log out and switch user? <a
                                            href="/assets/includes/logout.php" class="btn btn-primary btn-lg">Log
                                            out</a>
                                    </div>
                                    <script>
                                        window.setTimeout(function () {
                                            window.location.href = "/portal/";
                                        }, 5000);
                                    </script>

                                <?php }  else if ($login['response'] == 'emailverify') { ?>
                                    <div class="alert alert-info" id="contactInfo">You are already logged in, However
                                        you are required to <strong>verify your email address</strong>.
                                    </div>

                                    <p id="paragraph">Please check your email for your verification link. If you have
                                        not received a verification link, please click on the button below and we will
                                        resend the email.</p>
                                    <div class="alert alert-success hidden" id="contactSuccess">Success!</div>
                                    <div class="alert alert-danger hidden" id="contactError"><strong>Error!</strong>
                                    </div>
                                    <form action="/assets/php/processing/email-verify-resend.php" method="POST"
                                          name="emailverify" id="emailverify">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input type="text" value="action" class="hidden" name="action"
                                                           id="action">
                                                    <input type="submit" value="Resend Verification Email"
                                                           class="btn btn-lg btn-primary push-bottom" id="submit"
                                                           name="submit">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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

<?php
include($_SERVER['DOCUMENT_ROOT'] . "/assets/php/views/footer-home.php");
echo $views->addScript(Array(
    "/assets/ajax/register/form-submit.js",
    "/assets/ajax/shared/sha512.js",
    "/assets/ajax/email/email-verify.js"));
?>
</body>
</html>

