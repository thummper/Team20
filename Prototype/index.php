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
                    localStorage.usertype = "operator"
                    window.location.href = "main.php";
                }else if($('#username').val() == "201" && $('#password').val() == "1234"){
                    localStorage.usertype = "specialist"
                    window.location.href = "main.php";
                }else{
                    alert('Incorrect username and password')
                }
            }
            
            window.onload = function(){
            document.getElementsByClassName("login")[0].onkeydown = function(e) {
                if(e.keyCode == 13) {
                    login();
                }
            };
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