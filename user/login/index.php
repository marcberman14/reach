<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$title = "Login";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
include($_SERVER['DOCUMENT_ROOT']."/assets/php/views/header-home-login.php");
?>
<div role="main" class="main push-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row featured-boxes login">
                        <div class="col-sm-12">
                            <div class="featured-box featured-box-secundary default info-content">
                                <div class="box-content" id="swag">
                                    <?php
                                    if ($login['response'] == 'error') { ?>

                                        <div class="alert alert-success hidden" id="contactSuccess">Success! You will be redirected shortly.</div>
                                        <div class="alert alert-danger hidden" id="contactError">Error!</div>

                                        <h1>Login</h1>
                                        <form action="/assets/includes/process_login.php" method="POST" name="loginform"
                                              id="loginform">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                    	<label>E-mail Address</label>
                                                        <div class="input-group input-group-icon">
                                                        <span class="input-group-addon">
                                                                <span class="icon"><i class="fa fa-envelope"></i></span>
                                                            </span>
                                                            <input type="text" value="" class="form-control input-lg"  name="email" id="email">
                                                            
                                                        </div>                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                	<div class="col-md-12">
                                                    	 <label>Password</label>
                                                        <div class="input-group input-group-icon">
                                                        <span class="input-group-addon">
                                                                <span class="icon"><i class="fa fa-lock"></i></span>
                                                            </span>
                                                            <input type="password" value="" class="form-control input-lg" id="password" name="password">
                                                            
                                                        </div>                                                       
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="submit" value="Login"
                                                           class="btn btn-lg btn-primary push-bottom" id="submit" name="submit">
                                                </div>
                                            </div>
                                        </form>
                                        <p>Don't have an account? <a href="/user/register/" class="btn btn-primary btn-lg">Register now!</a></p>
                                    <?php
                                    } else if ($login['response'] == 'warning') { ?>

                                        <div class="alert alert-warning" id="contactWarning">Warning! You are already logged in however, you are required to
                                            complete your profile before you can access the system.<br>
                                            You will be redirected shortly.
                                        </div>
                                        <script>
                                            window.setTimeout(function () {
                                                window.location.href = "/portal/profile/";
                                            }, 3000);
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
                                        </div>
                                        <script>
                                            window.setTimeout(function () {
                                                window.location.href = "/portal/";
                                            }, 3000);
                                        </script>

                                    <?php }  else if ($login['response'] == 'emailverify') { ?>
                                        <div class="alert alert-info" id="contactInfo">You are already logged in, However you are required to <strong>verify your email address</strong>.</div>

                                        <p id="paragraph">Please check your email for your verification link. If you have not received a verification link, please click on the button below and we will resend the email.</p>
                                        <div class="alert alert-success hidden" id="contactSuccess">Success!</div>
                                        <div class="alert alert-danger hidden" id="contactError"><strong>Error!</strong></div>
                                        <form action="/assets/php/processing/email-verify-resend.php" method="POST" name="emailverify" id="emailverify">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <input type="text" value="action" class="hidden"  name="action" id="action">
                                                        <input type="submit" value="Resend Verification Email" class="btn btn-lg btn-primary push-bottom" id="submit" name="submit">
                                                        </div>
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
include($_SERVER['DOCUMENT_ROOT']."/assets/php/views/footer-home.php");
echo $views->addScript(Array(
    "/assets/ajax/login/form-submit.js",
    "/assets/ajax/shared/sha512.js",
    "/assets/ajax/email/email-verify.js"));
?>

</body>
</html>
