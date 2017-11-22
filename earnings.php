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
            <?php

            use com\light\sql\SQLConnection;
            ?>
            <?php include 'includes/user/sidebar.php'; ?>
            <div id='content'>
                <ul>
                    <li id="h" class="grey">History</li>
                    <li id="c" class="green">Current</li>
                    <li id="f" class="blue">Future</li>
                </ul>
            </div>
            <div id="history" style="display:none">
                <!--<p>History Shows Here.</p>-->
                <?php
                $sql = new SQLConnection(SQLConnection::MYSQL, "bonus_reward_history", "joe");
                $con = $sql->getDbConnection();
                $query = "select iid, vbonusdesc,vrewarddesc from bonus_reward_history where vusername='" . $subject->getPublicCred()->getValue() . "'";
                $result = $con->query($query);
                echo "<table class='admintable'>";
                echo "<tr><th>IID</th><th>Bonus Description</th><th>Reward Description</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row['iid'] . "</td><td>NGN" . number_format($row['vbonusdesc'], 2) . "</td><td>" . $row['vrewarddesc'] . "</td></tr> <br>";
                }
                echo "</table>";
                ?>
            </div>
            <div id="current" style="display:none">
                <?php
                new SQLConnection(SQLConnection::MYSQL, "bonus_reward_current", "joe");
                $con = $sql->getDbConnection();
                $query = "select iid,vbonusdesc,vrewarddesc,vstatus from bonus_reward_current where (vstatus='Request' OR vstatus='Processing') AND vusername='" . $subject->getPublicCred()->getValue() . "'";
                $result = $con->query($query);
                ?>
                <table class="admintable"><tr><th>Title</th><th>Description</th><th>Status</th></tr>
                    <?php
                    echo "<form action='src/requestbonus.php' method='post'>";
                    while ($row = $result->fetch_assoc()) {
                        if ($row['vstatus'] === "Request") {
                            echo "<tr><td>Bonus</td><td>NGN" . number_format(floatval($row['vbonusdesc'])) . "</td><td><button>" . $row['vstatus'] . "</button></td></tr>";
                            echo "<input name='bonus' type='hidden' value=" . floatval($row['vbonusdesc']) . "/>";
                        } else {
                            echo "<tr><td>Bonus</td><td>NGN" . number_format(floatval($row['vbonusdesc'])) . "</td><td>" . $row['vstatus'] . "</td></tr>";
                        }
                    }
                    $result->data_seek(0);
                    echo "</form>";
                    echo "<form action='src/requestreward.php' method='post'>";
                    while ($row = $result->fetch_assoc()) {
                        if ($row['vrewarddesc'] === 'No Rewards.') {
                            echo "<tr><td>Reward</td><td>" . $row['vrewarddesc'] . "</td><td></td></tr>";
                        } else {
                            echo "<tr><td>Reward</td><td>" . $row['vrewarddesc'] . "</td><td><button>Request</button></td></tr>";
                        }
                    }
                    echo "</form>";
                    ?> 
                </table>
            </div>
            <div id="future" style="display:none">
                <?php
                $sql = new SQLConnection(SQLConnection::MYSQL, "bonus_reward_future", "joe");
                $con = $sql->getDbConnection();
                $query = "select * from bonus_reward_future where vstageid='" . $ref->getStage() . "'";
                $result = $con->query($query);
                echo "<table class='admintable'>";
                echo "<tr><th>IID</th><th>Bonus Description</th><th>Reward Description</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row['vstageid'] . "</td><td>" .($row['vbonusdesc']). "</td><td>" . $row['vrewarddesc'] . "</td></tr> <br>";
                }
                echo "</table>";
                ?>
            </div>
        </div>
        <?php include 'includes/footer.php'; ?>

    </body>
</html>
