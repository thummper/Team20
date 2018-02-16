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
              $sql = "INSERT INTO Query (Query_ID, Ticket_ID, Operator_ID, Caller_ID, Date, Reason) VALUES ('4', '".$_POST["tickID"]."', '".$_SESSION["staffID"]."', '".$_POST["Staff_ID"]."', '".date("Y-m-d")."', '".$_POST["reason"]."');";
              $conn->query($sql);

           }  
       }else if($_POST["resolved"] == 'Y'){
           
       }
   }
?>