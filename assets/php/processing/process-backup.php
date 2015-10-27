<?php


require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/BackupDao.php";


$security = new Security();
$security->sec_session_start();
$backup = new BackupDao;

session_cache_limiter('nocache');

header("Content-Type: application/json", true);

if (isset($_POST['backup'])) {
    
    $now = date('Y-m-d-G-i-s');
    $dbserver = "localhost";
    $dbname = "reach";
    $dbuser = "reach";
    $dbpass = "Reach2015#";
    $backupfile = "/var/www/html/portal/backup/backup_".$now.'.sql';
    $backuparray = array ("bfile" => $backupfile, "now" => $now);
    $backup -> backupDatabase($backuparray);
    $results = exec("mysqldump --allow-keywords --opt -u$dbuser -p$dbpass $dbname > $backupfile");
    
    
  $arrResult = array ('response' =>'success','reason'=>'Database has been backed up on the server.');
    echo json_encode($arrResult);
} else {
    $arrResult = array ('response'=>'error','reason'=>'An unknown error occurred.');
    echo json_encode($arrResult);
}

?>