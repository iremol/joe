<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\security;

/**
 * Description of UserPrincipal
 *
 * @author Imole
 */
//require_once 'Principal.php';
class UserPrincipal extends Principal{
    public function __toString() {
        return "[UserPrincipal]: ".$this->getName();
    }

}
