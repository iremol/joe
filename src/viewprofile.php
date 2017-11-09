<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use com\light\registration\Referral;
use com\light\user\ProfileManager;
use com\light\security\Subject;
use com\light\stage\Stage;
//function __autoload($classname) {
//    $directory = str_replace('\\', '/', $classname);
//    $filename = __DIR__ . '/classes/' . $directory . '.php';
////    echo $filename;
//    require_once $filename;
//}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Welcome to Joe's MLM Site</title>
        <link href="../css/main.css" rel='stylesheet' type="text/css"/>
        <script type="text/javascript" src="../js/main.js"></script>
    </head>
    <body>
        <?php include '../includes/nav.php'; ?>
        <div id="container">
            <?php include '../includes/user/sidebar.php'; ?>
            <div id='content'>
                <h2>My Information</h2>
                <?php
                $form_data = filter_input_array(INPUT_POST);
                $subject = $_SESSION["user"];
                $referral = new Referral($subject->getPublicCred(), $subject->getPrivateCred(),$_SESSION['stage']);
                $profileMangr = new ProfileManager();
                $row = $profileMangr->manageBioData($referral);
                $accountrow = $profileMangr->getManagedAccount($referral);
                //echo "Stage: ". Stage::getStage($referral->getPublicCredentials()->getValue()); 
                echo "Stage: ". $referral->getStage();
                //exit();
                ?>
                <form id="form2" action="" method="post">
                    <div id="col"></div>
                    <div id="col"></div>
                    <div id="row">
                        
                        <div class="reportcell">
                            <label for="fn">First Name</label>
                            <p><?= $row["vfirstname"] ?></p>
                        </div>
                        <div class="reportcell">
                            <label for="on">Other Name</label>
                            <p><?= $row["vothername"] ?></p>
                        </div>
                    </div>

                    <div id="row">
                        <div class="reportcell">
                            <label for="ln">Last Name</label>
                            <p><?= $row["vlastname"] ?></p>
                        </div>
                        <div class="reportcell">
                            <label for="dob">Date of Birth</label>
                            <p><?= $row["ddob"] ?></p>
                        </div>
                    </div>

                    <div id="row">
                        <div class="reportcell">
                            <label for="email">Email</label>
                            <p><?= $row["vemail"] ?></p>
                        </div>
                        <div class="reportcell">
                            <label for="city">City</label>
                            <p><?= $row["vcity"] ?></p>
                        </div>
                    </div>
                    <div id="row">
                        <div class="reportcell">
                            <label for="phoneno">Phone Number</label>
                            <p><?= $row["vphoneno"] ?></p>
                        </div>
                        <div class="reportcell">
                            <label for="country">Country</label>
                            <p><?= $row["vcountry"] ?></p>
                        </div>
                    </div>
                    <div id="row">
                        <div class="reportcell">
                            <label for="phoneno">Bank</label>
                            <p><?= $accountrow["vbankname"] ?></p>
                        </div>
                        <div class="reportcell">
                            <label for="country">Account Number</label>
                            <p><?= $accountrow["vaccountno"] ?></p>
                        </div>
                    </div>
<!--                    <div id='row'>
                        <div class="cell">
                            <input type="button" id='edit' class="edit" name='edit' value="  Edit  " onclick="enableFields()"/> 
                            <input type="submit" id='save' class="save" name='save' value="  Save  " />  
                            <input type="reset" id='cancel' name='cancel' value="Cancel" />
                        </div>
                        <div class="cell">
                        </div>-->
                    </div>
                </form>
            </div>
        </div>
        <?php include '../includes/footer.php'; ?>

    </body>
</html>




