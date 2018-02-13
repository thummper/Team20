<!DOCTYPE HTML>
<?php

   if($_POST["save-type"] == "query") {
       include("../../config.php");
       session_start();
       if($_POST["resolved"] == 'N'){
           $conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname);
           if($conn -> connect_error) {
            die("Connection Failed: " . $conn->connect_error);
           } else {
              $sql = "...";
              $conn->query($sql);

           }  
       }else if($_POST["resolved"] == 'Y'){
           
       }
   }
?>