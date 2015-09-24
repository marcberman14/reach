<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "Dao.php";
//require_once "../classes/User.php";

final class UserDao extends Dao {
    
    public function findByCode($code) {
        try {
            $this->db->stmt_prepare("SELECT * from `members` WHERE `code` = ?");
            $this->db->stmt_bind_and_execute(array($code => PDO::PARAM_STR));
            $data = $this->db->stmt_fetch(PDO::FETCH_ASSOC);
            $this->db->stmt_close();
            if (!$data) { return null; }
            $currency = new Currency();
            Currency::map($currency, $data);
            return $currency;
        } catch (DBException $e) {
            echo "Error finding currency by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding currency by code:<br/>" . $e->getMessage();
            return null;
        }
    }

    public function testDbConn() {
        try {
            echo $this->db->test();
        } catch (DBException $e) {
            echo "Error finding currency by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding currency by code:<br/>" . $e->getMessage();
            return null;
        }
    }
    
    public function findManyByCodes($codes) {
        $currencies = array();
        try {
            $this->db->stmt_prepare("SELECT * from `members` WHERE `user_id` = ?");
            foreach ($codes AS $key => $val) {
                $this->db->stmt_bind_and_execute(array($key => PDO::PARAM_STR));
                $data = $this->db->stmt_fetch(PDO::FETCH_ASSOC);
                if ($data) {
                    $data['usage_level'] = $val;
                    $currency = new Currency();
                    Currency::map($currency, $data);
                    array_push($currencies, $currency);
                }
            }
            $this->db->stmt_close();
            return ((count($currencies) == 0) ? null : $currencies);
        } catch (DBException $e) {
            echo "Error finding currency by code:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding currency by code:<br/>" . $e->getMessage();
            return null;
        }
    }
    
    public function findAll() {
        $currencies = array();
        try {
            $this->db->stmt_prepare("SELECT * from `members`");
            $this->db->stmt_execute();
            $data = $this->db->stmt_fetch_all(PDO::FETCH_ASSOC);
            $this->db->stmt_close();
            if (!$data) { return null; };
            foreach ($data as $val) {
                $currency = new Currency();
                Currency::map($currency, $val);
                array_push($currencies, $currency);
            }
            return ((count($currencies) == 0) ? null : $currencies);
        } catch (DBException $e) {
            echo "Error finding all currencies:<br/>" . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Error finding all currencies:<br/>" . $e->getMessage();
            return null;
        }
    }
}