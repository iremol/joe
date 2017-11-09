<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\security;

/**
 * Description of AdminPrincipal
 *
 * @author Imole Akpobome
 */
//require_once 'Principal.php';
class AdminPrincipal extends Principal{
    public function __toString() {
        return "[AdminPrincipal]: ".$this->getName();
    }

}
