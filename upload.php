<?php
	header("Location: https://soundabox.com");
	session_start();
	include_once 'dbh.inc.php';

	function resizeImage($sourceImage, $targetImage, $maxWidth, $maxHeight, $quality = 100)
	{
		// Obtain image from given source file.
		if (!$image = @imagecreatefromjpeg($sourceImage))
		{
			return false;
		}

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
		imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
		imagejpeg($newImage, $targetImage, $quality);

		// Free up the memory.
		imagedestroy($image);
		imagedestroy($newImage);

		return true;
	}

	
		$time = 'CURRENT_TIMESTAMP';
		if (isset($_POST['dateSet']))
		{
			$time = "'".$_POST['dateSet']."'";
		}
		$sourceID = '';
		if (isset($_POST['sourceIDValue']))
		{
			$sourceID = $_POST['sourceIDValue'];
		}		
		if (isset($_POST['altIDValue']))
		{
			$altID = $_POST['altIDValue'];
		}
		$pieceType = '';
		if (isset($_POST['pieceType']))
		{
			$pieceType = $_POST['pieceType'];
		}
		$creatorIDNum = $_SESSION['userID'];
		$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id = ".$creatorIDNum.";"));
		if ($user['admin'] == 1 && isset($_POST['creatorIDValue']))
		{
			if ($_POST['creatorIDValue'] != '')
			{
				$creatorIDNum = $_POST['creatorIDValue'];
			}
		}
		
		if (isset($_POST['Upload']))
		{
			if (!empty($_POST['pieceName'])&& !empty($_POST['container2Text'])&& !empty($_FILES['imageSourceFile'])) 
			{
				$pieceName =  $_POST['pieceName'];
				
				$description =  $_POST['container2Text'];
				
				$imageN = $_FILES['imageSourceFile']['name'];
				$imageF = $_FILES['imageSourceFile']['tmp_name'];	
				$imageExt = pathinfo($imageN, PATHINFO_EXTENSION);
				
				$soundN = $_FILES['soundSourceFile']['name'];
				$soundF = $_FILES['soundSourceFile']['tmp_name'];
				$soundExt = pathinfo($soundN, PATHINFO_EXTENSION);
				
				$uniqueID =hash('adler32',  uniqid());

				$result = mysqli_query($con, "SELECT *FROM piece WHERE pieceID = '$uniqueID';");	
				while (mysqli_num_rows($result) > 0) //episode available
				{
					$uniqueID =hash('adler32',  uniqid());
					$result = mysqli_query($con, "SELECT *FROM piece WHERE pieceID = '$uniqueID';");
				}	
				
				copy("soundabox.jpg", 'uploaded/'.$uniqueID.'.jpg');
				
				move_uploaded_file($imageF, 'uploaded/'.$uniqueID.'.jpg');//Moves twice
				$image = 'uploaded/'.$uniqueID.'.jpg';
				resizeImage($imageF, $image, 200, 200);
				
				move_uploaded_file($soundF, 'uploaded/'.$uniqueID.'.'.$soundExt);
				
				$sql = "INSERT INTO piece (pieceID, PieceName, idDescription, creatorID, time, source,altID, type) 
				VALUES('$uniqueID',\"$pieceName\" ,\"$description\", $creatorIDNum, $time, '$sourceID','$altID', '$pieceType');";
				$query = mysqli_query($con,$sql);
				$download = false;
			}
			else
			{
				echo "alert('Missing stuff');";
			}
		}
		if (isset($_POST['YTUpload']))
		{
			
			$ytURL = $_POST['ytURLS'];
			$ytID = substr( explode('?v=',$ytURL)[1],0,11);
			$ytContent = file_get_contents("http://youtube.com/get_video_info?video_id=".$ytID);
			parse_str($ytContent, $ytarr);
			
			$ytTitle = $ytarr['title'];
			
			if ($_POST['pieceName'] == '') {
				$pieceName = $ytTitle;
			}
			else
			{
				$pieceName = $_POST['pieceName'];
			}
			$description =  $_POST['container2Text'];
			
			if (empty($_POST['container2Text'])) {
				$description = $ytTitle;
			}
			
			$imageN = $_FILES['imageSourceFile']['name'];
			$imageF = $_FILES['imageSourceFile']['tmp_name'];	
			$imageExt = pathinfo($imageN, PATHINFO_EXTENSION);
			
			
			$uniqueID =hash('adler32',  uniqid());
			while (mysqli_num_rows(mysqli_query($con, "SELECT *FROM piece WHERE pieceID = '$uniqueID';")) > 0) //episode available
			{
				$uniqueID =hash('adler32',  uniqid());
			}			
			copy("soundabox.jpg", 'uploaded/'.$uniqueID.'.jpg');
			
			
			move_uploaded_file($imageF, 'uploaded/'.$uniqueID.'.jpg');//Moves twice
			$image = 'uploaded/'.$uniqueID.'.jpg';
			resizeImage($imageF, $image, 200, 200);
			
			$sql = "INSERT INTO piece (pieceID, PieceName, idDescription, creatorID, time, ytID, source,altID, type)
			VALUES('$uniqueID',\"$pieceName\" ,\"$description\", $creatorIDNum, $time, '$ytID', '$sourceID','$altID', '$pieceType' );";
			
			$query = mysqli_query($con,$sql);
		}
	
		session_write_close();
?>











