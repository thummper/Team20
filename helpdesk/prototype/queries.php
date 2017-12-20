<!DOCTYPE HTML>

<html>
	<head>
        <title>Help Desk</title>
        <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px'/>
        <link rel="stylesheet" href="css/style.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
	<body>
        <div id="sidebar" class="sidebar">
            
        </div>
        <script>
            if(localStorage.usertype == "specialist"){
                $("#sidebar").load("media/input.php #specialist")
            }else{
                $("#sidebar").load("media/input.php #operator")
            }
        </script>
        <div class="main">
            <div class="title">
                <h1>Query</h1>
            </div>
            <div class="content">
                
                <div class="table">
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
                            <td>096</td>
                            <td>C Davies</td>
                            <td>073</td>
                            <td>10/11/17</td>
                            <td>Y</td> 
                            <td><a href="#">View</a></td>
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
                            <td>094</td>
                            <td>C Davies</td>
                            <td>073</td>
                            <td>10/11/17</td>
                            <td>Y</td> 
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
                            <td>091</td>
                            <td>E Thomas</td>
                            <td>079</td>
                            <td>10/11/17</td>
                            <td>Y</td> 
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
                            <td>090</td>
                            <td>E Thomas</td>
                            <td>083</td>
                            <td>10/11/17</td>
                            <td>Y</td> 
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
                            <td>087</td>
                            <td>E Thomas</td>
                            <td>072</td>
                            <td>09/11/17</td>
                            <td>N</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>086</td>
                            <td>C Davies</td>
                            <td>073</td>
                            <td>09/11/17</td>
                            <td>N</td>
                            <td><a href="#">View</a></td>
                        </tr>
                        
                    </table>
                    <div class="page-num page-num-q">
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