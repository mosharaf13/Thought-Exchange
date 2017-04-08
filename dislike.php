<?php
include "process/database.php";
session_start();

$status_id2 = $_GET['id'];

$user_id=$_SESSION['id'];

$sql = "SELECT * from dislike_info where user_id='$user_id'  and status_id='$status_id2'";
$res = mysql_query($sql);

if(mysql_num_rows($res) > 0) {
	$response = array(
			'status'	=>	'error',
			'msg'		=>	'You have alredy disliked this'
		);
	echo json_encode($response);
}
else{
	$num=1;
	$sql = "INSERT into dislike_info (user_id,status_id,info) values ('$user_id','$status_id2','$num')";
	mysql_query($sql);
	$response = array(
			'status'	=>	'success',
			'msg'		=>	''
		);

	$sql2="UPDATE status SET votes=votes-1 WHERE status_id='$status_id2'";
	mysql_query($sql2);

	$sql="SELECT * from status where status_id='$status_id2'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	$uid=$row['user_id'];
	$sql3="UPDATE user SET rating=rating-1 WHERE user_id='$uid'";
	$res2=mysql_query($sql3);
	echo json_encode($response);
}