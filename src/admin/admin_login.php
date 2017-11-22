<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome to Joe's MLM Site::Login</title>
        <link href="../../css/main.css" rel='stylesheet' type="text/css"/>
        <script type="text/javascript" src="../../js/main.js"></script>
    </head>
    <body>
        <?php include '../../includes/nav.php';?>
        <div id="container">
            <?php //include '../../includes/sidebar.php';?>
            <div id='content'>
                <h2>Administrator Login</h2>
                <div id='form'>
                    <form action="authenticate.php" method="post">
                        <div id='row'>
                        <label for='username'>Admin Username</label>
                        <input type="text" id='username' name='username' required="true" size="50"/>
                        </div>
                        <div id='row'>
                        <label for='password'>Password</label>
                        <input type="password" id='password' name='password' required="true" size="22"/>
                        </div>
                        <div id='row'>
                            <label for='password'></label>
                            <input type="submit" id='login' name='login' value="Login" />
                            <input type="submit" id='cancel' name='cancel' value="Cancel" />
                        </div>
                    </form>
                </div>
            </div>            
        </div>
        <?php include 'includes/footer.php';?>

    </body>
</html>
