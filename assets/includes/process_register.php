<?php
include_once 'db_connect.php';
include_once 'functions.php';

header("Content-Type: application/json", true);

if (isset($_POST['firstname'],$_POST['surname'], $_POST['email'], $_POST['hashedPassword'], $_POST['usertype'])) {
    // Sanitize and validate the data passed in
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $arrResult = array ('response'=>'error','reason'=>'Invalid email address, please try again.');
        echo json_encode($arrResult);
    }
    $usertype = filter_input(INPUT_POST, 'usertype', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'hashedPassword', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $arrResult = array ('response'=>'error','reason'=>'A fatal error has occurred, if this problem persists please contact an administrator.');
        echo json_encode($arrResult);
    }

    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.

    $prep_stmt = "SELECT user_id FROM members WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);

    // check existing email
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            $arrResult = array ('response'=>'error','reason'=>'A user with this email address already exists.');
            echo json_encode($arrResult);
            $stmt->close();
            exit;
        }
    } else {
        $arrResult = array ('response'=>'error','reason'=>'An error occurred validating your email, please try again.');
        echo json_encode($arrResult);
        $stmt->close();
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
        // Insert the new user into the database
        if ($insert_stmt = $mysqli->prepare("INSERT INTO members(permission_id, firstname, lastname, email, password, salt, active, profilepicurl) VALUES (?,?,?,?,?,?,?,?)")) {
            $insert_stmt->bind_param('isssssss',$usertype, $firstname, $surname, $email, $password, $random_salt, $active, $profilepic);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                $arrResult = array ('response'=>'error','reason'=>'"Registration failed, if this problem persists please contact an administrator.');
                echo json_encode($arrResult);
            } else {
                $arrResult = array ('response'=>'success');
                echo json_encode($arrResult);
            }
        } else {
            $arrResult = array ('response'=>'error','reason'=>"Registration failed, if the problem persists please contact an administrator.");
            echo json_encode($arrResult);
        }


    }else {
        $arrResult = array ('response'=>'error','reason'=>'A fatal error has occurred, if this problem persists please contact an administrator.');
        echo json_encode($arrResult);
    }


} else {
    $arrResult = array ('response'=>'error','reason'=>'Please ensure you have entered all the required fields.');
    echo json_encode($arrResult);
}

?>