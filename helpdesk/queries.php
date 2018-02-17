<!DOCTYPE HTML>

<html>
	<head>
        <?php 
            session_start();
            if(empty($_SESSION["staffID"])){
                header("Location: index.php");
            }
            //sends user to index.php if session has expired
        ?>
        <title>Help Desk</title>
        <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px'/>
        <link rel="stylesheet" href="css/style.css" />
        <?php
        function FullTable(){
            //function with sql for a full table of query info
            $sql1 = "SELECT * FROM Query ORDER BY Query_ID DESC";
            $start = 0;
            echo FillTable($sql1, $start);
            //calls the function the create the table passing the sql statement through it
            echo "<script>document.getElementById(\"qall\").classList.add('active');document.getElementById(\"qopen\").classList.remove('active');</script>";
            //adds the active class to the all menu item and removes from others
        }
        function OpenTable(){
            //function with sql for a table of queries related to open tickets
            $sql1 = "SELECT * FROM Query WHERE Ticket_ID IN (SELECT Ticket_ID FROM Ticket WHERE Resolved = 'N') ORDER BY Query_ID DESC";
            $start = 0;
            echo FillTable($sql1, $start);
            //calls the function the create the table passing the sql statement through it
            echo "<script>document.getElementById(\"qall\").classList.remove('active');document.getElementById(\"qopen\").classList.add('active'); </script>";
            //adds the active class to the open menu item and removes from others
        }
        function FillTable($sql1, $start){
            //function to create table with query info
            include("config.php");
            $conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
            $start = 0;
            $ticketTable = " <table style=\"width:100%\" id=\"issuesTable\"><tr><th>Query ID:</th><th>Ticket ID:</th><th>Operator:</th><th>Date Added:</th></tr>";
            $result1 = $conn->query($sql1);
            if(!$result1){
                cLog("DB Error");
            } else {
            while( ($row = $result1->fetch_assoc())){
                $conn2 = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                $sql3 = "SELECT * FROM Staff";
                $result3 = $conn2->query($sql3);
                if(!$result3){
                cLog("DB Error");
                } else {
                while( ($row2 = $result3->fetch_assoc())){
                    if($row2["Staff_ID"]==$row["Operator_ID"]){
                        $op = $row2["Forename"]." ".$row2["Surname"];
                }
                }
                }
                //finds operators full name from staff table
                $ticketTable = $ticketTable."<tr><td>".$row["Query_ID"]."</td><td>".$row["Ticket_ID"]."</td><td>".$op."</td><td>".$row["Date"]."</td><td><a href='ticket.php?TicketID=".$row["Ticket_ID"]."#queries'>View </a></td></tr>";
                //creates a table row using table info from datatbase
                $start++;
            }
            $ticketTable = $ticketTable."</table>"; 
            return $ticketTable;
                //return the query table
        }
        }
        ?>
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
                    <li><a id="qall" href="queries.php" class="top-sub">All</a></li>
                    <li><a id="qopen" href="queries.php?tableType=Open">Open</a></li>
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
                <h1>Queries</h1>
            </div>
            
        	<div id="table" class="table">
            <?php
                if ($_GET['tableType'] == 'Open') { 
                   OpenTable();
                } else {
                    FullTable();
                }
            ?>
            </div>
        </div>
        
	</body>
</html>