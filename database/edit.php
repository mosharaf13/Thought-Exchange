<?php
include "process/database.php";
session_start();
unset($_SESSION['link']);

		$stid2=$_GET['stid'];
		$sql="SELECT * FROM status WHERE status_id=$stid2";
		$res=mysql_query($sql);
		$row=mysql_fetch_array($res);
		$old_status=$ROW['status'];
		
		header('Location:ask.php');
?>