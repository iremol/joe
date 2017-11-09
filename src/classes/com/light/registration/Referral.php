<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\registration;

/**
 * Description of Referral
 *
 * @author root
 */
use com\light\security\PublicCredential;
use com\light\security\PrivateCredential;
use com\light\stage\Stage;
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/registration/Person.php';
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/PublicCredential.php';
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/PrivateCredential.php';
class Referral extends Person{
    //put your code here
    private $account;
    private $sponsorUserName;
    private $stage;
    
    public function __construct(PublicCredential $publicc,PrivateCredential $privatec,string $stage,string $sponsorUserName=null, BioData $bioData=null,Account $account = null) {
        parent::__construct($publicc, $privatec, $bioData);
        $this->stage = $stage;
        $this->account = $account;
        $this->sponsorUserName = $sponsorUserName;
    }
    
    public function getAccount(): Account {
        return $this->account;
    }

    public function setAccount($account) {
        $this->account = $account;
    }

    public function getSponsorUsername() : string{
        return $this->sponsorUserName;
    }

    public function setSponsorUserName($sponsorUserName) {
        $this->sponsorUserName = $sponsorUserName;
    }

    public function getStage():string {
        return $this->stage;
    }

}
