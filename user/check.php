<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$title = "Email Verification";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
include($_SERVER['DOCUMENT_ROOT'] . "/assets/php/views/header-home.php");
?>
<div role="main" class="main push-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row featured-boxes login">
                    <div class="col-sm-12">
                        <div class="featured-box featured-box-secundary default info-content">
                            <div class="box-content">
                                <?php
                                if ($login['response'] == 'emailverify' && isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])) {
                                    // Verify data
                                    $email = ($_GET['email']); // Set email variable
                                    $hash = ($_GET['hash']); // Set hash variable
                                    $emailer = new SecurityDao();
                                    $match = $emailer->verify($email, $hash);
                                    if ($match != false && $match >= 2) {
                                        $match = $emailer->updateMember($email, $hash);
                                        //verified
                                        ?>
                                        <div class="alert alert-success" id="contactSuccess">Thank your for verifying
                                            your email address, you will be redirected to setup your profile shortly.
                                        </div>
                                        <script>
                                            window.setTimeout(function () {
                                                window.location.href = "/portal/profile/";
                                            }, 3000);
                                        </script>
                                    <?php
                                    }else{ // No match -> invalid url or account has already been activated.
                                        ?>
                                        <div class="alert alert-danger" id="contactSuccess">Oops! Your account could not
                                            be verified, please contact an administrator.
                                        </div>
                                    <?php
                                    }
                                } elseif (isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])) {
                                    // Verify data
                                    $email = ($_GET['email']); // Set email variable
                                    $hash = ($_GET['hash']); // Set hash variable
                                    $emailer = new SecurityDao();
                                    $match = $emailer->verify($email, $hash);
                                    if ($match != false && $match >= 2) {
                                        $match = $emailer->updateMember($email, $hash);
                                        //verified
                                        ?>
                                        <div class="alert alert-success" id="contactSuccess">Thank your for verifying
                                            your email address, you will be redirected to setup your profile shortly.
                                        </div>
                                        <script>
                                            window.setTimeout(function () {
                                                window.location.href = "/portal/profile/";
                                            }, 3000);
                                        </script>
                                    <?php
                                    }else{ // No match -> invalid url or account has already been activated.
                                    ?>
                                        <div class="alert alert-danger" id="contactSuccess">Oops! Your account could not
                                            be verified, please contact an administrator.
                                        </div>
                                    <?php
                                    }
                                } elseif ($login['response'] == 'emailverify'){//Invalid approach ?>

                                    <div class="alert alert-info" id="contactInfo">You are already logged in, However
                                        you
                                        are required to <strong>verify your email address</strong>.
                                    </div>

                                    <p id="paragraph">Please check your email for your verification link. If you have
                                        not
                                        received a verification link, please click on the button below and we will
                                        resend
                                        the email.</p>

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
                                <?php
                                } elseif ($login['response'] == 'warning') { ?>

                                    <div class="alert alert-warning" id="contactWarning">Warning! You are already logged
                                        in
                                        however, you are required to
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

                                    <div class="alert alert-danger" id="contactWarning">You are already logged in
                                        however,
                                        for
                                        security reasons an admin is required to approve your profile before you can
                                        access
                                        the
                                        system.
                                    </div>

                                <?php
                                } else if ($login['response'] == 'success') { ?>
                                    <div class="alert alert-info" id="contactInfo">You are already logged in.<br> You
                                        will
                                        be redirected to your portal shortly.
                                    </div>
                                    <script>
                                        window.setTimeout(function () {
                                            window.location.href = "/portal/";
                                        }, 3000);
                                    </script>
                                    <?php
                                } else if ($login['response'] == 'error') { ?>
                                    <div class="alert alert-danger" id="contactInfo">You need to login in order to
                                        proceed.
                                    </div>
                                    <script>
                                        window.setTimeout(function () {
                                            window.location.href = "/user/login";
                                        }, 3000);
                                    </script>
                                    <?php
                                }
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
    "/assets/ajax/login/form-submit.js",
    "/assets/ajax/shared/sha512.js",
    "/assets/ajax/email/email-verify.js"));
?>

</body>
</html>