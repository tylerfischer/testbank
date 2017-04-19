<!doctype html>
<?php 
	session_start( ) ; 
	if ( !isset($_SESSION['loggedin'])  || $_SESSION['loggedin'] == false){
		hheader("Location: index.php") ; 	
	}
?>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
	<h1> Succeess! </h1>
</body>
</html>