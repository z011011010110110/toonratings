<?php
	session_start(); 
	include_once 'dbh.inc.php';
	echo"<html>
	<head>
	</head><body>
	
	
	<link rel='canonical' href='https://soundabox.com/'>
	<meta name='twitter:card' content = 'Home'>
	<meta name='twitter:image' content = 'https://soundabox.com/soundabox.png'>
	<meta name='twitter:title' content = 'Home'>
	<meta name='twitter:description' content = 'Streaming Anime Soundtracks. Full Openings & Endings. All Downloadable.'>
	<meta property='og:type' content = 'music stream'>
	<meta property='og:image' content = '/soundabox.png'>
	<meta property='og:title' content = 'Soundabox - Listen to soundtracks from anime'>
	<meta property='og:url' content = 'https://soundabox.com/'>
	<meta name = 'description' content = 'Streaming Anime Soundtracks. Full Openings & Endings. All Downloadable.'></meta>
	<meta name = 'date' content = '".date("Y-m-d")."'></meta>";
	
	if (!isset($_POST['load']))
	{
		include_once 'home.php';
		echo "<div id = 'content'>";
	}
	echo
	"<h1><title>Soundabox - Listen to soundtracks from anime</title></h1>
	<meta property='description' content = 'Streaming Anime Soundtracks. Full Openings & Endings. All Downloadable.'>
	<meta property='og:description' content = 'Streaming Anime Soundtracks. Full Openings & Endings. All Downloadable.'>
	";
	
	$userID = '';
	if (!empty($_SESSION['userID']))
	{	
		$userID = $_SESSION['userID'];
	}
	
	function playlist()
	{
		echo "<p>REEEEEEEEEEE</p>";
		include_once 'dbh.inc.php';
		$creatorProfile = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id = 13;"));
		$creatorName = $creatorProfile['userName'];
		echo "<p>".$creatorName."</p>";
	}
	
	
	
	$trackID = '1c8303d4';
	$searchTrack = mysqli_query($con, "SELECT *FROM tracks WHERE trackID= '".$trackID."';");
	while($tracks = mysqli_fetch_assoc($searchTrack)) 
	{
		$creatorProfile = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id = ".$tracks['creatorID'].";"));
		$creatorName = $creatorProfile['userName'];
		$creatorDesc = $creatorProfile['description'];
		$songs = $tracks['pieceChain'];
		
		$songArray = explode(" ",$songs);
		$nextSongArray = array_reverse($songArray);
		array_push($nextSongArray, 'end');
		
		$songArray = array_reverse($songArray);
		$songString = implode(" ",$songArray);
		echo "<div class='scrollmenu'><p class = 'scrollmenuNav'><a class = 'loader' href ='playlist?trackID=".$tracks['trackID']."' title = '".$tracks['trackName']."' style = 'font-size: 20px; color: black; padding: 10px; margin: 0px; text-decoration:none'>".$tracks['trackName']."</a>
		<i class = 'fa fa-arrow-down' onclick = \"playlistToQueue('".$songString."')\" title = 'Add Entire Playlist to Queue'></i>
		<i class = 'fa fa-th playlistView' onclick = \"playlistView(this)\" title = 'Expand'></i>";
	if ($tracks['creatorID'] == $userID)
		{
			echo "<a onclick = \"deletePlaylist('".$tracks['trackID']."',this); return false\"  title = 'Perma-Delete This Playlist'>
			<i class='fa fa-times-circle tooltip deletePlaylist'></i></a>";
		}
		else
		{
			$userTracks = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id = ".$userID.";"));
			$savedTracks = explode(" ", $userTracks['playlistSaves']);
			$alreadySaved = false;
			foreach ($savedTracks as $savedTrackPiece)
			{
				if ($savedTrackPiece == $trackID)
				{
					$alreadySaved = true;
					echo "<a onclick = \"savePlaylist('".$tracks['trackID']."',this); return false\"  title = 'Playlist'>
					<i class='fa fa-check tooltip savePlaylist'><span class='tooltiptext'>Remove From My Playlist</span></i></a>";
				}
			}
			if ($alreadySaved == false)
			{
				echo "<a onclick = \"savePlaylist('".$tracks['trackID']."',this); return false\"  title = 'Playlist'>
				<i class='fa fa-plus tooltip savePlaylist'><span class='tooltiptext'>Add To My Playlist</span></i></a>";
			}
		}
		echo "</p>";
		
		$nextNum = 0;
		foreach ($songArray as $pieceID)
		{
			
			$findPiece = mysqli_query($con, "SELECT *FROM piece WHERE pieceID = '".$pieceID."' AND privacy != 'private';");
			

		
			while ($song = mysqli_fetch_assoc($findPiece))
			{
				$artistID = $song['creatorID'];
				$creator = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id = $artistID;"))['userName'];
				$description = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id = $artistID;"))['description'];				
				
				$nextNum++;
				$nextPiece = $nextSongArray[$nextNum];
				
				$releaseDate = date_format(date_create($song['time']), 'F d, Y');
				 echo "<div class='responsiveScroll'>
						<div class='gallery' ondrop='drop(event)'><div id = 'saveIcon'>";

						$added = FALSE;
						if (!empty($_SESSION['userID']))
						{	
							$userID = $_SESSION['userID'];
							$userx = mysqli_query($con, "SELECT *FROM user WHERE id= ".$userID.";");
							while($resultx = mysqli_fetch_assoc($userx)) 
							{
								$songs = $resultx['saves'];
							}		
							$songArray = explode(" ",$songs);
							foreach ($songArray as $pieceID)
							{ 
								if ($pieceID == $song['pieceID'])
								{
									$added = TRUE;
									echo "<a onmouseover = \"loadPlaylist('".$song['pieceID']."' ,this,true)\" onclick = \"save('".$song['pieceID']."','user', '".$song['pieceID']."Saved'); return false\"  title = 'Queue'>
									<div id = 'matchNav' class='saveDropdown'>
									<i id = '".$song['pieceID']."Saved' class='fa fa-check tooltip'><span class='tooltiptext'>Remove from Queue</span></i></a>
									<div id = 'addTo' class='dropdown-content'></div></div></div>";}
							}
						}
						
						if ($added == FALSE)
						{
							echo "<a onmouseover = \"loadPlaylist('".$song['pieceID']."' ,this,true)\" onclick = \"save('".$song['pieceID']."','user', '".$song['pieceID']."Saved'); return false\" title = 'Queue'>
									<div id = 'matchNav' class='saveDropdown'>
									<i id = '".$song['pieceID']."Saved' class='fa fa-plus tooltip'><span class='tooltiptext'>Add to Queue</span></i></a>
									<div id = 'addTo' class='dropdown-content'></div></div></div>";
						}
						
						if (!empty($_SESSION['userID']))
						{
							$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id = ".$userID.";"));
							if ($userID == $artistID ||$user['admin'] == 1)
							{	
								echo"<div id = 'delete'>
									<a onclick = \"deletePiece('".$song['pieceID']."'); return false\" title = 'Delete Piece'><i class='fa fa-times-circle tooltip delete'><span class='tooltiptext'>Delete</span></i></a>
								</div>";
							}
						}
						echo "<div class='desc'>
							<div class = 'pieceName'>
								<input style = 'display:none' name = 'pieceName' />
								<h2 class = 'piece-name-boxed'><a class = 'loader' href ='audio?piece=".$song['pieceID']."' title = '".$song['PieceName']."' style = 'color: black; text-decoration:none'>
								<br>".$song['PieceName']."</a></h2>
								<a href = 'dashboard?artist=".$song['creatorID']."' title = '".$creator."s Page' style = 'color: grey; text-decoration:none' class = 'tooltip loader'>
								<h2 class = 'piece-artist-boxed'>by ".$creator."</h2><span class='tooltiptext'>
								<img id = 'profilePicTooltip' src = 'user/".$song['creatorID']."ProfPic.jpg' alt='Profile Image'><span class = 'tooltipHTMLText'>".$creator.": ".$description."</span></span></a>
								<p class = 'publishDate'>Published ".$releaseDate."</p>
							</div>";
						if ($song['source'] != '')
						{
							$info = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM source WHERE sourceID = '".$song['source']."';"));
						}		
						if ($song['shortVersion'] != '' && $user['disableShortVersion'] != 'true')//Short version available
						{
							echo "<div class='imgContainer'>
							<img style = 'border-radius: 10px;' src= 'uploaded/".$song['pieceID'].".jpg' alt='Cover Image' draggable='true' ondragstart='drag(event)' id='drag1'>
							<input id = 'imgPlayButton' onclick = \"loadVid2('".$song['pieceID']."','".$nextPiece."',true,'playlist','".$trackID."')\" type = 'button'></input>
							<i id = '".$song['pieceID']."' class='fa fa-play soundPlayerIcon orangePlayButton'>
							<param id = '".$song['pieceID']."Next' value = '".$nextPiece."'>
							<param id = '".$song['pieceID']."vidID' value = '".$song['shortVersion']."'>
							<param id = '".$song['pieceID']."Type' value = 'yt'></i>
							</div><a style = 'margin: 0px 10px' href='#' onclick = \"downloadx('".$song['ytID']."')\" title = 'Download'><i class='fa fa-download'></i></a>
							<a href = 'https://myanimelist.net/anime/".$info['mal']."' title = 'MyAnimeList'><img style = 'margin:0px 10px; width: 20px; height: auto;' src = 'MyAnimeList.png'></a>";
						}
						else if ($song['ytID'] == null)//mp3
						{
							echo "<div class='imgContainer'>
									<img style = 'border-radius: 10px;' src= 'uploaded/".$song['pieceID'].".jpg' alt='Cover Image' draggable='true' ondragstart='drag(event)' id='drag1'>
									<input id = 'imgPlayButton' onclick = \"playOrPause2('".$song['pieceID']."','".$nextPiece."',true,'playlist','".$trackID."')\" type = 'button'></input>
									<i id = '".$song['pieceID']."' class='fa fa-play soundPlayerIcon orangePlayButton ".$trackID."'>
									<param id = '".$song['pieceID']."Next' value = '".$nextPiece."'>
									<param id = '".$song['pieceID']."Type' value = 'mp3'></i>
								</div>
								<a style = 'margin: 0px 10px' href='uploaded/".$song['pieceID'].".mp3' title = 'Download' download = '".$song['PieceName']."'><i class='fa fa-download'></i></a>
								<a href = 'https://myanimelist.net/anime/".$info['mal']."' title = 'MyAnimeList'><img style = 'margin:0px 10px; width: 20px; height: auto;' src = 'MyAnimeList.png'></a>";
						}
						else //yt
						{
							echo "<div class='imgContainer'>
							<img style = 'border-radius: 10px;' src= 'uploaded/".$song['pieceID'].".jpg' alt='Cover Image' draggable='true' ondragstart='drag(event)' id='drag1'>
							<input id = 'imgPlayButton' onclick = \"loadVid2('".$song['pieceID']."','".$nextPiece."',true,'playlist','".$trackID."')\" type = 'button'></input>
							<i id = '".$song['pieceID']."' class='fa fa-play soundPlayerIcon orangePlayButton ".$trackID."'>
							<param id = '".$song['pieceID']."Next' value = '".$nextPiece."'>
							<param id = '".$song['pieceID']."vidID' value = '".$song['ytID']."'>
							<param id = '".$song['pieceID']."Type' value = 'yt'></i>
							</div><a style = 'margin: 0px 10px' href='#' onclick = \"downloadx('".$song['ytID']."')\" title = 'Download'><i class='fa fa-download'></i></a>
							<a href = 'https://myanimelist.net/anime/".$info['mal']."' title = 'MyAnimeList'><img style = 'margin:0px 10px; width: 20px; height: auto;' src = 'MyAnimeList.png'></a>";
						}
						
						echo"</div>
						</div>
					</div>";
				
			}
		}
		echo "</div><br><br><br><br><br>";
	}

	
	
	$piecePerPage = 25;
	$pieceNum = mysqli_query ($con,"SELECT COUNT(*) as total FROM piece WHERE privacy != 'private' AND type != 'Episode' AND altID = '';");
	if (isset($_GET['index']) && $_GET['index'] == 'seasonals')//if seasonals
	{
		$pieceNum = mysqli_query($con, "SELECT COUNT(*) as total FROM piece WHERE time BETWEEN '2018/12/25 00:00:00' AND '2019/12/31 00:00:00' AND privacy != 'private' AND type != 'Episode' AND altID = '';");
	}
	$count = mysqli_fetch_assoc($pieceNum);
	echo "
	<div id = 'indexContent'>
	<div id = 'pageButtons'>";
	for ($x = 0; $x < ($count['total'])/$piecePerPage; $x++)
	{	
		echo "<button class = 'pageNumber pageNum".($x+1)."' onclick=\"loadDoc(".$x.", false)\">".($x+1)."</button>";
	}
	echo "</div>

	
	<div id='rankings'>
	</div>
	<div id = 'pageButtons'>";
	for ($x = 0; $x < $count['total']/$piecePerPage; $x++)
	{	
		echo "<button class = 'pageNumber pageNum".($x+1)."' onclick=\"loadDoc(".$x.", false)\">".($x+1)."</button>";
	}
	echo "</div></div>

		<br><br><br><br><br><br>
		<div class = 'notice'>
		
			<a href='contact' title = 'Contact Us!'>Got stuff to say or request?</a>
			<a style = 'margin: 0px; 100px;' href = 'https://twitter.com/Soundabox' title = 'twitter'><img style = 'height: 12px; width: 12px;' src = 'https://image.flaticon.com/icons/png/512/8/8800.png'></a>
		</div>
		";
	if (!isset($_POST['load']))
	{
		echo "</div>";
	}
	mysqli_close($con);
?>
</body>
</html>
<script>
	var $currentPage;
	var $maxPage = <?php
		echo ceil($count['total']/$piecePerPage);
	?>;
	var btns = document.getElementsByClassName("pageNumber");
	var first = document.getElementsByClassName(btns[0].className);
	
	for (var x = 0; x < first.length; x++)
	{
		first[x].className+= " PageButtonActive";
	}
	window.onload = loadDocx(0, false);


</script>


