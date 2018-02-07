<?php 
//This guy will deal with requests to add data.
include("config.php");
require_once('myFunctions.php');
$conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname);
    if($conn -> connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    } else {
        

$userData = json_decode($_POST["user_data"]);
$sql = "";
$updates = "";
var_dump($userData);
for($i = 0; $i < sizeof($userData); $i++){
    
  
    //IT WORKS OH MY GOD IT WORKS
    if($i==0){
        //First item is table name
        $sql .= "UPDATE ".$userData[$i]->Data." SET ";

    } else {
        //Isn't first row - add to the other variables.
        if($i + 2 === sizeof($userData)){
            //Don't do comma
        $updates .=  $userData[$i]->Field."=".$userData[$i]->Data;
        }else if($i + 1 === sizeof($userData)){
            //Last row - this is the bit for WHERE 
        $updates .= " WHERE ".$userData[$i]->Field."=".$userData[$i]->Data;
            
        } else {
        $updates .=  $userData[$i]->Field."=".$userData[$i]->Data.", ";
    
        }
    }
 
    
    
}
//Construct final sql query: 
        $sql .= $updates;
      
        $result = $conn->query($sql);
        if($result === TRUE){
            echo "YES";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
                }
        
        
        
        

        
    }




?>
