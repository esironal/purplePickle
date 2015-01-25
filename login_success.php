<?php
//session_start();
//if(!session_is_registered(myusername)){
if(!isset($_SESSION['myusername']) ){
    header("location:index.html");
    exit();
}
?>
<html>
<head>
<!--<meta http-equiv="refresh" content="1;url=http://purplepickle.byethost31.com/upload.html" />
-->
</head>
<body>
Login successful!
Redirecting in 3 seconds...
</body>
</html>