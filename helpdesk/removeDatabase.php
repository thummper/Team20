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
$fieldData = "";

for($i = 0; $i < 2; $i++){
    
  
    //IT WORKS OH MY GOD IT WORKS
    if($i==0){
        //First item is table name
        $sql .= "DELETE FROM ".$userData[$i]->Data." WHERE ";

    } else {
        //Isn't first row - add to the other variables.
        $fieldData .= $userData[$i]->Field . "=";
        $fieldData .= $userData[$i]->Data . " ";
        
    }
 
    
    
}
//Construct final sql query: 
$sql .= $fieldData;
echo "sql QUERY IS: " . $sql;
$result = $conn->query($sql);
               if($result === TRUE){
                   echo "Made new record";
      } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
            }
        
        
        
        
    }




?>
