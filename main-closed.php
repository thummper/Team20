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
                    <li><a href="#" class="active">Closed</a></li>
                    <li><h3>Queries</h3></li>
                    <li><a href="queries.php" class="top-sub">All</a></li>
                    <li><a href="queries-open.php">Open</a></li>
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
                <h1>Issues</h1>
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
                            <td>083</td>
                            <td>Network Hardware</td>
                            <td>P Jones</td>
                            <td>11/10/2017</td>
                            <td>3</td>
                            <td>Y</td>
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>082</td>
                            <td>Printer Jam</td>
                            <td>A Smith</td>
                            <td>11/10/2017</td>
                            <td>1</td>
                            <td>Y</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        
                        <tr>
                            <td>080</td>
                            <td>Printer Jam</td>
                            <td>P Jones</td>
                            <td>10/10/2017</td>
                            <td>1</td>
                            <td>Y</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>079</td>
                            <td>Application</td>
                            <td>A Smith</td>
                            <td>10/10/2017</td>
                            <td>2</td>
                            <td>Y</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>078</td>
                            <td>OS Crash</td>
                            <td>P Jones</td>
                            <td>10/10/2017</td>
                            <td>2</td>
                            <td>Y</td>
                            <td><a href="#">View</a></td>
                        </tr>
                        
                        <tr>
                            <td>075</td>
                            <td>Printer Software</td>
                            <td>P Jones</td>
                            <td>09/10/2017</td>
                            <td>2</td>
                            <td>Y</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        
                        <tr>
                            <td>072</td>
                            <td>Application</td>
                            <td>A Smith</td>
                            <td>09/10/2017</td>
                            <td>2</td>
                            <td>Y</td> 
                            <td><a href="#">View</a></td>
                        </tr>
                        
                    </table>
                    <div class="page-num closed-num">
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