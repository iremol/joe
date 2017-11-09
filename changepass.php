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
        <script type="text/javascript" src="js/main.js"></script>
    </head>
    <body>
        <?php include 'includes/nav.php'; ?>
        <div id="container">
            <?php include 'includes/user/sidebar.php'; ?>
            <div id='content'>
                <h2>Change Password</h2>
                <form id="form" action="src/testchangepassword.php" method="post">
                    <div id="row">
                        <label for="oldP">Old Password</label>
                        <input type="password" id="oldP" name="oldP" required size="28"/>
                    </div>
                    <div id="row">
                        <label for="password">New Password</label>
                        <input type="password" id="password" name="password" required size="28"/>
                    </div>
                    <div id="row">
                        <label for="re-password">Confirm New Password</label>
                        <input type="password" id="re-password" name="re-password" required size="28"/>
                    </div>
                    <div id='row'>
                        <label></label>
                        <input class="save" type="submit" id='change' name='change' value="Change Password" />
                        <input class="cancel" type="submit" id='cancel' name='cancel' value="Cancel" />
                    </div>
                </form>
            </div>
        </div>
        <?php include 'includes/footer.php'; ?>

    </body>
</html>
