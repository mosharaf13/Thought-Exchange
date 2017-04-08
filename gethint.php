<?php
include "process/database.php";
session_start();
unset($_SESSION['link']);
// Array with names
$sql = "SELECT * FROM tag";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
    $a[]=$row['tag_name'];

// get the q parameter from URL
$q = $_REQUEST["q"];
$hint = "";

// lookup all hints from array if $q is different from "" 

if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ",$name";
            }
        }
    }
}
// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "Not an avilable tag" : $hint;
?>