<?php
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/UserDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/ProfileDao.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/View.php";
    $security = new Security();
    $security->sec_session_start();
    echo "Login Test";
    $password = "Em1cr4m747#";
    $password = hash('sha512', $password);
    var_dump($security->login("marc@bermanz.co.za", $password));
    echo "Session Dump";
    var_dump($_SESSION);
    $FILENAME = "9c8502708ca247fdd89eda2354c8e074555a013b23c88692288d9d64e0c345a788443cd23d5f96c8f12ee22f7b40269b2d30de947b2d33bcebaa4a0962603598.png";
    $array = array("profilepicurl"=>$FILENAME ,"user_id"=>$_SESSION['user_id']);
    $result = $user->uploadpicurl($array);
    var_dump($result);

    /*echo "Tutor Count";
    var_dump($security->tutorCount());
    echo "Teach Count";
    var_dump($security->teacherCount());
    echo "Admin Count";
    var_dump($security->adminCount());
    $firstname = "Marc";
    $lastname = "Berman";
    $email = "mcber5@student.monash.edu";
    $password = "8a71df63e988a6cedbcc9a67beb738b3254441ff879d5082f9e8d159ef2dc00939907da5e6049fef65a8b3a6f4eafabf919469e64679a58493e90e998d1b83d8";
    $usertype = "4";
    $gender = "Male";
    echo "Regiser check";
    var_dump($security->register($firstname, $lastname, $email, $password, $usertype, $gender));
    echo "check brute";
    var_dump($security->checkbrute(50));

    echo "removeFailedLogin";
    var_dump($security->removeFailedLogin(50));

    echo "Login Check";
    var_dump($security->login_check(50));

    echo "getProfilePic";
    var_dump($security->getProfilePic());

    echo "getUserType";
    var_dump($security->getUserType());

    $views = new View();
    echo "Views test";
    var_dump($views->addScript(Array("/assets/home-site/vendor/jquery/jquery.js",
        "/assets/home-site/vendor/common/common.js",
        "/assets/home-site/vendor/jquery.validation/jquery.validation.js")));

    var_dump($views->addStyle(Array("/assets/home-site/vendor/jquery/jquery.js",
        "/assets/home-site/vendor/common/common.js",
        "/assets/home-site/vendor/jquery.validation/jquery.validation.js")));*/
?>