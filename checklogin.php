<?php
//http://www.phpeasystep.com/phptu/6.html

//require database connection
require "isloggedin.php";

// username and password sent from form 
$myusername=$_POST['username1']; 
$mypassword=$_POST['pw1']; 

$myusername=htmlentities($myusername);
$mypassword=htmlentities($mypassword);

if(empty($myusername)&&empty($pw))
{
	header("location:/");
	exit();
}

$tbl_name="Members";
$sql="SELECT id FROM $tbl_name WHERE username= ? and password= ?;";

if($stmt = mysqli_prepare($cxt,$sql))
{
	mysqli_stmt_bind_param($stmt,"ss", $myusername,$mypassword);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$user);
	//$result=mysql_query($sql);

	$count = 0;
	$cookieID=0;
	// fetch values 
	while (mysqli_stmt_fetch($stmt)) 
	{
		$count++;
		$cookieID=$user;
	}
	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==1)
	{
		session_start();
		$_SESSION["myusername"] = $myusername;
		$_SESSION["userid"] = $cookieID;
		$_SESSION["loggedin"] = true;
		$_SESSION["time"]=time();
		mysqli_stmt_close($stmt);
		mysqli_close($cxt);
		header("location:list_files.php");
		exit();
	}
	else 
	{
		echo "Wrong username or password. The pickle will direct you to the main page in two seconds. <meta http-equiv=\"Refresh\" content=\"2; url=http://purplepickle.byethost31.com\"> ";
	}
}
?>
<!DOCTYPE html>
<html>
<head>

<link rel="shortcut icon" href="http://www.favicongenerator.com/favicon2/eggplant-large-20141231-favicon.ico" >
	<title>Purple Pickle</title>
<style>
	body {background-color: #F3C1FF;font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;font-size: 15pt;}
</style>
</head>
<body>

</body>
</html>