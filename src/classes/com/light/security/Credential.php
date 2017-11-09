<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\security;

/**
 * Description of Credential
 *
 * @author Imole Akpobome
 */
class Credential {
    //put your code here
    protected $value;
    
    public function __construct(string $value) {
        $this->value = $value;
    }

}
