<?php
require "isloggedin.php";
if($isLoggedIn) 
{
	if(!empty($_POST['upload']) && !is_null($_POST['upload']) && $_FILES['userfile']['size'] > 0)
	{
		$fileName = $_FILES['userfile']['name'];
		$tmpName  = $_FILES['userfile']['tmp_name'];
		$fileSize = $_FILES['userfile']['size'];
		$fileType = $_FILES['userfile']['type'];

		//echo "ok";
		$data = file_get_contents($_FILES['userfile']['tmp_name']);
		$data = mysqli_real_escape_string($cxt,$data);
		//echo "k";
		$userid = $_SESSION['userid'];
		//$tbl_name="Files";
		//$query = "INSERT INTO `$db_name`.`$tbl_name` (`ownerid`, `id`, `name`, `type`, `content`, `size`) VALUES ($userid, '', '$fileName', '$fileType','$data','$fileSize');";
		$sql = "INSERT INTO `b31_15690090_db`.`Files` (`ownerid`,`name`, `type`, `content`, `size`) VALUES (?,?,'$fileType','$data','$fileSize');";
		//echo $sql;
		if($stmt = mysqli_prepare($cxt,$sql))
		    {
		        mysqli_stmt_bind_param($stmt,"is",$userid,$fileName);
		        mysqli_stmt_execute($stmt);
		        mysqli_stmt_bind_result($stmt,$user);
				header("location:list_files.php");
			}
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