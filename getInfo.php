<?php
	session_start(); 
	include_once 'dbh.inc.php';

	
	//get more information about ratings
	$pageId = $_GET['page'];
	$info = mysqli_query($con, "SELECT *FROM info WHERE id = $pageId;");	
	
	while($row = mysqli_fetch_assoc($info)) 
	{
		$newObj->info = $row['info'];
	}
	
	//get admin? of the user
	$user = mysqli_query($con, "SELECT *FROM user WHERE id = ".$_SESSION['userID'].";");	
	$admin = 0;
	while($row = mysqli_fetch_assoc($user)) 
	{
		if ($row['admin'] == 1)
		{
			$admin = 2;
		}
	}
	$newObj->admin = (int)$admin;
	/*
		$newObj->id = (double)$row['id'];
		$newObj->title = $row['title'];
		$newObj->description = $row['description'];
	*/
	$newJSON = json_encode($newObj);

	echo $newJSON;
?>