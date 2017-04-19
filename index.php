<html>
<head>
<link href="css/main.css" rel="stylesheet" type="text/css">
<style type="text/css">
#login_pane #login-pane #login form p strong {
	font-family: Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif;
}
#login_pane #welcome #description {
	font-family: Constantia, Lucida Bright, DejaVu Serif, Georgia, serif;
}
</style>
<title>MeTube</title>	

</head>
<body id="login_pane">
<div id=welcome> 
<header id=title>Welcome to MeTube</header>

<p id="description">MeTube is a multimedia site, where you can watch and share content</p>
</div>

<div id=login-pane>
  <div id="login-bg"></div>
  <div id=login>  
	<form action="login.php" method="post">
	  <p id=instructions><strong>If you have a MeTube Account 'Log in' <br>  Otherwise 'Register' Below. </strong></p>
	  <p>
	    <input id=button1 type="submit" class="button"  value = "Log in" >
    </p>
	</form>
	
	
	<form action="register.php" method="post">
 	 <input type="submit" class="button"  value = "Register" >
	</form>
	</div>
</div>

<div id=footer> <!-- Footer content -->
	<p>Landon Bagley | Anthony Ferraro | Tyler Fischer<br>Clemson University</p>
</div>
</body>
</html>
