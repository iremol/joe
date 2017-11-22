<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\security;

use com\light\sql\SQLConnection;

/**
 * Description of Authenticator
 *
 * @author root
 */
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/sql/SQLConnection.php';
//require_once 'PublicCredential.php';
//require_once 'Credential.php';
//require_once 'UserPrincipal.php';
//require_once 'AdminPrincipal.php';

class Authenticator {

//put your code here
    public function validate(string $username, string $password): Subject {
//        $success = false;
        $subject = null;
        $sql = new SQLConnection(SQLConnection::MYSQL, "users", "joe");
        try {
            $row = $sql->getTableData("vusername", $username);
        } catch (\Exception $e) {
            throw $e;
        }
        if ($row) {
            if (password_verify($password, $row['vpassword'])) {
//                $success = true;
                $subject = $this->allocate($row);
            }
        }
        if($subject == null){
            throw new \Exception("Wrong username or password");
        }
        return $subject;
    }

     public function validate_admin(string $username, string $password): Subject {
//        $success = false;
        $subject = null;
        $sql = new SQLConnection(SQLConnection::MYSQL);
        $sql->setTableName('admin_users');
        try {
            $row = $sql->getTableData("vusername", $username,"admin_joe");
        } catch (\Exception $e) {
            throw $e;
        }
        if ($row) {
            if (password_verify($password, $row['vpassword'])) {
//                $success = true;
                $subject = $this->allocate($row);
            }
        }
        if($subject == null){
            throw new \Exception("Wrong username or password");
        }
        return $subject;
    }
    
    private function allocate($row): Subject {
        $subject = new Subject();
        $subject->setPublicCred(new PublicCredential($row["vusername"]));
        //$subject->setPrivateCred(new PrivateCredential(password_hash($row["vpassword"], PASSWORD_DEFAULT)));
        $subject->setPrivateCred(new PrivateCredential($row["vpassword"]));
        if ($row['vprincipal'] === "UserPrincipal") {
            $subject->setPrincipal(new UserPrincipal("UserPrincipal"));
        } else {
            $subject->setPrincipal(new AdminPrincipal("AdminPricipal"));
        }
        return $subject;
    }

}
