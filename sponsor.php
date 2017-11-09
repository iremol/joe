<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome to Joe's MLM Site</title>
        <link href="css/main.css" rel='stylesheet' type="text/css"/>
        <script src="js/main.js" type="text/javascript"></script>
    </head>
    <body>
        <?php include 'includes/nav.php'; ?>
        <div id="container">
            <?php include 'includes/sidebar.php'; ?>
            <div id='content'>
                <h2>Referral Registration</h2>
                <div id='form'>
                    <!--<form action="src/testregistration.php" method="post">-->
                    <form action="sponsor2.php" method="post">
                        <div id="caption">
                            <p>Sponsor Detail</p>
                        </div>
                        <div id='row'>
                            <label for='sponsor'>Sponsor Id</label>
                            <input type="text" id='sponsor' name='sponsor' required size="22"/>
                        </div>
                        <div id="caption">
                            <p>Login Details</p>
                        </div>
                        <div id='row'>
                            <label for='username'>Email</label>
                            <input type="text" id='username' name='username' required size="50"/>
                        </div>
                        <div id='row'>
                            <label for='password'>Password</label>
                            <input type="password" id='password' name='password' required size="22"/>
                        </div>
                        <div id='row'>
                            <label for='re-password'>Re-Password</label>
                            <input type="password" id='re-password' name='re-password' required size="22" />
                        </div>
                        <input type="hidden" id='principal' name='principal' value="UserPrincipal"/>
                        <div id='row'>
                            <label for='password'></label>
                            <input type="submit" id='continue' name='continue' value="Continue" />
                            <input type="submit" id='cancel' name='cancel' value="Cancel" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>
