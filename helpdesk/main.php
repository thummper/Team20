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