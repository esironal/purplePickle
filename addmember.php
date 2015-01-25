<?php
//http://www.phpeasystep.com/phptu/6.html
require "isloggedin.php";

// username and password sent from form 
$myusername=$_POST['username2']; 
$mypassword=$_POST['pw2']; 

if(empty($myusername)&&empty($pw))
{
	header("location:/");
	exit();
}

$myusername=htmlentities($myusername);
$mypassword=htmlentities($mypassword);
// To protect MySQL injection (more detail about MySQL injection)
/*$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);*/
//echo $tbl_name." ".$myusername." ".$mypassword;
$tbl_name="Members";
$sql="SELECT * FROM $tbl_name WHERE username= ?;"; //$myusername

//PARENTHESIS ISSUE
if($stmt = mysqli_prepare($cxt,$sql)){
mysqli_stmt_bind_param($stmt,"s", $myusername);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt,$user);

$count = 0;
// fetch values 
while (mysqli_stmt_fetch($stmt)) {
	$count++;
}
if($count==0)
{
	$sql2="INSERT INTO $tbl_name VALUES (?,?, NULL);";
	if($stmt2 = mysqli_prepare($cxt,$sql2))
	{
		mysqli_stmt_bind_param($stmt2,"ss", $myusername,$mypassword);
		mysqli_stmt_execute($stmt2);
		mysqli_stmt_bind_result($stmt2,$user);
		mysqli_stmt_close($stmt);
		mysqli_stmt_close($stmt2);
		mysqli_close($cxt);
		echo "Processed. The pickle will direct you to the main page in two seconds to login. <meta http-equiv=\"Refresh\" content=\"2; url=http://purplepickle.byethost31.com\"> ";
	}
}
else
{
	mysqli_close($cxt);
	echo "Username already taken. The pickle will direct you to the main page in two seconds. <meta http-equiv=\"Refresh\" content=\"2; url=http://purplepickle.byethost31.com\"> ";
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