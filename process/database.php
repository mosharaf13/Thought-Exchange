<?php
	$con=mysql_connect("localhost","root","");
	
	if($con)
	{
		mysql_select_db("project",$con);
		$sql="SELECT * FROM status ORDER BY status_id ASC";
		mysql_query($sql);
	}
	else{
			echo 'not connected';
		}	
?>