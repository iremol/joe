<?php
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome to Joe's MLM Site</title>
        <link href="css/main.css" rel='stylesheet' type="text/css"/>
        <script src="js/main.js" type="text/javascript"></script>
    </head>
    <body>
        <?php   
        $secondForm = [];
        $arr = array_merge($_POST);
        $_SESSION['firstForm'] = $arr;
        //checking if this is a return response cause of wrong input.
        if (isset($_SESSION['secondForm'])) {
            $secondForm = $_SESSION['secondForm'];
        }
        ?>
        <?php include 'includes/nav.php'; ?>
        <div id="container">
            <?php include 'includes/sidebar.php'; ?>
            <div id='content'>
                <h2>Personal Information</h2>
                <div id='form'>
                    <!--<form action="src/testregistration.php" method="post">-->
                    <form action="src/testregistration.php" method="post">
                        <div id="caption">
                            <p>Bio Data</p>
                        </div>
                        <div id='row'>
                            <label for='fname'>First Name</label>
                            <input type="text" id='fname' name='fname' value="<?=$secondForm['fname']?>" required size="22"/>
                        </div>
                        <div id='row'>
                            <label for='oname'>Other Name</label>
                            <input type="text" id='oname' name='oname' value="<?=$secondForm['oname']?>" required size="22"/>
                        </div>
                        <div id='row'>
                            <label for='lname'>Last Name</label>
                            <input type="text" id='lname' name='lname' value="<?=$secondForm['lname']?>" required size="22"/>
                        </div>
                        <div id='row'>
                            <label for='dob'>Date of Birth</label>
                            <input type="date" id='dob' name='dob' value="<?=$secondForm['oname']?>" required size="22"/>
                        </div>
                        <div id='row'>
                            <label for='city'>City</label>
                            <input type="text" id='city' name='city' value="<?=$secondForm['city']?>" required size="22"/>
                        </div>
                        <div id='row'>
                            <label for='phoneno'>Phone Number</label>
                            <input type="text" id='phoneno' name='phoneno' value="<?=$secondForm['phoneno']?>" maxlength="11" required size="22" onkeypress="return isNumber(event)"/>
                        </div>
                        <div id='row'>
                            <label for='country'>Country</label>
                            <input type="text" id='country' name='country' value="<?=$secondForm['country']?>" required size="22"/>
                        </div>
                        <div id="caption">
                            <p>Account Information</p>
                        </div>
                        <div id='row'>
                            <label for='bank'>Bank</label>
                            <input type="text" id='bank' name='bank' value="<?=$secondForm['bank']?>" required size="25"/>
                        </div>
                        <div id='row'>
                            <label for='accname'>Account Name</label>
                            <input type="text" id='accname' name='accname' value="<?=$secondForm['accname']?>" required size="50"/>
                        </div>
                        <div id='row'>
                            <label for='accno'>Account Number</label>
                            <input type="text" id='accno' name='accno' required size="22" value="<?=$secondForm['accno']?>" maxlength="10" onkeypress="return isNumber(event)"/>
                        </div>
                        <div id='row'>
                            <label></label>
                            <div class='captcha'>
                                <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image"/><br>
                                <input type="text" name="captcha_code" size="10" maxlength="6"/><span style="color:red;font-style: italic"><?=$_SESSION['err']['msg']?></span>
                                <a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false;">[Different Image]</a>
                            </div>
                        </div>
                        <input type="hidden" id='principal' name='principal' value="UserPrincipal"/>
                        <div id='row'>
                            <label for='password'></label>
                            <input type="button" id='back' name='back' value="Previous" onclick="history.back(1)"/>
                            <input type="submit" id='register' name='register' value="Register" />
                            <input type="submit" id='cancel' name='cancel' value="Cancel" />

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>
