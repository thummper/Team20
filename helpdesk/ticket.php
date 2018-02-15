<!DOCTYPE HTML>
<html>
	<head>
         <?php 
            include("config.php");
            session_start();
            if(empty($_SESSION["staffID"])){
                header("Location: index.php");
            }
            $conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname);
            if($conn -> connect_error) {
                die("Connection Failed: " . $conn->connect_error);
            } else { 
               $sql = "SELECT * FROM Ticket WHERE Ticket_ID = '".$_GET["TicketID"]."'";
               $result = $conn->query($sql);
               if(!$result){
                   cLog("DB Error");
                 } else {
                    $row = $result->fetch_assoc();
                    $staffID = $row["Staff_ID"];
                    $specID = $row["Specialist_ID"];
                    $opID = $row["Operator_ID"];
                    $pType = $row["Problem_Type"];
                    $des = $row["Description"];
                    $pri = $row["Priority"];
                    $res = $row["Resolved"];
                    $date = $row["Date_Made"];
                    if($res == 'Y'){
                        $sol = $row["Solution"];
                        $dsol = $row["Date_Solved"];
                    }
               }
            }
        ?>
        <title>Help Desk</title>
        <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px'/>
        <link rel="stylesheet" href="css/style.css" />
        <script>
            function solution(){
                document.getElementById("modal").style.display = "block";
            }
        </script>
	</head>
	<body>
        <div class="sidebar">
        	<div class="sidebar-top">
                <h2><?php echo $_SESSION["jobTitle"]; ?></h2>
                <p><?php echo $_SESSION["staffName"]; ?></p>
            </div>
            <div class="sidebar-mid">
                <ul class="nav">
                    <li><h3>Tickets</h3></li> 
                    <li><a id="all" href="main.php" class="top-sub">All</a></li>
                    <?php
                    if($_SESSION["jobID"] == 1){
                        echo '<li><a id="my" href="main.php?tableType=My">My Tickets</a></li>';
                    }
                    ?>
                    <li><a id="open" href="main.php?tableType=Open">Open</a></li>
                    <li><a id="closed" href="main.php?tableType=Closed">Closed</a></li>
                    <li><h3>Queries</h3></li>
                    <li><a href="queries.php" class="top-sub">All</a></li>
                    <li><a href="queries.php?tableType=Open">Open</a></li>
                    <li><h3>More</h3></li>
                    <li><a href="analytics.php" class="top-sub">Analytics</a></li>
                    <?php
                    if($_SESSION["jobID"] == 3){
                        echo '<li><a href="database.php">Databases</a></li>';
                    }
                    ?>
                    <li><a href="logout.php">Log out</a></li>
                </ul>
            </div>
            </div>
            <div class="sidebar-bot">
                <a class="call" href="call.php">New Call</a>
            </div>
        
    <div class="main">
        <div class="title">
            <p class="tick-date" ><?php echo $date; ?></p>
            <h1>Ticket: <?php echo $_GET["TicketID"]; ?></h1>
            
        </div>
        <div class="op-spec">
            <div class="spec-div">
                <h3>Specialist</h3>
                <?php
                        $conn1 = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                        $sql2 = "SELECT * FROM Staff WHERE Staff_ID = '$specID';";
                        $result2 = $conn1->query($sql2);
                        if(!$result2){
                        cLog("DB Error");
                        } else {
                            $row1 = $result2->fetch_assoc();
                            echo '<table class="staff-info" style="width:100%" ><tr><th>Staff ID:</th><th>Full name:</th><th>Telephone number:</th></tr><tr><td>'.$specID.'</td><td>'.$row1["Forename"].' '.$row1["Surname"].'</td><td>'.$row1["Telephone"].'</td></tr></table>';
                        }
                        
                ?>
            </div>
            <div class="op-div">
                <h3>Operator</h3>
                <?php
                        $conn1 = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                        $sql2 = "SELECT * FROM Staff WHERE Staff_ID = '$opID';";
                        $result2 = $conn1->query($sql2);
                        if(!$result2){
                        cLog("DB Error");
                        } else {
                            $row1 = $result2->fetch_assoc();
                            echo '<table class="staff-info" style="width:100%" ><tr><th>Staff ID:</th><th>Full name:</th><th>Telephone number:</th></tr><tr><td>'.$opID.'</td><td>'.$row1["Forename"].' '.$row1["Surname"].'</td><td>'.$row1["Telephone"].'</td></tr></table>';
                        }
                        
                ?>
            </div>
            <div class="details">
            <h2>Information</h2>
                <div class="spec-div">
                    <h3>Staff Details</h3>
                    <?php
                        $conn1 = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                        $sql2 = "SELECT * FROM Staff WHERE Staff_ID = '$staffID';";
                        $result2 = $conn1->query($sql2);
                        if(!$result2){
                        cLog("DB Error");
                        } else {
                            $row1 = $result2->fetch_assoc();
                            echo '<table class="staff-info" style="width:100%" ><tr><th>Staff ID:</th><th>Full name:</th><th>Telephone number:</th></tr><tr><td>'.$staffID.'</td><td>'.$row1["Forename"].' '.$row1["Surname"].'</td><td>'.$row1["Telephone"].'</td></tr></table>';
                        }
                        
                ?>
                </div>
                <div class="op-div">
                    <h3>Problem Type</h3>
                    <?php
                        $conn1 = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                        $sql2 = "SELECT * FROM Specialisation WHERE Spec_ID = '$pType';";
                        $result2 = $conn1->query($sql2);
                        if(!$result2){
                        cLog("DB Error");
                        } else {
                            $row1 = $result2->fetch_assoc();
                            echo '<table class="staff-info tick-info" style="width:100%" ><tr><th> </th></tr><tr><td>'.$row1["Spec_Name"].'</td></tr></table>';
                        }
                        
                    ?>
                </div>
                <div class="spec-div">
                    <h3>Description</h3>
                    <?php
                        echo '<table class="staff-info tick-info" style="width:100%" ><tr><th> </th></tr><tr><td>'.$des.'</td></tr></table>';
                    ?>
                </div>
                <div class="op-div">
                    <h3>Priority</h3>
                    <?php
                        switch($pri){
                            case 1:
                                $priority = $pri.' - low';
                                break;
                            case 2:
                                $priority = $pri.' - medium';
                                break;
                            case 3:
                                $priority = $pri.' - high';
                                break;
                            default:
                                $priority = $pri;
                                break;
                        }
                        echo '<table class="staff-info tick-info" style="width:100%" ><tr><th> </th></tr><tr><td>'.$priority.'</td></tr></table>';
                    ?>
                </div>
                <div class="spec-div">
                    <h3>Hardware</h3>
                    <?php
                        $hwtable = '<table class="staff-info tick-info" style="width:100%" ><tr><th>Serial number:</th><th>Make:</th><th>Type:</th></tr>';
                        $conn1 = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                        $sql2 = "SELECT * FROM Hardware_Ticket WHERE Ticket_Number = '".$_GET["TicketID"]."';";
                        $result2 = $conn1->query($sql2);
                        if(!$result2){
                        cLog("DB Error");
                        } else {
                            while( ($row1 = $result2->fetch_assoc())){
                                $conn2 = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                                $sql3 = "SELECT * FROM Equipment WHERE Serial_Number = '".$row1["Hardware_ID"]."';";
                                $result3 = $conn2->query($sql3);
                                if(!$result3){
                                cLog("DB Error");
                                } else {
                                    $row2 = $result3->fetch_assoc();
                                    $make = $row2["Make"];
                                    $type = $row2["Type"];
                                }   
                                $hwtable = $hwtable.'<tr><td>'.$row1["Hardware_ID"].'</td><td>'.$make.'</td><td>'.$type.'</td></tr>';
                            }
                            $hwtable = $hwtable.'</table>';
                            echo $hwtable;
                        }
                    ?>
                </div>
                <div class="op-div">
                    <h3>Software</h3>
                    <?php
                        $hwtable = '<table class="staff-info tick-info" style="width:100%" ><tr><th>Software ID:</th><th>Name:</th><th>Licensed:</th><th>Supported:</th></tr>';
                        $conn1 = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                        $sql2 = "SELECT * FROM Software_Ticket WHERE Ticket_Number = '".$_GET["TicketID"]."';";
                        $result2 = $conn1->query($sql2);
                        if(!$result2){
                        cLog("DB Error");
                        } else {
                            while( ($row1 = $result2->fetch_assoc())){
                                $conn2 = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                                $sql3 = "SELECT * FROM Software WHERE Software_ID = '".$row1["Software_ID"]."';";
                                $result3 = $conn2->query($sql3);
                                if(!$result3){
                                cLog("DB Error");
                                } else {
                                    $row2 = $result3->fetch_assoc();
                                    $name = $row2["Name"];
                                    $lic = $row2["Licensed"];
                                    $sup = $row2["Supported"];
                                    
                                }   
                                $hwtable = $hwtable.'<tr><td>'.$row1["Software_ID"].'</td><td>'.$name.'</td><td>'.$lic.'</td><td>'.$sup.'</td></tr>';
                            }
                            $hwtable = $hwtable.'</table>';
                            echo $hwtable;
                        }
                    ?>
                </div>
            </div>
            <div class="queries">
                <h2>Queries</h2>
                <?php 
                    $qtable = "<table style=\"width:100%\" id=\"issuesTable\"><tr><th>Query ID:</th><th>Caller ID:</th><th>Operator ID:</th><th>Date Added:</th><th>Reason for call:</th></tr>";
                    $conn1 = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                    $sql2 = "SELECT * FROM Query WHERE Ticket_ID = '".$_GET["TicketID"]."';";
                    $result2 = $conn1->query($sql2);
                    if(!$result2){
                    cLog("DB Error");
                    } else {
                        while( ($row = $result2->fetch_assoc())){
                            $qtable = $qtable."<tr><td>".$row["Query_ID"]."</td><td>".$row["Caller_ID"]."</td><td>".$row["Operator_ID"]."</td><td>".$row["Date"]."</td><td>".$row["Reason"]."</td></tr>";
                        }
                        $qtable = $qtable.'</table>';
                        echo $qtable;
                    }
                ?>
            </div>
            <?php
                if(($res == 'N') && ($specID == $_SESSION["staffID"])){
                    echo "<div class=\"s-but\"><input type=\"submit\" id=\"submit-query\" class=\"next\" value=\"Resolve\" onclick=\"solution();\"/></div>";
                } else if($res == 'Y') {
                    echo '<div class="solutions"><h2>Solved</h2><div class="spec-div"><h3>Solution</h3><table class="staff-info tick-info" style="width:100%" ><tr><th></th></tr><tr><td>'.$sol.'</td></tr></table></div></div><div class="op-div"><h3>Date</h3><table class="staff-info tick-info" style="width:100%" ><tr><th></th></tr><tr><td>'.$dsol.'</td></tr></table></div></div>';
                }
            ?>
        </div>    
    </div>
    <div class="modal" id="modal">

            <div class="title"><h1>Possible Solutions.</h1></div>
            



    </div>
	</body>
</html>