<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/php/database/dao/SecurityDao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/php/classes/User.php';

class Security
{
    public static function sec_session_start()
    {
        $session_name = 'sec_session_id';   // Set a custom session name
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
        session_start();            // Start the PHP session
        session_regenerate_id();    // regenerated the session, delete the old one.
    }

    public function login($email, $password)
    {
        $sec_login = new SecurityDao();
        $sec_data = $sec_login->loginSecurity($email);

        // hash the password with the unique salt.
        $password = hash('sha512', $password . $sec_data['salt']);
        if (count($sec_data) == 7) {
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
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    $member = new User($sec_data['user_id'], $sec_data['firstname'], $sec_data['lastname'], $email, $sec_data['active'], $sec_data['permission_name']);
                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                    $_SESSION['user'] = $member;

                    // Login successful.
                    $ifFailed = $this->removeFailedLogin($user_id);
                    if ($ifFailed['response'] == 'success') {
                        return $arrResult = array('response' => 'success', 'usertype' => $sec_data['permission_name'], 'active' => $sec_data['active'], $member);
                    } else {
                        return $arrResult = array('response' => 'error', 'reason' => 'Invalid username or password, please try again.');
                    }

                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    if ($sec_login->invalidLoginInsert($sec_data['user_id']) == 0) {
                        return $arrResult = array('response' => 'error', 'reason' => 'Invalid username or password, please try again.');
                        exit();
                    }
                    return $arrResult = array('response' => 'error', 'reason' => 'Invalid username or password, please try again.');
                }
            }
        } else {
            // No user exists.
            return $arrResult = array('response' => 'error', 'reason' => 'Invalid username or password, please try again.');
            exit();
        }

    }

    public function register($firstname, $lastname, $email, $password, $usertype){
            // Sanitize and validate the data passed in

            if (strlen($password) != 128) {
                // The hashed pwd should be 128 characters long.
                // If it's not, something really odd has happened
                return $arrResult = array ('response'=>'error','reason'=>'A fatal error has occurred, if this problem persists please contact an administrator.');
            }

            $sec_login = new SecurityDao();
            $sec_data = $sec_login->registerEmailCheck($email);


            if (count($sec_data) == 1) {
                // A user with this email address already exists
                return $arrResult = array ('response'=>'error','reason'=>'A user with this email address already exists.');
            }


            if (empty($arrResult)) {
                // Create a random salt
                //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
                $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

                // Create salted password
                $password = hash('sha512', $password . $random_salt);

                if($usertype != 1){
                    $active = "notapproved";
                } else {
                    $active = "noprofile";
                }
                $profilepic = "default.png";
                $values = Array("permissionid"=>$usertype, "firstname"=>$firstname, "lastname"=>$lastname, "email"=>$email, "password"=>$password, "salt"=>$random_salt, "active"=>$active, "profilepicurl"=>$profilepic);
                // Insert the new user into the database
                $sec_insert = $sec_login->registerInsert($values);
                    if ($sec_insert > 0) {
                        return $arrResult = array ('response'=>'success');
                    } else {
                        return $arrResult = array ('response'=>'error','reason'=>'"Registration failed, if this problem persists please contact an administrator.');
                    }


            }else {
                return $arrResult = array ('response'=>'error','reason'=>'A fatal error has occurred, if this problem persists please contact an administrator.');
            }
    }


    public function checkbrute($user_id)
    {
        // Get timestamp of current time
        $now = time();
        // All login attempts are counted from the past 2 hours.
        $valid_attempts = $now - (2 * 60 * 60);
        $sec_login = new SecurityDao();
        $sec_data = $sec_login->logincheck($user_id);
        // If there have been more than 5 failed logins
        if (count($sec_data) > 5) {
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

            // Get timestamp of current time
            $now = time();
            // All login attempts are counted from the past 2 hours.
            $valid_attempts = $now - (2 * 60 * 60);

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
        if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
            $user_id = $_SESSION['user_id'];
            $login_string = $_SESSION['login_string'];
            // Get the user-agent string of the user.
            $user_browser = $_SERVER['HTTP_USER_AGENT'];
            $sec_login = new SecurityDao();
            $sec_data = $sec_login->logincheck($user_id);

            if (count($sec_data) == 1) {
                // If the user exists get variables from result.
                $login_check = hash('sha512', $sec_data['password'] . $user_browser);
                if ($login_check == $login_string) {
                    $_SESSION['username'] = $firstname;
                    $_SESSION['userlast'] = $lastname;
                    $_SESSION['usertype'] = $usertype;
                    if ($sec_data['active'] == 'noprofile') {
                        // Logged In with NO profile!!!
                        return $arrResult = array('response' => 'warning', 'reason' => 'You are required to complete your profile before you can use the system');
                    } elseif ($active == 'notapproved') {
                        // Logged In but user not approved by admin!!!
                        return $arrResult = array('response' => 'deny', 'reason' => 'Your profile is pending approval. You will be notified by via email when your profile has been approved by the system administrator.');
                    } else {
                        // Logged In with profile!!!
                        return $arrResult = array('response' => 'success', 'reason' => 'You will be redirected to your portal shortly.');
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

    function getProfilePic($user_id)
    {
        if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
            $user_id = $_SESSION['user_id'];

            $sec_login = new SecurityDao();
            $sec_data = $sec_login->loginSecurity($user_id);


            if (count($sec_data) == 1) {
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

    function getUserType($user_id)
    {
        if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
            $user_id = $_SESSION['user_id'];

            $sec_login = new SecurityDao();
            $sec_data = $sec_login->loginSecurity($user_id);

            if (count($sec_data) == 1) {
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

    function tutorCount($permission_id, $active)
    {
        if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
            $permid = 2;
            $approved = "notapproved";
            $tutorcount = 0;

            $sec_login = new SecurityDao();
            $sec_data = $sec_login->loginSecurity($user_id);

            if (count($sec_data == 1)) {
                return $tutorcount;
            } else {
                return $tutorcount;
            }
        } else {
            // Not logged in
            return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
        }

    }

    function teacherCount($permission_id, $active)
    {
        if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
            $permid = 3;
            $approved = "notapproved";
            $teachercount = 0;

            $sec_login = new SecurityDao();
            $sec_data = $sec_login->loginSecurity($user_id);

            if (count($sec_data == 1)) {
                return $teachercount;
            } else {
                return $teachercount;
            }
        } else {
            // Not logged in
            return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
        }

    }

    function adminCount($permission_id, $active)
    {
        if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
            $permid = 4;
            $approved = "notapproved";
            $admincount = 0;

            $sec_login = new SecurityDao();
            $sec_data = $sec_login->loginSecurity($user_id);

            if (count($sec_data == 1)) {
                // If the user exists get variables from result.
                return $admincount;
            } else {
                return $admincount;
            }
        } else {
            // Not logged in
            return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
        }
    }

} 