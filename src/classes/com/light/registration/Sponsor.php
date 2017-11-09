<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\registration;

/**
 * Description of Sponsor
 *
 * @author Imole Akpobome
 */
use com\light\security\PublicCredential;
use com\light\security\PrivateCredential;

//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/PublicCredential.php';
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/PrivateCredential.php';
class Sponsor extends Person {
    //put your code here
    //put your code here
    private $account;
    
    public function __construct(PublicCredential $publicc,PrivateCredential $privatec, BioData $bioData=null, Account $account=null) {
        parent::__construct($publicc, $privatec, $bioData);
        $this->account = $account;
    }
    
    public function getAccount() {
        return $this->account;
    }

    public function setAccount($account) {
        $this->account = $account;
    }
}
