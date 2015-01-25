<?php
require "isloggedin.php";
if(!$isLoggedIn||time()>$_SESSION['time']+(60*60*24*3))
{
    //3day timeout
    session_destroy();
    header("location:/");
    exit(); 
}
$username=htmlentities($_SESSION['myusername']);
?>
<!DOCTYPE HTML>
    <html>
    <head>
        <style id="antiClickjack">body{display:none !important;}</style>
        <script type="text/javascript">
           if (self === top) {
               var antiClickjack = document.getElementById("antiClickjack");
               antiClickjack.parentNode.removeChild(antiClickjack);
           } else {
               top.location = self.location;
           }
        /*nd-color:#FFFFEC
        color purple;*/
        </script>
        <style>
            a:link {text-decoration: none;color:purple;}
            a:visited {text-decoration: none;color:purple;}
            p:hover, a:hover {text-decoration: underline;color:purple;}
            a:active {text-decoration: underline;color:purple;}
            .tbl {border: 2px solid purple;align:center;background-color:#51FF55;color:black;}
            body {background-color: #9900FF;font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;font-size: 15pt;text-align: center;color:white;}
            h1 {color:#FFF900;text-align:center;}
            div{text-align: right;font-size: 10pt;}
            .rninput {display:none;}
            .actionTbl {color:#EAA8FF;font-weight:bold;}
            table {margin-left: auto;margin-right: auto;}
            #dancingPP {position: absolute;left:90px;top:100px;z-index:2;}
            input[type=submit] {padding:5px 15px; background:#1500FF; color:white;border:0 none;cursor:pointer;-webkit-border-radius: 5px;border-radius: 5px; font-family: Arial, Helvetica, sans-serif;}
            input[type=file] {padding:5px 15px; background:#FFF900; color:black;border:0 none;cursor:pointer;-webkit-border-radius: 6px;border-radius: 6px; font-family: Arial, Helvetica, sans-serif;}
            #wait {font-size: 5pt;}
            #toplayer {z-index:2;position: absolute;}
        </style>
        <link rel="shortcut icon" href="http://www.favicongenerator.com/favicon2/eggplant-large-20141231-favicon.ico">
        <title>Files</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <div id = "toplayer"></div>
        <img src= "eggplant.gif" alt = "dancing pickle" id = "dancingPP">
        <div>Hello, <?php echo $username;?><img src = "eggplant-large.png" width="10" alt = "little pickle">!<form method = "post" action = "logout.php"><input name = "logo" type = "submit" value = "Logout" id = "logo"></form></div>
        <h1><img src = "eggplant-large.png" width="25" alt = "pickle">The Purple Pickle<img src = "eggplant-large.png" width="25" alt = "pickle"></h1>
        Upload more files to the pickle.<br>
        <form method="post" enctype="multipart/form-data" action = "upload.php">
            <table class="box">
            <tr> 
                <td>
                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                    <input name="userfile" type="file" id="userfile"> 
                </td>
                <td>
                    <input name="upload" type="submit" class="box" id="upload" value=" Upload ">
                </td>
            </tr>
        </table>
        </form>
        The pickle has found: 
        <br>
        <?php

$userid= $_SESSION['userid'];
$tbl_name = "Files";
$sql="SELECT name, type, id FROM $tbl_name WHERE ownerid = ?;"; // or die('Error, query failed"

$_SESSION['deleteToken'] = md5(uniqid(rand(), true));
$_SESSION['renameToken'] = md5(uniqid(rand(), true));
$_SESSION['downloadToken'] = md5(uniqid(rand(), true));
if($stmt = mysqli_prepare($cxt,$sql))
{
    mysqli_stmt_bind_param($stmt,"i", $userid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$name,$type,$fileID);
    print "<br><table class = \"tbl\"><tr class = \"tbl\"><td class = \"tbl\">Name</td><td class = \"tbl\">Type</tr>";

    while (mysqli_stmt_fetch($stmt)) 
    {
        print "<tr class = \"tbl\"><td class=\"tbl\"><img src = \"eggplant-large.png\" width=\"12\" alt = \"file pickle\"> ".$name."</td><td class = \"tbl\">".$type."</td><td class = \"tbl\"><p class = \"actionTbl\"><a href='download.php?id={$fileID}&token={$_SESSION['downloadToken']}'>Download</a></p></td><td class = \"tbl\" onclick = \"tt(".$fileID.")\"><p class = \"actionTbl\" id = \"renameSpan".$fileID."\"><a href = \"#\">Rename</a></p><form method = \"POST\" action = \"rename.php\" name = \"rn\" class = \"rninput\" id = \"rn".$fileID."\"><input type = \"hidden\" name = \"token\" id = \"token\" value = \"".$_SESSION['renameToken']."\"><input type = \"hidden\" name = \"fileid\" id = \"fileid\" value = \"".$fileID."\"><input type = \"text\" name = \"newname\" id = \"newname\" value = \"Put the new name here.\"><input name=\"submitrename\" type=\"submit\" id=\"submitrename\" value=\"OK!\"></form></td><td class = \"tbl\"><p class = \"actionTbl\"><a href='delete.php?id={$fileID}&token={$_SESSION['deleteToken']}'>Delete</a></p></td></tr>";
    }
}
print "</table>";

mysqli_stmt_close($stmt);
mysqli_close($cxt);
/*
SQL Injection: bind_param
XSS: htmlentities
CSRF: token from md5
W3C validated! :D
Session management: dull session name, PHP generated id was safe enough, 3 day timeout
HTTPonly: turned on for cookies, cookie has random value, 
Clickjacking: prevented iframes
jQuery: later
*/
?>

<span id = "wait" onclick = "this.firstChild.play();eegg();"><audio src = "bossfight.mp3"></audio>That's an eggplant!</span>

<script>
            function tt(renameID) {
                var formTitle = "rn"+renameID;
               document.getElementById(formTitle).style.display = "inline";
               var title = "renameSpan"+renameID;
               document.getElementById(title).style.display = "none";
            }
            function eegg()
            {          
                document.getElementById("dancingPP").width="650";
                //var startx=0;
                //var starty=0;
                var myVar = setInterval(function(){
                    annoy();
                }, 1000);
            }

            //function annoy(sx,sy)
            function annoy()
            {
                var x = document.createElement("IMG");                        // Create a <p> node
                x.src = "eggplant.gif";
                x.alt = "dancing eggplant";
                document.getElementById("toplayer").appendChild(x);                               // Append <p> to <body>
                x.position="absolute";
            }
</script>
    </body>
</html>