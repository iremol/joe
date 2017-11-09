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
    $filename = __DIR__ . '/classes/' . $directory . '.php';
//    echo $filename;
    require_once $filename;
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
$securimage = new Securimage();
$arr = $_SESSION['firstForm'];
//foreach ($arr as $val) {
//    echo $val . '<br>';
//}
$arr2 = filter_input_array(INPUT_POST);
$account = new Account($arr2['accno'], $arr2['bank']);
$biodata = new BioData($arr2['fname'], $arr2['oname'], $arr2['lname'], $arr2['dob'], $arr['username'], $arr2['city'], $arr2['phoneno'], $arr2['country']);

//require_once '../src/classes/com/light/registration/RegistrationManager.php';
//require_once '../src/classes/com/light/sql/SQLConnection.php';
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/registration/Referral.php';
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/PublicCredential.php';
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/PrivateCredential.php';
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/registration/Sponsor.php';
$sql = new SQLConnection(SQLConnection::MYSQL, "users", "joe");
$sql->is_mysql_table_information();
//$insert = $sql->is_build_mysql_insert();
$reg = new RegistrationManager();
if (isset($arr2['register'])) {
    if ($securimage->check(filter_input(INPUT_POST, 'captcha_code')) == false) {
        $_SESSION['secondForm'] = $arr2;
        $_SESSION['err'] =["msg"=>"The Code was incorrect","code"=>0001]; 
        // the code was incorrect
        // you should handle the error so that the form processor doesn't continue
        // or you can use the following code if there is no validation or you do not know how
        echo "The security code entered was incorrect.<br /><br />";
        echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
        header("location: ../sponsor2.php");
        exit;
    }

    $username = $arr['username']; //filter_input(INPUT_POST, 'username');
    $password = $arr['password']; //filter_input(INPUT_POST, 'password');
    $sponsor = $arr['sponsor']; //filter_input(INPUT_POST, 'sponsor');
    $principal = $arr['principal']; //filter_input(INPUT_POST, 'principal');
    $referral = new com\light\registration\Referral(new PublicCredential($username), new PrivateCredential($password),"", $sponsor, $biodata, $account);
    try {
        $reg->register($referral);
        echo "<h2>Registration Successful</h2>";
        echo "<a href='../login.php'>click here to Login</a>";
    } catch (Exception $e) {
        echo "<h2>Registration Failed</h2>";
        echo $e->getMessage();
        echo "<a href='../sponsor.php'>click here to register</a>";
    }
} else {
    header("Location: index.php");
}
