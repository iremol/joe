<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\stage;

/**
 *
 * @author Imole Akpobome
 */
interface Bonus {
    const INVESTMENT = 10000;
    const STEPOUT = 2000; //represents  20% 
    const MATRIX = 0.2; // represents 20%
    /**
     * 1.Total Downline * 20% of total investment
     * 2. 20% of total investment of the stage.
     */
    public function getBonus() : float;
}