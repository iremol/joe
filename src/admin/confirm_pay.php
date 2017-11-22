<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use com\light\sql\MySQLDbConfig;
use com\light\sql\SQLConnection;


function __autoload($classname) {
    $directory = str_replace('\\', '/', $classname);
    $filename = rtrim(__DIR__,"/admin"). '/classes/' . $directory . '.php';
    require_once $filename;
}
$username = filter_input(INPUT_GET, "username");

$sql = new SQLConnection(SQLConnection::MYSQL, "claims","admin_joe");
$con = $sql->getDbConnection("admin_joe");
$query = "update claims set vstatus='processed' where vref_username='$username'";
if(!$con->query($query)){
    throw new \Exception($con->error);
}
$con->close();

//Update the bonus_reward_current table

$sql = new SQLConnection(SQLConnection::MYSQL,"bonus_reward_current","joe");
$con= $sql->getDbConnection();
$query = "update bonus_reward_current set vstatus='processed' where vusername='$username'";
if(!$con->query($query)){
    throw new \Exception($con->error);
}

//insert into history record
$sql = new SQLConnection(SQLConnection::MYSQL,"bonus_reward_history","joe");
$con= $sql->getDbConnection();
$query = "insert into bonus_reward_history (vbonusdesc,vusername,vrewarddesc,vstatus) select vbonusdesc,vusername,vrewarddesc,vstatus from bonus_reward_current where vstatus='processed' and vusername='$username'";
if(!$con->query($query)){
    throw new \Exception($con->error);
}

header('location: pay_confirm.php');