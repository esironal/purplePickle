<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "Welcome to the member's area, " . $_SESSION['myusername'] . "!";
} else {
    echo "Please log in first to see this page.";
}
?>
<!--
<html>
<head>
//<meta http-equiv="refresh" content="1;url=http://purplepickle.byethost31.com/upload.html" />
</head>
<body>
Login successful!
Redirecting in 3 seconds...
</body>
</html>
-->