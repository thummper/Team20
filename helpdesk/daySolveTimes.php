<?php
/* 
daySolveTimes.php 

This script is executed automatically once a day - it will work out the average ticket solve time for the entire previous day 
(Will execute at say 00:01 and get the average solve time of the day before)
Data is saved in a text file and is used in analytics.php

*/
include("config.php");
require_once('myFunctions.php');
$conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname);
if($conn -> connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else { 
//This will execute at like 0:00:01 - so have to get tickets from the day before.
    //Time range will be from today - 1  to today - 1 23:59:59
    $today = date("Y-m-d H:i:s");  
    //Get yesterday
    $dateR = date('Y-m-d H:i:s',(strtotime ( '-1 day' , strtotime ($today) ) ));
    //Yesterday from 00:00:00 to 23:59:00 
    $lessThan = date_time_set(date_create($dateR), 23, 59, 59);
    $moreThan = date_time_set(date_create($dateR), 00, 00, 00);
    $lt = $lessThan->format("Y-m-d H:i:s");
    $mt = $moreThan->format("Y-m-d H:i:s");
    //Get all tickets between the set times
    $sql = "SELECT * FROM Ticket WHERE Resolved = 'Y' AND Date_Made BETWEEN '$mt' AND '$lt'";
  
    $result = $conn->query($sql);
    if($result){
        $totalTime;
        $numTimes = 0;
        
        while($row = $result->fetch_assoc()){
            //Work out the difference between made/solved
            $startS = strtotime($row["Date_Made"]);
            $endS = strtotime($row["Date_Solved"]);
            $diff = ($endS - $startS)/60;
            if($totalTime == NULL){
                $totalTime = $diff;
            } else {
                $totalTime += $diff;
            }
            $numTimes++;
        }
        
        //Work out and round average ticket solve time.
        $avTicket = ceil($totalTime/$numTimes);
        
        if(is_nan($avTicket) ){
            $avTicket = 0;
        }
        echo "av: ".$avTicket;
        //Get yesterdays date
        $yest = date('d/m',strtotime("-1 days"));
        
        //Open the file to store data 
        $arrFile = fopen("/var/www/html/stats/dailySolve.txt", "r+");
        $arrayContents = file_get_contents("/var/www/html/stats/dailySolve.txt");
        
        //Make an array to store in file
        if($arrayContents == NULL){
        
        //There's no array so make one.
        $array = array(array($yest, $avTicket));
        $makeArrayEncoded = json_encode($array);
        file_put_contents("/var/www/html/stats/dailySolve.txt", $makeArrayEncoded);
            
    
        } else {
        $decodedArray = json_decode($arrayContents, true);
        if(sizeof($decodedArray) < 7){
            //There's room in the array
            $toAdd = array($yest, $avTicket);
            array_push($decodedArray, $toAdd); 

        } else {
            //No room in array. 
            array_shift($decodedArray);
            $toAdd = array($yest, $avTicket);
            array_push($decodedArray, $toAdd);
        }
            
        //Save the array in the file
        $finalArray = json_encode($decodedArray);
        echo "Pushing: $finalArray<br>";
        file_put_contents("/var/www/html/stats/dailySolve.txt", $finalArray);
        

    }
    }else {
     //ERROR
        echo "ERROR: ". $conn->error;
    }
}
?>