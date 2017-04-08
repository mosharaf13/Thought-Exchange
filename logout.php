<?php
	session_start();
	session_destroy();
	setcookie($cookie_name,$cookie_value, time() - (5), "/");
	header('Location:index.php');
?>