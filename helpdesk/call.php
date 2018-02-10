<!DOCTYPE HTML>
<html>
	<head>
         <?php 
            session_start();
            if(empty($_SESSION["staffID"])){
                header("Location: index.php");
            }
            include("config.php");
        ?>
        <title>Help Desk</title>
        <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px'/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="css/style.css" />
    <script type="text/javascript">
		hwnum = 2;
		swnum = 2;
        window.onload = function() {
          var ticket = document.getElementById("ticketbutton");
          var query = document.getElementById("querybutton");
          ticket.onclick = function() {
            document.getElementById("ticketbutton").classList.add('selected');
            document.getElementById("querybutton").classList.remove('selected');
            document.getElementById("ticket").classList.remove('divvis');
            document.getElementById("query").classList.add('divvis');
            
            return false;
          }
          query.onclick = function() {
            document.getElementById("ticketbutton").classList.remove('selected');
            document.getElementById("querybutton").classList.add('selected');
            document.getElementById("ticket").classList.add('divvis');
            document.getElementById("query").classList.remove('divvis');
            
            return false;
          }
        }
		function copypastehw(){
            numhw();
			drpdwn = '<select name="hard(' + hwnum + ')" id="hard(' + hwnum + ')" class="dropdown ware" required><option selected disabled value="">Hardware</option><option value="None">None</option><?php include("config.php"); $sql = 'SELECT * FROM Equipment'; $conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); $result = $conn->query($sql);if(!$result){cLog("DB Error");} else {while(($row = $result->fetch_assoc())){echo '<option value="'.$row['Serial_Number'].'">'.$row['Serial_Number'].' - '.$row['Type'].'</option>';}}?></select>';
			$("#hw").append(drpdwn);
			hwnum++;
		}
        
		function copypastesw(){
            numsw();
			drpdwn = '<select name="soft(' + swnum + ')" id="soft(' + swnum + ')" class="dropdown ware" required><option selected disabled value="">Software</option><option value="None">None</option><?php include("config.php");$sql = 'SELECT * FROM Software';$conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); $result = $conn->query($sql);if(!$result){cLog("DB Error");} else {while(($row = $result->fetch_assoc())){echo '<option value="'.$row['Software_ID'].'">'.$row['Name'].'</option>';}}?></select>';
			$("#sw").append(drpdwn);
			swnum++;
		}
        function numhw(){
            document.getElementById("hwnum").value = hwnum;
        }
        function numsw(){
            document.getElementById("swnum").value = swnum;
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
            <h1>New Call</h1>
        </div>
			<form class="id-sel" action="" method="get">
            <input type="text" class="s-bar s-bar-id" name="staff-id" id="staff-id" placeholder="Staff ID" required/>
            <input type="submit" class="s-button s-button-call" value="Search" />
			</form>

				<?php
					if(!empty($_GET['staff-id'])){
						include("config.php");
						$sql = "SELECT * FROM Staff WHERE Staff_ID = '".$_GET['staff-id']."'";
						$conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
						$result = $conn->query($sql);
						if(!$result){
							cLog("DB Error");
						} else {
						while(($row = $result->fetch_assoc())){
							$conn1 = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
							$sql2 = "SELECT * FROM Department";
							$result2 = $conn1->query($sql2);
							if(!$result2){
							cLog("DB Error");
							} else {
							while( ($row1 = $result2->fetch_assoc())){
								if($row1["Department_ID"]==$row["Department_ID"]){
									$dep = $row1["Department_Name"];
							}
							}
							}
							$conn2 = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
							$sql3 = "SELECT * FROM Job";
							$result3 = $conn2->query($sql3);
							if(!$result3){
							cLog("DB Error");
							} else {
							while( ($row2 = $result3->fetch_assoc())){
								if($row2["Job_ID"]==$row["Job_ID"]){
									$job = $row2["Job_Title"];
							}
							}
							}

							echo '<table class="staff-info" style="width:100%" ><tr><th>Staff ID:</th><th>Full name:</th><th>Job title:</th> <th>Department:</th> <th>Telephone number:</th> </tr><td>'.$row['Staff_ID'].'</td><td>'.$row['Forename'].' '.$row['Surname'].'</td><td>'.$job.'</td><td>'.$dep.'</td><td>'.$row['Telephone'].'</td></tr></table>';
						}
						}
					}
				?>
            <ul class="tab" >
                <li><a id="ticketbutton" class="selected" >Ticket</a></li>
                <li><a id="querybutton" >Query</a></li>
            </ul>
        <div id="input">
            <div id="ticket">
                <form action="" method="post" id="tick">
                    <div id="call-input" class="tick-input">
                        <select name="cat" id="cat" class="dropdown cat" required>
                            <option selected disabled value="">Category</option>
                            <?php 
                                include("config.php");
                                $sql = 'SELECT * FROM Specialisation';
                                $conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                                $result = $conn->query($sql);
                                if(!$result){
                                    cLog("DB Error");
                                } else {
                                while(($row = $result->fetch_assoc())){
                                    echo '<option value="'.$row['Spec_ID'].'">'.$row['Spec_Name'].'</option>';
                                }
                                }
                            ?>
                        </select>
                        <select name="prior" id="priority" class="dropdown priority" required>
                            <option selected disabled value="">Priority</option>
                            <option value="1">1 - Low</option>
                            <option value="2">2 - Medium</option>
                            <option value="3">3 - High</option>
                        </select>
                        <textarea  id="des" rows="5" placeholder="Description" class="des" required></textarea>
                        <div id="hw">
                            <select name="hard(1)" id="hard(1)" class="dropdown ware" required>
                                <option selected disabled value="">Hardware</option>
                                <option value="None">None</option>
                                <?php 
                                    include("config.php");
                                    $sql = 'SELECT * FROM Equipment';
                                    $conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                                    $result = $conn->query($sql);
                                    if(!$result){
                                        cLog("DB Error");
                                    } else {
                                    while(($row = $result->fetch_assoc())){
                                        echo '<option value="'.$row['Serial_Number'].'">'.$row['Serial_Number'].' - '.$row['Type'].'</option>';
                                    }
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="button" class="plus" value="+" onclick="copypastehw();"/>
                        <div id="sw">
                            <select name="soft(1)" id="soft(1)" class="dropdown ware" required>
                                <option selected disabled value="">Software</option>
                                <option value="None">None</option>
                                <?php 
                                    include("config.php");
                                    $sql = 'SELECT * FROM Software';
                                    $conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                                    $result = $conn->query($sql);
                                    if(!$result){
                                        cLog("DB Error");
                                    } else {
                                    while(($row = $result->fetch_assoc())){
                                        echo '<option value="'.$row['Software_ID'].'">'.$row['Name'].'</option>';
                                    }
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="button" class="plus" value="+" onclick="copypastesw();"/>
                    </div>
                    <div class="tick-but">
                        <input type="hidden" name="save-type" value="ticket">
                        <input type="hidden" name="staff_ID" value="<?php echo htmlspecialchars($_GET['staff-id']);?>">
                        <input type="hidden" name="hwnum" id="hwnum" value="1">
                        <input type="hidden" name="swnum" id="swnum" value="1">
                        <input type="button" class="reset" value="Reset" onclick="window.location.href='call.php?staff-id=<?php echo $_GET['staff-id'];?> '"/>
                        <input type="submit" id="submit-tick" class="next" value="Next"/>
                    </div>
                </form>
            </div>
        </div>
        <div id="query" class="divvis">
            <form action="media/php/additional.php" method="post">
                <div id="call-input" class="tick-input">
                    <select name="tickID" id="tickID" class="dropdown cat" required>
                        <option selected disabled value="">Ticket ID</option>
                        <?php 
                            include("config.php");
                            $sql = "SELECT * FROM Ticket WHERE Resolved = 'N'";
                            $conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                            $result = $conn->query($sql);
                            if(!$result){
                                cLog("DB Error");
                            } else {
                            while(($row = $result->fetch_assoc())){
                                echo '<option value="'.$row['Ticket_ID'].'">'.$row['Ticket_ID'].'</option>';
                            }
                            }
                        ?>
                    </select>
                    <select name="resolved" id="resolved" class="dropdown priority" required>
                        <option selected disabled value="">Resolved</option>
                        <option value="Y">Yes</option>
                        <option value="N">No</option>
                    </select>
                    <textarea  id="des" rows="5" placeholder="Reason for call/ Solution" class="des" required></textarea>
                </div>
                <div class="tick-but">
                    <input type="hidden" name="save-type" value="query">
                    <input type="hidden" name="staff_ID" value="<?php echo htmlspecialchars($_GET['staff-id']);?>">
                    <input type="reset" class="reset" value="Reset"/>
                    <input type="submit" id="submit-query" class="next" value="Submit"/>
                </div>
            </form>
        </div>
    </div>
	</body>
</html>