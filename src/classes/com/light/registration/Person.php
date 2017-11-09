<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\registration;

/**
 * Description of Person
 *
 * @author root
 */
use \com\light\security\PrivateCredential;
use \com\light\security\PublicCredential;

//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/PrivateCredential.php';
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/PublicCredential.php';
class Person {
    //put your code here
    private  $credential = [];
    private $bioData;
    
    public function __construct(PublicCredential $publicc,PrivateCredential $privatec, BioData $bioData = null) {
        $this->credential = [$publicc,$privatec];
        $this->bioData = $bioData;
    }
    
    public function setCredential(array $credential) {
        $this->credential = $credential;
    }
    
    public function setBioData(BioData $bioData){
        $this->bioData = $bioData;
    }
    
    public function getCredential(): array {
        return $this->credential;
    }
    public function getBioData(): BioData {
        return $this->bioData;
    }
    public function getPrivateCredentials() : PrivateCredential {
        return $this->credential[1];
    }
    public function getPublicCredentials() : PublicCredential {
        return $this->credential[0];
    }
}
