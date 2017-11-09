<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
//    echo $_SERVER['DOCUMENT_ROOT'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome to Joe's MLM Site</title>
        <link href="css/main.css" rel='stylesheet' type="text/css"/>
        <script type="text/javascript" src="js/main.js"></script>
    </head>
    <body>
     <?php include 'includes/nav.php';?>
        <div id="container">
            <?php include 'includes/sidebar.php';?>
            <div id='content'>
                <p>Interested in becoming a <i>Member</i>?<a href="#"> Click here.</a></p>
                <p>Already a member? <a href="#">click here</a> to login. </p>
            </div>
        </div>
         <?php include 'includes/footer.php';?>

    </body>
</html>
