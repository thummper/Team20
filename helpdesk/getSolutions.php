<?php 
//Passed a ticket type, will return the most recent 3 solved tickets with the same type. 
$ticketType = $_GET["type"];


include("config.php");
require_once('myFunctions.php');


$conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname);

if($conn -> connect_error) {
    die("Connection Failed: " . $conn->connect_error);

} else { 
   
    $sql = "SELECT * FROM Ticket WHERE Problem_Type = '$ticketType' AND Resolved = 'Y' ORDER BY Date_Made DESC";
    $result = $conn->query($sql);
   if($result->num_rows > 0){
    $returnTable = "<table class='helpSolutions'><tr><th>ID</th><th>Description</th><th>Solution</th></tr>";
    //Seem to be unable to reliably get the number of results from an SQL query (getting link 1400 for OS)
    for($i = 0; $i < 3; $i++){
    while($row = $result->fetch_assoc()){
        $returnTable .= "<tr>";
        
        
        $returnTable .= "<td>".$row["Ticket_ID"]."</td>";
        $returnTable .= "<td>".$row["Description"]."</td>";
        $returnTable .= "<td>".$row["Solution"]."</td></tr>";

    }
    }
        $returnTable .= "</table>";
   }
    
    //Ok table should be ok now
    //Will echo table if there is one, message if not
    if($returnTable){
    echo $returnTable;
    }else {
        echo "No Possible Solutions Found.";
    }
    


    
}




?>