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
                <h1>Query: 097</h1>
            </div>
            <div class="issue-data">
            <div class="speinfo-q">
                <h2>Operator</h2>
                <p><b>ID:</b> 301</p>
                <p><b>Name:</b> Claire Davies</p>
                <p><b>Telephone:</b> 07968746385</p>
            </div>
            <p class="time"><b>Time of call:</b> 09:37, 11/10/17</p>
            <h2>Reason for call</h2>
                
            <table class="staff-info" style="width:100%">
                <tr>
                    <th>Staff ID:</th>
                    <th>Full name:</th>
                    <th>Job title:</th> 
                    <th>Department:</th> 
                    <th>Telephone number:</th> 
                </tr>
                <tr id="staffinfo">
                    <td>304</td>
                    <td>Sara Perry</td>
                    <td>Manager</td>
                    <td>Distributions</td>
                    <td>07859486922</td> 
                </tr>     
            </table>
            <div id="query">
                <div id="call-input" class="issue-input">
                    <input  disabled type="text" name="issueID" id="issueID" class="dropdown cat" placeholder="Issue ID: 084"/>
                    <select disabled name="resolved" id="resolved" class="dropdown priority">
                        <option selected disabled value="">Resolved: No</option>
                    </select>
                    <textarea disabled rows="10" placeholder="Reason for Call" class="query"></textarea>
                </div>
            </div>
            </div>
        </div>
	</body>
</html>