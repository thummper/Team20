<!DOCTYPE HTML>
<!-- 
database.php

Displays certain tables from the database and allows an administrator to edit/add items to tables. 

Made by: Aron, Tom

-->
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
            //Get all tables.
            $sql = "SHOW TABLES FROM $dbname";
            $result = $conn->query($sql);
        
            if(!$result){
                cLog("DB Error, could not list tables");
            }

            $tableNames = array();
            echo "<div class='dbbuttonContainer'>";
            //From list of tables get the ones we need
            while($row = $result->fetch_row()){
                //Make the buttons for tabbed nav 
                $tableName = $row[0];
                //SHOW sql is weird, seems like this is the best way to avoid reworking it.
                if($tableName === "Equipment" || $tableName === "Job" || $tableName === "Software"|| $tableName === "Specialisation" || $tableName === "Staff_Spec" || $tableName === "Staff"){
                array_push($tableNames, $tableName);
                echo "<button class='tablinks' onclick=' openTable(event, \"$tableName\" ) ' >$tableName</button>";
                }
            }
            echo "</div>";
            //For each table make a tabbed section for it. 
            foreach($tableNames as $tableName){
            $start = 0;
            echo "<div id='$tableName' class='tabcontent'>";
            if($tableName === "Staff"){
                $sql1 = "SELECT Staff_ID, Forename, Surname FROM $tableName";
                
            }else{
            $sql1 = "SELECT * FROM $tableName";
            }
            $result1 = $conn->query($sql1);
                        if(!$result1){
                cLog("DB Error");
            } else {
            //Draw the table
            echo "<table class='dbTable $tableName'>";
            while( $row1 = $result1->fetch_assoc() ){

                if($start == 0){
                //Start is 0, first row of table, column headers.
                $keyArr = array_keys($row1);
                    echo "<tr class='keys'>";
                    foreach($keyArr as $key){
                        echo "<th>";
                        echo $key;
                        echo "</th>";
                    }
                    echo "</tr>";
                    
                } 
                // print normal trs
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
            //Container for dbButtons
            echo "<div class='dbedit' id='$tableName'>";
            //Buttons for add/remove/edit
            echo "<button onclick='addEntry(this)'> Add Entry </button><button id='editButton' onclick='editEntry(this)'> Edit Selected </button>";
            echo "</div>";
            }
            //Get all columns from the table to make the add/edit forms.
            $sqlCols = "SHOW COLUMNS FROM $tableName";
            $result = $conn->query($sqlCols);
            if(!$result){
            cLog("DB Error, could not list tables");
            }
            
            //Modal window for inputting data.
            echo "<div class='modal'>";
            echo "<div class='inputDB " . $tableName . " " . $tableName . "mod'>";
            echo "<span class='closeTicketSubmit' onclick='closeInput(this)'>×</span>";
            echo "<div class='title'><h1>$tableName</h1></div>";
            echo "<form class='inputDBSE $tableName' action='javascript:void(0);'>";
            while($row = $result->fetch_row()){
 
                echo "<input type='text' placeholder='$row[0]' name='$row[0]'><br>";
                
                
            }
            echo "<button class='dbSubmit' onclick='databaseInput(this.parentNode, \"$tableName\", \"INPUT\") '> Submit</button>";
            echo "<div class='dbFeedback'>Query was not successful, please try again.</div>";
            echo "</form></div></div>";
            
            
            //Modal window for editing existing record. 
            echo "<div class='modal'>";
            cLog("Table Name at this point: " . $tableName);
            echo "<div class='editRecord " . $tableName . " " . $tableName . "mod'>";
            echo "<span class='closeTicketSubmit' onclick='closeInput(this)'>×</span>";
            echo "<div class='title'><h1>$tableName</h1></div>";
            echo "<form class='editDBSE $tableName' action='javascript:void(0);'>";
            $sqlCols = "SHOW COLUMNS FROM $tableName";
            $result = $conn->query($sqlCols);
            if(!$result){
            cLog("DB Error, could not list tables");
            }
            while($row = $result->fetch_row()){
             
            echo "<input type='text' placeholder='$row[0]' name='$row[0]'><br>";
            }
            echo "<button class='dbSubmit' onclick='databaseInput(this.parentNode, \"$tableName\", \"EDIT\")'> Submit</button>";
            
            //User feedback for query. 
            echo "<div class='dbFeedback'>Query was not successful, please try again.</div>";
            
            echo "</form></div></div>";
            
            
            
            
            
            echo "</div>";
        }    
        } 
    }
?>
    <script>
        function closeInput(item) {
            console.log("Closing: " + item);
            console.log(item.parentElement);
            item.parentElement.parentElement.style.display = "none";
            //Also when you close the input windows make the fails dissapear. 
            var feedbacks = document.getElementsByClassName("dbFeedback");
            for(var i = 0; i<feedbacks.length; i++){
                feedbacks[i].style.display = "none";
            }
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
            var element = document.getElementsByClassName(elementName)[0];
            element.parentElement.style.display = "block";
            console.log("Add a record to this table: " + t.parentNode.parentElement.id);
        }



        var globalEdit = [];

        function editEntry(t) {
            //Make the edit window visible (should only make visible if it can find an active table row)
            var elementName = "editRecord " + t.parentElement.id;
            var element = document.getElementsByClassName(elementName)[0];
            



            //Set the fields in the form to the selected row. 

            var keys = element.parentElement.parentElement.getElementsByClassName("keys")[0];
            //Get Form? 
            var form = element.getElementsByTagName("form")[0];
            var formElements = form.getElementsByTagName("input");

            //Get the active row. 
            var rows = element.parentElement.parentElement.getElementsByTagName("tr");


            for (i = 0; i < rows.length; i++) {
                if (rows[i].classList.contains("active")) {
                    //This is the record we want.
                    element.parentElement.style.display = "block";
                    for (j = 0; j < rows[i].children.length; j++) {
                        if (j == 0) {
                            //First item is always primary key - will store this for the UPDATE query. 

                            globalEdit.push({
                                Field: keys.children[j].innerHTML,
                                Data: rows[i].children[j].innerHTML
                            });
                        }
                        formElements[j].value = rows[i].children[j].innerHTML;
                    }


                }
            }
        }


        function databaseInput(form, tableName, action) {

            var data = [];
            //Should do basic database validation?? 
            console.log(form + " has been submitted for: " + tableName);
            var nodeList = form.childNodes;
            data.push({
                Field: "TableName",
                Data: tableName
            });
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
                            Data: "'" + nodeList[i].value + "'"
                        });
                    }
                }
            }



            //AJAX to submit data 
            var xmlhttp = new XMLHttpRequest(); 

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    
                    var textCompare = this.responseText;
                    console.log("Testing: " + this.responseText + " AND YES");
                    if(textCompare === "YES"){
                  
                        //Query was successful. 
                        location.reload(); 
                    } else {
                    console.log(this.responseText);
                    var feedbacks = document.getElementsByClassName("dbFeedback");
                        for(var i = 0; i < feedbacks.length; i++){
                            feedbacks[i].style.display = "block";
                        }
                    }
                }
            }
            if (action == "INPUT") {
                console.log("WANTS TO INPUT");
                var json_upload = "user_data=" + JSON.stringify(data);
                xmlhttp.open("POST", "/addDatabase.php");
            }
            if (action == "EDIT") {
                //Need the primary key of the field we are updating
                console.log("WANTS TO EDIT");
                console.log("Adding GEDIT: " + globalEdit[0].Field + " " + globalEdit[0].Data);
                data.push({
                    Field: globalEdit[0].Field,
                    Data: globalEdit[0].Data
                });
                var json_upload = "user_data=" + JSON.stringify(data);
                //This way the pKey will always be last in the data


                xmlhttp.open("POST", "/editDatabase.php");
            }
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send(json_upload);



        }

    </script>
</head>

<body>
    <div class="sidebar">
        	<div class="sidebar-top">
                <h2><?php echo $_SESSION["jobTitle"]; ?></h2>
                <p><?php echo $_SESSION["staffName"]; ?></p>
            </div>
            <div class="sidebar-mid">
                <ul class="nav">
                    <li><h3>Tickets</h3></li> 
                    <li><a id="all" href="main.php" class="top-sub">All</a></li>
                    <?php
                    if($_SESSION["jobID"] == 1){
                        echo '<li><a id="my" href="main.php?tableType=My">My Tickets</a></li>';
                      
                    }
                    ?>
                    <li><a id="open" href="main.php?tableType=Open">Open</a></li>
                    <li><a id="closed" href="main.php?tableType=Closed">Closed</a></li>
                    <li>
                        <h3>Queries</h3>
                    </li>
                    <li><a href="queries.php" class="top-sub">All</a></li>
                    <li><a href="queries.php?tableType=Open">Open</a></li>
                    <li>
                        <h3>More</h3>
                    </li>
                    <li><a href="analytics.php" class="top-sub">Analytics</a></li>
                    <?php
                    if($_SESSION["jobID"] == 3){
                        echo '<li><a  class="active" href="database.php">Databases</a></li>';
                    }
                    ?>
                    <li><a href="logout.php">Log out</a></li>
                </ul>
            </div>
            </div>
            <div class="sidebar-bot">
                <a class="call" href="call.php">New Call</a>
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
