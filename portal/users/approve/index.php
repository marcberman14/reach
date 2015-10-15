<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";

$views = new View();
$security = new Security();
$security->sec_session_start();
//$state = $security->userActiveState();
$login = $security->login_check();
$title = "Approve Users";
$page_heading = "Approve users";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

//if($login['response'] != "error" && $state['response']['success']) {
if($login['response'] != "error") {
    $security->refreshUser($_SESSION['user_id']);
    include($_SERVER['DOCUMENT_ROOT'].$views->includeHeader($_SESSION['user']->getPermissionName()));

    include($_SERVER['DOCUMENT_ROOT'].$views->includeLeftNav($_SESSION['user']->getPermissionName()));
?>

        <!-- begin: breadcrumbs -->
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>User Management</h2>

                <div class="right-wrapper pull-right">
                    <ol class="breadcrumbs">
                        <li>
                            <a  class="sidebar-right-toggle" href="/portal/">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li><span>User</span></li>
                        <li><span>User Approval</span></li>
                    </ol>

                    <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                </div>
            </header>
            <!-- end: breadcrumbs -->

            <!-- start: page -->

            <div class="box-content">
                <section class="panel">
                    <header class="panel-heading">

                        <h2 class="panel-title">User Approval</h2>
                    </header>
                    <div class="panel-body">
                        <div class="alert alert-success hidden" id="contactSuccess">Your request has been successfully processed.
                        </div>
                        <div class="alert alert-warning hidden" id="contactLoading">Please wait while your request is being processed.
                        </div>
                        <div class="alert alert-danger hidden" id="contactError">Error!</div>

                        <form method="post" name="subcreateform" id="subcreateform">

                            <table class="table table-no-more table-bordered table-striped mb-none" id="members">
                                <thead>
                                <tr>
                                    <th width="5%">User ID</th>
                                    <th width="20%">First Name</th>
                                    <th width="20%">Last Name</th>
                                    <th width="20%">Email</th>
                                    <th width="10%">User Type</th>
                                    <th width="25%">Approve</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($stmt = "SELECT m.user_id, m.firstname, m.lastname, m.email, p.permission_name, m.active FROM members m join permission_group p
                                        ON m.permission_id = p.permission_id") {
                                    if ($result = $mysqli->query($stmt)) {

                                        //fetch associative array
                                        while ($row = $result->fetch_assoc() ){
                                            echo "<tr>";
                                            echo "<td data-title=\"User ID\" id=\"" . $row["user_id"] . "\">" . $row["user_id"] . "</td>";
                                            echo "<td data-title=\"First Name\">" . $row["firstname"] . "</td>";
                                            echo "<td data-title=\"Last Name\">" . $row["lastname"] . "</td>";
                                            echo "<td data-title=\"Email\">" . $row["email"] . "</td>";
                                            echo "<td data-title=\"User Type\">" . $row["permission_name"] . "</td>";
                                            echo "<td data-title=\"Approve\"><select class=\"form-control\" name=\"usertype\" id=\"".$row["user_id"]."\"onchange=\"autosave(this.id,$(this).val( ))\">";
                                            if($row["active"] == "active"){
                                                echo "<option selected value=\"active\">Activated</option>
                                                <option value=\"noprofile\">Approve - No Profile</option>
                                                <option value=\"notapproved\">Approval Pending</option>
                                                <option value=\"inactive\">Deactivated</option>
                                                <option value=\"invalid\">Deny User</option>";
                                            } elseif ($row["active"] == "inactive") {
                                                echo "
                                                <option value=\"active\">Activated</option>
                                                <option value=\"noprofile\">Approve - No Profile</option>
                                                <option value=\"notapproved\">Approval Pending</option>
                                                <option selected value=\"inactive\">Deactivated</option>
                                                <option value=\"invalid\">Deny User</option>";
                                            } elseif ($row["active"] == "noprofile") {
                                                echo "
                                                <option value=\"active\">Activated</option>
                                                <option selected value=\"noprofile\">Approve - No Profile</option>
                                                <option value=\"notapproved\">Approval Pending</option>
                                                <option value=\"inactive\">Deactivated</option>
                                                <option value=\"invalid\">Deny User</option>";
                                            } elseif ($row["active"] == "notapproved") {
                                                echo "
                                                <option value=\"active\">Activated</option>
                                                <option value=\"noprofile\">Approve - No Profile</option>
                                                <option selected value=\"notapproved\">Approval Pending</optionselected>
                                                <option value=\"inactive\">Deactivated</option>
                                                <option value=\"invalid\">Deny User</option>";
                                            } elseif ($row["active"] == "invalid") {
                                                echo "
                                                <option value=\"active\">Activated</option>
                                                <option value=\"noprofile\">Approve - No Profile</option>
                                                <option value=\"notapproved\">Approval Pending</option>
                                                <option value=\"inactive\">Deactivate</option>
                                                <option selected value=\"invalid\">Deny User</option>";
                                            }

                                            echo "</select></td>";
                                            ?>
                                            <?php
                                            echo "</tr>";
                                        }
                                    }
                                } else{
                                    echo "A Fatal error has occoured, Please try again or contact an administrator.";
                                }
                                ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </section>
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



<!-- Theme Base, Components and Settings -->
<script src="/assets/javascripts/theme.js"></script>

<!-- Theme Initialization Files -->
<script src="/assets/javascripts/theme.init.js"></script>

<script>
    function autosave(inputid,values) {
        console.log(inputid);
        console.log(values);
        var userdetails = {userid : inputid, active : values};

        $.ajax({
            url: '/assets/includes/user_activation.php',
            type: "POST",
            data: userdetails,

            beforeSend: function() {
                $('#contactLoading').removeClass('hidden');
                $('#contactSuccess').addClass('hidden');
                $('#contactError').addClass('hidden');

                if (($('#contactLoading').offset().top - 200) < $(window).scrollTop()) {
                    $('html, body').animate({
                        scrollTop: $('#contactLoading').offset().top - 200
                    }, 300);
                }

            },

            success: function(data) {

                if (data.response == 'success') {
                    $('#contactSuccess').removeClass('hidden');
                    $('#contactError').addClass('hidden');
                    $('#contactLoading').addClass('hidden');

                    $("#submit").prop('disabled', false); // disable button

                    if (($('#contactSuccess').offset().top - 200) < $(window).scrollTop()) {
                        $('html, body').animate({
                            scrollTop: $('#contactSuccess').offset().top - 200
                        }, 300);
                    }



                } else if (data.response == 'error') {
                    $('#contactError').html('Error! ' + data.reason);
                    $('#contactSuccess').addClass('hidden');
                    $('#contactError').removeClass('hidden');
                    $('#contactLoading').addClass('hidden');

                    if (($('#contactError').offset().top - 200) < $(window).scrollTop()) {
                        $('html, body').animate({
                            scrollTop: $('#contactError').offset().top - 200
                        }, 300);
                    }
                }
            }
        });
    }
</script>



</body>
</html>


