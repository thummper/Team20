<!DOCTYPE HTML>

<html>

<head>
    <title>Help Desk</title>
    <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px' />
    <link rel="stylesheet" href="css/style.css" />


    <!-- Connect to Database  -->
    <?php 
    require_once('myFunctions.php');
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
            //Make ths buttons for tabbed nav 
            
                
            
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
                
                

                echo "<tr>";
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
            echo "<button> Add Entry </button><button> Remove Entry </button>";
                            
                            
                            
            echo "</div>";
            echo "</div>";
        }
            
        } 
    }
?>


    
    
    
</head>

<body id="dbBody">

</body>
    <script>
    
        function openTable(evt,tableName) {
      
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
        

    </script>

</html>
