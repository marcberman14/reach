<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
	$security = new Security();
    $security->sec_session_start();
echo "Login Test";
    $password = "Em1cr4m747#";
    $password = hash('sha512', $password);
    var_dump($security->login("marc@bermanz.co.za",$password));
echo "Session Dump";
var_dump($_SESSION);

echo "Tutor Count";
    var_dump($security->tutorCount());
echo "Teach Count";
    var_dump($security->teacherCount());
echo "Admin Count";
    var_dump($security->adminCount());
    $firstname  = "marc";
    $lastname = "berman";
    $email= "marc@bermanz.co.za";
    $password= "8a71df63e988a6cedbcc9a67beb738b3254441ff879d5082f9e8d159ef2dc00939907da5e6049fef65a8b3a6f4eafabf919469e64679a58493e90e998d1b83d8";
    $usertype= "4";
    //var_dump($security->register($firstname, $lastname, $email, $password, $usertype));
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
?>