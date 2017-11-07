<!DOCTYPE HTML>
<script>
    function login(form){
        console.log("Testing Git");
        console.log(form.username.value)
        if (form.username.value =="Test1" || form.username=="Test2"){
            if (form.password.value == "123"){
                console.log("Stuff is good")
                url = window.location.href;
                newUrl = url.replace("index.php", "operator.php");
                console.log("New URL: " + newUrl);
                window.location.href = newUrl;
        }else{ alert("Invalid Username of Password")
        }
    }
    }
    
</script>

<html>
	<head>
        <title>Help Desk</title>
        <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px'/>
        <link rel="stylesheet" href="css/style.css" />
	</head>
	<body class="login-body">
        <div class="login">
            <h2>Login</h2>
		<form method="post">
            <input type="text" class="username" name="username" id="username" placeholder="Staff ID" /> 
            <input type="password" class="password" name="password" id="password" placeholder="Password" />  
            <input type="button" class="login-button" value="Login" onclick="login(form)"/>
		</form>
        </div>
	</body>
</html>