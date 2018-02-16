<?php 
/* 
getAnalytics.php

This file recieved requests and responds with: 
Total tickets in system 
Open tickets 
Closed tickets 

or an array of all 3

Made by: Simeon
*/

include("config.php");
require_once('myFunctions.php');
$var = $_GET["var"];
$totalTickets; $openTickets; $closedTickets;

$conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname);
if($conn -> connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else { 
    // Global Stats
    //1 - Global total tickets. 
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
    
    //2 - Open Tickets
    $sql = "SELECT COUNT(*) FROM Ticket WHERE Resolved LIKE 'N'";
    $result = $conn->query($sql);
    if($result){
         
     } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
     }
    while($row = $result->fetch_row()){
        foreach($row as $value){
            $openTickets = $value;
        }
    }
    
    //3 - Closed Tickets
  
    $sql = "SELECT COUNT(*) FROM Ticket WHERE Resolved LIKE 'Y'";
    $result = $conn->query($sql);
    if($result){
         
     } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
     }
    while($row = $result->fetch_row()){
        foreach($row as $value){
            $closedTickets = $value;
        }
    }
    
    if($var === "totalTickets"){
        echo $totalTickets;
    } else if($var === "openTickets"){
        echo $openTickets;
    } else if($var === "closedTickets"){
        echo $closedTickets;
    } else if($var === "all") {
        $data = array(
            array("Total Tickets", $totalTickets), array("Open Tickets", $openTickets), array("Closed Tickets", $closedTickets));
        $jsonData = json_encode($data);
       
        echo $jsonData;
    } else if($var === "openclosed"){
                $data = array(
             array("Open Tickets", $openTickets), array("Closed Tickets", $closedTickets));
        $jsonData = json_encode($data);
       
        echo $jsonData;
        
        
    }
}
?>
