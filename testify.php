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
                <h2>Enter your testimony</h2>
                <form id="form" action="" method="post">
                    <div id="row">
                        <label></label>
                        <textarea cols="70" rows="10"></textarea>
                    </div>
<!--                    <div id="row">
                        <label></label>
                        <input type="text" id="accountno" name="accountno" maxlength="10" required size="28" onkeypress="return isNumber(event)"/>
                    </div>-->
                    <div id='row' style="text-align: right">
                        <label></label>
                        <input type="submit" id='cancel' name='cancel' value="Cancel" />
                        <input type="submit" id='publish' name='publish' value="Publish" />
                    </div>
                </form>
            </div>
        </div>
        <?php include 'includes/footer.php'; ?>

    </body>
</html>
