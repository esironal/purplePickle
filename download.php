<?php
require "isloggedin.php";
/*if ($isLoggedIn) {
$id = intval($_GET['id']);
        // Connect to the database
 
        // Fetch the file information
        $query = "
            SELECT `type`, `name`, `size`, `content`
            FROM `Files`
            WHERE `id` = {$id} AND `ownerid`= ".$_SESSION['userid'].";";
        $result = mysql_query($query);

        if(mysql_num_rows($result)==1)
        {

                        // Get the row
        $row = mysql_fetch_assoc($result);
 
                // Print headers
        header("Content-Type: ". $row['type']);
        //header("Content-Length: ". $row['size']);
        header("Content-Disposition: attachment; filename=". $row['name']);
 
        // Print data
        echo $row['content'];
        }
} */
$token = $_GET['token'];
if ($isLoggedIn&&$_SESSION['downloadToken']==$token) 
{
    $id = intval($_GET['id']);
    $userid = $_SESSION['userid'];
    //$sql = "DELETE FROM `b31_15690090_db`.`Files` WHERE `Files`.`id` = ".$id." AND `ownerid`= ".$_SESSION['userid'].";";

    $tbl_name="Files";
    $sql="SELECT type,size,name,content FROM $tbl_name WHERE id= ? and ownerid= ?;";

    if($stmt = mysqli_prepare($cxt,$sql))
    {
        mysqli_stmt_bind_param($stmt,"ii", $id,$userid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$type,$size,$name,$content);
        //$result=mysql_query($sql);
        //echo "yus";
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result)==1)
        {
            $row = mysqli_fetch_assoc($result);
            // Print headers/*
            header("Content-Type: ". $row['type']);
            header("Content-Length: ". $row['size']);
            header("Content-Disposition: attachment; filename=". $row['name']);
            /*header("Content-Type: $type");
            header("Content-Length: $size");
            header("Content-Disposition: attachment; filename=$name");*/
            // Print data
            echo $row['content'];
        }
    }
} 
else {
    header("location:/");
    exit(); 
}
mysqli_stmt_close($stmt);
mysqli_close($cxt);
?>