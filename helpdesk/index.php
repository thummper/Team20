<!DOCTYPE HTML>
<!-- 
index.php 

Handles user login, makes sure the correct staff details are displayed.

Made by: Tom
-->
<?php
   if($_SERVER["REQUEST_METHOD"] == "POST") { 
      include("config.php");
      session_start();
      $staffID = $_POST["stfID"];
      $password = $_POST["psw"];
      $conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname);
      if($conn -> connect_error) {
        die("Connection Failed: " . $conn->connect_error);
      } else {
          $sql = "SELECT * FROM Staff WHERE Staff_ID = '$staffID' AND Password = '$password'";
          //sql statement that uses the users entered info to find the relevent account
          $result = $conn->query($sql);
          if($result->num_rows == 1){
              //if the user exists then their info is stored as a session to use throughout the website
              $row = $result->fetch_assoc();
              $_SESSION["staffID"] = $staffID;
              $_SESSION["staffName"] = $row["Forename"] . " " . $row["Surname"];
              $_SESSION["jobID"] = $row["Job_ID"];
              $jobID = $row["Job_ID"];
              if($jobID == 1){    
                    $_SESSION["jobTitle"] = "Specialist";
                    header("Location: main.php");
                } else if($jobID == 2){
                    $_SESSION["jobTitle"] = "Operator";
                    header("Location: main.php");
                } else if($jobID == 3){
                    $_SESSION["jobTitle"] = "Administrator";
                    header("Location: main.php");
                } else {
                    session_destroy();
                    echo '<script language="javascript">alert("incorrect username and password");location.href = "index.php";</script>';
                }
              //the statemnt ensures that the user is actually a part of the helpdesk team (and assigns relevent title)
          }else{
              session_destroy();
              echo '<script language="javascript">alert("incorrect username and password");location.href = "index.php";</script>'; 
          }
          //creates a msg box to tell the user that the entered info is incorrect
      }
   }
?>
<html>
	<head>
        <title>Help Desk</title>
        <link rel="shortcut icon" href="media/helpdesk.ico"/>
        <link rel="stylesheet" href="css/style.css" />    
	</head>
	<body class="login-body">
        <form  class="login-form" method="post">
            <input type="text" placeholder="Staff ID" name="stfID" required>
            <input type="password" placeholder="Password" name="psw" class="login-field" required>
            <button type="submit" class="login-button">Login</button>
        </form>   
	</body>
</html> 