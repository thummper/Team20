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
        require_once("myFunctions.php");
        cLog("Logged in as: " . $_SESSION["staffID"] . " with name: " . $_SESSION["staffName"] . " job title: " . $_SESSION["jobTitle"]);
        
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
                    <li><h3>Issues</h3></li> 
                    <li><a href="#" class="top-sub active">All</a></li>
                    <li><a href="#">Open</a></li>
                    <li><a href="#">Closed</a></li>
                    <li><h3>Queries</h3></li>
                    <li><a href="#" class="top-sub">All</a></li>
                    <li><a href="#">Open</a></li>
                    <li><h3>More</h3></li>
                    <li><a href="#" class="top-sub">Analytics</a></li>
                    <li><a href="logout.php">Log out</a></li>
                </ul>
            </div> 
            <div class="sidebar-bot">
                <a class="call" href="call.php">New Call</a>
            </div>
        </div>
        <div class="main">
        	
        </div>
        
	</body>
</html>
