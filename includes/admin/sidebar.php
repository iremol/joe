<?php
session_start();


function __autoload($classname) {
    $directory = str_replace('\\', '/', $classname);
    $filename = '/root/NetBeansProjects/joe/src' . '/classes/' . $directory . '.php';
    require_once $filename;
}

;
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/Subject.php';
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/Principal.php';
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/UserPrincipal.php';
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/AdminPrincipal.php';
use com\light\stage\Stage;
use com\light\registration\Referral;
use com\light\sql\SQLConnection;

if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php");
}

$subject = $_SESSION["admin"];
$ref = new Referral($subject->getPublicCred(), $subject->getPrivateCred(), "");
$sql = new SQLConnection(SQLConnection::MYSQL, "referral", "joe");
$con = $sql->getDbConnection();
$query = "select vstage from referral where vusername='".$subject->getPublicCred()->getValue()."'";
$result = $con->query($query);
$row = $result->fetch_assoc();
if ($row['vstage']!==$ref->getStage()){
    $query = "update referral set vstage='".$ref->getStage()."' where vusername='".$subject->getPublicCred()->getValue()."'";
    if(!$con->query($query)){
           throw new \Exception("Could not write new stage to datatable");
    }
    $bonus = Stage::getBonus($ref->getStage());
    $reward = Stage::getReward($ref->getStage());
    $sql = new SQLConnection(SQLConnection::MYSQL,"bonus_reward_current","joe");
    $con = $sql->getDbConnection();
    $statement = $con->prepare("insert into bonus_reward_current (vbonusdesc,vusername,vrewarddesc) values(?,?,?)");
//    $_SESSION["current_bonus"] = $bonus;
//    $_SESSION["current_reward"] = $reward;
    
    $statement->bind_param("sss",$bonus,$subject->getPublicCred()->getValue(),$reward);
    $statement->execute();
    
}
//$stage=$_SESSION['stage']=Stage::getStage($subject->getPublicCred()->getValue());
//$subject->setStage($stage);
?>
<?php
$Msg = $_SESSION['ErrMsg'];
//$errMsg = $_SESSION['msg'];
//$errCode = $_SESSION['code'];
//$sqlState = $_SESSION['sqlstate'];
?>
<?php
//print_r($_SESSION);
//$e = new ErrorDAO();
//$userMsg = $e->getUserMsg($sqlState);
if (strlen($Msg) > 0) {
    ?>
    <script>
        var f = function () {
            var title = "<?= $Msg; ?>";
            var mesg = "<?= $Msg ?>" + " " + "<?= $Msg ?>";
            swal({
                title: title,
                text: mesg,
                html: true
            });
        };
        window.onload = function () {
            f();
        };
    </script>
    <?php
}
?>
<div id='sidenav'>
    <ul>
        <li style="background-color: #333; color:#eee">User: <?= $subject->getPublicCred()->getValue() ?></li>
        <!--<li style="background-color: #666; color:yellow"><?= $ref->getStage() ?></li>-->
<!--        <li class="c"><a href='../../userprofile.php'>Dashboard</a></li>
        <a href='#'><li onfocus="document.getElementById('submenu1').style.display = 'block'" onmouseover="document.getElementById('submenu1').style.display = 'block'" onmouseout="document.getElementById('submenu1').style.display = 'none'"><a href="#">Profile</a>
            <ul id="submenu1" style="display:none">
                <li class="c"><a href="../../viewprofile.php">View Profile</a></li>
                <li id="li1" class="c"><a  href="../../changepass.php">Change Password</a></li> 
                <li class="c"><a href="../../changeaccount.php">Change Account</a></li> 
                <li class="c"><a href="../../changemobile.php">Change Phone</a></li> 
            </ul>
        </li></a>-->
        <!--<li class="c"><a href='../../src/testviewreferral.php'>Referrals</a></li>-->
        <!--<li class="c"><a href='../../earnings.php'>My Pending Earnings</a></li>-->
        <!--<li class="c"><a href='#'>User Account</a></li>-->
        <!--<li class="c"><a href='../../testify.php'>Add Testimony</a></li>-->
        <!--<li class="c"><a href='#'>Notification</a></li>-->
        <li class="c"><a href='../../src/admin/request_viewer.php'>View Requests</a></li>
        <li class="c"><a href='../../src/admin/pay_confirm.php'>Confirm Payment</a></li>
        <li class="c"><a href='../../src/logout.php'>Logout</a></li>
    </ul>
</div>