<?php
session_start();
include "database.php";

$username=$_POST['uname'];
$password=$_POST['pass'];


login($username,$password,$checkbox);

function login($name,$pass,$checkbox)
{
	$sql="SELECT * FROM user WHERE username='$name'";
	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result))
	{
		if($row['password']==$pass)
		{

			if(isset($_POST['check']))
			{
					
				setcookie('id',$row['user_id'], time() + (20), "/");
				setcookie('name',$row['username'], time() + (20), "/");
				setcookie('pro',$row['img_name'], time() + (20), "/");
			}
			else{
				$_SESSION['id']=$row['user_id'];
				$_SESSION['name']=$row['username'];
				$_SESSION['pro']=$row['img_name'];
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

