<!DOCTYPE HTML>

<html>

<head>
    <title>Help Desk</title>
    <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px' />
    <link rel="stylesheet" href="css/style.css" />


    <!-- Connect to Database  -->
    <?php 
    
    require_once('myFunctions.php');

    $servername = "localhost";
    $username = "root";
    $password = "69420";
    $dbname = "Support";




    $conn = new mysqli($servername, $username, $password, $dbname);
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
        
        while($row = $result->fetch_row()){
            //For each table, make a table
            $start = 0;
            $tableName = $row[0];
            cLog($tableName);
            
            
            echo "<div class='tableWrapper'>";
            echo "<div class='tableName'>" . $tableName . " Table" . "</div>";
            
            
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
            echo "</div>";
        }
            
            
            
            
            
            
            
        }
        
        
        
    }
        ?>




</head>

<body id="dbBody">

</body>

</html>
