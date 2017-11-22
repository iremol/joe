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
        <link href="../../css/main.css" rel='stylesheet' type="text/css"/>
        <script type="text/javascript" src="../../js/main.js"></script>
    </head>
    <body>
        <?php include '../../includes/nav.php'; ?>
        <div id="container">
            <?php include '../../includes/admin/sidebar.php'; ?>
             <?php include '../../includes/a    dmin/profile.php'; ?>
            <div id='content'>
                <div class="table">
                    <div class="row">
                        <div class="cell">
                            <div class="title" style="background-color: greenyellow">Notifications</div>
                            <div class="box">
                                <p>Already a member? <a href="#">click here</a> to login. </p>
                            </div>
                        </div>
                        <div class="cell">
                            <div class="title" style="background-color: yellow">Profile</div>
                            <div class="box"><p>Already a member? <a href="#">click here</a> to login. </p> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="cell">
                            <div class="title" style="background-color: red">Pending Earnings</div>
                            <div class="box">
                                <p>Already a member? <a href="#">click here</a> to login. </p>
                            </div>
                        </div>
                        <div class="cell">
                            <div class="title" style="background-color: lightblue">Support</div>
                            <div class="box"><p>Already a member? <a href="#">click here</a> to login. </p> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'includes/footer.php'; ?>

    </body>
</html>
