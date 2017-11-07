<!DOCTYPE HTML>

<html>
	<head>
        <title>Help Desk</title>
        <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px'/>
        <link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
        <div class="sidebar">
            <div class="sidebar-top">
                <h2>Operator</h2>
                <p>Full Name</p>
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
                    <li><a href="stats.php" class="top-sub">Stats</a></li>
                    <li><a href="index.php">Log out</a></li>
                    
                </ul>
            </div> 
            <div class="sidebar-bot">
                <a class="call" href="call.php">New Call</a>
            </div>
        </div>
        <div class="main">
            <div class="title">
                <h1>Issues</h1>
            </div>
            <div class="content">
                <div class="menu-bar">
                    <div class="search">
                    <input type="text" class="s-bar" name="query" id="query" placeholder="Search" />
                    <input type="submit" class="s-button" value="Search"/>
                    </div>
                    <select name="sort" id="sort" class="sort">
                        <option selected disabled value="">Sort By</option>
                        <option value="2">Highest Priority</option>
                        <option value="1">Newest First</option>
                    </select>

                </div>
                <div class="table">
                    <table style="width:100%">
                        <tr>
                            <th>Issue ID:</th>
                            <th>Category:</th>
                            <th>Specialist:</th> 
                            <th>Priority:</th> 
                            <th>Resolved:</th> 
                        </tr>
                        <tr>
                            <td>012</td>
                            <td>Broken Something</td>
                            <td>A Smith</td>
                            <td>3</td>
                            <td>N</td> 
                            <td><a href="issue.php">View</a></td>
                        </tr>
                        <tr>
                            <td>011</td>
                            <td>Windows crash</td>
                            <td>P Jones</td>
                            <td>1</td>
                            <td>N</td>
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>010</td>
                            <td>Printer Jam</td>
                            <td>A Smith</td>
                            <td>2</td>
                            <td>Y</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>009</td>
                            <td>No Internet</td>
                            <td>A Smith</td>
                            <td>3</td>
                            <td>N</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>008</td>
                            <td>Printer Jam</td>
                            <td>P Jones</td>
                            <td>2</td>
                            <td>Y</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>012</td>
                            <td>Broken Something</td>
                            <td>A Smith</td>
                            <td>3</td>
                            <td>N</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>011</td>
                            <td>Windows crash</td>
                            <td>P Jones</td>
                            <td>1</td>
                            <td>N</td>
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>010</td>
                            <td>Printer Jam</td>
                            <td>A Smith</td>
                            <td>2</td>
                            <td>Y</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>009</td>
                            <td>No Internet</td>
                            <td>A Smith</td>
                            <td>3</td>
                            <td>N</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>008</td>
                            <td>Printer Jam</td>
                            <td>P Jones</td>
                            <td>2</td>
                            <td>Y</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>012</td>
                            <td>Broken Something</td>
                            <td>A Smith</td>
                            <td>3</td>
                            <td>N</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>011</td>
                            <td>Windows crash</td>
                            <td>P Jones</td>
                            <td>1</td>
                            <td>N</td>
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>010</td>
                            <td>Printer Jam</td>
                            <td>A Smith</td>
                            <td>2</td>
                            <td>Y</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        
                    </table>
                    <div class="page-num">
                        <ul>
                            <li><a href="#" class="first-last">Previous</a></li>
                            <li class="page-i">1</li>
                            <li><a href="#">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
	</body>
</html>