<?php 

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
            $actualPass = $row["Password"];
            $enteredPass = $_POST["psw"];
            echo "Database password is: $actualPass<br>";
            echo "Entered password is: $enteredPass<br>";
            if($actualPass == $enteredPass){
                echo "Passwords are the same<br>";
                $jobID = $row["Job_ID"];
                echo "Job ID is $jobID<br>";
                //We need to get the employee type and load the correct page.
                //There are only ever 3 cases? ID is 1, 2 or NULL 
                //Could just get job stuff from job table.. 
                if($jobID == 1){
                    //Operator
                    echo "Specialist<br>";
                } else if($jobID == 2){
                    //Specialist
                    echo "Operator<br>";
                } else {
                    //Null/Other job
                }
            } else {
                echo "Passwords different";
                //Would we make the webpage for bad login here? 
            }
            
            
            
        } else {
            //Staff ID not found! 
            echo "No such staff id.";
        }
    }
 
    
    
?>