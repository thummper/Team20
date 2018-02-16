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
    
}








$dataArray = json_decode($_POST["user_data"]);

$hardwareArray = array();
$softwareArray = array();
$ticketID = $totalTickets + 1;

$dataArray[0]->Data = "'".$ticketID."'";
for($i = sizeof($dataArray); $i > 0; $i--){
    //Array is array inside arrays :^(
    
    if($dataArray[$i]->Field === "Hardware_ID"){
        
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
        
        
    } else if($dataArray[$i]->Field === "Specialist_ID"){
        if($dataArray[$i]->Data === "'ASSIGN'"){
        //Found spec ID - AUTO ASSIGN SPECIALIST.
        //Get the problem Type. 
       
        for($j = sizeof($dataArray); $j > 0; $j--){
            if($dataArray[$j]->Field === "Problem_Type"){
                //Get the specialist with the least amount of tickets with this specialty. 
                $problemType = $dataArray[$j]->Data;
                $sql = "SELECT * FROM `Staff_Spec` INNER JOIN Staff ON Staff_Spec.Staff_ID = Staff.Staff_ID WHERE Staff.Job_ID = '1' AND Spec_ID = $problemType";
                $staffWspec = array(); 
                $result = $conn->query($sql);
                
                if($result){
                    while($row = $result->fetch_assoc()){
                        $id = $row["Staff_ID"];
                       
                        array_push($staffWspec, $id);
                        
                    }
                } else {
                    //Nobody has spec (arr len will be 0)
                }
                
                //Get count of all unresolved tickets. 
                $sql = "SELECT Specialist_ID, COUNT(*) FROM Ticket WHERE Resolved = 'N' GROUP BY Specialist_ID";
                $genStaff = array();
                $specStaff = array(); 
                $res = $conn->query($sql);
                if($res){

                    while($row = $res->fetch_row()){
                        for($l = 0; $l < sizeof($row); $l++){
                            if($l == 0){
                                //StaffID
                                if(in_array($row[$l], $staffWspec)){
                                    //Found a staff memeber with the specification, should record ID and value
                                    array_push($specStaff, array($row[$l], $row[($l+1)]));
                                    
                                } else {
                                    //Staff member does not have ticket spec, record data in different array.
                                    array_push($genStaff, array($row[$l], $row[($l+1)]));
                                }
                            } 
                        }
                    }
                    
                    
                    $assignTo; 
                    if(sizeof($specStaff) != 0){
                        //There are staff members with spec.
                        //Get the member of staff with the lowest ticket count 
                        if(sizeof($specStaff) == 1){
                            //Give it to this guy. 
                            $assignTo = $specStaff[0][0];
                        } else {
                            $smallest;
                            $id = 0;
                            foreach($specStaff as $staff){
                                $numTickets = $staff[1];
                                $id = $staff[0];
                                if($smallest == NULL){
                                    $smallest = $numTickets;
                                    $id = $staff[0];
                                } else {
                                    if($numTickets < $smallest){
                                        $smallest = $numTickets;
                                        $id = $staff[0];
                                    }
                                }
                            }
                            $assignTo = $id;
                        }
                    } else {
                        //There are no memebers of staff with spec. 
                        //Get GENERIC member of staff with lowest ticket count.
                        $smallest;
                        $id = 0;
                        foreach($genStaff as $staff){
                                $numTickets = $staff[1];
                                $id = $staff[0];
                                if($smallest == NULL){
                                    $smallest = $numTickets;
                                    $id = $staff[0];
                                } else {
                                    if($numTickets < $smallest){
                                        $smallest = $numTickets;
                                        $id = $staff[0];
                                    }
                                }
                            }
                            $assignTo = $id;
                            
                        }
                    
                    
                    
                    $dataArray[$i]->Data = "'".$assignTo."'";
                    }
                    
                    
                }
            

                
                
                
                
                
            }
           
            
            
            

            
            
            
            
        }
        
        
        
    }
    }

    




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


//We need the ticket id.. 
//Could possiblt be multiple hardware and software queries? 
$hardwareQueries = array();
$softwareQueries = array(); 
if(sizeof($hardwareArray) > 0){
    //Make (multiple) hardware queries. 
    
    for($i = 0; $i < sizeof($hardwareArray); $i++){
        $hwsql = "INSERT INTO Hardware_Ticket (Ticket_Number, Hardware_ID) VALUES ('$ticketID', " . $hardwareArray[$i]->Data . ")";
       
        array_push($hardwareQueries, $hwsql);
    }
    
    
}
if(sizeof($softwareArray) > 0){
    //Make (multiple) hardware queries. 
    for($i = 0; $i < sizeof($softwareArray); $i++){
      $swsql = "INSERT INTO Software_Ticket (Ticket_Number, Software_ID) VALUES ('$ticketID', " . $softwareArray[$i]->Data . ")";
         
      array_push($softwareQueries, $swsql);
    }
}


//Make all queries.


$conn= new mysqli($DBservername, $DBusername, $DBpassword, $dbname);
if($conn -> connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else { 


$resultTicket = $conn->query($ticketfinal) or die('Error: '.$conn->error);
if($resultTicket){
    echo "OK";
}
for($i = 0; $i < sizeof($hardwareQueries); $i++){
    $result1 = $conn->query($hardwareQueries[$i]);
        if(!$result1){
        
   } else {
        
   }
    
}
for($i = 0; $i < sizeof($softwareQueries); $i++){
   $result1 = $conn->query($softwareQueries[$i]); 
            if(!$result1){
        
   } else {
        
    }
}
}






?>
