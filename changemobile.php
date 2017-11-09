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
                <h2>Change Phone Number</h2>
                <form id="form" action="src/processchangemobile.php" method="post">
                    
                    <div id="row">
                        <label for="phoneno">New Phone Number</label>
                        <input type="text" id="phoneno" name="phoneno" maxlength="11" required size="28" onkeypress="return isNumber(event)"/>
                    </div>
                    <div id='row'>
                        <label></label>
                        <input type="submit" class="save"  id='save' name='save' value="Save Changes" />
                        <input class="cancel" type="submit" id='cancel' name='cancel' value="Cancel" />
                    </div>
                </form>
            </div>
        </div>
        <?php include 'includes/footer.php'; ?>

    </body>
</html>
