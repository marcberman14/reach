<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$active = $security->userActiveState();
$title = "Deny";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

var_dump(empty($_SESSION));
if(empty($_SESSION)){
    $security->refreshUser($_SESSION['user_id']);
}
include($_SERVER['DOCUMENT_ROOT']."/assets/php/views/header-home.php");
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
                                if ($active['response'] == 'error') { ?>


                                    <div class="alert alert-danger" id="contactWarning">You are not authorized to access this area, please log in to continue.<br>
                                        You will be redirected shortly to the login page shortly.

                                    </div>
                                    <script>
                                        window.setTimeout(function () {
                                            window.location.href = "/user/login/";
                                        }, 3000);
                                    </script>
                                <?php
                                } else if ($active['response'] == 'warning' && $active['active'] == 'noprofile') { ?>

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
                                } else if ($active['response'] == 'warning' && $active['active'] == 'notapproved') { ?>

                                    <div class="alert alert-danger" id="contactWarning">You are already logged in however, for security reasons an admin is required to approve your profile before you can access the system.
                                    </div>

                                <?php
                                } else if ($active['response'] == 'warning' && $active['active'] == 'inactive') { ?>

                                    <div class="alert alert-warning" id="contactWarning">Warning! You are already logged in however, you are required to
                                        complete your profile before you can access the system.<br>
                                        You will be redirected shortly.

                                    </div>
                                    <script>
                                        window.setTimeout(function () {
                                            window.location.href = "/user/login/";
                                        }, 3000);
                                    </script>

                                <?php
                                } else if ($active['response'] == 'warning' && $active['active'] == 'invalid') { ?>

                                    <div class="alert alert-warning" id="contactWarning">Warning! You are not authorised to access this system, please contact an administrator.<br>
                                        You will be logged out now!

                                    </div>
                                    <script>
                                        window.setTimeout(function () {
                                            window.location.href = "/assets/includes/logout.php";
                                        }, 3000);
                                    </script>

                                    <?php
                                }else if ($active['response'] == 'warning' && $active['active'] == 'emailverify') { ?>

                                    <div class="alert alert-warning" id="contactWarning">Warning! You are already logged in however, you are required to
                                        verify your email before you can access the system.<br>
                                        You will be redirected shortly.

                                    </div>
                                    <script>
                                        window.setTimeout(function () {
                                            window.location.href = "/user/check.php";
                                        }, 3000);
                                    </script>

                                <?php
                                }  else if ($login['response'] == 'success') { ?>
                                    <div class="alert alert-info" id="contactInfo">You are already logged in.<br> You will
                                        be redirected to your portal shortly.
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

<?php
include($_SERVER['DOCUMENT_ROOT']."/assets/php/views/footer-home.php");
?>


</body>
</html>