<?php

require_once "Dao.php";

final class BackupDao extends Dao {
    
        public function backupDatabase($values){
        try {
            $temp = $this->db->query("INSERT INTO backup (backup_id, backup_date, backup_file) VALUES (NULL, NOW(), '$backupfile'"); 
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }
}

    
?>