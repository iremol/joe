<?php

namespace com\light\registration;

/**
 * Description of RegistrationManager
 *
 * @author root 
 */
use com\light\sql\SQLConnection;

//require_once '/root/NetBeansProjects/joe/src/classes/com/light/sql/SQLConnection.php';

class RegistrationManager {

    //put your code here
    public function testRegister(string $username, string $password, string $principal): bool {
        $success = false;
        $sql = new SQLConnection(SQLConnection::MYSQL,"admin_users","admin_joe");
//        $sql->setTableName("admin_users");
        $con=$sql->getDbConnection("admin_joe");
        $sql->is_mysql_table_information();
        $query = $sql->get_mysql_insert();
        //$con = $sql->getDbConnection();
        if (!($stmt = $con->prepare($query))) {
            throw new \Exception($stmt->error);
        }
        if (!$stmt->bind_param("sss", $username, password_hash($password, PASSWORD_DEFAULT), $principal)) {
            throw new \Exception("Binding Parameters Error: " . $stmt->error);
        }

        if (!$stmt->execute()) {
            throw new \Exception("Execution Error: " . $stmt->error);
        }
        $success = true;
        return $success;
    }

    public function register(Referral $referral, $principal = "UserPrincipal"): bool {
        $success = false;
        if ($this->enactTwoPolicy($referral->getSponsorUsername())) {
            $sql = new SQLConnection(SQLConnection::MYSQL);
            $con = $sql->getDbConnection();
            $con->autocommit(false);
            $con->begin_transaction();
            $this->registerUser($referral, $con, $principal);
            $this->registerReferral($referral, $con, "FEEDER");
            $this->registerBioData($referral, $con);
            $this->registerAccount($referral, $con);
            $con->commit();
            $success = true;
            return $success;
        }
        else{
            throw  new \Exception("Sorry, sponsor cannot have any more direct downlines");
            return $success;
        }
    }

    private function registerUser(Referral &$referral, &$con, $principal) {
        $sql = new SQLConnection(SQLConnection::MYSQL);
        $sql->setTableName("users");
        $sql->setSchema("joe");
        $sql->is_mysql_table_information();
        $query = $sql->get_mysql_insert();
        //$con = $sql->getDbConnection();
        if (!($stmt = $con->prepare($query))) {
            throw new \Exception($stmt->error);
        }
        if (!$stmt->bind_param("sss", $referral->getPublicCredentials()->getValue(), password_hash($referral->getPrivateCredentials()->getValue(), PASSWORD_DEFAULT), $principal)) {
            throw new \Exception("Binding Parameters Error: " . $stmt->error);
        }

        if (!$stmt->execute()) {
            throw new \Exception("Execution Error: " . $stmt->error);
        }
    }

    private function registerBioData(Referral &$referral, &$con) {
        $sql = new SQLConnection(SQLConnection::MYSQL);
        $sql->setTableName("biodata");
        $sql->setSchema("joe");
        $sql->is_mysql_table_information();
        $query = $sql->get_mysql_insert();
        //$con = $sql->getDbConnection();
        if (!($stmt = $con->prepare($query))) {
            throw new \Exception($stmt->error);
        }
        if (!$stmt->bind_param("sssssssss", $referral->getBioData()->getFirstName(), $referral->getBioData()->getOtherName(), $referral->getBioData()->getLastName(), $referral->getBioData()->getDob(), $referral->getBioData()->getEmail(), $referral->getBioData()->getCity(), $referral->getBioData()->getPhoneno(), $referral->getBioData()->getCountry(), $referral->getPublicCredentials()->getValue())) {
            throw new \Exception("Binding Parameters Error: " . $stmt->error);
        }

        if (!$stmt->execute()) {
            throw new \Exception("Execution Error: " . $stmt->error);
        }
    }

    private function registerAccount(Referral &$referral, &$con) {
        $sql = new SQLConnection(SQLConnection::MYSQL);
        $sql->setTableName("account");
        $sql->setSchema("joe");
        $sql->is_mysql_table_information();
        $query = $sql->get_mysql_insert();
        //$con = $sql->getDbConnection();
        if (!($stmt = $con->prepare($query))) {
            throw new \Exception($stmt->error);
        }
        if (!$stmt->bind_param("sss", $referral->getAccount()->getAccountNo(), $referral->getAccount()->getBankName(), $referral->getPublicCredentials()->getValue())) {
            throw new \Exception("Binding Parameters Error: " . $stmt->error);
        }

        if (!$stmt->execute()) {
            throw new \Exception("Execution Error: " . $stmt->error);
        }
    }

    private function registerReferral(Referral &$referral, &$con, $stage) {
        $sql = new SQLConnection(SQLConnection::MYSQL);
        $sql->setTableName("referral");
        $sql->setSchema("joe");
        $sql->is_mysql_table_information();
        $query = $sql->get_mysql_insert();
        //$con = $sql->getDbConnection();
        if (!($stmt = $con->prepare($query))) {
            throw new \Exception("Error Description: " . $stmt->error);
        }
        if (!$stmt->bind_param("sss", $referral->getPublicCredentials()->getValue(), $referral->getSponsorUsername(), $stage)) {
            throw new \Exception("Binding Parameters Error: " . $con->error);
        }

        if (!$stmt->execute()) {
            throw new \Exception("Execution Error: " . $stmt->error);
        }
    }

    /**
     * 
     * @param \com\light\registration\String $intendedSponsor
     * @return type bool
     * @throws \Exception
     */
    private function enactTwoPolicy(string $sponsor) {
        $sql = new SQLConnection(SQLConnection::MYSQL);
        $sql->setTableName("referral");
        $sql->setSchema("joe");
        $con = $sql->getDbConnection();
        $query = "select count(vsusername) as 'totcount' from referral where vsusername='$sponsor'";
        if (!$result = $con->query($query)) {
            throw new \Exception("Error: Cannot confirm adherence to 2 referral policy");
        }
        $row = $result->fetch_assoc();
        if ($row['totcount'] < 2) {
            return true;
        } else {
            return false;
        }
    }

}
