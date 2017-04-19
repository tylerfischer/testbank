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

<link rel="stylesheet" type="text/css" href="css/browse.css" />

<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script type="text/javascript">

function saveDownload(id)
{
	$.post("media_download_process.php",
	{
       id: id,
	},
	function(message)
    { }
 	);
}
</script>
</head>

<body>

<div id="welcome">
<h5>Welcome <?php echo $_SESSION['username'];?></h5>
</div>
<nav class="navigation">

					<button class="button" id="acct_btn">My Account</button>
					<a id="upload_file" href='media_upload.php'  style="color:#FF9900;">Upload File</a>

		<form name="logoutForm" id="logoutForm" action="browse.php" method="post">
			<input name="logoutBtn" id="log_out_btn" type="submit"  value="Log Out">
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
<?php
	# The following is the prompt for Accessing / Updating Account Information
	$acct_info = get_user_info($_SESSION['username']) ;

	if(isset($_POST['profile_name'])){
		$post_name = $_POST['profile_name'] ;
		update_profile($_POST['profile_name'], "name" ) ;
		unset($_POST['profile_name']) ;
	}
	if(isset($_POST['pw'])){
		$post_pass = $_POST['pw'] ;
		update_profile($_POST['pw'], "pass" ) ;
		unset($_POST['pw']) ;
	}
	if(isset($_POST['emails'])){
		$post_email = $_POST['emails'] ;
		update_profile($_POST['emails'], "email" ) ;
		unset($_POST['emails']) ;
}
?>
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
<?php # Loads all the media available.
	$result = load_media() ;
?>

    <h2 id="table_header">Uploaded Media</h2>
    <table id="top_row" width="50%" cellpadding="5" cellspacing="10">
	<tr valign="top">
	<td>Media ID</td><td>View File </td><td>Download file</td>
	</tr>

	</table>
	<table width="50%" cellpadding="5" cellspacing="10" border="2" bordercolor="#895803">
		<?php
			while ($result_row = mysqli_fetch_row($result)) //filename, username, type, mediaid, path
			{
				$mediaid = $result_row[0]; // was 3
				$filename = $result_row[1]; // was 0
				$filenpath = $result_row[2]; // was 4   // This seems correct!
		?>
    <tr valign="top">
					<td>
							<?php
								echo $mediaid ;
							?>
					</td>
		      <td>
		      	<script>
							function view_media(var id) {
								console.info("The id is " + id ) ;
								return ;
							}
						</script>
		        <a href="media.php?id=<?php echo $mediaid;?>"><?php echo $filename;?></a>
		      </td>
		      <td>
		          <a href="<?php echo $filenpath;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[2];?>);" download> Download</a>
					</td>
		</tr>
    <?php
			}
		?>
	</table>
   </div>


</body>
</html>