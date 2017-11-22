<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use com\light\security\Authenticator;

function __autoload($classname) {
    $directory = str_replace('\\', '/', $classname);            
    $filename = rtrim(__DIR__,"/admin") . '/classes/' . $directory . '.php';
//    echo $filename;
    require_once $filename;
}

//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/Authenticator.php';
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/Subject.php';
if (isset($_POST['login'])) {
    $username = filter_input(INPUT_POST, "username");
    $password = filter_input(INPUT_POST, "password");
    $auth = new Authenticator();
    try {
        $subject = $auth->validate_admin($username, $password);
        echo $subject->getPublicCred();
        echo $subject->getPrincipal();
        session_start();
        $_SESSION["admin"] = &$subject;
        header('Location: adminprofile.php');
    } catch (\Exception $e) {
        echo "<h2>Authentication Failure</h2>";
        echo $e->getMessage();
    }
}
