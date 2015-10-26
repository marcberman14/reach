<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";

$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$security->refreshUser($_SESSION['user_id']);
$title = "Users";
$page_heading = "User Details";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";


require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Member.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/UserDao.php";


$member = new UserDao();
$user = new Member();
$id = $_REQUEST['identity'];
$array = array("userid" => $id);
$profile;
$perm;
$more1 = $member->allTutors($array);
$more2 = $member->allTeachers($array);
$more3 = $member->allStudents($array);
if ($more1 != false) {
    $profile = $more1;
} elseif ($more2 != false) {
    $profile = $more2;
} elseif ($more3 != false) {
    $profile = $more3;
} else {
    $profile = false;
}

$user->pullUser($id);

$usertype = $_GET['type'];

if($usertype == "Teacher"){
	
	$perm = 3;
	
	}elseif($usertype == "Tutor"){
		
		$perm = 2;
		
	}elseif($usertype == "Student"){
		
		$perm = 1;
	}


if($login['response'] != "error") {
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
                            <a  class="sidebar-right-toggle" href="/portal">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li><span>Users</span></li>
                        <li><span>View Users</span></li>
                    </ol>

                    <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                </div>
            </header>
            <!-- end: breadcrumbs -->

            <!-- start: page -->
            <section class="panel">
                <header class="panel-heading">

                    <h2 class="panel-title"><?php echo $_REQUEST['name'];?>'s Profile View

                     
                    
                    
                   
		 &nbsp;<a href="../edit/index.php?id=<?php echo $_REQUEST['identity']; ?>&type=<?php echo $perm; ?>" class="on-default edit-row" title="Edit"><i class="fa fa-2x fa-pencil"></i></a>
        &nbsp;&nbsp;<a href="../delete/index.php?id=<?php echo $_REQUEST['identity']; ?>" class="on-default remove-row" title="Delete"><i class="fa fa-2x fa-trash-o"></i></a>


                    </h2>
                </header>
                
                <div class="panel-body">

                 <div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">First Name:</label>
                                <div class="col-sm-9">
                                                                         <?php  echo $user->getUserfirstname(); ?>


                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Last Name:</label>
                                <div class="col-sm-9">


                                  <?php  echo $user->getUserlastname(); ?>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Email:</label>
                                <div class="col-sm-9">


                                 <?php  echo $user->getUseremail(); ?>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Active:</label>
                                <div class="col-sm-9">

                                   <?php  echo $user->getUserActive(); ?>


                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Gender:</label>
                                <div class="col-sm-9">

                                 <?php  echo $user->getGender(); ?>


                                </div>
                            </div>




                                 <?php

                                     if($perm == 1 && $profile != false){

                                     echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Street Number:</label>
                                <div class="col-sm-9">

                                '.$profile['streetnumber'].'

                                </div>
                            </div>';


                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Street Name:</label>
                                <div class="col-sm-9">

                                '.$profile['streetname'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Suburb:</label>
                                <div class="col-sm-9">

                                '.$profile['suburb'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">City:</label>
                                <div class="col-sm-9">

                                '.$profile['city'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Country:</label>
                                <div class="col-sm-9">

                                '.$profile['country'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username"> Postal code:</label>
                                <div class="col-sm-9">

                                '.$profile['postalcode'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username"> Home number:</label>
                                <div class="col-sm-9">

                                '.$profile['homenumber'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username"> Cell number:</label>
                                <div class="col-sm-9">

                                '.$profile['cellnumber'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Alternative number:</label>
                                <div class="col-sm-9">

                                '.$profile['alternativenumber'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Parent number:</label>
                                <div class="col-sm-9">

                                '.$profile['parentnumber'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Date of Birth:</label>
                                <div class="col-sm-9">

                                '.$profile['dob'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">School name:</label>
                                <div class="col-sm-9">

                                '.$profile['schoolname'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Grade:</label>
                                <div class="col-sm-9">

                                '.$profile['grade'].'

                                </div>
                            </div>';

                                     }elseif($perm == 2 && $profile != false){

                                         echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Date of Birth:</label>
                                <div class="col-sm-9">

                                '.$profile['dob'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Cell number:</label>
                                <div class="col-sm-9">

                                '.$profile['cellnumber'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Alternative number:</label>
                                <div class="col-sm-9">

                                '.$profile['alternativenumber'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Street number:</label>
                                <div class="col-sm-9">

                                '.$profile['streetnumber'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Street name:</label>
                                <div class="col-sm-9">

                                '.$profile['streetname'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Suburb:</label>
                                <div class="col-sm-9">

                                '.$profile['suburb'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">City:</label>
                                <div class="col-sm-9">

                                '.$profile['city'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Country:</label>
                                <div class="col-sm-9">

                                '.$profile['country'].'

                                </div>
                            </div>';


                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Postal code:</label>
                                <div class="col-sm-9">

                                '.$profile['postalcode'].'

                                </div>
                            </div>';


                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">nationality:</label>
                                <div class="col-sm-9">

                                '.$profile['nationality'].'

                                </div>
                            </div>';


                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Country of residence:</label>
                                <div class="col-sm-9">

                                '.$profile['countryresidence'].'

                                </div>
                            </div>';


                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Study area:</label>
                                <div class="col-sm-9">

                                '.$profile['studyarea'].'

                                </div>
                            </div>';


                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Study year:</label>
                                <div class="col-sm-9">

                                '.$profile['studyyear'].'

                                </div>
                            </div>';


                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Student number:</label>
                                <div class="col-sm-9">

                                '.$profile['studentnumber'].'

                                </div>
                            </div>';







                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Monash email:</label>
                                <div class="col-sm-9">

                                '.$profile['monashemail'].'

                                </div>
                            </div>';


                                     }elseif ($perm == 3 && $profile != false){
										 
										 //var_dump($profile);

                                         echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">School employed:</label>
                                <div class="col-sm-9">

                                '.$profile['schoolemployed'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Teaching grade:</label>
                                <div class="col-sm-9">

                                '.$profile['teachinggrade'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Years of experience:</label>
                                <div class="col-sm-9">

                                '.$profile['yearsexperience'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Cell number:</label>
                                <div class="col-sm-9">

                                '.$profile['cellnumber'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Aternative number:</label>
                                <div class="col-sm-9">

                                '.$profile['alternativenumber'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Personal email:</label>
                                <div class="col-sm-9">

                                '.$profile['personalemail'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Date of Birth:</label>
                                <div class="col-sm-9">

                                '.$profile['dob'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">School Address:</label>
                                <div class="col-sm-9">

                                '.$profile['schooladdress'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">School contact:</label>
                                <div class="col-sm-9">

                                '.$profile['schoolcontact'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Street number:</label>
                                <div class="col-sm-9">

                                '.$profile['streetnumber'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Street name:</label>
                                <div class="col-sm-9">

                                '.$profile['streetname'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Suburb:</label>
                                <div class="col-sm-9">

                                '.$profile['suburb'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">City:</label>
                                <div class="col-sm-9">

                                '.$profile['city'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Country:</label>
                                <div class="col-sm-9">

                                '.$profile['country'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Postal code:</label>
                                <div class="col-sm-9">

                                '.$profile['postalcode'].'

                                </div>
                            </div>';

                            echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="w3-username">Subject taught:</label>
                                <div class="col-sm-9">

                                '.$profile['subjectstaught'].'

                                </div>
                            </div>';




                                     }?>


                </div>
            </section>

<form method="POST" action="../view/">
            <button class="btn btn-primary push-bottom">Return to Users</button>
            </form>


            <!-- end: page -->
        </section>



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


