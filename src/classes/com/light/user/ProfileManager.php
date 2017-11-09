<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\user;

/**
 * Description of ProfileManager
 * A Gateway to handling the profile of the 
 * sponsor / referral.
 * @requires com\light\registration\Referral;
 * @author Imole Akpobome
 */
use com\light\registration\Referral;
use com\light\security\PrivateCredential;
use com\light\sql\SQLConnection;
use com\light\registration\Account;
use com\light\stage\Stage;

class ProfileManager {
    
    private $stage;
    
    public function getStage() {
        return $this->stage;
    }

    
    public function manageBioData(Referral &$referral) {
        return $this->getBioData($referral);
    }

    private function getBioData(Referral &$referral) {
        $sql = new SQLConnection(SQLConnection::MYSQL, "biodata", "joe");
        $con = $sql->getDbConnection();
        $query = "select vfirstname, vothername,vlastname,ddob,vemail,vcity,vphoneno,vcountry from " . $sql->getTableName() . " where vusername='" . $referral->getPublicCredentials()->getValue() . "'";
        if (!($result = $con->query($query))) {
            throw new \Exception("Error: COuld not get requested data");
        }
//        for($i = 0;$i < $result->num_rows;$i++){
//            
//        }
        $row = $result->fetch_assoc();
        return $row;
    }

    public function getManagedAccount(Referral &$referral) {
        return $this->fetchManagedAccount($referral);
    }

    private function fetchManagedAccount(Referral &$referral) {
        $sql = new SQLConnection(SQLConnection::MYSQL, "account", "joe");
        $con = $sql->getDbConnection();
        $query = "select vaccountno,vbankname from " . $sql->getTableName() . " where vusername='" . $referral->getPublicCredentials()->getValue() . "'";
        if (!($result = $con->query($query))) {
            throw new \Exception("Error: COuld not get requested data");
        }
//        for($i = 0;$i < $result->num_rows;$i++){
//            
//        }
        $row = $result->fetch_assoc();
        return $row;
    }

    public function manageAccount(Referral &$referral, string $accNum, string $bankName) {
        $ref = $this->changeAccount($referral, $accNum, $bankName);
        $this->updateAccount($ref);
        echo "Success Updating Account";
    }

    private function changeAccount(Referral &$referral, string $accNum, string $bankName) {
        $account = new Account($accNum, $bankName);
        $referral->setAccount($account);
        return $referral;
    }

    private function updateAccount(Referral &$referral) {
        $sql = new SQLConnection(SQLConnection::MYSQL, "account", "joe");
        $con = $sql->getDbConnection();
        $updateStmt = "update " . $sql->getSchema() . "." . $sql->getTableName() . " set vaccountno=?, vbankname=?  where vusername=?";
        if (!($stmt = $con->prepare($updateStmt))) {
            throw new \Exception("Error in Update Statement: " . $con->error);
        }
        $account = $referral->getAccount();
        if (!($stmt->bind_param("sss", $account->getAccountNo(), $account->getBankName(), $referral->getPublicCredentials()->getValue()))) {
            throw new \Exception("Error in bind parameters" . $stmt->error);
        }
        if (!($stmt->execute())) {
            throw new \Exception("Error Excuting prepared statement: " . $stmt->error);
        }
    }

    public function manageCredential(Referral &$referral, string $oldPassword, string $newPassword, string $conformedPassword) {
        $ref = $this->changePrivateCredential($referral, $oldPassword, $newPassword, $conformedPassword);
        $this->updatePrivateCredential($ref);
        echo "Success Updating Password";
    }

    private function changePrivateCredential(Referral &$referral, string $oldPassword, string $newPassword, string $conformedPassword): Referral {
        if (password_verify($oldPassword, $referral->getPrivateCredentials()->getValue()) && ($conformedPassword === $newPassword)) {
            $credential = [$referral->getPublicCredentials(), new PrivateCredential(password_hash($newPassword, PASSWORD_DEFAULT))];
            $referral->setCredential($credential);
        } else {
            echo "Sorry there is a prolem with password";
        }
        return $referral;
    }

    private function updatePrivateCredential(Referral &$referral) {
        $sql = new SQLConnection(SQLConnection::MYSQL, "users", "joe");
        $con = $sql->getDbConnection();
        $updateStmt = "update " . $sql->getSchema() . "." . $sql->getTableName() . " set vpassword=? where vusername=?";
        if (!($stmt = $con->prepare($updateStmt))) {
            throw new \Exception("Error in Update Statement: " . $con->error);
        }
        if (!($stmt->bind_param("ss", $referral->getPrivateCredentials()->getValue(), $referral->getPublicCredentials()->getValue()))) {
            throw new \Exception("Error in bind parameters" . $stmt->error);
        }
        if (!($stmt->execute())) {
            throw new \Exception("Error Excuting prepared statement: " . $stmt->error);
        }
    }
    public function manageMobileNumber(Referral &$referral, String $phoneno){
        $ref = $this->changeMobileNumber($referral, $phoneno);
        $this->updateMobileNumber($ref);
        echo "Success updating Mobile Number";
    }

    private function changeMobileNumber(Referral &$referral, String $phoneno) {
        $biodata = new \com\light\registration\BioData(NULL, NULL, NULL, NULL, NULL, NULL, $phoneno, NULL);
        $referral->setBioData($biodata);
        return $referral;
    }

    private function updateMobileNumber(Referral &$referral) {
        $sql = new SQLConnection(SQLConnection::MYSQL, "biodata", "joe");
        $con = $sql->getDbConnection();
        $updateStmt = "update " . $sql->getSchema() . "." . $sql->getTableName() . " set vphoneno=? where vusername=?";
        if (!($stmt = $con->prepare($updateStmt))) {
            throw new \Exception("Error in Update Statement: " . $con->error);
        }
        $biodata = $referral->getBioData();
        if (!($stmt->bind_param("ss", $biodata->getPhoneno(), $referral->getPublicCredentials()->getValue()))) {
            throw new \Exception("Error in bind parameters" . $stmt->error);
        }
        if (!($stmt->execute())) {
            throw new \Exception("Error Excuting prepared statement: " . $stmt->error);
        }
    }
    
    private function getUserStage(Referral $referral){
        
    }
    
    private function getUserGenerationCount(Referral $referral){
        
    }
    

}
