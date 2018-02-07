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
                    <li><a href="#" class="top-sub">Analytics</a></li>
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
        <div class="id-sel" >
            <input type="text" class="s-bar s-bar-id" name="staff-id" id="staff-id" placeholder="Staff ID" />
            <input type="submit" class="s-button s-button-call" value="Search" />
        </div>
            <table class="staff-info" style="width:100%" >
                <tr>
                    <th>Staff ID:</th>
                    <th>Full name:</th>
                    <th>Job title:</th> 
                    <th>Department:</th> 
                    <th>Telephone number:</th> 
                </tr>
                <tr id="staffinfo" >
                    <td >...</td>
                    <td >...</td>
                    <td >...</td>
                    <td >...</td>
                    <td >...</td> 
                </tr>
            </table>
            <ul class="tab" >
                <li><a id="ticketbutton" class="selected" >Ticket</a></li>
                <li><a id="querybutton" >Query</a></li>
            </ul>
        <div id="input">
            <div id="ticket">
                <form action="" method="post">
                    <div id="call-input" class="tick-input">
                        <select name="cat" id="cat" class="dropdown cat">
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
                        <select name="prior" id="priority" class="dropdown priority">
                            <option selected disabled value="">Priority</option>
                            <option value="1">1 - Low</option>
                            <option value="2">2 - Medium</option>
                            <option value="3">3 - High</option>
                        </select>
                        <textarea  id="des" rows="5" placeholder="Description" class="des"></textarea>
                        <select name="hard1" id="hard1" class="dropdown ware">
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
                        <input type="button" class="plus" value="+"/>
                        <select name="soft1" id="soft1" class="dropdown ware">
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
                        <input type="button" class="plus" value="+"/>
                    </div>
                    <div class="tick-but">
                        <input type="reset" class="reset" value="Reset"/>
                        <input type="submit" id="submit-tick" class="next" value="Next"/>
                    </div>
                </form>
            </div>
        </div>
        <div id="query" class="divvis">
            <form action="" method="post">
                <div id="call-input" class="tick-input">
                    <select name="tickID" id="tickID" class="dropdown cat">
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
                    <select name="resolved" id="resolved" class="dropdown priority">
                        <option selected disabled value="">Resolved</option>
                        <option value="Y">Yes</option>
                        <option value="N">No</option>
                    </select>
                    <textarea  id="des" rows="5" placeholder="Reason for call/ Solution" class="des"></textarea>
                </div>
                <div class="tick-but">
                    <input type="reset" class="reset" value="Reset"/>
                    <input type="submit" id="submit-query" class="next" value="Next"/>
                </div>
            </form>
        </div>
    </div>
	</body>
</html>