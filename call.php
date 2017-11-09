<!DOCTYPE HTML>

<html>
	<head>
        <title>Help Desk</title>
        <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px'/>
        <link rel="stylesheet" href="css/style.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <style>
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 5%; /* Location of the box */
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
        height:80%;
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
    .sol{
        width: 95%;
        margin-left: 2.5%;
        margin-top: 2em;
    }
    .solution{
        float: left;  

    }
    .sol-div{
        padding-top: 1em;    
    }
    .modal-but{
        margin-top: 4em;
        width: 30%;
        float:right;   
        display: flex;
        align-items: center;
        justify-content: center;
    }
        .modal-but input[type="submit"]{
            width: 30%;
        }
    </style>
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
                    <li><a href="query.php" class="top-sub">All</a></li>
                    <li><a href="#">Open</a></li>
                    <li><h3>More</h3></li>
<<<<<<< HEAD
                    <li><a href="analytics.php" class="top-sub">Analytics</a></li>
=======
                    <li><a href="analytics.php" class="top-sub">Stats</a></li>
                    <li><a href="#" class="top-sub">Personal Stats</a></li>
>>>>>>> 7aa0bc8b4e56466c3a5cdd0547aadbed4434ae5b
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
    <div id="Modal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Possible solutions</h2>
          <div class="table">
                    <table class="sol">
                        <tr>
                            <th>Issue ID:</th>
                            <th>Category:</th>
                            <th>Specialist:</th> 
                            <th>Solution:</th> 
                            <th>Date resolved:</th> 
                        </tr>
                        <tr>
                            <td>012</td>
                            <td>Windows crash</td>
                            <td>A Smith</td>
                            <td style="width: 50%;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas neque tortor, blandit sit amet ultrices ut, vestibulum non felis. Aenean id tortor risus. Morbi ac scelerisque libero. Duis non leo metus. Phasellus convallis a urna ut elementum. Fusce dui quam, facilisis ut scelerisque eget, ornare a sapien. Sed a lorem non leo tincidunt laoreet quis eu augue. Donec sit amet elit lectus.</td>
                            <td>11/02/17</td> 
                            
                        </tr>
                        <tr>
                            <td>011</td>
                            <td>Windows crash</td>
                            <td>P Jones</td>
                            <td style="width: 50%;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas neque tortor, blandit sit amet ultrices ut, vestibulum non felis. Aenean id tortor risus. Morbi ac scelerisque libero. Duis non leo metus. Phasellus convallis a urna ut elementum. Fusce dui quam, facilisis ut scelerisque eget, ornare a sapien. Sed a lorem non leo tincidunt laoreet quis eu augue. Donec sit amet elit lectus.</td>
                            <td>7/11/2017</td>
                        </tr>
                        <tr>
                            <td>010</td>
                            <td>Windows crash</td>
                            <td>A Smith</td>
                            <td style="width: 50%;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas neque tortor, blandit sit amet ultrices ut, vestibulum non felis. Aenean id tortor risus. Morbi ac scelerisque libero. Duis non leo metus. Phasellus convallis a urna ut elementum. Fusce dui quam, facilisis ut scelerisque eget, ornare a sapien. Sed a lorem non leo tincidunt laoreet quis eu augue. Donec sit amet elit lectus.</td>
                            <td>6/11/2017</td> 
                            
                        </tr>
                    </table>
            </div>
            <div class="sol-div">
                <textarea  disabled rows="5" placeholder="Solution" class="solution"></textarea>  
                <select name="resolved" id="resolved" class="dropdown priority">
                    <option selected disabled value="">Resolved</option>
                    <option value="1" onclick="">Yes</option>
                    <option value="2" onclick="">No</option>
                </select>  
            </div>
            <div class="modal-but">
                <input type="submit" class="cancel" value="Next Issue" action="action" onclick="modal.style.display = 'none';"/>
                <input type="submit" id="finish" class="next" value="Submit" onclick="window.location.href='main.php'"/>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    var modal = document.getElementById('Modal');
    var span = document.getElementsByClassName("close")[0];
    function modalopen() {
        modal.style.display = "block";
    }
    function nextissue(){
        if($('#indes').val() == "" || $('#inpriority').val() == "" || $('#incat').val() == "" || $('#staff-id').val() == ""){
            alert("Required data is missing");
            return;
        }else{
        modalopen();
        }
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