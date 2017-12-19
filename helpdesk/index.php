<!DOCTYPE HTML>

<html>
	<head>
        <title>Help Desk</title>
        <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px'/>
        <link rel="stylesheet" href="css/style.css" />
	</head>
	<body class="login-body">
        <form action="databaseFunction.php" class="login-form" method="post">
            <input type="text" placeholder="Staff ID" name="stfID" required>
            <input type="password" placeholder="Password" name="psw" class="login-field" required>
            <button type="submit" class="login-button">Login</button>
        </form> 
        <div class="databaseWrapper">
        <button id="viewDatabases">Databases</button>
        </div>
	</body>
</html>