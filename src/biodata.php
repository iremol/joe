<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use com\light\registration\Referral;
use com\light\user\ProfileManager;
use com\light\security\Subject;

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
                <h2>Bio Information</h2>
                <?php
                $form_data = filter_input_array(INPUT_POST);
                $subject = $_SESSION["user"];
                $referral = new Referral($subject->getPublicCred(), $subject->getPrivateCred());
                $profileMangr = new ProfileManager();
                $row = $profileMangr->manageBioData($referral);
                ?>
                <form id="form2" action="" method="post">
                    <div id="col"></div>
                    <div id="col"></div>
                    <div id="row">
                        <div class="cell">
                            <label for="fn">First Name</label>
                            <input name="on" type="text" value="<?= $row["vfirstname"] ?>" size="25" disabled>
                        </div>
                        <div class="cell">
                            <label for="on">Other Name</label>
                            <input name="on" type="text" value="<?= $row["vothername"] ?>" size="25" disabled=>
                        </div>
                    </div>

                    <div id="row">
                        <div class="cell">
                            <label for="ln">Last Name</label>
                            <input name="ln" type="text" value="<?= $row["vlastname"] ?>" size="25" disabled>
                        </div>
                        <div class="cell">
                            <label for="dob">Date of Birth</label>
                            <input name="dob" type="text" value="<?= $row["ddob"] ?>" size="25" disabled>
                        </div>
                    </div>

                    <div id="row">
                        <div class="cell">
                            <label for="email">Email</label>
                            <input name="email" type="text" value="<?= $row["vemail"] ?>" size="25" disabled>
                        </div>
                        <div class="cell">
                            <label for="city">City</label>
                            <input name="city" type="text" value="<?= $row["vcity"] ?>" size="25" disabled>
                        </div>
                    </div>
                    <div id="row">
                        <div class="cell">
                            <label for="phoneno">Phone Number</label>
                            <input name="pnoneno" type="text" value="<?= $row["vphoneno"] ?>" class="e" size="25" disabled onkeypress="return isNumber(event)" maxlength="11">
                        </div>
                        <div class="cell">
                            <label for="country">Country</label>
                            <input name="country" type="text" value="<?= $row["vcountry"] ?>" class="e" size="25" disabled>
                        </div>
                    </div>
                    <div id='row'>
                        <div class="cell">
                            <input type="button" id='edit' class="edit" name='edit' value="  Edit  " onclick="enableFields()"/> 
                            <input type="submit" id='save' class="save" name='save' value="  Save  " />  
<!--                            <input type="reset" id='cancel' name='cancel' value="Cancel" />-->
                        </div>
                        <div class="cell">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php include '../includes/footer.php'; ?>

    </body>
</html>




