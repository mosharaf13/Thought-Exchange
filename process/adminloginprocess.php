<?php
session_start();
include "database.php";

$username=$_POST['uname'];
$password=$_POST['pass'];


login($username,$password,$checkbox);

function login($name,$pass,$checkbox)
{
	$sql="SELECT * FROM admin WHERE username='$name'";
	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result))
	{
		if($row['password']==$pass)
		{
			$_SESSION['id']=$row['user_id'];
			$_SESSION['name']=$row['username'];
			$_SESSION['pro']=$row['img_name'];
			$_SESSION['admin']=$row['user_id'];
			if(isset($_POST['check']))
			{
				$cookie_name = "user";
				$cookie_value = $row['user_id'];	
				setcookie($cookie_name,$cookie_value, time() + (5), "/");
			/*	if(!isset($_COOKIE[$cookie_name]) || !isset($_SESSION['id'])) {
				    echo "Cookie named '" . $cookie_name . "' is not set!";
				}
				 else {
				    echo "Cookie '" . $cookie_name . "' is set!<br>";
				    echo "Value is: " . $_COOKIE[$cookie_name];
				}*/
			}
			header('Location:../index.php');
			die();
		}
		else
		{
			header('Location:../process/login.php?error=yes');
			die();
		}
	}
	header('Location:../process/login.php?error=username');
	die();
}
?>

