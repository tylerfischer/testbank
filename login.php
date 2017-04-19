<!DOCTYPE HTML> 

<?php
	# This tells browsers not to cache anything! REMOVE LATER 
	header("Cache-Control: no-cache, no-store, must-revalidate") ; 
	header("Pragma: no-cache") ; 
	header("Expires: 0"); 
	# Remove above portion later.! 

	session_start();
	include_once('function.php'); 


	# echo $_POST['username'] , "   ",  $_POST['password'] , "\n" ; 

	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ){
		header("Location: browse.php") ; 
	}
	
	if(isset($_POST['username']) && isset($_POST['password'])) {
		$flag = 0 ; 
		
		if(user_exist_check($_POST['username'], $_POST['password']) == 1 ){
			if (isset($_SESSION['error']) ){
		?><div id="err_div" style="visibility: visable; color: red; position:relative; left: 10% "  > 
		<h1>The username you entered does not match any of our records.</h1> 	
	</div> <?php
				unset($_SESSION['error']) ;
			}
		}
		if(user_exist_check($_POST['username'], $_POST['password']) == 2 ){
			# echo "User exists check passed ! " ; 
		  if ( user_pass_check($_POST['username'], $_POST['password']) == 0 ) {
			 # echo "We have a match!" ; 
			$_SESSION['username']=$_POST['username']; 
			$_SESSION['loggedin'] = true ; 
		     header("Location: browse.php") ;		
			}
			else {
			if (isset($_SESSION['error']) ){
		?><div id="err_divs" style="visibility: visable; color: red; position:relative; left: 30% "  > 
		<h1>The password you entered is incorrect.</h1> 	
	</div> <?php
				unset($_SESSION['error']) ;
				
			}
		}
	 } 
	} 
?>

<html> 
	<head>
		<title> Metube Login </title>
	<link rel="stylesheet" type="text/css" href="css/login.css" />
	</head>
	
<body> 

<!-- Welcome Header --> 
<div id=welcome>
  <header id=title>Welcome to MeTube</header>
  <title>MeTube Login</title>
  <p id="description">Please Login<br>Or Click Home to Go Back</p>
</div>	

<!-- Login Form --> 
  <form id="login_form" method="post" action="login.php" > 
        Username:
          <input name="username" type="text" required="required" class="text" placeholder="username" >
        <br/>
        <br/> 
	    Password: &nbsp;<input name="password" type="password" required="required" class="text" placeholder="password" >
       		<br/> 
	      	<input name="reset" id="reset" type="reset" title="reset" value="Reset">
	      	<input name="submit" type="submit" autofocus class="submit" value="Login">
  </form>
 
</body>
</html>
