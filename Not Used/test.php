<?php
require "isloggedin.php";
//echo $_SESSION['myusername'];
if ($isLoggedIn) { 
$userid= $_SESSION['userid'];
echo $_SESSION['userid'];
$tbl_name = "Files";
$sql="SELECT name,type FROM $tbl_name WHERE ownerid = ?;"; // or die('Error, query failed"

if($stmt = mysqli_prepare($cxt,$sql)){

mysqli_stmt_bind_param($stmt,"i", $userid);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt,$col1,$col2);//, $col2, $col3, $col4, $col5, $col6);
     //echo $userid;
     $count=0;
     while (mysqli_stmt_fetch($stmt)) {
       $count++;
    }
    echo $count;
}
} 
else {
    header("location:/");
    exit(); 
}
?>