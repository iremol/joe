<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\stage;

/**
 * Description of GoldBonus
 *
 * @author Imole Akpobome
 */
require_once 'Bonus.php';
class GoldBonus implements Bonus{
    //put your code here
    const DOWNLINE = 384;
    public function getBonus(): float {
         $stepout = self::STEPOUT * self::DOWNLINE;
        $matrix = (self::INVESTMENT * self::DOWNLINE) * self::MATRIX;
        return $stepout + $matrix;
    }

}
