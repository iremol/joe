<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light;

/**
 * Description of LoginHandler
 *
 * @author Imole Akpobome
 */
class LoginHandler {

    private $userName;
    private $password;
    private $authenticated;

    public function __construct($userName=null,$password=null) {
        if($userName == null){ 
            throw new \Exception("Username or Password cannot be null");
        }
        if( $password == null){
            throw new \Exception("Username or Password cannot be null");
        }
        
        $this->userName = $userName;
        $this->password = $password;
        $this->authenticated = false;
    }
    /**
     * login() function compares the 
     * credentials with that in the database
     * to verify existence and conformity.
     */
    private function login(){
        
    }
    
    public function getUserName() : string {
        return $this->userName;
    }

}
