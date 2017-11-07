<!DOCTYPE HTML>

<html>
	<head>
        <title>Help Desk</title>
        <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px'/>
        <link rel="stylesheet" href="css/style.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
            function login(){
                if($('#username').val() == "101" && $('#password').val() == "1234"){
                    window.location.href = "main.php";
                }else if($('#username').val() == "201" && $('#password').val() == "1234"){
                    window.location.href = "main.php";
                }else{
                    alert('Incorrect username and password')
                }
            }
        </script>
	</head>
	<body class="login-body">
        <div class="login">
            <h2>Login</h2>
            <input type="text" class="username" name="username" id="username" placeholder="Staff ID" /> 
            <input type="password" class="password" name="password" id="password" placeholder="Password" />  
            <input type="submit" class="login-button" value="Login" onclick="login();"/>
        </div>
	</body>
</html>