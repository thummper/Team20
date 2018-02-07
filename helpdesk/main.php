<!DOCTYPE HTML>

<html>
	<head>
        <?php 
            session_start();
            if(empty($_SESSION["staffID"])){
                header("Location: index.php");
            }
        ?>
        <title>Help Desk</title>
        <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px'/>
        <link rel="stylesheet" href="css/style.css" />
        <?php
            function FullTable(){
                $start = 0;
                if(!empty($_GET['query'])){
                    $sql1 = "SELECT * FROM Ticket WHERE Problem_Type LIKE '%".$_GET['query']."%' ORDER BY Ticket_ID DESC";
                }else {
                    $sql1 = "SELECT * FROM Ticket ORDER BY Ticket_ID DESC";
                }
                echo FillTable($sql1, $start);
                echo "<script>document.getElementById(\"all\").classList.add('active');document.getElementById(\"open\").classList.remove('active');document.getElementById(\"closed\").classList.remove('active');document.getElementById(\"my\").classList.remove('active') </script>";
            }
            function OpenTable(){
                $start = 0;
                if(!empty($_GET['query'])){
                    $sql1 = "SELECT * FROM Ticket WHERE Problem_Type LIKE '%".$_GET['query']."%' AND Resolved = 'N' ORDER BY Ticket_ID DESC";
                }else {
                    $sql1 = "SELECT * FROM Ticket WHERE Resolved = 'N' ORDER BY Ticket_ID DESC";
                }
                echo FillTable($sql1, $start);
                echo "<script>document.getElementById(\"all\").classList.remove('active');document.getElementById(\"open\").classList.add('active');document.getElementById(\"closed\").classList.remove('active');document.getElementById(\"my\").classList.remove('active'); </script>";

            }
            function ClosedTable(){
                $start = 0;
                if(!empty($_GET['query'])){
                    $sql1 = "SELECT * FROM Ticket WHERE Problem_Type LIKE '%".$_GET['query']."%' AND Resolved = 'Y' ORDER BY Ticket_ID DESC";
                }else {
                    $sql1 = "SELECT * FROM Ticket WHERE Resolved = 'Y' ORDER BY Ticket_ID DESC";
                }
                echo FillTable($sql1, $start);
                echo "<script>document.getElementById(\"all\").classList.remove('active');document.getElementById(\"open\").classList.remove('active');document.getElementById(\"closed\").classList.add('active');document.getElementById(\"my\").classList.remove('active') </script>";
            }
            function MyTable(){
                $start = 0;
                if(!empty($_GET['query'])){
                    $sql1 = "SELECT * FROM Ticket WHERE Problem_Type LIKE '%".$_GET['query']."%' AND Resolved = 'N' AND Specialist_ID = '".$_SESSION["staffID"]."' ORDER BY Ticket_ID DESC";
                }else {
                    $sql1 = "SELECT * FROM Ticket WHERE Resolved = 'N' AND Specialist_ID = '".$_SESSION["staffID"]."' ORDER BY Ticket_ID DESC";
                }
                echo FillTable($sql1, $start);
                echo "<script>document.getElementById(\"all\").classList.remove('active');document.getElementById(\"open\").classList.remove('active');document.getElementById(\"closed\").classList.remove('active');document.getElementById(\"my\").classList.add('active') </script>";
            }
            function FillTable($sql1, $start){
                include("config.php");
                $conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                $start = 0;
                $ticketTable = " <table style=\"width:100%\" id=\"issuesTable\"><tr><th>Ticket ID:</th><th>Category:</th><th>Operator:</th><th>Date Added:</th><th>Specialist:</th><th>Priority:</th> <th>Resolved:</th></tr>";
                $result1 = $conn->query($sql1);
                if(!$result1){
                    cLog("DB Error");
                } else {
                while( ($row = $result1->fetch_assoc())){
                    $conn1 = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                    $sql2 = "SELECT * FROM Staff";
                    $result2 = $conn1->query($sql2);
                    if(!$result2){
                    cLog("DB Error");
                    } else {
                    while( ($row1 = $result2->fetch_assoc())){
                        if($row1["Staff_ID"]==$row["Specialist_ID"]){
                            $spec = $row1["Forename"]." ".$row1["Surname"];
                    }
                    }
                    }
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
                    $ticketTable = $ticketTable."<tr><td>".$row["Ticket_ID"]."</td><td>".$row["Problem_Type"]."</td><td>".$op."</td><td>".$row["Date_Made"]."</td><td>".$spec."</td><td>".$row["Priority"]."</td><td>".$row["Resolved"]."</td><td><a href='ticket.php?TicketID=".$row["Ticket_ID"]."'>View</a></td></tr>";
                    $start++;
                }
                $ticketTable = $ticketTable."</table>"; 
                return $ticketTable;
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
                <h1>Tickets</h1>
            </div>
            <div class="menu-bar">
                    <div class="search">
                        <form action="<?php echo $url; ?>" method="get">
                            <input type="hidden" name="tableType" value="<?php echo htmlspecialchars($_GET['tableType']);?>">
                            <input type="text" class="s-bar" name="query" id="query" placeholder="Problem Type" required/>
                            <input type="submit" class="s-button" value="Search" onclick = ""/>
                        </form>
                    </div>
                </div>
        	<div id="table" class="table">
                <?php
                    if ($_GET['tableType'] == 'Open') { 
                        OpenTable();
                    } else if ($_GET['tableType'] == 'Closed'){ 
                        ClosedTable();
                    } else if ($_GET['tableType'] == 'My'){ 
                        MyTable();
                    } else {
                        FullTable();
                    }
                ?>
                </div>
            
        </div>
        
	</body>
</html>