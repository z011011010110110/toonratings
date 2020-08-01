<?php
	if (!isset($_POST['load']))
	{
		include_once 'home.php';
		echo "<div id = 'content'>";
	}
	session_start(); 
	include_once 'dbh.inc.php';

	$pieceID = $_GET['piece'];
	$piece = mysqli_query($con, "SELECT *FROM piece WHERE pieceID ='".$pieceID."';");	
	
	while($row = mysqli_fetch_assoc($piece))
	{
		$nextPiece = '';
		$nextUp = mysqli_query($con, "SELECT *FROM piece WHERE pieceID= '".$pieceID."';");
		while($nextResult = mysqli_fetch_assoc($nextUp)) 
		{
			$chainArray = explode(" ",$nextResult['nextChain']);
			$values = array_count_values($chainArray);
			arsort($values);
			$sortedArr = array_keys($values);
			$nextPiece = $sortedArr[0];
		}
		
		$releaseDate = date_format(date_create($row['time']), 'F d, Y');
		$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id =" .$row['creatorID'].";"));
		$creatorName = $user['userName'];
		$creatorDesc = $user['description'];
		
		echo "<h1 class = 'hidden'>Download ".$row['PieceName']." Soundtrack</h1>";
		echo "<h1 class = 'piece-name-boxed'><title>".$row['PieceName']." - ".$creatorName."</title></h1>
		<meta property='published_time' content='".$row['time']."' />
		<meta name = 'description' content = '".$row['idDescription']." ".$row['PieceName']." by ".$creatorName.".[Full]'></meta>";
		
		 echo "<div class = 'item'>
			<div class='responsive'>
				<div class='gallery' ondrop='drop(event)'><div id = 'saveIcon'>";
					$rows = '';
					$added = FALSE;
					if (!empty($_SESSION['userID'])) //check for if saved
					{	
						$userID = $_SESSION['userID'];
						$userx = mysqli_query($con, "SELECT *FROM user WHERE id= ".$userID.";");
						while($resultx = mysqli_fetch_assoc($userx)) 
						{
							$rows = $resultx['saves'];
						}		
						$rowArray = explode(" ",$rows);
						foreach ($rowArray as $pieceID)
						{ 
							if ($pieceID == $row['pieceID'])
							{
								$added = TRUE;
								echo "<a href='#' onmouseover = \"loadPlaylist('".$row['pieceID']."' ,this,true)\" onclick = \"save('".$row['pieceID']."','user', '".$row['pieceID']."Saved'); return false\">
										<div id = 'matchNav' class='saveDropdown'>
										<i id = '".$row['pieceID']."Saved' class='fa fa-check tooltip'><span class='tooltiptext'>Remove from Queue</span></i>
										
									</a><div id = 'addTo' class='dropdown-content'></div></div></div>";
									}
						}
					}
					if ($added == FALSE)
					{
						echo "<a href='#' onmouseover = \"loadPlaylist('".$row['pieceID']."' ,this,true)\" onclick = \"save('".$row['pieceID']."','user', '".$row['pieceID']."Saved'); return false\">
										<div id = 'matchNav' class='saveDropdown'>
										<i id = '".$row['pieceID']."Saved' class='fa fa-plus tooltip'><span class='tooltiptext'>Add to Queue</span></i>
									</a><div id = 'addTo' class='dropdown-content'></div></div></div>";

					}
					
					if (!empty($_SESSION['userID']))
					{
						$currentUser = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id = ".$_SESSION['userID'].";"));
						if ($userID == $row['creatorID'] ||$currentUser['admin'] == 1)
						{	
							echo"<div id = 'delete'>
								<a onclick = \"deletePiece('".$row['pieceID']."'); return false\"><i class='fa fa-times-circle tooltip delete'><span class='tooltiptext'>Delete</span></i></a>
							</div>";
						}
					}
					$thisArtist = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id = ".$row['creatorID'].";"));
					echo "<div class='desc'>
						<div class = 'pieceName'>
							<input style = 'display:none' id = 'pieceName' name = 'pieceName' />
							<p class = 'pieceNameTextx'><h2 class = 'piece-name-boxed'>".$row['PieceName']."</h2>
							<a href = 'dashboard?artist=".$row['creatorID']."' style = 'color: grey; font-size: 12px; text-decoration:none' class = 'tooltip loader'>by ".$thisArtist['userName']."<span class='tooltiptext'><img id = 'profilePicTooltip' alt = '".$creatorName."'s Page' src = 'user/".$row['creatorID']."ProfPic.jpg'><span class = 'tooltipHTMLText'>".$creatorName.": ".$creatorDesc."</span></span></a></p>
							<p class = 'publishDate'>Published ".$releaseDate."</p>
							<meta name = 'date' content = '".$releaseDate."'></meta>
						</div>";
						
				if ($row['source'] != '')
				{
					$info = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM source WHERE sourceID = '".$row['source']."';"));
				}					
				if ($row['ytID'] == null  && $row['vidSource'] == null)//mp3
				{
					echo "<div class='imgContainer'>
							<img style = 'border-radius: 10px;' src= 'uploaded/".$row['pieceID'].".jpg' alt = '".$row['PieceName']."' draggable='true' ondragstart='drag(event)' id='drag1'>
							<input id = 'imgPlayButton' onclick = \"playOrPause2('".$row['pieceID']."','".$nextPiece."',true, 'audio','')\" type = 'button'></input>
							<i id = '".$row['pieceID']."' class='fa fa-play soundPlayerIcon orangePlayButton'>
							<param id = '".$row['pieceID']."Type' value = 'mp3'></i>
						</div>
						<a style = 'margin: 0px 10px' href='uploaded/".$row['pieceID'].".mp3' download = '".$row['PieceName']."' title = 'Download'><i class='fa fa-download'></i></a>
						<a href = 'https://myanimelist.net/anime/".$info['mal']."' title = 'MyAnimeList'><img style = 'margin:0px 10px; width: 20px; height: auto;' src = 'MyAnimeList.png' alt = 'MyAnimeList'></a>
						";
				}
				
				else if ($row['vidSource'] != null)	//mp4
				{
					if ($row['vidFrameLink'] != null)
					{
						$vidLink = $row['vidFrameLink'];
					}
					else
					{
						$str = file_get_contents($row['vidSource']);
						$vidLink = '';
						if(strlen($str)>0){
							$str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
							preg_match("/<iframe src=\"(.*)\"/siU",$str,$title); // ignore case
							$vidLink = $title[1];
							mysqli_query($con, "UPDATE piece SET vidFrameLink='$vidLink' WHERE pieceID='".$row['pieceID']."';");
							$row['vidFrameLink'] = $vidLink;
						}
					}
					if ($row['thumbnailSource'] != null)
					{
						$src = $row['thumbnailSource'];
					}
					else
					{
						$src = 'sourceMaterial/'.$row['source'].'.jpg';
					}
					
					echo "<div class='imgContainer'>
						<img style = 'border-radius: 10px;' src= '$src' draggable='true' ondragstart='drag(event)' id='drag1'>
						<input id = 'imgPlayButton' onclick = \"playOrPause3('".$row['pieceID']."','".$nextPiece."',true,'queue','".$vidLink."')\" type = 'button'></input>
						<i id = '".$row['pieceID']."' class='fa fa-play soundPlayerIcon orangePlayButton ".$trackID."'>
						<param id = '".$row['pieceID']."Next' value = '".$nextPiece."'>
						<param id = '".$row['pieceID']."Type' value = 'mp4'></i>
					</div><a style = 'margin: 0px 10px' href='#' onclick = \"downloadMP4('".$row['vidSource']."')\" title = 'Download'><i class='fa fa-download'></i></a>
					<a href = 'https://myanimelist.net/anime/".$info['mal']."' title = 'MyAnimeList'><img style = 'margin:0px 10px; width: 20px; height: auto;' src = 'MyAnimeList.png' alt = 'MyAnimeList'></a>";
				}
				else //yt
				{
					echo "<div class='imgContainer'>
					<img style = 'border-radius: 10px;' src= 'uploaded/".$row['pieceID'].".jpg' alt = '".$row['PieceName']."' draggable='true' ondragstart='drag(event)' id='drag1'>
					<input id = 'imgPlayButton' onclick = \"loadVid2('".$row['pieceID']."','".$nextPiece."',true, 'audio','')\" type = 'button'></input>
					<i id = '".$row['pieceID']."' class='fa fa-play soundPlayerIcon orangePlayButton'>
					<param id = '".$row['pieceID']."vidID' value = '".$row['ytID']."'>
					<param id = '".$row['pieceID']."Type' value = 'yt'></i>
					</div><a style = 'margin: 0px 10px' href='#' onclick = \"downloadx('".$row['ytID']."')\" title = 'Download'><i class='fa fa-download'></i></a>
					<a href = 'https://myanimelist.net/anime/".$info['mal']."' title = 'MyAnimeList'><img style = 'margin:0px 10px; width: 20px; height: auto;' src = 'MyAnimeList.png' alt = 'MyAnimeList'></a>";
				}
				echo	"</div>
				</div>
			</div>
			
			<div id = 'pieceDescription'>
				<param id = 'pieceID' value = '".$row['pieceID']."'></param>
				<p style = 'color: grey; font-size: 13px'><span>".$row['listens']." Listens</span>";
				
				$altCheck = mysqli_query($con, "SELECT *FROM piece WHERE altID = '".$row['pieceID']."';");	//find where altID is this pieceID
				$parentAlt = mysqli_query($con, "SELECT *FROM piece WHERE pieceID = '".$row['altID']."';");	//find this piece's origin
				$siblingAlt = mysqli_query($con, "SELECT *FROM piece WHERE altID = '".$row['altID']."' AND pieceID != '".$row['pieceID']."';");	//find piece with same altID as this

					if (mysqli_num_rows($parentAlt) > 0 || mysqli_num_rows($altCheck) > 0)
					{
						echo "<span style = 'float: right'>Alternative Versions: <select onchange = \"loadAlt(this)\" value = '".$alt['pieceID']."'>";
						echo "<option value = '".$orw['pieceID']."'>".$row['PieceName']." [Current]</option>";

						while($sibling = mysqli_fetch_assoc($siblingAlt) && $row['altID'] != '')
						{
							echo "<option value = '".$sibling['pieceID']."'>".$sibling['PieceName']."</option>";
						}
					}
				
					while($parent = mysqli_fetch_assoc($parentAlt))
					{
						echo "<option value = '".$parent['pieceID']."'>".$parent['PieceName']."</option>";
					}					
					while($alt = mysqli_fetch_assoc($altCheck))
					{
						echo "<option value = '".$alt['pieceID']."'>".$alt['PieceName']."</option>";
					}
					if (mysqli_num_rows($parentAlt) > 0 || mysqli_num_rows($altCheck) > 0)
					{
						echo "</select></span>";
					}

				
				
				echo "</p>
				<textarea readonly class = 'noneditable' id = 'pieceDescriptionInner'";
				
				
				if ($currentUser['admin'] == 1 || $row['creatorID'] == $userID)
				{
					echo "description-editable ";
				}
				echo ">".$row['idDescription']."</textarea><h2 class = 'hidden'>".$row['idDescription']."</h2>";
				
				echo "<div style='float: right;'>";
				if ($row['source'] != '')
				{
					$info = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM source WHERE sourceID = '".$row['source']."';"));
					$filler = '';
					if ($row['type'] == '')
					{
						$filler = ' From the';
					}
					else
					{
						$filler = ' from the';
					}
					$choose = $row['type'];
					if ($currentUser['admin'] == 1)
					{//CHANGE FIX FIRST THING WHEN PHP COMES BACK ON 
						echo "<input id = 'altID' type = 'text' placeholder='Insert Parent Version' value = '".$row['altID']."' onchange = \"updatePiece('".$row['pieceID']."',this)\"></input>
						<input id = 'shortVersion' type = 'text' placeholder='Insert TV Version' value = '".$row['shortVersion']."' onchange = \"updatePiece('".$row['pieceID']."',this)\"></input>";
						$choose = "<select id = 'pieceType' style='margin-right:5px' onchange = \"updatePiece('".$row['pieceID']."', this)\">";
						$choose = $choose."<option id = 'searchOption' value=''";
						if ($row['type'] == '')
						{
							$choose = $choose."selected";
						}
							$choose = $choose.">&nbsp;&nbsp;Single</option>";
							
						$choose = $choose."<option id = 'searchOption' value='Opening'";
						if ($row['type'] == 'Opening')
						{
							$choose = $choose."selected";
						}
							$choose = $choose.">&nbsp;&nbsp;Opening</option>";
							
						$choose = $choose."<option id = 'searchOption' value='Ending'";
						if ($row['type'] == 'Ending')
						{
							$choose = $choose."selected";
						}
							$choose = $choose.">&nbsp;&nbsp;Ending</option>";
						$choose = $choose."<option id = 'searchOption' value='OST'";
						if ($row['type'] == 'OST')
						{
							$choose = $choose."selected";
						}
							$choose = $choose.">&nbsp;&nbsp;OST</option>";
							
						$choose = $choose."</select>";
						
						echo $choose;
					}
					else 
					{
						$sourceString = $choose;
					}
					
					
					if ($user['weebMode'] == 'true' && $info['weebSourceName'] != '')
					{
						//$sourceName = get_title("https://myanimelist.net/anime/");
						$sourceName = $info['weebSourceName'];
					}
					else
					{
						$sourceName = $info['sourceName'];
					}
					
					$sourceString = $sourceString.$filler." ".$info['sourceType'].", ".$sourceName."";
					echo "<h1 class = 'hidden'>Download ".$sourceString." Full</h1>";
					echo "<a style='color: grey; font-size: 10px; text-decoration:none; float: right' href ='source?s=".$info['sourceID']."' class = 'tooltip loader'>
					$sourceString<span class='tooltiptext'>
						<img  alt = '".$sourceName."' id = 'profilePicTooltip' src = 'sourceMaterial/".$info['sourceID'].".jpg'>
							<span class = 'tooltipHTMLText'>".$sourceName."</span>
						</span>
					</a>
					</td>";
					//echo "<p>".."</p>";
				}
			echo "</div></div></div>";
	}
	
		$num = 0;
		$nextChain = mysqli_query($con, "SELECT *FROM piece WHERE pieceID = '".$_GET['piece']."';");
		while($nextChainString = mysqli_fetch_assoc($nextChain))
		{
			if ($nextChainString['nextChain'] != '')
			{
				echo "<div class='content'>
				<table>
				  <tr>
					<th class = 'centerTable' style = 'width: 60px'>Cover</th>
					<th>Name and Artist</th>
					<th class = 'centerTableDetails'>Details</th>
					<th class = 'centerTable'>Listens</th>
					<th class = 'centerTable'></th>
					<th class = 'centerTable'></th>
				  </tr>";
			}
			$chainArray = explode(" ",$nextChainString['nextChain']);
			$values = array_count_values($chainArray);
			arsort($values);
			$sortedArr = array_keys($values);
			foreach ($sortedArr as $chainPiece)
			{
				$result = mysqli_query($con, "SELECT *FROM piece WHERE pieceID = '".$chainPiece."';");
				if (mysqli_num_rows($result) > 0 )
				{
					while($row = mysqli_fetch_assoc($result))
					{
						$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id =".$row['creatorID'].";"));
						
						$creatorName = $user['userName'];
						$creatorDesc = $user['description'];
						$num+=1;
						$desc = substr($row['idDescription'],0,100);
						$nextPiece = $sortedArr[$num];
						if (strlen($desc) >= 97)//Cut off description after 97 characters FIX LATER
						{
							$desc = $desc.'...';
						}
						//echo "<div>".$row['pieceID']."asd</div>";
						echo "<tr class><td class = 'centerTable' style = 'width: 60px'>
							<div id = 'imageListWrapper'>";
						
							$userID = $_SESSION['userID'];
							$userx  = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id= ".$userID.";"));
							if ($row['shortVersion'] != '' && $userx['disableShortVersion'] != 'true')//Short version available
							{
								echo "<img style = 'border-radius: 10px;' id = 'imageSourceList' src='uploaded/".$row['pieceID'].".jpg' alt='Yellowest thing ever' draggable='true' ondragstart='drag(event)' id = 'drag1'>	
								<input id = 'imgPlayButtonList' onclick = \"loadVid2('".$row['pieceID']."','".$nextPiece."',true, 'soundarray')\" type = 'button'></input>
								<i id = '".$row['pieceID']."' class='fa fa-play soundPlayerIcon orangePlayButtonList listID'>
								<param id = '".$row['pieceID']."Next' value = '".$nextPiece."'>
								<param id = '".$row['pieceID']."vidID' value = '".$row['shortVersion']."'>
								<param id = '".$row['pieceID']."Type' value = 'yt'></i>	
								"; //id for next piece
							}
							
							else if ($row['ytID'] == null && $row['vidSource'] == null)//mp3
							{
								echo "<img style = 'border-radius: 10px;' id = 'imageSourceList' src='uploaded/".$row['pieceID'].".jpg' alt='Yellowest thing ever' draggable='true' ondragstart='drag(event)'>	
								<input id = 'imgPlayButtonList' onclick = \"playOrPause2('".$row['pieceID']."','".$nextPiece."',true, 'none')\" type = 'button'></input>
								<i id = '".$row['pieceID']."' class='fa fa-play soundPlayerIcon orangePlayButtonList listID' value = '".$nextPiece."'>
								<param id = '".$row['pieceID']."Next' value = '".$nextPiece."'>
								<param id = '".$row['pieceID']."Type' value = 'mp3'></i>";
							}
							
							else if ($row['vidSource'] != null)	//mp4
							{
								if ($row['vidFrameLink'] != null)
								{
									$vidLink = $row['vidFrameLink'];
								}
								else
								{
									$str = file_get_contents($row['vidSource']);
									$vidLink = '';
									if(strlen($str)>0){
										$str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
										preg_match("/<iframe src=\"(.*)\"/siU",$str,$title); // ignore case
										$vidLink = $title[1];
										mysqli_query($con, "UPDATE piece SET vidFrameLink='$vidLink' WHERE pieceID='".$row['pieceID']."';");
										$row['vidFrameLink'] = $vidLink;
									}
								}
								if ($row['thumbnailSource'] != null)
								{
									$src = $row['thumbnailSource'];
								}
								else
								{
									$src = 'sourceMaterial/'.$row['source'].'.jpg';
								}
								echo "<img style = 'border-radius: 10px;' id = 'imageSourceList' src='$src' alt='Cover Image' draggable='true' ondragstart='drag(event)' if = 'drag1'>	
								<input id = 'imgPlayButtonList' onclick = \"playOrPause3('".$row['pieceID']."','".$nextPiece."',true, '', '".$vidLink."' )\" type = 'button'></input>
								<i id = '".$row['pieceID']."' class='fa fa-play soundPlayerIcon orangePlayButtonList listID' value = '".$nextPiece."'>
								<param id = '".$row['pieceID']."Next' value = '".$nextPiece."'>
								<param id = '".$row['pieceID']."Type' value = 'mp3'></i>";
							}
							
							else    //youtube
							{
								echo "<img style = 'border-radius: 10px;' id = 'imageSourceList' src='uploaded/".$row['pieceID'].".jpg' alt='Yellowest thing ever' draggable='true' ondragstart='drag(event)'>	
								<input id = 'imgPlayButtonList' onclick = \"loadVid2('".$row['pieceID']."','".$nextPiece."',true, 'none')\" type = 'button'></input>
								<i id = '".$row['pieceID']."' class='fa fa-play soundPlayerIcon orangePlayButtonList listID'>
								<param id = '".$row['pieceID']."Next' value = '".$nextPiece."'>
								<param id = '".$row['pieceID']."vidID' value = '".$row['ytID']."'>
								<param id = '".$row['pieceID']."Type' value = 'yt'></i>"; //id for next piece
							}
								
							echo "
							</div>
							</td>
							<td><span><a class = 'loader' href = 'audio?piece=".$row['pieceID']."'  style = 'color: black; text-decoration:none'>".$row['PieceName']."</a></span>
							<p><a href = 'dashboard?artist=".$row['creatorID']."' style = 'color: grey; font-size: 12px; text-decoration:none' class = 'tooltip loader'>by ".$user['userName']."<span class='tooltiptext'><img id = 'profilePicTooltip' src = 'user/".$row['creatorID']."ProfPic.jpg' alt = 'Profile Picture'><span class = 'tooltipHTMLText'>".$creatorName.": ".$creatorDesc."</span></span></a></p></td>
							<td class = 'centerTableDetails'><div style = 'color: grey; font-size: 12px'>".$row['time']."</div>
							<h2 class = 'piece-name-boxed'><textarea readonly id = 'containerDesc' style='color: grey; font-size: 15px'>".$desc."</textarea></h2>";
							
							if ($row['source'] !== '')
							{
								$info = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM source WHERE sourceID = '".$row['source']."';"));
								$filler = '';
								if ($row['type'] == '')
								{
									$filler = 'From the';
								}
								else
								{
									$filler = 'from the';
								}
								
								$userx = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id= ".$userID.";"));
								if ($userx['weebMode'] == 'true' && $info['weebSourceName'] != '')
								{
									$sourceName = $info['weebSourceName'];
								}
								else
								{
									$sourceName = $info['sourceName'];
								}
								$sourceString = "".$row['type']." ".$filler." ".$info['sourceType'].", ".$sourceName."";
								echo "<a style='color: grey; font-size: 10px; text-decoration:none; float: right' href ='source?s=".$info['sourceID']."' class = 'tooltip loader'>$sourceString
								<span class='tooltiptext'><img id = 'profilePicTooltip' src = 'sourceMaterial/".$info['sourceID'].".jpg' alt = '".$sourceName."''><span class = 'tooltipHTMLText'>".$sourceName."</span></span>
								</a>
								</td>";
							}
							echo "</td>
							<td class = 'centerTable'>".$row['listens']."</td>";
							
						if ($row['ytID'] == null && $row['vidSource'] == null)
						{
							echo "<td class = 'centerTable'><a href='uploaded/".$row['pieceID'].".mp3' download = '".$row['PieceName']."' title = 'Download'><i class='fa fa-download'></i></a>
							</td>";
						}
						else if ($row['vidSource'] != null)	//mp4
						{
							echo "<td class = 'centerTable'><a href='#' onclick = \"downloadMP4('".$row['vidLink']."')\" title = 'Download'><i class='fa fa-download'></i></a></td>";
						}
						else{
							echo "<td class = 'centerTable'><a href='#' onclick = \"downloadx('".$row['ytID']."')\" title = 'Download'><i class='fa fa-download'></i></a></td>";
						}
						
						$rows = '';
						$added = FALSE;
						if (!empty($_SESSION['userID']))
						{	
							$userID = $_SESSION['userID'];
							$userx = mysqli_query($con, "SELECT *FROM user WHERE id= ".$userID.";");
							while($resultx = mysqli_fetch_assoc($userx)) 
							{
								$rows = $resultx['saves'];
							}		
							$rowArray = explode(" ",$rows);
							foreach ($rowArray as $pieceID)
							{ 
								if ($pieceID == $row['pieceID'])
								{
									$added = TRUE;
									echo "<td class = 'centerTable'><a href='#' onmouseover = \"loadPlaylist('".$row['pieceID']."' ,this,false)\" onclick = \"save('".$row['pieceID']."','user', '".$row['pieceID']."Saved'); return false\">
											<div id = 'matchNav' class='dropdown'>
											<i id = '".$row['pieceID']."Saved' class='fa fa-check tooltip'><span class='tooltiptext'>Remove from Queue</span></i>
											
										</a><div id = 'addTo' class='dropdown-content'></div></td></tr>";
								}
							}
						}
						if ($added == FALSE)
						{
							echo "<td class = 'centerTable'><a href='#' onmouseover = \"loadPlaylist('".$row['pieceID']."' ,this,false)\" onclick = \"save('".$row['pieceID']."','user', '".$row['pieceID']."Saved'); return false\">
											<div id = 'matchNav' class='dropdown'>
											<i id = '".$row['pieceID']."Saved' class='fa fa-plus tooltip'><span class='tooltiptext'>Add to Queue</span></i>
											
										</a><div id = 'addTo' class='dropdown-content'></div></td></tr>";
						}
					}
				}
				else
				{
					$row = mysqli_fetch_assoc($result);
					$newChain = $row['nextChain'];
					$newChain = str_replace("'".$chainPiece."'","",$newChain);
					$newChain = str_replace("  "," ",$newChain);
					mysqli_query($con,"UPDATE piece SET nextChain = '".$newChain."' WHERE pieceID= '".$chainPiece."';");
				}
			}
		}
		echo "</table>
		</div><br><br><br><br><br><br><br><br>";
		?>

<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-6955123370906543",
    enable_page_level_ads: true
  });

</script>
<?php
	if (!isset($_POST['load']))
	{
		echo "</div>";	
	}
?>