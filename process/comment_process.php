<?php
session_start();
ob_start();
include 'database.php';
	$comment=base64_encode($_POST['comment']);
	$comment_id2=$_POST['status_id'];
	if(isset($_SESSION['id']))
	{
		$userid=$_SESSION['id'];
	}
	else if(isset($_COOKIE['id']))
	{
		$userid=$_COOKIE['id'];
	}
	$date=date('m/d/Y h:i:s a',time());

	comment_update($comment_id2,$comment,$userid);

	function comment_update($comment_id2,$comment,$userid)
	{
		$sql="INSERT INTO comment(comment_id,comment,user_id)VALUES($comment_id2,'$comment','$userid')";
		mysql_query($sql);
		$sql2="UPDATE status SET comment_num=comment_num + 1 WHERE status_id=$comment_id2";
		mysql_query($sql2);
	}
	header('Location:comment.php');
?>