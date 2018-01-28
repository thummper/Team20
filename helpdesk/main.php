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
        include("config.php");
        $conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
        $start = 0;
        $ticketTable = " <table style=\"width:100%\" id=\"issuesTable\"><tr><th>Ticket ID:</th><th>Category:</th><th>Specialist ID:</th><th>Date Added:</th><th>Priority:</th> <th>Resolved:</th></tr>";
            $sql1 = "SELECT * FROM Ticket ORDER BY Ticket_ID DESC";
            $result1 = $conn->query($sql1);
            if(!$result1){
                cLog("DB Error");
            } else {
            
            //Draw the table
            while( ($row = $result1->fetch_assoc())){
                $ticketTable = $ticketTable."<tr><td>".$row["Ticket_ID"]."</td><td>".$row["Problem_Type"]."</td><td>".$row["Specialist_ID"]."</td><td>".$row["Date_Made"]."</td><td>".$row["Priority"]."</td><td>".$row["Resolved"]."</td><td><a href='#'>View</a></td></tr>";
            $start++;
            }
            $ticketTable = $ticketTable."</table>"; 
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
                    <li><a href="#" class="top-sub active">All</a></li>
                    <li><a href="#">Open</a></li>
                    <li><a href="#">Closed</a></li>
                    <li><h3>Queries</h3></li>
                    <li><a href="#" class="top-sub">All</a></li>
                    <li><a href="#">Open</a></li>
                    <li><h3>More</h3></li>
                    <li><a href="#" class="top-sub">Analytics</a></li>
                    <li><a href="database.php">Databases</a></li>
                    <li><a href="logout.php">Log out</a></li>
                </ul>
            </div> 
            <div class="sidebar-bot">
                <a class="call" href="call.php">New Call</a>
            </div>
        </div>
        <div class="main">
            <div class="title">
                <h1>Tickets</h1>
            </div>
            <div class="menu-bar">
                    <div class="search">
                        <input type="text" class="s-bar" name="query" id="query" placeholder="Problem Type" />
                        <input type="submit" class="s-button" value="Search" onclick = ""/>
                    </div>
                </div>
        	<div id="table" class="table">
                <?php echo $ticketTable;?>
            </div>
            <div class="page-num">
                <ul>
                    <li class="prev"><button id="prev" class="first-last">Previous</button></li>
                    <li class="page-i">1</li>
                    <li class="next"><button id="next">Next</button></li>
                </ul>
            </div>
        </div>
        
	</body>
</html>