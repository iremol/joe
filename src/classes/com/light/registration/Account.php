<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\registration;

/**
 * Description of Account
 *
 * @author root
 */
class Account {
    //put your code here
    private $accountNo;
    private $bankName;
    
    public function __construct(string $accountNo, string $bankName) {
        $this->accountNo = $accountNo;
        $this->bankName = $bankName;
    }
    
    public function getAccountNo() {
        return $this->accountNo;
    }

    public function getBankName() {
        return $this->bankName;
    }

    public function setAccountNo($accountNo) {
        $this->accountNo = $accountNo;
    }

    public function setBankName($bankName) {
        $this->bankName = $bankName;
    }

    public function __toString() {
        return "[$this->bankName,$this->accountNo]";
    }


}
