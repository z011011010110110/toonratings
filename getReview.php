<?php
	session_start(); 
	include_once 'dbh.inc.php';
	$toonId = $_GET['toon'];
	
	
	//get reviews for the toon
	$toon = mysqli_query($con, "SELECT *FROM review WHERE toonId = $toonId AND active > -1;");	
	
	$newObj = array();
	
	//returns toon that matches
	while($row = mysqli_fetch_assoc($toon))
	{
		//get username of the reviewer
		$review = mysqli_query($con, "SELECT *FROM user WHERE id = ".$row['userId'].";");	
		$username = '';
		while($row2 = mysqli_fetch_assoc($review)) 
		{
			$username = $row2['userName'];
		}
			$reviewOwner = 0;
			if ($row['userId'] == $_SESSION['userID']){
				$reviewOwner = 1;
			}

		
		$newObj[] = array(
			'id' => (double)$row['id'],
			'toonId' => $row['toonId'],
			'userId' => $row['userId'],
			'username' => $username,
			'review' => $row['review'],
			'userRating' => (double)$row['userRating'],
			'storyRating' => (double)$row['storyRating'],//NOT IN USE. CAN DELETE.
			'artRating' => (double)$row['artRating'],//NOT IN USE. CAN DELETE.
			'panelRating' => (double)$row['panelRating'],//NOT IN USE. CAN DELETE.
			'reviewOwner' => (int)$reviewOwner,
			'date' => $row['date'],
			'replyId' => $row['replyId'],

		);
	}
	/*
		$newObj->id = (double)$row['id'];
		$newObj->title = $row['title'];
		$newObj->description = $row['description'];
		$newObj->uniqueId = $row['uniqueId'];
		$newObj->userRating = (double)$row['userRating'];
		$newObj->storyRating = (double)$row['storyRating'];
		$newObj->artRating = (double)$row['artRating'];
		$newObj->panelRating = (double)$row['panelRating'];
		$newObj->date = $row['date'];
		$newObj->author = $row['author'];
		$newObj->authorId = (double)$row['authorId'];
		*/
	$newJSON = json_encode($newObj);

	echo $newJSON;
?>