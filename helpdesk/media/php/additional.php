<!DOCTYPE HTML>
<?php
   if($_POST["save-type"] == "query") { 
      include("config.php");
      session_start();
      $conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname);
      if($conn -> connect_error) {
        die("Connection Failed: " . $conn->connect_error);
      } else {
          $sql = "";
          $conn->query($sql);
          
    }
   }
?>