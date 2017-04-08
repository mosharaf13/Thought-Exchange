<?php
include "process/database.php";
session_start();
unset($_SESSION['link']);

		$stid2=$_GET['stid'];
		$sql="DELETE FROM status WHERE status_id=$stid2";
		$res=mysql_query($sql);
		$sql="DELETE FROM comment WHERE comment_id=$stid2";
		header('Location:index.php');
?>