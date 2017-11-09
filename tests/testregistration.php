<?php
use com\light\registration\RegistrationManager;
use com\light\sql\SQLConnection;
use com\light\security\PrivateCredential;
use com\light\security\PublicCredential;

require_once '../src/classes/com/light/registration/RegistrationManager.php';
require_once '../src/classes/com/light/sql/SQLConnection.php';
require_once '/root/NetBeansProjects/joe/src/classes/com/light/registration/Referral.php';
require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/PublicCredential.php';
require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/PrivateCredential.php';
require_once '/root/NetBeansProjects/joe/src/classes/com/light/registration/Sponsor.php';
$sql = new SQLConnection(SQLConnection::MYSQL, "users", "joe");
$sql->is_mysql_table_information();
//$insert = $sql->is_build_mysql_insert();
$reg = new RegistrationManager();
if (isset($_POST['register'])) {
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $sponsor = filter_input(INPUT_POST, 'sponsor');
    $principal = filter_input(INPUT_POST, 'principal');
    $referral = new com\light\registration\Referral(new PublicCredential($username), new PrivateCredential($password), $sponsor);
    try {
        $reg->register($referral);
        echo "<h2>Registration Successful</h2>";
        echo "<a href='../login.php'>click here to Login</a>";
    } catch (Exception $e) {
        echo "<h2>Registration Failed</h2>";
        echo $e->getMessage();
        echo "<a href='../sponsor.php'>click here to register</a>";
    }
}
else{
    header("Location: index.php");
}
