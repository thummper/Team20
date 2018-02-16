<?php 
/* 
logout.php 

Destroys any session a user might have and then redirects to the login page 

Made by: Tom.

*/
session_start();
session_destroy();
header("Location: index.php");
?>