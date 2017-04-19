<!DOCTYPE HTML">
<?php
	session_start();
	include_once "function.php";

	# If you are not logged in, Get out of here! # This needs to be changed to restrict some functionality.
	if (!isset($_SESSION['loggedin'])) {
		header("Location: login.php") ;
	}
	unset($_GET['id']) ;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media Browse</title>

<link rel="stylesheet" type="text/css" href="css/messages.css" />

<script type="text/javascript" src="js/jquery-latest.pack.js"></script>

</head>

<body>

<div id="welcome">
<h5>Here are your messages, <?php echo $_SESSION['username'];?></h5>
</div>
<nav class="navigation">
					<button class="button" id="upload_file" onclick="upload_file()" >Upload File</button>
					<button class="button" id="acct_btn">Edit Your (<?php echo $_SESSION['username']?>) Account</button>

		<form name="channelForm" id="channelForm" action="browse.php" method="post">
			<input name="channelBtn" id="channel_btn" type="submit"  value="My Channel">
		</form>

		<form name="logoutForm" id="logoutForm" action="browse.php" method="post">
			<input name="logoutBtn" id="log_out_btn" type="submit"  value="Log Out <?php echo $_SESSION['username'] ?> ">
		</form>

		<form name="inboxForm" id="inboxForm" action="messages.php" method="post">
			<input name="inbox_btn" id="inbox_btn" type="submit" value="inbox">
		</form>

</nav>
<!-- The following PHP code is used for logging out the user and return to index.php -->
		<?php
			if(isset($_POST['logoutBtn'])){
				$_SESSION['username'] = NULL ;
				$_SESSION['loggedin'] = NULL ;
				header("Location: index.php");
			}
		?>



<!-- The following PHP code is used to Update Account Profile -->

<div id="acct_prompt" class="prompt">

	<div id="acct_prompt_content">
		<span id="acct_prompt_close" class="close">&times;</span>
		<h4>Account Settings</h4>
		<!-- Account (Update) Settings Form -->
  		<form id="acct_form" method="post" action="browse.php" >

		Name:<input id="profile_name" name="profile_name" type="text" class="text" value="<?php echo $acct_info[1]?>" >
        <br/>
        <br/>
		Password: <input id="pw" name="pw" type="password" class="text" value="<?php echo $acct_info[3]?>">
       	<br/>
       	 <br/>
		Email: <input id="emails" name="emails" type="text" class="text" value="<?php echo $acct_info[5]?>" >
        <br/> <br/>
	      	<input name="submit" type="submit" autofocus class="submit" value="Save">
  </form>

	</div>
</div>
<script>
	var acct_prompt1 = document.getElementById('acct_prompt') ;
	var acct_prompt_button = document.getElementById('acct_btn') ;
	var acct_prompt_close1 = document.getElementById('acct_prompt_close');

	acct_prompt_button.onclick = function(){
		console.info("Clicked Acct Button") ;
		acct_prompt1.style.display = "block" ;
	}
	acct_prompt_close1.onclick = function() {
		console.info("Clicked Close Button") ;
		acct_prompt1.style.display = "none" ;
	}
	window.onclick = function(event){
		if ( event.target == acct_prompt1 )
			acct_prompt1.style.display = "none" ;
	}

</script>
<!-- _____________ END of Prompt Section ______________________________________ -->


<div id='upload_result'>
<?php
	if(isset($_REQUEST['result']) && $_REQUEST['result']!=0)
	{
		echo upload_error($_REQUEST['result']);
	}
?>
</div>
<br/><br/>
<?php # Loads all the messages.
 $result = load_messages($_SESSION['username']) ;//change to user id
?>

    <table id="top_row" width="50%" cellpadding="5" cellspacing="10">
 <tr valign="top">
 <td>Sender</td><td>Message</td><td>Timestamp</td>
 </tr>

 </table>
 <table width="50%" cellpadding="5" cellspacing="10" border="2" bordercolor="#895803">
   <?php
     while ($result_row = mysqli_fetch_row($result)) //filename, _SESSION['username'], type, mediaid, path
     {
       $sender = $result_row[0]; // was 3
       $message = $result_row[1]; // was 0
       $time = $result_row[2]; // was 4   // This seems correct!
   ?>
    <tr valign="top">
         <td>
             <?php
               echo $sender;
             ?>
         </td>
         <td>
           <?php echo $message;?>
         </td>
         <td>
           <?php echo $time;?>
         </td>
   </tr>
    <?php
     }
   ?>
 </table>
   </div>

</body>
</html>
