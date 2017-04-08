<?php
include "database.php";
session_start();

$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];
$apassword=$_POST['adminpassword'];
$validation=123456789;
	function insert_user ($name,$email,$pass,$apassword)
	{
		$sql="INSERT INTO admin(username,email,password,apassword)VALUES('$name','$email','$pass','$apassword')";
		mysql_query($sql);
	}
if($apassword==$validation)
{
	insert_user($username,$email,$password,$apassword);

}




header('Location:../index.php');
?>











