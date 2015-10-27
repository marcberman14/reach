<?php

require_once "Dao.php";

final class BackupDao extends Dao {
    
        public function backupDatabase($values){
        try {
            $temp = $this->db->query("INSERT INTO backup (backup_date, backup_file) VALUES ( :now, :bfile);",$values); 
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }
    
        public function returnDatabase() {
                try {
            $temp = $this->db->query("SELECT backup_file, 
                                     backup_date    
                                     FROM backup
                                     "); 
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