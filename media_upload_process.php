<?php
session_start();
include_once "function.php";

# If you are not logged in, Get out of here! 
	if (!isset($_SESSION['loggedin'])) {
		header("Location: login.php") ; 
	}

/******************************************************
*
* upload document from user
*
*******************************************************/

$username=$_SESSION['username'];


//Create Directory if doesn't exist
if(!file_exists('uploads/'))
	mkdir('uploads/', 0757);
$dirfile = 'uploads/'.$username.'/';
if(!file_exists($dirfile))
	mkdir($dirfile,0755);
	chmod( $dirfile,0755);
	if($_FILES["file"]["error"] > 0 )
	{ 	$result=$_FILES["file"]["error"];} //error from 1-4
	else
	{
		$upfile = $dirfile.urlencode($_FILES["file"]["name"]);
	  
	  if(file_exists($upfile))
	  {
	  	$result="5"; //The file has been uploaded.
	  }
	  else{
			if(is_uploaded_file($_FILES["file"]["tmp_name"]))
			{
				if(!move_uploaded_file($_FILES["file"]["tmp_name"],$upfile))
				{
					$result="6"; //Failed to move file from temporary directory
				}
				else /*Successfully upload file*/
				{
					## Work on the metadata of the files. 
		   
					## ----------------------------------		
					echo "Path of file is: "  . urlencode($_FILES["file"]["name"]) ; ?> <br> <?php 
					echo "Username is: $username " ;  ?> <br> <?php 
					echo "File type is: " . $_FILES["file"]["type"] ; ?> <br> <?php 
					echo "Upfile variable is:" . "'$upfile'"  ;  ?> <br> <?php 
				
					
					//insert into media table
					##INSERT INTO `Media`(`Media_ID`, `Name`, `File_Location`, `File_Format`, `Category`, `Tags`, `Length`, `LastAccessTime`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8])
					
					## TEMPLATE CODE BELOW 
					//insert into media table
					#$insert = "insert into media(mediaid, filename,username,type, path)".
					#		  "values(NULL,'". urlencode($_FILES["file"]["name"])."','$username','".$_FILES["file"]["type"]."', '$upfile')";
					
					## ________________________
					
					$insert1 = "INSERT INTO `Media`(`Media_ID`,`Name` , `owner_username`, `File_Location`, `File_Format`) VALUES (DEFAULT, '". urlencode($_FILES["file"]["name"])."' , '$username' , '$upfile', '".$_FILES["file"]["type"]."') ; ";
					$queryresult = mysqli_query($GLOBALS['con'] , $insert1)
						  or die("Insert into Media error in media_upload_process.php ". $insert1 . "  ". mysql_error());
					$result="0";
					chmod($upfile, 0755);
				}
			}
			else  
			{
					$result="7"; //upload file failed
			}
		}
	}
	
	//You can process the error code of the $result here.
?>

<meta http-equiv="refresh" content="0;url=browse.php?result=<?php echo $result;?>">
