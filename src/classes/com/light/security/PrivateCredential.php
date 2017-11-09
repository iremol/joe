<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\security;

/**
 * Description of PrivateCredential
 *
 * @author root
 */
//require_once 'Credential.php';
class PrivateCredential extends Credential{
    //put your code here
    public function __construct(string $value) {
        parent::__construct($value);
    }
    public function getValue():string {
        return $this->value;
    }
}
