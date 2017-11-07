<!DOCTYPE HTML>

<html>
	<head>
        <title>Help Desk</title>
        <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px'/>
        <link rel="stylesheet" href="css/style.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        window.onload = function() {
          var issue = document.getElementById("issuebutton");
          var query = document.getElementById("querybutton");
          issue.onclick = function() {
            document.getElementById("issuebutton").classList.add('selected');
            document.getElementById("querybutton").classList.remove('selected');
            $("#input-div").load("media/input.php #issue")
            
            return false;
          }
          query.onclick = function() {
            document.getElementById("querybutton").classList.add('selected');
            document.getElementById("issuebutton").classList.remove('selected');
            $("#input-div").load("media/input.php #query")
            
            return false;
          }
        }
        function issuebutton(){
        var div = document.getElementById('call-input');
        div.innerHTML = '';
        }
        function searchstaff(){
            if($('#staff-id').val() == "101"){
                $("#staffinfo").html("<td>101</td><td>John Smith</td><td>Manager</td><td>Sales</td><td>07974850386</td>");
            }else if($('#staff-id').val() == "304"){
                $("#staffinfo").html("<td>304</td><td>Sara Perry</td><td>Manager</td><td>Distributions</td><td>07859486922</td>");
            }else{
                alert("Invalid Staff ID");
            }
        }

    </script>
    
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
                    <li><a href="operator.php" class="top-sub">All</a></li>
                    <li><a href="#">Open</a></li>
                    <li><a href="#">Closed</a></li>
                    <li><h3>Queries</h3></li>
                    <li><a href="#" class="top-sub">All</a></li>
                    <li><a href="#">Open</a></li>
                    <li><h3>More</h3></li>
                    <li><a href="analytics.php" class="top-sub">Analytics</a></li>
                    <li><a href="index.php">Log out</a></li>
                    
                </ul>
            </div> 
            <div class="sidebar-bot">
                <a class="call" href="#">New Call</a>
            </div>
        </div>
        
        <div class="main">
            <div class="title">
                <h1>New Call</h1>
            </div>
                <div class="id-sel">
                    <input type="text" class="s-bar-id" name="staff-id" id="staff-id" placeholder="Staff ID" />
                    <input type="submit" class="s-button" value="Search" onclick="searchstaff();"/>
                </div>
                <table class="staff-info" style="width:100%">
                        <tr>
                            <th>Staff ID:</th>
                            <th>Full name:</th>
                            <th>Job title:</th> 
                            <th>Department:</th> 
                            <th>Telephone number:</th> 
                        </tr>
                        <tr id="staffinfo">
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td> 
                        </tr>
                        
                    </table>
                <ul class="tab">
                    <li><a id="issuebutton" class="selected">Issue</a></li>
                    <li><a id="querybutton" >Query</a></li>
                </ul>
                <div id="input-div">
                </div>
                 <script>$("#input-div").load("media/input.php #issue")</script>   
        </div>
	</body>
</html>