<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\util;

/**
 * Description of ReferralDisplayManager
 *
 * @author Imole Akpobome
 */
use com\light\sql\SQLConnection;

//require_once '/root/NetBeansProjects/joe/src/classes/com/light/sql/SQLConnection.php';

class ReferralDisplayManager {

    private $data;

    /**
     * Construct a new ReferralDisplayMnager Instance
     * initiating $data with the referral data in the database table.
     */
    public function __construct() {
        $this->data = $this->buildData();
    }

    /**
     * 
     * @return type $data
     */
    public function getData() {
        return $this->data;
    }

    private function buildData() {
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

    /**
     * @deprecated
     * @param array $username
     * @param type $data
     * @param type $gencontainer
     * @return array
     */
    private function buildTree(array $username, $data, &$gencontainer = []) {
        $rows = (count($data));
        $counter = 0;
        $gen = $nextusername = [];
        foreach ($username as $value) {
            while ($counter < $rows) {
                if (array_search($value, $data[$counter])) {
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
            $this->buildTree($nextusername, $data, $gencontainer);
        }
        return $gencontainer;
    }

    /**
     * THis method is for testing purposes only.
     * @param array $username
     * @param type $data
     * @param type $gencontainer
     * @return array
     */
    public function buildTreeV2(array $username, $data, &$gencontainer = []) {
        //Arrays for holding the generational data and owner of 
        //such generational data.
        $gen = $nextusername = [];
        $index = 0;
        foreach ($username as $value) {
            foreach ($data as $row) {
                if (array_search($value, $row)) {
//                    print_r($row);
//                    echo "<br><br><br><br><br>";
                    //Assigns both the next set of usernames and generational data to
                    //the local variables $gen and $nextusername.
                    $nextusername[$index] = $gen[$index] = $row[0];
                    $index++;
                }
            }
//            if (!empty($gen)) {
//                $gencontainer[$value] = $gen;
//            }
            if (count($gen) > 0) {
                $gencontainer[$value] = $gen;
            } else {
                $gencontainer[$value] = $gen;
            }
            //This array is reintialised on every recursion.
            $gen = [];
        }
        if (count($nextusername) > 0) {
            $this->buildTreeV2($nextusername, $data, $gencontainer);
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
    private function buildTreeForGoogle(array $username, $data, &$gencontainer = []) {
        //Arrays for holding the generational data and owner of 
        //such generational data.
        $gen = $nextusername = [];
        //Counter for the array to store the referral names.
        $index = 0;
        foreach ($username as $value) {
            foreach ($data as $row) {
                //check if the name is in that particular row. This ascertains if the referral was brought by that username.
                if (array_search($value, $row)) {
                    //Assigns both the next set of usernames and generational data to
                    //the local variables $gen and $nextusername.
                    $nextusername[$index] = $gen[$index] = $row[0];
                    //increase the counter by 1.
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
        //if the nextusername arrayis not null. Then the buildTreeForGoogle should be called again.
        if (count($nextusername) > 0) {
            $this->buildTreeForGoogle($nextusername, $data, $gencontainer);
        }
        return $gencontainer;
    }

    /**
     * This is for test purposes.
     * @param type $source
     * @return type
     */
    public function buildTable($source) {
//Returns the keys of the associative array.
        $keys = array_keys($source);
//        echo "<br><br><br><br><br><br><br>";
//        print_r($keys);
        //exit();
        $counter = 0;
        $temp = [];
        foreach ($keys as $value) {
            $index = 0;
//            while ($index < count($source[$value])) {
//                $temp[$counter] = [$source[$value][$index], $value];
//                $index++;
//                $counter++;
//            }
            foreach ($source[$value] as $item) {
                $temp[$counter] = [$item, $value];
                $counter++;
            }
            $index++;
        }
        return $temp;
    }

    /*     * This method is defective
     * 
     * @param type $source
     * @return type
     */

    private function buildTableForGoogleV1($source) {
//Returns the keys of the associative array.
        $keys = array_keys($source);
        $counter = 0;
        $temp = [];
        foreach ($keys as $value) {
            $index = 0;
            while ($index < count($source[$value])) {
                $temp[$counter] = [$source[$value][$index], $value];
                $index++;
                $counter++;
            }
        }
        return $temp;
    }

    private function buildTableForGoogleV2($source) {
//Returns the keys of the associative array.
        $keys = array_keys($source);
        $counter = 0;
        $temp = [];
        foreach ($keys as $value) {
            foreach ($source[$value] as $item) {
                $temp[$counter] = [$item, $value];
                $counter++;
            }
        }
        return $temp;
    }

    public function buildForGoogle(array $username, &$gencontainer = []) {
        $data = $this->buildData();
        return $this->buildTableForGoogleV2($this->buildTreeForGoogle($username, $data, $gencontainer));
        //return $this->buildTable($this->buildTreeV2($username, $data, $gencontainer));
    }

}
