<?php
require "isloggedin.php";
$token = $_POST['token'];
if ($isLoggedIn&&$token==$_SESSION['renameToken']) {
	// username and password sent from form 
	$alterto=$_POST['newname']; 
	$myfileid=$_POST['fileid'];
	$userid =$_SESSION['userid'];

	$alterto = htmlentities($alterto);
	//$sql = "UPDATE `b31_15690090_db`.`Files` SET `name` =  '".$alterto."' WHERE  `Files`.`id` =".$myfileid." AND `ownerid`= ".$_SESSION['userid'].";";
	//echo $sql;
	$sql = "UPDATE `b31_15690090_db`.`Files` SET `name` = ? WHERE  `Files`.`id` = ? AND `ownerid`= ?;";
	//mysql_query($sql) or die("Query error");
	if($stmt = mysqli_prepare($cxt,$sql))
    {
        mysqli_stmt_bind_param($stmt,"sii",$alterto,$myfileid,$userid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$user);
		header("location:list_files.php");
	}
} 
else 
{
    header("location:/");
    exit(); 
}
mysqli_stmt_close($stmt);
mysqli_close($cxt);
?>