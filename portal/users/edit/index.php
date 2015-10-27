<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";

$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$state = $security->userActiveState();
$title = "User Managament";
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

$user->pullUser($identity);
$permis = $user->getPermissionId();

if($permis == 1){
    $profile=$member->allStudents($array);
} elseif($permis == 2){
    $profile = $member->allTutors($array);
}elseif($permis == 3){
    $profile=$member->allTeachers($array);
}elseif($permis == 4){
   //for admin
}


 if($permis == 1) {
    if($user->getUserActive() == "noprofile") {
        $formname =  "studentformnoprofile";
    } else {
        echo "studentform";
    }
 } elseif($permis == 2){
    if($user->getUserActive() == "noprofile") {
        $formname =  "tutorformnoprofile";
    } else {
        $formname =  "tutorform";
    }
 }
 else if($permis == 3) {
    if($user->getUserActive() == "noprofile") {
        $formname =  "teacherformnoprofile";
    } else {
        $formname =  "teacherform";
    }
 }
 else if($permis == 4) {
    if($user->getUserActive() == "noprofile") {
        $formname = "adminformnoprofile";
    } else {
        $formname = "adminform";
    }
 }

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
                    <p><h2 class="panel-title">Profile Edit &nbsp;<a href="../edit/index.php?id=<?php echo $identity; ?>&type=<?php echo $type; ?>" class="on-default edit-row" title="Edit"><i class="fa fa-2x fa-history"></i></a></h2></p>

                    </header>



                    <form action="/assets/includes/process_useredit.php?id=<?php echo $identity; ?>&type=<?php echo $type; ?>" method="POST" id="<?php echo $formname; ?>" name="<?php echo $formname; ?>">

                    <div class="panel-body">

                     <div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-firstname">First Name:</label>
                                    <div class="col-sm-9">

                                    <input type="text"class="form-control" name="firstname" id="firstname" value="<?php  echo $user->getUserfirstname(); ?>">


                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-surname">Last Name:</label>
                                    <div class="col-sm-9">

                                        <input type="text"class="form-control" name="surname" id="surname" value="<?php  echo $user->getUserlastname(); ?>">




                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-email">Email:</label>
                                    <div class="col-sm-9">


                                        <input type="text"class="form-control" name="email" id="email" value="<?php  echo $user->getUseremail(); ?>">



                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-active">Active:</label>
                                    <div class="col-sm-9">

                                    <?php

									if($user->getUserActive() == "active"){
                                                    echo '<select class="form-control input" name="active" id="active">
													<option selected value="active">Activated</option>
                                                    <option value="noprofile">Approve - No Profile</option>
                                                    <option value="notapproved">Approval Pending</option>
                                                    <option value="inactive">Deactivated</option>
                                                    <option value="invalid">Deny User</option> </select>';
                                                } elseif ($user->getUserActive()== "inactive") {
                                                    echo '<select class="form-control input" name="active" id="active">
                                                    <option value="active">Activated</option>
                                                    <option value="noprofile">Approve - No Profile</option>
                                                    <option value="notapproved">Approval Pending</option>
                                                    <option selected value="inactive">Deactivated</option>
                                                    <option value="invalid">Deny User</option>
													</select>';
                                                } elseif ($user->getUserActive() == "noprofile") {
                                                    echo '<select class="form-control input" name="active" id="active">
                                                    <option value="active">Activated</option>
                                                    <option selected value="noprofile">Approve - No Profile</option>
                                                    <option value="notapproved">Approval Pending</option>
                                                    <option value="inactive">Deactivated</option>
                                                    <option value="invalid">Deny User</option>
													</select>';
                                                } elseif ($user->getUserActive() == "notapproved") {
                                                    echo '<select class="form-control input" name="active" id="active">
                                                    <option value="active">Activated</option>
                                                    <option value="noprofile">Approve - No Profile</option>
                                                    <option selected value="notapproved">Approval Pending</optionselected>
                                                    <option value="inactive">Deactivated</option>
                                                    <option value="invalid">Deny User</option>
													</select>';
                                                } elseif ($user->getUserActive() == "invalid") {
                                                    echo ' <select class="form-control input" name="active" id="active">
                                                    <option value="active">Activated</option>
                                                    <option value="noprofile">Approve - No Profile</option>
                                                    <option value="notapproved">Approval Pending</option>
                                                    <option value="inactive">Deactivate</option>
                                                    <option selected value="invalid">Deny User</option>
													</select>';
                                                }else {
                                                    echo ' <select class="form-control input" name="active" id="active">
                                                    <option value="active">Activated</option>
                                                    <option value="noprofile">Approve - No Profile</option>
                                                    <option value="notapproved">Approval Pending</option>
                                                    <option value="inactive">Deactivate</option>
                                                    <option selected value="invalid">Deny User</option>
													</select>';
                                                }
									 ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-gender">Gender:</label>
                                    <div class="col-sm-9">
									<?php
												if($user->getGender() == 'Female'){
                                                    echo '<select class="form-control input" name="gender" id="gender">
													<option value="Female">Female</option>
													<option value="Male">Male</option>

													 </select>';
                                                } elseif ($user->getGender() == 'Male') {

													echo '<select class="form-control input" name="gender" id="gender">
													<option value="Male">Male</option>
													<option value="Female">Female</option>

													 </select>';
												}else{

													echo '<select class="form-control input" name="gender" id="gender">
													<option value="Male">Male</option>
													<option value="Female">Female</option>

													 </select>';
												}
                                   ?>
                                    </div>
                                </div>

                                <?php
                                if($permis == 1 && $profile != false){

										 echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-stustreetno">Street Number:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="stustreetno" id="stustreetno" value="'.$profile['streetnumber'].'">



                                    </div>
                                </div>';


								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-stustreetname">Street Name:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="stustreetname" id="stustreetname" value="'.$profile['streetname'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-stusuburb">Suburb:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="stusuburb" id="stusuburb" value="'.$profile['suburb'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-stucity">City:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="stucity" id="stucity" value="'.$profile['city'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-stucountry">Country:</label>
                                    <div class="col-sm-9">

									<select class="form-control" data-plugin-multiselect
                                                                            data-plugin-options=\'{ "enableCaseInsensitiveFiltering": true }\'
                                                                            name="stucountry" id="stucountry">
                                                                        <option value="'.$profile['country'].'">'.$profile['country'].'</option>
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
                                                                        <option value="Cote D\'ivoire">Cote D\'ivoire
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
                                                                            value="Korea, Democratic People\'s Republic of">
                                                                            Korea, Democratic People\'s Republic of
                                                                        </option>
                                                                        <option value="Korea, Republic of">Korea,
                                                                            Republic of
                                                                        </option>
                                                                        <option value="Kuwait">Kuwait</option>
                                                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                                        <option
                                                                            value="Lao People\'s Democratic Republic">Lao
                                                                            People\'s Democratic Republic
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
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-stupostcode"> Postal code:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="stupostcode" id="stupostcode" value="'.$profile['postalcode'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-stuhomeno"> Home number:</label>
                                    <div class="col-sm-9">


												  <input type="text"class="form-control" name="stuhomeno" id="stuhomeno" value="'.$profile['homenumber'].'">


                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-stucellno"> Cell number:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="stucellno" id="stucellno" value="'.$profile['cellnumber'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-stualtno">Alternative number:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="stualtno" id="stualtno" value="'.$profile['alternativenumber'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-stuparentno">Parent number:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="stuparentno" id="stuparentno" value="'.$profile['parentnumber'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-studob">Date of Birth:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="studob" id="studob" value="'.$profile['dob'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-stuschoolname">School name:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="stuschoolname" id="stuschoolname" value="'.$profile['schoolname'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-stugrade">Grade:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="stugrade" id="stugrade" value="'.$profile['grade'].'">



                                    </div>
                                </div>';

										 }elseif($permis == 2 && $profile != false){

											 echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-dob">Date of Birth:</label>
                                    <div class="col-sm-9">



									<input type="text"class="form-control" name="dob" id="dob" value="'.$profile['dob'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-tutcellno">Cell number:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="tutcellno" id="tutcellno" value="'.$profile['cellnumber'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-tutaltno">Alternative number:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="tutaltno" id="tutaltno" value="'.$profile['alternativenumber'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-tutstreetno">Street number:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="tutstreetno" id="tutstreetno" value="'.$profile['streetnumber'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-tutstreetname">Street name:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="tutstreetname" id="tutstreetname" value="'.$profile['streetname'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-tutsuburb">Suburb:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="tutsuburb" id="tutsuburb" value="'.$profile['suburb'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-tutcity">City:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="tutcity" id="tutcity" value="'.$profile['city'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-tutcountry">Country:</label>
                                    <div class="col-sm-9">


									<select class="form-control" data-plugin-multiselect
                                                                            data-plugin-options=\'{ "enableCaseInsensitiveFiltering": true }\'
                                                                            name="tutcountry" id="tutcountry">
                                                                        <option value="'.$profile['country'].'">'.$profile['country'].'</option>
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
                                                                        <option value="Cote D\'ivoire">Cote D\'ivoire
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
                                                                            value="Korea, Democratic People\'s Republic of">
                                                                            Korea, Democratic People\'s Republic of
                                                                        </option>
                                                                        <option value="Korea, Republic of">Korea,
                                                                            Republic of
                                                                        </option>
                                                                        <option value="Kuwait">Kuwait</option>
                                                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                                        <option
                                                                            value="Lao People\'s Democratic Republic">Lao
                                                                            People\'s Democratic Republic
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
                                </div>';


								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-tutpostcode">Postal code:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="tutpostcode" id="tutpostcode" value="'.$profile['postalcode'].'">



                                    </div>
                                </div>';


								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-tutnationality">Nationality:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="tutnationality" id="tutnationality" value="'.$profile['nationality'].'">



                                    </div>
                                </div>';


								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-tutcountryofres">Country of residence:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="tutcountryofres" id="tutcountryofres" value="'.$profile['countryresidence'].'">



                                    </div>
                                </div>';


								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-tutsarea">Study area:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="tutsarea" id="tutsarea" value="'.$profile['studyarea'].'">



                                    </div>
                                </div>';


								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-tutsyear">Study year:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="tutsyear" id="tutsyear" value="'.$profile['studyyear'].'">



                                    </div>
                                </div>';


								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-tutstudentnumber">Student number:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="tutstudentnumber" id="tutstudentnumber" value="'.$profile['studentnumber'].'">



                                    </div>
                                </div>';



								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-tutmonashemail">Monash email:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="tutmonashemail" id="tutmonashemail" value="'.$profile['monashemail'].'">



                                    </div>
                                </div>';


										 }elseif ($permis == 3 && $profile != false){

											 echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teaschoolemp">School employed:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="teaschoolemp" id="teaschoolemp" value="'.$profile['schoolemployed'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teagradtaught">Teaching grade:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="teagradtaught" id="teagradtaught" value="'.$profile['teachinggrade'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teayearsofexperience">Years of experience:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="teayearsofexperience" id="teayearsofexperience" value="'.$profile['yearsexperience'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teacellno">Cell number:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="teacellno" id="teacellno" value="'.$profile['cellnumber'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teaaltno">Aternative number:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="teaaltno" id="teaaltno" value="'.$profile['alternativenumber'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teapersonalemail">Personal email:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="teapersonalemail" id="teapersonalemail" value="'.$profile['personalemail'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-dob">Date of Birth:</label>
                                    <div class="col-sm-9">



									<input type="text"class="form-control" name="dob" id="dob" value="'.$profile['dob'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teaschooladdress">School Address:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="teaschooladdress" id="teaschooladdress" value="'.$profile['schooladdress'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teaschoolcontact">School contact:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="teaschoolcontact" id="teaschoolcontact" value="'.$profile['schoolcontact'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teastreetno">Street number:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="teastreetno" id="teastreetno" value="'.$profile['streetnumber'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teastreetname">Street name:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="teastreetname" id="teastreetname" value="'.$profile['streetname'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teasuburb">Suburb:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="teasuburb" id="teasuburb" value="'.$profile['suburb'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teacity">City:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="teacity" id="teacity" value="'.$profile['city'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teacountry">Country:</label>
                                    <div class="col-sm-9">


									<select class="form-control" data-plugin-multiselect
                                                                            data-plugin-options=\'{ "enableCaseInsensitiveFiltering": true }\'
                                                                            name="teacountry" id="teacountry">
                                                                        <option value="'.$profile['country'].'">'.$profile['country'].'</option>
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
                                                                        <option value="Cote D\'ivoire">Cote D\'ivoire
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
                                                                            value="Korea, Democratic People\'s Republic of">
                                                                            Korea, Democratic People\'s Republic of
                                                                        </option>
                                                                        <option value="Korea, Republic of">Korea,
                                                                            Republic of
                                                                        </option>
                                                                        <option value="Kuwait">Kuwait</option>
                                                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                                        <option
                                                                            value="Lao People\'s Democratic Republic">Lao
                                                                            People\'s Democratic Republic
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
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teapostcode">Postal code:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="teapostcode" id="teapostcode" value="'.$profile['postalcode'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teasubtaught">Subject taught:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="teasubtaught" id="teasubtaught" value="'.$profile['subjectstaught'].'">



                                    </div>
                                </div>';

										 } elseif ($permis == 4 && $profile != false){

											 echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teaschoolemp">Date of Birth:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="dob" id="dob" value="'.$profile['dob'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teagradtaught">Street Number:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="adminstreetnumber" id="adminstreetnumber" value="'.$profile['streetnumber'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teayearsofexperience">Street Name:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="adminstreetname" id="adminstreetname" value="'.$profile['streetname'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teacellno">Suburb:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="adminsuburb" id="teacellno" value="'.$profile['suburb'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teaaltno">City:</label>
                                    <div class="col-sm-9">
									<input type="text"class="form-control" name="admincity" id="admincity" value="'.$profile['city'].'">
                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teacountry">Country:</label>
                                    <div class="col-sm-9">
									<select class="form-control" data-plugin-multiselect
                                                                            data-plugin-options=\'{ "enableCaseInsensitiveFiltering": true }\'
                                                                            name="admincountry" id="admincountry">
                                                                        <option value="'.$profile['country'].'">'.$profile['country'].'</option>
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
                                                                        <option value="Cote D\'ivoire">Cote D\'ivoire
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
                                                                            value="Korea, Democratic People\'s Republic of">
                                                                            Korea, Democratic People\'s Republic of
                                                                        </option>
                                                                        <option value="Korea, Republic of">Korea,
                                                                            Republic of
                                                                        </option>
                                                                        <option value="Kuwait">Kuwait</option>
                                                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                                        <option
                                                                            value="Lao People\'s Democratic Republic">Lao
                                                                            People\'s Democratic Republic
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
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-dob">Date of Birth:</label>
                                    <div class="col-sm-9">



									<input type="text"class="form-control" name="dob" id="dob" value="'.$profile['dob'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teaschooladdress">School Address:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="teaschooladdress" id="teaschooladdress" value="'.$profile['schooladdress'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teaschoolcontact">School contact:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="teaschoolcontact" id="teaschoolcontact" value="'.$profile['schoolcontact'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teastreetno">Street number:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="teastreetno" id="teastreetno" value="'.$profile['streetnumber'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teastreetname">Street name:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="teastreetname" id="teastreetname" value="'.$profile['streetname'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teasuburb">Suburb:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="teasuburb" id="teasuburb" value="'.$profile['suburb'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teacity">City:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="teacity" id="teacity" value="'.$profile['city'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teacountry">Country:</label>
                                    <div class="col-sm-9">
									<select class="form-control" data-plugin-multiselect
                                                                            data-plugin-options=\'{ "enableCaseInsensitiveFiltering": true }\'
                                                                            name="teacountry" id="teacountry">
                                                                        <option value="'.$profile['country'].'">'.$profile['country'].'</option>
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
                                                                        <option value="Cote D\'ivoire">Cote D\'ivoire
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
                                                                            value="Korea, Democratic People\'s Republic of">
                                                                            Korea, Democratic People\'s Republic of
                                                                        </option>
                                                                        <option value="Korea, Republic of">Korea,
                                                                            Republic of
                                                                        </option>
                                                                        <option value="Kuwait">Kuwait</option>
                                                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                                        <option
                                                                            value="Lao People\'s Democratic Republic">Lao
                                                                            People\'s Democratic Republic
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
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teapostcode">Postal code:</label>
                                    <div class="col-sm-9">


									<input type="text"class="form-control" name="teapostcode" id="teapostcode" value="'.$profile['postalcode'].'">



                                    </div>
                                </div>';

								echo '<div class="form-group">
                                    <label class="col-sm-3 control-label" for="w3-teasubtaught">Subject taught:</label>
                                    <div class="col-sm-9">

									<input type="text"class="form-control" name="teasubtaught" id="teasubtaught" value="'.$profile['subjectstaught'].'">



                                    </div>
                                </div>';

										 } ?>
                                <input type="submit" id="submit" name="submit" value="Edit" class="btn btn-primary push-bottom"> <a href="../view/" class="btn btn-primary push-bottom">Return to Users</a>
                    </div>
                </form>


                </section>


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


