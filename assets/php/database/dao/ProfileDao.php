<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "Dao.php";

final class ProfileDao extends Dao {

    public function insertAdminProfile($values)
    {

        try {
            $temp = $this->db->query("INSERT INTO administrator(user_id, dob, streetnumber,
                                                                streetname, suburb, city, country, postalcode, homenumber,
                                                                cellphone, worknumber, staffnumber, jobdepartment,
                                                                jobposition, monashmail, alternativeemail, altcontactnum)
                                                                VALUES (:user_id,:dob,:streetnumber,:streetname,:suburb,:city,:country,:postalcode,:homenumber
                                                                ,:cellphone,:worknumber,:staffnumber,:jobdepartment,:jobposition,
                                                                :monashmail,:alternativeemail,:altcontactnum)", $values);
            return $temp;
        } catch (DBException $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function updateProfileStatus($values)
    {
        try {
            $temp = $this->db->query("UPDATE members AS m SET m.active=:active WHERE m.user_id=:user_id",$values);
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