<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/classes/Security.php";
$security = new Security();
$security->sec_session_start();

session_cache_limiter('nocache');

header("Content-Type: application/json", true);

if (isset($_POST['restore'])) {
    
    $now = date("Y-m-d_H-i-s");
    $dbname = "reach";
    $dbuser = "reach";
    $dbpass = "Reach2015#";
    $restorefile = "/var/www/html/portal/backup/backup.sql";
    
    $results = exec("mysql -u $dbuser -p$dbpass --add-drop-table $dbname < $restorefile");

    $arrResult = array ('response'=>'success','reason'=>'Database has been restored up on the server.');
    echo json_encode($arrResult);
} else {
    $arrResult = array ('response'=>'error','reason'=>'An unknown error occurred.');
    echo json_encode($arrResult);
}

?>