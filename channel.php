<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	include_once "function.php";

	# If you are not logged in, Get out of here!
	if (!isset($_SESSION['loggedin'])) {
		header("Location: login.php") ;
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Media</title>
    <script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
      <link rel="stylesheet" type="text/css" href="css/channel.css" />
    <script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

  <body>



    <!--Message send prompt-->
    <div id="msg_prompt" class="prompt">

    	<div id="msg_prompt_content">
    		<span id="msg_prompt_close" class="close">&times;</span>
    		<h4>Send a message to</h4>
    		<!-- Account (Update) Settings Form -->
      		<form id="msg_form" method="post" action="message_process.php" >
    ///////WHERE I STOPPED CHANGING
    		Message: <input id="pw" name="pw" type="password" class="text" value="<?php echo $acct_info[3]?>">
           	<br/>
           	<br/>
    	      	<input name="submit" type="submit" autofocus class="submit" value="Send">
      </form>

    	</div>
    </div>
    <script>
    	var msg_prompt1 = document.getElementById('msg_prompt') ;
    	var msg_prompt_button = document.getElementById('msg_btn') ;
    	var msg_prompt_close1 = document.getElementById('msg_prompt_close');

    	msg_prompt_button.onclick = function(){
    		console.info("Clicked msg Button") ;
    		msg_prompt1.style.display = "block" ;
    	}
    	msg_prompt_close1.onclick = function() {
    		console.info("Clicked Close Button") ;
    		msg_prompt1.style.display = "none" ;
    	}
    	window.onclick = function(event){
    		if ( event.target == acct_prompt1 )
    			msg_prompt1.style.display = "none" ;
    	}

    </script>

  </body>
</html>
