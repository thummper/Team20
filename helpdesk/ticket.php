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
                    $row = $result->fetch_row();
                    $staffID = $row["Staff_ID"];
                    $specID = $row["Specialist_ID"];
                    $opID = $row["Operator_ID"];
                    $ptype = $row["Problem_Type"];
                    $des = $row["Description"];
                    $pri = $row["Priority"];
                    $res = $row["Resolved"];
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
            <h1>Ticket: <?php echo $_GET["TicketID"]; ?></h1>
        </div>

    </div>
	</body>
</html>