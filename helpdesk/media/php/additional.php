<!DOCTYPE HTML>
<?php
<<<<<<< HEAD
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
=======
>>>>>>> 789ddf36ef123d18d820f17dd42a750174c52c5f
   }
?>