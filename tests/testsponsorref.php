<html>
    <?php
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    use com\light\sql\SQLConnection;

require_once '/root/NetBeansProjects/joe/src/classes/com/light/sql/SQLConnection.php';

    function buildData() {
        $data = [];
        $sql = new SQLConnection(SQLConnection::MYSQL, "referral", "joe");
        $con = $sql->getDbConnection();
        $query = $sql->get_mysql_select_all();
        $res = $con->query($query);
        $counter = 0;
        while ($row = $res->fetch_assoc()) {
            $data[$counter] = [$row['vusername'], $row['vsusername']];
            $counter++;
        }
        $con->close();
        return $data;
    }

    function printTree(array $username, $data) {
        $rows = (count($data));
        $counter = 0;
        $nextusername = [];
        foreach ($username as $value) {
            echo $value . ":<br>";
            while ($counter < $rows) {
                if (array_search($value, $data[$counter]) == 1) {
                    $nextusername[$counter] = $data[$counter][0];
                    echo "&Longrightarrow;";
                    echo $data[$counter][0] . "<br>";
                }
                $counter++;
            }
            $counter = 0;
        }
        if (count($nextusername) > 0) {
            printTree($nextusername, $data);
        }
    }

    function buildTree(array $username, $data, &$gencontainer = []) {
        $rows = (count($data));
        $counter = 0;
        $gen = $nextusername = [];
        foreach ($username as $value) {
            while ($counter < $rows) {
                if (array_search($value, $data[$counter]) == 1) {
                    $nextusername[$counter] = $data[$counter][0];
                    $gen[$counter] = $data[$counter][0];
                }
                $counter++;
            }
            if (count($gen) > 0) {
                $gencontainer[$value] = $gen;
            } else {
                $gencontainer[$value] = $gen;
            }
            $counter = 0;
            $gen = [];
        }
        if (count($nextusername) > 0) {
            buildTree($nextusername, $data, $gencontainer);
        }
        return $gencontainer;
    }
    /**
     * This function returns an array that will not allow 
     * empty generational data to be added to it. It is designed for the
     * Google Chart API.
     *  
     * @param array $username
     * @param type $data
     * @param type $gencontainer
     * @return array
     */

    function buildTreeForGoogle(array $username, $data, &$gencontainer = []) {
        //Arrays for holding the generational data and owner of 
        //such generational data.
        $gen = $nextusername = [];
        
        foreach ($username as $value) {
            $index = 0;
            foreach ($data as $row) {
                if (array_search($value, $row)) {
                    //Assigns both the next set of usernames and generational data to
                    //the local variables $gen and $nextusername.
                    $nextusername[$index] = $gen[$index] = $row[0];
                    $index++;
                }
            }
            //Performs a check if the username in context does 
            //generational data. If it has it is stored in the generational data 
            //container.
            if (!empty($gen)) {
                $gencontainer[$value] = $gen;
            }
            //This array is reintialised on every recursion.
            $gen = [];
        }
        if (count($nextusername) > 0) {
            buildTreeForGoogle($nextusername, $data, $gencontainer);
        }
        return $gencontainer;
    }

    function buildTableForGoogle($source) {
        //Returns the keys of the associative array.
        $keys = array_keys($source);
        $counter = 0;
        $temp = [];
        foreach ($keys as $value) {
            $index = 0;
            while ($index < count($source[$value])) {
                $temp[$counter] = [$source[$value][$index],$value];
                $index++;$counter++;
            }
        }
        return $temp;
    }

    $table = buildData();
    $data = buildTreeForGoogle(["joevic"], $table);
    $data = buildTableForGoogle($data);
//printTree(["admin"], $table);
    ?>

    <head>
        <script src="https://www.gstatic.com/charts/loader.js"></script>
        <script>
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
                chart.draw(data, {allowHtml: true});
            }
        </script>
    </head>
    <bodY>
        <div id="chart_div"></div>
    </bodY>
</html>