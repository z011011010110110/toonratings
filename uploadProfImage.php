<?php
	session_start();
	include_once 'dbh.inc.php';
	
	function resizeImage($sourceImage, $targetImage, $maxWidth, $maxHeight, $quality = 80)
	{
		
		/* Obtain image from given source file.
		if (!$image == @imagecreatefromjpeg($sourceImage))
		{
			return false;
		}*/

		// Get dimensions of source image.
		list($origWidth, $origHeight) = getimagesize($sourceImage);

		if ($maxWidth == 0)
		{
			$maxWidth  = $origWidth;
		}

		if ($maxHeight == 0)
		{
			$maxHeight = $origHeight;
		}
		// Calculate ratio of desired maximum sizes and original sizes.
		$widthRatio = $maxWidth / $origWidth;
		$ratio = $widthRatio;//Test. Delete/fix later.
		//$heightRatio = $maxHeight / $origHeight;

		// Ratio used for calculating new image dimensions.
		//$ratio = min($widthRatio, $heightRatio);

		// Calculate new image dimensions.
		$newWidth  = (int)$origWidth  * $ratio;
		$newHeight = (int)$origHeight * $ratio;

		// Create final image with new dimensions.
		$newImage = imagecreatetruecolor($newWidth, $newHeight);
		$img = imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
		imagejpeg("user/110ProfPic.jpg", $targetImage, $quality);
		//echo $targetImage;
		
		// Free up the memory.
		//imagedestroy($image);
		imagedestroy($newImage);

		return true;
	}

	// Get image name
	$userID = $_SESSION['userID'];
	
	$bigImage = $_FILES['fileInput']['tmp_name'];
	$image = 'user/'.$userID.'ProfPic.jpg';
	

	echo $image;
	imagejpeg($bigImage, $image, 80);
	//$image = preg_replace('/\s/', '', $image);
	//$compressedImg = addslashes(file_get_contents(compress($bigImage, $image, 85)));
	//resizeImage($bigImage, $image, 200, 200);
	/*$sql = "SELECT *FROM user WHERE id = '$userID';";
	$results = mysqli_query($con, $sql);
	while($id = mysqli_fetch_assoc($results))
	{
		$idNum = $id['id'];
		$sql2 = "UPDATE profilepic SET profileImage = '$compressedImg'  WHERE userid = '$idNum';";
			// execute query
		//$uploaded = mysqli_query($con, $sql2);
		//header("Location: dashboard.php?artist=".$userID);
	}
	*/
	//session_write_close();
?>





























