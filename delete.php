<?php
require "isloggedin.php";
$token = $_GET['token'];

if ($isLoggedIn&&$_SESSION['deleteToken']==$token) 
{
	$id = intval($_GET['id']);
	$userid = $_SESSION['userid'];
	//$sql = "DELETE FROM `b31_15690090_db`.`Files` WHERE `Files`.`id` = ".$id." AND `ownerid`= ".$_SESSION['userid'].";";

	$tbl_name="Files";
	$sql="SELECT * FROM $tbl_name WHERE id= ? and ownerid= ?;";

	if($stmt = mysqli_prepare($cxt,$sql))
	{
		mysqli_stmt_bind_param($stmt,"ii", $id,$userid);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$user);
		//$result=mysql_query($sql);

		$count = 0;
		// fetch values 
		while (mysqli_stmt_fetch($stmt)) 
		{
			$count++;
		}

		if($count==1)
		{
			$sql2 = "DELETE FROM `b31_15690090_db`.`Files` WHERE `Files`.`id` = ? AND `ownerid`= ?;";
			if($stmt2 = mysqli_prepare($cxt,$sql2))
			{
				mysqli_stmt_bind_param($stmt2,"ii", $id, $userid);
				mysqli_stmt_execute($stmt2);
				mysqli_stmt_bind_result($stmt2);
				header("location:list_files.php");
			}
		}
	}
} 
else 
{
    header("location:/");
    exit(); 
}
mysqli_stmt_close($stmt);
mysqli_stmt_close($stmt2);
mysqli_close($cxt);
?>