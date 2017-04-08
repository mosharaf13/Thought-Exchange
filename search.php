<?php
include "process/database.php";
session_start();
unset($_SESSION['link']);
// Array with names
$sql = "SELECT * FROM status";
$result = mysql_query($sql);
$q = $_REQUEST["q"];
$hint = "";
while($row = mysql_fetch_array($result))
{
    $a=$row['status_header'];
    
    if ($q !== "") {
        $q = strtolower($q);
        $len=strlen($q);
        //$a = strtolower($a);
        //foreach($a as $name) {
            //if (stristr($q, substr($a, 0, $len))) {
        if(strpos($a, $q)!=false){
                $id=$row['status_id'];
            ?>
                <div class="suggetion">
                    <h4><a href="process/comment.php?stid=<?php echo $id ?>"><?php echo $a; ?></a></h4>
                </div>
                    
                    <?php
                }
            }
       // }
    }
// lookup all hints from array if $q is different from "" 
// Output "no suggestion" if no hint was found or output correct values 
?>
