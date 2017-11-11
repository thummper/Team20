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
                    <li><a href="main.php" class="top-sub">All</a></li>
                    <li><a href="main-open.php">Open</a></li>
                    <li><a href="main-closed.php">Closed</a></li>
                    <li><h3>Queries</h3></li>
                    <li><a href="queries.php" class="top-sub">All</a></li>
                    <li><a href="queries-open.php" class = "active">Open</a></li>
                    <li><h3>More</h3></li>
                    <li><a href="analytics.php" class="top-sub">Analytics</a></li>
                    <li><a href="index.php">Log out</a></li>
                    
                </ul>
            </div> 
            <div class="sidebar-bot">
                <a class="call" href="call.php">New Call</a>
            </div>
        </div>
        <div class="main">
            <div class="title">
                <h1>Query</h1>
            </div>
            <div class="content">
                
                <div class="table">
                    <table style="width:100%" id="issuesTable">
                       <table style="width:100%" id="issuesTable">
                        <tr>
                            <th>Query ID:</th>
                            <th>Operator:</th>
                            <th>Issue ID:</th> 
                            <th>Date:</th> 
                            <th>Issue Resolved:</th> 
                        </tr>
                        <tr>
                            <td>098</td>
                            <td>E Thomas</td>
                            <td>080</td>
                            <td>11/11/17</td>
                            <td>N</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>097</td>
                            <td>C Davies</td>
                            <td>083</td>
                            <td>11/11/17</td>
                            <td>N</td>
                            <td><a href="query.php">View</a></td>
                        </tr>
                       
                        <tr>
                            <td>095</td>
                            <td>C Davies</td>
                            <td>075</td>
                            <td>10/11/17</td>
                            <td>N</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        
                        <tr>
                            <td>093</td>
                            <td>E Thomas</td>
                            <td>081</td>
                            <td>10/11/17</td>
                            <td>N</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>092</td>
                            <td>E Thomas</td>
                            <td>079</td>
                            <td>1</td>
                            <td>N</td>
                            <td><a href="#">View</a></td>
                        </tr>
                        
                        <tr>
                            <td>009</td>
                            <td>C Davies</td>
                            <td>077</td>
                            <td>10/11/17</td>
                            <td>N</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        
                        <tr>
                            <td>089</td>
                            <td>C Davies</td>
                            <td>080</td>
                            <td>3</td>
                            <td>N</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>088</td>
                            <td>E Thomas</td>
                            <td>078</td>
                            <td>09/11/17</td>
                            <td>N</td>
                            <td><a href="#">View</a></td>
                        </tr>
                        
                        <tr>
                            <td>086</td>
                            <td>E Thomas</td>
                            <td>072</td>
                            <td>09/11/17</td>
                            <td>N</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>085</td>
                            <td>C Davies</td>
                            <td>073</td>
                            <td>09/11/17</td>
                            <td>N</td>
                            <td><a href="#">View</a></td>
                        </tr>
                        
                    </table>
                    <div class="page-num page-num-qo">
                        <ul>
                            <li><a href="#" class="first-last">Previous</a></li>
                            <li class="page-i">1</li>
                            <li><a href="#" class="first-last">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
	</body>
</html>