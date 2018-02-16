<?php 
/* 
addDatabase.php 

Recieves data to be added to the database and adds it. 

Made by: Simeon.


*/
include("config.php");
$conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname);
    if($conn -> connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    } else {
        $userData = json_decode($_POST["user_data"]);
        $sql = "";
        $columns = "";
        $values = "";
        for($i = 0; $i < sizeof($userData); $i++){
            if($i==0){
                //First item is table name
                $sql .= "INSERT INTO ".$userData[$i]->Data." ";
            } else {
                //Isn't first row - add to the other variables.
                if($i + 1 == sizeof($userData)){
                    //Don't do comma
                    $columns .= $userData[$i]->Field;
                    $values .= $userData[$i]->Data;
                } else {
                    $columns .= $userData[$i]->Field . ", ";
                    $values .= $userData[$i]->Data . ", ";
                }
            }
        }
        //Construct final sql query: 
        $sql .= "($columns) VALUES ($values)";
        $result = $conn->query($sql);
        if($result){
            echo "YES";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>
