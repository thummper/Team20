<?php 
include("config.php");
require_once('myFunctions.php');

$totalTickets;

$conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname);
if($conn -> connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else { 



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
    $conn->close;
}







echo "Ticket data has been submitted <br>";
$dataArray = json_decode($_POST["user_data"]);
var_dump($dataArray);
$hardwareArray = array();
$softwareArray = array();
$ticketID = $totalTickets + 1;

$dataArray[0]->Data = "'".$ticketID."'";
for($i = sizeof($dataArray); $i > 0; $i--){
    //Array is array inside arrays :^(
    echo "Testing: ".$dataArray[$i]->Field;
    if($dataArray[$i]->Field === "Hardware_ID"){
        echo "FOUND SW: ".$dataArray[$i]->Data;
        //Hardware Item, should be removed. 
        if($dataArray[$i]->Data === "'None'"){
            //Should be removed from main array but not added to dbase.
            unset($dataArray[$i]);
        } else {
            $temp = $dataArray[$i];
            unset($dataArray[$i]);
            array_push($hardwareArray, $temp);
            
        }
    } else if($dataArray[$i]->Field === "Software_ID"){
                //Hardware Item, should be removed. 
        if($dataArray[$i]->Data === "'None'"){
            //Should be removed from main array but not added to dbase.
            unset($dataArray[$i]);
        } else {
            $temp = $dataArray[$i];
            unset($dataArray[$i]);
            array_push($softwareArray, $temp);
            
        }
        
        
    }

    
}

var_dump($dataArray);
var_dump($hardwareArray);
var_dump($softwareArray);

//Now make all of our queries. 
$ticketSQL = "INSERT INTO `Ticket` ";
$ticketTables = "(";
$ticketValues = " VALUES (";
    
for($i = 0; $i < sizeof($dataArray); $i++){
    $item = $dataArray[$i];
    if($i + 1 == sizeof($dataArray)){
        //Last item (no commas)
        $ticketTables .= "`".$item->Field."`" . ")";
        if($item->Data === "NULL"){
            $ticketValues .= "NULL)";
        }else {
        $ticketValues .= $item->Data . ")";
        }
    } else {
        $ticketTables .= "`".$item->Field."`" . ", ";
        if($item->Data === "NULL"){
          $ticketValues .= "NULL, ";  
        }else{
        $ticketValues .= $item->Data . ", ";
        }
    }
    
    
}
//All is good here. 
$ticketfinal = $ticketSQL. $ticketTables. $ticketValues;
echo $ticketfinal;

//We need the ticket id.. 
//Could possiblt be multiple hardware and software queries? 
$hardwareQueries = array();
$softwareQueries = array(); 
if(sizeof($hardwareArray) > 0){
    //Make (multiple) hardware queries. 
    
    for($i = 0; $i < sizeof($hardwareArray); $i++){
        $hwsql = "INSERT INTO Hardware_Ticket (Ticket_Number, Hardware_ID) VALUES ('$ticketID', " . $hardwareArray[$i]->Data . ")";
        echo $hwsql;
        array_push($hardwareQueries, $hwsql);
    }
    
    
}
if(sizeof($softwareArray) > 0){
    //Make (multiple) hardware queries. 
    for($i = 0; $i < sizeof($softwareArray); $i++){
      $swsql = "INSERT INTO Software_Ticket (Ticket_Number, Software_ID) VALUES ('$ticketID', " . $softwareArray[$i]->Data . ")";
         echo $swsql;
      array_push($softwareQueries, $swsql);
    }
}


//Make all queries.


$conn= new mysqli($DBservername, $DBusername, $DBpassword, $dbname);
if($conn -> connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else { 


$resultTicket = $conn->query($ticketfinal) or die('Error: '.$conn->error);

for($i = 0; $i < sizeof($hardwareQueries); $i++){
    $result1 = $conn->query($hardwareQueries[$i]);
        if(!$result1){
        echo "hw Query Fail";
   } else {
        echo "hw Query ok";
   }
    
}
for($i = 0; $i < sizeof($softwareQueries); $i++){
   $result1 = $conn->query($softwareQueries[$i]); 
            if(!$result1){
        echo "sw Query Fail";
   } else {
        echo "sw Query ok";
    }
}
}






?>
