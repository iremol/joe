<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace com\light\stage;

use com\light\util\ReferralDisplayManager;

/**
 * Description of Stage
 * THis Class is a representation of the 
 * several stages a sponsor can be in.
 *
 * @author Imole Akpobome
 * 
 */
class Stage {

    const ID = ["FEEDER", "BRONZE", "SILVER", "GOLD", "DIAMOND"];

    /**
     * @method constructor __construct(string $id) The constructor returns
     * a <code>@name Stage</code> instance following the id passed at runtime.
     * @param string id
     */
    public function __construct(string $id) {
        /* performs a search of id in the array and returns key if found
         * else it returns false.
         */
        $key = array_search(strtoupper($id), Stage::ID);
        if ($key === FALSE) {
            throw new \Exception("Error: There is a problem with the stage", "100");
        }
        switch ((int) $key) {
            case 0:
                echo (new FeederBonus())->getBonus();
                break;
            case 1:
                echo "BronzeBonus";
                break;
            case 2:
                echo "SilverBonus";
                break;
            case 3:
                echo "GoldBonus";
                break;
            case 4:
                echo "DiamondBonus";
                break;
        }
    }

    /**
     * @name loadStage
     * @static
     * performs a check on the number of referrals and return the appropriate stage.
     * @param type $count
     * @return string
     */
    private static function loadStage($count) {
        if (($count >= 0) && ($count < 3)) {
            return Stage::ID[0];
        } elseif (($count >= 3) && ($count < 15)) {
            return Stage::ID[1];
        }elseif(($count >= 15) && ($count < 63)){
            return Stage::ID[2];
        } 
        elseif(($count >=63) && ($count< 255)){
            return Stage::ID[3];
        }
        elseif(($count >= 255) &&($count<1023)){
            return Stage::ID[4];
        } 
        else {
            return "Not a valid Stage";
        }
    }

    public function isFeederStage(array $source, $sponsor): bool {
        //check if the sponsor has 2 or more direct referral.  
        $directRef = count($source[$username]);
        echo $directRef . "<br>";
        if ($directRef < 2) {
            echo "Still in feeder stage";
            return true;
        }
        //Count the direct downlines of the refs if there are 2 or more that has 2 direct downlines.
        $count = 0;
        foreach ($source[$username] as $refs) {
            if (count($source[$refs]) >= 2) {
                $count++;
            }
        }
        if (count >= 2) {
            return true;
        } else {
            return false;
        }
    }

    private static function checkStage(array &$sponsorList, array $source, &$determinant = 0, &$counter = 0, &$counter2 = 0, &$counter3 = 0) {
        $index = 0;
        $sponsorList2 = [];
        $counter3 = ($counter3 * 2) + 1;
        foreach ($sponsorList as $sponsor) {
            if (count($source[$sponsor]) >= 2) {
                foreach ($source[$sponsor] as $ref) {
//                if (count($source[$sponsor]) >= 2) {
                    $sponsorList2[$index] = $ref;
                    $index++;
                }
                $counter2++;
                //$determinant = ($determinant *2)+1;
                //echo '<br>Generation ' . $counter2 . '<br>';
            }
        }
        if ((!empty($sponsorList2)) && ($counter2 >= $counter3)) {
            $counter += $index;
            //echo '<br><br>';
            //print_r($sponsorList2);
            //echo '<br>';
            Stage::checkStage($sponsorList2, $source, $determinant, $counter, $counter2, $counter3);
        }
//        } else {
//            // echo $counter . '<br>';
//            //echo $counter2;
//            return $counter2;
//        }
        return $counter2;
    }

    /**
     * @name getStage()
     * @static
     * @return string
     */
    public static function getStage($username): string {
        $refDisplayMangr = new ReferralDisplayManager();
        $data = $refDisplayMangr->getData();
        $gendata = $refDisplayMangr->buildTreeV2([$username], $data, $gencontainer = []);
        $users = [$username];
        $count = Stage::checkStage($users, $gendata, $determinant, $counter, $counter2, $counter3);
        return Stage::loadStage($count);
    }

}
