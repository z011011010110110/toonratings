<?php
	session_start();
	include_once 'dbh.inc.php';


	// Get image name
	$userID = $_SESSION['userID'];
	
	$bigImage = $_FILES['fileInput']['tmp_name'];
	$image = 'user/'.$userID.'ProfPic.jpg';
	
	if (imagedestroy($image)) {
		echo $image;
		copy($bigImage, $image);
	}
	else {
		if (move_uploaded_file("user/1.jpg", $image)) {
			echo "Uploaded";
		}
		else{
			if (copy($bigImage, $image)){
				echo "Copied to ".$image;
			}
			else{
				echo 'The file is not writable';
			}
		}
	}
	
	
	
	//$fp = fileperms($image);
	 
	//echo substr(sprintf('%o', $fp), -4); //0666
	
	//session_write_close();
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>