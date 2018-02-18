<!DOCTYPE HTML>

<html>
	<head>
        <?php 
            session_start();
            if(empty($_SESSION["staffID"])){
                header("Location: index.php");
                //sends user to index.php if session has expired
            }
        ?>
        <title>Help Desk</title>
        <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px'/>
        <link rel="stylesheet" href="css/style.css" />
        <?php
            function FullTable(){
                //function with sql for a full table of ticket info
                $start = 0;
                if(!empty($_GET['query'])){
                    $sql1 = "SELECT * FROM Ticket WHERE Problem_Type IN (SELECT Spec_ID FROM Specialisation WHERE Spec_Name LIKE '%".$_GET['query']."%') ORDER BY Ticket_ID DESC";
                    //if the user has made a query it is inserted into the sql statement
                }else {
                    $sql1 = "SELECT * FROM Ticket ORDER BY Ticket_ID DESC";
                }
                echo FillTable($sql1, $start);
                //calls the function the create the table passing the sql statement through it
                echo "<script>document.getElementById(\"all\").classList.add('active');document.getElementById(\"open\").classList.remove('active');document.getElementById(\"closed\").classList.remove('active');document.getElementById(\"my\").classList.remove('active') </script>";
                //adds the active class to the all menu item and removes from others
            }
            function OpenTable(){
                //function with sql for a  table of ticket info where the tickets are open
                $start = 0;
                if(!empty($_GET['query'])){
                    $sql1 = "SELECT * FROM Ticket WHERE Problem_Type IN (SELECT Spec_ID FROM Specialisation WHERE Spec_Name LIKE '%".$_GET['query']."%') AND Resolved = 'N' ORDER BY Ticket_ID DESC";
                }else {
                    $sql1 = "SELECT * FROM Ticket WHERE Resolved = 'N' ORDER BY Ticket_ID DESC";
                }
                //relevent sql statements with/without user query
                echo FillTable($sql1, $start);
                //calls the function the create the table passing the sql statement through it
                echo "<script>document.getElementById(\"all\").classList.remove('active');document.getElementById(\"open\").classList.add('active');document.getElementById(\"closed\").classList.remove('active');document.getElementById(\"my\").classList.remove('active'); </script>";
                //adds the active class to the open menu item and removes from others
            }
            function ClosedTable(){
                //function with sql for a  table of ticket info where the tickets are closed
                $start = 0;
                if(!empty($_GET['query'])){
                    $sql1 = "SELECT * FROM Ticket WHERE Problem_Type IN (SELECT Spec_ID FROM Specialisation WHERE Spec_Name LIKE '%".$_GET['query']."%') AND Resolved = 'Y' ORDER BY Ticket_ID DESC";
                }else {
                    $sql1 = "SELECT * FROM Ticket WHERE Resolved = 'Y' ORDER BY Ticket_ID DESC";  
                }
                //relevent sql statements with/without user query
                echo FillTable($sql1, $start);
                //calls the function the create the table passing the sql statement through it
                echo "<script>document.getElementById(\"all\").classList.remove('active');document.getElementById(\"open\").classList.remove('active');document.getElementById(\"closed\").classList.add('active');document.getElementById(\"my\").classList.remove('active') </script>";
                //adds the active class to the closed menu item and removes from others
            }
            function MyTable(){
                //contains the sql statement to show specialist assigned tickets
                $start = 0;
                if(!empty($_GET['query'])){
                    $sql1 = "SELECT * FROM Ticket WHERE Problem_Type IN (SELECT Spec_ID FROM Specialisation WHERE Spec_Name LIKE '%".$_GET['query']."%') AND Resolved = 'N' AND Specialist_ID = '".$_SESSION["staffID"]."' ORDER BY Ticket_ID DESC";
                }else {
                    $sql1 = "SELECT * FROM Ticket WHERE Resolved = 'N' AND Specialist_ID = '".$_SESSION["staffID"]."' ORDER BY Ticket_ID DESC";
                }
                //relevent sql statements with/without user query
                echo FillTable($sql1, $start);
                //calls the function the create the table passing the sql statement through it
                echo "<script>document.getElementById(\"all\").classList.remove('active');document.getElementById(\"open\").classList.remove('active');document.getElementById(\"closed\").classList.remove('active');document.getElementById(\"my\").classList.add('active') </script>";
                //adds the active class to the my table menu item and removes from others
            }
            function FillTable($sql1, $start){
                //function to create table with ticket info
                include("config.php");
                $conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                $start = 0;
                $ticketTable = " <table style=\"width:100%\" id=\"issuesTable\"><tr><th onclick='sort(0)'>Ticket ID:</th><th onclick='sort(1)'>Category:</th><th onclick='sort(2);'>Operator:</th><th onclick='sort(3);'>Date Added:</th><th onclick='sort(4);'>Specialist:</th><th onclick='sort(5);'>Priority:</th> <th onclick='sort(6)'>Resolved:</th></tr>";
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
                    //above queries find operator and specialist forenames and surnames
                    $conn3 = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                        $sql4 = "SELECT * FROM Specialisation WHERE Spec_ID = '".$row["Problem_Type"]."';";
                        $result4 = $conn1->query($sql4);
                        if(!$result4){
                        cLog("DB Error");
                        } else {
                            $row3 = $result4->fetch_assoc();
                            $ptype = $row3["Spec_Name"];
                        }
                    //finds the specialiation type using the ID from ticket info
                    $ticketTable = $ticketTable."<tr><td>".$row["Ticket_ID"]."</td><td>".$ptype."</td><td>".$op."</td><td>".$row["Date_Made"]."</td><td>".$spec."</td><td>".$row["Priority"]."</td><td>".$row["Resolved"]."</td><td><a href='ticket.php?TicketID=".$row["Ticket_ID"]."'>View</a></td></tr>";
                    //creates a table row using table info from datatbase
                    $start++;
                }
                $ticketTable = $ticketTable."</table>"; 
                return $ticketTable;
                //returns ticket table
                }
            }
        ?>
	<script>

        function sort(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("issuesTable");
            switching = true;
            // Set the sorting direction to ascending:
            dir = "asc"; 
            /* Make a loop that will continue until
            no switching has been done: */
            while (switching) {
                // Start by saying: no switching is done:
                switching = false;
                rows = table.getElementsByTagName("TR");
                /* Loop through all table rows (except the
                first, which contains table headers): */
                for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare,
                one from current row and one from the next: */
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                /* Check if the two rows should switch place,
                based on the direction, asc or desc: */
                if (dir == "asc") {
                    if(!isNaN(x.innerHTML)){
                        //Its a number
                        var xnum = parseInt(x.innerHTML, 10);
                        var ynum = parseInt(y.innerHTML, 10);
                        
                        if(xnum > ynum){
                            shouldSwitch = true;
                            break;
                        }
                        
                    } else {
                        
                    
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch= true;
                        break;
                }
                }
                } else if (dir == "desc") {
                    if(!isNaN(x.innerHTML)){
                        //Its a number
                        var xnum = parseInt(x.innerHTML, 10);
                        var ynum = parseInt(y.innerHTML, 10);
                        
                        if(xnum < ynum){
                            shouldSwitch = true;
                            break;
                        }
                        
                    } else {
                    
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch= true;
                        break;
                    }
                }
                }
            }
            if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            // Each time a switch is done, increase this count by 1:
            switchcount ++; 
            } else {
            /* If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again. */
                if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
                }
            }
        }
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
                    //shows menu item if user is specialist
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
                    //shows menu item if user is administrator
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
                    //displays correct table depending on which menu item has been selected (all/my/open/closed)
                ?>
                </div>
        </div>
	</body>
</html>