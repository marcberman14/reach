<?php
include_once 'psl-config.php';

error_reporting(-1);

function sec_session_start()
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

function login($email, $password, $mysqli)
{
    // Using prepared statements means that SQL injection is not possible.
    if ($stmt = $mysqli->prepare("SELECT m.user_id, m.firstname, m.lastname, p.permission_name, m.password, m.salt, m.active FROM members m join permission_group p ON p.permission_id = m.permission_id WHERE m.email = ? LIMIT 1;")) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
        // get variables from result.
        $stmt->bind_result($user_id, $firstname, $lastname, $usertype, $db_password, $salt, $active);
        $stmt->fetch();
        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts
            $isLocked = checkbrute($user_id, $mysqli);
            if ($isLocked['response'] != 'success') {
                return $isLocked;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS protection as we might print this value
                    $firstname = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $firstname);
                    $_SESSION['username'] = $firstname;
                    $_SESSION['userlast'] = $lastname;
                    $_SESSION['usertype'] = $usertype;
                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                    // Login successful.

                    $ifFailed = removeFailedLogin($user_id, $mysqli);
                    if ($ifFailed['response'] == 'success') {
                        return $arrResult = array('response' => 'success', 'usertype'=>$usertype, 'active'=>$active);
                    } else {
                        return $arrResult = array('response' => 'error', 'reason' => 'Invalid username or password, please try again.');
                    }

                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    if (!$mysqli->query("INSERT INTO login_attempts(user_id, time) VALUES ('$user_id', '$now')")) {
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
    } else {
        // Could not create a prepared statement
        return $arrResult = array('response' => 'error', 'reason' => 'Unable to access the database, please try again later.');
        exit();
    }
}

function checkbrute($user_id, $mysqli)
{
    // Get timestamp of current time
    $now = time();
    // All login attempts are counted from the past 2 hours.
    $valid_attempts = $now - (2 * 60 * 60);
    if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > ?")) {
        $stmt->bind_param('id', $user_id, $valid_attempts);
        // Execute the prepared query.
        $stmt->execute();
        $stmt->store_result();
        // If there have been more than 5 failed logins
        if ($stmt->num_rows > 5) {
            return $arrResult = array('response' => 'error', 'reason' => 'Account is locked. Please contact an administrator for assistance.');
        } else {
            return $arrResult = array('response' => 'success');
        }
    } else {
        // Could not create a prepared statement
        return $arrResult = array('response' => 'error', 'reason' => 'Unable to access the database, please try again later.');
        exit();
    }
}

function removeFailedLogin($user_id, $mysqli)
{
    // Get timestamp of current time
    $now = time();
    // All login attempts are counted from the past 2 hours.
    $valid_attempts = $now - (2 * 60 * 60);
    if ($stmt = $mysqli->prepare("DELETE FROM login_attempts
                                  WHERE user_id = ?")
    ) {
        $stmt->bind_param('i', $user_id);
        // Execute the prepared query.
        $stmt->execute();
        return $arrResult = array('response' => 'success');
    } else {
        // Could not create a prepared statement
        return $arrResult = array('response' => 'error', 'reason' => 'Unable to access the database, please try again later.');
        exit();
    }
}

function login_check($mysqli)
{
    // Check if all session variables are set
    if (isset($_SESSION['user_id'], $_SESSION['username'],$_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        if ($stmt = $mysqli->prepare("SELECT m.password, p.permission_name, m.active, m.firstname, m.lastname FROM members m join permission_group p  ON p.permission_id = m.permission_id  WHERE m.user_id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter.
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password, $usertype, $active, $firstname, $lastname);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
                if ($login_check == $login_string) {
                    $_SESSION['username'] = $firstname;
                    $_SESSION['userlast'] = $lastname;
                    $_SESSION['usertype'] = $usertype;
                    if ($active == 'noprofile') {
                        // Logged In with NO profile!!!
                        return $arrResult = array('response' => 'warning', 'reason' => 'You are required to complete your profile before you can use the system');
                    } elseif($active == 'notapproved') {
                        // Logged In but user not approved by admin!!!
                        return $arrResult = array('response' => 'deny', 'reason' => 'Your profile is pending approval. You will be notified by via email when your profile has been approved by the system administrator.');
                    }else {
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
            // Could not prepare statement
            return $arrResult = array('response' => 'error', 'reason' => 'A fatal error occurred. Please try again later.');
        }
    } else {
        // Not logged in
        return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
    }
}

function getProfilePic($mysqli)
{
    if (isset($_SESSION['user_id'], $_SESSION['username'],$_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        if ($stmt = $mysqli->prepare("SELECT profilepicurl FROM members m WHERE m.user_id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter.
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($profile);
                $stmt->fetch();
                return $arrResult = array('response' => 'success', 'url' => $profile);
            } else {
                //no profile exists
                return $arrResult = array('response' => 'error', 'url' => 'default.png');
            }
        } else {
            // Could not prepare statement
            return $arrResult = array('response' => 'error', 'url' => 'default.png');
        }
    } else {
        // Not logged in
        return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
    }
}

function getUserType($mysqli)
{
    if (isset($_SESSION['user_id'], $_SESSION['username'],$_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        if ($stmt = $mysqli->prepare("SELECT p.permission_name FROM members m join permission_group p  ON p.permission_id = m.permission_id  WHERE m.user_id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter.
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($usertype);
                $stmt->fetch();
                return $arrResult = array('response' => 'success', 'usertype' => $usertype);
            } else {
                //no profile exists
                return $arrResult = array('response' => 'error', 'reason' => 'No profile exists');
            }
        } else {
            // Could not prepare statement
            return $arrResult = array('response' => 'error', 'reason' => 'A fatal error occured, please try again later.');
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

function tutorCount($mysqli)
{
    if (isset($_SESSION['user_id'], $_SESSION['username'],$_SESSION['login_string'])) {
        $permid = 2;
        $approved = "notapproved";
        $tutorcount = 0;
        if ($stmt = $mysqli->prepare("SELECT COUNT(m.user_id) FROM members m WHERE m.permission_id = ? AND m.active = ?")) {
            // Bind "$user_id" to parameter.
            $stmt->bind_param('is', $permid, $approved);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($tutorcount);
                $stmt->fetch();
                return $tutorcount;
            } else {
                return $tutorcount;
            }
        } else {
            return mysqli_error($mysqli);
            // Could not prepare statement
            return $arrResult = array('response' => 'error', 'reason' => 'A fatal error occured, please try again later.');
        }
    } else {
        // Not logged in
        return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
    }

}

function teacherCount($mysqli)
{
    if (isset($_SESSION['user_id'], $_SESSION['username'],$_SESSION['login_string'])) {
        $permid = 3;
        $approved = "notapproved";
        $tutorcount = 0;
        if ($stmt = $mysqli->prepare("SELECT COUNT(m.user_id) FROM members m  WHERE m.permission_id = ? AND m.active = ?")) {
            // Bind "$user_id" to parameter.
            $stmt->bind_param('is', $permid, $approved);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($tutorcount);
                $stmt->fetch();
                return $tutorcount;
            } else {
                return $tutorcount;
            }
        } else {
            return mysqli_error($mysqli);
            // Could not prepare statement
            return $arrResult = array('response' => 'error', 'reason' => 'A fatal error occured, please try again later.');
        }
    } else {
        // Not logged in
        return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
    }

}

function adminCount($mysqli)
{
    if (isset($_SESSION['user_id'], $_SESSION['username'],$_SESSION['login_string'])) {
        $permid = 4;
        $approved = "notapproved";
        $tutorcount = 0;
        if ($stmt = $mysqli->prepare("SELECT COUNT(m.user_id) FROM members m WHERE m.permission_id = ? AND m.active = ?")) {
            // Bind "$user_id" to parameter.
            $stmt->bind_param('is', $permid, $approved);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($tutorcount);
                $stmt->fetch();
                return $tutorcount;
            } else {
                return $tutorcount;
            }
        } else {
            return mysqli_error($mysqli);
            // Could not prepare statement
            return $arrResult = array('response' => 'error', 'reason' => 'A fatal error occured, please try again later.');
        }
    } else {
        // Not logged in
        return $arrResult = array('response' => 'error', 'reason' => 'You are not logged in. Please login to continue');
    }

}