<?php
require "isloggedin.php";
if($isLoggedIn)
{
	header("location:list_files.php");
	exit();
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<link rel="shortcut icon" href="http://www.favicongenerator.com/favicon2/eggplant-large-20141231-favicon.ico" >
	<title>Purple Pickle</title>
	<style id="antiClickjack">body{display:none !important;}</style>
	<script type="text/javascript">
	   if (self === top) {
	       var antiClickjack = document.getElementById("antiClickjack");
	       antiClickjack.parentNode.removeChild(antiClickjack);
	   } else {
	       top.location = self.location;
	   }
	</script>
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<meta charset="UTF-8">
	<style>
	body {background-color: #9900FF;font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;font-size: 15pt;color:white;}
	h1 {color:#FFF900;text-align:center;}
	#registerDIV {visibility: hidden;}
	input[type=submit] {padding:5px 15px; background:#1500FF; color:white;border:0 none;cursor:pointer;-webkit-border-radius: 5px;border-radius: 5px; font-family: Arial, Helvetica, sans-serif;}
	</style>
</head>
	<body>
	<div class = "main">
		<h1><img src = "eggplant-large.png" width="25" alt = "pickle">The Purple Pickle<img src = "eggplant-large.png" width="25" alt = "pickle"></h1>
		The Purple Pickle stores files that you can upload and download once you have an account. Please login to start.
		<form name = "login" method = "post" action = "checklogin.php">
			Username: <input type = "text" name = "username1" id="username1">
			<br>
			Password: <input type = "password" name = "pw1" id = "pw1">
			<br>
			<input type = "submit" name = "submission" value = "Login!">
		</form>
		<br>
		<!--If you don't have an account, please register by clicking <strong onclick = "regis();">here</strong>.-->
		If you don't have an account, please register by clicking <strong id = "here">here</strong>.
		<div id = "registerDIV">
		<form name = "register" method = "post" action = "addmember.php">
			Username: <input type = "text" name = "username2" id="username2">
			<br>
			Password: <input type = "password" name = "pw2" id = "pw2">
			<br>
			<input type = "submit" name = "submission" value = "Register!">
		</form>
		</div>
	</div>
	<script>
		$( "#here" ).click(function() {
		  $( "#registerDIV" ).css('visibility','visible');
		});
	</script>
	</body>
</html>