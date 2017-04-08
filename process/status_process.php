<?php
session_start();
include 'database.php';
	$title=htmlentities($_POST['header']);
	$status2=base64_encode($_POST['status']);
	if(isset($_SESSION['id']))
	{
		$name2=$_SESSION['name'];
		$uid=$_SESSION['id'];
		$tagname=$_POST['tag'];
	}
	else if(isset($_COOKIE['id']))
	{
		$name2=$_COOKIE['name'];
		$uid=$_COOKIE['id'];
		$tagname=$_POST['tag'];
	}

	//$status2 = mysql_real_escape_string[$status2];
	/*$dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
	$date=date('m/d/Y h:i:s a',time());*/
	//$date=date('F j, Y, g:i a', time() - 6*3600); 
	$sql="UPDATE tag SET value=value+1 WHERE tag_name='$tagname'";
	$res=mysql_query($sql);

	$dat = new DateTime('now', new DateTimezone('Asia/Dhaka'));
	$date=$dat->format('F j, Y, g:i a');
	status_update($status2,$title,$name2,$date,$tagname,$uid);

	function status_update($status2,$title,$name2,$date,$tagname,$uid)
	{
		$sql="INSERT INTO status(username,status_header,status,time,tag_name,user_id)VALUES('$name2','$title','$status2','$date','$tagname',$uid)";
		mysql_query($sql);
	}
	header('Location:../index.php');
?>