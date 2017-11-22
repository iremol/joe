<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
$subject = $_SESSION['user'];

use com\light\sql\SQLConnection;
use com\light\user\ProfileManager;
use com\light\registration\Referral;
function __autoload($classname) {
    $directory = str_replace('\\', '/', $classname);
    $filename = __DIR__ . '/classes/' . $directory . '.php';
//    echo $filename;
    require_once $filename;
}

$referral = new Referral($subject->getPublicCred(), $subject->getPrivateCred());
$profMangr = new ProfileManager();
$accno=$profMangr->getManagedAccount($referral);
$sql = new SQLConnection(SQLConnection::MYSQL);
$con=$sql->getDbConnection("admin_joe");
$query = 'insert into claims (vref_username,fbonus_amt,vaccnum,ddeadline) values (?,?,?,ADDDATE(CURDATE(),7))';
$stmt = $con->prepare($query);
$stmt->bind_param('sds',$subject->getPublicCred()->getValue(), filter_input(INPUT_POST,'bonus'),$accno['vaccountno']);
if(!$stmt->execute()){
    throw new \Exception($stmt->error);
}
$sql = new SQLConnection(SQLConnection::MYSQL);
$con = $sql->getDbConnection("joe");
$query = "update bonus_reward_current set vstatus='Processing' where vusername='".$subject->getPublicCred()->getValue()."'";
if(!$con->query($query)){
    throw new \Exception("Error in Query:".$con->error);
}
