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
      x = rows[i].getElementsByTagName("TD")[3];
      y = rows[i + 1].getElementsByTagName("TD")[3];
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
                    <li><a href="#" class="top-sub active">All</a></li>
                    <li><a href="#" >Open</a></li>
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
                            <th>Query ID:</th>
                            <th>Staff ID</th>
                            <th>Issue ID</th> 
                            <th>Date:</th> 
                            <th>Issue Resolved:</th> 
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
                            <li><a href="#" class="first-last">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
	</body>
</html>