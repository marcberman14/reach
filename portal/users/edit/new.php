<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";

$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$state = $security->userActiveState();
$title = "User Management";
$page_heading = "Edit User";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";

if($login['response'] != "error" && $state['response']== 'success') {
$security->refreshUser($_SESSION['user_id']);

if($state['response']== 'warning'){
    echo $state['script'];
}

include($_SERVER['DOCUMENT_ROOT'].$views->includeHeader($_SESSION['user']->getPermissionName()));
include($_SERVER['DOCUMENT_ROOT'].$views->includeLeftNav($_SESSION['user']->getPermissionName()));



require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Member.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";

$member = new UserDao();

$user = new Member();
if (isset($_GET['id']) && isset($_GET['type'])) {
    $identity = $_GET['id'];
    $type = $_GET['type'];
}else{
    ?>
    <script>
        window.location.href = "/portal/users/view/";
    </script>
    <?php
}



$array = array("userid"=>$identity);

$profile;
$more1=$member->allTutors($array);
$more2=$member->allTeachers($array);
$more3=$member->allStudents($array);
if($more1!=false){
    $profile = $more1;
}elseif($more2!=false){
    $profile = $more2;
}elseif($more3!=false){
    $profile = $more3;
}else{
    $profile = false;
}

$user->pullUser($identity);
$permis = $user->getPermissionId();

include($_SERVER['DOCUMENT_ROOT'].$views->user_edit($_SESSION['user']->getPermissionName()));
?>

        </div>
    </section>
<?php
echo $views->addScript(Array(
    "/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js",
    "/assets/vendor/bootstrap/js/bootstrap.js",
    "/assets/vendor/nanoscroller/nanoscroller.js",
    "/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js",
    "/assets/vendor/magnific-popup/magnific-popup.js",
    "/assets/vendor/jquery-placeholder/jquery.placeholder.js",
    "/assets/vendor/modernizr/modernizr.js",
    "/assets/javascripts/theme.js",
    "/assets/javascripts/theme.init.js"));
    }else {
        ?>
        <script>
            window.location.href = "/user/login/";
        </script>
    <?php
    }
?>


</body>
</html>


