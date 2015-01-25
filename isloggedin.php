<?php
session_name("session");
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
{
	$isLoggedIn=true;
}
else 
{
	$isLoggedIn=false;
}
$host="sql208.byethost31.com"; // Host name 
$username="b31_15690090"; // Mysql username 
$password="pA55word"; // Mysql password 
$db_name="b31_15690090_db"; // Database name 

// Connect to server and select databse.
//http://bytes.com/topic/php/insights/740327-uploading-files-into-mysql-database-using-php/4
$cxt = mysqli_connect($host,$username,$password,$db_name); //or die("Error");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$value = uniqid(rand(), true);
setcookie("cookie", $value, time() + (7 * 24 * 60 * 60),'/','http://purplepickle.byethost31.com/',false,true);
?>