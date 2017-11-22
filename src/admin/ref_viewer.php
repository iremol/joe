
<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome to Joe's MLM Site: Request Viewer</title>
        <link href="../../css/main.css" rel='stylesheet' type="text/css"/>
        <script type="text/javascript" src="../../js/main.js"></script>
    </head>
    <body>
        <?php include '../../includes/nav.php'; ?>

        <?php

        use com\light\sql\SQLConnection; ?>
        <div id="container">            
            <div id='content'>
                <?php
                $f_handle = rtrim(__DIR__, "/admin");
                include $f_handle . "/classes/com/light/sql/SQLConnection.php";
                include $f_handle . "/classes/com/light/sql/MySQLDbConfig.php";
                $username = filter_input(INPUT_GET, "username");
                $sql = new SQLConnection(SQLConnection::MYSQL, "biodata", "joe");
                $con = $sql->getDbConnection("joe");
                $query = "select * from biodata where vusername='" . $username . "'";
                $res = $con->query($query);
                ?>
                <div>
                <table class='admintable' style="margin-bottom: 10px;">
                    <tr><th>S/N</th><th>First Name</th><th>Other Name</th><th>Last Name</th><th>Date of Birth</th><th>Email</th><th>City</th><th>Phone</th><th>Country</th><th>Username</th></tr>
                    <?php
                        while ($row = $res->fetch_assoc()) {
                        echo "<tr>";
                        foreach ($row as $value) {
                            echo '<td>' . $value . '</td>';
                        }
                        echo "</tr>";
                    }
                    $con->close();
                    ?>
                </table>
                    <div><button onclick="window.close()" style="float: right;">Close</button></div>
                </div>
            </div>
        </div>
        <?php include '../../includes/admin/footer.php';
        ?>

    </body>
</html>
