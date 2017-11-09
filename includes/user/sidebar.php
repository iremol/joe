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

if (!isset($_SESSION["user"])) {
    header("Location: ../../index.php");
}

$subject = $_SESSION["user"];
$stage=$_SESSION['stage']=Stage::getStage($subject->getPublicCred()->getValue());
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
        <li style="background-color: #666; color:yellow"><?= $stage ?></li>
        <li class="c"><a href='../../userprofile.php'>Dashboard</a></li>
        <!--<a href='#'>--><li onfocus="document.getElementById('submenu1').style.display = 'block'" onmouseover="document.getElementById('submenu1').style.display = 'block'" onmouseout="document.getElementById('submenu1').style.display = 'none'"><a href="#">Profile</a>
            <ul id="submenu1" style="display:none">
                <li class="c"><a href="../../viewprofile.php">View Profile</a></li>
                <li id="li1" class="c"><a  href="../../changepass.php">Change Password</a></li> 
                <li class="c"><a href="../../changeaccount.php">Change Account</a></li> 
                <li class="c"><a href="../../changemobile.php">Change Phone</a></li> 
            </ul>
        </li><!--</a>-->
        <li class="c"><a href='../../src/testviewreferral.php'>Referrals</a></li>
        <li class="c"><a href='../../earnings.php'>My Pending Earnings</a></li>
        <li class="c"><a href='#'>User Account</a></li>
        <li class="c"><a href='../../testify.php'>Add Testimony</a></li>
        <li class="c"><a href='#'>Notification</a></li>
        <li class="c"><a href='#'>Support</li></a>
        <li class="c"><a href='../../src/logout.php'>Logout</a></li>
    </ul>
</div>