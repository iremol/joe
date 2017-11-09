<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\security;

/**
 * Description of SubjectAllocator
 *
 * @author root
 */
class SubjectAllocator {
    //put your code here
    private $username;
    private $password;
    public function __construct($username,$password){
        $this->username = $username;
        $this->password = $password;
    }
    
    public function validate(){
        $auth = new Authenticator();
        if($auth->validate($this->username, $this->password)){
            $subject = new Subject();
            $subject->setPublicCred(new PublicCredential($this->username));
        }
    }
}
