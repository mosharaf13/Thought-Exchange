<?php
include "database.php";
session_start();

$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];


insert_user($username,$email,$password);

function insert_user($name,$email,$pass)
{
	$sql="INSERT INTO user(username,email,password)VALUES('$name','$email','$pass')";
	mysql_query($sql);
}

header('Location:../index.php');
?>











