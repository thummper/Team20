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
$txtFile = fopen($_SERVER["DOCUMENT_ROOT"]."/stats/hourly.txt", "r+");  


$current = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/stats/hourly.txt");
cLog("Getting Contents : " . $current);   
//What we actually need.
$lastHour = $totalTickets - $current;
cLog("Getting LH : " . $lastHour);  
    
//Update file with this total
cLog("Putting: " . $totalTickets . " in file");
file_put_contents($_SERVER["DOCUMENT_ROOT"]."/stats/hourly.txt", $totalTickets);
if($txtFile){
fclose($txtFile);
}
    
    
//Seems to work kinda - need to store the values somewhere now.


}


?>