<!DOCTYPE HTML>

<html>

<head>
    <title>Help Desk</title>
    <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px' />
    <link rel="stylesheet" href="css/style.css" />


    <!-- Connect to Database  -->
    <?php 
    session_start();
    if(empty($_SESSION["staffID"])){
        header("Location: index.php");
    }
    require_once('myFunctions.php');
    
    function dbData(){
    include("config.php");
    $conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname);
    
    if($conn -> connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    } else {
        //echo "Connected to database okay. <br>";
        //Will make a dbase query
        $sql = "SHOW TABLES FROM $dbname";
        $result = $conn->query($sql);
        
        if(!$result){
            cLog("DB Error, could not list tables");
        }

        $tableNames = array();
        echo "<div class='dbbuttonContainer'>";
        while($row = $result->fetch_row()){
            //Make the buttons for tabbed nav 
            
                
            
            $tableName = $row[0];
            array_push($tableNames, $tableName);
            echo "<button class='tablinks' onclick=' openTable(event, \"$tableName\" ) ' >$tableName</button>";
            
        }
        echo "</div>";
        
        
        
        foreach($tableNames as $tableName){
            $start = 0;
            echo "<div id='$tableName' class='tabcontent'>";
            
            $sql1 = "SELECT * FROM $tableName";
            $result1 = $conn->query($sql1);
                        if(!$result1){
                cLog("DB Error");
            } else {
            
            //Draw the table
            echo "<table class='dbTable $tableName'>";
            while( $row1 = $result1->fetch_assoc() ){

                if($start == 0){
                //Print the keys. 
                $keyArr = array_keys($row1);
                    
                    echo "<tr class='keys'>";
                    foreach($keyArr as $key){
                        echo "<th>";
                        echo $key;
                        echo "</th>";
                    }
                    echo "</tr>";
                    
                }
                
                

                echo "<tr onclick='rowClick(this,event)'>";
                foreach($row1 as $value1){
                    //Draw table stuff.
                    echo "<td>";
                    echo $value1;
                    echo "</td>";
                }
                echo "</tr>";
                

            $start++;

            }
            echo "</table>";
            //Placeholders for buttons.
            echo "<div class='dbedit'>";
            echo "<button onclick='addEntry(this)'> Add Entry </button><button onclick='removeEntry(this)'> Remove Entry </button>";
                            
                            
                            
            echo "</div>";
            
        }
            //Draw windows for inputting stuff? 
            cLog("This is next section");
            $sqlCols = "SHOW COLUMNS FROM $tableName";
            $result = $conn->query($sqlCols);
            if(!$result){
            cLog("DB Error, could not list tables");
            }
            
            echo "<div class='inputDB $tableName'>";
            echo "<button class='closeDBInput' onclick='closeInput(this)'>X</button>";
            echo "<form class='inputDBSE $tableName' action='javascript:void(0);'>";
            while($row = $result->fetch_row()){
                echo $row[0].": <br>"; 
                echo "<input type='text' name='$row[0]'><br>";
                
                
            }
            echo "<button onclick='databaseInput(this.parentNode, \"$tableName\")'> Submit</button>";
            echo "</form></div></div>";
        
        }
                
             

            
            
            
            
            
        } 
    }
?>
    <script>
        function closeInput(item) {
            console.log("Closing: " + item);
            item.parentNode.style.display = "none";
        }

        function rowClick(row, evt) {
            if (row.classList.contains("active")) {
                //Already has active tag
                row.classList.remove("active");
            } else {

                rows = document.getElementsByTagName("tr");
                for (i = 0; i < rows.length; i++) {
                    rows[i].classList.remove("active");
                }
                row.classList.add("active");
            }
        }


        function openTable(evt, tableName) {

            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tableName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        function trClick(row, event) {

        }

        function addEntry(t) {
            //MAKE this visible.. inputDB $tableName
            var elementName = "inputDB " + t.parentNode.parentElement.id;
            document.getElementsByClassName(elementName)[0].style.display = "block";
            console.log("Add a record to this table: " + t.parentNode.parentElement.id);
        }

        function removeEntry(t) {
            //Will remove active row.
            var tableName = t.parentNode.parentElement.id;
            var rows = document.getElementsByTagName("tr");
            var record = false;
            for (i = 0; i < rows.length; i++) {
                if (rows[i].classList.contains("active")) {
                    record = rows[i];
                }
            }
            console.log("Remove: " + record + " from this table: " + t.parentNode.parentElement.id);
        }

        function databaseInput(form, tableName) {

            var data = [];
            //Should do basic database validation?? 
            console.log(form + " has been submitted for: " + tableName);
            var nodeList = form.childNodes;
            data.push({Field: "TableName", Data: tableName});
            for (i in nodeList) {
                if (nodeList[i].tagName == "INPUT") {

                    if (nodeList[i].name.length == 0) {
                        //Nothing has been submitted in form.
                        data.push({
                            Field: nodeList[i].name,
                            Data: ""
                        });





                    } else {
                        data.push({
                            Field: nodeList[i].name,
                            Data:  "'"+nodeList[i].value+"'"
                        });
                    }



                    //Now it will try and submit to database

                }


            }


            var json_upload = "user_data=" + JSON.stringify(data);
   
            var xmlhttp = new XMLHttpRequest(); // new HttpRequest instance 
            
              xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
              console.log(this.responseText);
               }}
            xmlhttp.open("POST", "/addDatabase.php");
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send(json_upload);



        }

    </script>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-top">
            <h2>
                <?php echo $_SESSION["jobTitle"]; ?>
            </h2>
            <p>
                <?php echo $_SESSION["staffName"]; ?>
            </p>
        </div>
        <div class="sidebar-mid">
                <ul class="nav">
                    <li><h3>Tickets</h3></li> 
                    <li><a id="all" href="main.php" class="top-sub">All</a></li>
                    <li><a id="open" href="main.php?tableType=Open">Open</a></li>
                    <li><a id="closed" href="main.php?tableType=Closed">Closed</a></li>
                    <li><h3>Queries</h3></li>
                    <li><a href="view-query.php" class="top-sub">All</a></li>
                    <li><a href="view-query.php?tableType=Open">Open</a></li>
                    <li><h3>More</h3></li>
                    <li><a href="#" class="top-sub">Analytics</a></li>
                    <li><a href="database.php">Databases</a></li>
                    <li><a href="logout.php">Log out</a></li>
                </ul>
            </div>
        <div class="sidebar-bot">
            <a class="call" href="call.php">New Call</a>
        </div>
    </div>
    <div class="main">
        <div class="title">
            <h1>Databases</h1>
        </div>
        <div id="dbBody">
            <?php
                    dbData();
                ?>
                <!-- This is causing error <script> openTable(event, "Specialisation");</script> -->

        </div>
    </div>
</body>


</html>
