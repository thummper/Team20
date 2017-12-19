<!DOCTYPE HTML>

<html>

<head>
    <title>Help Desk</title>
    <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px' />
    <link rel="stylesheet" href="css/style.css" />


    <!-- Connect to Database  -->
    <?php 

    $servername = "localhost";
    $username = "root";
    $password = "69420";
    $dbname = "Support";
    $staffID = $_POST["stfID"];



    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn -> connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    } else {
        echo "Connected to database okay. <br>";
        //Will make a dbase query
    }
        ?>




</head>

<body>

</body>

</html>
