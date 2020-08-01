<?php
	session_start(); 
	include_once 'dbh.inc.php';
		echo "<div class='content'>";
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
			//imagedestroy($image);
			imagedestroy($newImage);

			return true;
		}
		//resizeImage("sourceMaterial/".$info['sourceID'].".jpg", "sourceMaterial/".$info['sourceID'].".jpg", 200, 200);
	
		echo "<table>
			  <div class = 'sticky'>
				<th style = 'width: 100px'>
			<select id = 'rankingType' onchange = \"changeRanking()\">";
			
			echo "<option id = 'rankingOption' value = 'date'";
			if (isset($_SESSION['rankingType']))
			{
				if ($_SESSION['rankingType'] == 'date')
				{
					echo "selected='selected'";
				}
			}
			echo ">By Upload Date</option>";
			
			echo "<option id = 'rankingOption' value = 'trending'";
			if (isset($_SESSION['rankingType']))
			{
				if ($_SESSION['rankingType'] == 'trending')
				{
					echo "selected='selected'";
				}
			}
			echo ">By Trending</option>";
			
			echo "<option id = 'rankingOption' value = 'rank'";
			if (isset($_SESSION['rankingType']))
			{
				if ($_SESSION['rankingType'] == 'rank')
				{
					echo "selected='selected'";
				}
			}
			echo ">Hall Of Fame</option>";
			
		echo "
		</select>
		</th>
			<th class = 'centerTable' style = 'width: 60px'>Cover</th>
			<th style = 'width: 15%'>Name and Artist</th>
			<th class = 'centerTableDetails'>Details</th>
			<th class = 'centerTable'>Listens</th>
			<th class = 'centerTable'></th>
			<th class = 'centerTable'></th>
		  </div>";

		$num = 0; //num of pieces
		$piecePerPage = 25;
		$piece = array();	
		if (isset($_POST['page']))
		{
			if (!empty($_POST['page']))
			{
				$page = $_POST['page']*$piecePerPage;
			}
			else
			{
				$page = 0;
			}
		}
		else
		{
			$page = 0;
		}
		
		$searchBy = 'time';
		if (isset($_SESSION['rankingType']))
		{
			if ($_SESSION['rankingType'] == 'date')
			{
				$searchBy = 'time';
			}
			else if ($_SESSION['rankingType'] == 'trending')
			{
				$searchBy = 'listenTime/listens';
			}
			else if ($_SESSION['rankingType'] == 'rank')
			{
				$searchBy = 'listenTime';
			}
			else
			{
				$searchBy = 'listenTime/listens';
			}
		}
		$result = mysqli_query($con, "SELECT *FROM piece WHERE privacy != 'private' AND type != 'Episode' AND altID = '' ORDER BY ".$searchBy." DESC LIMIT $piecePerPage OFFSET ".$page.";"); //desc = descending 
		$resultArr = mysqli_query($con, "SELECT *FROM piece WHERE privacy != 'private' AND type != 'Episode' AND altID = '' ORDER BY ".$searchBy." DESC LIMIT $piecePerPage OFFSET ".$page.";"); //simulation list making
		if (isset($_POST['index']) && $_POST['index'] == 'seasonals')//if seasonals
		{
			$result = mysqli_query($con, "SELECT *FROM piece WHERE time BETWEEN '2018/12/25 00:00:00' AND '2019/12/31 00:00:00' AND type != 'Episode' AND altID = '' AND privacy != 'private' ORDER BY ".$searchBy." DESC LIMIT $piecePerPage OFFSET ".$page.";"); //desc = descending 
			$resultArr = mysqli_query($con, "SELECT *FROM piece WHERE time BETWEEN '2018/12/25 00:00:00' AND '2019/12/31 00:00:00' AND type != 'Episode' AND altID = '' AND privacy != 'private' ORDER BY ".$searchBy." DESC LIMIT $piecePerPage OFFSET ".$page.";"); //simulation list making
			//$resultArr = mysqli_query($con, "SELECT *FROM piece WHERE time BETWEEN '2018/09/01 00:00:00' AND '2018/12/31 00:00:00' AND privacy != 'private' ORDER BY ".$searchBy." DESC LIMIT $piecePerPage OFFSET ".$page.";"); //simulation list making
		}
		
		while($rowArr = mysqli_fetch_assoc($resultArr))
		{
			array_push($piece, $rowArr['pieceID']); 	
		}
		array_push($piece, 'end'); 	

		while($row = mysqli_fetch_assoc($result))
		{
			$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id =" .$row['creatorID'].";"));
			$num+=1;
			
			$desc = substr($row['idDescription'],0,100);
			$nextPiece = $piece[$num];
			//echo $nextPiece."||";
			
			if (strlen($desc) >= 97)//Cut off description after 97 characters FIX LATER
			{
				$desc = $desc.'...';
			}
			

			 echo 
			"<tr class>
				<td>".($num + $page)."</td>
				<td class = 'centerTable' style = 'width: 60px'>
					<div id = 'imageListWrapper'>";
				
				$userID = $_SESSION['userID'];
				$userx  = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id= ".$userID.";"));
				
				if ($row['shortVersion'] != '' && $userx['disableShortVersion'] != 'true')//Short version available
				{
					echo "<img style = 'border-radius: 10px;' id = 'imageSourceList' src='uploaded/".$row['pieceID'].".jpg' alt='Cover Image' draggable='true' ondragstart='drag(event)' id = 'drag1'>	
					<input id = 'imgPlayButtonList' onclick = \"loadVid2('".$row['pieceID']."','".$nextPiece."',true, 'soundarray')\" type = 'button'></input>
					<i id = '".$row['pieceID']."' class='fa fa-play soundPlayerIcon orangePlayButtonList listID'>
					<param id = '".$row['pieceID']."Next' value = '".$nextPiece."'>
					<param id = '".$row['pieceID']."vidID' value = '".$row['shortVersion']."'>
					<param id = '".$row['pieceID']."Type' value = 'yt'></i>	
					"; //id for next piece
				}
				else if ($row['ytID'] == null && $row['vidSource'] == null)	//mp3
				{
					echo "<img style = 'border-radius: 10px;' id = 'imageSourceList' src='uploaded/".$row['pieceID'].".jpg' alt='Cover Image' draggable='true' ondragstart='drag(event)' if = 'drag1'>	
					<input id = 'imgPlayButtonList' onclick = \"playOrPause2('".$row['pieceID']."','".$nextPiece."',true, 'sounrarray','')\" type = 'button'></input>
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
					if ($song['thumbnailSource'] != null)
					{
						$src = $song['thumbnailSource'];
					}
					else
					{
						$src = 'sourceMaterial/'.$song['source'].'.jpg';
					}
					echo "<img style = 'border-radius: 10px;' id = 'imageSourceList' src='$src' alt='Cover Image' draggable='true' ondragstart='drag(event)' if = 'drag1'>	
					<input id = 'imgPlayButtonList' onclick = \"playOrPause3('".$row['pieceID']."','".$nextPiece."',true, '', '".$vidLink."' )\" type = 'button'></input>
					<i id = '".$row['pieceID']."' class='fa fa-play soundPlayerIcon orangePlayButtonList listID' value = '".$nextPiece."'>
					<param id = '".$row['pieceID']."Next' value = '".$nextPiece."'>
					<param id = '".$row['pieceID']."Type' value = 'mp3'></i>";
				}
				else    //youtube
				{
					echo "<img style = 'border-radius: 10px;' id = 'imageSourceList' src='uploaded/".$row['pieceID'].".jpg' alt='Cover Image' draggable='true' ondragstart='drag(event)' id = 'drag1'>	
					<input id = 'imgPlayButtonList' onclick = \"loadVid2('".$row['pieceID']."','".$nextPiece."',true, 'soundarray','')\" type = 'button'></input>
					<i id = '".$row['pieceID']."' class='fa fa-play soundPlayerIcon orangePlayButtonList listID'>
					<param id = '".$row['pieceID']."Next' value = '".$nextPiece."'>
					<param id = '".$row['pieceID']."vidID' value = '".$row['ytID']."'>
					<param id = '".$row['pieceID']."Type' value = 'yt'></i>	
					"; //id for next piece
				}
					
				echo "</div>
					</td>
					<td style = 'width: 15%'><span><h2 class = 'piece-name'><a class = 'loader' href = 'audio?piece=".$row['pieceID']."' title = '".$row['PieceName']."' style = 'color: black; text-decoration:none'>".$row['PieceName']."</a></h2></span>
					<p><a href = 'dashboard?artist=".$row['creatorID']."' title = '".$user['userName']."'s Page' style = 'color: grey; font-size: 12px; text-decoration:none' class = 'tooltip loader'>by ".$user['userName']."<span class='tooltiptext'><img id = 'profilePicTooltip' src = 'user/".$row['creatorID']."ProfPic.jpg' alt='Profile Image'><span class = 'tooltipHTMLText'>".$user['userName'].": ".$user['description']."</span></a></p></td>
					<td class = 'centerTableDetails'><div style = 'color: grey; font-size: 12px'>".$row['time']."</div>
					<textarea readonly id = 'containerDesc' style='color: grey; font-size: 15px'>".$desc."</textarea>";
												
				if ($row['source'] != '')
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
					
					if ($userx['weebMode'] == 'true' && $info['weebSourceName'] != '')
					{
						$sourceName = $info['weebSourceName'];
					}
					else
					{
						$sourceName = $info['sourceName'];
					}
					
					//$weebName = get_title("https://myanimelist.net/anime/".$info['mal']);
					//mysqli_query($con, "UPDATE source SET weebSourceName = '".$weebName."' WHERE sourceID = '".$info['sourceID']."';");
					
					$sourceString = "".$row['type']." ".$filler." ".$info['sourceType'].", ".$sourceName."";
					echo "<a style='color: grey; font-size: 10px; text-decoration:none; float: right' href ='source?s=".$info['sourceID']."' title = '".$sourceName."' class = 'tooltip loader'>$sourceString
					<span class='tooltiptext'><img id = 'profilePicTooltip' src = 'sourceMaterial/".$info['sourceID'].".jpg' alt='Anime Cover Image'><span class = 'tooltipHTMLText'>".$sourceName."</span></span>
					</a>
					</td>";
					
				}
				echo "<td class = 'centerTable'>".$row['listens']."</td>";
				
				if ($row['ytID'] == null)
				{
					echo "<td class = 'centerTable'><a href='uploaded/".$row['pieceID'].".mp3' title = 'Download' download = '".$row['PieceName']."'><i class='fa fa-download'></i></a></td>";
				}
				else{
					echo "<td class = 'centerTable'><a href='#' onclick = \"downloadx('".$row['ytID']."')\" 'Download'><i class='fa fa-download'></i></a></td>";
				}
				
				$songs = '';
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
						if ($pieceID == $row['pieceID'])
						{
							$added = TRUE;
							echo "<td class = 'centerTable'>
									<a onmouseover = \"loadPlaylist('".$row['pieceID']."' ,this, false)\" onclick = \"save('".$row['pieceID']."','user', '".$row['pieceID']."Saved'); return false\" title = 'Playlist'>
										<div id = 'matchNav' class='saveDropdown'>
										<i id = '".$row['pieceID']."Saved' class='fa fa-check tooltip'><span class='tooltiptext'>Remove from Queue</span></i>
										
									</a><div id = 'addTo' class='dropdown-content'></div>
								</td></tr>";
						}
					}
				}
				if ($added == FALSE)
				{
					echo "<td class = 'centerTable'>
							<a onmouseover = \"loadPlaylist('".$row['pieceID']."' ,this, false)\" onclick = \"save('".$row['pieceID']."','user', '".$row['pieceID']."Saved'); return false\">
								<div id = 'matchNav' class='saveDropdown'>
								<i id = '".$row['pieceID']."Saved' class='fa fa-plus tooltip'><span class='tooltiptext'>Add to Queue</span></i>
								
							</a><div id = 'addTo' class='dropdown-content'></div>
				</td></tr>";	
				}
		}

		echo "</table>";
				//include_once 'animelist.php';
				echo "</div>
					
						<br><br><br><br><br>";
						session_write_close();
		?>


				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
