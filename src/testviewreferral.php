<?php ?>
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
        <link href="../css/main.css" rel='stylesheet' type="text/css"/>
        <script src="../js/main.js"></script>
        <script src="https://www.gstatic.com/charts/loader.js"></script>

    </head>
    <body>
<?php include '../includes/nav.php'; ?>
        <div id="container">
        <?php include '../includes/user/sidebar.php'; ?>
        <?php

        use com\light\util\ReferralDisplayManager;

        spl_autoload_register(function ($classname) {
            $directory = str_replace('\\', '/', $classname);
            $filename = __DIR__ . '/classes/' . $directory . '.php';
            //echo $filename;
            require_once $filename;
        });

//require_once '/root/NetBeansProjects/joe/src/classes/com/light/util/ReferralDisplayManager.php';

        $refMangr = new ReferralDisplayManager();
        $data = $refMangr->buildForGoogle([$subject->getPublicCred()->getValue()]);
        //print_r($refMangr->buildTreeV2([$subject->getPublicCred()->getValue()], $refMangr->getData()));
       
        ?>
        
            <script>
                 //https://developers.google.com/chart/interactive/docs/gallery/orgchart
                google.charts.load('current', {packages: ["orgchart"]});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var table = <?php echo json_encode($data) ?>;
                    var jtable = JSON.parse(JSON.stringify(table));
                    var data = new google.visualization.DataTable();                    
                    data.addColumn('string', 'Name');
                    data.addColumn('string', 'Add');
                    data.addRows(jtable);
                    //Create the chart
                    var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
//                    chart.size = 'small';
                    chart.draw(data, {allowHtml: true});
                }
            </script>
            <div id='content'>
                <h1 style="text-align: center">Your Referrals</h1>
                <div id="chart_div"></div>
            </div>
        </div>
<?php include '../includes/footer.php'; ?>

    </body>
</html>
