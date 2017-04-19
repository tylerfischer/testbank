<html>
	<head>
		<title> Metube Registration </title>
	
	<link rel="stylesheet" type="text/css" href="css/register.css" />
	</head>
<body>

<?php
session_start();

include_once "function.php";

if(isset($_POST['submit'])) {
	if( $_POST['pass1'] != $_POST['pass2']) {
		?><div id="err_div" style="visibility: visable; color: red; position:relative; top:40px ; left: 35% "  > 
		<h2>Passwords entered do not match. Try again? </h2> 	
	</div> <?php
	}
	else {
		$check = user_exist_check($_POST['username'], $_POST['pass1']);	
		
		#check if the user does not exist. 
		if($check == 1){
			add_user($_POST['name'], $_POST['email'],  $_POST['username'], $_POST['pass1']) ;  # add_user ($name, $email, $username, $password ){
		$_SESSION['username']=$_POST['username'];
			header('Location: browse.php');
		}
		# User already exists. 
		else if($check == 2){
			?><div id="err_div" style="visibility: visable; color: red; position:relative; top:40px ; left: 5% "  > 
		<h2>Username or email already exist in system. Please use a different username or email.</h2> 	
	</div> <?php
		}
	}
}

?>
<h1>Create a New Account</h1>
<form id="regist" action="register.php" method="post">
	 Username: <input name="username" type="text" required="required" id="username"> <br>
	 Name: <input  name="name" type="text" required="required" id="name1"> <br>
	Email: <input name="email"  type="text" required="required" id="email1"> <br>
	Create Password: <input name="pass1"  type="password" required="required" id="pass1"> <br>
	Repeat password: <input name="pass2" type="password" required="required" autocomplete="off"> <br>
	
	<input class="submit"name="submit" type="submit" value="Submit">
</form>
</body>
</html>
