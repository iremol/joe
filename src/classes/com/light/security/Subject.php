<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\security;

/**
 * Description of Subject
 *
 * @author Imole Akpobome
 */
//require_once 'PublicCredential.php';
//require_once 'PrivateCredential.php';
//require_once 'Principal.php';
class Subject {

    //put your code here
    private $publicCred;
    private $privateCred;
    private $principal;

    public function __construct() {
        ;
    }

    public function setPublicCred(PublicCredential $cred): bool {
        $status = false;
        if ($cred == NULL) {
            throw new Exception("Error: Credential cannot be null");
        }
        $this->publicCred = $cred;
        $status = true;
        return $status;
    }

    public function setPrivateCred(PrivateCredential $cred): bool {
        $status = false;
        if ($cred == NULL) {
            throw new Exception("Error: Credential cannot be null");
        }
        $this->privateCred = $cred;
        $status = true;
        return $status;
    }

    public function setPrincipal(Principal $p): bool {
        $status = false;
        if ($p == NULL) {
            throw new Exception("Error: Pricipal cannot be null");
        }
        $this->principal = $p;
        $status = true;
        return $status;
    }

    public function getPublicCred(): PublicCredential {
        return $this->publicCred;
    }

    public function getPrivateCred(): PrivateCredential {
        return $this->privateCred;
    }

    public function getPrincipal(): Principal {
        return $this->principal;
    }

    public function __toString() {
        return $this->getPublicCred()." ".$this->principal;
    }

}
