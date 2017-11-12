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
                <h1>Issue: 084</h1>
            </div>
            <div class="issue-data">
            <div class = "spe-info">
                <h2>Specialist</h2>
                <p><b>ID:</b> 405</p>
                <p><b>Name:</b> Alan Smith</p>
                <p><b>Telephone:</b> 078594857633</p>
            </div>
            <div class="ope-info">
                <h2>Operator</h2>
                <p><b>ID:</b> 301</p>
                <p><b>Name:</b> Claire Davies</p>
                <p><b>Telephone:</b> 07968746385</p>
            </div>
            <p class="time"><b>Time of call:</b> 09:37, 11/10/17</p>
            <h2>Issue information</h2>
                
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
            <div id="issue">
                <div id="call-input" class="issue-input">
                    <select disabled name="sort" id="incat" class="dropdown cat">
                        <option selected disabled value="">Category: OS</option>
                        
                    </select>
                    <select disabled name="sort" id="inpriority" class="dropdown priority">
                        <option selected disabled value="">Priority: 2</option>
                        
                    </select>
                    <textarea  disabled id="indes" rows="10" placeholder="Description:      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas neque tortor, blandit sit amet ultrices ut, vestibulum non felis. Aenean id tortor risus. Morbi ac scelerisque libero. Duis non leo metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas neque tortor, blandit sit amet ultrices ut, vestibulum non felis. Aenean id tortor risus. Morbi ac scelerisque libero. Duis non leo metus." class="des"></textarea>
                    <textarea  disabled id="insoft" rows="3" placeholder="Effected software: Microsoft Windows 7" class="soft"></textarea>
                    <textarea  disabled id="inhard" rows="3" placeholder="Effected hardware: None" class="hard"></textarea>
                </div>
            </div>
            <h2 class="issued">Solution</h2>
            <textarea  disabled rows="5" placeholder="Not yet resolved" class="query-sol"></textarea>
            </div>
        </div>
	</body>
</html>