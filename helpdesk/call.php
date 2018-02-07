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
                <li><a id="issuebutton" class="selected" >Ticket</a></li>
                <li><a id="querybutton" >Query</a></li>
            </ul>
        <div id="ticket">
            <form action="" method="post">
                <div id="call-input" class="issue-input">
                    <select name="sort" id="cat" class="dropdown cat">
                        <option selected disabled value="">Category</option>
                    </select>
                    <select name="sort" id="priority" class="dropdown priority">
                        <option selected disabled value="">Priority</option>
                    </select>
                    <textarea  id="des" rows="10" placeholder="Description" class="des"></textarea>
                    <textarea  id="soft" rows="3" placeholder="Effected software (item1, item2, ...)" class="soft"></textarea>
                    <textarea  id="hard" rows="3" placeholder="Effected hardware (item1, item2, ...)" class="hard"></textarea>
                    <div class="issue-but">
                        <input type="reset" class="reset" value="Reset"/>
                        <input type="submit" id="mybtn" class="next" value="Next"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
	</body>
</html>