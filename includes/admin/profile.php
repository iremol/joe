<?php

use com\light\util\ReferralDisplayManager;

//function __autoload ($classname) {
//    $directory = str_replace('\\', '/', $classname);
//    $filename = '/root/NetBeansProjects/joe/src' . '/classes/' . $directory . '.php';
//    require_once $filename;
//};
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/Subject.php';
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/Principal.php';
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/UserPrincipal.php';
//require_once '/root/NetBeansProjects/joe/src/classes/com/light/security/AdminPrincipal.php';


$refDisplayMangr = new ReferralDisplayManager();
$data = $refDisplayMangr->getData();
$gendata = $refDisplayMangr->buildTreeV2([$subject->getPublicCred()->getValue()], $data, $gencontainer = []);

//$table=$refDisplayMangr->buildTable($gendata);
//print_r($gendata);
//echo "<br><br><br><br><br><br><br>";
//$counter =  1;

function printHieChartCount(array $source, $username) {
    //check if the sponsor has 2 or more direct referral.  
    $feederCount = count($source[$username]);
    echo $feederCount . "<br>";
    if ($feederCount < 2) {
        echo "Still in feeder stage";
        exit();
    }
    //index should start with 1 since we are accessing the second array.
    $count = 0;
    foreach ($source[$username] as $refs) {
        if (count($source[$refs]) >= 2) {
            $count++;
        }
    }
    return $count;
}

//echo printHieChartCount($gendata, $subject->getPublicCred()->getValue());

function getStage(array &$sponsorList, array $source, &$determinant = 0, &$counter = 0,&$counter2=0, &$counter3=0) {
    $index = 0;
    $sponsorList2 = [];
    $counter3 = ($counter3 * 2) +1;
    foreach ($sponsorList as $sponsor) {
        if (count($source[$sponsor]) >= 2) {            
            foreach ($source[$sponsor] as $ref) {
//                if (count($source[$sponsor]) >= 2) {
                $sponsorList2[$index] = $ref;
                $index++;
            }
            $counter2++;
            //$determinant = ($determinant *2)+1;
            echo '<br>Generation '.$counter2.'<br>';
        }
    }
    if ((!empty($sponsorList2)) && ($counter2>=$counter3)) {
        $counter += $index;
        echo '<br><br>';
        print_r($sponsorList2);
        echo '<br>';
        getStage($sponsorList2, $source, $determinant, $counter,$counter2,$counter3);
        
    } else {
        echo $counter.'<br>';
        echo $counter2;
    }
}

//$users = [$subject->getPublicCred()->getValue()];
//getStage($users, $gendata);
//exit();
