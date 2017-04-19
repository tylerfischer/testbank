////////////MEDIA.css
/* You can implement your own css code*/
body {
	margin: 0px ;
	background-image: url(../images/bg/beige-background.jpg);
	background-size: cover;
}


#view_messages{
	width: auto;
	align-items: right;
	padding: 15px 20px;
	border-radius: 4px;
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
	margin: 10px;
	font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, "sans-serif";
	color: black;
	font-size: 24px;
	cursor: pointer;
	text-shadow: 1px 2px white;
	background: rgba(255,255,255,0.5) ;
}


.navigation{
	list-style-type: none;
	margin: 0 ;
	padding-bottom: 2px ;
	padding-top: 2px ;
    align-content: center;
	background-color: burlywood ;


}
ul {
	position: relative;
	left: 25% ;
}
li{
	display: inline ;
}

#msg_prompt{
	position: fixed ;
	z-index:  1 ;
	display:  none ;
	left: 0 ;
	top: 0 ;
	width: 100% ;
	height: 100% ;
	overflow: auto ;
	background-color: rgb(137, 88, 3, 0.5) ;
	padding-top:100px ;
}

#msg_prompt_content{
	background-color: antiquewhite ;
	margin: 10% auto ;
	padding: 25px ;
	border: 1px groove #895803 ;
	width: 40% ;
	font-size: 24px ;
}
#msg_btn{
	position: relative ;
	left: 30%  ;
}
.close{
	color:brown ;
	float:right ;
	font-weight:  bolder;
	font-size: 28px  ;
}

h2{
	text-align: center ;
	font-size: 25px  ;
	color: saddlebrown ;
	text-shadow: 2px 2px  white ;

}
h4 {
	font-size: 30px ;
	position: relative ;
	left: 150px ;
	color: brown ;
}

h5 {
	margin: 0px ;
	padding: 10px;
	color: saddlebrown;
	background-color: burlywood;

}
.submit {
	width: auto;
	height: auto;
	align-items: right;
	left: 40px  ;
	padding: 10px;
	border-radius: 4px;
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
	margin: 10px;
	margin-left: 380px ;
	font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, "sans-serif";
	color: white;
	font-size: 24px;
	cursor: pointer;
	text-shadow: 2px 2px black;
	background: rgba(69,69,69,0.8)
}
.submit:hover {
	box-shadow: 0 12px 16px 0 rbga(0, 0, 0, 0, .24), 0 17px 50px 0 rgba(0,0,0,0.19);
	text-align: right;
}

#log_out_btn {
	position: relative ;
	left: 30% ;
	width: auto;
	align-items: left;
	padding: 15px 20px;
	border-radius: 4px;
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
	margin: 10px;
	font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, "sans-serif";
	color: black;
	font-size: 24px;
	cursor: pointer;
	text-shadow: 1px 2px white;
	background: rgba(255,255,255,0.5) ;
}
#log_out_btn:hover {
	box-shadow: 0 12px 16px 0 rbga(0, 0, 0, 0, .24), 0 17px 50px 0 rgba(0,0,0,0.19);
}

#logoutForm{
	display: inline;
	width: auto ;
}

td {
	color: saddlebrown ;
	font-size: 20px ;
	text-align: center ;
}

table {
	position: relative ;
	left: 25% ;
}





//////////////media.php
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
<link rel="stylesheet" type="text/css" href="css/media.css" />
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body>

<?php

if(isset($_GET['id'])) {
	# echo "This is GET id :" . $_GET['id'] ;
	$id = $_GET['id'] ;
	$query = "SELECT * FROM Media WHERE Media_ID = $id  ";
	$result = mysqli_query($GLOBALS['con'],  $query );
	$result_row = mysqli_fetch_row($result);

	//updateMediaTime($_GET['id']); //  or $id

	$filename=$result_row[1];   ////0, 4, 2
	$filepath=$result_row[2];
	$type=$result_row[3];
	if(substr($type,0,5)=="image") //view image
	{
		echo "Viewing Picture:";
		echo $result_row[2]; // was 4

		echo "<img src='".$filepath."'/>";
	}
	else //view movie
	{
?>

	<!-- <p>Viewing Video:
	<?php echo $result_row[3].$result_row[1];?></p> -->
	<p>Viewing Video:<?php echo $result_row[2];?></p> <!-- was 4 -->

    <object id="MediaPlayer" width=320 height=286 classid="CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95" standby="Loading Windows Media Player components…" type="application/x-oleobject" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112">

<param name="filename" value="<?php echo $result_row[2];?>"> <!-- was 4 -->
	<!-- echo $result_row[2].$result_row[1];  -->


<param name="Showcontrols" value="True">
<param name="autoStart" value="True">

<embed type="application/x-mplayer2" src="<?php echo $filepath;  ?>" name="MediaPlayer" width=320 height=240></embed>

</object>

<?php
	}
}
else
{
?>
<meta http-equiv="refresh" content="0; url=browse.php">
<?php
}
?>
<!-- ____the following code is used to post comments on a video___ -->
<form action="" method ="post">
	Comment : <textarea name="comment" rows="6" cols="50"></textarea>
	<input type="submit" name="submit">
</form>
<?php
if(isset($_POST["submit"]))
{
$comment = $_POST["comment"];

$username = $_SESSION['username'];

$insert1 = "INSERT INTO `Comment`(`Comment_ID`,`Username` , `Comment`, `Media_ID`, `TimeSt`) VALUES (DEFAULT, '$username' , '$comment', '$id', DEFAULT);";
$queryresult = mysqli_query($GLOBALS['con'] , $insert1)
		or die("Insert into Media error in media_upload_process.php ". $insert1 . "  ". mysql_error());
$result="0";
echo '<center> Comment Successfully Submitted </center>';

}

 ?>

 <?php # Loads all the media available.
 	$result = load_comments($id) ;
 ?>

     <h4>Comments</h4>
     <table id="top_row" width="50%" cellpadding="5" cellspacing="10">
 	<tr valign="top">
 	<td>User</td><td>Comment</td><td>timestamp</td>
 	</tr>

 	</table>
 	<table width="50%" cellpadding="5" cellspacing="10" border="2" bordercolor="#895803">
 		<?php
 			while ($result_row = mysqli_fetch_row($result)) //filename, username, type, mediaid, path
 			{
 				$username = $result_row[0]; // was 3
 				$comment = $result_row[1]; // was 0
 				$time = $result_row[2]; // was 4   // This seems correct!
 		?>
     <tr valign="top">
 					<td>
						<button class="button" id="msg_btn"><?php echo $username; ?></button>
 					</td>
 		      <td>
 		        <?php echo $comment;?>
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




/////////////BROSWE.css/////




/* You can implement your own css code*/
body {
	margin: 0px ;
	background-image: url(../images/bg/beige-background.jpg);
	background-size: cover;
}

#welcome{
	padding-top: 0px;
	color: black;
	text-align: center;
	align-content: center;
	font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, "sans-serif";
	text-shadow: 1px 1px black;
	font-size: 75px ;
}
.button  {
	width: auto;
	align-items: left;
	padding: 15px 20px;
	border-radius: 4px;
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
	margin: 10px;
	font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, "sans-serif";
	color: black;
	font-size: 24px;
	cursor: pointer;
	text-shadow: 1px 2px white;
	background: rgba(255,255,255,0.5) ;
}
.button:hover {
	box-shadow: 0 12px 16px 0 rbga(0, 0, 0, 0, .24), 0 17px 50px 0 rgba(0,0,0,0.19);
}

#upload_file{
	width: auto;
	align-items: left;
	padding: 15px 20px;
	border-radius: 4px;
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
	margin: 10px;
	font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, "sans-serif";
	color: black;
	font-size: 24px;
	cursor: pointer;
	text-shadow: 1px 2px white;
	background: rgba(255,255,255,0.5) ;
}
#upload_file:visited{
	color: black ;
}

#upload_file:hover{
		box-shadow: 0 12px 16px 0 rbga(0, 0, 0, 0, .24), 0 17px 50px 0 rgba(0,0,0,0.19);

}
#view_messages{
	width: auto;
	align-items: right;
	padding: 15px 20px;
	border-radius: 4px;
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
	margin: 10px;
	font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, "sans-serif";
	color: black;
	font-size: 24px;
	cursor: pointer;
	text-shadow: 1px 2px white;
	background: rgba(255,255,255,0.5) ;
}


.navigation{
	list-style-type: none;
	margin: 0 ;
	padding-bottom: 2px ;
	padding-top: 2px ;
    align-content: center;
	background-color: burlywood ;


}
ul {
	position: relative;
	left: 25% ;
}
li{
	display: inline ;
}

#acct_prompt{
	position: fixed ;
	z-index:  1 ;
	display:  none ;
	left: 0 ;
	top: 0 ;
	width: 100% ;
	height: 100% ;
	overflow: auto ;
	background-color: rgb(137, 88, 3, 0.5) ;
	padding-top:100px ;
}

#acct_prompt_content{
	background-color: antiquewhite ;
	margin: 10% auto ;
	padding: 25px ;
	border: 1px groove #895803 ;
	width: 40% ;
	font-size: 24px ;
}
#acct_btn{
	position: relative ;
	left: 30%  ;
}

.close{
	color:brown ;
	float:right ;
	font-weight:  bolder;
	font-size: 28px  ;
}


#profile_name
{
	margin-left: 75px ;
}
#pw {
	margin-left: 35px ;
}
#emails {
	margin-left: 69px ;

}
h2{
	text-align: center ;
	font-size: 25px  ;
	color: saddlebrown ;
	text-shadow: 2px 2px  white ;

}
h4 {
	font-size: 30px ;
	position: relative ;
	left: 150px ;
	color: brown ;
}

h5 {
	margin: 0px ;
	padding: 10px;
	color: saddlebrown;
	background-color: burlywood;

}
.submit {
	width: auto;
	height: auto;
	align-items: right;
	left: 40px  ;
	padding: 10px;
	border-radius: 4px;
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
	margin: 10px;
	margin-left: 380px ;
	font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, "sans-serif";
	color: white;
	font-size: 24px;
	cursor: pointer;
	text-shadow: 2px 2px black;
	background: rgba(69,69,69,0.8)
}
.submit:hover {
	box-shadow: 0 12px 16px 0 rbga(0, 0, 0, 0, .24), 0 17px 50px 0 rgba(0,0,0,0.19);
	text-align: right;
}

#log_out_btn {
	position: relative ;
	left: 30% ;
	width: auto;
	align-items: left;
	padding: 15px 20px;
	border-radius: 4px;
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
	margin: 10px;
	font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, "sans-serif";
	color: black;
	font-size: 24px;
	cursor: pointer;
	text-shadow: 1px 2px white;
	background: rgba(255,255,255,0.5) ;
}
#log_out_btn:hover {
	box-shadow: 0 12px 16px 0 rbga(0, 0, 0, 0, .24), 0 17px 50px 0 rgba(0,0,0,0.19);
}

#logoutForm{
	display: inline;
	width: auto ;
}

td {
	color: saddlebrown ;
	font-size: 20px ;
	text-align: center ;
}

table {
	position: relative ;
	left: 25% ;
}



//////////////FUNCTION.PHP<?php
include "mysqlClass.inc.php";
include("config.php") ;

# Could not get the variables to read from the config.php leaving it here for now.
$database = 'MeTube_5tfc';
$dbuser = 'MeTube_t3tt';
$dbpass = 'metubeGroup1';
$dbhost = 'mysql1.cs.clemson.edu';
$con = mysqli_connect( $GLOBALS['dbhost'] ,$GLOBALS['dbuser'], $GLOBALS['dbpass'] , $GLOBALS['database'] ) ;
	// Check connection
	if (mysqli_connect_errno())
  	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	else {
		# echo "Successfully connected to Database!" ;
	}

function user_exist_check ($username, $password){
	# Apparently table names are case sensitive.
	$query = "select * from Accounts where user_name ='$username'";

	# echo "In user_exist_check username is $username" ;

	$result = mysqli_query($GLOBALS['con'],   $query  );
	if (!$result){
		die ("user_exist_check() failed. Could not query the database: <br />". mysql_error());
	}
	else {
		$row = mysqli_fetch_assoc( $result);
		if($row == 0){
			$_SESSION['error'] = "No matching account." ;
			# No values were found that matched.
			return 1 ;
		}
		else{
			return 2;
		}
	}

}

function get_user_info ($username ) {
	$query = "SELECT * FROM `Accounts` WHERE `User_Name` = '$username' " ;
	$result = mysqli_query($GLOBALS['con'], $query) ;
	$acct_info = mysqli_fetch_row( $result) ;
	if($acct_info){
		return $acct_info ;
	}
	else
		die ("Error in get_user_info() related to query") ;
}

# Right now -- Only create regular users. ( No Admins )
# The System does verify that the Email and Username are unique.
function add_user ($name, $email, $username, $password ){

		# The Following SQL command works in MySQL .
	 # INSERT INTO  `Accounts` VALUES (DEFAULT,  "",  "",  "", DEFAULT, 0,  "",  "", 0, 0) ;

	 $query = "INSERT INTO  `Accounts` VALUES (DEFAULT,  \"$name\" ,  '$username',  '$password' , 0,  '$email',
		 'User',0,0);" ;

		 echo "insert query:" . $query;
		 $insert = mysqli_query($GLOBALS['con'], $query );
		if($insert)
			return 1;
		else
			die ("Could not insert into the database: <br />". mysql_error());
}
function update_profile ($new_value, $attribute){

		$logged_in_user = $_SESSION['username'] ;
		# Update Name
		if(strcmp($attribute, "name") == 0 ){
			$query = "UPDATE `Accounts` SET `Name` = \"$new_value\" WHERE `User_Name` = '$logged_in_user' ";
		 	$update = mysqli_query($GLOBALS['con'], $query );
		if($update)
			return 1;
		else
			die ("Could not update the database profile: <br />". mysql_error());

		}

		# Update Password
		if(strcmp($attribute, "pass") == 0){
			$query = "UPDATE `Accounts` SET `Password` = \"$new_value\" WHERE `User_Name` = '$logged_in_user' ";
		 	$update = mysqli_query($GLOBALS['con'], $query );
		if($update)
			return 1;
		else
			die ("Could not update the database profile: <br />". mysql_error());
		}

		#Update Email
		if(strcmp($attribute, "email") == 0 ){
			$query = "UPDATE `Accounts` SET `Email` = \"$new_value\" WHERE `User_Name` = '$logged_in_user' ";
		 	$update = mysqli_query($GLOBALS['con'], $query );
		if($update)
			return 1;
		else
			die ("Could not update the database profile: <br />". mysql_error());
		}
}

function user_pass_check($username, $password)
{

	$query = "select * from Accounts where user_name='$username'";
	$result = mysqli_query($GLOBALS['con'],  $query );

	if (!$result)
	{
	   die ("user_pass_check() failed. Could not query the database: <br />". mysql_error());
	}
	else{
		$row = mysqli_fetch_row($result);
		# echo "Row 1 is : " . $row[3] . "password is " . $password ;
		if(strcmp($row[3],$password)){
			$_SESSION['error'] = "Wrong password." ;
			return 2; //wrong password
		}
		else
			return 0; //Checked.
	}
}

function updateMediaTime($mediaid)
{
	$query = "	update  media set lastaccesstime=NOW()
   						WHERE '$mediaid' = media_id
					";
					 // Run the query created above on the database through the connection
    $result = mysqli_query( $query );
	if (!$result)
	{
	   die ("updateMediaTime() failed. Could not query the database: <br />". mysql_error());
	}
}

function upload_error($result)
{
	//view erorr description in http://us2.php.net/manual/en/features.file-upload.errors.php
	switch ($result){
	case 1:
		return "UPLOAD_ERR_INI_SIZE";
	case 2:
		return "UPLOAD_ERR_FORM_SIZE";
	case 3:
		return "UPLOAD_ERR_PARTIAL";
	case 4:
		return "UPLOAD_ERR_NO_FILE";
	case 5:
		return "File has already been uploaded";
	case 6:
		return  "Failed to move file from temporary directory";
	case 7:
		return  "Upload file failed";
	}
}

function load_media() {
	$query = "SELECT * from Media";
	$result = mysqli_query( $GLOBALS['con'],  $query );
	if (!$result){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	}
	return $result ;
}

function load_comments($id) {
	$query = "SELECT Username, Comment, TimeSt from Comment where Media_ID = $id";
	$result = mysqli_query( $GLOBALS['con'],  $query );
	if (!$result){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	}
	return $result ;
}


function load_messages($username) {
	$query = "SELECT Sender, Message, TimeSt from Messages where Receiver = '$username'";
	$result = mysqli_query( $GLOBALS['con'],  $query );
	if (!$result){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	}
	return $result ;
}

function view_media() {
	echo "In view media! " ;
	if(isset($_GET['id'])) {
	# echo "This is GET id :" . $_GET['id'] ;
	$id = $_GET['id'] ;
	$query = "SELECT * FROM Media WHERE Media_ID = $id  ";
	$result = mysqli_query($GLOBALS['con'],  $query );
	$result_row = mysqli_fetch_row($result);

	//updateMediaTime($_GET['id']); //  or $id

	$filename=$result_row[1];   ////0, 4, 2
	$filepath=$result_row[2];
	$type=$result_row[3];
	if(substr($type,0,5)=="image") //view image
	{
		echo "Viewing Picture:";
		echo $result_row[2]; // was 4

		echo "<img src='".$filepath."'/>";
	}
	}
}
?>


/////////messages.php.///////
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

</head>

<body>

<div id="welcome">
<h5>Here are your messages, <?php echo $_SESSION['username'];?></h5>
</div>
<nav class="navigation">

					<button class="button" id="acct_btn">My Account</button>
					<a id="upload_file" href='media_upload.php'  style="color:#FF9900;">Upload File</a>
					<a id="view_messages" href='browse.php'  style="color:#FF9900;">Browse</a>

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




/////browse.php

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
					<a id="view_messages" href='messages.php'  style="color:#FF9900;">Inbox</a>

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
