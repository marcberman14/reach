<?php
include_once 'psl-config.php';
include_once 'functions.php';

function userTypeCheck($mysqli){
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
                return $usertype;
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

function getPageName()
{

}

// This function will take $_SERVER['REQUEST_URI'] and build a breadcrumb based on the user's current path
function breadcrumbs($separator = ' &raquo; ', $home = 'Home') {
    // This gets the REQUEST_URI (/path/to/file.php), splits the string (using '/') into an array, and then filters out any empty values
    $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

    // This will build our "base URL" ... Also accounts for HTTPS :)
    $base = ($_SERVER['HTTPS'] ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

    // Initialize a temporary array with our breadcrumbs. (starting with our home page, which I'm assuming will be the base URL)
    $breadcrumbs = Array("<li><a  class=\"sidebar-right-toggle\"  href=\"$base\"><i class=\"fa fa-home\"></i></a></li>");

    // Find out the index for the last value in our path array
    $last = end(array_keys($path));

    // Build the rest of the breadcrumbs
    foreach ($path AS $x => $crumb) {
        // Our "title" is the text that will be displayed (strip out .php and turn '_' into a space)
        $title = ucwords(str_replace(Array('.php', '_'), Array('', ' '), $crumb));

        // If we are not on the last index, then display an <a> tag
        if ($x != $last)
            $breadcrumbs[] = "<li><a href=\"$base$crumb\"><span>$title</span></a></li>";
        // Otherwise, just display the title (minus)
        else
            $breadcrumbs[] = $title;
    }
    // Build our temporary array (pieces of bread) into one big string :)
    return implode($separator, $breadcrumbs);
}

function loadView($mysqli)
{
    $loggedIn = loggedIn($mysqli);
    if ($loggedIn== true)
    {

      /*  <section role="main" class="content-body">
            <!-- begin: breadcrumbs -->
            <header class="page-header">
                <h2> print_r(getPageName()); </h2>

                <div class="right-wrapper pull-right">
                    <ol class="breadcrumbs">
                        <?php echo breadcrumbs(); ?>
                    </ol>
                    <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                </div>
            </header>
            <!-- end: breadcrumbs -->

            <!-- start: page -->
            <div class="row">
                <div class="col-md-6">
                    <p>This is column 1. More can be added. adjust the values above. Remember they must all equal 12 in the end.</p>
                </div>

                <div class="col-md-6">
                    <p>This is column 2. More can be added. adjust the values above. Remember they must all equal 12 in the end.</p>
                </div>


                <div class="col-md-4">
                    <p>This is column 1. More can be added. adjust the values above. Remember they must all equal 12 in the end.</p>
                </div>

                <div class="col-md-4">
                    <p>This is column 2. More can be added. adjust the values above. Remember they must all equal 12 in the end.</p>
                </div>
                <div class="col-md-4">
                    <p>This is column 3. More can be added. adjust the values above. Remember they must all equal 12 in the end.</p>
                </div>
            </div>

            <!-- end: page -->
        </section>*/


    } else
    {

    }

}

function loggedIn($mysqli)
{
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
                    if ($active == 'noprofile') {
                        // Logged In with NO profile!!!
                        return $arrResult = array('response' => 'warning', 'reason' => 'You are required to complete your profile before you can use the system');
                    } elseif($active == 'notapproved') {
                        // Logged In but user not approved by admin!!!
                        return $arrResult = array('response' => 'deny', 'reason' => 'Your profile is pending approval. You will be notified by via email when your profile has been approved by the system administrator.');
                    }else {
                        // Logged In with profile!!!
                        return $arrResult = array('response' => 'success');
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
