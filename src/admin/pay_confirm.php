<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome to Joe's MLM Site: Request Viewer</title>
        <link href="../../css/main.css" rel='stylesheet' type="text/css"/>
        <script type="text/javascript" src="../../js/main.js"></script>
    </head>
    <body>
        <?php include '../../includes/nav.php'; ?>
        <div id="container">
            <?php include '../../includes/admin/sidebar.php'; ?>
            <?php include '../../includes/admin/profile.php'; ?>
            <?php use com\light\sql\SQLConnection; ?>
            <div id='content'>
                <table class="admintable">
                    <tr><th>Referral</th><th>Bonus Amount</th><th>Account Number</th><th>Date of Request</th><th>Payment Deadline</th><th></th></tr>
                    <?php
                    $sql = new SQLConnection(SQLConnection::MYSQL, "claims", "admin_joe");
                    $con = $sql->getDbConnection("admin_joe");
                    $query = "select * from claims where vstatus is null";
                    $res = $con->query($query);
                    while ($row = $res->fetch_assoc()) {
                        //echo "<tr><td><a href='ref_viewer.php?username=".$row['vref_username']."'><button onclick=window.open('ref_viewer.php?username='".$row['vref_username']."','View','status=no')>".$row['vref_username']."</button></a></td><td>".$row['fbonus_amt']."</td><td>".$row['vaccnum']."</td><td>".$row['ddateofreq']."</td><td>".$row['ddeadline']."</td></tr>";
                        echo "<tr><td>".$row['vref_username']."</td><td>NGN".number_format($row['fbonus_amt'],2)."</td><td>".$row['vaccnum']."</td><td>".$row['ddateofreq']."</td><td>".$row['ddeadline']."</td><td><a href='confirm_pay.php?username=".$row['vref_username']."'><button>Confirm Payment</button></a></td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
        <?php include '../../includes/admin/footer.php'; ?>

    </body>
</html>
