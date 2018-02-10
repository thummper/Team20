<?php 

/* 
Will run hourly. 
Stores number of tickets in file.
Does current tickets - tickets in file to get the number of tickets made in that hour. 
Array of tickets made hourly for last 12 hours stored in a file
if size < 12 it can add the time and tickets made 
if size > 12 remove the first entry in the array and add this. 




1 - Get current tickets.
*/ 
include("config.php");
require_once('myFunctions.php');







$conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname);
if($conn -> connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else { 
    
$totalTickets;    
$sql = "SELECT COUNT(*) FROM Ticket";
$result = $conn->query($sql);
   
     if($result){
         
     } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
     }
    while($row = $result->fetch_row()){
        foreach($row as $value){
           $totalTickets = $value;
        }
    }
//We have total tickets - check file for last total.
$txtFile = fopen("/var/www/html/stats/hourly.txt", "r+");  


$current = file_get_contents("/var/www/html/stats/hourly.txt");
  
//What we actually need.
$lastHour = $totalTickets - $current;
  
    
//Update file with this total

file_put_contents("/var/www/html/stats/hourly.txt", $totalTickets);
if($txtFile){
fclose($txtFile);
}
    
    
//Seems to work kinda - need to store the values somewhere now.
//Now we would retrieve the array from some other file.
$arrFile = fopen("/var/www/html/stats/hourlyArray.txt", "r+");
$arrayContents = file_get_contents("/var/www/html/stats/hourlyArray.txt");
$time = date("H");
if($arrayContents == NULL){
    
    //There's no array so make one. 
    $makeArray = array(array($time, $lastHour));
    $makeArrayEncoded = json_encode($makeArray);
    file_put_contents("/var/www/html/stats/hourlyArray.txt", $makeArrayEncoded);
} else {
    $decodedArray = json_decode($arrayContents, true);
    if(sizeof($decodedArray) < 12){
        //There's room in the array
        $toAdd = array($time, $lastHour);
        array_push($decodedArray, $toAdd); 
        
    } else {
        //No room in array. 
        array_shift($decodedArray);
        $toAdd = array($time, $lastHour);
        array_push($decodedArray, $toAdd);
    }
    $finalArray = json_encode($decodedArray);
    file_put_contents("/var/www/html/stats/hourlyArray.txt", $finalArray);
    
    
}
//Should be a normal array at this point.


}


?>