<?php
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/View.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/classes/Security.php";
include_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/BackupDao.php";

$views = new View();
$security = new Security();
$security->sec_session_start();
$login = $security->login_check();
$state = $security->userActiveState();
$title = "Backup and Restore";
$page_heading = "Backup and Restore";
$keywords = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$description = "Monash South Africa, MSA, REACH, R.E.A.CH, Online, Video, Tutoring";
$back = new BackupDao;
$backArray = $back -> returnDatabase();

if($login['response'] != "error" && $state['response']== 'success') {
    $security->refreshUser($_SESSION['user_id']);

    if($state['response']== 'warning'){
        echo $state['script'];
    }

    include($_SERVER['DOCUMENT_ROOT'].$views->includeHeader($_SESSION['user']->getPermissionName()));
    include($_SERVER['DOCUMENT_ROOT'].$views->includeLeftNav($_SESSION['user']->getPermissionName()));
?>
<!-- begin: breadcrumbs -->
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Admin Dashboard</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
               <li>
                    <a  class="sidebar-right-toggle" href="/portal/">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Backup</span></li>
            </ol>

            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">
        <div class="alert alert-success hidden" id="contactSuccess">Success!</div>
        <div class="alert alert-danger hidden" id="contactError"><strong>Error!</strong>
        </div>
        <form action="/assets/php/processing/process-backup.php" method="POST"
              name="backupform" id="backupform">
            <div class="row">
                <div class="form-group">
                    <div class="col-md-6">                        
                        <i class="fa fa-database fa-2x"></i>
                        <input type="text" value="backup" class="hidden" name="backup"
                               id="backup">
                        <input type="submit" value="Backup Database"
                               class="btn btn-lg btn-primary push-bottom" id="submit"
                               name="submit">
                    </div>
                </div>
            </div>
        </form>
    </div>

    
<!-- end: breadcrumbs -->
    
     <div class="row">
        <div class="alert alert-success hidden" id="contactSuccess">Success!</div>
        <div class="alert alert-danger hidden" id="contactError"><strong>Error!</strong>
        </div>
        <form action="/assets/php/processing/process-restore.php" method="POST"
              name="backupform" id="backupform">
            <div class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <i class="fa fa-database fa-2x"></i>
                                               <input type="submit" value="Restore Database"
                               class="btn btn-lg btn-primary push-bottom" id="submit"
                               name="submit">
                        <select id="restoreselect" name="restoreselect">
                            <option value="" disabled="disabled" selected="selected">Select Backup Restore Point</option>
                            <option value="<?php echo $backArray[count($backArray ) - 1]['backup_file']; ?>"><?php echo $backArray[count($backArray ) - 1]['backup_date']; ?></option>
                            <option value="<?php echo $backArray[count($backArray ) - 2]['backup_file']; ?>"><?php echo $backArray[count($backArray ) - 2]['backup_date']; ?></option>
                            <option value="<?php echo $backArray[count($backArray ) - 3]['backup_file']; ?>"><?php echo $backArray[count($backArray ) - 3]['backup_date']; ?></option>                              
                            <option value="<?php echo $backArray[count($backArray ) - 4]['backup_file']; ?>"><?php echo $backArray[count($backArray ) - 4]['backup_date']; ?></option>
                            <option value="<?php echo $backArray[count($backArray ) - 5]['backup_file']; ?>"><?php echo $backArray[count($backArray ) - 5]['backup_date']; ?></option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
    

    <!-- end: page -->
</section>
</div>
</section>


<?php
echo $views->addScript(Array("/assets/vendor/jquery/jquery.js",
"/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js",
"/assets/vendor/bootstrap/js/bootstrap.js",
"/assets/vendor/nanoscroller/nanoscroller.js",
"/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js",
"/assets/vendor/magnific-popup/magnific-popup.js",
"/assets/vendor/jquery-placeholder/jquery.placeholder.js",
"/assets/vendor/modernizr/modernizr.js",
"/assets/javascripts/theme.js",
"/assets/javascripts/theme.init.js",
"/assets/ajax/backup/process-restore.js",
"/assets/ajax/backup/process-backup.js"));
} else {
    ?>
    <script>
        window.location.href = "/user/login/";
    </script>
<?php
}
?>
</body>
</html>