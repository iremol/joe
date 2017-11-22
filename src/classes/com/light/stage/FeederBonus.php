<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\stage;

/**
 * Description of FeederBonus
 *
 * @author Imole Akpobome
 */
use com\light\sql\SQLConnection;

require_once '/root/NetBeansProjects/joe/src/classes/com/light/sql/SQLConnection.php';

require_once 'Bonus.php';

class FeederBonus implements Bonus {
    const DOWNLINE = 6;

    //put your code here
    /*
      public function getBonus(): float {
      $sql = new SQLConnection(SQLConnection::MYSQL,'bonus','joe');
      $con = $sql->getDbConnection();
      $total = [];
      $index = 0;
      $query = "select total from {$sql->getSchema()}.{$sql->getTableName()} where vstage='FEEDER'";
      $res = $con->query($query);
      while($line = $res->fetch_assoc()){
      $total[$index] = $line['total'];
      $index++;
      }
      return array_sum($total);
      }
     * 
     */

    public function getBonus():float {
        $stepout = self::STEPOUT * self::DOWNLINE;
        $matrix = (self::INVESTMENT * self::DOWNLINE) * self::MATRIX;
        return $stepout + $matrix;
    }

}
