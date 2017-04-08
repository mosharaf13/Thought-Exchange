<?php
include "database.php";
session_start();
$user_id2=$_SESSION['id'];
$image_link="";
$username=$_SESSION['name'];
    if($_FILES['image_file']['error']>0)
    {
	   echo "error";
    }
    else
    {
	   $prefix =$_SESSION['id'].time();
	   $link = "../images/" .$prefix . $_FILES["image_file"]["name"];
	   move_uploaded_file($_FILES["image_file"]["tmp_name"], $link);
	   $image_link = "http://localhost/project/images/".$prefix.$_FILES["image_file"]["name"];

	   //echo $image_link;
    }
    $sql="UPDATE admin SET img_name='$image_link' WHERE user_id='$user_id2'";
    mysql_query($sql);
    $_SESSION['pro']=$image_link;
    header('Location:../index.php');
?>









