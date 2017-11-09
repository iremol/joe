<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\security;

/**
 * Description of PublicCredentials
 *
 * @author root
 */
//require_once 'Credential.php';

class PublicCredential extends Credential {

    public function __construct(string $value) {
        parent::__construct($value);
    }

    public function getValue(): string {
        return $this->value;
    }

    public function setValue(string $value) {
        if($value == null){
            throw new Exception("Error: value is null");
        }
        $this->value = $value;
    }
    public function __toString() {
        return "[PublicCredential]: ".$this->getValue();
    }


}
