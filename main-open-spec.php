<!DOCTYPE HTML>
   
<script>
    function selectChange(select) {
        console.log(select.value);
        if(select.value == 1) {
            
            sortNewest();
        }
        else if(select.value == 2){
            sortPriority();
            
        }
    }
	function sortNewest() {
        console.log("Sort Newest");
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("issuesTable");
  switching = true;
  while (switching) {
    switching = false;
    rows = table.getElementsByTagName("TR");
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[0];
      y = rows[i + 1].getElementsByTagName("TD")[0];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
        shouldSwitch= true;
        break;
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}

	function sortPriority() {
         console.log("Sort Priority");
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("issuesTable");
  switching = true;
  while (switching) {
    switching = false;
    rows = table.getElementsByTagName("TR");
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[4];
      y = rows[i + 1].getElementsByTagName("TD")[4];
      if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
        shouldSwitch= true;
        break;
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
</script>
<html>
	<head>
        <title>Help Desk</title>
        <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px'/>
        <link rel="stylesheet" href="css/style.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <style>
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 2.5%; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        height:85%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
    .modal h2{
        font-family: "Source Sans Pro", sans-serif;
        margin-left: 0.5em;
        margin-right: 0.5em;
        padding-left:0.5em;
        padding-bottom: 0.2em;
        font-size: 22pt;
        border-bottom: solid 3px #ed6a5e;
        color: #333;
        margin-top:1em;
    }
    .sol-spe{
        margin-top: 21em;     
        border-color: #d16055;
        box-shadow: 0 0 0 2px #d16055;
    }
    </style>
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
                <h1>My Issues</h1>
            </div>
            <div class="content">
                <div class="menu-bar">
                    <div class="search">
                    <input type="text" class="s-bar" name="query" id="query" placeholder="Search" />
                    <input type="submit" class="s-button" value="Search"/>
                    </div>
                    <select name="sort" id="sort" class="sort" onchange="selectChange(this)">
                        <option selected disabled value="">Sort By</option>
                        <option value="2" onclick="sortPriority()">Highest Priority</option>
                        <option value="1" onclick="sortNewest()">Newest First</option>
                    </select>

                </div>
                <div class="table">
                    <table style="width:100%" id="issuesTable">
                        <tr>
                            <th>Issue ID:</th>
                            <th>Category:</th>
                            <th>Specialist:</th>
                            <th>Date Added:</th> 
                            <th>Priority:</th> 
                            <th>Resolved:</th> 
                        </tr>
                        <tr>
                            <td>084</td>
                            <td>OS</td>
                            <td>P Jones</td>
                            <td>11/10/2017</td>
                            <td>2</td>
                            <td>N</td> 
                            <td><a href="issue.php">View</a></td>
                            <td><a href="#" id="mybtn" onclick="nextissue();">Solve</a></td>
                        </tr>
             
                        <tr>
                            <td>081</td>
                            <td>Network</td>
                            <td>P Jones</td>
                            <td>10/10/2017</td>
                            <td>2</td>
                            <td>N</td> 
                            <td><a href="#">View</a></td>
                            <td><a href="issue.php">Solve</a></td>
                        </tr>
                        <tr>
                            <td>077</td>
                            <td>PC Malfunction</td>
                            <td>P Jones</td>
                            <td>09/10/2017</td>
                            <td>2</td>
                            <td>N</td> 
                            <td><a href="#">View</a></td>
                            <td><a href="issue.php">Solve</a></td>
                        </tr>
                        <tr>
                            <td>076</td>
                            <td>Network</td>
                            <td>P Jones</td>
                            <td>09/10/2017</td>
                            <td>3</td>
                            <td>N</td> 
                            <td><a href="#">View</a></td>
                            <td><a href="issue.php">Solve</a></td>
                        </tr>
                        <tr>
                            <td>074</td>
                            <td>PC Malfunction</td>
                            <td>P Jones</td>
                            <td>09/10/2017</td>
                            <td>2</td>
                            <td>N</td> 
                            <td><a href="#">View</a></td>
                            <td><a href="issue.php">Solve</a></td>
                        </tr>
                        <tr>
                            <td>073</td>
                            <td>Printer Hardware</td>
                            <td>P Jones</td>
                            <td>09/10/2017</td>
                            <td>1</td>
                            <td>N</td>
                            <td><a href="#">View</a></td>
                            <td><a href="issue.php">Solve</a></td>
                        </tr>   
                    </table>
                    <div class="page-num open-num">
                        <ul>
                            <li><a href="#" class="first-last">Previous</a></li>
                            <li class="page-i">1</li>
                            <li><a href="#" class="first-last">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="Modal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Solve Issue: 084</h2>
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
                
                    <textarea  disabled id="indes" rows="10" placeholder="Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas neque tortor, blandit sit amet ultrices ut, vestibulum non felis. Aenean id tortor risus. Morbi ac scelerisque libero. Duis non leo metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas neque tortor, blandit sit amet ultrices ut, vestibulum non felis. Aenean id tortor risus. Morbi ac scelerisque libero. Duis non leo metus." class="des"></textarea>
                    <textarea  disabled id="insoft" rows="3" placeholder="Effected software: Microsoft Windows 7" class="soft"></textarea>
                    <textarea  disabled id="inhard" rows="3" placeholder="Effected hardware: None" class="hard"></textarea>
              
            </div>
        <textarea rows="8" placeholder="Solution" class="query-sol sol-spe"></textarea>
          <div class="issue-but1">
            <input type="submit" class="cancel" value="Cancel" action="action" onclick="window.location.href='main-open-spec.php'"/>
            <input type="submit" id="mybtn1" class="next" value="Submit" onclick="window.location.href='main-open-spec.php'"/>
        </div>
        </div>
    </div>
    <script type="text/javascript">
    function selectChange(select) {
        console.log(select.value);
        if(select.value == 1) {
            
            sol();
        }
        else if(select.value == 2){
            sol1();
            
        }
    }
    var modal = document.getElementById('Modal');
    var span = document.getElementsByClassName("close")[0];
    function sol(){
       document.getElementById("solution").disabled = false;
    }
    function sol1(){
       document.getElementById("solution").disabled = true;
    }
    function modalopen() {
        modal.style.display = "block";
    }
    function nextissue(){
        
        modalopen();

    }
    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
	</body>
</html>