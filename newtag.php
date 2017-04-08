<?php
session_start();
include 'process/database.php';
	$tagname=$_POST['tname'];
	tag_update($tagname);

	function tag_update($tagname)
	{
			$sql2="INSERT INTO tag(tag_name)VALUES('$tagname')";
			mysql_query($sql2);
	}
	header('Location:index.php');
?>