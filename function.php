<?php
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

// Function: Finds all media and returns the result.
function load_media() {
	$query = "SELECT * from Media";
	$result = mysqli_query( $GLOBALS['con'],  $query );
	if (!$result){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	}
	return $result ;
}

// Function: Finds all media for a channel and returns the result.

function load_mychannel_media($channel) {
	$query = "SELECT * from Media WHERE `owner_username` = '$channel' ";
	$result = mysqli_query( $GLOBALS['con'],  $query );
	if (!$result){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	}
	return $result ;
}

// Function: Finds media that matches the input $tag variable
function find_media( $tag) {
	$query = "SELECT * from Media WHERE `Tags` LIKE '%{$tag}%' OR `Name` LIKE '%{$tag}%' ; "  ;
	$result = mysqli_query( $GLOBALS['con'],  $query );
	if (!$result){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	 }
	return $result ;
}

// Function: Finds media that matches the input $tag variable
function find_channel_media( $tag, $channel) {
	$query = "SELECT * from Media WHERE `owner_username` = '$channel' AND `Tags` LIKE '%{$tag}%' OR `Name` LIKE '%{$tag}%' ; "  ;
	$result = mysqli_query( $GLOBALS['con'],  $query );
	if (!$result){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	 }
	return $result ;
}

// Function: Finds all distinct categories.
function categorized_media( ) {
	$query = "SELECT * from Media  GROUP BY `Category` ; "  ;
	$result = mysqli_query( $GLOBALS['con'],  $query );
	if (!$result){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	 }
	$_SESSION['categories'] = true ;
	return $result ;
}

// Function: Finds all distinct categories for a particular channel.
function categorized_mychannel_media($channel ) {
	$query = "SELECT * from Media WHERE `owner_username` = '$channel'  GROUP BY `Category` ; "  ;
	$result = mysqli_query( $GLOBALS['con'],  $query );
	if (!$result){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	 }
	$_SESSION['categories'] = true ;
	return $result ;
}



// Function: Finds all records matching a certain category.
function cat_media($cat ) {
	$query = "SELECT * FROM Media WHERE `Category` LIKE  '%{$cat}%' ; "  ;
	$result = mysqli_query( $GLOBALS['con'],  $query );
	if (!$result){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	 }
	$_SESSION['category'] = true ;
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
function reset_page () {
	unset($_GET['keyword']);
	header("Location: browse.php") ;
}

// This function creates the channel page for your username if nonexistent and Returns the path.
function check_channel_exists () {

	//Create Directory if doesn't exist
	if(!file_exists('channels/'))
		mkdir('channels/', 0757);
	chmod('channels' , 0755) ;
	$myusername = $_SESSION['username'] ;
	echo $myusername ;
	$dirfile = 'channels/'. $myusername . '.php' ;
	echo $dirfile ;
	if(!file_exists($dirfile)){
		touch($dirfile) ;
		copy('channel_default.php' , $dirfile ) ;  // Copies channel template.
		chmod( $dirfile,0755);
	}
	return $dirfile ;
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
?>
