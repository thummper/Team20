<?php 
    session_start();
    echo "Database will search for staff ID<br>";
    $servername = "localhost";
    $username = "root";
    $password = "69420";
    $dbname = "Support";
    $staffID = $_POST["stfID"];



    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn -> connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    } else {
        echo "Connected to database okay. <br>";
        //Will make a dbase query 
        echo "Trying to log in with staff ID: $staffID <br>";
        $sql = "SELECT * FROM Staff WHERE Staff_ID = '$staffID'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            echo "Found results <br>";
            //Staff ID matches
            //Now check password
            $row = $result->fetch_assoc();
            //Add stuff to session. 
            $_SESSION["staffID"] = $staffID;
            $_SESSION["staffName"] = $row["Forename"] . " " . $row["Surname"];
            $actualPass = $row["Password"];
            $enteredPass = $_POST["psw"];
            echo "Database password is: $actualPass<br>";
            echo "Entered password is: $enteredPass<br>";
            if($actualPass == $enteredPass){
                echo "Passwords are the same<br>";
                $jobID = $row["Job_ID"];
                echo "Job ID is $jobID<br>";
                $_SESSION["jobID"] = $jobID;
                //We need to get the employee type and load the correct page.
                //There are only ever 3 cases? ID is 1, 2 or NULL 
                //Could just get job stuff from job table.. 
                if($jobID == 1){
                    //spec
                    echo "Specialist<br>";
                    $_SESSION["jobTitle"] = "Specialist";
                    header("Location: main.php");
                } else if($jobID == 2){
                    //op
                    echo "Operator<br>";
                    $_SESSION["jobTitle"] = "Operator";
                    header("Location: main.php");
                } else {
                    //Null/Other job
                    session_destroy();
                }
            } else {
                echo "Passwords different";
                session_destroy();
                //Would we make the webpage for bad login here? 
            }
            
            
            
        } else {
            //Staff ID not found! 
            echo "No such staff id.";
        }
    }
 
    
    
?>