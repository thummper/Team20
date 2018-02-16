<?php 
/* 
getSovleTimes.php 

This file gets the fastest, slowest and average solve times of all solved tickets in the system.

Made by: Jake, Dennis

*/
//Get fastest, slowest, average ticket solve times. 
$var = $_GET["var"];
include("config.php");
require_once('myFunctions.php');
$conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname);
if($conn -> connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else {
    //Connection is ok.
    //Get all soved tickets 
    $sql = "SELECT * FROM Ticket WHERE Resolved = 'Y'";
    //I think one at top should be overall average ticket solve time - daily solve time needs to be daily though, pain because of the way the dates are formatted. 
    $result = $conn->query($sql);
    $totalTime = 0;
    $numTimes = 0;
    $fastest = 0;
    $slowest = 0;
    if($result){
    while($row = $result->fetch_assoc()){
        
        $startS = strtotime($row["Date_Made"]);
        $endS = strtotime($row["Date_Solved"]);
        $diff = ($endS - $startS)/60;
        if($diff < $fastest){
            $fastest = $diff;
            }
        if($diff > $slowest){
            $slowest = $diff;
        }
        $totalTime += $diff;
        $numTimes++;
    }
    }
    $globalAvgSolve = ceil($totalTime/$numTimes);
    
    if($var === "globalAv"){
        echo $globalAvgSolve;
    } else if($var === "fastest"){
        echo $fastest;
    } else if($var === "slowest"){
        echo $slowest;
    } else if($var === "all"){
        $output = array($fastest, $globalAvgSolve, $slowest);
     
        $jsonOutput = json_encode($output);
        echo $jsonOutput;
    }
}
?> 