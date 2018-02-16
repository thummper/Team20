<?php 
include("config.php");
require_once('myFunctions.php');
$hardwareArray = array();
$softwareArray = array(); 


$conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname);
if($conn -> connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else {
//Get list of open ticket IDs
    $sql = "SELECT Ticket_ID FROM Ticket WHERE Resolved = 'N'";
    $result = $conn->query($sql);
    if(!$result){
        echo "Error";
    } else {
        while($row = $result->fetch_row()){
            foreach($row as $id){
                //For each id, look for hardware of software associated?
               
                $sql1 = "SELECT Hardware_ID FROM Hardware_Ticket WHERE Ticket_Number = '$id'";
                $sql2 = "SELECT Software_ID FROM Software_Ticket WHERE Ticket_Number = '$id'";
                $result1 = $conn->query($sql1);
                $result2 = $conn->query($sql2);
                //All hardware
                if($result1){
                while($row1 = $result1->fetch_row()){
                    foreach($row1 as $item){
                    if(array_key_exists($item, $hardwareArray)){
                            //Already in array, increment.
                            $hardwareArray[$item]++;
                        }else{
                            //Not in array, add 
                            
                            $hardwareArray += [ $item => 1];
                        }
                    }
                }
                //All software   
                if($result2){
                while($row2 = $result2->fetch_row()){
                    foreach($row2 as $item){
                        if(array_key_exists($item, $softwareArray)){
                            //Already in array, increment.
                            $softwareArray[$item] = $softwareArray[$item]++;
                        } else{
                                $softwareArray += [ $item => 1];
                        }
                    }
                }
                }
                
                
 
                
            }
        }
    }
        //Ok, we have 2 arrays that have the primary key of the hw/sw and the amount of times they show up in open tickets - I'd like to graph the primary key AND type against the number of occurances. 
        $data = array(); 
        
        foreach($hardwareArray as $key => $value){
            //Get the make from Equipment table. 
            $sql = "SELECT Type FROM Equipment WHERE Serial_Number = '$key'";
            
            $hwResult = $conn->query($sql);
            while($row = $hwResult->fetch_row()){
                foreach($row as $item){
                    $arrk = $key . " " . $item;
                    $temparr = array($arrk, $value);
                    array_push($data, $temparr);
                }
            }
     
            
              
        }
        foreach($softwareArray as $key => $value){
            //Get the make from Equipment table. 
           
            $sql = "SELECT Name FROM Software WHERE Software_ID = '$key'";
            $swResult = $conn->query($sql);
            while($row = $swResult->fetch_row()){
                foreach($row as $item){
                    $arrk = $key . " " . $item;
                    $temparr = array($arrk, $value);
                    array_push($data, $temparr);
                    
                }
            }
            
              
        }
        
        $json_data = json_encode($data);
        echo $json_data;
        
        
    
    
    
}
}


?>