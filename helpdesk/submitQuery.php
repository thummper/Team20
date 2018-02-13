<?php

   if($_POST["save-type"] == "query") {
       include("config.php");
       session_start();
       if($_POST["resolved"] == 'N'){
          $conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname);
           if($conn -> connect_error) {
            die("Connection Failed: " . $conn->connect_error);
           } else {
              $queryID = 0;
              $conn1 = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
              $sql1 = "SELECT COUNT(Query_ID) FROM Query";
              $result = $conn1->query($sql1);
              while($row = $result->fetch_row()){
                  foreach($row as $value){
                    $queryID = $value;
                  }
              }
              $queryID++;
              $sql = "INSERT INTO Query (Query_ID, Ticket_ID, Operator_ID, Caller_ID, Date, Reason) VALUES ('".$queryID."', '".$_POST["tickID"]."', '".$_SESSION["staffID"]."', '".$_POST["staff_ID"]."', '".date("Y-m-d")."', '".$_POST["reason"]."');";
              $result = $conn->query($sql);
               if(!$result){
                    echo "query Query Fail";
               } else {
                    echo "query Query ok";
               }
           } 
       }else if($_POST["resolved"] == 'Y'){
           $conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname);
           if($conn -> connect_error) {
            die("Connection Failed: " . $conn->connect_error);
           } else {
               $sql = "UPDATE Ticket SET Solution = '".$_POST["reason"]."', Date_Solved = '".date("Y-m-d H:i:s")."', Resolved = 'Y' WHERE Ticket_ID = '".$_POST["tickID"]."';";
               $result = $conn->query($sql);
               if(!$result){
                    echo "query Query Fail";
               } else {
                    echo "query Query ok";
               }
           } 
       }
       header("Location: main.php");
   }
?>