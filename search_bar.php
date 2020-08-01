<?php
	include_once 'dbh.inc.php';
	$string = str_replace("'","\'",$_POST['input']);
	$search = $_POST['searchThis'];
	
	if ($_POST['getValue'] == 'artistValue')
	{
		if ($search == 'artist')
		{
			$users = mysqli_query($con, "SELECT *FROM user WHERE userName LIKE '%$string%' LIMIT 10;");
			while($user = mysqli_fetch_assoc($users)) 
			{
				$checkName = str_replace("'","\'",$user['userName']);
				echo "<div onclick = \"setValue(".$user['id'].",'".$checkName."')\" class = 'autofillWords'> <img class = 'previewCover' src = 'user/".$user['id']."ProfPic.jpg'>".$user['userName']."
				<input type = 'hidden' value = '".$user['id']."'></div>";
			}
		}
	}
	 else if ($_POST['getValue'] == 'sourceValue')
	{
		if ($search == 'source')
		{
			$sources = mysqli_query($con, "SELECT *FROM source WHERE sourceName LIKE '%$string%' OR weebSourceName LIKE '%$string%' LIMIT 10;");
			while($source = mysqli_fetch_assoc($sources)) 
			{
				$parentSourceName = '';
				if($source['parentSourceID'] != '')
				{
					$parentSourceName = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM source WHERE sourceID = '".$source['parentSourceID']."'"))['sourceName'];
				}
				$checkSource = str_replace("'","\'",$source['sourceName']);
				echo "<div onclick = \"setSourceValue('".$source['sourceID']."','".$checkSource."', '".$source['sourceType']."' ,'".$source['mal']."', '".$parentSourceName."')\" class = 'autofillWords'>".$source['sourceName']."
				<input type = 'hidden' value = '".$source['sourceID']."'></div>";
			}
		}
	}
	 else if ($_POST['getValue'] == 'parentSourceValue')
	{
		if ($search == 'source')
		{
			$sources = mysqli_query($con, "SELECT *FROM source WHERE sourceName LIKE '%$string%' OR weebSourceName LIKE '%$string%' LIMIT 10;");
			while($source = mysqli_fetch_assoc($sources)) 
			{				
				$checkSource = str_replace("'","\'",$source['sourceName']);
				echo "<div onclick = \"setParentSource('".$source['sourceID']."','".$source['sourceName']."')\" class = 'autofillWords'>".$source['sourceName']."
				<input type = 'hidden' value = '".$source['sourceID']."'></div>";
			}
		}
	}
	else if ($search == 'piece')
	{
		$numOfResults = 0;
		$pieces = mysqli_query($con, "SELECT *FROM piece WHERE PieceName LIKE '%$string%' AND privacy != 'private' AND type != 'Episode' ORDER BY listenTime/listens;");
		while($piece = mysqli_fetch_assoc($pieces)) 
		{	
			$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id = ".$piece['creatorID'] .";"));
			if ($user['admin'] == 2 && $numOfResults < 7)
			{
				$numOfResults +=1;
				echo "<a href = 'audio.php?piece=".$piece['pieceID']."'><div class = 'autofillWords'>
				<img class = 'previewCover' src = 'uploaded/".$piece['pieceID'].".jpg'>".$piece['PieceName']."<input type = 'hidden' value = '".$piece['pieceID']."'>
				</div></a>";
			}
		}
		
		$numOfUserResults = 0;
		$userPieces = mysqli_query($con, "SELECT *FROM piece WHERE PieceName LIKE '%$string%' AND privacy != 'private' ORDER BY listenTime/listens;");
		while($userPiece = mysqli_fetch_assoc($userPieces)) 
		{	
			$pieceCreator = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id = ".$userPiece['creatorID'] .";"));
			if ($user['admin'] == 0 && $numOfUserResults < 3)
			{
				$numOfUserResults +=1;
				echo "<a href = 'audio.php?piece=".$userPiece['pieceID']."'><div class = 'autofillWords'>
				<img class = 'previewCover' src = 'uploaded/".$userPiece['pieceID'].".jpg'>".$userPiece['PieceName']."<input type = 'hidden' value = '".$userPiece['pieceID']."'>
				</div>";
			}
		}
		
		$numOfIDMatch = 0;
		$alt = mysqli_query($con, "SELECT *FROM piece WHERE pieceID = '".$string."' AND privacy != 'private';");
		while($altPiece = mysqli_fetch_assoc($alt)) 
		{	
			$pieceCreator = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id = ".$altPiece['creatorID'] .";"));
			if ($numOfIDMatch < 1)
			{
				$numOfUserResults +=1;
				echo "<a href = 'audio.php?piece=".$altPiece['pieceID']."'><div class = 'autofillWords'>
				<img class = 'previewCover' src = 'uploaded/".$altPiece['pieceID'].".jpg'>".$altPiece['PieceName']."<input type = 'hidden' value = '".$altPiece['pieceID']."'>
				</div>";
			}
		}
	}	
	else if ($search == 'alt')
	{
		$numOfResults = 0;
		$pieces = mysqli_query($con, "SELECT *FROM piece WHERE PieceName LIKE '%$string%' AND privacy != 'private' AND type != 'Episode' ORDER BY listenTime;");
		while($piece = mysqli_fetch_assoc($pieces)) 
		{
			$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id = ".$piece['creatorID'] .";"));
			if ($user['admin'] == 2 && $numOfResults < 7)
			{
				$numOfResults +=1;
				echo "<div onclick = \"setAlt('".$piece['pieceID']."','".$piece['PieceName']."')\" class = 'autofillWords'>
				<img class = 'previewCover' src = 'uploaded/".$piece['pieceID'].".jpg'>".$piece['PieceName']."<input type = 'hidden' value = '".$piece['pieceID']."'>
				</div>";
			}
		}
		
		$numOfUserResults = 0;
		$userPieces = mysqli_query($con, "SELECT *FROM piece WHERE PieceName LIKE '%$string%' AND privacy != 'private' AND type != 'Episode' ORDER BY listenTime;");
		while($userPiece = mysqli_fetch_assoc($userPieces)) 
		{	
			$pieceCreator = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id = ".$userPiece['creatorID'] .";"));
			if ($user['admin'] == 0 && $numOfUserResults < 3)
			{
				$numOfUserResults +=1;
				echo "<div onclick = \"setAlt('".$userPiece['pieceID']."','".$userPiece['PieceName']."')\" class = 'autofillWords'>
				<img class = 'previewCover' src = 'uploaded/".$userPiece['pieceID'].".jpg'>".$userPiece['PieceName']."<input type = 'hidden' value = '".$userPiece['pieceID']."'>
				</div>";
			}
		}
		
		$numOfIDMatch = 0;
		$alt = mysqli_query($con, "SELECT *FROM piece WHERE pieceID = '".$string."' AND privacy != 'private' AND type != 'Episode';");
		while($altPiece = mysqli_fetch_assoc($alt)) 
		{	
			$pieceCreator = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id = ".$altPiece['creatorID'] .";"));
			if ($numOfIDMatch < 1)
			{
				$numOfUserResults +=1;
				echo "<div onclick = \"setAlt('".$altPiece['pieceID']."','".$altPiece['PieceName']."')\" class = 'autofillWords'>
				<img class = 'previewCover' src = 'uploaded/".$altPiece['pieceID'].".jpg'>".$altPiece['PieceName']."<input type = 'hidden' value = '".$altPiece['pieceID']."'>
				</div>";
			}
		}
	}
	else if ($search == 'artist')
	{
		$users = mysqli_query($con, "SELECT *FROM user WHERE admin = 2 AND userName LIKE '%$string%' LIMIT 7;");
		while($user = mysqli_fetch_assoc($users)) 
		{	
			echo "<a href = 'dashboard.php?artist=".$user['id']."'><div class = 'autofillWords'>
			<img class = 'previewCover' src = 'user/".$user['id']."ProfPic.jpg'>".$user['userName']."
			<input type = 'hidden' value = '".$user['id']."'></div>";
		}
		$realUsers = mysqli_query($con, "SELECT *FROM user WHERE admin = 0 AND userName LIKE '%$string%' LIMIT 3;");
		while($realUser = mysqli_fetch_assoc($realUsers)) 
		{	
			echo "<a href = 'dashboard.php?artist=".$realUser['id']."'><div class = 'autofillWords'>
			<img class = 'previewCover' src = 'user/".$realUser['id']."ProfPic.jpg'>".$realUser['userName']."
			<input type = 'hidden' value = '".$realUser['id']."'></div>";
		}
	}
	
	else if ($search == 'source')
	{
		$sources = mysqli_query($con, "SELECT *FROM source WHERE sourceName LIKE '%$string%' OR weebSourceName LIKE '%$string%' ORDER BY mal LIMIT 10;");
		while($source = mysqli_fetch_assoc($sources)) 
		{	
			echo "<a href = 'source?s=".$source['sourceID']."'><div class = 'autofillWords'>
			<img class = 'previewCover' src = 'sourceMaterial/".$source['sourceID'].".jpg'>".$source['sourceName']."
			<input type = 'hidden' value = '".$user['id']."'></div>";
		}
	}
	
	else if ($search == 'all')
	{
		//exact match piece+
		$alt = mysqli_query($con, "SELECT *FROM piece WHERE pieceID = '".$string."' AND privacy != 'private' AND type != 'Episode';");
		while($altPiece = mysqli_fetch_assoc($alt)) 
		{	
			echo "<a href = 'audio.php?piece=".$altPiece['pieceID']."'><div class = 'autofillWords'>
			<img class = 'previewCover' src = 'uploaded/".$altPiece['pieceID'].".jpg'>".$altPiece['PieceName']."<span class = 'searchType' style = 'color: orange'>[Song]</span><input type = 'hidden' value = '".$altPiece['pieceID']."'>
			</div>";
		}
		
		//exact match artist
		$userMatch = mysqli_query($con, "SELECT *FROM user WHERE id = ".$string.";");
		while($userPerfectMatch = mysqli_fetch_assoc($userMatch)) 
		{	
				echo "<a href = 'dashboard.php?artist=".$userPerfectMatch['id']."'><div class = 'autofillWords'>
					<img class = 'previewCover' src = 'user/".$userPerfectMatch['id']."ProfPic.jpg'>".$userPerfectMatch['userName']."<span class = 'searchType' style = 'color: grey'>[Artist]</span><input type = 'hidden' value = '".$userPerfectMatch['id']."'>
				</div>";
		}
		
		//exact match source
		$sources = mysqli_query($con, "SELECT *FROM source WHERE sourceID = '%$string%';");
		while($source = mysqli_fetch_assoc($sources)) 
		{	
			echo "<a href = 'source?s=".$source['sourceID']."'><div class = 'autofillWords'>
				<img class = 'previewCover' src = 'sourceMaterial/".$source['sourceID'].".jpg'>".$source['sourceName']."<span class = 'searchType' style = 'color: purple'>[".$source['sourceType']."]</span><input type = 'hidden' value = '".$user['id']."'>
			</div>";
		}
		
		//piece+
		$numOfResults = 0;
		$pieces = mysqli_query($con, "SELECT *FROM piece WHERE PieceName LIKE '%$string%' AND privacy != 'private' AND type != 'Episode' AND LENGTH(altID) < 1 ORDER BY listenTime/listens;");
		while($piece = mysqli_fetch_assoc($pieces)) 
		{	
			$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id = ".$piece['creatorID'] .";"));
			if ($numOfResults < 12)
			{
				$numOfResults +=1;
				echo "<a href = 'audio.php?piece=".$piece['pieceID']."'><div class = 'autofillWords'>
				<img class = 'previewCover' src = 'uploaded/".$piece['pieceID'].".jpg'>".$piece['PieceName']."<input type = 'hidden' value = '".$piece['pieceID']."'><span class = 'searchType' style = 'color: orange'>[Song]</span>
				</div>";
			}
		}
		
		//artist
		$users = mysqli_query($con, "SELECT *FROM user WHERE userName LIKE '%$string%' LIMIT 12;");
		while($user = mysqli_fetch_assoc($users)) 
		{	
			if ($numOfResults < 12)
			{
				$numOfResults +=1;
				echo "<a href = 'dashboard.php?artist=".$user['id']."'><div class = 'autofillWords'>
				<img class = 'previewCover' src = 'user/".$user['id']."ProfPic.jpg'>".$user['userName']."<span class = 'searchType' style = 'color: grey'>[Artist]</span>
				<input type = 'hidden' value = '".$user['id']."'></div>";
			}
		}
		
		//source
		$sources = mysqli_query($con, "SELECT *FROM source WHERE sourceName LIKE '%$string%' OR weebSourceName LIKE '%$string%' ORDER BY mal LIMIT 12;");
		while($source = mysqli_fetch_assoc($sources)) 
		{	
			if ($numOfResults < 12)
			{
				$numOfResults +=1;
				echo "<a href = 'source?s=".$source['sourceID']."'><div class = 'autofillWords'>
				<img class = 'previewCover' src = 'sourceMaterial/".$source['sourceID'].".jpg'>".$source['sourceName']."<span class = 'searchType' style = 'color: purple'>[".$source['sourceType']."]</span>
				<input type = 'hidden' value = '".$user['id']."'></div>";
			}
		}
		
	}
?>







