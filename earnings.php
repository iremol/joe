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
        <script type="text/javascript" src="js/main_.js"></script>
        <script type="text/javascript" src="js/earnings.js"></script>
    </head>
    <body>
        <?php include 'includes/nav.php'; ?>
        <div id="container">
            <?php include 'includes/user/sidebar.php'; ?>
            <div id='content'>
                <ul>
                    <li id="h" class="grey">History</li>
                    <li id="c" class="green">Current</li>
                    <li id="f" class="blue">Future</li>
                </ul>
            </div>
            <div id="history" style="display:none">
                <p>History Shows Here.</p>
            </div>
            <div id="current" style="display:none">
                <p>Current Shows Here.</p>
            </div>
            <div id="future" style="display:none">
                <p>Future Shows Here.</p>
            </div>
        </div>
        <?php include 'includes/footer.php'; ?>

    </body>
</html>
