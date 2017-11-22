<?php

session_start();

use com\light\registration\RegistrationManager;
use com\light\sql\SQLConnection;
use com\light\security\PrivateCredential;
use com\light\security\PublicCredential;
use com\light\registration\BioData;
use com\light\registration\Account;

function __autoload($classname) {
    $directory = str_replace('\\', '/', $classname);
    $filename = rtrim(__DIR__,"/admin") . '/classes/' . $directory . '.php';
//    echo $filename;
    require_once $filename;
}

$regMangr = new RegistrationManager();
$username = filter_input(INPUT_POST,"username");
$password = filter_input(INPUT_POST,"password");
$principal = "AdinPrincipal";
if($regMangr->testRegister($username, $password, $principal)){
    echo "Registration successfull. <a href='admin_login.php'>Click here to login</a>";
}
else{
    echo "Error in registration. please try again.";
}
