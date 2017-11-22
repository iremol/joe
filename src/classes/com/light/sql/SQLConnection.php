<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\sql;

/**
 * Description of SQLConnection
 *
 * @author root
 */
//define(POSTGRES, "postgresql");
//define(MSSQL, "mssql");
//define(MYSQL, "mysql");
use com\light\sql\MySQLDbConfig;

//require_once '/root/NetBeansProjects/joe/src/classes/com/light/sql/MySQLDbConfig.php';

class SQLConnection {

//Database brand  being used which determines the connection to use.
    const POSTGRES = "postgresql";
    const MSSQL = "mssql";
    const MYSQL = "mysql";

    private $dbServerBrand;
//Server name of DB
    private $serverName;
//Username
    private $user;
//Password
    private $pass;
//Port number
    private $port;
// Db name
    private $dbname;
//Db connection
    private $dbConn;
//Table -array of the column names of the table
    private $fieldNameArray = array();
//Table -array of the column datatype of the table
    private $fieldTypeArray = array();
//Table - name of the table working with
    private $tableName;
//Table - schema the table belongs to.
    private $schema;

    /**
     * 
     * @param type $dbServerBrand
     * @param type $serverName
     * @param type $user
     * @param type $pass
     * @param type $port
     * @param type $dbname
     * @param type $schema
     * @param type $tableName
     */
    public function __construct($dbServerBrand, $tableName = "", $schema = "", $serverName = "", $user = "", $pass = "", $port = "", $dbname = "") {
        $this->dbServerBrand = $dbServerBrand;
        $this->serverName = $serverName;
        $this->user = $user;
        $this->pass = $pass;
        $this->port = $port;
        $this->dbname = $dbname;
        $this->schema = $schema;
        $this->tableName = $tableName;
    }

    /**
     * creates a connection to the MSSQL OR POSTGRES OR MYSQL database server.
     */
    private function connect(string $dbname = "") {
        if ($this->dbServerBrand == self::POSTGRES) {
            $this->dbConn = pg_connect("host=localhost dbname=npdcbi user=npdcbi password=Passw0rd")
                    or die('Could not connect: ' . pg_last_error());
        } elseif ($this->dbServerBrand == self::MSSQL) {
            //$serverName = "10.80.0.61";
            $serverName = "127.0.0.1";
            //$connectionInfo = array("Database" => "NPDCBI", "UID" => "biadmin", "PWD" => "PARA123key","ReturnDatesAsStrings"=>true);
            $connectionInfo = array("Database" => "npdcbi", "UID" => "SA", "PWD" => "Passw0rd", "ReturnDatesAsStrings" => true);
            $this->dbConn = sqlsrv_connect($serverName, $connectionInfo) or print_r(sqlsrv_errors());
        } elseif (($this->dbServerBrand == self::MYSQL)) {
            if ($dbname === "") {
                $this->dbConn = new \mysqli(MySQLDbConfig::DBHOST, MySQLDbConfig::DBUSER, MySQLDbConfig::DBPASS, MySQLDbConfig::DBNAME);
            } else {
                $this->dbConn = new \mysqli(MySQLDbConfig::DBHOST, MySQLDbConfig::DBUSER, MySQLDbConfig::DBPASS, $dbname);
            }
            if ($this->dbConn->connect_errno) {
                throw new \Exception("MySQL Error: " . $this->dbConn->connect_error);
            }
        } else {
            echo "Sorry Does not support brand yet";
        }
    }

    /**
     * Shows if the connect() method return a resource.
     */
    public function showConnect() {
        $this->connect();
        print_r($this->dbConn);
    }

    /**
     * Loads the meta data of the input mssql db table.
     */
    private function mssql_table_information() {
        $query = sqlsrv_query($this->dbConn, "select * from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='$this->tableName' and TABLE_SCHEMA='$this->schema'");
        //$query = sqlsrv_query($this->dbConn,"select * from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='communityleaders' and TABLE_SCHEMA='crd'");
        $counter = 0;
        while ($line = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
            similar_text($line["COLUMN_NAME"], $this->tableName . 'Id', $percent);
            if ($line["COLUMN_NAME"] == "block") {
                continue;
            } elseif ($line["COLUMN_NAME"] == "dtentrydate") {
                continue;
            } elseif ($line["COLUMN_NAME"] == "rid") {
                continue;
            } elseif ($percent > 75) {
                continue;
            } else {
                $this->fieldTypeArray[$counter] = $line["DATA_TYPE"]; // . PHP_EOL;
                $this->fieldNameArray[$counter] = $line["COLUMN_NAME"]; // . PHP_EOL;
                $counter++;
            }
        }
    }

    /**
     * Confirms loading data.
     */
    public function is_mssql_table_information() {
        $this->connect();
        $this->mssql_table_information();
        //foreach ($this->fieldNameArray as $fna) //{
        //    echo $fna . "<br>";
        //}
        return $this->fieldNameArray;
    }

    /**
     * Loads the meta data of the input postgres db table.
     */
    private function pgsql_table_information() {
        $this->connect();
//        $result = pg_query("select * from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='$this->tableName' and TABLE_SCHEMA='$this->schema'") or die('Query failed: ' . pg_last_error());
        $counter = 0;
        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            if ($line["column_name"] == "block") {
                continue;
            } elseif ($line["column_name"] == "dtentrydate") {
                continue;
            } else {
                $this->fieldTypeArray[$counter] = $line["data_type"]; // . PHP_EOL;
                $this->fieldNameArray[$counter] = $line["column_name"]; // . PHP_EOL;
                $counter++;
            }
        }
    }

    public function is_pgsql_table_information() {
        $this->connect();
        $this->pgsql_table_information();
        foreach ($this->fieldNameArray as $fna) {
            echo $fna . "<br>";
        }
    }

    /**
     * Loads the meta data of the input mysql db table.
     */
    private function mysql_table_information() {
        $this->connect();
        $result = $this->dbConn->query("select * from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='$this->tableName' and TABLE_SCHEMA='$this->schema'");
        $counter = 0;
        while ($line = $result->fetch_assoc()) {
            if ($line["COLUMN_NAME"] == "ibdid") {
                continue;
            } else if ($line["COLUMN_NAME"] == "irid") {
                continue;
            } else {
                $this->fieldTypeArray[$counter] = $line["DATA_TYPE"]; // . PHP_EOL;
                $this->fieldNameArray[$counter] = $line["COLUMN_NAME"]; // . PHP_EOL;
                $counter++;
            }
        }
    }

    public function is_mysql_table_information() {
        $this->connect();
        $this->mysql_table_information();
//        foreach ($this->fieldNameArray as $fna) {
//            echo $fna . "<br>";
//        }
    }

    /**
     * Builds the an insert statement based on the table columns
     */
    public function build_mssql_insert() {
        $queryString = "insert into $this->schema.$this->tableName (";
        for ($i = 0; $i < count($this->fieldNameArray); $i++) {
            $queryString .= $this->fieldNameArray[$i] . ",";
        }
        $queryString = substr($queryString, 0, strlen($queryString) - 1);
        $queryString .= ") values (";
        for ($i = 0; $i < count($this->fieldNameArray); $i++) {
            $queryString .= "?,";
        }
        $queryString = substr($queryString, 0, strlen($queryString) - 1);
        $queryString .= ")";
        return $queryString;
    }

    /**
     * shows the generated insert statement - debugging purpose only
     */
    public function is_build_mssql_insert() {
        echo $this->build_mssql_insert();
    }

    /**
     * Builds the an insert statement based on the table columns
     */
    private function build_pgsql_insert() {
        print_r($this->fieldNameArray);
        $queryString = "insert into $this->schema.$this->tableName (";
        for ($i = 0; $i < count($this->fieldNameArray); $i++) {
            $queryString .= $this->fieldNameArray[$i] . ",";
        }
        $queryString = substr($queryString, 0, strlen($queryString) - 1);
        $queryString .= ") values (";
        for ($i = 0; $i < count($this->fieldNameArray); $i++) {
            $queryString .= "\$" . ($i + 1) . ",";
        }
        $queryString = substr($queryString, 0, strlen($queryString) - 1);
        $queryString .= ")";
        return $queryString;
    }

    /**
     * shows the generated insert statement - debugging purpose only
     */
    public function is_build_pgsql_insert() {
        echo $this->build_pgsql_insert();
    }

    private function build_mysql_insert() {
        $queryString = "insert into $this->schema.$this->tableName (";
        for ($i = 0; $i < count($this->fieldNameArray); $i++) {
            $queryString .= $this->fieldNameArray[$i] . ",";
        }
        $queryString = substr($queryString, 0, strlen($queryString) - 1);
        $queryString .= ") values (";
        for ($i = 0; $i < count($this->fieldNameArray); $i++) {
            $queryString .= "?,";
        }
        $queryString = substr($queryString, 0, strlen($queryString) - 1);
        $queryString .= ")";
        return $queryString;
    }

    private function build_mysql_select_all() {
        $queryString = "select * from $this->schema.$this->tableName";
        return $queryString;
    }

    /**
     * shows the generated insert statement - debugging purpose only
     */
    public function is_build_mysql_insert() {
        echo $this->build_mysql_insert();
    }

    public function get_mysql_insert() {
        return $this->build_mysql_insert();
    }

    public function get_mysql_select_all() {
        return $this->build_mysql_select_all();
    }

    public function getDbConnection(string $dbname = "") {
        if (!$this->dbConn == NULL) {
            return $this->dbConn;
        } else {
            if ($dbname === "") {
                $this->connect();
                return $this->dbConn;
            }
            else{
                $this->connect($dbname);
                return $this->dbConn;
            }
        }
    }

    /**
     * This is suppose to allow the developer 
     * retrieve a record from any table as far as the key column and key is supplied.
     * @param type $keyColumn
     * @param type $key
     */
    public function getTableData($keyColumn, $key,$dbname=""): array {
        $this->connect($dbname);
        $query = "select * from $this->schema.$this->tableName where $keyColumn='$key'";
        $result = $this->dbConn->query($query);
        $row = "";
        if (!($row = $result->fetch_assoc())) {
            throw new \Exception("Wrong username of password.");
        }
        return $row;
    }

    public function getTableName() {
        return $this->tableName;
    }

    public function getSchema() {
        return $this->schema;
    }

    public function setTableName($tableName) {
        $this->tableName = $tableName;
    }

    public function setSchema($schema) {
        $this->schema = $schema;
    }

}
