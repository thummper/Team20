<div id="issue">
    <div id="call-input" class="issue-input">
        <select name="sort" id="incat" class="dropdown cat">
            <option selected disabled value="">Category</option>
            <option value="1">OS</option>
            <option value="2">Software</option>
            <option value="3">Printer</option>
            <option value="4">Hard drive</option>
            <option value="5">...</option>
        </select>
        <select name="sort" id="inpriority" class="dropdown priority">
            <option selected disabled value="">Priority</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
        <textarea  id="indes" rows="10" placeholder="Description" class="des"></textarea>
        <textarea  id="insoft" rows="3" placeholder="Effected software (item1, item2, ...)" class="soft"></textarea>
        <textarea  id="inhard" rows="3" placeholder="Effected hardware (item1, item2, ...)" class="hard"></textarea>
        <div class="issue-but">
            <input type="submit" class="cancel" value="Cancel" action="action" onclick="window.history.back(); return false;"/>
            <input type="submit" id="mybtn" class="next" value="Next" onclick="nextissue();"/>
        </div>
    </div>
    
</div>
<div id="query">
    <div id="call-input" class="issue-input">
        <input  type="text" name="issueID" id="issueID" class="dropdown cat" placeholder="Issue ID"/>
        <select name="resolved" id="resolved" class="dropdown priority">
            <option selected disabled value="">Resolved</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
        </select>
        <textarea rows="10" placeholder="Reason for Call" class="query"></textarea>
        <div class="issue-but1">
            <input type="submit" class="cancel" value="Cancel" action="action" onclick="window.history.back(); return false;"/>
            <input type="submit" id="mybtn1" class="next" value="Submit" onclick="window.location.href='main.php'"/>
            
        </div>
    </div>
</div>

<div id="printertable">
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
			<td>075</td>
			<td>Printer Software</td>
			<td>P Jones</td>
			<td>09/10/2017</td>
			<td>2</td>
			<td>Y</td> 
			<td><a href="#">View</a></td>
		</tr>
		<tr>
			<td>073</td>
			<td>Printer Hardware</td>
			<td>P Jones</td>
			<td>09/10/2017</td>
			<td>1</td>
			<td>N</td>
			<td><a href="#">View</a></td>
		</tr>
	</table>
	<div class="page-num print-table" >
		<ul>
			<li><a href="#" class="first-last">Previous</a></li>
			<li class="page-i">1</li>
			<li><a href="#" class="first-last">Next</a></li>
		</ul>
    </div>
</div>
<div id="operator">
            <div class="sidebar-top">
                <h2>Operator</h2>
                <p>Claire Davies</p>
            </div>
            <div class="sidebar-mid">
                <ul class="nav">
                    <li><h3>Issues</h3></li>
                    <li><a href="main.php" class="top-sub">All</a></li>
                    <li><a href="main-open.php">Open</a></li>
                    <li><a href="main-closed.php">Closed</a></li>
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

<div id="specialist">

            <div class="sidebar-top">
                <h2>Specialist</h2>
                <p>Paul Jones</p>
            </div>
            <div class="sidebar-mid">
                <ul class="nav">
                    <li><h3>Issues</h3></li>
                    <li><a href="main.php" class="top-sub">All</a></li>
                    <li><a href="main-open-spec.php">My Issues</a></li>
                    <li><a href="main-closed.php">Closed</a></li>
                    <li><h3>More</h3></li>
                    <li><a href="analytics.php" class="top-sub">Analytics</a></li>
                    <li><a href="index.php">Log out</a></li>
                    
                </ul>
            </div> 
            
</div>
