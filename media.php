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
</body>
</html>
