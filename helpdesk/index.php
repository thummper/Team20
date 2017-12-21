<!DOCTYPE HTML>
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
          $result = $conn->query($sql);
          if($result->num_rows == 1){
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
                } else {
                    session_destroy();
                    echo '<script language="javascript">';
                    echo 'alert("incorrect username and password")';
                    echo 'location.href = "index.php";';
                    echo '</script>';
                }
          }else{
              session_destroy();
              echo '<script language="javascript">';
              echo 'alert("incorrect username and password");';
              echo 'location.href = "index.php";';
              echo '</script>';   
          }
      }
   }
?>
<html>
	<head>
        <title>Help Desk</title>
        <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px'/>
        <link rel="stylesheet" href="css/style.css" />    
	</head>
	<body class="login-body">
        <form action=" " class="login-form" method="post">
            <input type="text" placeholder="Staff ID" name="stfID" required>
            <input type="password" placeholder="Password" name="psw" class="login-field" required>
            <button type="submit" class="login-button">Login</button>
        </form>    
	</body>
</html>            