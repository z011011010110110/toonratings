<?php
    session_start();
    include_once 'dbh.inc.php';

 	

	//reset all toons
	$toon = mysqli_query($con, "SELECT *FROM toon;");	
	
	
	while($row = mysqli_fetch_assoc($toon))
	{
		$id = $row['id'];
		$story = $row['storyRating'];
		$art = $row['artRating'];
		$newRating = ($story + $art)/2;
        $sql2 = "UPDATE toon set userRating = 0 , overallRating = $newRating WHERE id = $id;";
		//$query = mysqli_query($con,$sql2);
	}

	
?>
