<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/php/database/dao/SecurityDao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/php/classes/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/php/classes/Student.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/php/classes/Tutor.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/php/classes/Teacher.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/php/classes/Admin.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/View.php";


class Security
{

    public static function userActiveState()
    {
        if (isset($_SESSION['user_id'], $_SESSION['login_string'])) {
            $user_id = $_SESSION['user_id'];
            $login_string = $_SESSION['login_string'];
            // Get the user-agent string of the user.
            $user_browser = $_SERVER['HTTP_USER_AGENT'];
            $sec_login = new SecurityDao();
            $sec_data = $sec_login->userActive($user_id);
            if (count($sec_data) == 2) {
                // If the user exists get variables from result.
                $login_check = hash('sha512', $sec_data['password'] . $user_browser);
                if ($login_check == $login_string) {
                    if($sec_data['active'] == 'active'){
                        return $arrResult = array('response' => 'success', 'reason' => 'active');
                    } elseif ($sec_data['active'] == 'noprofile') {
                        $script = '<script>
                            window.location.href = "/portal/profile/";
                        </script>';
                        return $arrResult = array('response' => 'warning', 'script' => $script);

                    } elseif ($sec_data['active'] == 'notapproved') {
                        $script = '<script>
                            window.location.href = "/deny.php";
                        </script>';
                        return $arrResult = array('response' => 'warning', 'script' => $script);

                    } elseif ($sec_data['active'] == 'inactive') {
                        $script = '<script>
                            window.location.href = "/user/login/";
                        </script>';
                        return $arrResult = array('response' => 'warning', 'script' => $script);

                    } elseif ($sec_data['active'] == 'invalid') {
                        $script = '<script>
                            window.location.href = "/user/login/";
                        </script>';
                        return $arrResult = array('response' => 'warning', 'script' => $script);

                    } elseif ($sec_data['active'] == 'emailverify') {
                        $script = '<script>
                            window.location.href = "/user/check.php";
                        </script>';
                        return $arrResult = array('response' => 'warning', 'script' => $script);
                    }
                } else {
                    // Not logged in
                    return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
                }
            } else {
                // Not logged in
                return $arrResult = array('response' => 'error', 'reason' => 'An unknown error has occurred, please logout and try again.');
            }

        } else {
            // Not logged in
            return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
        }

    }

    public static function sec_session_start()
    {
        define("SECURE", false);
        $session_name = 'sec_session_id'; // Set a custom session name
        $secure = SECURE;
        // This stops JavaScript being able to access the session id.
        $httponly = true;
        // Forces sessions to only use cookies.
        if (ini_set('session.use_only_cookies', 1) === FALSE) {
            header("Location: /error.php?err=Could not initiate a safe session (ini_set)");
            exit();
        }
        // Gets current cookies params.
        $cookieParams = session_get_cookie_params();
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
        // Sets the session name to the one set above.
        session_name($session_name);
        session_start(); // Start the PHP session
        session_regenerate_id(); // regenerated the session, delete the old one.
    }

    public static function refreshUser($user_id)
    {
        $sec_login = new SecurityDao();
        $sec_data = $sec_login->userDetails($user_id);
        if ($sec_data['active'] == "active") {
            if ($sec_data['permission_name'] == "Student") {
                $sec_user = $sec_login->studentDetails(Array('userid' => $user_id));
                $member = new Student($sec_user['user_id'], $sec_user['studentId'], $sec_user['firstname'], $sec_user['lastname'], $sec_user['email'], $sec_user['active'], $sec_user['permission_name'], $sec_user['profilepicurl'], $sec_user['gender'],
                    $sec_user['streetnumber'], $sec_user['streetname'], $sec_user['suburb'], $sec_user['city'], $sec_user['country'], $sec_user['postalcode'],
                    $sec_user['homenumber'], $sec_user['cellnumber'], $sec_user['alternativenumber'], $sec_user['parentnumber'],
                    $sec_user['dob'], $sec_user['schoolname'], $sec_user['grade']);
            } else if ($sec_data['permission_name'] == "Tutor") {
                $sec_user = $sec_login->tutorDetails(Array('userid' => $user_id));
                $member = new Tutor($sec_user['user_id'], $sec_user['tutor_id'], $sec_user['firstname'], $sec_user['lastname'], $sec_user['email'], $sec_user['active'], $sec_user['permission_name'], $sec_user['profilepicurl'], $sec_user['gender'],
                    $sec_user['streetnumber'], $sec_user['streetname'], $sec_user['suburb'], $sec_user['city'], $sec_user['country'], $sec_user['postalcode'], $sec_user['nationality'], $sec_user['countryresidence'],
                    $sec_user['studyarea'], $sec_user['studyyear'], $sec_user['studentnumber'], $sec_user['personalemail'], $sec_user['monashemail'],
                    $sec_user['cellnumber'], $sec_user['alternativenumber'], $sec_user['dob']);
            } else if ($sec_data['permission_name'] == "Teacher") {
                $sec_user = $sec_login->teacherDetails(Array('userid' => $user_id));
                $member = new Teacher($sec_user['user_id'], $sec_user['teacherId'], $sec_user['firstname'], $sec_user['lastname'], $sec_user['email'], $sec_user['active'], $sec_user['permission_name'], $sec_user['profilepicurl'], $sec_user['gender'],
                    $sec_user['schoolemployed'], $sec_user['teachinggrade'], $sec_user['yearsexperience'], $sec_user['cellnumber'], $sec_user['alternativenumber'], $sec_user['personalemail'], $sec_user['dob'],
                    $sec_user['schooladdress'], $sec_user['schoolcontact'], $sec_user['streetnumber'], $sec_user['streetname'], $sec_user['suburb'], $sec_user['city'], $sec_user['country'], $sec_user['postalcode'],
                    $sec_user['subjectstaught']);

            } else if ($sec_data['permission_name'] == "Administrator") {
                $sec_user = $sec_login->adminDetails(Array('userid' => $user_id));
                $member = new Admin($sec_user['user_id'], $sec_user['adminId'], $sec_user['firstname'], $sec_user['lastname'], $sec_user['email'], $sec_user['active'], $sec_user['permission_name'], $sec_user['profilepicurl'], $sec_user['gender'],
                    $sec_user['dob'], $sec_user['streetnumber'], $sec_user['streetname'], $sec_user['suburb'], $sec_user['city'], $sec_user['country'], $sec_user['postalcode'],
                    $sec_user['homenumber'], $sec_user['cellphone'], $sec_user['worknumber'], $sec_user['staffnumber'], $sec_user['jobdepartment'],
                    $sec_user['jobposition'], $sec_user['monashmail'], $sec_user['alternativeemail'], $sec_user['altcontactnum']);
            }
        } else {
            $member = new User($sec_data['user_id'], $sec_data['firstname'], $sec_data['lastname'], $sec_data['email'], $sec_data['active'], $sec_data['permission_name'], $sec_data['profilepicurl'], $sec_data['gender']);
        }
        if($member != null){
            $_SESSION['user'] = $member;
            return Array('response'=>"success");
        } else {
            return Array('response'=>'error', 'reason'=>'Invalid user');
        }

    }

    public function login($email, $password)
    {
        $sec_login = new SecurityDao();
        $sec_data = $sec_login->loginSecurity($email);

        // hash the password with the unique salt.
        $password = hash('sha512', $password . $sec_data['salt']);
        if (count($sec_data) == 9) {
            // If the user exists we check if the account is locked
            // from too many login attempts
            $isLocked = $this->checkbrute($sec_data['user_id']);
            if ($isLocked['response'] != 'success') {
                return $isLocked;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($sec_data['password'] == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $sec_data['user_id']);
                    $_SESSION['user_id'] = $user_id;
                    if ($sec_data['active'] == "active") {
                        if ($sec_data['permission_name'] == "Student") {
                            $sec_user = $sec_login->studentDetails(Array('userid' => $user_id));
                            $member = new Student($sec_user['user_id'], $sec_user['studentId'], $sec_user['firstname'], $sec_user['lastname'], $sec_user['email'], $sec_user['active'], $sec_user['permission_name'], $sec_user['profilepicurl'], $sec_user['gender'],
                                $sec_user['streetnumber'], $sec_user['streetname'], $sec_user['suburb'], $sec_user['city'], $sec_user['country'], $sec_user['postalcode'],
                                $sec_user['homenumber'], $sec_user['cellnumber'], $sec_user['alternativenumber'], $sec_user['parentnumber'],
                                $sec_user['dob'], $sec_user['schoolname'], $sec_user['grade']);
                        } else if ($sec_data['permission_name'] == "Tutor") {
                            $sec_user = $sec_login->tutorDetails(Array('userid' => $user_id));
                            $member = new Tutor($sec_user['user_id'], $sec_user['tutor_id'], $sec_user['firstname'], $sec_user['lastname'], $sec_user['email'], $sec_user['active'], $sec_user['permission_name'], $sec_user['profilepicurl'], $sec_user['gender'],
                                $sec_user['streetnumber'], $sec_user['streetname'], $sec_user['suburb'], $sec_user['city'], $sec_user['country'], $sec_user['postalcode'], $sec_user['nationality'], $sec_user['countryresidence'],
                                $sec_user['studyarea'], $sec_user['studyyear'], $sec_user['studentnumber'], $sec_user['personalemail'], $sec_user['monashemail'],
                                $sec_user['cellnumber'], $sec_user['alternativenumber'], $sec_user['dob']);
                        } else if ($sec_data['permission_name'] == "Teacher") {
                            $sec_user = $sec_login->teacherDetails(Array('userid' => $user_id));
                            $member = new Teacher($sec_user['user_id'], $sec_user['teacherId'], $sec_user['firstname'], $sec_user['lastname'], $sec_user['email'], $sec_user['active'], $sec_user['permission_name'], $sec_user['profilepicurl'], $sec_user['gender'],
                                $sec_user['schoolemployed'], $sec_user['teachinggrade'], $sec_user['yearsexperience'], $sec_user['cellnumber'], $sec_user['alternativenumber'], $sec_user['personalemail'], $sec_user['dob'],
                                $sec_user['schooladdress'], $sec_user['schoolcontact'], $sec_user['streetnumber'], $sec_user['streetname'], $sec_user['suburb'], $sec_user['city'], $sec_user['country'], $sec_user['postalcode'],
                                $sec_user['subjectstaught']);

                        } else if ($sec_data['permission_name'] == "Administrator") {
                            $sec_user = $sec_login->adminDetails(Array('userid' => $user_id));
                            $member = new Admin($sec_user['user_id'], $sec_user['adminId'], $sec_user['firstname'], $sec_user['lastname'], $sec_user['email'], $sec_user['active'], $sec_user['permission_name'], $sec_user['profilepicurl'], $sec_user['gender'],
                                $sec_user['dob'], $sec_user['streetnumber'], $sec_user['streetname'], $sec_user['suburb'], $sec_user['city'], $sec_user['country'], $sec_user['postalcode'],
                                $sec_user['homenumber'], $sec_user['cellphone'], $sec_user['worknumber'], $sec_user['staffnumber'], $sec_user['jobdepartment'],
                                $sec_user['jobposition'], $sec_user['monashmail'], $sec_user['alternativeemail'], $sec_user['altcontactnum']);
                        }
                    } else if ($sec_data['active'] == "noprofile" || $sec_data['active'] == "notapproved" || $sec_data['active'] == "inactive" || $sec_data['active'] == "invalid" || $sec_data['active'] == "emailverify") {
                        $member = new User($sec_data['user_id'], $sec_data['firstname'], $sec_data['lastname'], $email, $sec_data['active'], $sec_data['permission_name'], $sec_data['profilepicurl'], $sec_data['gender']);
                    }
                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                    $_SESSION['user'] = $member;
                    // Login successful.
                    $ifFailed = $this->removeFailedLogin($user_id);
                    if ($ifFailed['response'] == 'success') {
                        return $arrResult = array('response' => 'success');
                    } else {
                        return $arrResult = array('response' => 'error', 'reason' => 'Invalid username or password, please try again. failed login');
                    }

                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    if ($sec_login->invalidLoginInsert($sec_data['user_id'], $now) == 0) {
                        return $arrResult = array('response' => 'error', 'reason' => 'Invalid username or password, please try again. login insert');
                        exit();
                    }
                    return $arrResult = array('response' => 'error', 'reason' => 'Invalid username or password, please try again. wrong password');
                }
            }
        } else {
            // No user exists.
            return $arrResult = array('response' => 'error', 'reason' => 'Invalid username or password, please try again. data pull');
            exit();
        }

    }

    public function register($firstname, $lastname, $email, $password, $usertype, $gender)
    {
        if (strlen($password) != 128) {
            // The hashed pwd should be 128 characters long.
            // If it's not, something really odd has happened
            return $arrResult = array('response' => 'error', 'reason' => 'A fatal error has occurred, if this problem persists please contact an administrator.');
            exit;
        }

        $sec_login = new SecurityDao();
        $sec_data = $sec_login->registerEmailCheck($email);
        if ($sec_data == true) {
            // A user with this email address already exists
            return $arrResult = array('response' => 'error', 'reason' => 'A user with this email address already exists.');
            exit;

        }
        // Create a random salt
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

        // Create salted password
        $password = hash('sha512', $password . $random_salt);

        /*if ($usertype != 1) {
            $active = "notapproved";
        } else {
            $active = "noprofile";
        }*/
        $active = "emailverify";
        $profilepic = "default.png";
        $values = Array("permissionid" => $usertype, "firstname" => $firstname, "lastname" => $lastname, "email" => $email, "password" => $password, "salt" => $random_salt, "active" => $active, "profilepicurl" => $profilepic, "gender" =>  $gender);
        // Insert the new user into the database
        $sec_insert = $sec_login->registerInsert($values);
        if ($sec_insert > 0 && $sec_insert != false) {
            $hash = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
            $sec_login->insertHash($email, $hash);
            $emailsent = $this->sendEmail($email, $hash);
            return $arrResult = array('response' => 'success', 'reason' => 'Please check your email address to activate your account.');
        } else {
            return $arrResult = array('response' => 'error', 'reason' => 'Registration failed, if this problem persists please contact an administrator.');
        }
    }

    public function checkbrute($user_id)
    {
        // Get timestamp of current time
        $now = time();
        $sec_login = new SecurityDao();
        $sec_data = $sec_login->checkBrute($user_id, $now);
        // If there have been more than 5 failed logins
        if (count($sec_data) > 0) {
            return $arrResult = array('response' => 'error', 'reason' => 'Account is locked. Please contact an administrator for assistance.');
        } else {
            return $arrResult = array('response' => 'success');
        }

    }

    function removeFailedLogin($user_id)
    {
        $sec_login = new SecurityDao();
        $sec_data = $sec_login->removeFailedLogin($user_id);
        if (count($sec_data) == 1) {
            return $arrResult = array('response' => 'success');
        } else {
            //could not prepare statement
            return $arrResult = array('response' => 'error', 'reason' => 'User cannot be found in the database.');
            exit();
        }

    }

    function login_check()
    {
        // Check if all session variables are set
        if (isset($_SESSION['user_id'], $_SESSION['login_string'])) {
            $user_id = $_SESSION['user_id'];
            $login_string = $_SESSION['login_string'];
            // Get the user-agent string of the user.
            $user_browser = $_SERVER['HTTP_USER_AGENT'];
            $sec_login = new SecurityDao();
            $sec_data = $sec_login->logincheck($user_id);
            if (count($sec_data) == 5) {
                // If the user exists get variables from result.
                $login_check = hash('sha512', $sec_data['password'] . $user_browser);
                if ($login_check == $login_string) {
                    if ($sec_data['active'] == 'noprofile') {
                        // Logged In with NO profile!
                        return $arrResult = array('response' => 'warning', 'reason' => 'You are required to complete your profile before you can use the system');
                    } elseif ($sec_data['active'] == 'notapproved') {
                        // Logged In but user not approved by admin!
                        return $arrResult = array('response' => 'deny', 'reason' => 'Your profile is pending approval. You will be notified by via email when your profile has been approved by the system administrator.');
                    }  elseif ($sec_data['active'] == 'active') {
                        // Logged In with profile!
                        return $arrResult = array('response' => 'success', 'reason' => 'You will be redirected to your portal shortly.');
                    }  elseif ($sec_data['active'] == 'emailverify') {
                        //Need to verify email
                        return $arrResult = array('response' => 'emailverify', 'reason' => 'You are required to verify your email before proceeding.');
                    }

                } else {
                    // Not logged in
                    return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
                }
            } else {
                // Not logged in
                return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
            }

        } else {
            // Not logged in
            return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
        }
    }

    function esc_url($url)
    {
        if ('' == $url) {
            return $url;
        }
        $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

        $strip = array('%0d', '%0a', '%0D', '%0A');
        $url = (string)$url;

        $count = 1;
        while ($count) {
            $url = str_replace($strip, '', $url, $count);
        }

        $url = str_replace(';//', '://', $url);
        $url = htmlentities($url);

        $url = str_replace('&amp;', '&#038;', $url);
        $url = str_replace("'", '&#039;', $url);
        if ($url[0] !== '/') {
            // We're only interested in relative links from $_SERVER['PHP_SELF']
            return '';
        } else {
            return $url;
        }
    }

    function getProfilePic()
    {
        if (isset($_SESSION['user_id'], $_SESSION['login_string'])) {
            $user_id = $_SESSION['user']->getUserID();

            $sec_login = new SecurityDao();
            $sec_data = $sec_login->profilePic($user_id);

            if (count($sec_data) == 1 && $sec_data != false) {
                // If the user exists get variables from result.
                return $arrResult = array('response' => 'success', 'url' => $sec_data['profilepicurl']);
            } else {
                //no profile exists
                return $arrResult = array('response' => 'error', 'url' => 'default.png');
            }
        } else {
            // Not logged in
            return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
        }
    }

    function getUserType()
    {
        if (isset($_SESSION['user_id'], $_SESSION['login_string'])) {
            $user_id = $_SESSION['user']->getUserID();
            $sec_login = new SecurityDao();
            $sec_data = $sec_login->userType($user_id);
            if (count($sec_data) == 1 && $sec_data != false) {
                // If the user exists get variables from result. 
                return $arrResult = array('response' => 'success', 'usertype' => $sec_data['permission_name']);
            } else {
                //no profile exists
                return $arrResult = array('response' => 'error', 'reason' => 'No profile exists');
            }
        } else {
            // Not logged in
            return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
        }
    }

    function tutorCount()
    {
        if (isset($_SESSION['user_id'], $_SESSION['login_string'])) {
            $permid = "2";
            $approved = "notapproved";
            $sec_login = new SecurityDao();
            $sec_data = $sec_login->approveCount(Array('permid' => $permid, 'approved' => $approved));

            if (count($sec_data == 1)) {
                // If the user exists get variables from result.
                return $sec_data['COUNT(m.user_id)'];
            } else {
                return "0";
            }
        } else {
            // Not logged in
            return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
        }

    }

    function teacherCount()
    {
        if (isset($_SESSION['user_id'], $_SESSION['login_string'])) {
            $permid = '3';
            $approved = "notapproved";
            $sec_login = new SecurityDao();
            $sec_data = $sec_login->approveCount(Array('permid' => $permid, 'approved' => $approved));

            if (count($sec_data == 1)) {
                // If the user exists get variables from result.
                return $sec_data['COUNT(m.user_id)'];
            } else {
                return "0";
            }
        } else {
            // Not logged in
            return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
        }

    }

    function adminCount()
    {
        if (isset($_SESSION['user_id'], $_SESSION['login_string'])) {
            $permid = '4';
            $approved = "notapproved";
            $sec_login = new SecurityDao();
            $sec_data = $sec_login->approveCount(Array('permid' => $permid, 'approved' => $approved));

            if (count($sec_data == 1)) {
                // If the user exists get variables from result.
                return $sec_data['COUNT(m.user_id)'];
            } else {
                return "0";
            }
        } else {
            // Not logged in
            return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
        }
    }

    function siteURL()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'].'/';
        return $protocol.$domainName;
    }

    function sendEmail($email,$hash)
    {
        $to      = $email; //Send email to our user
        $subject = 'Signup | Verification'; //// Give the email a subject
        $message = '
					Thanks for signing up!
					Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

					Please click this link to activate your account:
					'.$this->siteURL().'user/check.php?email='.$email.'&hash='.$hash.'

					If you have not registered to our website, then ignore this email.

					'; // Our message above including the link
        $headers = 'From:noreply@bermanz.co.za' . "\r\n"; // Set from headers
        return mail($to, $subject, $message, $headers); // Send the email


    }

    function resendEmail()
    {
        if (isset($_SESSION['user_id'], $_SESSION['login_string'])) {
            $user_id = $_SESSION['user']->getUserID();
            $email = $_SESSION['user']->getUseremail();
            $sec_login = new SecurityDao();
            $sec_data = $sec_login->getEmailHash($email, $user_id);

            if (count($sec_data) == 1 && $sec_data != false) {
                $this->sendEmail($email,$sec_data['hash']);
                // If the user exists get variables from result.
                return $arrResult = array('response' => 'success', 'reason' => "An email has been sent the email address you registered with. If you do not receive it, please check your junk mail before requesting a new email.");
            } else {
                //no profile exists
                return $arrResult = array('response' => 'error', 'reason' => 'Your email address could not be found in the system.');
            }
        } else {
            // Not logged in
            return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
        }

    }

} 