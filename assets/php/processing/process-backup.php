<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();

session_cache_limiter('nocache');

header("Content-Type: application/json", true);

if (isset($_POST['backup'])) {
    
    $now = date('d-m-Y G-i');
    $dbname = "reach";
    $dbuser = "reach";
    $dbpass = "Reach2015#";
    $backupfile = "/var/www/html/portal/backup/".$now."."."sql";

    $results = exec("mysqldump --allow-keywords --opt -u$dbuser -p$dbpass $dbname > $backupfile");

    $arrResult = array ('response'=>'success','reason'=>'Database has been backed up on the server.');
    echo json_encode($arrResult);
} else {
    $arrResult = array ('response'=>'error','reason'=>'An unknown error occurred.');
    echo json_encode($arrResult);
}

?>