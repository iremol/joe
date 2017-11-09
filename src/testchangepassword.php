<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

use com\light\registration\Referral;
use com\light\user\ProfileManager;
use com\light\security\Subject;

function __autoload($classname) {
    $directory = str_replace('\\', '/', $classname);
    $filename = __DIR__ . '/classes/' . $directory . '.php';
//    echo $filename;
    require_once $filename;
}

$form_data = filter_input_array(INPUT_POST);
$subject = $_SESSION["user"];
$referral = new Referral($subject->getPublicCred(),$subject->getPrivateCred());
$profileMangr = new ProfileManager();
$profileMangr->manageCredential($referral, $form_data['oldP'], $form_data['password'], $form_data['re-password']);

