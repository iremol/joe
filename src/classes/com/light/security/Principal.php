<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\security;

/**
 * Description of Principal
 * Represents the role / authorization the subject can perform.
 * @author Imole Akpobome
 */
class Principal {
    // The description of the principal.
    private $name;
    
    public function __construct($name){
        $this->name = $name;
    }
    public function getName() : string {
        return $this->name;
    }
    public function setName(string $name) {
        $this->name = $name;
    }
    public function __toString() {
        return "[name]: ".$this->name;
    }

}
