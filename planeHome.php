
<!--<link rel="icon" href="https://soundabox.com/soundabox.png"></link>-->
<html lang="en">
<?php
	session_start(); 
	include_once 'dbh.inc.php';
	$included = true;

?>
	<link href="all.min.css" rel="stylesheet">
	<style>
    .newFare
    {
        padding: 10px;
    }
	textarea
	{
		background-color: transparent;
	}
	.spinner {
		margin-right: 10px;
		border: 5px solid #f3f3f3;
		border-top: 5px solid orange;
		border-radius: 50%;
		width: 20px;
		height: 20px;
		-webkit-animation: spin 2s linear infinite; /* Safari */
		animation: spin 2s linear infinite;
	}

	.fileDiv {
		overflow: auto;
		white-space: nowrap;
		align-items: center;
		margin: 50px auto 10px auto;
		min-width: 500px;
		max-width: 1200px;
		color: orange;
	}
	.fileDiv a{
		position: relative;
		z-index: 1;
	}

	.fa-check
	{
		color: Chartreuse ;
	}
	.fa-check:hover
	{
		color: red;
	}
	.fa-plus
	{
		color: grey;
	}
	.fa-plus:hover
	{
		color: orange;
	}
	.fa-arrow-down
	{
		color: grey;
	}
	.fa-arrow-down:hover
	{
		color: orange;
	}
	.playlistIcon
	{
		border:none;
		float: right;
	}
	.createPlaylist
	{
		border:none;
		margin: 2px 2px 2px 2px;
		width: 75%;
	}

	
	@keyframes shake 
	{
		10%, 90% {
			transform: translate3d(-1px, 0, 0);
		}

		20%, 80% {
			transform: translate3d(2px, 0, 0);
		}

		30%, 50%, 70% {
			transform: translate3d(-4px, 0, 0);
		}

		40%, 60% {
			transform: translate3d(4px, 0, 0);
		}
	}
	.saveButton:hover
	{
		transition: 0.2s;
		color: black;
		background-color: orange;
		animation: none;
	}
	#settings
	{
		margin-left: auto;
		margin-right: auto;
		padding: 0px;
		margin-top: 3%; 
		width: 30%;
	}
	#mp3OrYt
	{
		margin-left: auto;
		margin-right: auto;
		display: flex;
		justify-content: center;
	}
	.mp3OrYtButton{
    background-color: #e9e9e9;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
	}
	.MOYActive, .mp3OrYtButton:hover
	{
		color: black;
		background-color: orange;
	}
	

	#whatToUpload
	{
		position: relative;
		margin-left: auto;
		margin-right: auto;
		display: flex;
		justify-content: center;
		height: 100px;
	}
	#setMid, #imgSourceContainerMid, #altSearch
	{
		position: relative;
		margin-left: auto;
		margin-right: auto;
		display: flex;
		justify-content: center;
	}	
	#uploadedTag
	{
		position: relative;
		margin-left: auto;
		margin-right: auto;
		display: flex;
		justify-content: center;
	}	
	#dateSet
	{
		position: relative;
		margin-left: auto;
		margin-right: auto;
		display: flex;
		justify-content: center;
	}	
	.center
	{
		position: relative;
		margin-left: auto;
		margin-right: auto;
		display: flex;
		justify-content: center;
	}
	#imgSourceContainer, #imgCreatorContainer
	{
		display: flex;
		align-items: center;
		text-align: center;
		position: relative;
		width: 100%;
		height: auto;
		
		margin-left: auto;
		margin-right: auto;
	}
	.sameLine
	{
		display: block;
	}
	#imgSourceContainer img, #imgCreatorContainer img  {	
		width: 100%;
		height: auto;
	}
	#mp3Upload, #ytUpload
	{
		padding: 5px;
		border: none;
		border-radius: 25px;
	}
	#mp3Upload:hover, #ytUpload:hover
	{
		transition: 0.2s;
		background-color: orange;
		color: white;
	}
	#ytContainer
	{
		position: absolute;
		top: 50%; 
		left: 50%;
		transform: translate(-50%,-50%);
	}
	#ytURL
	{
		padding: 5px;	
		border: solid 1px;
		border-color: grey;
	}

	#pageButtons
	{
		text-align: center;
		align-items: center;
	}
	.pageNumber{
		display: inline-block;
		border-radius: 25px;
		background-color: #e9e9e9;
		border: none;
		color: white;
		padding: 10px 20px;
		margin-left: 5px;
		text-align: center;
	}
	.PageButtonActive, .pageNumber:hover
	{
		color: black;
		background-color: orange;
	}
	.channelArtChange
	{
		position: absolute;
		z-index: 0;
		width: 100%;
		height: 200px;
		opacity: 0;
	}

	.profName
	{
		z-index: 1;
		padding: 10px;
		font-size: 30px;
		color: #5b5b5b;
		
	}
	.profName p
	{
		padding:5px;
		font-size: 18px;

	}
	.profImage
	{
		padding: 5px;
		z-index: 10;
		width: auto;
		height: 175px;
	}
	.profileBox
	{
		background-size: cover;
		background-repeat: no-repeat;
		background-position: 50% 50%;
		overflow: hidden;
		display: flex;
		width: 100%;
		height: 175px;
		background-color: #e9e9e9;
	}
	.autofillWords
	{ 
		display: flex;
		align-items: center;
		z-index: 99;
	}
	.previewCover
	{
		height: 45px; 
		width: 45px;
		padding: 5px;
	}
	#imgPlayButton
	{
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		height: 100%;
		width: 100%;
		opacity: 0;
	}

	.orangePlayButton
	{
		pointer-events: none;
		color: orange;
		position: absolute;
		top: 50%;
		left: 45%;
		transform: translate(-50%, -50%);
		font-size: 50px;
		display: flex;
		opacity: 0;
	}
	.orangePlayButton.fa-pause
	{
		opacity: 1;
	}
	#imgPlayButton:hover ~.orangePlayButton
	{
		transition: 0.1s;
		opacity: 1;
	}

	#mp3Container
	{
		text-align: center;
		position: absolute;
		top: 50%; 
		left: 50%;
		transform: translate(-50%,-50%);
	}
	#fileContainer 
	{
		text-align: center;
		position: fixed;
		top: 50%; 
		left: 50%;
		width: 98%;
		height: 85%;
		transform: translate(-50%,-50%);

	}

	#mp3Container > div {
			display: inline-block;
			vertical-align: middle;
	}

	#fileContainer > div {
			display: inline-block;
			vertical-align: middle;
	}
	#container2 
	{
		text-align: center;
	}
	#container2Text {
		padding: 10px;
		display: inline-block;
		height: 300px;
		width: 15%;
		border: solid 2px;
		border-color: grey;
		resize: none;
		}
	#iDescription {
		padding: 10px;
		display: inline-block;
		height: 300px;
		width: 50%;
		border: solid 2px;
		border-color: grey;
		resize: none;
		}
	#containerDesc {
		font-family:verdana;
		padding: 5px;
		height: 70px;
		width: 100%;
		border: none;
		resize: none;
	}

	.imgDrag
		{
			position:relative; 
			top: 90%; 
		}
	.uploadImage
	{
		height: 100%;
		width: 100%;
	}
	.upload-btn-wrapper {
			margin-left: auto;
			margin-right: auto;
			position: relative;
		  	border: 3px;
			border-color: #AEAEAE;		
			border-style: dotted;
			width:  200px;
			height: 100px;
		}
	.upload-file-wrapper {
		margin-left: auto;
		margin-right: auto;
		position: relative;
		border: 3px;
		border-color: #AEAEAE;		
		border-style: dotted;
		width:  100%;
		height: 100%;
		z-index: -10;
		
	}
	.upload-file-wrapper:hover
	{
		border-color: black;
	}


	.upload-file-wrapper:hover .uploadFileText
	{
		display: inline;
	}
	.uploadFileText
	{
		display: none;
	}
	.upload-btn-wrapper:hover
		{
			border-color: black;
		}

	.btn {
			border: 3px;
			border-color: #AEAEAE;
			width:  200px;
			height: 100px;
		}
	.upload-btn-wrapper input[type=file], .upload-file-wrapper input[type=file]{
		  font-size: 10px;
		  width:  100%;
		  height: 100%;
		  position: absolute;
		  left: 0;
		  top: 0;
		  opacity: 0;
		}
	#playerWrapper
	{
		bottom: 0;
		height:54px;
		min-width: 1000px;
		position: sticky;
	}		
	#wrapper
		{	
			position: fixed;
			bottom: 0%;
			min-width: 1000px;
			width: 100%;
			margin: auto;
			margin-left: auto;
			margin-right: auto;

			z-index: 99;
		}
	div.player
		{	
			width: 100%;
			background-color: rgb(250,250,250);
			padding-bottom: 3px;
		}

	.soundPlayerButton
		{
			background-color: Transparent;
			background-repeat:no-repeat;
			border: none;
			cursor:pointer;
			overflow: hidden;
			outline:none;
		}
	.soundPlayerButton:hover .soundPlayerIcon
	{
		color: grey;
	}
	#soundBar:hover
	{
		cursor: pointer;
	}
	.mb:hover ~ #soundBarButton
	{
		opacity: 1;
		width: 50%;
	}		

	#soundBarButton:hover
	{
		opacity: 1;
		width: 50%;
	}

	#soundBarButton
	{
		transition: 0.5s;
		opacity: 0;
		width: 0%;
	}
	#soundButtons
	{
		font-size: 19px;
		display: inline-flex;
		align-items: center; 
	}
	#soundNavBottom
	{
		width: 25%; 
		font-size: 19px;
		display: inline-flex;
		align-items: center; 
		color:orange;
		margin-left: 20px;
	}	
	#queuedTrack
	{
		position: fixed;
		margin:0px;
		width: 100%; 
		height:auto;
		transition: all .3s ease-out;
		//display:none;
		bottom: -50%;
		z-index: -1;
		display:flex;
	}

	#wrapper:hover > #queuedTrack
	{
		bottom: 54px;
	}
	.soundPlayerIcon
		{
			height: 40px;
			width: 30px;
			padding: 5px;
			display: flex;
			align-items: center;
		}
	#volumeArea
		{
			height: 40px;
			padding: 5px;
			display: flex;
			align-items: center;
		}
	#currentTime
		{
			left: 100px;
		}
	div.gallery {
			border: 1px solid #ccc;
		}

	div.gallery:hover {
			border: 1px solid #777;
		}

	
	.imgContainer
	{
		margin: 10px 0;
		display: flex;
		align-items: center;
		text-align: center;
		position: relative;
		width: 100%;
		height: auto;
	}
	.imgContainer img {	
		width: 100%;
		height: auto;
	}
	.imageSourceFile{	
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		background-color: transparent;
		color: transparent;
		width: 100%;
		height: 100%;
		border: none;
		cursor: pointer;
		border-radius: 5px;
		text-align: center;
	}	
	.imageSourceFile:hover{	
		border: 5px solid grey;	
	}	

	.imageSourceFile::-webkit-file-upload-button{
		display: none;
	}
	#imageSourceText
	{
		color: transparent;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}
	.imgContainer:hover #imageSourceText
	{	
		transition: 0.3s;
		color: grey;
	}	

	div.desc {
		padding: 15px;
		text-align: center;
	}
	* {
			box-sizing: border-box;
		}
	.responsiveUpload {
		margin-left: auto;
		margin-right: auto;
		padding: 0px;
		margin-top: 3%; 
		width: 15%;	
	}
	.item
	{
		display: flex;
		justify-content: center;
	}
	@media only screen and (max-width: 600px) {
		.item {
			display: inline;
		}
	}
	.playlistItem
	{
		border: dotted;
		width: auto;
	}
	.responsive {
		padding: 0px;
		margin-top: 3%; 
		width: 10%;	
		}

	#pieceDescription
	{
		min-width: 350px;
		margin-top: 3%; 
		padding: 20px;
		height: auto;
		width: 50%;
	}
	.editable
	{
		font-family:verdana;
		resize: vertical;
	}
	.noneditable
	{
		border: none;
		resize: none;
	}
	#pieceDescriptionInner
	{
		font-family:verdana;
		min-height: 200px;
		height: auto;
		width: 100%;
		padding: 3px;
		word-wrap:break-word;
	}
	.content {
        zoom:75%;
		align-items: center;
		display: flex;
		padding: 15px;
		margin: 15px;
		min-width: 600px;
        display: table;
        margin: 50px auto;
	}
	.contentHeader {
		align-items: center;
		text-align: center;
		display: flex;
		padding: 0px;
		font-size: 30px;
		color: #5b5b5b;
		margin: 50px auto 0px auto;
		min-width: 600px;
		max-width: 1200px;
	}
	.contentHeader a{
		color: #5b5b5b;
		text-decoration: none;
	}
	table{
		width: 100%;
		z-index: 1;
	}
    th
    {
        background-color: white;
        z-index: 10;
        position: -webkit-sticky; /* Safari */
        position: sticky;
        top: 60px;
        border-bottom: 3px solid red;
        border-top: 10px solid white;
    }
    #pagePreTable, #pageTable{
        margin-bottom: 30px;
    }
    .tableBody{
    }
    #contentList th, td {
        border: 1px solid #DCDCDC;
        border-collapse: collapse;
        padding: 10px;
    }
    td p{
        white-space: pre-line;
    }
    .tooltip {
        position: relative;
    }
    .tooltiptext {
        transition: 0.2s;
        visibility: hidden;
        width: auto;
        background-color: black;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px;
        margin: 3px;
        z-index: 11;
        bottom: 110%;
        left: 50%;
        white-space: pre-line;
            /* Position the tooltip */
        position: absolute;
    }
    .tooltip:hover .tooltiptext{
        visibility: visible;
    }
    .tooltip:active .tooltiptext {
        visibility: visible;
    }
    .tooltip2:hover .tooltiptext{
        visibility: visible;
    }
    .tooltip2:active .tooltiptext {
        visibility: visible;
    }
	.sideMenu
	{
		margin: 10px;
		width: 10%;
		height:85%;
		border: 2px solid #e9e9e9;
	}
	#imageListWrapper
	{
		display: flex;
		align-items: center;
		text-align: center;
		position: relative;
		width: 60px;
		height: 60px;
	}
	#imageSourceList
	{
		width: 100%;
		height: 100%;
	}
	#imgPlayButtonList
	{
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		height: 100%;
		width: 100%;
		opacity: 0;
	}
	.orangePlayButtonList.fa-play
	{
		pointer-events: none;
		color: orange;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-45%, -50%);
		font-size: 20px;
		display: flex;
		opacity: 0;
	}
		.orangePlayButtonList.fa-pause
	{
		pointer-events: none;
		color: orange;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-45%, -50%);
		font-size: 20px;
		display: flex;
		opacity: 1;
	}
	#imgPlayButtonList:hover ~.orangePlayButtonList
	{
		transition: 0.2s;
		opacity: 1;
	}
	
	#imgPlayButton
	{
		position: absolute;
		transform: translate(-50%, -50%);
		height: 100%;
		width: 100%;
		opacity: 0;
	}
	#contentList
	{
		width:100%;	
	}

	.centerTable
	{	
		text-align: center; 
		vertical-align: middle;
	}
	.centerTableDetails
	{
        text-align: center;
        vertical-align: middle;
	}


	@media only screen and (max-width: 600px) {
			.responsive {
				width: 49.99999%;
				margin: 6px 0;	
				width: 90%;
			}

		}


	.clearfix:after {
			content: "";
			display: table;
			clear: both;
		}
		* {box-sizing: border-box;}

	body {
		font-size: 100%;
		margin: 0;
		font-family: Arial, Helvetica, sans-serif;
		}

	.topnav {
        zoom: 85%;
		top: 0;
		height:50px;
		position: sticky;
		position: -webkit-sticky; /* Safari */
		width:100%;
		background-color: #e9e9e9;
		display: inline-flex;
		align-items: center;
		z-index: 99;
		justify-content: space-between;
	   -moz-box-shadow: 0 8px 6px -6px black;
	    box-shadow: 0 8px 6px -6px black;
        min-width: 800px;
		}

	.topnav a{
		color: grey;
		text-decoration: none;
	}
	.topnav a.loader {
		transition: 3s;
		color: grey;
		float: left;
		height : 100%;
		padding: 20px;
		text-decoration: none;
		font-size: 17px;
		-moz-box-shadow:    inset 0 0 10px #e9e9e9;
		-webkit-box-shadow: inset 0 0 10px #e9e9e9;
		box-shadow:         inset 0 0 10px #e9e9e9;
		}

	.topnav a.loader:hover {
		color: white;
		transition: 0.5s;
		background-color: orange;
	}
	.topnav a.active {			
			transition: 3s;
			padding: 0px;
			background-color: orange;
			color: white;
		}
	.topnav a.active:hover {
			transition: 0.5s;
			background-color: #e9e9e9;
			color: orange;
		}

	.topnav .search-container {
			text-align:center;
        
		}
	.topnav #searchThis{
		float:left;
        display: inline;
		border-radius: 25px 0px 0px 25px ;
		}

	.topnav #searchWhat {
        display: inline;
		padding: 6px;
		font-size: 17px;
		border: none;
		width: 300px;
		border-radius: 0px 25px 25px 0px ;
	}
    .dateSearch{
        padding: 2px;
    }
    #searchByDate, #searchByDate2{
        width: 120px;
        border: none;
        border-radius: 25px 25px 25px 25px ;
        padding: 3px;
        margin: 2px;
    }
	.topnav #searchBox
	{
		float:left;
	}
	.topnav .search-container button {
		float:left;
		  vertical-align: middle;
		  padding: 3px 5px;
		  margin-top: 3px;
		  margin-left: 10px;
		  background: #ddd;
		  font-size: 10px;
		  border: none;
		  cursor: pointer;
		}
	.topnav .search-container select {
		  vertical-align: middle;
		  margin-right: 1px;
		  background: #ddd;
		  height: 35px;
		  width: 100px; 
		  font-size: 16px;
		  border: none;
		  cursor: pointer;
		}
	.topnav .search-container button:hover {
		  background: #red;
		}

	@media screen and (max-width: 400px) 
	{

		.topnav .search-container 
		{
			float: none;
		}
		.topnav a.loader, .topnav input[type=text], .topnav .search-container button 
		{		
			float: none;
			display: block;
			text-align: left;
			width: 100%;
			margin: 0;
			padding: 14px;
		}
	}
	.topnav input[type=text] 
	{
		border: 1px solid #ccc;  
	}
	
	#userLogIn
	{
		padding: 6px;
	}
	#userLogIn #username
	{
		display:inline-block;
		padding: 6px;
		font-size: 15px;
		border: none;
		width: 150px; 
	}
	#userLogIn input[type=password]
	{
		display:inline-block;
		padding: 6px;
		font-size: 15px;
		border: none;
		width: 150px; 
	}
	#userLogIn #contactHolder
	{
		display:inline-block;
		padding: 6px;
		font-size: 15px;
		border: none;
		width: 200px; 
		background-color: grey;
		color: orange;
	}
	#userLogIn #contactHolder::placeholder
	{
		color: orange;
	}
	#verifyPassword
	{	
		display:inline-block;
		padding: 6px;
		font-size: 15px;
		border: none;
		width: 150px; 
		background-color: grey;
		color: orange;
	}
	#verifyPassword::placeholder
	{
		color: orange;		
	}
	#userLogIn #submitButton
	{
		border: none;
		padding: 6px;
	}
	#userLogIn #submitButton:hover
	{
		transition: 0.3s;	
		background-color: orange;
	}
	.responsive audio.musicfile
		{
			 
		}

	input[type='range']::-webkit-slider-thumb {
		width: 15px;
		-webkit-appearance: none;
		height: 15px;
    }
    input[type='range']{
		-webkit-appearance: none;
		background-color: grey;
		
		background-image: -webkit-gradient(
        linear,
        left top,
        right top,
        color-stop(0.0, orange),
        color-stop(0.0, #d3d3d3)
    );
		
		
    }	
	.slider::-webkit-slider-thumb {
		-webkit-appearance: none;
		appearance: none;
		width: 25px;
		height: 25px;
		border-radius: 50%;
		background: orange;
		cursor: pointer;
		transition: 0.2s;
		opacity: 0;
	}
	.volSlider::-webkit-slider-thumb {
		-webkit-appearance: none;
		appearance: none;
		width: 25px;
		height: 25px;
		border-radius: 50%;
		background: orange;
		cursor: pointer;
		transition: 0.2s;
	}
	 input[type='range']:hover::-webkit-slider-thumb {
		transition: 0.2s;
		opacity: 1;
	}
	input[type='range']:active::-webkit-slider-thumb {
		transition: 0.2s;
		opacity: 1;
	}
	.pieceName
	{
		word-wrap:break-word;
		width: 100%;
		top: -7px;
	}

	.pieceNameText:hover
	{
		color: grey;
		outline: dotted;
	}
	
	#account
	{
		position: relative;
		display: flex;
		vertical-align: middle;
		text-align: center;
		align-items: center;
	}
	#centerIcon
	{	
		position: absolute;
	}
	#profilePic
	{	
		width: 40px;
		height: 40px;
	}

	
	#usernameFont
	{
		padding: 0px 15px;
	}
.dropbtn {
    background-color: transparent;
    color: black;
    padding: 10px;
    font-size: 16px;
    outline: solid white;
	border: none;
}

.searchDropdown {
    display: inline-block;
	z-index: 1;
}

.dropdown {
    position: relative;
    display: inline-block;
}
.dropdown-content {
	transition: 0.5s;
    display: none;
    background-color: #f1f1f1;
    position: absolute;
	z-index: 1;
	transform: translate(-50%,0%);
}
	.styleRight
	{
		transition: 0.5s;
		display: none;
		background-color: #f1f1f1;
		position: absolute;
		z-index: 1;
		right:0;
	}
.dropdown-content a, .styleRight a{
	transition: 0.5s;
	width: 180px;
    color: black;
    padding: 8px 12px;
    text-decoration: none;
    display: block;
}
.dropdown-content a:hover, .styleRight a:hover
	{
		min-width: 160px;
		background-color: orange;
	}

.dropdown:hover .dropbtn {
		outline: solid orange;
	}
.dropdown:hover .styleRight
	 {  
		transition: 0.5s;
		display: block;
	}

.saveDropdown:hover .styleRight
	{  
		transition: 0.5s;
		display: block;
	}

#rightUnderSearchBar
	{
	position: absolute;
	}
.autocomplete-items div {
	position: relative;
	width: 400px;
	padding: 10px;
	cursor: pointer;
	background-color: white; 
	border-bottom: 1px solid  #e9e9e9; 
}
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}
.autocomplete-active {
  background-color: orange !important; 
  color: #ffffff; 
}
#fixed {
	zoom: 125%;
	position: fixed;
	top: 45;
	bottom: 50;
	left: 0;
	right: 0;
	pointer-events: none;
	z-index: 100;
}
.ignoreMouse
{
	pointer-events: none;
}
#snapper {
	
	position: fixed;
	top: 75;
	bottom: 80;
	left: 25;
	right: 25;
	pointer-events: none;
}
#dragableYT {
    position: absolute;
	cursor: move;
	top: 0%;
	left: 10%;
	min-width: 320px;
}

#dragableYTHeader {
    padding:10px;
    cursor: move;
    background-color: orange;
}

#player{
}
#minimize
{
	position: absolute;
	top: 0px;
    left: 0px;
	background-color: transparent;
	border: none;
}
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}
.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}
.boolSlider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.boolSlider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .boolSlider {
  background-color: orange;
}

input:focus + .boolSlider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .boolSlider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

.boolSlider.round {
  border-radius: 34px;
}

.boolSlider.round:before {
  border-radius: 50%;
}
.piece-name {
	font-size: 1em;
	font-family: "Gill Sans", sans-serif;
	font-weight: normal;
}
h2
{
	padding: 0px;
	margin: 0px;
}
.piece-name-boxed {
	font-size: 0.80vw;
	font-family: "Gill Sans", sans-serif;
	font-weight: normal;
	overflow-wrap: break-word;
	white-space: normal;
	padding: 0px;
}
.piece-artist-boxed {
	font-size: 0.70vw;
	font-family: "Gill Sans", sans-serif;
	font-weight: normal;
	overflow-wrap: break-word;
	white-space: normal;
}
.hidden {
	display: none;
}
h3{
	font-family:verdana;
	word-wrap:break-word;
}
.publishDate
{
	color: grey;
	font-size: 0.6vw;
}
.filter
{
	background-color: white;
	top: 50px;
	position: sticky;
	padding-left: 100px;
	padding-bottom: 2px;
	border: 1px solid #e9e9e9;
	z-index: 10;
}
.searchType
{
	font-size: 10px;
	margin: 2px;
}

.active{
    background-color: #92b3e5;
    color: white;
}
.add{
   display: table;
   margin: 50 auto;
}
.bg{
   border-radius: 25px;
   width: 30%;
   min-width: 600px;
   margin: 10px auto 0px auto;
   padding: 10px;
   background-color: #c0cee5;
   font-family: Geneva,Tahoma,Verdana,sans-serif;
   font-size:12px;
   color: #061d44;
    }
.inputs{
	width: 20%;
    color: black;
    background-color:white;
}
#today, #editId, #editTicket{
    display:none;
}
.button, .areaButton, .pusdButton, .inputs{
    border-radius: 25px;
    outline:none;
    border: none;
    margin:3px;
    padding: 3px;
    padding-left: 10px;
}
#copyButton, #regButton, #editButton, #submitTicket,#editTicket{
    width: 100%;
    text-align: center;
    color:grey;
}
#copyENG, #copyKOR
{
   width: 48%;
   text-align: center;
   color:grey;
}
 .formats{
	width: auto;
	text-align: center;
	color:grey;
 }
.button, .areaButton, .formats, .pusdButton, #copyButton, #regButton, #editButton, #submitTicket,#editTicket, #copyENG, #copyKOR{
    background-color: white;
    padding: 5px;
}
 .formats:hover, .button:hover, .areaButton:hover, .pusdButton:hover, #copyButton:hover, #regButton:hover, #editButton:hover , #submitTicket:hover, #editTicket:hover, #downloadPage:hover,#clearPage:hover, #editPage:hover, #submitPage:hover, #copyENG:hover, #copyKOR:hover{
    background-color: #92b3e5;
    color:  white;
    transition: 0.2s;
}
.active{
    background-color: #92b3e5;
    color: white;
}
.mini{
    
}
#outputText
{
    padding: 25px;
    width: 100%;
    height: 150px;
    color: grey;
    font-size: 15px;
}
#swipex{
    overflow: auto;
    white-space: nowrap;
}
#tourText,#translateText
{
    padding: 25px;
    width: 100%;
    color: grey;
    font-size: 14px;
    resize: vertical;
    height: 150px;
}
#translateTextKOR
{
    display: none;
    width: 100%;
    padding: 20px;
    background-color: black;
    color: white;
    font-size: 12px;
    resize: vertical;
    height: 150px;
}
.sm{
    width: 50px;
}
.m{
    width: 100px;
}

.hoverable:hover{
    color: grey;
    cursor: pointer;
}
.name, .area, .checkIn, .hotel, .roomNum, .members, .nights, .costAdult, .pusdCost, .tourText, .remarks{
    color: grey;
}
                                           
.sliderContainer {
    display: table;
    margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
    position: fixed;
    bottom: 50px;
    width: 33%;
}

.pageSlider {
    -webkit-appearance: none;
    width: 100%;
    height: 10px;
    border-radius: 5px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.33;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.pageSlider:hover, .pageSlider:active {
    opacity: 1;
}
.pageSlider::-webkit-slider-thumb {
    border-radius: 50%;
    background: #92b3e5;
    cursor: pointer;
}

.pageSlider::-moz-range-thumb {
    border-radius: 50%;
    background: #92b3e5;
    cursor: pointer;
}
#page{
    position: fixed;
}
@media only screen and (max-width: 1000px) {
    .bg{
        width: 95%;
    }
   .sliderContainer {
        width: 75%;
   }
   input[type='range']::-webkit-slider-thumb {
       width: 50px;
       height: 50px;
   }
   .dateSearch{
       display:none;
   }
   #translateTextKOR{
        display: block;
   }
}
@media only screen and (max-width: 400px) {
   .topnav{
        display:none;
   }
}
#new1, #new2,#new3,#new4,#new5,#new6,#new7,#new8,#new9,#new10,#new11,#new12,#new13,#new14,#new15,#new16,#new17,#new18{
    white-space: pre-line;
}
.excel{
	font-size: 13px;
    width : 100%;
    margin : 0px;
    resize : none;
    padding: 5px;
    background-color : transparent;
}
.preExcel{
    border: none;
    width : 100%;
    margin : 0px;
    padding: 5px;
}
.excelHold{
    padding: 0px;
}
#translateTxt{
	text-align: left;
}
.noBreak p{
    white-space: pre;
    margin : 10px;
}
.noBreak{
	padding: 0px;
}
.noBreak textarea{
   border: none;
   font-size: 15px;
   white-space: pre;
   text-align: center;
   width : 100%;
   height : 100%;
   box-sizing: border-box;
   -moz-box-sizing: border-box;
   -webkit-box-sizing: border-box;
   margin : 0px;
   resize : none;
   padding: 5px;
}
#excelTitle{
    border: 1px solid gray;
    font-size: 20px;
    white-space: pre;
    text-align: center;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box
    margin : 0px;
    padding: 5px;
}
.trBlackBorder td{
}
.normalRow td input{
}
.tableBody{
	margin:  10px;
}
.numNum, .numPrice, .rowTime{
	text-align: center;
}
</style>
	<body>
        <meta name'viewport' content='width=device-width, initial-scale=1.0'>
		<div class="topnav">
           <div><button id = 'trKorean' type = 'button' class = 'active button' title = 'Language' onclick = 'clicked(this)'>한국어</button>
           <button id = 'trEnglish' type = 'button' class = 'button' title = 'Language' onclick = 'clicked(this)'>English</button></div>
                                           
            <div class = 'dateSearch' >
                <input id = 'searchByDate' onchange = 'sessionChange()' type = 'date'
                    <?php
                         if (!empty($_SESSION['dateSearch']))
                       {
                            echo " value = ".$_SESSION['dateSearch']." ";
                       }
                    ?>
                />
            TO
                                           
           <input id = 'searchByDate2' onchange = 'sessionChange()' type = 'date'
               <?php
                   if (!empty($_SESSION['dateSearch2']))
                   {
                       echo " value = ".$_SESSION['dateSearch2']." ";
                   }
               ?>
           />
            </div>
            <div class="search-container">
                    <select id = "searchThis" class = "searchDropdown" onchange = 'searchChange()'>
                       <option id = 'searchOption' value="tour"
                                           <?php
                                               if ($_SESSION['search'] == 'tour')
                                               {
                                                echo " selected ";
                                               }
                                           ?>
                                           >&nbsp;&nbsp;By Hotel</option>
                          <option id = 'searchOption' value="page"
                                           <?php
                                               if ($_SESSION['search'] == 'page')
                                               {
                                               echo " selected ";
                                               }
                                           ?>
                                           >&nbsp;&nbsp;By Tour</option>
                          <option id = 'searchOption' value="all"
                                           <?php
                                               if ($_SESSION['search'] == 'all')
                                               {
                                               echo " selected ";
                                               }
                                           ?>
                                           >&nbsp;&nbsp;All</option>
                        <option id = 'searchOption' value="docNum"
                                           <?php
                                               if ($_SESSION['search'] == 'docNum')
                                               {
                                               echo " selected ";
                                               }
                                           ?>
                                           >&nbsp;&nbsp;By Document Number</option>
                        <option id = 'searchOption' value="ticketNum"
                                           <?php
                                               if ($_SESSION['search'] == 'ticketNum')
                                               {
                                               echo " selected ";
                                               }
                                           ?>
                                           >&nbsp;&nbsp;By Ticket Number</option>

                    </select>
                    
                    <div id = 'searchBox'>
                        <input id = "searchWhat" type="text" placeholder="Search Here..." name="search" autocomplete="off"><div id = 'rightUnderSearchBar'></div></input>
                    </div>
            </div>
            <div id ='userLogIn'></div>
		</div>
              <a id="downloader" download href = '' style = 'display: none'></a>
	</body>

<script type="text/javascript" src="//code.jquery.com/jquery-2.1.4.js"></script>
<script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="/html2canvas.js"></script>
<script>

   $area = '';
   $areaHelpENG = '';
   $areaHelpKOR = '';
   $areaHelp = '';
   var $pusd = ''; 
   
	var $areaCode;
	var $name;
	var $tour;
	var $tourID;
	var $startDate;
	var $itenary;
	var $class;
	var $time;
	var $price;
	var $currency;
	var $payDate;
   	function getNewTicketData($idx)
	{
		if (lang == 'KOR')
		{
			$tour = '';
			$startDate = '';
			$itenary = '';
			
           var newStr = document.getElementById($idx+'new5').innerHTML.trim().split('\n');
           for (var i = 0; i < newStr.length; i++) {
			   $tour += trxCode(newStr[i])+"\n";
           }
			
			
			
           var newStr = document.getElementById($idx+'new7').innerHTML.trim().split('\n');
           for (var i = 0; i < newStr.length; i++) {
			   $startDate += trxDates(newStr[i])+"\n";
           }
		   
			
			var newStr = document.getElementById($idx+'new8').innerHTML.trim().split('\n');
			
           for (var i = 0; i < newStr.length; i++) {
			   $itenary += trxAreaCode(newStr[i])+"\n";
           }
		}
		else{
			$tour = document.getElementById($idx+'new5').innerHTML;
			$startDate = document.getElementById($idx+'new7').innerHTML;
			$itenary = document.getElementById($idx+'new8').innerHTML;
		}
		$areaCode = document.getElementById($idx+'new3').innerHTML;
		$name = document.getElementById($idx+'new4').innerHTML;
		$tourID = document.getElementById($idx+'new6').innerHTML;
		$class = document.getElementById($idx+'new9').innerHTML;
		$time = document.getElementById($idx+'new10').innerHTML;
		$price = document.getElementById($idx+'new11').innerHTML;
		$currency = document.getElementById($idx+'new12').innerHTML;
		$payDate = document.getElementById($idx+'new13').innerHTML;
		
	}
   function translateFormat($airline)
   {
	   if ($airline == 'Default'){
		   outputText(document.getElementById('editId').value);
	   }
	   	if ($airline == 'Bamboo'){
		   outputTextBamboo(document.getElementById('editId').value);
	   }
	   	if ($airline == 'VietJet'){
		   outputTextVietJet(document.getElementById('editId').value);
	   }
   }
	function hiddenClone(element){
	  // Create clone of element
	  var clone = element.cloneNode(true);

	  // Position element relatively within the
	  // body but still out of the viewport
	  var style = clone.style;
	  style.position = 'relative';
	  style.top = window.innerHeight + 'px';
	  style.left = 0;

	  // Append clone to body and return the clone
	  document.body.appendChild(clone);
	  return clone;
	}
   	function htmlTest(){
		var clone = hiddenClone(document.getElementsByClassName('content')[0]);
		var textareas = clone.getElementsByClassName('noBreak');
		clone.style.width = '800px';
		
		clone.getElementsByClassName('noBreak');
		for (var i = 0; i < textareas.length; i++){
			var $input = $("<p/>").text(textareas[i].childNodes[0].value);
			if (textareas[i].childNodes[0].tagName.toLowerCase() == 'textarea'){
			//alert(textareas[i].childNodes[0].tagName);
				$(textareas[i].childNodes[0]).replaceWith($input);
			}
		}
		clone.getElementsByClassName('hannatourLogo')[0].style.display = 'table';
		var buttons = clone.getElementsByClassName('pageButtons');
		var fa = clone.getElementsByClassName('fa');
		for (var i = 0; i < buttons.length;i++){
			buttons[i].style.display= 'none';
		}
		for (var i = 0; i < fa.length;i++){
			fa[i].style.display= 'none';
		}



		
	 	window.scrollTo(0,0);
        html2canvas(clone).then(canvas => {
			var img = canvas.toDataURL("image/png");
			document.getElementById('downloader').setAttribute("download", 'page_'+document.getElementsByClassName("preExcel")[0].value+'_'+document.getElementById("pgDateInput").innerHTML);
			document.getElementById('downloader').setAttribute("href", img);
			document.getElementById('downloader').click();
			document.body.removeChild(clone);
        //document.body.appendChild(canvas)
        });
    
   }
    function switchTour($tour){ 
    	if (document.getElementById('searchThis').value == 'all'){
			var preTable = document.getElementById('pagePreTable');
			var table = document.getElementById('pageTable');
			var detailTable = document.getElementById('pageDetailTable');
			
			if ($tour == 'HOTEL'){
				document.getElementById('input1').style.display = 'block';
				document.getElementById('input2').style.display = 'none';
				preTable.style.display = 'none';
				table.style.display = 'none';
				detailTable.style.display = 'none';
			}
			else if ($tour == 'TOUR'){
				document.getElementById('input1').style.display = 'none';
				document.getElementById('input2').style.display = 'block';
				preTable.style.display = 'table';
				table.style.display = 'table';
				detailTable.style.display = 'table';
			}
		}
		
		
    }
    function trDate($num){
       if ($num == 1){
           return '월';
       }
       if ($num == 2){
           return '화';
        }
       if ($num == 3){
           return '수';
        }
       if ($num == 4){
			return '목';
       }
       if ($num == 5){
       		return '금';
       }
       if ($num == 6){
       		return '토';
       }
       if ($num == 0){
       		return '일';
       }
   }
   	function newPage(){
           quickPage(0, document.getElementById('today').value, '&', '&&&', '포  함&;불포함&;참  조&-차량은 기본 10시간 이며 저녁 7시까지 사용가능합니다._-차량  및 기사 오버타임 : 시간당 5불;결  재&농협 82512- 51-107898 윤지경_한국 구좌 송금은 송금 당일 송금환율(기준환율+10원)로 송금하시면 됩니다.;담  당&주이사 093-218-5000', '&&&&');
   			clearPgi();
   }
	function clearPgi(){
			var inputs = document.getElementsByClassName('input')[0].getElementsByTagName('input');
			for (var i = 0; i< inputs.length;i++){
				inputs[i].value = '';
			}
			 document.getElementById('pgiCar').value = 1;
			  document.getElementById('pgiGuideNum').value = 1;
   }
    function quickPage($pid, $startDate, $route, $override, $notes, $detail, $issueDate){
       var $details = "&&&&".split('&');
       if ($detail){
            var $details = $detail.split('&');
       }
       var issueDate = $startDate;
       if ($issueDate){
       		issueDate = $issueDate;
       }
        document.getElementById('editId').value = $pid;
        var startDate = new Date($startDate);
        //$nights = document.getElementById('pgiNights');
        var preTable = document.getElementById('pagePreTable');
        var table = document.getElementById('pageTable');
        var detailTable = document.getElementById('pageDetailTable');
		switchTour('TOUR');
		
        $nights = $override.trim().split(';').length;
                                           
       preTable.innerHTML = "<tr><td colspan = '6' style = 'border:none;'><img class = 'hannatourLogo' style = 'display:none;width:800px' src = 'hannatourLogo.png'></td></tr><tr>"+
       "<td colspan = '6' class = 'centerTable excelHold'><input class = 'excel' id = 'excelTitle' style = 'font-size: 20px;white-space: pre;text-align: center;margin : 0px;padding: 5px;' value = '"+$details[0]+"'></input></td>"+
    	"</tr>"+"<tr>"+
        "<td class = 'centerTable'><p id  = 'pgName' class = 'tooltip'>Name:</p></td>"+
        "<td class = 'centerTable excelHold'><input class = 'preExcel' value = '"+$details[1]+"'></input></td>"+
        "<td class = 'centerTable'><p id  = 'pgPeople'>인원</p></td>"+
        "<td class = 'centerTable excelHold'><input class = 'preExcel' value = '"+$details[2]+"'></input></td>"+
        "<td class = 'centerTable'><p id  = 'pgDate'>Date:</p></td>"+
        "<td class = 'centerTable'><p id  = 'pgDateInput'>"+issueDate+"</td>"+"</tr>";
        table.innerHTML = "<tr>"+
        "<th class = 'centerTable' style = 'width: 7%'><p id  = 'pgDate' class = 'tooltip'><p>일자</p></th>"+
        "<th class = 'centerTable' style = 'width: 7%'><p id  = 'pgCity' class = 'tooltip'><p>장소</p></th>"+
        "<th class = 'centerTable' style = 'width: 8%'><p id  = 'pgTime' class = 'tooltip'><p>시간</p></th>"+
        "<th class = 'centerTable' style = 'width: 50%'><p id  = 'pgDescription' class = 'tooltip'><p>내역</p></th>"+
        "<th class = 'centerTable' style = 'width: 8%'><p id = 'pgNumber' class = 'tooltip'><p>단가($)</p></th>"+
        "<th class = 'centerTable' style = 'width: 8%'><p id = 'pgPeople' class = 'tooltip'><p>인원/수량</p></th>"+
        "<th class = 'centerTable' style = 'width: 10%'><p id = 'pgCost' class = 'tooltip'><p>금액($)</p></th></tr>";
		
        for (var p = 0; p< $nights;p++){
            var div = document.createElement("tbody");
            div.className = 'tableBody';
            $rowspan = 3;
            var newDate = new Date($startDate);
            newDate.setDate(newDate.getDate()+p);
            var routeDay = $route.split(';');
            var el = document.createElement("tr");
                                           
            for (var i = 0; i< 1;i++){
                //DATE
                var child = document.createElement("td");
                var text = document.createElement("p");
                var textx = document.createElement("p");
                child.className = 'centerTable noBreak multiRow';
                child.rowSpan = $rowspan;
										   
                textx.innerHTML = (newDate.getMonth()+1) +"월 "+ (newDate.getDate())+"일\n("+trDate(newDate.getDay())+")";
                textx.setAttribute("date-editablePage", "");
                text.appendChild(textx);
                                           
                var span = document.createElement("span");
                text.className = 'tooltip';
                span.className = 'tooltiptext';
                span.innerHTML = $startDate;
                text.appendChild(span);
                                           
                child.appendChild(text);
                el.appendChild(child);

                //LOCATION
                var child2 = document.createElement("td");
                var text2 = document.createElement("p");
                text2.setAttribute("contenteditable", "true");
                text2.rows = $rowspan;
                child2.className = 'centerTable noBreak multiRow';
                child2.rowSpan = $rowspan;
               text2.innerHTML = routeDay[p].replace(/&/, '\n');
                
                child2.appendChild(text2);
                el.appendChild(child2);
            }
            div.appendChild(el);

            //COST MISC;
            for (var i = 0; i < $rowspan-2;i++){
                var el2 = document.createElement("tr");
                el2.className = 'normalRow';
                for (var o = 0; o< 5;o++){
                    var child = document.createElement("td");
                    var text = document.createElement("input");
                    text.className = 'excel';
                    text.rows = '1';
                    text.style.border= 'none';
                    child.className = 'centerTable excelHold';
                    if (i == 0){
						if (o == 0){
						   text.className = 'excel rowTime';
					    }
                        if (o == 1){
                        }
                        if (o == 2){
                            text.className = 'excel numPrice';
                        }
                        if (o == 3){
                            text.className = 'excel numNum';
                        }
                        if (o == 4){
                            text.className = 'excel numTotal';
                        }
                    }
				   if (o == 0){
					   text.className = 'excel rowTime';
				   }
                    if (o == 1){
                        text.className = 'excel rowDescription';
                    }
                    if (o == 2){
                        text.className = 'excel numPrice';
                        text.setAttribute("oninput", "rowMultiply(this)");
                    }
                    if (o == 3){
                        text.className = 'excel numNum';
                        text.setAttribute("oninput", "rowMultiply(this)");
                    }
                    if (o == 4){
                        text.className = 'excel numTotal';
                    }

                    child.appendChild(text);
                    el2.appendChild(child);
                }
                div.appendChild(el2);
            }

            //HOTEL
            var el3 = document.createElement("tr");
            el3.className = 'trBlackBorder';
            for (var i = 0; i<5;i++){
                var child = document.createElement("td");
                var text = document.createElement("input");
                text.className = 'excel';
                text.style.border= 'none';
										   
                child.className = 'centerTable excelHold';
				if (o == 0){
				   text.className = 'excel rowTime';
			   }
                if (i == 1){
                	child.style.border = '1px solid gray';
                }
                if (i == 2){
                    text.className = 'excel numPrice';
                    text.setAttribute("oninput", "rowMultiply(this)");
                }
                if (i == 3){
                    text.className = 'excel numNum';
                    text.setAttribute("oninput", "rowMultiply(this)");
                }
                if (i == 4){
                    text.className = 'excel numTotal';
                }
                    child.appendChild(text);
                    el3.appendChild(child);
                }
                div.appendChild(el3);
                table.appendChild(div);
            }
            //TOTAL
            var div = document.createElement("tbody");
            
           var el2 = document.createElement("tr");
           for (var i = 0; i<7;i++){
               var child = document.createElement("td");
               child.className = 'centerTable excelHold';
               var text = document.createElement("p");
               if (i == 3){
               		text.innerHTML = '진행비';
               }
               if (i == 4){
                    text = document.createElement("input");
               		text.className = 'excel numPrice';
                    text.id = 'feePrice';
                    text.value = $details[3];
                    text.setAttribute("oninput", "rowMultiply(this)");
                    text.style.border = 'none';
               }
               if (i == 5){
                   text = document.createElement("input");
                   text.className = 'excel numNum';
                   text.id = 'feeNum';
                   text.value = $details[4];
                   text.setAttribute("oninput", "rowMultiply(this)");
                   text.style.border = 'none';
               }
               if (i == 6){
                   text = document.createElement("input");
                   text.className= 'excel numTotal';
                   text.style.border = 'none';
               }
               child.appendChild(text);
               el2.appendChild(child);
           }
										   
            var el = document.createElement("tr");
            for (var i = 0; i<7;i++){
                var child = document.createElement("td");
                child.className = 'centerTable';
                var text = document.createElement("p");
                if (i == 0){
                    text.innerHTML = "<i class = 'fa fa-plus tooltip' onclick = 'addPage()'><span class='tooltiptext'>Add Day</span></i><i class = 'fa fa-minus tooltip' onclick = 'removePage()'><span class='tooltiptext'>Remove Day</span></i>";
                }
                if (i == 3){
                	text.innerHTML = '합계';
                }
                if (i == 6){
                    text.id = 'numFinalTotal';
                    text.setAttribute("onclick", "insertTitle()");
                }
                child.appendChild(text);
                el.appendChild(child);
        	}
        div.appendChild(el2);
        div.appendChild(el);
        
        //NOTES
        table.appendChild(div);
        detailTable.innerHTML = "";
        var div2 = document.createElement("tbody");
        for (var o = 0; o< 5;o++){
        
        //<p style = 'white-space:pre' contenteditable = 'true'>sdsda</p>
            var el = document.createElement("tr");
            for(var i = 0; i< 2;i++){
                var child = document.createElement("td");
                child.className = 'centerTable';
                child.style.padding = '0px';
                var text = document.createElement("p");
                text.setAttribute("contenteditable", "true");
                text.style.whiteSpace = 'pre';
                text.className = 'excel';
                text.rows = '1';

				text.style.align = 'center';

                if (i == 1)
                {
					if (o == 3)
					{
						text.title = 'ALT(계산)';
					}
					text.className = 'excel double';
					child.style.width = '90%';
					text.align = 'left';
					
				}
                child.appendChild(text);
                el.appendChild(child);
            }
            div2.appendChild(el);
        }
        //SUBMIT BUTTON
        for(var i = 0; i< 2;i++){
            var el = document.createElement("tr");
            el.className = 'pageButtons';
            el.style.backgroundColor = '#c0cee5';
            var child = document.createElement("td");
            child.className = 'centerTable';
            child.colSpan = '2';
            el.appendChild(child);
            var text = document.createElement("button");
            text.className = 'excel';
           		if(i == 0){
                   text.setAttribute("onclick", "savePage(this)");
                   text.id = 'editPage';
                   text.style.width = '100%';
                    if(document.getElementById('editId').value > 0){
                    	el.style.display = '';
                    }
                   else{
                   		el.style.display = 'none';
                   }
                   text.innerHTML = '수정';
               }
               if(i == 1){
                   text.setAttribute("onclick", "savePage(this)");
                   text.id = 'submitPage';
                   text.innerHTML = '등록';
                   text.style.width = '75%';
										   
                   var textMini = document.createElement("button");
                   textMini.id = 'clearPage';
                   textMini.className = 'inputs';
                   textMini.setAttribute("onclick", "newPage()");
                   textMini.innerHTML = 'X';
                   textMini.style.width = '10%';
                   child.appendChild(textMini);
										   
				   var textMini2 = document.createElement("button");
                   textMini2.id = 'downloadPage';
                   textMini2.className = 'inputs';
                   textMini2.setAttribute("onclick", "htmlTest()");
                   textMini2.innerHTML = "<i class = 'fa fa-download'></i>";
                   textMini2.style.width = '10%';
                   child.appendChild(textMini2);
               }
										   
            text.className = 'inputs';
            child.appendChild(text);
            div2.appendChild(el);
        }
        detailTable.appendChild(div2);
        if ($notes)
        {
        	writeNotes($notes);
        }
        overridePage($override);
        updatePage();
    }
   	function savePage(callBack){
       var str = '';
       var route = '';
       var notes = '';
       var details = '';
       var tableBody = document.getElementsByClassName("tableBody");
       var tableDetailBody = document.getElementById("pageDetailTable").childNodes[0].childNodes;
       var date = tableBody[0].childNodes[0].childNodes[0].childNodes[0].childNodes[1].innerHTML;
       var issueDate = document.getElementById("pgDateInput").innerHTML;
       for (var i = 0; i < tableBody.length;i++){
        //Get Route
           var routeNode = tableBody[i].childNodes[0].childNodes[1].childNodes[0].innerHTML.split('\n');
           for (var o = 0; o < routeNode.length; o++){
               route += routeNode[o];
               if (o != (routeNode.length-1)){
                    route += '&';
               }
           }
           if (i != (tableBody.length-1)){
                route += ';';
           }
           var tr = tableBody[i].childNodes;
           for (var o = 1; o < tr.length; o++){
           
               var td = tr[o].childNodes;
               for (var p = 0; p < td.length-1; p++){
                    str += td[p].childNodes[0].value;
                    if (td[p].style.border.includes('rgb(220, 220, 220)') && p == 1)
                    {
						str += '<unbold>';
					}
					else if(td[p].style.border.includes('gray') && p == 1)
					{
						str += '<bold>';
					}
                    if (p != (td.length-2) || o != tr.length-1){
                        str += '&';
                    }
               }
           }
            if (i != (tableBody.length-1)){
            	str += ';';
            }
       }
       
        //NOTES
       for (var i = 0; i < tableDetailBody.length-3;i++){
            notes += tableDetailBody[i].childNodes[0].childNodes[0].innerHTML +'&'+ tableDetailBody[i].childNodes[1].childNodes[0].innerHTML+ ';';
       }
       notes += tableDetailBody[tableDetailBody.length-3].childNodes[0].childNodes[0].innerHTML +'&'+ tableDetailBody[tableDetailBody.length-3].childNodes[1].childNodes[0].innerHTML;
       notes = notes.replace(/\n/g, '_');
       //DETAILS
       details += document.getElementById("excelTitle").value + '&';
       details += document.getElementsByClassName("preExcel")[0].value + '&';
       details += document.getElementsByClassName("preExcel")[1].value + '&';
       details += document.getElementById("feePrice").value + '&';
       details += document.getElementById("feeNum").value;
						
       if (callBack == 'str'){
       		return str;
       }
       else if (callBack == 'route'){
       		return route;
       }
       else if (callBack == 'date'){
       		return date;
       }
       else if (callBack == 'notes'){
       		return notes;
       }
       else if (callBack == 'details'){
       
            return details;
       }
		else if (callBack == 'issueDate'){
            return issueDate;
       }
       else{
            submitPage(str, date, route, notes, details, callBack);
            document.getElementById('editId').parentNode.parentNode.style.display = 'none';
            document.getElementById('editId').value = 0;
       }
   }
    function submitPage($override, $startDate, $route, $notes, $details, e){
       $nights = document.getElementById('pgiNights').value;
       //$startDate = document.getElementById('pgiStartDate').value;
       $startCity = document.getElementById('pgiStartCity').value;
       $destination = document.getElementById('pgiDestination').value;
       $carPrice = document.getElementById('pgiVehiclePrice').value;
       $carNum = document.getElementById('pgiVehicle').value;
       $hotel = document.getElementById('pgiHotel').value;
       $price = document.getElementById('pgiPrice').value;
       $people = document.getElementById('pgiPeople').value;

       var xhttp = new XMLHttpRequest();
       var formData = new FormData();
                                           
       $today = document.getElementById('today').value;
                                           
       if (document.getElementById('editId').value >= 1 && e.id == 'editPage')
       {
            formData.append("editId", document.getElementById('editId').value);
       }
        formData.append("date", $today);
        formData.append("nights", $nights);
        formData.append("details", $details);
        formData.append("startDate", $startDate);
        formData.append("startCity", $startCity);
        formData.append("destination", $route);
        formData.append("carPrice", $carPrice);
        formData.append("carNum", $carNum);
        formData.append("hotel", $hotel);
        formData.append("price", $price);
        formData.append("people", $people);
        formData.append("override", $override);
        formData.append("notes", $notes);
       xhttp.onreadystatechange = function(){
           if (this.readyState == 4 && this.status == 200) {
               alert("uploaded");
               var saveID = document.getElementById('editId').value;
               var saveDate = savePage('date');
               var saveRoute = savePage('route');
               var saveStr = savePage('str');
               var saveNotes = savePage('notes');
               var saveIssueDate = savePage('issueDate');
										   
               search();
               quickPage(saveID, saveDate,saveRoute, saveStr,saveNotes,saveIssueDate);
           }
       };
       xhttp.open("POST", "pgsubmit.php");
       xhttp.send(formData);
    }
   	function writeNotes($notes){
        var notes = $notes.replace(/&nbsp;/g, ' ').split(';');
       if(document.getElementById('pageDetailTable')){
           var tr = document.getElementById('pageDetailTable').childNodes[0].childNodes;
           var strAdder
			if (document.getElementById('numFinalTotal').innerHTML > 0){
			
			}
           for (var i = 0; i < notes.length;i++){
               tr[i].childNodes[0].childNodes[0].innerHTML = notes[i].split('&')[0].replace(/_/g, '\n');
               tr[i].childNodes[1].childNodes[0].innerHTML = notes[i].split('&')[1].replace(/_/g, '\n');
           }
       }
   }
   	function matchRows(e){
       if (e.classList.contains('excel')){
           var len = e.value.split('\n').length;
           var len1 = e.parentNode.parentNode.childNodes[0].childNodes[0].value.split('\n').length;
           var len2 = e.parentNode.parentNode.childNodes[1].childNodes[0].value.split('\n').length;
           e.rows = Math.max(len1,len2);
       }
   }
    function overridePage($overrideStr){
        /*desc jd jd & 2 & 35; desc jd jd & 2 & 35; desc jd jd & 2 & 35;
         */
        var nights = $overrideStr.trim().split(';');
        var tableBody = document.getElementsByClassName("tableBody");
                                           
        for (var i = 0; i < (nights.length);i++){//for each night
                                   
			var variable= nights[i].split('&');
            var x = 0;
            for (var o = 0; o < variable.length;o+=4){//for every 3 variables of string
                x++;
                var child = tableBody[i].childNodes[x];   //tr 2-end
               if (tableBody[i].childNodes.length-1 > x)
                {
                   child.childNodes[0].childNodes[0].value = variable[o];
                   child.childNodes[1].childNodes[0].value = variable[o+1];
                   child.childNodes[2].childNodes[0].value = variable[o+2];
                   child.childNodes[3].childNodes[0].value = variable[o+3];
                }
               else if (tableBody[i].childNodes.length-1 != (variable.length/4))
               {
                   addRow(tableBody[i].childNodes[x-1].childNodes[0].childNodes[0] , variable[o], variable[o+1],variable[o+2],variable[o+3]);
               }
                else{
                   child.childNodes[0].childNodes[0].value = variable[o];
                   child.childNodes[1].childNodes[0].value = variable[o+1];
                   child.childNodes[2].childNodes[0].value = variable[o+2];
                   child.childNodes[3].childNodes[0].value = variable[o+3];
										   
					var unboldStr = variable[o+1];
					if (unboldStr.includes('<unbold>')){
						child.childNodes[1].childNodes[0].value = child.childNodes[1].childNodes[0].value.replace(/<unbold>/g, '');
						child.childNodes[1].childNodes[0].className = 'excel rowDescription';
						child.childNodes[0].style.border = '1px solid rgb(220, 220, 220)';
						child.childNodes[1].style.border = '1px solid rgb(220, 220, 220)';
						child.childNodes[2].style.border = '1px solid rgb(220, 220, 220)';
						child.childNodes[3].style.border = '1px solid rgb(220, 220, 220)';
						child.childNodes[4].style.border = '1px solid rgb(220, 220, 220)';
						child.className = 'extraRow normalRow';
					}
					else if (unboldStr.includes('<bold>')){
						child.childNodes[1].childNodes[0].value = child.childNodes[1].childNodes[0].value.replace(/<bold>/g, '');
						child.childNodes[1].childNodes[0].className = 'excel rowDescription';
						child.childNodes[0].style.border = '1px solid rgb(220, 220, 220)';
						child.childNodes[1].style.border = '1px solid gray';
						child.childNodes[2].style.border = '1px solid rgb(220, 220, 220)';
						child.childNodes[3].style.border = '1px solid rgb(220, 220, 220)';
						child.childNodes[4].style.border = '1px solid rgb(220, 220, 220)';
						child.className = 'extraRow normalRow';
					}
				}

            }
       }
       updatePage();
    }
   	function addPage(){
   		quickPage(document.getElementById('editId').value,savePage('date'),(savePage('route')+';&'),(savePage('str')+';&&&'),savePage('notes'),savePage('details'));
   }
    function removePage(){
       var str = '';
       var newStr = savePage('route').split(';');
       
       for (var i = 0; i < (newStr.length-2);i++){
       
            str += newStr[i]+';';
       }
       str += newStr[newStr.length-2];
       
       var str2 = '';
       var newStr2 = savePage('str').split(';');
       
       for (var i = 0; i < (newStr2.length-2);i++){
       		str2 += newStr2[i]+';';
       }
       str2 += newStr2[newStr2.length-2];
                             
    	quickPage(document.getElementById('editId').value,savePage('date'),str,str2,savePage('notes'),savePage('details'));
    }
    function loadPage(){
			var $route = '';
			var $override = '';
			var $details = '';
			var $name = document.getElementById('pgiName').value;
			
			var $people = document.getElementById('pgiPeople').value;
			var $startDate = document.getElementById('pgiStartDate').value;
			var $nights = document.getElementById('pgiNights').value;
			
			var $cars = document.getElementById('pgiVehicle').value;
			var $carPrice = document.getElementById('pgiVehiclePrice').value;
			var $carNum = document.getElementById('pgiCar').value;

			var $guide = document.getElementById('pgiGuide').value;
			var $guideNum = document.getElementById('pgiGuideNum').value;

			if ($nights <= 0)
			{
				$nights = 0;
			}
			for (var i = 0; i< $nights;i++){
				//BEGINNING TO FIRST TO LAST
				if (i == 0){
					$route += document.getElementById('pgiStartCity').value + '&' + document.getElementById('pgiDestination').value+';';
					$override += '&'+'공항미팅'+ '&'+ '' + '&' + $people;
					if($carNum > 0)
					{
						$override += '&&'+$cars+ '&'+ $carPrice + '&' + $carNum;
					}
					if ($guideNum > 0)
					{
						$override += '&&가이드'+ '&'+ $guide + '&' + $guideNum;
					}
					$override += '&&'+document.getElementById('pgiHotel').value+'&'+document.getElementById('pgiPrice').value+'&'+document.getElementById('pgiRooms').value+';';
				}
				else{
					$route += document.getElementById('pgiDestination').value + ';';
					$override += '&'+'호텔조식' + '&&';
					if($carNum > 0)
					{
						$override += '&&'+$cars+ '&'+ $carPrice + '&' + $carNum;
					}
					if ($guideNum > 0)
					{
						$override += '&&가이드'+ '&'+ $guide + '&' + $guideNum;
					}
					$override += '&'+'&'+document.getElementById('pgiHotel').value+'&'+document.getElementById('pgiPrice').value+'&'+document.getElementById('pgiRooms').value+';';
				}
			}//END
				$route += document.getElementById('pgiStartCity').value;
				
				
				if ($nights == 4){
					$override += '&'+'호텔조식' + '&&';
					if($carNum > 0)
					{
						$override += '&&'+$cars+ '&'+ $carPrice + '&' + $carNum;
					}
					if ($guideNum > 0)
					{
						$override += '&&가이드'+ '&'+ $guide + '&' + $guideNum;
					}
					$override += '&&<unbold>&&';
				}
				else
				{
					$override += '&&&&&<unbold>&&';
				}
				$title = '견격서('+document.getElementById('pgiStartCity').value+'-'+ document.getElementById('pgiDestination').value+' '+ ($nights*1) +'박'+ ($nights*1+1) +'일): '+ ($people)+' 불/인';
				$hotelStr = document.getElementById('pgiHotel').value +' '+ $nights +'박';
				if ($guideNum > 0){
					$hotelStr += '+ 가이드';
				}
			quickPage(0, $startDate, $route, $override, '포  함x&'+$hotelStr+';불포함&;참  조&-차량은 기본 10시간 이며 저녁 7시까지 사용가능합니다._-차량  및 기사 오버타임 : 시간당 5불;결  재&농협 82512- 51-107898 윤지경_한국 구좌 송금은 송금 당일 송금환율(기준환율+10원)로 송금하시면 됩니다.;담  당&주이사 093-218-5000',$title +'&'+$name+'&'+$people+'&&'+$people, document.getElementById('today').value);
			insertTitle();
		}
   function rowMultiply(e){
    	e.value;
        var parent = e.parentNode.parentNode;//tr
       var num;
       var price;
       for (var i = 0 ; i < parent.childNodes.length;i++)
       {
           if (parent.childNodes[i].childNodes[0].classList.contains('numNum')){
           		num = parent.childNodes[i].childNodes[0].value;
           }
       }
       
       for (var i = 0 ; i < parent.childNodes.length;i++)
       {
           if (parent.childNodes[i].childNodes[0].classList.contains('numPrice')){
           		price = parent.childNodes[i].childNodes[0].value;
           }
       }
                                           
                                           
       for (var i = 0 ; i < parent.childNodes.length;i++)
       {
           if (parent.childNodes[i].childNodes[0].classList.contains('numTotal')){
                    parent.childNodes[i].childNodes[0].value = (price*num);
               }
   		}
       var finalTotal = 0;
       var newTotal = document.getElementsByClassName("numTotal");
       for (var i = 0 ; i < newTotal.length;i++)
       {
        	finalTotal += (1*newTotal[i].value);
       }
       document.getElementById('numFinalTotal').innerHTML = finalTotal;
       insertTotal();
   }
   function insertTitle(){
	   var loc = document.getElementsByClassName("tableBody")[0].childNodes[0].childNodes[1].childNodes[0].innerHTML.split('\n');
       var title = '견격서(' + loc[0] +'-'+ loc[1] +'): '+ (document.getElementById('numFinalTotal').innerHTML/document.getElementById('feeNum').value) +'불/인';
       document.getElementById('excelTitle').value = title;
   }
   
    function formatNumber(num) {
	  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
	}
    function updatePage(){
		var rowNum = document.getElementsByClassName("numNum");
       for (var i = 0; i < rowNum.length; i++) {
       		rowMultiply(rowNum[i]);
       }
       insertTotal();
    }
    function insertTotal(){
		  var tr = document.getElementById('pageDetailTable').childNodes[0].childNodes;
		  var newStr = '';
		  var str = tr[3].childNodes[1].childNodes[0].innerHTML.split('\n');
		  
		  var num = 0;

		  
			for (var i = 0; i < str.length; i++) {
				if (str[i].includes('×') && str[i].includes('=')){
					var totalCost = str[i].split('×')[1].split('=')[0].replace(/&nbsp;/g, ' ').trim()*1*document.getElementById('numFinalTotal').innerHTML;
					newStr += document.getElementById('numFinalTotal').innerHTML + ' × '+ str[i].split('×')[1].split('=')[0].replace(/&nbsp;/g, '').trim() + ' = ' +  formatNumber(totalCost) + '원\n';
						num++;
			   }
			   else{
			   		newStr += str[i]+'\n';
			   }
		   }
		   if (num == 0){
		   		newStr = document.getElementById('numFinalTotal').innerHTML + '×'+ ' = 원\n'+ newStr;
			}
			tr[3].childNodes[1].childNodes[0].innerHTML = newStr.trim();
	}
    function addRow(e,$strTime, $strName, $strNum, $strPrice){
	   var strTime = '';
       var strName = '';
       var strNum = 0;
       var strPrice = 0;
	   if ($strTime)
       {
        	strTime = $strTime;
       }
       if ($strName)
       {
        	strName = $strName;
       }
       if ($strNum)
       {
       		strNum = $strNum;
       }
       if ($strPrice)
       {
       		strPrice = $strPrice;
       }
       var parent = e.parentNode.parentNode.parentNode; //tablebody
       
       var referenceNode = e;
       for (var i = 0 ; i < parent.childNodes.length;i++)
       {
           for (var o = 0 ; o < parent.childNodes[i].childNodes.length;o++)
           {
               if (parent.childNodes[i].childNodes[o].classList.contains('multiRow')){
                    parent.childNodes[i].childNodes[o].rowSpan += 1;
               }
           }
       }
    	addSingleRow(e,strTime, strName, strNum, strPrice);
    }
   function addSingleRow(e,$strTime, $strName, $strNum, $strPrice){
       var div = e.parentNode.parentNode.parentNode;
       var el = document.createElement("tr");
       el.className = 'extraRow normalRow';
       for (var o = 0; o< 5;o++){
       
           var child = document.createElement("td");
           var text = document.createElement("input");
           text.className = 'excel';
           text.rows = '1';
           text.style.border= 'none';
           child.className = 'centerTable excelHold';
           if (o == 0){
               text.className = 'excel rowTime';
               text.value = $strTime;
           }
           if (o == 1){
               text.className = 'excel rowDescription';
										   
               	var unboldStr = $strName;
               	text.value = $strName;
				if (unboldStr.includes('<unbold>')){
					text.value = $strName.replace(/<unbold>/g, '');
					child.style.border = '1px solid rgb(220, 220, 220)';
				}
				else if (unboldStr.includes('<bold>')){
					text.value = $strName.replace(/<bold>/g, '');
					child.style.border = '1px solid gray';
				}
										   
           }
           if (o == 2){
               text.className = 'excel numPrice';
               text.value = $strNum;
               text.setAttribute("oninput", "rowMultiply(this)");
           }
           if (o == 3){
               text.className = 'excel numNum';
               text.value = $strPrice;
               text.setAttribute("oninput", "rowMultiply(this)");
           }
           if (o == 4){
                text.value = $strNum*$strPrice;
                text.className = 'excel numTotal';
           }
           child.appendChild(text);
           el.appendChild(child);
       }
       div.insertBefore(el, e.parentNode.parentNode.nextSibling);
   }
   function changePage(e){
        $value = e.value;
        loadURL('','planetest', '?input='+document.getElementById('searchWhat').value+"&page="+$value+"&limit="+document.getElementById('limit').value);
   }
   function pageNum(e){
       $value = document.getElementById('slider').value;
       document.getElementById('page').innerHTML = "Page "+$value+"/"+document.getElementById('slider').max;
       document.getElementById('page').style.left =  (e.clientX)+"px";
   }
   function copyOutput($name, $roomNum, $areax, $hotel, $roomNum, $costAdult,$costOthers,$numOthers,$costBed,$numBed,$checkIn,$nights,$members, $pusdCost,$tour, $id){

		switchTour('HOTEL');
		
        document.getElementById('adder').classList.replace('fa-plus','fa-minus');
                                           
           var btns = document.getElementsByClassName("active areaButton");
                                           
           var btn = document.getElementsByClassName("areaButton");
               for (var i = 0; i < btn.length; i++) {
               btn[i].className = 'AreaButton';
               }
           document.getElementById('area'+$areax).className = "active areaButton";
           for (var i = 0; i < btns.length; i++) {
           if ($areax == 'CXR')
           {
               $area = 'CXR';
               $areaHelpENG = 'Cam Ranh';
               $areaHelpKOR = '나트랑';
           }
           else if ($areax == 'DAN')
           {
               $area = 'DAN';
               $areaHelpENG = 'Da Nang';
               $areaHelpKOR = '다낭';
           }
           else if ($areax == 'PQC')
           {
               $area = 'PQC';
               $areaHelpENG = 'Phu Quoc';
               $areaHelpKOR = '푸꾹';
           }
           else{
               document.getElementById('areaCXR').className = "active areaButton";
           }
       }
                                           
        document.getElementById('bg').style.display = "block";
        document.getElementById('name').value = $name;
        document.getElementById('hotel').value = $hotel;
        document.getElementById('roomNum').value = $roomNum;
        document.getElementById('costAdult').value = $costAdult;
        document.getElementById('costOthers').value = $costOthers;
        document.getElementById('numOthers').value = $numOthers;
        document.getElementById('costBed').value = $costBed;
        document.getElementById('numBed').value = $numBed;
        document.getElementById('checkIn').value = $checkIn;
        document.getElementById('nights').value = $nights;
        document.getElementById('members').value = $members;
        document.getElementById('pusdCost').value = $pusdCost;
        document.getElementById('tourText').value = $tour;
        document.getElementById('editId').value = $id;
        document.getElementById('editButton').style.display = "block";
        output();
   }
   function edit(){
       var xhttp = new XMLHttpRequest();
       var formData = new FormData();
                                           
       formData.append("editId", document.getElementById('editId').value);
       formData.append("date", document.getElementById('today').value);
       formData.append("name", document.getElementById('name').value);
       formData.append("area", $area);
       formData.append("hotel", document.getElementById('hotel').value);
       formData.append("checkIn", document.getElementById('checkIn').value);
       
       formData.append("costAdult", document.getElementById('costAdult').value);
       
       formData.append("costBed", document.getElementById('costBed').value);
       formData.append("numBed", document.getElementById('numBed').value);
       formData.append("costOthers", document.getElementById('costOthers').value);
       formData.append("numOthers", document.getElementById('numOthers').value);
       formData.append("nights", document.getElementById('nights').value);
       formData.append("roomNum", document.getElementById('roomNum').value);
       formData.append("members", document.getElementById('members').value);
       
       formData.append("pusdCost", document.getElementById('pusdCost').value);
       formData.append("tourText", document.getElementById('tourText').value);
       
       xhttp.onreadystatechange = function(){
       if (this.readyState == 4 && this.status == 200) {
            alert("Edited");
            document.getElementById('editId').value = 0;
            document.getElementById('editButton').style.display = "none";
            search();
       }
       };
       xhttp.open("POST", "trsubmit.php");
       xhttp.send(formData);
   }
   function hide(e){
                                   //document.getElementById('searchWhat').value = screen.width;
       if (e.classList.contains('fa-minus')){
           e.classList.replace('fa-minus','fa-plus');
           document.getElementById('bg').style.display = "none";
       }
       else if(e.classList.contains('fa-plus')){
            e.classList.replace('fa-plus','fa-minus');
            document.getElementById('bg').style.display = "block";
       }
   }
   function translateENG(){
       document.getElementById('trName').innerHTML = "Name";
       document.getElementById('trCity').innerHTML = "City";
       document.getElementById('trHotel').innerHTML = "Hotel";
       document.getElementById('trRoomNumber').innerHTML = "Room no.";
       document.getElementById('trCheckIn').innerHTML = "Check In";
       document.getElementById('trNights').innerHTML = "Room Nights";
       document.getElementById('trAdultRate').innerHTML = "Room Rate(ADL)";
       document.getElementById('trBedRate').innerHTML = "Bed Rate";
       document.getElementById('trChildRate').innerHTML = "Room Rate(CHD)";
       document.getElementById('trMembers').innerHTML = "PAX";
                                           
       document.getElementById('trPusd').innerHTML = "Airport Pickup/Sending";
       document.getElementById('trTour').innerHTML = "Tours";
                                           
       document.getElementById('thDate').innerHTML = "Date";
       document.getElementById('thName').innerHTML = "Name";
       document.getElementById('thCity').innerHTML = "City";
       document.getElementById('thCheckIn').innerHTML = "Check In";
       document.getElementById('thHotel').innerHTML = "Hotel";
       document.getElementById('thMem').innerHTML = "PAX";
       document.getElementById('thRoomNum').innerHTML = "Room no.";
       document.getElementById('thNights').innerHTML = "Nights";
       
       document.getElementById('thTourText').innerHTML = "Tour";
       document.getElementById('thPriceAdult').innerHTML = "Adult Price";
       document.getElementById('thPriceBed').innerHTML = "Bed Price";
       document.getElementById('thPriceChild').innerHTML = "Child Price";
                                           
       document.getElementById('thPusd').innerHTML = "Pickup/Sending";
       
       document.getElementById('thDeposit').innerHTML = "Deposit";
       document.getElementById('thExpenditure').innerHTML = "Expenditure";
       
       document.getElementById('thTotal').innerHTML = "Total";
       document.getElementById('thRemarks').innerHTML = "Remarks";
       if (document.getElementById('thRemove'))
       {
           document.getElementById('thRemove').innerHTML = "Remove?";
       }
       if (document.getElementById('adder'))
       {
           document.getElementById('adder').innerHTML = "Add New(M)";
       }
    }
   function translateKOR()
   {
       document.getElementById('trName').innerHTML = "이름";
       document.getElementById('trCity').innerHTML = "지역";
       document.getElementById('trHotel').innerHTML = "호텔";
       document.getElementById('trRoomNumber').innerHTML = "룸수";
       document.getElementById('trCheckIn').innerHTML = "체크인";
       document.getElementById('trNights').innerHTML = "박 수";
       document.getElementById('trAdultRate').innerHTML = "성인";
       document.getElementById('trBedRate').innerHTML = "베드 추가";
       document.getElementById('trChildRate').innerHTML = "아동";
       document.getElementById('trMembers').innerHTML = "인원";
                                           
       document.getElementById('trPusd').innerHTML = "공항 픽업/샌딩";
       document.getElementById('trTour').innerHTML = "투어 추가";
                                           
       document.getElementById('thDate').innerHTML = "신청일";
       document.getElementById('thName').innerHTML = "이름";
       document.getElementById('thCity').innerHTML = "지역";
       document.getElementById('thCheckIn').innerHTML = "체크인";
       document.getElementById('thHotel').innerHTML = "호텔";
       document.getElementById('thMem').innerHTML = "인원";
       document.getElementById('thRoomNum').innerHTML = "룸수";
       document.getElementById('thNights').innerHTML = "박 수";
       document.getElementById('thTourText').innerHTML = "투어 추가";
       document.getElementById('thPusd').innerHTML = "공항 픽업/샌딩";
       
       document.getElementById('thPriceAdult').innerHTML = "성인요금";
       document.getElementById('thPriceBed').innerHTML = "베드";
       document.getElementById('thPriceChild').innerHTML = "아동추가";
       
       document.getElementById('thDeposit').innerHTML = "입금 완료";
       document.getElementById('thExpenditure').innerHTML = "지출 완료";
       
       document.getElementById('thTotal').innerHTML = "합";
       document.getElementById('thRemarks').innerHTML = "비고";
       if (document.getElementById('thRemove'))
        {
            document.getElementById('thRemove').innerHTML = "삭제?";
        }
       if (document.getElementById('adder'))
       {
           document.getElementById('adder').innerHTML = "등록 하기(M)";
       }
   }
   function translateKORTicket()
	{
       var trTour = document.getElementsByClassName("trTour");
       for (var i = 0; i < trTour.length; i++) {
                                           
            var str = trTour[i].innerHTML.trim().split('\n');
       		trTour[i].innerHTML = '';
                                           
           for (var o = 0; o < str.length; o++) {
                trTour[i].innerHTML += trCode(str[o])+"\n";
           }
       }

       var trItenary = document.getElementsByClassName("trItenary");
       for (var i = 0; i < trItenary.length; i++) {
       
           var str = trItenary[i].innerHTML.trim().split('\n');
           trItenary[i].innerHTML = '';
       
           for (var o = 0; o < str.length; o++) {
            trItenary[i].innerHTML += trAreaCode(str[o])+"\n";
           }
       }
        //Translate English dates to Korean Dates

/*		
       var trDate = document.getElementsByClassName("trDate");
       for (var i = 0; i < trDate.length; i++){
           var str = trDate[i].innerHTML.trim().split('\n');
           trDate[i].innerHTML = '';
       
           for (var o = 0; o < str.length; o++) {
                trDate[i].innerHTML += trDates(str[o])+"\n";
           }
       }
	   */
       //trDate
    }
   function translateENGTicket()
   {
       var trTour = document.getElementsByClassName("trTour");
       for (var i = 0; i < trTour.length; i++) {
           
           var str = trTour[i].innerHTML.trim().split('\n');
           trTour[i].innerHTML = '';
           
           for (var o = 0; o < str.length; o++) {
           trTour[i].innerHTML += trxCode(str[o])+"\n";
           }
       }
       
       var trItenary = document.getElementsByClassName("trItenary");
       for (var i = 0; i < trItenary.length; i++) {
       
           var str = trItenary[i].innerHTML.trim().split('\n');
           trItenary[i].innerHTML = '';
           
           for (var o = 0; o < str.length; o++) {
           trItenary[i].innerHTML += trxAreaCode(str[o])+"\n";
           }
       }
    
//Translate Korean paydates to English dates	
/*
       var trDate = document.getElementsByClassName("trDate");
       for (var i = 0; i < trDate.length; i++) {
           var str = trDate[i].innerHTML.trim().split('\n');
           trDate[i].innerHTML = '';
           
           for (var o = 0; o < str.length; o++) {
           trDate[i].innerHTML += trxDates(str[o])+"\n";
           }
       }
	   */
	   
	   
       //trDate
   }
   var lang;
   function translate(){
       if (document.getElementById('trEnglish').classList.contains('active') && lang == 'KOR'){
           if (document.getElementById('searchThis').value == 'tour')
           {
				translateENG();
           }
           if (document.getElementById('searchThis').value == 'ticketNum')
           {
                translateENGTicket();
                
           }
           lang = 'ENG';
       }
       else if (document.getElementById('trKorean').classList.contains('active')&& lang != 'KOR'){
           if (document.getElementById('searchThis').value == 'tour')
           {
                translateKOR();
           }
           if (document.getElementById('searchThis').value == 'ticketNum')
           {
           		translateKORTicket();
           }
           lang = 'KOR';
       }
   }
   function submit(){
       var xhttp = new XMLHttpRequest();
       var formData = new FormData();
       
        formData.append("date", document.getElementById('date').value);
        formData.append("docNumber", document.getElementById('docNumber').value);
        formData.append("orderNumber", document.getElementById('orderNumber').value);
        formData.append("route", document.getElementById('route').value);
        formData.append("description", document.getElementById('description').value);
        formData.append("fare", document.getElementById('fare').value);
        formData.append("tax", document.getElementById('tax').value);
        formData.append("vat", document.getElementById('vat').value);
        formData.append("PVD", document.getElementById('PVD').value);
        formData.append("local", document.getElementById('local').value);
        formData.append("VND", document.getElementById('VND').value);
        formData.append("ROE", document.getElementById('ROE').value);
       xhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
                alert("uploaded");
                search();
           }
       };
       xhttp.open("POST", "submit.php");
       xhttp.send(formData);
       loadURL('', 'planetest', '');
   }
   function search(){
       loadURL('','planetest', '?input='+document.getElementById('searchWhat').value);
    }
   function searchChange(){
       var xhttp = new XMLHttpRequest();
       var formData = new FormData();
       formData.append("searchBy", document.getElementById('searchThis').value);
       xhttp.open("POST", "changeDoc.php",true);
       xhttp.send(formData);
       xhttp.onreadystatechange = function(){
           if (this.readyState == 4 && this.status == 200){
                  search();
           }
       };
   }

   function sessionChange()
   {
       var xhttp = new XMLHttpRequest();
       var formData = new FormData();
       formData.append("searchByDate", document.getElementById('searchByDate').value);
       formData.append("searchByDate2", document.getElementById('searchByDate2').value);
       xhttp.open("POST", "changeDoc.php",true);
       xhttp.send(formData);
        xhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
                search();
           }
       };
   }
    autocomplete(document.getElementById("searchWhat"));
    function autocomplete(input) {
       input.addEventListener("input", function(e){
          var xhttp = new XMLHttpRequest();

          history.pushState('', 'New URL: ','/planetest?input='+document.getElementById('searchWhat').value);
          xhttp.open("POST", "planetest?input="+document.getElementById('searchWhat').value, true);
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.send("load=no");

          xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                document.getElementById('content').innerHTML = this.responseText;
                  if (document.getElementById('searchThis').value == 'page'){
                    newPage();
                  }
              }
          };
       });
   }


   window.addEventListener("keydown", function(e) {
      var tag = e.target.tagName.toLowerCase();
      var parentTag = e.target.parentNode.tagName.toLowerCase();
      if (e.keyCode == 77 && tag != 'input' && tag != 'textarea' && parentTag != 'td') { //esc arrow
          hide(document.getElementById('adder'));
      }


	//DELETE
       if ((document.getElementById('searchThis').value == 'page'||document.getElementById('searchThis').value == 'all') && e.keyCode == 8 && e.target.value == '' && e.target.parentNode.parentNode.classList.contains('extraRow') ){
           e.preventDefault();
           var tabbables = document.getElementsByClassName("rowDescription");
           for(var i=0; i<tabbables.length; i++) {
               if(tabbables[i] == e.target){
                   tabbables[i-1].focus();
                   break;
               }
           }
            var parent = e.target.parentNode.parentNode.parentNode; //tablebody
           for (var i = 0 ; i < parent.childNodes.length;i++)
           {
               for (var o = 0 ; o < parent.childNodes[i].childNodes.length;o++)
               {
                   if (parent.childNodes[i].childNodes[o].classList.contains('multiRow')){
                       parent.childNodes[i].childNodes[o].rowSpan -= 1;
                   }
               }
           }
          e.target.parentNode.parentNode.remove();
       }
		if (e.target.isContentEditable) {
			if (e.keyCode == 13){
				e.preventDefault();
				document.execCommand('insertHTML', true, '\n');
			}
		}
   });
   function loadURL(e, pathname, pathsearch) {
       //href = window.location.pathname+window.location.search;
       if (e != 'back')
       {
            history.pushState('', 'New URL: '+ pathname+pathsearch, pathname+pathsearch);
       }
       var xhttp = new XMLHttpRequest();
       xhttp.open("POST", pathname+pathsearch, true);
       xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       xhttp.send('load=no');
       xhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
                document.getElementById("content").innerHTML = this.responseText;
                lang = 'ENG';
                translate();
               if (document.getElementById('searchThis').value == 'page'){
                    newPage();
               }
       }
       };
   }
       $('body').on('click', 'a',function(e){
            href = $(this).attr("href");
            if (href)
            {
                $pathinfo = href.split('?');
                if (href.includes('?'))
                {
                        $paths = '?'+$pathinfo[1];
                }
                else
                {
                        $paths = '';
                }
                
                if (href.includes("https://"))
                {
                        e.preventDefault();
                        window.open(href, "");
                //newtab.location = href;
                }
            }
        });

       function change(e) {
           e.style.backgroundColor = '#ffdbba';
           e.style.zIndex = '100';
       };
       
       function change_back(e) {
           e.style.backgroundColor = 'transparent';
           e.style.zIndex = '0';
       };
       
       window.onpopstate = function(e) {
           //window.location = "https://soundabox.com"+window.location.pathname;
           href = window.location.pathname+window.location.search;

           if (href == '#')
           {
               e.preventDefault();
           }
           else if (href.includes("https://"))
           {
               e.preventDefault();
               window.open(href, "");
           //newtab.location = href;
           }
           else
           {
           };
       }
    function changeCheck(e,$change)
    {
        $docNumber = e.id;
        $today = document.getElementById('today').value;
        var xhttp = new XMLHttpRequest();
        if (e.className == 'fa fa-plus tooltip')
        {
            xhttp.open("POST", "changeDoc.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("id="+$docNumber+"&"+$change+"="+$today);
            e.className = 'fa fa-check tooltip';
            e.innerHTML =  "<span class='tooltiptext'>"+$today+"</span>";
        }
        else if (e.className == 'fa fa-check tooltip')
        {
            xhttp.open("POST", "changeDoc.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("id="+$docNumber+"&"+$change+"=0000-00-00");
            e.className = 'fa fa-plus tooltip';
            e.innerHTML = '';
        }
}
   function changeCheck2(e,$change)
   {
       $docNumber = e.id;
       $today = document.getElementById('today').value;
       var xhttp = new XMLHttpRequest();
                                           
       if (e.className == 'fa fa-plus tooltip')
       {
           xhttp.open("POST", "changeDoc.php", true);
           xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
           xhttp.send("idx="+$docNumber+"&"+$change+"="+$today);
                                           
           e.className = 'fa fa-check tooltip';
           e.innerHTML =  "<span class='tooltiptext'>"+$today+"</span>";
       }
       else if (e.className == 'fa fa-check tooltip')
       {
           xhttp.open("POST", "changeDoc.php", true);
           xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
           xhttp.send("idx="+$docNumber+"&"+$change+"=0000-00-00");
           e.className = 'fa fa-plus tooltip';
           e.innerHTML = '';
       }
   }
    function changePay(e)
   {
       $docNumber = e.id;
       var xhttp = new XMLHttpRequest();
       if (e.className == 'fa fa-plus tooltip')
       {
            xhttp.open("POST", "changeDoc.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("docNum="+$docNumber+"&paidx=1");
            e.className = 'fa fa-check tooltip';
        }
        else if (e.className == 'fa fa-check tooltip')
       {
           xhttp.open("POST", "changeDoc.php", true);
           xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
           xhttp.send("docNum="+$docNumber+"&paidx=0");
           e.className = 'fa fa-plus tooltip';
               
       }
    }

   function remove(e,$str){
       $docNumber = e.id;
       var xhttp = new XMLHttpRequest();
       xhttp.open("POST", "changeDoc.php", true);
       xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        if ($str == 'docNum')
       {
           xhttp.send("docNum="+$docNumber+"&delete=1");
       }
       if ($str == 'deleteTour')
       {
           xhttp.send("id="+$docNumber+"&deleteTour=1");
       }
       if ($str == 'ticket')
       {
           xhttp.send("idx="+$docNumber+"&deleteTicket=1");
       }
       if ($str == 'page')
       {
			xhttp.send("id="+$docNumber+"&deleteTour=1");
       }
       e.parentElement.parentNode.parentNode.remove();
   }
   
   $('body').on('click', '[editable]', function(){
        var $el = $(this);
        $docNumber = $el.attr('id');
        $change = $el.attr('class');
        $previousValue = $el.html();
        var $input = $('<input type= "number"/>').val($previousValue);

        //var $input = $('<input type= "text"/>').val($previousValue);
        $el.replaceWith($input);

        var save = function()
        {
            if ($input.val().trim() == "" )
            {
                if ($previousValue == '')
                {
                    var $p = $('<p editable>').text("0");
                }
                else
                {
                    var $p = $('<p editable />').text($previousValue);
                }
                $el.value = $previousValue;
            }
            else
            {
                var $p = $('<p editable />').text( $input.val());
                $el.value = $input.val();
                
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "changeDoc.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("docNum="+$docNumber+"&"+$change+"="+$input.val());
            }
            $p.attr('class', $change);
            $p.attr('id', $docNumber);
            $input.replaceWith( $p );
        };
        $input.one('blur', save).focus();
    });
   $('body').on('click', '[text-editable]', function(){
                
        var $el = $(this);
        $previousValue = $el.html();
        $docNumber = $el.attr('id');
        $change = $el.attr('class');
        var $input = $('<input type= "text"/>').val($previousValue);
        $el.replaceWith($input);

        var save = function()
        {
            if ($input.val().trim() == "" )
            {
                if ($previousValue == '')
                {
                    var $p = $('<p text-editable>').text("0");
                }
                else
                {
                    var $p = $('<p text-editable />').text($previousValue);
                }
                $el.value = $previousValue;
            }
            else
            {
                var $p = $('<p text-editable />').text( $input.val());
                $el.value = $input.val();
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "changeDoc.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("docNum="+$docNumber+"&"+$change+"="+$input.val());
                
            }
            $p.attr('class', $change);
            $p.attr('id', $docNumber);
            $input.replaceWith( $p );
        };
        $input.one('blur', save).focus();
    });
   $('body').on('click', '[date-editable]', function(){
        var $el = $(this);
        $previousValue = $el.html();
        $docNumber = $el.attr('id');
        $change = $el.attr('class');
        var $input = $('<input type= "date"/>').val($previousValue);
        $el.replaceWith($input);

                
        var save = function()
        {
            if ($input.val().trim() == "" )
            {
                if ($previousValue == '')
                {
                    var $p = $('<p date-editable>').text("0");
                }
                else
                {
                    var $p = $('<p date-editable />').text($previousValue);
                }
                $el.value = $previousValue;
            }
            else
            {
                var xhttp = new XMLHttpRequest();
                var formData = new FormData();
                formData.append("date", $input.val());
                formData.append("docNum", $docNumber);
                xhttp.open("POST", "changeDoc.php");
                xhttp.send(formData);
                
                var $p = $('<p date-editable />').text( $input.val());
                $el.value = $input.val();
            }
            $p.attr('class', $change);
            $p.attr('id', $docNumber);
            $input.replaceWith( $p );
        };
        $input.one('blur', save).focus();
    });

    $('body').on('click', '[editable2]', function(){
        var $el = $(this);
        $docNumber = $el.attr('id');
        $change = $el.attr('class');
        $previousValue = $el.html();
        var $input = $('<input type= "number" class = "sm"/>').val($previousValue);

        //var $input = $('<input type= "text"/>').val($previousValue);
        $el.replaceWith($input);

        var save = function()
        {
            if ($input.val().trim() == "" )
            {
                if ($previousValue == '')
                {
                 var $p = $('<p editable2>').text("0");
                }
                else
                {
                 var $p = $('<p editable2 />').text($previousValue);
                }
                $el.value = $previousValue;
            }
            else
            {
                var $p = $('<p editable2 />').text( $input.val());
                $el.value = $input.val();

                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "changeDoc.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("id="+$docNumber+"&"+$change+"="+$input.val());
                 
            }
            $p.attr('class', $change);
            $p.attr('id', $docNumber);
            $input.replaceWith( $p );
        };
        $input.one('blur', save).focus();
    });
                                           
    $('body').on('click', '[text-editable2]', function(){

        var $el = $(this);
        $previousValue = $el.html();
        $docNumber = $el.attr('id');
        $change = $el.attr('class');
        var $input = $('<input type= "text" class = "m"/>').val($previousValue);
        $el.replaceWith($input);

        var save = function()
        {
            if ($input.val().trim() == "" )
            {
                if ($previousValue == '')
                {
                 var $p = $('<p text-editable2>').text("0");
                }
                else
                {
                 var $p = $('<p text-editable2 />').text($previousValue);
                }
                $el.value = $previousValue;
            }
            else
            {
                var $p = $('<p text-editable2 />').text( $input.val());
                $el.value = $input.val();
                 var xhttp = new XMLHttpRequest();
                 var formData = new FormData();
                 formData.append($change, $input.val());
                 formData.append("id", $docNumber);
                 xhttp.open("POST", "changeDoc.php");
                 xhttp.send(formData);
            }
            $p.attr('class', $change);
            $p.attr('id', $docNumber);
            $input.replaceWith( $p );
        };
        $input.one('blur', save).focus();
    });
                                           
    $('body').on('click', '[date-editable2]', function(){
        var $el = $(this);
        $previousValue = $el.html();
        $docNumber = $el.attr('id');
        $change = $el.attr('class');
        var $input = $('<input type= "date"/>').val($previousValue);
        $el.replaceWith($input);


        var save = function()
        {
            if ($input.val().trim() == "" )
            {
                if ($previousValue == '')
                {
                 var $p = $('<p date-editable2>').text("0");
                }
                else
                {
                 var $p = $('<p date-editable2 />').text($previousValue);
                }
                $el.value = $previousValue;
            }
            else
            {
                var xhttp = new XMLHttpRequest();
                var formData = new FormData();
                formData.append($change, $input.val());
                formData.append("id", $docNumber);
                xhttp.open("POST", "changeDoc.php");
                xhttp.send(formData);

                var $p = $('<p date-editable />').text( $input.val());
                $el.value = $input.val();
            }
            $p.attr('class', $change);
            $p.attr('id', $docNumber);
            $input.replaceWith( $p );
        };
        $input.one('blur', save).focus();
    });

$('body').on('touchend', '[editable2]', function(){
    var $el = $(this);
    $docNumber = $el.attr('id');
    $change = $el.attr('class');
    $previousValue = $el.html();
    var $input = $('<input type= "number" class = "sm"/>').val($previousValue);
    
    //var $input = $('<input type= "text"/>').val($previousValue);
    $el.replaceWith($input);
    
    var save = function()
    {
    if ($input.val().trim() == "" )
    {
    if ($previousValue == '')
    {
    var $p = $('<p editable2>').text("0");
    }
    else
    {
    var $p = $('<p editable2 />').text($previousValue);
    }
    $el.value = $previousValue;
    }
    else
    {
    var $p = $('<p editable2 />').text( $input.val());
    $el.value = $input.val();
    
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "changeDoc.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id="+$docNumber+"&"+$change+"="+$input.val());
             
    }
    $p.attr('class', $change);
    $p.attr('id', $docNumber);
    $input.replaceWith( $p );
    };
    $input.one('blur', save).focus();
    });

$('body').on('touchend', '[text-editable2]', function(){
    
    var $el = $(this);
    $previousValue = $el.html();
    $docNumber = $el.attr('id');
    $change = $el.attr('class');
    var $input = $('<input type= "text" class = "m"/>').val($previousValue);
    $el.replaceWith($input);
    
    var save = function()
    {
        if ($input.val().trim() == "" )
        {
            if ($previousValue == '')
            {
                var $p = $('<p text-editable2>').text("0");
            }
            else
            {
                var $p = $('<p text-editable2 />').text($previousValue);
            }
            $el.value = $previousValue;
        }
        else
        {
            var $p = $('<p text-editable2 />').text( $input.val());
            $el.value = $input.val();
            var xhttp = new XMLHttpRequest();
            var formData = new FormData();
            formData.append($change, $input.val());
            formData.append("id", $docNumber);
            xhttp.open("POST", "changeDoc.php");
            xhttp.send(formData);
        }
        $p.attr('class', $change);
        $p.attr('id', $docNumber);
        $input.replaceWith( $p );
    };
    $input.one('blur', save).focus();
    });

$('body').on('touchend', '[date-editable2]', function(){
    var $el = $(this);
    $previousValue = $el.html();
    $docNumber = $el.attr('id');
    $change = $el.attr('class');
    var $input = $('<input type= "date"/>').val($previousValue);
    $el.replaceWith($input);
    
    
    var save = function()
    {
        if ($input.val().trim() == "" )
        {
            if ($previousValue == '')
            {
                var $p = $('<p date-editable2>').text("0");
            }
            else
            {
                var $p = $('<p date-editable2 />').text($previousValue);
            }
            $el.value = $previousValue;
        }
        else
            {
            var xhttp = new XMLHttpRequest();
            var formData = new FormData();
            formData.append($change, $input.val());
            formData.append("id", $docNumber);
            xhttp.open("POST", "changeDoc.php");
            xhttp.send(formData);
            
            var $p = $('<p date-editable />').text( $input.val());
            $el.value = $input.val();
        }
        $p.attr('class', $change);
        $p.attr('id', $docNumber);
        $input.replaceWith( $p );
    };
    $input.one('blur', save).focus();
    });
                                           
   $('body').on('click', '[date-editablePage]', function(){
        var $el = $(this);
        $previousValue = $el.html();
        $docNumber = $el.attr('id');
        $change = $el.attr('class');
        var $input = $('<input type= "date"/>').val($previousValue);
        $el.replaceWith($input);
        
        var save = function(){
            if ($input.val().trim() == "" ){
                if ($previousValue == ''){
                	var $p = $('<p date-editablePage>').text("0");
                }
                else{
                	var $p = $('<p date-editablePage />').text($previousValue);
                }
                $el.value = $previousValue;
            }
            else{
                quickPage(document.getElementById('editId').value,$input.val(),savePage('route'),savePage('str'),savePage('notes'));
                /*
                var xhttp = new XMLHttpRequest();
                var formData = new FormData();
                formData.append("date", $input.val());
                formData.append("docNum", $docNumber);
                xhttp.open("POST", "changeDoc.php");
                //xhttp.send(formData);
                */
                var $p = $('<p date-editablePage />').text( $input.val());
                $el.value = $input.val();
            }
            $p.attr('class', $change);
            $p.attr('id', $docNumber);
            $input.replaceWith( $p );
        };
        $input.one('blur', save).focus();
    });
                                           
    function copyToClipboard(text){

        var textArea = document.createElement( "textarea" );
        textArea.value = text;
        document.body.appendChild( textArea );

        textArea.select();
        document.execCommand( 'copy' );
        document.body.removeChild( textArea );
    }
                                           
   function getIndex($array, $element){
       for (var i=0; i<$array.length; i++) {
       		if ($array[i] == $element){
                return i;
           }
       }
   }
    function smartModeFocus(e){
       if (document.getElementById('searchThis').value == 'page' || document.getElementById('searchThis').value == 'all'){
           if(smartMode){
               var fellowExcelBoxes = document.getElementsByClassName('excel');
               for (var i=0; i<fellowExcelBoxes.length; i++) {
                    fellowExcelBoxes[i].style.backgroundColor = 'transparent';
               }
               var inputTr = e.target.parentNode.parentNode;
               if (inputTr.classList.contains('trBlackBorder')){
                   var fellowBoxes = document.getElementsByClassName('trBlackBorder');
                   for (var i=0; i<fellowBoxes.length; i++){
                       fellowBoxes[i].childNodes[0].childNodes[0].style.backgroundColor = '#e8deda';
                       fellowBoxes[i].childNodes[1].childNodes[0].style.backgroundColor = '#e8deda';
                       fellowBoxes[i].childNodes[2].childNodes[0].style.backgroundColor = '#e8deda';
                       fellowBoxes[i].childNodes[3].childNodes[0].style.backgroundColor = '#e8deda';
                       fellowBoxes[i].childNodes[4].childNodes[0].style.backgroundColor = '#e8deda';
                   }
               }
               else if (inputTr.classList.contains('normalRow')){
                   var fellowBoxes = document.getElementsByClassName('normalRow');
                   for (var i=0; i<fellowBoxes.length; i++){
                       if (getIndex(fellowBoxes[i].parentNode.childNodes, fellowBoxes[i]) == getIndex(e.target.parentNode.parentNode.parentNode.childNodes, e.target.parentNode.parentNode)){
   
                           fellowBoxes[i].childNodes[0].childNodes[0].style.backgroundColor = '#e8deda';
                           fellowBoxes[i].childNodes[1].childNodes[0].style.backgroundColor = '#e8deda';
                           fellowBoxes[i].childNodes[2].childNodes[0].style.backgroundColor = '#e8deda';
                           fellowBoxes[i].childNodes[3].childNodes[0].style.backgroundColor = '#e8deda';
                           fellowBoxes[i].childNodes[4].childNodes[0].style.backgroundColor = '#e8deda';
                       }
                   }
               }
           }
           else{
               var fellowBoxes = document.getElementsByClassName('excel');
               for (var i=0; i<fellowBoxes.length; i++) {
               		fellowBoxes[i].style.backgroundColor = 'transparent';
               }
           }
       }
   }
    var smartMode = false;
    window.addEventListener("click", function(e){
         smartModeFocus(e);
    });
    window.addEventListener('keyup', function(e) {
        var tag = e.target.tagName.toLowerCase();
        if (document.getElementById('searchThis').value == 'tour'){
            output();
        }
        if (document.getElementById('searchThis').value == 'page' || document.getElementById('searchThis').value == 'all'){
                            
            if (smartMode && e.keyCode != 17 && e.target.classList.contains('excel')){
                var inputTr = e.target.parentNode.parentNode;
                if (inputTr.classList.contains('trBlackBorder')){
                    var fellowBoxes = document.getElementsByClassName('trBlackBorder');
                            
                    for (var i=0; i<fellowBoxes.length; i++) {
                            
                        var index = e.target.parentNode.parentNode.childNodes;
                              
                        fellowBoxes[i].childNodes[getIndex(index, e.target.parentNode)].childNodes[0].value = e.target.parentNode.parentNode.childNodes[getIndex(index, e.target.parentNode)].childNodes[0].value;
                    }
                }
                else if (inputTr.classList.contains('normalRow')){
                    var fellowBoxes = document.getElementsByClassName('normalRow');
                    for (var i=0; i<fellowBoxes.length; i++) {
                        if (getIndex(fellowBoxes[i].parentNode.childNodes, fellowBoxes[i]) == getIndex(e.target.parentNode.parentNode.parentNode.childNodes, e.target.parentNode.parentNode) ){
                    
                            var index = e.target.parentNode.parentNode.childNodes;
                            fellowBoxes[i].childNodes[getIndex(index, e.target.parentNode)].childNodes[0].value = e.target.parentNode.parentNode.childNodes[getIndex(index, e.target.parentNode)].childNodes[0].value;
                        }
                    }
                }
                if (!e.target.classList.contains('double')){
                	updatePage();
                }
            }
            if (e.target.classList.contains('inputs')){
            	loadPage();
            }
            if (e.target.classList.contains('excel')){
                if (e.keyCode == 17){
                     smartMode = !smartMode;
                     smartModeFocus(e);
                }
            }
            if (e.target.classList.contains('rowDescription')){
                if (e.keyCode == 13){
                    addRow(e.target);
                    var tabbables = document.getElementsByClassName("rowDescription");
                    for(var i=0; i<tabbables.length; i++) {
                        if(tabbables[i] == e.target) {
                            tabbables[i+1].focus();
                            break;
                        }
                    }
                }
            }
			if (e.keyCode == 18){
			   if (e.target.classList.contains('double')){
					insertTotal();
				}
				if (e.target.parentNode.parentNode.classList.contains('trBlackBorder')||e.target.parentNode.parentNode.classList.contains('extraRow')){
					var color = '1px solid #DCDCDC';
					var className = 'excel rowDescription';
					var trClass = 'extraRow normalRow';
					if (e.target.parentNode.style.border != '1px solid gray'){
						color = '1px solid gray';
						className = 'excel';
						trClass = 'trBlackBorder';
					}
					var blackBorderChild = e.target.parentNode.parentNode.childNodes;
						blackBorderChild[1].style.border = color;
						e.target.className = className;
						e.target.parentNode.parentNode.className = trClass;
				}
			}
        }
    });

    function trDates($str){
        var str = $str.toUpperCase();
        var month = '';
        var day = '';
        var strx = str.split(' ');

        for (var i = 0; i < strx.length;i++){
           if (day == '' || day == null)
           {
                day = strx[i].match(/\d+/g);
                str = str.replace(day, '');
           }
        }
                                    
        str=str.trim();
        str =str.replace('JAN','1월');
        str =str.replace('FEB','2월');
        str =str.replace('MAR','3월');
        str =str.replace('APR','4월');
        str =str.replace('MAY','5월');
        str =str.replace('JUN','6월');
                                           
        str =str.replace('JUL','7월');
        str =str.replace('AUG','8월');
        str =str.replace('SEP','9월');
        str =str.replace('OCT','10월');
        str =str.replace('NOV','11월');
        str =str.replace('DEC','12월');
                                           

        str = str.replace('월', '월'+day+'일');
   
    	return str;
    }
   function trxDates($str)
   {
       var str = $str.toUpperCase();
       str = str.trim();
       var day = '';
       
       str =str.replace('1월','JAN');
       str =str.replace('2월','FEB');
       str =str.replace('3월','MAR');
       str =str.replace('4월','APR');
       str =str.replace('5월','MAY');
       str =str.replace('6월','JUN');
       
       str =str.replace('7월','JUL');
       str =str.replace('8월','AUG');
       str =str.replace('9월','SEP');
       str =str.replace('10월','OCT');
       str =str.replace('11월','NOV');
       str =str.replace('12월','DEC');
       str = str.replace('일','');
                                           
       var strx = str.split(' ');
       for (var i = 0; i < strx.length;i++){
           if (day == '' || day == null)
           {
               day = strx[i].match(/\d+/g);
               str = str.replace(day, '');
           }
       }
       //var date = str.match(/\d+/g);
       //str = str.replace(/\d+/g, '');
                                           
       return day+str;
   }
     function trCode($str){
       var str = $str.toUpperCase();
                                           
       str =str.replace(/AF/g,'에어프랑스');
       str =str.replace(/MH/g,'알레이시아항공');
       str =str.replace(/QF/g,'콴타스항공');
       
       str =str.replace(/KE/g,'대항항공');
       str =str.replace(/OZ/g,'아시아나항공');
       str =str.replace(/BX/g,'에어부산');
       str =str.replace(/LJ/g,'진에어항공');
       str =str.replace(/7C/g,'제주항공');
       str =str.replace(/TW/g,'티웨이항공');
       str =str.replace(/PR/g,'필리핀항공');
       str =str.replace(/QP/g,'카타르항공');
       str =str.replace(/TK/g,'터키항공');
       str =str.replace(/QV/g,'라오스항공');
       
       str = str.replace(/SQ/g,'싱가폴항공');
       str =str.replace(/TG/g,'타이항공');
       str =str.replace(/CI/g,'중화항공');
       str =str.replace(/JL/g,'일본항공');
       str =str.replace(/NH/g,'전일본공수');
                                           
       str = str.replace(/VN/g,'베트남항공');
       return str;
   }
    function trxCode($str){
        var str = $str.toUpperCase();
                                           
        str =str.replace(/에어프랑스/g,'AF');
        str =str.replace(/알레이시아항공/g,'MH');
        str =str.replace(/콴타스항공/g,'QF');

        str =str.replace(/대항항공/g,'KE');
        str =str.replace(/아시아나항공/g,'OZ');
        str =str.replace(/에어부산/g,'BX');
        str =str.replace(/진에어항공/g,'LJ');
        str =str.replace(/제주항공/g,'7C');
        str =str.replace(/티웨이항공/g,'TW');
        str =str.replace(/필리핀항공/g,'PR');
        str =str.replace(/카타르항공/g,'QP');
        str =str.replace(/터키항공/g,'TK');
        str =str.replace(/라오스항공/g,'QV');

        str = str.replace(/싱가폴항공/g,'SQ');
        str =str.replace(/타이항공/g,'TG');
        str =str.replace(/중화항공/g,'CI');
        str =str.replace(/일본항공/g,'JL');
        str =str.replace(/전일본공수/g,'NH');

        str = str.replace(/베트남항공/g,'VN');
        return str;
    }
   function trAreaCode($str){
       var str = $str.toUpperCase();
       return (trAreaCodex($str.substring(0,3)) +"-"+ trAreaCodex($str.substring(3))).replace(/--/g,'');
   }
   function trxAreaCode($str){
       var str = $str.split('-');
       return trxAreaCodex(str[0])+trxAreaCodex(str[1]);
   }
   function trAreaCodex($str){
       var str = $str.toUpperCase();
       str =str.replace('NRT','동경');
       str =str.replace('KIX','오사카');
       str =str.replace('AOJ','아오모리');
       str =str.replace('KOJ','가고시마');
       str =str.replace('KIJ','니이가타');
       
       str =str.replace('BJS','북경');
       str =str.replace('CAN','광쩌우');
       str =str.replace('SHA','상해');
       str =str.replace('YNT','연대');
       
       str =str.replace(/HKG/g,'홍콩');
       str =str.replace(/TPE/g,'타이페이');
       str =str.replace(/DEL/g,'뉴델리');
       str =str.replace(/BKI/g,'코타키나바루');
       str =str.replace(/ULN/g,'울란바토르');
       str =str.replace(/BKK/g,'방콕');
       str =str.replace(/MNL/g,'마닐라');
       str =str.replace(/SGN/g,'호치민');
       str =str.replace(/KUL/g,'뭄쿠앙아움푸트');
       str =str.replace(/SIN/g,'싱가풍');
       str =str.replace(/HKT/g,'푸켓');
       str =str.replace(/CGK/g,'자카르타');
       str =str.replace(/BOM/g,'뭄바이');
       str =str.replace(/ICN/g,'인천');
       str =str.replace(/DAD/g,'다낭');
       str =str.replace(/PQC/g,'푸꾹');
       str =str.replace(/CXR/g,'나트랑');
       
       str =str.replace(/LAX/g,'로스엔젤레스');
       str =str.replace(/HNL/g,'호놀룰루');
       str =str.replace(/IAD/g,'워싱턴');
       str =str.replace(/YVR/g,'밴쿠버');
       str =str.replace(/JFK/g,'뉴욕');
       str =str.replace(/DFW/g,'댈러스');
       
       str =str.replace(/AKL/g,'오크랜드');
       str =str.replace(/GUM/g,'괌');
       str =str.replace(/BNE/g,'브리스베인');
       str =str.replace(/SPN/g,'사이판');
       str =str.replace(/CHC/g,'크라이스처지');
       str =str.replace(/SYD/g,'시드니');
       
       str =str.replace(/AMS/g,'암스텔담');
       str =str.replace(/CDG/g,'파리');
       str =str.replace(/FRA/g,'프랑프푸르트');
       str =str.replace(/FCO/g,'로마');
       str =str.replace(/LHR/g,'크라이스처지');
       str =str.replace(/ZRH/g,'시드니');
       return str;
   }
   function trxAreaCodex($str){
       var str = $str.toUpperCase();
       str =str.replace(/동경/g,'NRT');
       str =str.replace(/오사카/g,'KIX');
       str =str.replace(/아오모리/g,'AOJ');
       str =str.replace(/가고시마/g,'KOJ');
       str =str.replace(/니이가타/g,'KIJ');
       
       str =str.replace(/북경/g,'BJS');
       str =str.replace(/광쩌우/g,'CAN');
       str =str.replace(/상해/g,'SHA');
       str =str.replace(/연대/g,'YNT');
       
       str =str.replace(/홍콩/g,'HKG');
       str =str.replace(/타이페이/g,'TPE');
       str =str.replace(/뉴델리/g,'DEL');
       str =str.replace(/코타키나바루/g,'BKI');
       str =str.replace(/울란바토르/g,'ULN');
       str =str.replace(/방콕/g,'BKK');
       str =str.replace(/마닐라/g,'MNL');
       str =str.replace(/호치민/g,'SGN');
       str =str.replace(/뭄쿠앙아움푸트/g,'KUL');
       str =str.replace(/싱가풍/g,'SIN');
       str =str.replace(/푸켓/g,'HKT');
       str =str.replace(/자카르타/g,'CGK');
       str =str.replace(/뭄바이/g,'BOM');
       str =str.replace(/인천/g,'ICN');
       str =str.replace(/다낭/g,'DAD');
       str =str.replace(/푸꾹/g,'PQC');
       str =str.replace(/나트랑/g,'CXR');
       
       str =str.replace(/로스엔젤레스/g,'LAX');
       str =str.replace(/호놀룰루/g,'HNL');
       str =str.replace(/워싱턴/g,'IAD');
       str =str.replace(/밴쿠버/g,'YVR');
       str =str.replace(/뉴욕/g,'JFK');
       str =str.replace(/댈러스/g,'DFW');
       
       str =str.replace(/오크랜드/g,'AKL');
       str =str.replace(/괌/g,'GUM');
       str =str.replace(/브리스베인/g,'BNE');
       str =str.replace(/사이판/g,'SPN');
       str =str.replace(/크라이스처지/g,'CHC');
       str =str.replace(/시드니/g,'SYD');
       
       str =str.replace(/암스텔담/g,'AMS');
       str =str.replace(/파리/g,'CDG');
       str =str.replace(/프랑프푸르트/g,'FRA');
       str =str.replace(/로마/g,'FCO');
       str =str.replace(/크라이스처지/g,'LHR');
       str =str.replace(/시드니/g,'ZRH');
       return str;
   }
   function AreaCodeFull($str){
       var str = $str.toUpperCase();
       str =str.replace('SGN','Sai Gon');
       str =str.replace('HAN','Ha Noi');
       str =str.replace('NHA','Nha Trang');
       str =str.replace('PQC','Phu Quoc');
	   str =str.replace('DLI','Da Lat');
       str =str.replace('HUI','Hue');
       str =str.replace('HPH','Hai Phong');
       str =str.replace('DAD','Da Nang');
	   
	   str =str.replace('ICN','Incheon');
       str =str.replace('PUS','Pusan');
       str =str.replace('SEL','Seoul');
	   
       str =str.replace('BAV','Bao Tou');
	   str =str.replace('BHY','Bei Hai');
       str =str.replace('PEK','Bei Jing');
       str =str.replace('CGQ','Chang Chun');
       str =str.replace('CSX','Chang Sa');
	   str =str.replace('CTU','Cheng Du');
       str =str.replace('CKG','Chong Qing');
       str =str.replace('DLC','Da Lian');
       str =str.replace('DIG','Di Qing');
	   str =str.replace('FOC','Fu Zhou');
       str =str.replace('CAN','Guang Zhou');
       str =str.replace('KWL','Gui Lin');
	   str =str.replace('KWE','Gui Zang');
       str =str.replace('SHA','ShangHia');
	   str =str.replace('HRB','Ha Er Bin');
       str =str.replace('HAK','Hai Kou');
       str =str.replace('TNA','Ji Nan');
       str =str.replace('JNZ','Ji Nan');
	   str =str.replace('JIU','Jiu Jiang');
       str =str.replace('KMG','Kun Ming');
       str =str.replace('LHW','Lan Zhou');
       str =str.replace('LJG','Li Jiand');
	   str =str.replace('LYI','Lin Yi');
       str =str.replace('MIG','Mian Yang');
       str =str.replace('KHN','Nan Chang');
       str =str.replace('NNG','Nan Ning');
	   str =str.replace('SHP','Qin Huang Dao');
       str =str.replace('TAO','Qing Dao');
       str =str.replace('SYX','San Ya');
       str =str.replace('SWA','Shan Tou');
	   str =str.replace('SHE','Shen Yang');
       str =str.replace('SZX','Shen Zhen');
       str =str.replace('SWJ','Shi Jia Zhuang');
       str =str.replace('TYN','Tai Yuan');
	   str =str.replace('TSN','Tian Jin');
       str =str.replace('WXN','Wan Xian');
       str =str.replace('WEH','Wei Hai');
       str =str.replace('WNZ','Wen Zhou');
	   str =str.replace('WUH','Wu Han');
       str =str.replace('XIY','Xi An');
       str =str.replace('XNN','Xi Ning');
	   str =str.replace('JHG','Xi Shuang Ban Na');
       str =str.replace('XMN','Xia Men');
       str =str.replace('XFN','Xiang Fan');
       str =str.replace('XUZ','Xu Zhou');
	   str =str.replace('YNT','Yan Tai');
       str =str.replace('YIH','Yi Chang');
       str =str.replace('INC','Yi Chuan');
       str =str.replace('YCU','Yun Cheng');
	   str =str.replace('ZHA','Zhan Jiang');
       str =str.replace('DYG','Zhang Jia Jie');
       str =str.replace('CGO','Zhen Zhou');
	   
       str =str.replace('REP','Siem Riep');
	   str =str.replace('PNH','Phrom Penh');
       str =str.replace('LAO','laos');
       str =str.replace('KUL','Kuala Lurmpur');
	   str =str.replace('MNL','Manila');
       str =str.replace('HKG','Hong Kong');
       str =str.replace('MFM','Ma Cau');
       str =str.replace('TPE','Tai Pei');
	   str =str.replace('SIN','Singapore');
       str =str.replace('BKK','Bangkok');
	   str =str.replace('JKT','Jakarta');
	   
       str =str.replace('IST','Istanbul');
       str =str.replace('ADA','Adana');
	   
       str =str.replace('TYO','Tokyo');
	   str =str.replace('OSA','Osaka');
       str =str.replace('FUK','Fukuoka');
       str =str.replace('NGO','Nagoya');
       str =str.replace('FSZ','Shizuoka');
	   str =str.replace('PRG','Prague');
       str =str.replace('ATH','Athenes');
       str =str.replace('CPH','Copenhagen');
	   
       str =str.replace('WLG','Wellington');
	   str =str.replace('AKL','Auckland');
       str =str.replace('TAS','Tashkent');
       str =str.replace('YTO','Toronto');
	   
       str =str.replace('LAX','Las Angeles');
	   str =str.replace('SFO','San Fransisco');
       str =str.replace('SEA','Seattle');
       str =str.replace('LAS','Las Vegas');
       str =str.replace('HNL','Honolulu');
	   str =str.replace('YVR','Vancouver');
       str =str.replace('ATL','Atlanta');
       str =str.replace('CHI','Chicago');
	   str =str.replace('DFW','Dallas');
       str =str.replace('WAS','Washington');
       str =str.replace('NYC','New York');
	   
       str =str.replace('LED','Saint Peterburg');
	   str =str.replace('MOW','Moscow');
       str =str.replace('VVO','Vladivostok');
       str =str.replace('BHX','Birningham');
       str =str.replace('GLA','Glashow');
	   str =str.replace('MAN','Manchester');
       str =str.replace('NCL','New Caltle');
       str =str.replace('LHR','Lon Don');
	   
       str =str.replace('ROM','Roma');
	   str =str.replace('MIL','Milan');
	   str =str.replace('VEC','Venice');
	   
       str =str.replace('BER','Berlin');
	   str =str.replace('MUC','Munich');
       str =str.replace('FRA','Frankfurt');
	   str =str.replace('DUS','Duesseldorf');
       str =str.replace('PAR','Paris');
       str =str.replace('NEC','Nice');
       str =str.replace('SYD','Sydnye');
	   str =str.replace('MEL','Melbourne');
       str =str.replace('VIE','Vienna');

	   
	   return str;
   }
   function translateText($text){
   }
    function inputText(e){
       var value = e.value;
       value = value.trim().replace(/^\s*[\r\n]/gm, '');
        var str = value.split('\n');
                                
       var tr = '';
       var cl = '';
        document.getElementById('new3').innerHTML = str[0].trim();
        document.getElementById('new4').innerHTML = str[1].trim().replace(/  /g,'\n');
                                           
        document.getElementById('new5').innerHTML ='';
        document.getElementById('new6').innerHTML ='';
        document.getElementById('new7').innerHTML ='';
        document.getElementById('new8').innerHTML ='';
        document.getElementById('new9').innerHTML ='';
        document.getElementById('new10').innerHTML ='';
                                           
                                           
        tr += str[0]+'\n'+ str[1]+'\n';
        for (var i = 2; i < str.length-2; i++) {
            var str2 = str[i].replace(/[^\w\s!?]/g,'').replace(/ +(?= )/g,'').trim().split(' ');
            tr += (i-1) +' ';
            for (var x = 0; x < str2.length; x++) {
            	if (str2[x].length == 1 && str2[x].match(/[a-zA-Z]/) != null)
               {
               		document.getElementById('new9').innerHTML += str2[x] + "\n";
                    cl = str2[x] + ' ';
                    str2.splice(x,1);
               }
            }
                                           
                                           
            var o = 0;
            document.getElementById('new5').innerHTML += trCode(str2[o+1].substring(0, 2)) + "\n";
            tr += trCode(str2[o+1].substring(0, 2)) + ' ';
           if (str2[o+1].length <= 2)
           {
               o++;
               document.getElementById('new6').innerHTML += str2[o+1]+ "\n";
               tr += str2[o+1] + ' ';
           }
           else
           {
               document.getElementById('new6').innerHTML += str2[o+2].substring(2)+ "\n";
               tr += str2[o+2].substring(2) + ' ';
           }
            document.getElementById('new7').innerHTML += trDates(str2[o+2])+ "\n";
            document.getElementById('new8').innerHTML += trAreaCode(str2[o+3])+ "\n";
            //document.getElementById('new9').innerHTML += str2[o+4]+ "\n";
            document.getElementById('new10').innerHTML += str2[o+4];
            document.getElementById('new10').innerHTML += " "+str2[o+5]+ "\n";
                                           
            tr += trDates(str2[o+2]) + ' '+ cl + ' ' + trAreaCode(str2[o+3]) + ' ' + str2[o+4] + ' '+ str2[o+5] + '\n';
		}
        document.getElementById('new11').innerHTML = str[(str.length-2)].match(/\d+/g);
            tr += 'SALE: '+ str[(str.length-2)].match(/\d+/g);
        var str3 = str[(str.length-2)].trim().split(' ');
        document.getElementById('new12').innerHTML = str3[str3.length-1].replace(/\d+/g, '').replace(/,/g,'');
            tr += str3[str3.length-1].replace(/\d+/g, '').replace(/,/g,'')+'\n';
        document.getElementById('new13').innerHTML = trDates(str[(str.length-1)].substring(10));
            tr += 'DEADLINE: ' + trDates(str[(str.length-1)].substring(10));
                                           
           document.getElementById('translateTxt').innerHTML = tr;
           document.getElementById('translateTextKOR').innerHTML = tr;
    }
	
    function outputText($idx){
	getNewTicketData($idx);
	var str = '';
	str += $areaCode += '\n';
	str += $name.replace('\n', '  ') +'\n';

	strx = $tour.trim().split('\n');
	for (var i = 0; i < strx.length; i++){

		str += (i+1) +' ';
		str += $tour.split('\n')[i] + ' ';
		str += $tourID.split('\n')[i] + ' ';
		str += $startDate.split('\n')[i] + ' ';
		str += $itenary.split('\n')[i] + ' ';
		str += $class.split('\n')[i] + ' ';
		str += $time.split('\n')[i] + '\n';
			
	}
                                            
    str += '===>SALES: '+ $price + $currency +'\n';
    /*if (lang == 'KOR')
    {
		str += 'DEADLINE: '+trxDates($payDate);
    }
    else{*/
    	str += 'DEADLINE: '+$payDate;
    //}
   
   document.getElementById('editId').value = $idx;
   document.getElementById('editTicket').style.display = 'block';
    document.getElementById('translateText').value = str;
    inputText(document.getElementById('translateText'));
    }
	
	function outputTextVietJet($idx){
		getNewTicketData($idx);
		var str = '';
		str += $areaCode += '\n';
		str += $name.replace('\n', '  ') +'\n';

		strx = $tour.trim().split('\n');
		for (var i = 0; i < strx.length; i++){

			str += $tour.split('\n')[i];
			str += $tourID.split('\n')[i] + ' ';
			str += $startDate.split('\n')[i] + ' ';
			
			str += $class.split('\n')[i] + ' ';
			
			str += $time.split('\n')[i].split(' ')[0].substring(0,2) + ':' + $time.split('\n')[i].split(' ')[0].substring(2) + ' - ';
			str += AreaCodeFull($itenary.split('\n')[i].substring(0,3)) + '(' + $itenary.split('\n')[i].substring(0,3) + ') ';
			
			str += $time.split('\n')[i].split(' ')[1].substring(0,2) + ':' + $time.split('\n')[i].split(' ')[1].substring(2) + ' - ';
			str += AreaCodeFull($itenary.split('\n')[i].substring(3)) + '(' + $itenary.split('\n')[i].substring(3) + ') ';
			str += '\n';
		}
											   
		str += '===>SALE FARE: '+ $price + $currency +'\n';
		/*if (lang == 'KOR')
		{
			str += 'DEADLINE: '+trxDates($payDate);
		}
		else{*/
			str += 'DEADLINE: '+$payDate;
		//}
		document.getElementById('editId').value = $idx;
		document.getElementById('editTicket').style.display = 'block';
		document.getElementById('translateText').value = str;
		inputText(document.getElementById('translateText'));
    }
	
	
		function outputTextBamboo($idx){
		getNewTicketData($idx);
		var str = '';
		str += $areaCode += '\n';
		str += $name +'\n';

		strx = $tour.trim().split('\n');
		for (var i = 0; i < strx.length; i++){

			str += '(' + $startDate.split('\n')[i] + ') \n';
			

			
			str += $time.split('\n')[i].split(' ')[0].substring(0,2) + ':' + $time.split('\n')[i].split(' ')[0].substring(2) + ' ';
			str += AreaCodeFull($itenary.split('\n')[i].substring(0,3)) + '(' + $itenary.split('\n')[i].substring(0,3) + ') \n';


			str += $time.split('\n')[i].split(' ')[1].substring(0,2) + ':' + $time.split('\n')[i].split(' ')[1].substring(2) + ' ';
			str += AreaCodeFull($itenary.split('\n')[i].substring(3)) + '(' + $itenary.split('\n')[i].substring(3) + ') \n';

			
			str += $tour.split('\n')[i] + ' ';
			str += $tourID.split('\n')[i] + '\n';
			str += ": " + $class.split('\n')[i] + '\n';
			
			str += '\n';
		}
		
		//replace :: with : for different time formats(12:00 vs 1200)
		str = str.replace(/::/g, ':');
											   
		str += '===>SALE FARE: '+ $price + $currency +'\n';
		/*if (lang == 'KOR')
		{
			str += 'DEADLINE: '+trxDates($payDate);
		}
		else{*/
			str += 'DEADLINE: '+$payDate;
		//}
		document.getElementById('editId').value = $idx;
		document.getElementById('editTicket').style.display = 'block';
		document.getElementById('translateText').value = str;
		//inputText(document.getElementById('translateText'));
    }
	
	
    function submitTicket(e){
       var value = document.getElementById('translateText').value;
       value = value.trim().replace(/^\s*[\r\n]/gm, '');
       var str = value.split('\n');
                                           
       var xhttp = new XMLHttpRequest();
       var formData = new FormData();
                                           
       var $tour = '';
       var $tourID = '';
       var $startDate = '';
       var $itenary = '';
       var $class = '';
       var $time = '';
                                        
       for (var i = 2; i < str.length-2; i++) {
           var str2 = str[i].replace(/[^\w\s!?]/g,'').replace(/ +(?= )/g,'').trim().split(' ');
           for (var x = 0; x < str2.length; x++) {
               if (str2[x].length == 1 && str2[x].match(/[a-zA-Z]/) != null)
               {
                   $class += str2[x] + "\n";
                   str2.splice(x,1);
               }
           }
           var o = 0;
           $tour += str2[o+1].substring(0, 2) + "\n";
           if (str2[o+1].length <= 2)
           {
               o++;
               $tourID += str2[o+1]+ "\n";
           }
            else
           {
               $tourID += str2[o+1].substring(2)+ "\n";
           }
           
           $startDate += str2[o+2]+ "\n";
           $itenary += str2[o+3]+ "\n";
           $time += str2[o+4];
           $time += " "+str2[o+5]+ "\n";
       }
       if (document.getElementById('editId').value >= 1 && e.id == 'editTicket')
       {
            formData.append("editId", document.getElementById('editId').value);
       }
       $today = document.getElementById('today').value;
       formData.append("date", $today);
       formData.append("areaCode", str[0].trim());
       formData.append("name", str[1].trim().replace(/  /g,'\n'));
       formData.append("tour", $tour);
       formData.append("tourID", $tourID);
       
       formData.append("startDate", $startDate);
       
       formData.append("itenary", $itenary);
       formData.append("class", $class);
       formData.append("time", $time);
	   
	   //replace commas, only take digits
        var $price = str[(str.length-2)].replace(/,/g, '').match(/\d+/g);
                                           
       formData.append("price", $price);
       var str3 = str[(str.length-2)].trim().split(' ');
       formData.append("currency", str3[str3.length-1].replace(/\d+/g, '').replace(/,/g,''));
       formData.append("payDate", str[(str.length-1)].substring(10));
       
       xhttp.onreadystatechange = function(){
           if (this.readyState == 4 && this.status == 200) {
                alert("uploaded");
               document.getElementById('editId').value = 0;
               e.style.display = 'none';
               search();
           }
       };
       xhttp.open("POST", "tisubmit.php");
       xhttp.send(formData);
   }
   
   function submitTicketBamboo(e){
		var value = document.getElementById('translateText').value;
		value = value.trim().replace(/^\s*[\r\n]/gm, '');
		var str = value.split('\n');
										   
		var xhttp = new XMLHttpRequest();
		var formData = new FormData();

		var $name = '';
		var $tour = '';
		var $tourID = '';
		var $startDate = '';
		var $itenary = '';
		var $class = '';
		var $time = '';
		var $currency = '';
		var o = 1;          
		//get name
		for (var i = o; ( !str[i].includes('(') && !str[i].includes(')')) ; i++) {
				$name += str[i] + '\n';
				o = i;
		}

		//get info: tour, tourID, date, class, and itenary
		for (var i = o; (!str[i+1].toUpperCase().includes("SALE FARE")) ; i+=5){
			
			$startDate += /\(([^)]+)\)/.exec(str[i+1])[1]+ "\n";

			$itenary += /\(([^)]+)\)/.exec(str[i+2])[1];
			$itenary += /\(([^)]+)\)/.exec(str[i+3])[1] + "\n";
			
			$time += str[i+2].substring(0,5) + " ";
			$time += str[i+3].substring(0,5)+ "\n";
			
			var str2 = str[i+4].trim().split(' ');
			$tour += str2[str2.length-2]+ "\n";
			$tourID += str2[str2.length-1]+ "\n";
			$class += str[i+5].trim().split(':')[1].trim() + "\n";
			
			o = i;
		}

	   	var $price = str[(str.length-2)].substr(str[(str.length-2)].indexOf(':')+1).trim();
		var $payDate = str[(str.length-1)].substr(str[(str.length-1)].indexOf(':')+1).trim();
		var str3 = str[(str.length-2)].trim().split(' ');
		
		/*alert(str[0].trim());
		alert($name);
		alert($tour);
		alert($tourID);
		alert($startDate);
		alert($itenary);
		alert($class);
		alert($price);
		alert(str3[str3.length-1].replace(/\d+/g, '').replace(/,/g,''));
		alert($payDate);*/
		
		if (document.getElementById('editId').value >= 1 && e.id == 'editTicket')
		{
			formData.append("editId", document.getElementById('editId').value);
		}
		$today = document.getElementById('today').value;
		formData.append("date", $today);
		formData.append("areaCode", str[0].trim());
		formData.append("name", $name.trim());
		formData.append("tour", $tour);
		formData.append("tourID", $tourID);

		formData.append("startDate", $startDate);

		formData.append("itenary", $itenary);
		formData.append("class", $class);
		formData.append("time", $time);

		
		formData.append("price", $price);
		formData.append("currency", $currency);
		formData.append("payDate", $payDate);

       xhttp.onreadystatechange = function(){
           if (this.readyState == 4 && this.status == 200) {
               alert("uploaded");
               document.getElementById('editId').value = 0;
               e.style.display = 'none';
               search();
           }
       };
       xhttp.open("POST", "tisubmit.php");
       xhttp.send(formData);
   }
    function changePay(e)
    {
        $docNumber = e.id;
        $today = document.getElementById('today').value;
        var xhttp = new XMLHttpRequest();
        if (e.className == 'fa fa-plus tooltip')
        {
            xhttp.open("POST", "changeDoc.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("docNum="+$docNumber+"&paidx=1");
            e.className = 'fa fa-check tooltip';
            e.innerHTML =  $today;
        }
        else if (e.className == 'fa fa-check tooltip')
        {
            xhttp.open("POST", "changeDoc.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("docNum="+$docNumber+"&paidx=0");
            e.className = 'fa fa-plus tooltip';
            e.innerHTML = '';
        }
    }
    function clicked(e)
    {
        var btns = document.getElementsByClassName("button");
        for (var i = 0; i < btns.length; i++) {
            btns[i].className = 'button';
        }
        e.className = "active button";
                                           
                                           
       if (document.getElementById('searchThis').value == 'tour'){
       		output();
       }
       translate();
    }
    function clickedArea(e)
    {
        var btns = document.getElementsByClassName("areaButton");
        for (var i = 0; i < btns.length; i++) {
            btns[i].className = 'AreaButton';
        }
        e.className = "active areaButton";
        output();
    }
    function clickedPusd(e)
    {
        var btns = document.getElementsByClassName("pusdButton");
        for (var i = 0; i < btns.length; i++) {
            btns[i].className = 'pusdButton';
        }
        e.className = "active pusdButton";
        output();
    }
    function pusdYesNo()
    {
        if (document.getElementById('yesPusd').classList.contains('active'))
        {
            $pusd = document.getElementById('yesPusd').innerHTML;
            document.getElementById('pusdCost').style.display = 'initial';
        }
        if (document.getElementById('noPusd').classList.contains('active'))
        {
            $pusd = document.getElementById('noPusd').innerHTML;
            document.getElementById('pusdCost').style.display = 'none';
            document.getElementById('pusdCost').value = -1;
        }
    }
    function output(){
        pusdYesNo();
        var btns = document.getElementsByClassName("active areaButton");
        for (var i = 0; i < btns.length; i++) {
            if (btns[0].id == 'areaCXR')
            {
                $area = 'CXR';
                $areaHelpENG = 'Cam Ranh';
                $areaHelpKOR = '나트랑';
            }
            else if (btns[0].id == 'areaDAN')
            {
                $area = 'DAN';
                $areaHelpENG = 'Da Nang';
                $areaHelpKOR = '다낭';
            }
            else if (btns[0].id == 'areaPQC')
            {
                $area = 'PQC';
                $areaHelpENG = 'Phu Quoc';
                $areaHelpKOR = '푸꾹';
            }
        }
                                           
        $name = document.getElementById('name').value;

        $hotel = document.getElementById('hotel').value;

        $startDate = document.getElementById('checkIn').value;

        $costAdult = document.getElementById('costAdult').value;

        $costBedx = document.getElementById('costBed').value;
        $numBed = document.getElementById('numBed').value;

        $costOthers = document.getElementById('costOthers').value;
        $numOthers = document.getElementById('numOthers').value;

        $checkIn = document.getElementById('checkIn').value;

        $nights = document.getElementById('nights').value;

        $roomNum = document.getElementById('roomNum').value;

        $mem = document.getElementById('members').value;

        $pusdNum = document.getElementById('pusdCost').value;


        $trCost = 'USD';
        $trRooms = 'Rooms';
        $trNights = 'Nights';
        $trPeople = 'People';
        $trAdults = 'Adult(s)';
        $trChildren = 'Children';
                                           
        if (document.getElementById('trEnglish').classList.contains('active')){
            $trCost = 'USD';
            $trRooms = 'Rooms';
            $trNights = 'Nights';
            $trPeople = 'People';
            $trAdults = 'Adult(s)';
            $trChildren = 'Children';
            $trBed = 'Bed(s)';
            $areaHelp = $areaHelpENG;
        }
        else if (document.getElementById('trKorean').classList.contains('active')){
            $trCost = '불';
            $trRooms = '룸';
            $trNights = '박';
            $trPeople = '명';
            $trAdults = '성인';
            $trChildren = '아동';
            $trBed = '계';
            $areaHelp = $areaHelpKOR;
        }
        translate();
        var $costAdult = $costAdult*1;
        var $costOthers = $costOthers*$numOthers;
        var $costTotal = ($costAdult+$costOthers);
        var $costBed = ($costBedx * $numBed*1);
        var $total = ($costAdult+$costOthers+$costBed)*$nights;

        $trString = $area +"("+$areaHelp+")"+" - "+ $hotel + "\n"
        + "(" + ($costAdult*1).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + " " + $trCost;

        if ( ($costOthers * $numOthers) > 0)
        {
             $trString += " + " + ($costOthers*1).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + " " + $trCost + " x " + $numOthers + " " + $trPeople;
        }

        if ( ($costBedx * $numBed) > 0)
        {
            $trString += " + " +($costBedx*1).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + " " + $trCost + " x " + $numBed + " " + $trBed;
        }

        $trString += ") " + " x " + $nights + " " + $trNights;

        $trString += "\n = "+($total).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + " " + $trCost;
        document.getElementById('outputText').innerHTML = $trString;
    }
    function copy()
   {
       var clipboardText = "";
       clipboardText = $( '#outputText' ).val();
       copyToClipboard( clipboardText );
   }
   function copyTicket($str)
   {
       if ($str == 'ENG'){
           var clipboardText = "";
           clipboardText = $( '#translateText' ).val();
           copyToClipboard( clipboardText );
       }
       if ($str == 'KOR'){
           var clipboardText = "";
           //clipboardText = $( '#translateTxt' ).val();
            clipboardText = document.getElementById('translateTxt').innerHTML;
           copyToClipboard( clipboardText );
       }
   }
   function reg(){
       var xhttp = new XMLHttpRequest();
       var formData = new FormData();
       
       formData.append("date", document.getElementById('today').value);
       formData.append("name", document.getElementById('name').value);
       formData.append("area", $area);
       formData.append("hotel", document.getElementById('hotel').value);
       formData.append("checkIn", document.getElementById('checkIn').value);
       
       formData.append("costAdult", document.getElementById('costAdult').value);
       
       formData.append("costBed", document.getElementById('costBed').value);
       formData.append("numBed", document.getElementById('numBed').value);
       formData.append("costOthers", document.getElementById('costOthers').value);
       formData.append("numOthers", document.getElementById('numOthers').value);
       formData.append("nights", document.getElementById('nights').value);
       formData.append("roomNum", document.getElementById('roomNum').value);
       formData.append("members", document.getElementById('members').value);
       
       formData.append("pusdCost", document.getElementById('pusdCost').value);
       formData.append("tourText", document.getElementById('tourText').value);
       
       xhttp.onreadystatechange = function(){
           if (this.readyState == 4 && this.status == 200) {
               alert("uploaded");
           }
       };
       xhttp.open("POST", "trsubmit.php");
       xhttp.send(formData);
   }
                                           
    $( '#copyButton' ).click( function()
    {
        var clipboardText = "";
        clipboardText = $( '#outputText' ).val();
        copyToClipboard( clipboardText );
    });
   $( '#regButton' ).click( function(){
       var xhttp = new XMLHttpRequest();
       var formData = new FormData();
       
       formData.append("date", document.getElementById('today').value);
       formData.append("name", document.getElementById('name').value);
       formData.append("area", $area);
       formData.append("hotel", document.getElementById('hotel').value);
       formData.append("checkIn", document.getElementById('checkIn').value);
       
       formData.append("costAdult", document.getElementById('costAdult').value);
       
       formData.append("costBed", document.getElementById('costBed').value);
       formData.append("numBed", document.getElementById('numBed').value);
       formData.append("costOthers", document.getElementById('costOthers').value);
       formData.append("numOthers", document.getElementById('numOthers').value);
       formData.append("nights", document.getElementById('nights').value);
       formData.append("roomNum", document.getElementById('roomNum').value);
       formData.append("members", document.getElementById('members').value);
       
       formData.append("pusdCost", document.getElementById('pusdCost').value);
       formData.append("tourText", document.getElementById('tourText').value);

       
       xhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
               alert("uploaded");
               search();
           }
       };
       xhttp.open("POST", "trsubmit.php");
       xhttp.send(formData);
   });
    loading();
    function loading() {
        $username = document.getElementById("username");
        $password = document.getElementById("password");
        $verifyPassword = document.getElementById("verifyPassword");
        $contact = document.getElementById("contact");

        if($username){
            $usernameValue = $username.value;
        }
        else
        {
            $usernameValue = '';
        }

        if($contact){
            $contactValue = $contact.value;
        }
        else
        {
            $contactValue = '';
        }

        if($password){
            $passwordValue = $password.value;
        }
        else
        {
            $passwordValue = '';
        }

        if($verifyPassword){
            $verifyPasswordValue = $verifyPassword.value;
        }
        else
        {
            $verifyPasswordValue = '';
        }

        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "log_options.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("&planetest=1");
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("userLogIn").innerHTML = this.responseText;}
        };
    }
   function logging() {
    
       $username = document.getElementById("username");
       $password = document.getElementById("password");
       $verifyPassword = document.getElementById("verifyPassword");
       $contact = document.getElementById("contactHolder");
   
       if($username){
           $usernameValue = $username.value;
       }
       else
       {
           $usernameValue = '';
       }
   
       if($contact){
           $contactValue = $contact.value;
       }
       else
       {
           $contactValue = '';
       }
   
       if($password){
           $passwordValue = $password.value;
       }
       else
       {
           $passwordValue = '';
       }
   
       if($verifyPassword){
           $verifyPasswordValue = $verifyPassword.value;
       }
       else
       {
           $verifyPasswordValue = '';
       }
       var xhttp = new XMLHttpRequest();
       xhttp.open("POST", "log_options.php", true);
       xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       xhttp.send("Log=Log&username="+$usernameValue+"&password="+$passwordValue+"&verifyPassword="+$verifyPasswordValue+"&contact="+$contactValue+"&planetest=1");
       xhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
               document.getElementById("userLogIn").innerHTML = this.responseText;
               search();
               };
       };
   }
   function submitLog(input)
   {
       if (input.keyCode === 13)
       {
           logging();
       }
   }

</script> 

