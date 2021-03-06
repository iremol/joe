<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use com\light\security\Authenticator;

require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/Authenticator.php';
require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/Subject.php';
if (isset($_POST['login'])) {
    $username = filter_input(INPUT_POST, "username");
    $password = filter_input(INPUT_POST, "password");
    $auth = new Authenticator();
    try {
        $subject = $auth->validate($username, $password);
        echo $subject->getPublicCred();
        echo $subject->getPrincipal();
        session_start();
        $_SESSION["user"] = &$subject;
        header('Location: ../userprofile.php');
    } catch (\Exception $e) {
        echo "<h2>Authentication Failure</h2>";
        echo $e->getMessage();
    }
}
