<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        use com\light\security\Principal;
        require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/Subject.php';
        require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/Principal.php';
        require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/UserPrincipal.php';
        require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/AdminPrincipal.php';
        session_start();
        $subject  = $_SESSION["user"];
        //$principal =  (object) $subject->getPrincipal();
        echo $subject;
        ?>
    </body>
</html>
