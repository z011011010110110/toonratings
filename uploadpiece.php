<?php
	session_start(); 
	if (!isset($_POST['load']))
	{
		include_once 'home.php';
		echo "<div id = 'content'>";
	}
	
	include_once 'dbh.inc.php';
	if (!empty($_SESSION['userID']))
	{
		$userID = $_SESSION['userID'];
		$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id= ".$userID.";"));
		echo "<div id = 'mp3OrYt'>
			<button id = 'chooseMp3' class = 'mp3OrYtButton'>Upload from file</button>
			<button id = 'chooseYt' class = 'mp3OrYtButton' style = '".$user['id']."'>Upload from Youtube</button>
			</div>";
			echo "<title>Upload Your Piece</title>
				<meta name = 'description' content = 'Upload your music'></meta>";
			if ($user['admin'] == 1)
			{
				echo "<div id = 'setMid'><div class='search-container'>
						<select style = 'visibility: hidden; position: absolute' id = 'searchThisx' class = 'searchDropdown'>
						  <option id = 'searchOption' value='artists'>&nbsp;&nbsp;Artists</option>
						</select>
						<div id = 'searchBox'>
							<input id = 'creatorIDValue' name = 'creatorIDValue' type = 'hidden'>
							<input style = 'width: 300px;' id = 'searchWhatx' type='text' placeholder='Search for artist...' name='search' autocomplete='off'>
							<i onclick = \"customArtist()\" style = 'position: relative;font-size: 19px;' class='fa fa-plus'></i>
							<div id = 'rightUnderSearchBarx'></div></input>		
					</div></div>						
						</div>
							<div id='imgCreatorContainer' style = 'width: 100px; height: auto; display: none;'>
								
								<p id = 'userName'  username-editable onchange = \"updateUserName(this)\"></p>

								<div class='imgContainer'>
									<img style = 'border-radius: 10px;' id = 'imageCreatorSource' name = 'imageSource' src='yellow.jpg' alt='Empty Cover' draggable='true' ondragstart='drag(event)' id='drag1'/>	
									<font id = 'imageSourceText'>Drag and Drop Image Here...</font>
									<input class='imageSourceFile btn btn-primary' type='file' name = 'imageProfPicFile' accept='image/*,.bin' onchange = 'readUserIURL(this)'/>
								</div>

								
							
							</div>

							<div id = 'setMid'><div class='search-container'><div id = 'searchBox'>
								<input id = 'sourceIDValue' name = 'sourceIDValue' type = 'hidden'>
								<input style = 'width: 300px;' id = 'searchWhatSource' type='text' placeholder='Search for source...' name='search' autocomplete='off'>
								<i onclick = \"customSource()\" style = 'position: relative;font-size: 19px;' class='fa fa-plus'></i>
								<div id = 'rightUnderSearchBarxx'></div></input>		
							</div></div></div>
						
							<div id = 'imgSourceContainerMid' style = 'display: none'><div class='search-container'><div id = 'searchBox'>
								<input id = 'parentSourceIDValue' name = 'parentSourceIDValue' type = 'hidden'>
								<input style = 'width: 300px;' id = 'searchWhatParentSource' type='text' placeholder='Search for parent source...' name='search' autocomplete='off'>
								<i onclick = \"setParentSource('','')\" style = 'position: relative;font-size: 19px;' class='fa fa-times-circle'></i>
								<div id = 'rightUnderSearchBarxxx'></div></input>
							</div></div></div>
							
							<div id='imgSourceContainer' style = 'width: 100px; height: auto; display: none;'>
								<select style = 'position: relative' id = 'sourceType' class = 'searchDropdown' onchange = \"updateSource(this)\">
									<option id = 'searchOption' value='all'>&nbsp;&nbsp;All</option>
									<option id = 'searchOption' value='singles'>&nbsp;&nbsp;Singles</option>
									<option id = 'searchOption' value='anime'>&nbsp;&nbsp;Anime</option>
									<option id = 'searchOption' value='games'>&nbsp;&nbsp;Games</option>
									<option id = 'searchOption' value='cartoon'>&nbsp;&nbsp;Cartoons</option>
									<option id = 'searchOption' value='movie'>&nbsp;&nbsp;Movies</option>
								  <option id = 'searchOption' value='tv'>&nbsp;&nbsp;TV Shows</option>
								</select>
								
								<input id = 'mal' type = 'text' onchange = \"updateSource(this)\"></input>
								<div class='imgContainer'>
									<img style = 'border-radius: 10px;' id = 'imageSourceSource' name = 'imageSource' src='yellow.jpg' alt='Empty Cover' draggable='true' ondragstart='drag(event)' id='drag1'/>	
									<font id = 'imageSourceText'>Drag and Drop Image Here...</font>
									<input class='imageSourceFile btn btn-primary' type='file' name = 'imageSourceFile' accept='image/*,.bin' onchange = 'readSourceIURL(this)'/>
								</div>

							</div>
					
						<input id = 'dateSet' name = 'dateSet' type='date' value='".date("Y-m-d")."'>
						<select id = 'pieceType' class = 'center' onchange = \"updateSource(this)\">
							<option id = 'searchOption' value=''>&nbsp;&nbsp;Single</option>
							<option id = 'searchOption' value='Opening'>&nbsp;&nbsp;Opening</option>
							<option id = 'searchOption' value='Ending'>&nbsp;&nbsp;Ending</option>
							<option id = 'searchOption' value='OST'>&nbsp;&nbsp;OST</option>
						</select>";
			}
				echo "<div class='responsiveUpload'>
					<div class='gallery' ondrop='drop(event)'>
						<div class='desc'>
							<div class = 'pieceName'>
								<input style = 'display:none' id = 'pieceName' name = 'pieceName'/>
								<p class = 'pieceNameText'  title-editable>Input Title Here:</p>
							</div>
							<div class='imgContainer'>
								<img style = 'border-radius: 10px;' id = 'imageSource' name = 'imageSource' src='yellow.jpg' alt='Yellowest thing ever' draggable='true' ondragstart='drag(event)' id='drag1'/>	
								<font id = 'imageSourceText'>Drag and Drop Image Here...</font>
								<input id = 'imageFile' class='imageSourceFile btn btn-primary' type='file' name = 'imageSourceFile' accept='image/*,.bin' onchange = 'readIURL(this)'/>
							</div>
						</div>
					</div>
				</div>

				<br>

				
				<div id = 'setMid' style = 'width: 350px'>
					<span style = 'margin: auto; text-align: center;'>This is a cover or an alternative version.</span>
					<label class='switch' style = 'float:right'>
						<input id = 'altCheck' onchange = \"altSearchDisplay(this)\" type='checkbox'>
						<span class='boolSlider round'></span>
					</label>
				</div>
				
				<div id = 'altSearch' style = 'display: none'>
					<div class='alt-container'>
						<div id = 'searchBox'>
							<input id = 'altIDValue' name = 'altIDValue' type = 'hidden'>
							<input style = 'width: 250px;' id = 'searchWhatAlt' type='text' placeholder='Search for parent song...' name='search' autocomplete='off'>
							<i onclick = \"setAlt('','')\" style = 'position: relative;font-size: 19px;' class='fa fa-times-circle'></i>
							<div id = 'rightUnderSearchBarxxxx'></div></input>		
						</div>
					</div>
				</div>
				
				<br>
				<div id = 'container2'>
					<textarea style = 'font-family:verdana;' id = 'container2Text' name = 'container2Text' rows='4' placeholder='Enter description here...'></textarea>
				</div>
				<br>
				<div id = 'whatToUpload'>
					<br>
					<div id = 'mp3Container'>
						<div class='upload-btn-wrapper' align = 'middle'>	
							<div class='imgDrag'>
								<font  id = 'uploadFileText'  class = 'uploadFileText'  color = 'grey' >Drag sound files here...</font>
							</div>
							<input id = 'uploadData' class = 'uploadImage' name  = 'soundSourceFile' type = 'file' accept='.mp3,audio/*' onchange='readSURL(this)'></input>
						</div>
						<input id = 'mp3Upload' onclick = \"uploadIt('mp3',this)\" type = 'submit' name = 'Upload' value = 'Upload'></input>
						<br><progress id='progressBar'value='0' max='100' style='width:300px;'></progress></p>
						<h3 id='status'></h3>
						<p id='loaded_n_total'>
					</div>
					
					<div id = 'ytContainer'>
						<input id = 'ytURL' type = 'text' placeholder = 'Enter Youtube URL here...' name = 'ytURLS'></input>
						<input id = 'ytUpload' onclick = \"uploadIt('yt',this)\" type = 'submit' name = 'YTUpload' value = 'Upload from Youtube'></input>	
					</div>
				</div>
				<div id = 'uploadedTag' style = 'font-family:Arial, sans-serif; font-size: 15px; opacity:0';></div>";
	}
	else
	{
		echo "<div id = 'pleaseLogIn'>Please log in before you upload</div>";
	}
	echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>	";
	if (!isset($_POST['load']))
	{
		echo "</div>";
	}
?>	
<script>
	function altSearchDisplay(event)
	{
		if (event.checked)
		{
			document.getElementById('altSearch').style.display = '';
		}
		else
		{
			document.getElementById('altSearch').style.display = 'none';
		}
	}


	function uploadIt($uploadWhat, input)
	{
		if ($status == 'empty')
		{
			$status = 'uploading';
			var xhttp = new XMLHttpRequest();
			var formData = new FormData();
			if (document.getElementById("dateSet"))
			{
				formData.append("dateSet", document.getElementById('dateSet').value);
			}
			if (document.getElementById("sourceIDValue"))
			{
				formData.append("sourceIDValue", document.getElementById('sourceIDValue').value);
			}
			if (document.getElementById("creatorIDValue"))
			{
				formData.append("creatorIDValue", document.getElementById('creatorIDValue').value);
			}
			if (document.getElementById("pieceType"))
			{
				formData.append("pieceType", document.getElementById('pieceType').value);
			}
			if (document.getElementById("altIDValue"))
			{
				formData.append("altIDValue", document.getElementById('altIDValue').value);
			}
			formData.append("pieceName", document.getElementById('pieceName').value);
			
			formData.append("container2Text", document.getElementById('container2Text').value);
			
			formData.append("imageSourceFile", document.getElementById('imageFile').files[0]);
			
			if ($uploadWhat == 'mp3')
			{
				formData.append("soundSourceFile", document.getElementById('uploadData').files[0]);
				formData.append("Upload", 'a');
				
				xhttp.upload.addEventListener("progress", progressHandler, false);
				xhttp.addEventListener("load", completeHandler, false);
				xhttp.addEventListener("error", errorHandler, false);
				xhttp.addEventListener("abort", abortHandler, false);
			}
			else if ($uploadWhat == 'yt')
			{
				formData.append("ytURLS", document.getElementById('ytURL').value);
				formData.append("YTUpload", 'a');
			}
			
			xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
					setTimeout(function () {
						document.getElementById('uploadedTag').innerHTML = 'Uploaded';
						document.getElementById('uploadedTag').style.color = 'green';
						document.getElementById('uploadedTag').style.transition = '0.3s';
						document.getElementById('uploadedTag').style.opacity= '1';
					}, 100);		
					setTimeout(function () {
						document.getElementById('uploadedTag').style.transition = '0.3s';
						document.getElementById('uploadedTag').style.opacity= '0';
						document.getElementById('pieceName').value = '';
						document.getElementById('ytURL').value = '';
						$status = 'empty';
					}, 2000);
				}
			};
			xhttp.open("POST", "upload.php");
			
			
			
			if (document.getElementById('ytURL').value.includes('?v=') && $uploadWhat == 'yt')
			{
				xhttp.send(formData);
			}
			else if (document.getElementById('uploadData').files[0] && $uploadWhat == 'mp3')
			{
				xhttp.send(formData);
			}
			else
			{
				alert("You're not uploading anything.");
				$status = 'empty';
			}
		}
		else 
		{
			alert('Please wait until it is done uploading...');
		}
	}

	if (document.getElementById("searchWhatx"))
	{
		autocomplete2(document.getElementById("searchWhatx"));
	}
	if (document.getElementById("searchWhatSource"))
	{
		autocomplete3(document.getElementById("searchWhatSource"));
	}
	if (document.getElementById("searchWhatParentSource"))
	{
		autocomplete4(document.getElementById("searchWhatParentSource"));
	}
	if (document.getElementById("searchWhatAlt"))
	{
		autocomplete5(document.getElementById("searchWhatAlt"));
	}
	function customArtist()
	{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			setValue(this.responseText,document.getElementById("searchWhatx").value);
			}
		};
		xhttp.open("POST", "custom_artist.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("customArtistUsername="+document.getElementById('searchWhatx').value);
	}
	function customSource()
	{
		var xhttp = new XMLHttpRequest();
		$sourceName = document.getElementById('searchWhatSource').value;
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			$newPieceID = this.responseText.replace(/\s/g,'');
			setSourceValue($newPieceID,$sourceName, '', '');
			}
		};
		xhttp.open("POST", "custom_artist.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("sourceName="+$sourceName+"&sourceType="+document.getElementById('sourceType').value);
	}
	function setParentSource($parentSourceID, $name)
	{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById('searchWhatParentSource').value = $name;
			}
		};
		xhttp.open("POST", "custom_artist.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("parentSourceID="+$parentSourceID+"&sourceID="+document.getElementById('sourceIDValue').value);
	}
	function setAlt($parentSourceID,$name)
	{
		document.getElementById("altIDValue").value = $parentSourceID;
		document.getElementById("searchWhatAlt").value = $name;
	}
	function updateSource(e)
	{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			}
		};
		xhttp.open("POST", "custom_artist.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		if (e.id == 'mal')
		{	
			xhttp.send("sourceID="+document.getElementById('sourceIDValue').value+"&mal="+document.getElementById('mal').value);
		}
		if (e.id == 'sourceType')
		{
			xhttp.send("sourceID="+document.getElementById('sourceIDValue').value+"&sourceType="+document.getElementById('sourceType').value);
		}		
	}

	function setValue($creatorID,$creatorUsername)
	{
		document.getElementById("imgCreatorContainer").style.display = 'block';
		document.getElementById("imageCreatorSource").src = "user/"+$creatorID+"ProfPic.jpg";
		document.getElementById("searchWhatx").value = $creatorUsername;
		document.getElementById("userName").innerHTML = $creatorUsername;
		document.getElementById("creatorIDValue").value = $creatorID;
	}
	function setSourceValue($sourceID,$sourceName, $sourceType, $mal, $parentSource)
	{
		document.getElementById("imgSourceContainer").style.display = 'block';
		document.getElementById("imgSourceContainerMid").style.display = 'flex';
		
		document.getElementById("searchWhatSource").value = $sourceName;
		document.getElementById("sourceIDValue").value = $sourceID;
		document.getElementById("imageSourceSource").src = "sourceMaterial/"+$sourceID+".jpg";
		document.getElementById("sourceType").value = $sourceType;
		document.getElementById("mal").value = $mal;
		document.getElementById("searchWhatParentSource").value = $parentSource;
	}
	function autocomplete2(input) {
		var currentFocus;
		input.addEventListener("input", function(e) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("searchWhatxAutocomplete-list").innerHTML = this.responseText;
			}
		};

		xhttp.open("POST", "search_bar.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("input="+document.getElementById('searchWhatx').value+"&searchThis=artist&getValue=artistValue");

		
		var a, b, i, img, val = this.value;
		closeAllLists();
		if (!val) { return false;}
		currentFocus = -1;
		a = document.createElement("div");
		a.setAttribute("id", this.id + "Autocomplete-list");
		a.setAttribute("class", "autocomplete-items");
		document.getElementById("rightUnderSearchBarx").appendChild(a);
			
	});
	
	 input.addEventListener("keydown", function(e) {
	  var x = document.getElementById(this.id + "Autocomplete-list");
	  if (x) x = x.getElementsByTagName("div");
	  if (e.keyCode == 40) {//down arrow
		currentFocus++;
		addActive(x);
	  } 
	  else if (e.keyCode == 38) { //up arrow
		currentFocus--;
		addActive(x);
	  } 
	  else if (e.keyCode == 13) {//enter

		if (currentFocus > -1) {
			
			e.preventDefault();
		  if (x) x[currentFocus].click();
		  currentFocus = -1;
		}

	  }
	  else if (e.keyCode == 27) { //esc arrow
	   document.getElementById('searchWhatx').value = '';
	   closeAllLists();
	  }
  });
	function addActive(x) {
	if (!x) return false;
	removeActive(x);
	if (currentFocus >= x.length) currentFocus = 0;
	if (currentFocus < 0) currentFocus = (x.length - 1);
	x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
	for (var i = 0; i < x.length; i++) {
	  x[i].classList.remove("autocomplete-active");
	}
  }
  function closeAllLists(elmnt) {
	var x = document.getElementsByClassName("autocomplete-items");
	for (var i = 0; i < x.length; i++) {
	  if (elmnt != x[i] && elmnt != input) {
		x[i].parentNode.removeChild(x[i]);
	  }
	}
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
	  closeAllLists(e.target);
	  });
}

	function autocomplete3(input) {
		var currentFocus;
		input.addEventListener("input", function(e) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("searchWhatSourceAutocomplete-list").innerHTML = this.responseText;
			}
		};

		xhttp.open("POST", "search_bar.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("input="+document.getElementById('searchWhatSource').value+"&searchThis=source&getValue=sourceValue");

		
		var a, b, i, img, val = this.value;
		closeAllLists();
		if (!val) { return false;}
		currentFocus = -1;
		a = document.createElement("div");
		a.setAttribute("id", this.id + "Autocomplete-list");
		a.setAttribute("class", "autocomplete-items");
		document.getElementById("rightUnderSearchBarxx").appendChild(a);
			
		});

		input.addEventListener("keydown", function(e) {
			var x = document.getElementById(this.id + "Autocomplete-list");
			if (x) x = x.getElementsByTagName("div");
			if (e.keyCode == 40) {//down arrow
				currentFocus++;
				addActive(x);
			} 
			else if (e.keyCode == 38) { //up arrow
				currentFocus--;
				addActive(x);
			} 
			else if (e.keyCode == 13) {//enter
				if (currentFocus > -1) {
					e.preventDefault();
					if (x) x[currentFocus].click();
					currentFocus = -1;
				}
			}
			else if (e.keyCode == 27) { //esc arrow
				document.getElementById('searchWhatSource').value = '';
				closeAllLists();
			}
		});
		function addActive(x) {
		if (!x) return false;
		removeActive(x);
		if (currentFocus >= x.length) currentFocus = 0;
		if (currentFocus < 0) currentFocus = (x.length - 1);
			x[currentFocus].classList.add("autocomplete-active");
		}
		function removeActive(x) {
		for (var i = 0; i < x.length; i++) {
			x[i].classList.remove("autocomplete-active");
		}
		}
		function closeAllLists(elmnt) {
			var x = document.getElementsByClassName("autocomplete-items");
			for (var i = 0; i < x.length; i++) {
				if (elmnt != x[i] && elmnt != input) {
					x[i].parentNode.removeChild(x[i]);
				}
			}
		}
		/*execute a function when someone clicks in the document:*/
		document.addEventListener("click", function (e) {
		closeAllLists(e.target);
		});
	}
	function autocomplete4(input) {
		var currentFocus;
		input.addEventListener("input", function(e) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("searchWhatParentSourceAutocomplete-list").innerHTML = this.responseText;
			}
		};

		xhttp.open("POST", "search_bar.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("input="+document.getElementById('searchWhatParentSource').value+"&searchThis=source&getValue=parentSourceValue");

		
		var a, b, i, img, val = this.value;
		closeAllLists();
		if (!val) { return false;}
		currentFocus = -1;
		a = document.createElement("div");
		a.setAttribute("id", this.id + "Autocomplete-list");
		a.setAttribute("class", "autocomplete-items");
		document.getElementById("rightUnderSearchBarxxx").appendChild(a);
			
		});

		input.addEventListener("keydown", function(e) {
			var x = document.getElementById(this.id + "Autocomplete-list");
			if (x) x = x.getElementsByTagName("div");
			if (e.keyCode == 40) {//down arrow
				currentFocus++;
				addActive(x);
			} 
			else if (e.keyCode == 38) { //up arrow
				currentFocus--;
				addActive(x);
			} 
			else if (e.keyCode == 13) {//enter
				if (currentFocus > -1) {
					e.preventDefault();
					if (x) x[currentFocus].click();
					currentFocus = -1;
				}
			}
			else if (e.keyCode == 27) { //esc arrow
				document.getElementById('searchWhatParentSource').value = '';
				closeAllLists();
			}
		});
		function addActive(x) {
		if (!x) return false;
		removeActive(x);
		if (currentFocus >= x.length) currentFocus = 0;
		if (currentFocus < 0) currentFocus = (x.length - 1);
			x[currentFocus].classList.add("autocomplete-active");
		}
		function removeActive(x) {
		for (var i = 0; i < x.length; i++) {
			x[i].classList.remove("autocomplete-active");
		}
		}
		function closeAllLists(elmnt) {
			var x = document.getElementsByClassName("autocomplete-items");
			for (var i = 0; i < x.length; i++) {
				if (elmnt != x[i] && elmnt != input) {
					x[i].parentNode.removeChild(x[i]);
				}
			}
		}
		/*execute a function when someone clicks in the document:*/
		document.addEventListener("click", function (e) {
		closeAllLists(e.target);
		});
	}
	function autocomplete5(input) {
		var currentFocus;
		input.addEventListener("input", function(e) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("searchWhatAltAutocomplete-list").innerHTML = this.responseText;
			}
		};

		xhttp.open("POST", "search_bar.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("input="+document.getElementById('searchWhatAlt').value+"&searchThis=alt");
		
		var a, b, i, img, val = this.value;
		closeAllLists();
		if (!val) { return false;}
		currentFocus = -1;
		a = document.createElement("div");
		a.setAttribute("id", this.id + "Autocomplete-list");
		a.setAttribute("class", "autocomplete-items");
		document.getElementById("rightUnderSearchBarxxxx").appendChild(a);
			
		});

		input.addEventListener("keydown", function(e) {
			var x = document.getElementById(this.id + "Autocomplete-list");
			if (x) x = x.getElementsByTagName("div");
			if (e.keyCode == 40) {//down arrow
				currentFocus++;
				addActive(x);
			} 
			else if (e.keyCode == 38) { //up arrow
				currentFocus--;
				addActive(x);
			} 
			else if (e.keyCode == 13) {//enter
				if (currentFocus > -1) {
					e.preventDefault();
					if (x) x[currentFocus].click();
					currentFocus = -1;
				}
			}
			else if (e.keyCode == 27) { //esc arrow
				document.getElementById('searchWhatAlt').value = '';
				closeAllLists();
			}
		});
		function addActive(x) {
		if (!x) return false;
		removeActive(x);
		if (currentFocus >= x.length) currentFocus = 0;
		if (currentFocus < 0) currentFocus = (x.length - 1);
			x[currentFocus].classList.add("autocomplete-active");
		}
		function removeActive(x) {
		for (var i = 0; i < x.length; i++) {
			x[i].classList.remove("autocomplete-active");
		}
		}
		function closeAllLists(elmnt) {
			var x = document.getElementsByClassName("autocomplete-items");
			for (var i = 0; i < x.length; i++) {
				if (elmnt != x[i] && elmnt != input) {
					x[i].parentNode.removeChild(x[i]);
				}
			}
		}
		/*execute a function when someone clicks in the document:*/
		document.addEventListener("click", function (e) {
		closeAllLists(e.target);
		});
	}
		  
	window.onload = document.getElementById('ytContainer').style = 'display: none;';
	
	var header = document.getElementById("mp3OrYt");
	var btns = header.getElementsByClassName("mp3OrYtButton");
	btns[0].className += " MOYActive";
	for (var i = 0; i < btns.length; i++) {
	  btns[i].addEventListener("click", function() {
		var current = document.getElementsByClassName("MOYActive");
		current[0].className = current[0].className.replace("MOYActive", "");
		this.className += " MOYActive";
		if (this.id == 'chooseMp3')
		{
			document.getElementById('ytContainer').style = 'display: none;';
			document.getElementById('mp3Container').style = 'display: initial;';

		}
		else if (this.id == 'chooseYt')
		{
			document.getElementById('mp3Container').style = 'display: none;';
			document.getElementById('ytContainer').style = 'display: initial;';
		}
		
	  });
	}


	var mouseDown = false;

	$(document).delegate('#container2Text', 'keydown', function(e) {
	  var keyCode = e.keyCode || e.which;

	  if (keyCode == 9) {
		e.preventDefault();
		var start = this.selectionStart;
		var end = this.selectionEnd;

		// set textarea value to: text before caret + tab + text after caret
		$(this).val($(this).val().substring(0, start)
					+ "\t"
					+ $(this).val().substring(end));

		// put caret at right position again
		this.selectionStart =
		this.selectionEnd = start + 1;
	  }
	});
	function readIURL(input) 
	{
		if (input.files && input.files[0] && Validate(input) == "image") 
		{
			var reader = new FileReader();

			reader.onload = function (e) {
				e.preventDefault();
				$('#imageSource').attr('src', e.target.result)
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	function readUserIURL(input) 
	{
		if (input.files && input.files[0] && Validate(input) == "image") 
		{
			var reader = new FileReader();

			reader.onload = function (e) {
				e.preventDefault();
				$('#imageCreatorSource').attr('src', e.target.result)
			};
			reader.readAsDataURL(input.files[0]);
		}
		
		var formData = new FormData();
		formData.append("sourceFile", input.files[0]);
		formData.append("creatorID", document.getElementById('creatorIDValue').value);
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "uploadSourceImage.php");
		xhttp.send(formData);
		
	}
	
	function readSourceIURL(input) 
	{
		if (input.files && input.files[0] && Validate(input) == "image") 
		{
			var reader = new FileReader();

			reader.onload = function (e) {
				e.preventDefault();
				$('#imageSourceSource').attr('src', e.target.result)
			};
			reader.readAsDataURL(input.files[0]);
		}
		
		var formData = new FormData();
		formData.append("sourceFile", input.files[0]);
		formData.append("sourceID", document.getElementById('sourceIDValue').value);
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "uploadSourceImage.php");
		xhttp.send(formData);
		
	}
	function readSURL(input) 
	{
		if (input.files && input.files[0] && Validate(input) == "sound" ) 
		{
			document.getElementById("uploadFileText").innerHTML = "Uploading...";
			var reader = new FileReader();

			reader.onload = function (e) {

				e.preventDefault();
				$('#currentTrack').attr('src', e.target.result)
				document.getElementById("uploadFileText").innerHTML = "Uploaded " ;
				document.getElementById("currentTrack").load();
			};
			reader.readAsDataURL(input.files[0]);
		}
		else {
			alert("Please upload sound files only!");
		}
	}

	defaultBar = document.getElementById("sliderBar");
	
	$('body').on('click', '[username-editable]', function(){
		var $el = $(this);
		$previousValue = document.getElementById('userName').innerHTML;
		var $input = $("<input id = 'userName' type = 'text'/>").val($previousValue);
		$el.replaceWith( $input );
		  
		var save = function()
		{
			if ($input.val().trim() == "" )
			{
				var $p = $('<p id = "userName" username-editable />').text($previousValue);
				document.getElementById('userName').value = $previousValue;
			}
			else
			{
				var $p = $('<p id = "userName" username-editable />').text( $input.val() );	
				document.getElementById('userName').value = $input.val();
				//alert($input.val());
				
				var xhttp = new XMLHttpRequest();
				xhttp.open("POST", "update_data.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("changeWhat=username&id="+document.getElementById("creatorIDValue").value+"&value="+$input.val());
				xhttp.onreadystatechange = function() {
			};
				updateDatax('userName',$input.val());
			}
			
			$input.replaceWith( $p );
		};
		$input.one('blur', save).focus();
	});
									
									
	$('body').on('click', '[title-editable]', function(){
	var $el = $(this);
	$previousValue = document.getElementById('pieceName').value;
	var $input = $('<input class = "pieceNameText" />').val($previousValue);
	$el.replaceWith( $input );
	  
	  var save = function()
	  {
		if ($input.val().trim() == "" )
		{
			if ($previousValue == '')
			{
				var $p = $('<p class = "pieceNameText" title-editable />').text("Input Title Here:");
			}
			else
			{
				var $p = $('<p class = "pieceNameText" title-editable />').text($previousValue);
			}
			document.getElementById('pieceName').value = $previousValue;
		}
		else
		{
			var $p = $('<p class = "pieceNameText" title-editable />').text( $input.val() );	
			document.getElementById('pieceName').value = $input.val();
		}
		
		$input.replaceWith( $p );
		};
		$input.one('blur', save).focus();
	});
</script>
