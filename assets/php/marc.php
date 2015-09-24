<?php
echo "######################################### Marc Test ##########################################################" . "\xA";

	require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
	$security = new Security();
    $security->sec_session_start();
    //var_dump($security->removeFailedLogin(10));
    var_dump($security->login("marc@bermanz.co.za","8a71df63e988a6cedbcc9a67beb738b3254441ff879d5082f9e8d159ef2dc00939907da5e6049fef65a8b3a6f4eafabf919469e64679a58493e90e998d1b83d8"));

    $user = new User();
    $user->pullUser('12');
    var_dump($_SESSION['user']);

echo $_SESSION['user']->getUserID();
?>