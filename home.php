<link rel="icon" href="/soundabox.png"></link>
<html lang="en">
<?php
	session_start(); 
	include_once 'dbh.inc.php';
	$included = true;
	if(isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0')//page regreshed
	{
		if (isset($_SESSION['id']))
		{
			if ($_SESSION['id']!=1 && $_SESSION['id']!=4)
			{
				session_unset();
				session_destroy();
			}
		}
	}

?>
	<link href="all.min.css" rel="stylesheet">
	<style>
	.playlistView
	{
		color: grey;
	}
	.playlistView:hover
	{
		color: orange;
	}
	.file
	{
		z-index: 1;
	}
	textarea
	{
		background-color: transparent;
	}
	#sliderbar:hover
	{
		cursor:pointer;
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

	/* Safari */
	@-webkit-keyframes spin {
		0% { -webkit-transform: rotate(0deg); }
		100% { -webkit-transform: rotate(360deg); }
	}

	@keyframes spin {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(360deg); }
	}

	#center
	{
		justify-content: center;
		display: flex;
		align-items: center;
		margin: 40px;
	}
	#rankingType
	{
		
	}
	.loader
	{
		cursor:pointer;
	}
	.notice
	{
		position: relative;
		bottom: 0;
		width: 100%;
		height: 75px;
		background-color: orange;
		color: white;
	}
	.savePlaylist, .deletePlaylist
	{
		margin: 8px;
		margin-top:0px;
		float: right;
		position: absolute;
		
	}

	#drag1
	{
		border-radius: 10px;
	}
	.scrollmenuNav
	{
		margin-top: 10px;
		position: absolute;
		width: 100%;
		min-width: 500px;
		max-width: 1200px;
	}
	div.scrollmenu {
		overflow: auto;
		white-space: nowrap;
		align-items: center;
		margin: 50px auto 10px auto;
		min-width: 500px;
		max-width: 1200px;
		border: 2px solid #e9e9e9;
		background-color: white;
	}
	div.scrollmenuQueue {
		overflow: auto;
		white-space: nowrap;
		align-items: center;
		margin: 0px auto 0px auto;
		width: 100%;
		min-width: 500px;
		max-width: 1500px;
		border: 2px solid #e9e9e9;
		background-color: white;
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
	
	.scrollmenu::-webkit-scrollbar-button:single-button {
		background-color: white;
		display: block;
		border-style: solid;
		height: 100%;
		width: 16px;
		
	}
	/* Up */
	.scrollmenu::-webkit-scrollbar-button:single-button:horizontal:decrement {
		border-width: 8px 8px 8px 0px;
		border-color: transparent orange transparent transparent;
	}

	.scrollmenu::-webkit-scrollbar-button:single-button:horizontal:decrement:hover {
	  border-color: transparent #C15B01 transparent transparent;
	}
	/* Down */
	.scrollmenu::-webkit-scrollbar-button:single-button:horizontal:increment {
	  border-width: 8px 0px 8px 8px;
	  border-color: transparent transparent transparent orange;
	}

	.scrollmenu::-webkit-scrollbar-button:single-button:horizontal:increment:hover {
	  border-color: transparent transparent transparent #C15B01;
	}
	
		/* width */
	.scrollmenu::-webkit-scrollbar {
		width: 10000px;
	}
	 
	/* Handle */
	.scrollmenu::-webkit-scrollbar-thumb {
		background: orange; 
		border-radius: 16px;
		border-style: solid;
		border-width: 0px 8x 0px 8px;
		border-color: white;
	}

	/* Handle on hover */
	.scrollmenu::-webkit-scrollbar-thumb:hover {
		background: #C15B01; 
	}
	.responsiveScroll{
		display: inline-block;
		margin: 50px 5px 5px 5px;
		width: 15%;	
		min-width: 100px;
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
	
	#pleaseLogIn
	{
		color: orange;
		text-align: center;
	}
	#saveIcon
	{
		z-index: 10;
		padding: 8px;
		color: grey;
		float: left;
	}

	.delete
	{
		padding: 8px;
		color: grey;
		float: right;
	}
	.deleteFile
	{
		padding: 8px;
		color: grey;
	}
	.delete:hover
	{
		color: orange;
	}
	.tooltip {
		white-space: normal;
		position: relative;
	}

	.tooltip .tooltiptext {
		font-weight: normal;
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
		visibility: hidden;
		width: auto;
		background-color: black;
		color: #fff;
		z-index: 1;
		display: inline-block;
		text-align: center;
		align-items: center;
		border-radius: 6px;
		margin: 5px;
		padding: 5px;
		position: absolute;
		bottom: 100%;
		opacity: 0;
		transition: opacity 1s;
		display: flex;
		align-items: center;
	}
	#profilePicTooltip
	{	 
		z-index: 1;
		vertical-align: middle;
		float: left;
		margin-left: 10px;
		width: 40px;
		height: 40px;
	}
	.tooltipHTMLText
	{
		margin: 5px;
		font-size: 12px;
		display: inline-block;
		vertical-align: middle;
	}
	.tooltip .tooltiptext::after {
		content: "";
		position: absolute;
		border-width: 5px;
		border-style: solid;
		border-color: transparent black transparent transparent;
	}
	.tooltip:hover .tooltiptext {
		visibility: visible;
		opacity: 1;
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
	.saveButton
	{
		transition: 0.2s;
		padding: 3px;
		border: none;
		background-color: grey;
		color: white;
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
		align-items: center;
		display: flex;
		padding: 0px;
		margin: 50px auto 0px auto;
		min-width: 600px;
		max-width: 1200px;
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
	table {
		width: 100%;
		z-index: 1;
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

	#contentList th, td {
		border: 1px solid #DCDCDC;
		border-collapse: collapse;
		padding: 15px;
	}
	.centerTable 
	{	
		text-align: center; 
		vertical-align: middle;
	}
	.centerTableDetails
	{
		min-width:350px;
	}
	th
	{
		background-color: white;
		z-index: 10;
		position: -webkit-sticky; /* Safari */
		position: sticky;
		top: 53px;
		border-bottom: 2px solid orange;
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
		zoom: 85%;
		font-size: 100%;
		margin: 0;
		font-family: Arial, Helvetica, sans-serif;
		}

	.topnav {
		top: 0;
		height:50px;
		min-width: 1050px;
		position: sticky;
		position: -webkit-sticky; /* Safari */
		width:100%;
		background-color: #e9e9e9;
		display: flex;
		align-items: center;
		z-index: 99;
		justify-content: space-between;
	   -moz-box-shadow: 0 8px 6px -6px black;
	    box-shadow: 0 8px 6px -6px black;
		}
		
	@media screen and (max-width: 600px) {
		.topnav {
		min-width: 600px;
		width: 100%;
		}
		.seasonals{
			display: none;
		}
		#userLogIn{
		display: none;
		}
		body {
			zoom: 100%;
			min-width: 600px;
		}
		table{
			zoom: 75%;
		}
		#dragableYT
		{
			opacity: 0;
		}
		.centerTableDetails
		{
			min-width:0px;
		}
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
		border-radius: 25px 0px 0px 25px ;
		}

	.topnav #searchWhat {	
		padding: 6px;
		font-size: 17px;
		border: none;
		width: 400px;
		border-radius: 0px 25px 25px 0px ;
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
	.slider {
		-webkit-appearance: none;
		width: 100%;
		height: 5px;
		border-radius: 5px;
		background: #d3d3d3;
		outline: none;
		//opacity: 0.5;
		-webkit-transition: .2s;
		transition:.2s;
	}
	.volSlider {
		-webkit-appearance: none;
		width: 100%;
		height: 5px;
		border-radius: 5px;
		background: #d3d3d3;
		outline: none;
		//opacity: 0.5;
		-webkit-transition: .2s;
		transition:.2s;
	}

	.slider:hover{
		opacity: 1;
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

#rightUnderSearchBar{
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

</style>

	<body>
	
	
		<meta name="viewport" content="width=device-width, initial-scale=.8">
		<link rel="apple-touch-icon image_src" href="/soundabox.png">
		<meta name="twitter:site" content="@soundabox">

		<meta property='og:image' content = 'https://soundabox.com/soundabox.png'>
		<meta property='og:site_name' content = 'Soundabox'>
		<div class="topnav">
				<div>
					<a class="active loader navLoader" href = '/' title = 'Home' onclick = "loadURL(this,'index','')"><img style = 'height:100%;width:50px;padding:5px;' src = 'whiteSoundabox.png' alt = 'logo'></a>
					<!--<a class="loader navLoader seasonals" href = 'index?index=seasonals' title = 'Winter 2019'>Winter 2019</a>-->
				</div>
				<div class="search-container">
						<select id = "searchThis" class = "searchDropdown">
							<option id = 'searchOption' value="all">&nbsp;&nbsp;All</option>
							<option id = 'searchOption' value="track">&nbsp;&nbsp;Track</option>
							<option id = 'searchOption' value="artists">&nbsp;&nbsp;Artists</option>
							<option id = 'searchOption' value="source">&nbsp;&nbsp;Source</option>
						</select>
						<div id = 'searchBox'>
							<input id = "searchWhat" type="text" placeholder="Search for track..." name="search" autocomplete="off"><div id = 'rightUnderSearchBar'></div></input>
						</div>
						<button style = "background-color: transparent" type="submit"> <i style = 'position: relative;font-size: 19px;' class="fa fa-search" onclick = "search()"></i></button>
				</div>
				
		<div id ='userLogIn'></div>
		</div>
	</body>
  	<div id = 'wrapper'>
		<audio id = 'currentTrack' class = 'musicfile'>
				<source id = 'soundSource' name = 'soundSource' type='audio/mp3'>
		</audio>
		<div id = 'queuedTrack'>
			<div class='scrollmenuQueue scrollmenu' style = 'margin: 0px autp 0px auto; width: 100%'>
				<div style = 'height:20px;'>
					<i id = 'minmax' onclick = 'minimize()' style = 'margin: 2px;' class = 'fa fa-window-minimize' title = 'M to Minimize/Maximize'></i>
					<i id = 'clearQueue' onclick = 'clearQueue()' style = 'margin: 2px;' class = 'fa fa-trash' title = 'T to Clear Queue'></i>
				</div>
				<div id = 'queue'>
				</div>
			</div>
		</div>
		<div class = 'player'>
			<div class= 'slidecontainer tooltip'>
				<input id = 'sliderBar' type='range' min='1' max='1000' value='0' class='slider tooltip'  onmouseup ='changeTime()'>
				<span id = 'tooltipTime' class='tooltiptext'>0:00</span>
				
				<div id = 'dragCircle'></div>
				</input>
			</div>
			
			<div id = 'soundButtons'>
					<button class = 'soundPlayerButton pb' type = 'button'> <i id = 'playButton' style = 'position: relative;font-size: 19px;' class='fa fa-play soundPlayerIcon'></i></button>
					<button  class = 'soundPlayerButton mb' type = 'button' ><i id = 'muteButton' style = 'position: relative;font-size: 25px;' class='fa fa-volume-up soundPlayerIcon'></i>	</button>
					<button id = 'soundBarButton' class = 'soundPlayerButton sb' type = 'button' >
						<div id = 'volumeArea'>
							<input id = 'soundBar'  type='range' min='0' max='100' value=
							<?php 
								session_start();
								echo "'".$_SESSION['volume']."'";
							?>
							class='volSlider fa volumeIcon' onmouseup ='setVolume()'></input>
						</div>
					</button>
					<span id = 'currentTime'> 0:00 </span> &nbsp;/&nbsp; <span id = 'fullDuration'>0:00</span>

			</div>

			<div id = 'soundNavBottom' style = 'display:none'><div class = 'spinner'></div><span style = 'font-size: 75%;' id = 'downloadMessage'>It's downloading. It'll download eventually...</span>
				<a onclick = 'cancelDownload()'><i class='fa fa-times-circle tooltip'><span class='tooltiptext'>Cancel Download</span></i></a>
			</div>
			
			<div style = 'float: right; margin: 5px; margin-right:50px' id = 'currentPlaying'>
			</div>
		</div>
	</div>
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.4.js"></script>
<script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<iframe id = 'downloadRec' style = 'display:none' style='width: 300px; height: 150px; border: 0px;'></iframe>
<div id="fixed">
	<div id = 'snapper'></div>
	<div id="dragableYT" style = 
	<?php
		$YoutubeHider = "'opacity:1; pointer-events: auto'";
		
		if (!empty($_SESSION['userID']))
		{
			$userID = $_SESSION['userID'];
			$YoutubeHidden = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE id = $userID;"))['YoutubeHider'];
			if ($YoutubeHidden == 'true')
			{
				$YoutubeHider = "'opacity:0; pointer-events: none'";
			}
		}
		echo $YoutubeHider;
	?>

		 class = 'dragable'><div id="dragableYTHeader"></div>
		 <iframe autoplay="" frameborder="0" allowfullscreen="1" name="media" id = 'currentVidTrack' style="height: 270px;width: 480px;display: none"></iframe>
		<iframe id="player" style="height:180px; width: 320px;" frameborder="0" allowfullscreen="1" allow="autoplay; encrypted-media" title="YouTube video player" src="https://www.youtube.com/embed/?playsinline=1;enablejsapi=1&amp;origin=https%3A%2F%2Fsoundabox.com&amp;widgetid=1"></iframe>
		<button id = 'minimize' style = 'outline:none;'  onclick = 'minimize()'><i id = 'minmaxUnnecessary' class = 'fa fa-window-minimize' title = 'M to Minimize/Maximize'></i></button>
	</div>
</div>
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-129302806-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-129302806-1');
	</script>

</head>

<script>
	redirect();
	function redirect(){
		href = window.location.pathname+window.location.search;
		if (!href.includes("/planetest"))
		{
			//window.location.href = "https://soundabox.com/planetest?input=";
		}
	}
//dragable youtube
	  $( function() {
		$( "#dragableYT" ).draggable({ snap: "#fixed", snapMode: "inner"});
	  } );
  
	var dragDiv = $('#dragableYT');
	dragDiv.draggable({containment: "#fixed"});
	dragElement(document.getElementById("dragableYT"));
	
	var tag = document.createElement('script');
    tag.src = "iframe_api.txt";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	  
	var player;
	function onYouTubeIframeAPIReady(){
		player = new YT.Player('player', {
			playerVars: {
				modestbranding: true
			},
			height: '180',
			width: '320',
			events: {
			  'onStateChange': onPlayerStateChange,
			  'onError': onPlayerError
			}
	  }
	  );
	}
	
	function changeProfImage(input)
	{
		var xhttp = new XMLHttpRequest();
		var formData = new FormData();
		formData.append("fileInput", input.files[0]);
		xhttp.open("POST", "uploadProfImage.php");
		xhttp.send(formData);
		
		if (input.files && input.files[0] && Validate(input) == "image") 
		{
			var reader = new FileReader();
			reader.onload = function (e) 
			{
				e.preventDefault();
				
				document.getElementById("profilePic").src = e.target.result;
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	function changeChannelArt(input)
	{
		var xhttp = new XMLHttpRequest();
		
		var formData = new FormData();
		formData.append("channelArtFile", input.files[0]);
		
		xhttp.open("POST", "uploadChannelArt.php");
		xhttp.send(formData);
		
		location.reload();
	}
	function uploadFile(input)
	{
		var xhttp = new XMLHttpRequest();
		
		var formData = new FormData();
		for (var i = 0; i < input.files.length; i++)
		{
			formData.append('myFile[]', input.files[i]);
		}
		xhttp.upload.addEventListener("progress", progressHandler, false);
		xhttp.addEventListener("load", completeHandler, false);
		xhttp.addEventListener("error", errorHandler, false);
		xhttp.addEventListener("abort", abortHandler, false);
		
		
		//alert(input.files[0]);
		xhttp.open("POST", "uploadFiles.php");
		xhttp.send(formData);
		//location.reload();
	}
	function dragElement(elmnt)
	{
		var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
		if (document.getElementById(elmnt.id + "header")) {
		document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
		} 
		else {
		elmnt.onmousedown = dragMouseDown;
		elmnt.onmouseup = closeDragElement;
		}

		function dragMouseDown(e) {
		document.getElementById('player').style.pointerEvents = "none";
		document.getElementById('currentVidTrack').style.pointerEvents = "none";
		}

		function elementDrag(e) {
		elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
		}

		function closeDragElement() {
		document.getElementById('player').style.pointerEvents = "auto";
		document.getElementById('currentVidTrack').style.pointerEvents = "auto";
		document.onmouseup = null;
		document.onmousemove = null;
		}
	}

	loading();
	var $currentPage;
	var $maxPage;

	function playNext(pieceID, nextPieceID, soundType)
	{
		if (soundType == 'mp3')
		{
			playOrPause2(pieceID, nextPieceID,false,'home','');
		}
		else if(soundType = 'yt')
		{
			loadVid2(pieceID, nextPieceID,false,'home','');
		}	
	}
	function playFirst()
	{
		var songList = document.getElementsByClassName("listID");
		var songID = songList[0].id;
		playNext(songID, document.getElementById(songID+'Next').value,document.getElementById(songID+'Type').value);
	}
	
	function loadDocx($pageNum, $playFirst) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("rankings").innerHTML =
			this.responseText;
			setHref();
		  
		}
		};
		xhttp.open("POST", "soundArray.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
		$pathsearchPost = window.location.search.replace('?','');
		xhttp.send("page="+$pageNum+"&"+$pathsearchPost);
		$currentPage = $pageNum;
		if ($playFirst == true)
		{
			xhttp.onload = playFirst;
		}
	}
	function changeRanking() {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				loadDoc(0,false);
			}
		};
		xhttp.open("POST", "changeRanking.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("rankingType="+document.getElementById('rankingType').value);
	}
	
	function changeFilterRank() {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				href = window.location.pathname+window.location.search;
				loadURL('',window.location.pathname, window.location.search);
			}
		};
		xhttp.open("POST", "changeRanking.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("filterRank="+document.getElementById('filterRank').value);
	}
	function changeFilter(e) {
		$checked = ' ';
		if (e.checked)
		{
			$checked = 'checked';
		}
		else
		{
			$checked = ' ';
		}
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				href = window.location.pathname+window.location.search;
				loadURL('',window.location.pathname, window.location.search);
			}
		};
		xhttp.open("POST", "changeRanking.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(e.value+"="+$checked);
		//alert(e.value+"="+$checked);
	}
	function loadDoc($pageNum, $playFirst) {
	
		var buttons = document.getElementsByClassName("pageNumber");
		for (var i = 0; i < buttons.length; i++)
		{
			if($(buttons[i]).hasClass('pageNum'+($pageNum+1)) && !$(buttons[i]).hasClass('PageButtonActive')) 
			{
				buttons[i].className+= ' PageButtonActive';
			}
			else if (!$(buttons[i]).hasClass('pageNum'+($pageNum+1)))
			{
				buttons[i].className = buttons[i].className.replace(" PageButtonActive", "");
			}
		}
		
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("rankings").innerHTML =
			this.responseText;
			setHref();
		}
		};
		xhttp.open("POST", "soundArray.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		$pathsearchPost = window.location.search.replace('?','&');
		xhttp.send("page="+$pageNum+$pathsearchPost);
		$currentPage = $pageNum;
		if ($playFirst == true)
		{
			xhttp.onload = playFirst;
		}
	}
	function setHref()
	{
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
			
			if ((href.includes("uploaded/") && href.includes(".mp3")) || href.includes("#download") || href == 'log_out')
			{
			}
			else if (href == '#')
			{
				e.preventDefault();
			}
			else if (href.includes("https://"))
			{
				e.preventDefault();
				window.open(href, "");
				//newtab.location = href;
			}
			else if (href != 'uploadpiece' && href != 'contact' && href != 'settings')
			{
				e.preventDefault();
				loadURL('',$pathinfo[0],$paths);
				//alert($pathinfo[0]+'?'+$pathinfo[1]);
			}
			else if (href == 'contact')
			{
				e.preventDefault();
				window.open("contact" , "Contact Us!", "width=600,height=700");
			}
			if ($pathinfo[0] == 'source')
			{
			}
			else
			{
				document.getElementById('searchThis').value = 'all';
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
		//alert(window.location.pathname);
		if ((href.includes("uploaded/") && href.includes(".mp3")) || href == 'log_out')
		{
		}
		else if (href == '#')
		{
			e.preventDefault();
		}
		else if (href.includes("https://"))
		{
			e.preventDefault();
			window.open(href, "");
			//newtab.location = href;
		}
		else if (href != 'uploadpiece' && href != 'contact' && href != 'settings')
		{
			
			e.preventDefault();
			loadURL('',window.location.pathname, window.location.search);
		}
		else if (href == 'contact')
		{
			e.preventDefault();
			window.open("contact" , "Contact Us!", "width=600,height=700");
		}
		else
		{
		};
	}
	function loadURL(e, pathname, pathsearch) {
		//href = window.location.pathname+window.location.search;
		if (e != 'back')
		{
			if (pathname == '/')
			{
				history.pushState('', 'New URL: '+ pathname+pathsearch, '/');
			}
			else
			{
				history.pushState('', 'New URL: '+ pathname+pathsearch, pathname+pathsearch);
			}
		}
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", pathname+pathsearch, true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send('load=no');
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("content").innerHTML = this.responseText;
				if (pathname == 'index' || pathname == '/')
				{
					xhttp.onload = loadDocx(0, false);
					xhttp.onload = loadDoc(0, false);
				}
				//loading();
			}
		};
	}
	
	function loadAlt(e)
	{
		loadURL(e, 'audio', '?piece='+e.value);
	}
	
	function clearQueue()
	{
		var playlistPieceChain = document.getElementById('queueTrackPiece').value;
		var chain = playlistPieceChain.split(" ");
		for (var i = 0; i < chain.length; i++)
		{
			matchSaveOrCheck(chain[i],'remove');
		}
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "save_song.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("clear=a");
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				setQueue();
			}
		};
	}
	function playlistToQueue(playlistPieceChain)
	{
		var queuePieceChain = document.getElementById('queueTrackPiece').value;
		var chain = queuePieceChain.split(" ");
		for (var i = 0; i < chain.length; i++)
		{
			matchSaveOrCheck(chain[i],'remove');
		}
		
		var chain = playlistPieceChain.split(" ");
		for (var i = 0; i < chain.length; i++)
		{
			matchSaveOrCheck(chain[i],'save');
		}
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "save_song.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("trackPiece="+playlistPieceChain);
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				setQueue();
			}
		};
	}
	function playlistView(e)
	{
		var scrollmenu = e.parentNode.parentNode;
		if (scrollmenu.style.whiteSpace != 'initial')
		{
			scrollmenu.style.whiteSpace = 'initial';
			e.className = 'fa fa-arrows-alt-h playlistView';
		}
		else
		{
			scrollmenu.style.whiteSpace = 'nowrap';
			e.className = 'fa fa-th playlistView';
		}
	}
	
	function matchSaveOrCheck($pieceID, $saveOrRemove)
	{
		$piece = document.getElementById($pieceID+"Saved");
		
		$pieces = document.getElementsByTagName('i');
		
		if ($saveOrRemove == 'remove')
		{
			for (i = 0; i < $pieces.length; i++) {
				if ($pieces[i].id == $pieceID+"Saved")
				{
					$pieces[i].className = 'fa fa-plus tooltip';
					for (var o = 0; o < $pieces[i].childNodes.length; o++) {
						if ($pieces[i].childNodes[o].className == "tooltiptext") 
						{
							$pieces[i].childNodes[o].innerHTML = "Add to Queue";	
						}
					}
				}
			}
		}
		
		else if($saveOrRemove == 'save')
		{
			for (i = 0; i < $pieces.length; i++) {
				if ($pieces[i].id == $pieceID+"Saved")
				{
					$pieces[i].className = 'fa fa-check tooltip';
					for (var o = 0; o < $pieces[i].childNodes.length; o++) {
						if ($pieces[i].childNodes[o].className == "tooltiptext") 
						{
							$pieces[i].childNodes[o].innerHTML = "Remove from Queue";	
						}
					}
				}
			}
		}
	}
	
	function save($pieceID, $location, $pieceSaved)
	{
		var xhttp = new XMLHttpRequest();
		$piece = document.getElementById($pieceID+"Saved");
		
		$pieces = document.getElementsByTagName('i');
		
		if ($piece.className == 'fa fa-check tooltip')
		{
			for (i = 0; i < $pieces.length; i++) {
				if ($pieces[i].id == $pieceID+"Saved")
				{
					$pieces[i].className = 'fa fa-plus tooltip';
					for (var o = 0; o < $pieces[i].childNodes.length; o++) {
						if ($pieces[i].childNodes[o].className == "tooltiptext") 
						{
							$pieces[i].childNodes[o].innerHTML = "Add to Queue";	
						}
					}
				}
			}
			
			xhttp.open("POST", "save_song.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("piece="+$pieceID+"&location="+$location+"&save=no");
		}
		
		else if($piece.className == 'fa fa-plus tooltip')
		{
			for (i = 0; i < $pieces.length; i++) {
				if ($pieces[i].id == $pieceID+"Saved")
				{
					$pieces[i].className = 'fa fa-check tooltip';
					for (var o = 0; o < $pieces[i].childNodes.length; o++) {
						if ($pieces[i].childNodes[o].className == "tooltiptext") 
						{
							$pieces[i].childNodes[o].innerHTML = "Remove from Queue";	
						}
					}
				}
			}
			xhttp.open("POST", "save_song.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("piece="+$pieceID+"&location="+$location+"&save=yes");
		}
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
				setQueue();
			}
		};
	}
	
	function deletePiece($pieceID)
	{
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "delete_piece.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("piece="+$pieceID);
		
		//document.getElementById($pieceID).parentElement.parentElement.parentElement.parentElement.parentElement.remove();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				loadURL('',window.location.pathname,window.location.search);
			}
		}
		
	}
	function setQueue(deletingPiece)
	{
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "setQueue.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("deletingID="+deletingPiece);
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("queue").innerHTML = this.responseText;
			
			if ($currentPlaylistID == 'queue')
			{
				$pieces = document.getElementsByClassName($currentPlaylistID);
				for (i = 0; i < $pieces.length; i++) {
					if ($pieces[i].id == $currentTrackID)//current playing in queue
					{
						$childNode = $pieces[i].childNodes;
						for (x = 0; x < $childNode.length; x++) {
							if ($childNode[x].id == $currentTrackID+"Next")
							{								
								$nextPieceID = $childNode[x].value;
								return;
							}
						}
					}
				}
			}
			
			}
		};
	}
	
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
		xhttp.send();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("userLogIn").innerHTML = this.responseText;
			setQueue();
			}
		};
	}
	
	var $session = '';
	function submitLog(input)
	{
		if (input.keyCode === 13)
		{
			logging();
		}
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
		xhttp.send("Log=Log&username="+$usernameValue+"&password="+$passwordValue+"&verifyPassword="+$verifyPasswordValue+"&contact="+$contactValue);
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("userLogIn").innerHTML = this.responseText;
			$session = document.getElementById("sessionID").value;
			
			//loadURL('',window.location.pathname);
			hrefPHP = window.location.pathname;
			href = window.location.pathname+window.location.search;
			//alert(window.location.pathname);

			if (hrefPHP != 'uploadpiece' && hrefPHP != 'contact' && hrefPHP != 'settings')
			{
				loadURL('',window.location.pathname,window.location.search);
			}
			else
			{
				location.reload();
			};
			
			setQueue();			
		}};
		if (typeof loadDoc === "function") {
			
			loadDoc($currentPage,false);
		}
	}
	
	function deny()
	{
		$username = document.getElementById('username');
		$contact = document.getElementById('contactHolder');
		$password = document.getElementById('password');
		$verifyPassword = document.getElementById('verifyPassword');
		
		if($password.value != $verifyPassword.value)
		{
			document.getElementById($password).style.animation = 'shake 0.75s cubic-bezier(.36,.07,.19,.97) both';
			setTimeout(function () {
				document.getElementById($password).style.animation = 'none';
			}, 750);
			
			document.getElementById($verifyPassword).style.animation = 'shake 0.75s cubic-bezier(.36,.07,.19,.97) both';
			setTimeout(function () {
				document.getElementById($verifyPassword).style.animation = 'none';
			}, 750);
		}
	}

	
	if (document.getElementById('dragableYT').style.opacity == '0')
	{
		document.getElementById('minmax').className = "fa fa-window-maximize";
		var minmax = 'min';
	}
	else
	{
		document.getElementById('minmax').className = "fa fa-window-minimize";
		var minmax = 'max';
	}
	function minimize()
	{
		if (minmax == 'max')
		{
			document.getElementById("dragableYT").style.opacity = '0';
			document.getElementById("dragableYT").style.pointerEvents = 'none';
			document.getElementById("player").style.pointerEvents = 'none';
			document.getElementById("minmax").className = 'fa fa-window-maximize';
			minmax = 'min';
		}
		else if (minmax == 'min')
		{
			document.getElementById("dragableYT").style.opacity = '1';
			document.getElementById("dragableYT").style.pointerEvents = 'auto';
			document.getElementById("player").style.pointerEvents = 'auto';
			document.getElementById("minmax").className = 'fa fa-window-minimize';
			minmax = 'max';
		}
	}
	
	function search()
	{
		loadURL('','search', '?input='+document.getElementById('searchWhat').value);
		document.getElementById('searchThis').value = 'source';
	}
	
	function autocomplete(input, arrPiece, arrArtists) {
		
		var arr = [];
		
		var currentFocus;
		input.addEventListener("input", function(e) {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("searchWhatAutocomplete-list").innerHTML = this.responseText;
				}
			};
			if (window.location.pathname == '/search' && document.getElementById('searchThis').value == 'source')
			{				
				history.pushState('', 'New URL: ','/search?input='+document.getElementById('searchWhat').value);
				xhttp.open("POST", "search?input="+document.getElementById('searchWhat').value, true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("load=no");
			}
			else if (document.getElementById("searchThis").value == 'all')
			{			
				xhttp.open("POST", "search_bar.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("input="+document.getElementById('searchWhat').value+"&searchThis=all");
				//arr = arrPiece;
			}
			else if (document.getElementById("searchThis").value == 'source')
			{			
				xhttp.open("POST", "search_bar.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("input="+document.getElementById('searchWhat').value+"&searchThis=source");
				//arr = arrPiece;
			}
			else if (document.getElementById("searchThis").value == 'track')
			{			
				xhttp.open("POST", "search_bar.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("input="+document.getElementById('searchWhat').value+"&searchThis=piece");
				//arr = arrPiece;
			}
			else if (document.getElementById("searchThis").value == 'artists')
			{
				xhttp.open("POST", "search_bar.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("input="+document.getElementById('searchWhat').value+"&searchThis=artist");
				//arr = arrArtists;
			}
			
			
			if (window.location.pathname == '/search' && document.getElementById('searchThis').value == 'source')
			{				
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById('content').innerHTML = this.responseText;
					}
				};
			}
			else//Not sure what this is for
			{
				var a, b, i, img, val = this.value;
				closeAllLists();
				if (!val) { return false;}
				currentFocus = -1;
				a = document.createElement("div");
				a.setAttribute("id", this.id + "Autocomplete-list");
				a.setAttribute("class", "autocomplete-items");
				document.getElementById("rightUnderSearchBar").appendChild(a);
				
				for (i = 0; i < arr.length; i++) {
				if (arr[i].name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
					
					img = document.createElement("img");
					img.setAttribute('class', 'previewCover');
					
					if (document.getElementById("searchThis").value == 'track')
					{
						img.setAttribute('src', 'uploaded/'+arr[i].ID+'.jpg');
					}
					else if (document.getElementById("searchThis").value == 'artists')
					{
						img.setAttribute('src', 'user/'+arr[i].ID+'ProfPic.jpg');
					}
					
					b = document.createElement("div");
					
					b.setAttribute('class', 'autofillWords');
					b.innerHTML = "<strong>" + arr[i].name.substr(0, val.length) + "</strong>";
					b.innerHTML += arr[i].name.substr(val.length);
					b.innerHTML += "<input type='hidden' value='" + arr[i].name + "'>";
					b.addEventListener("click", function(e) {
					 input.value = this.getElementsByTagName("input")[0].value;
					  closeAllLists();
					});
					a.appendChild(b);
					b.appendChild(img);
					b.insertBefore(img, b.childNodes[0]);
				}
			}
		}
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
       document.getElementById('searchWhat').value = '';
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


autocomplete(document.getElementById("searchWhat"), piece, artists);
var piece = [];
var artists = [];
var $nextPieceID;


var xhttp = new XMLHttpRequest();
//-----------------------------------
	var $php = 'home';
	var $currentTrackID = null;
	var $currentPlaylistID = '';
	var mouseDown = false;
	var $currentSoundType = '';
	var $currentTrackID;
	var $track = document.getElementById('currentTrack');
	document.getElementById('playButton').addEventListener('click',playOrPause,false);
	$track.addEventListener('ended',ended,false);
	document.getElementById('muteButton').addEventListener('click',muteOrUnmute,false);
	$track.addEventListener('loadedmetadata', updateTime);
	
	var mouseDown = 0;
	document.getElementById('sliderBar').onmousedown = function(){
		mouseDown = 1;
		updateTime();
	}
	document.getElementById('soundBar').onmousedown = function(){
		document.getElementById('soundBarButton').style.opacity = '1';
		document.getElementById('soundBarButton').style.width = '50%';
	}
	document.getElementById('soundBar').onmouseup = function(){
		document.getElementById('soundBarButton').style = '';
	}
	document.getElementById('sliderBar').onmouseup = function(){
		{
			var $newtime = 0;
			if ($currentSoundType == 'mp3'||$currentSoundType == 'mp4')
			{
				$newtime = sliderBar.value/1000 * $track.duration;
				$track.currentTime = $newtime;
			}
			else if ($currentSoundType == 'yt')
			{
				$newtime = Math.round(sliderBar.value/1000 * player.getDuration());
				newTime = Math.round(sliderBar.value/1000 * player.getDuration());
				player.seekTo(newTime);
				
			}
			mouseDown = 0;
			updateTime();
		}
	}
	$fullDuration = 0; 
	function updateTime()
	{
		changeVolume();
		$tags = document.getElementsByTagName('i');
		for (var i = 0; i < $tags.length; i++) {
			//find button that matches id
			if ($tags[i].id == $currentTrackID)
			{
				if (document.getElementById('playButton').classList.contains('fa-play'))
				{
					$tags[i].classList.replace('fa-pause','fa-play');
				}
				else if (document.getElementById('playButton').classList.contains('fa-pause'))
				{
					$tags[i].classList.replace('fa-play','fa-pause');
				}
			}
			//for other button
			else if ($tags[i].id != $currentTrackID && $tags[i].id != document.getElementById('playButton').id && $tags[i].classList.contains('fa-pause')) 
			{
				$tags[i].classList.replace('fa-pause','fa-play');
			}
			
		}
		if ($currentSoundType == 'mp3' || $currentSoundType == 'mp4')
		{
			$fullDuration = $track.duration;
			if (mouseDown == 0)
			{
				document.getElementById('fullDuration').innerHTML = parseInt($track.duration/60)+':' + ('0' + parseInt($track.duration%60)).slice(-2);
			if(!$track.ended)
			{
				document.getElementById('currentTime').innerHTML = parseInt($track.currentTime/60)+':' + ('0' + parseInt($track.currentTime%60)).slice(-2);
			}
			else
			{

				document.getElementById('currentTime').innerHTML = '0:00';
				
				//alert('end check 2'+$currentPlaylistID);
				if ($currentPlaylistID == 'queue')//delete from queue once done playing
				{
					//alert('end check 2x');
					save($currentTrackID, 'user','');
					$currentSoundType = null;
					//setQueue($currentTrackID);
				}
				$pieces = document.getElementsByClassName($currentPlaylistID);
				for (i = 0; i < $pieces.length; i++) {//click next in play
					if ($pieces[i].id == $nextPieceID)
					{
						$siblings = $pieces[i].parentNode.childNodes;
						for (o = 0; o < $siblings.length; o++) {
							if ($siblings[o].id == 'imgPlayButton')
							{
								$siblings[o].click();
								return;
							}
						}
					}
				}

				if (document.getElementById($nextPieceID))
				{
					var continuePlaylist='';
					if (document.getElementById($nextPieceID).classList.contains($currentPlaylistID))
					{
						//document.getElementsByClassName($currentPlaylistID);
						continuePlaylist = $currentPlaylistID;
					}
					if (document.getElementById($nextPieceID + 'Type').value == 'mp3')//mp3 ended goes here
					{
						playOrPause2($nextPieceID, document.getElementById($nextPieceID + 'Next').value,false,$php,continuePlaylist);	
					}
					else if (document.getElementById($nextPieceID + 'Type').value == 'yt')//mp3 ended goes here
					{
						loadVid2($nextPieceID, document.getElementById($nextPieceID + 'Next').value,false,$php,continuePlaylist);	
					}
					//alert($currentPlaylistID);
				}
				else
				{
					//alert('End');
				}
				return;	
			}
			document.getElementById('sliderBar').value = (($track.currentTime / $track.duration)*1000);
			document.getElementById('sliderBar').style.backgroundImage =
			'-webkit-gradient(linear, left top, right top, color-stop('+($track.currentTime / $track.duration)+', orange), color-stop('+($track.currentTime / $track.duration)+', #d3d3d3))';
			}
		}
		if ($currentSoundType == 'yt')
		{
			$fullDuration = player.getDuration();
			if (mouseDown == 0)
			{
				document.getElementById('fullDuration').innerHTML = parseInt(player.getDuration()/60)+':' + ('0' + parseInt(player.getDuration()%60)).slice(-2);
				if($state == 'paused')
				{
					document.getElementById('currentTime').innerHTML = parseInt(player.getCurrentTime()/60)+':' + ('0' + parseInt(player.getCurrentTime()%60)).slice(-2);
					
				}
				else
				{
					document.getElementById('currentTime').innerHTML = parseInt(player.getCurrentTime()/60)+':' + ('0' + parseInt(player.getCurrentTime()%60)).slice(-2);
				}
			
				document.getElementById('sliderBar').value = ((player.getCurrentTime() / player.getDuration())*1000);
		
				document.getElementById('sliderBar').style.backgroundImage =
				'-webkit-gradient(linear, left top, right top, color-stop('+(player.getCurrentTime() / player.getDuration())+', orange), color-stop('+(player.getCurrentTime() / player.getDuration())+', #d3d3d3))';
			}
		}
	}
	function playOrPause()
	{
		//document.getElementById("currentVidTrack").contentWindow.document.jwplayer.stop();
		if ($currentSoundType == 'mp3')
		{
			if(!$track.paused && !$track.ended)
			{
				if(document.getElementById($currentTrackID) !== null)
				{
					document.getElementById($currentTrackID).classList.replace('fa-pause','fa-play');
				}
				document.getElementById('playButton').className = 'fa fa-play soundPlayerIcon';
				document.getElementById('playButton').style = 'position: relative;font-size: 19px;';
				$track.pause();
			}
			else
			{
				if(document.getElementById($currentTrackID) !== null)
				{
					document.getElementById($currentTrackID).classList.replace('fa-play','fa-pause');
				}
				document.getElementById('playButton').className = 'fa fa-pause soundPlayerIcon';
				document.getElementById('playButton').style = 'position: relative;font-size: 19px;';
				$track.play();
				update = setInterval(updateTime,100);
			}
		}
		else if ($currentSoundType == 'mp4')
		{
			alert('a');
			$("#currentVidTrack").contentWindow.jwplayer().stop();
			
		}
		if ($currentSoundType == 'yt')
		{
			if($state == 'playing')
			{
				if(document.getElementById($currentTrackID) !== null)
				{
					if (document.getElementById($currentTrackID).classList.contains('fa-play'))
					{
						document.getElementById($currentTrackID).classList.replace('fa-play','fa-pause');
					}
				}
				document.getElementById('playButton').className = 'fa fa-play soundPlayerIcon';
				document.getElementById('playButton').style = 'position: relative;font-size: 19px;';
				$state = 'paused';
				player.pauseVideo();
			}
			else
			{
				if(document.getElementById($currentTrackID) !== null)
				{
					document.getElementById($currentTrackID).classList.replace('fa-play','fa-pause');
				}
				document.getElementById('playButton').className = 'fa fa-pause soundPlayerIcon';
				document.getElementById('playButton').style = 'position: relative;font-size: 19px;';
				$state = 'playing';
				player.playVideo();
				update = setInterval(updateTime,100);
			}
		}
	}
	var $loadTo = '';

	$(window).on('beforeunload', function() {
		
		var xhttp = new XMLHttpRequest();
		if ($currentSoundType == 'mp3')
		{
			xhttp.open("POST", "addlistentime.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("pieceID="+$currentTrackID+"&listenTime="+$track.currentTime);
		}
		else if ($currentSoundType == 'yt')
		{
			xhttp.open("POST", "addlistentime.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("pieceID="+$currentTrackID+"&listenTime="+player.getCurrentTime());
		}
	});
	
	
	
	function ended()
	{
		
		$tags = document.getElementsByTagName('i');
		for (var i = 0; i < $tags.length; i++) {
			if ($tags[i].id == $currentTrackID)
			{
				$tags[i].classList.replace('fa-pause','fa-play');
			}
		}
		document.getElementById('playButton').className = 'fa fa-play soundPlayerIcon';
		document.getElementById('playButton').style = 'position: relative;font-size: 19px;';
		
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "addlistentime.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("pieceID="+$currentTrackID+"&listenTime="+$track.currentTime);

		
		if ($php == 'audio' && nextPieceID != '')//loads audio if next piece exists
		{
			window.location = "https://soundabox.com/audio.php?piece="+$loadTo;
		}
		else if(document.getElementsByClassName($currentPlaylistID))//does document with same playlist class exist
		{
			$playlist = document.getElementsByClassName($currentTrackID);
			for (var i = 0; i < $playlist.length; i++)
			{
				if($playlist[i].id == $nextPieceID)//sets next audio to play.
				{
					$siblings = $playlist[i].parentNode.children;
					$sibIdNext = $nextPieceID + 'Next';
					$nextID = '';
					$sibType = $nextPieceID + 'Type';
					$nextType = '';
					for(var i = 0; i < $siblings.length; i++) 
					{
						if($siblings[i].id == $sibId) {
							$nextID = $siblings[i].value;
						}
						if($siblings[i].id == $sibType) {
							$nextType = $siblings[i].value;
						}
					}
				}
			}
		}
		else if (document.getElementById($nextPieceID + 'Type').value == 'yt')
		{
			loadVid2($nextPieceID, document.getElementById($nextPieceID + 'Next').value,false,$php,'');
		}
		else if (document.getElementById($nextPieceID + 'Type').value == 'mp3')
		{
			playOrPause2($nextPieceID, document.getElementById($nextPieceID + 'Next').value,false,$php,'');	
		}
		if (($currentPage+1)< $maxPage && $currentPlaylistID == '')
		{
			loadDoc($currentPage+1, true);
		}
		else
		{
			endReset();
		}
	}
	function endReset()
	{
		document.getElementById($currentTrackID).classList.replace('fa-pause','fa-play');
		document.getElementById('playButton').className = 'fa fa-play soundPlayerIcon';
		document.getElementById('playButton').style = 'position: relative;font-size: 19px;';
	}
	function siblingId(event,$id) {
		var siblings = event.parentNode.children,
			$sibId = $id;
		for(var i = 0; i < siblings.length; i++) 
		{
			if(siblings[i].id == $sibId) {
				return true;
			}
		}
		return false;
	}
	function muteOrUnmute()
	{
		if($track.muted == true)
		{
			$track.muted = false;
			document.getElementById('muteButton').className = 'fa fa-volume-up soundPlayerIcon';
			document.getElementById('muteButton').style = 'position: relative;font-size: 25px;';
		}
		else
		{
			$track.muted = true;
			document.getElementById('muteButton').className = 'fa fa-volume-off soundPlayerIcon';
			document.getElementById('muteButton').style = 'position: relative;font-size: 25px;';

		}
	}
	function changeVolume()
	{
		$track.volume = Math.sqrt(document.getElementById('soundBar').value)/20;
		player.setVolume(document.getElementById('soundBar').value);
	}
	function setVolume()
	{	
		var xhttp = new XMLHttpRequest();
		xhttp.open("GET", "set_volume.php?volume="+document.getElementById('soundBar').value, true);
		xhttp.send();
	}
	document.getElementById("searchThis").onchange = function() {changeSearch()};
	function changeSearch() {
		document.getElementById("searchWhat").placeholder = "Search for "+document.getElementById("searchThis").value+"...";
	}
	var player = document.getElementById('player');
	var $state = '';
	function onPlayerError(event) {	
		$state = 'paused';
			if ($php == 'audio')
			{
				window.location = "https://soundabox.com/audio?piece="+$loadTo;
			}		

			else if ($nextPieceID != 'end' && $nextPieceID != '')
			{

				if (document.getElementById($nextPieceID + 'Type'))
				{
					if (document.getElementById($nextPieceID + 'Type').value == 'yt')
					{
						loadVid2($nextPieceID, document.getElementById($nextPieceID + 'Next').value,false);
					}
					else if (document.getElementById($nextPieceID + 'Type').value == 'mp3')
					{
						playOrPause2($nextPieceID, document.getElementById($nextPieceID + 'Next').value,false);	
					}
				}
			}
			else
			{
				if (($currentPage+1)< $maxPage)
				{
					loadDoc($currentPage+1, true);
				}
				else
				{
					endReset();
				}
			}
	}

	function onPlayerStateChange(event) {		

		if (event.data == YT.PlayerState.ENDED){
			$state = 'paused';
			if ($php == 'audio')
			{
				window.location = "https://soundabox.com/audio?piece="+$loadTo;
			}		



			//alert('end check 3'+$currentPlaylistID);
			if ($currentPlaylistID == 'queue')//delete from queue once done playing
			{
				//alert('end check 3x');
				save($currentTrackID, 'user','');
				//setQueue($currentTrackID);
			}
				
			if ($nextPieceID != 'end' && $nextPieceID != '')//if next piece exists
			{	
				$pieces = document.getElementsByClassName($currentPlaylistID);
				for (i = 0; i < $pieces.length; i++) {
					if ($pieces[i].id == $nextPieceID)
					{
						$siblings = $pieces[i].parentNode.childNodes;
						for (o = 0; o < $siblings.length; o++) {
							if ($siblings[o].id == 'imgPlayButton')
							{
								$siblings[o].click();
								return;
							}
						}
					}
				}
				
				if (document.getElementById($nextPieceID))
				{
					var continuePlaylist = '';
					if (document.getElementById($nextPieceID).classList.contains($currentPlaylistID))
					{
						continuePlaylist = $currentPlaylistID;
					}
					if (document.getElementById($nextPieceID + 'Type').value == 'yt')
					{
						loadVid2($nextPieceID, document.getElementById($nextPieceID + 'Next').value,false, continuePlaylist);
					}
					else if (document.getElementById($nextPieceID + 'Type').value == 'mp3')
					{
						playOrPause2($nextPieceID, document.getElementById($nextPieceID + 'Next').value,false, continuePlaylist);	
					}
				}
				
			}
			else
			{
				if (($currentPage+1)< $maxPage && $currentPlaylistID == '')
				{
					loadDoc($currentPage+1, true);
				}
				else
				{
					endReset();
				}
			}
		}
	}
	
	function changeCurrentPlaying($pieceID)
	{
		var xhttps = new XMLHttpRequest();
		xhttps.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById('currentPlaying').innerHTML = this.responseText;
				setHref();
			}
		};
		xhttps.open("POST", "loadCurrentPlaying", true);
		xhttps.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttps.send("pieceID="+$pieceID);
	}
	function loadVid2(pieceID, nextPieceID, $clicked, php, $thisPlaylistID){
		$('#currentVidTrack').attr('src', '');
		$track = document.getElementById('currentTrack');
		$currentPlaylistID = $thisPlaylistID;
		changeCurrentPlaying(pieceID);
		$track.pause();
		document.getElementById('currentVidTrack').style.display = 'none';
		document.getElementById('currentVidTrack').style.pointerEvents = 'none';
		document.getElementById('player').style.display = 'inline';
		
		if (nextPieceID != '')
		{
			$php = php;
			if ($php == 'audio')
			{
				$loadTo = nextPieceID;
			}
		}
		if ($currentTrackID != pieceID)//if new song, play
		{
			$state = "playing";
			if ($clicked == true)
				{
					var xhttps = new XMLHttpRequest();
					xhttps.open("POST", "add_chain.php", true);
					xhttps.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttps.send("nextchain="+pieceID);
				}
			if ($currentTrackID != null)
			{
				var xhttpx = new XMLHttpRequest();
				if(document.getElementById($currentTrackID) !== null)
				{
					document.getElementById($currentTrackID).classList.replace('fa-pause','fa-play');
				}
				if($currentSoundType == 'mp3')
				{
					$track.pause();
					$track.currentTime = 0.0;
				}
				if ($currentSoundType == 'mp3')
				{
					xhttpx.open("POST", "addlistentime.php", true);
					xhttpx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttpx.send("pieceID="+$currentTrackID+"&listenTime="+$track.currentTime);
				}
				else if ($currentSoundType == 'yt')
				{
					xhttpx.open("POST", "addlistentime.php", true);
					xhttpx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttpx.send("pieceID="+$currentTrackID+"&listenTime="+player.getCurrentTime());
				}
			}
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "addview.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("pieceID="+pieceID);
					
			document.getElementById(pieceID).classList.replace('fa-play','fa-pause');
			document.getElementById('playButton').className = 'fa fa-pause soundPlayerIcon';
			document.getElementById('playButton').style = 'position: relative;font-size: 19px;';
			var $vidIDThis = document.getElementById(pieceID+"vidID").value;

			player.loadVideoById($vidIDThis, 0, "large");
			$currentTrackID = pieceID;
			$currentSoundType = 'yt';
			$nextPieceID = nextPieceID;
			update = setInterval(updateTime,100);
		}
		else
		{

			if ($state == 'playing')//pause
			{
				document.getElementById($currentTrackID).classList.replace('fa-play','fa-pause');
				document.getElementById('playButton').className = 'fa fa-play soundPlayerIcon';
				document.getElementById('playButton').style = 'position: relative;font-size: 19px;';
				player.pauseVideo();
				$state = 'paused';
				document.getElementById(pieceID).classList.replace('fa-pause','fa-play');
			}
			else if ($state == 'paused')//play
			{
				document.getElementById($currentTrackID).classList.replace('fa-pause','fa-play');
				document.getElementById('playButton').className = 'fa fa-pause soundPlayerIcon';
				document.getElementById('playButton').style = 'position: relative;font-size: 19px;';
				player.playVideo();
				$state = 'playing';
				document.getElementById(pieceID).classList.replace('fa-play','fa-pause');
				
			}
		}
	}
	function downloadx($ytIDDL)
	{
		//document.getElementById('downloadRec').src = '//www.recordmp3.co/#/watch?v='+$ytIDDL+'&layout=button300100';
		document.getElementById('downloadRec').src = '//www.recordmp3.co/#/watch?v='+$ytIDDL;
		document.getElementById('soundNavBottom').style.display = '';
		document.getElementById('soundNavBottom').style.transition = '0.2s';
		setTimeout(function () {
			document.getElementById('soundNavBottom').style.display = 'none';
			document.getElementById('soundNavBottom').style.transition = '0.2s';
		}, 5000);
	}
	function downloadMP4($url)
	{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			a = document.createElement("a");
			a.setAttribute('download', ''); 
			a.setAttribute('href',this.responseText.replace("&amp;", "&"));
			a.click();
		}
		};
		xhttp.open("POST", "episodeUploader.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("vidUrl="+$url);
	}
	function cancelDownload()
	{
		document.getElementById('downloadRec').src = '';
		document.getElementById('soundNavBottom').style.display = 'none';
		document.getElementById('soundNavBottom').style.transition = '0.2s';
	}
		
	function playOrPause3(pieceID, nextPieceID, $clicked, $thisPlaylistID, source)	{
		minmax = 'min';
		minimize();

		$currentPlaylistID = $thisPlaylistID;
		document.getElementById('currentVidTrack').style.display = 'inline';
			document.getElementById('currentVidTrack').style.pointerEvents = 'auto';
		document.getElementById('player').style.display = 'none';
		
		document.getElementById('currentTrack').pause();
		$track = document.getElementById('currentVidTrack');
		changeCurrentPlaying(pieceID);
		if ($currentSoundType == 'yt')
		{
			if($state == 'playing')
			{
				if(document.getElementById($currentTrackID) !== null)
				{
					if (document.getElementById($currentTrackID).classList.contains('fa-play'))
					{
						document.getElementById($currentTrackID).classList.replace('fa-play','fa-pause');
					}
				}
				document.getElementById('playButton').className = 'fa fa-play soundPlayerIcon';
				document.getElementById('playButton').style = 'position: relative;font-size: 19px;';
				$state = 'paused';
				player.pauseVideo();
			}
		}
		var $url = "https://soundabox.com/";
		var $source = source;
		if(!$track.paused && !$track.ended && document.getElementById("currentVidTrack").src == $source) //pauses track if playing
		{
			document.getElementById(pieceID).classList.replace('fa-pause','fa-play');
			document.getElementById('playButton').className = 'fa fa-play soundPlayerIcon';
			document.getElementById('playButton').style = 'position: relative;font-size: 19px;';
			$track.pause();
		}
		else //plays track if not playing
		{
			
			if ($currentTrackID != pieceID)
			{
				if ($clicked == true)
				{
					var xhttps = new XMLHttpRequest();
					xhttps.open("POST", "add_chain.php", true);
					xhttps.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttps.send("nextchain="+pieceID);
					
					var xhttpa = new XMLHttpRequest();
					xhttpa.open("GET", "episodeUploader.php?pieceID="+pieceID, true);
					xhttpa.send();
				}
				
				if ($currentTrackID != null)
				{
					var xhttp = new XMLHttpRequest();
					if(document.getElementById($currentTrackID) !== null)
					{
						document.getElementById($currentTrackID).classList.replace('fa-pause','fa-play');
					}
					if ($currentSoundType == 'mp3')
					{
						xhttp.open("POST", "addlistentime.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("pieceID="+$currentTrackID+"&listenTime="+$track.currentTime);
					}
					else if ($currentSoundType == 'yt')
					{
						xhttp.open("POST", "addlistentime.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("pieceID="+$currentTrackID+"&listenTime="+player.getCurrentTime());
					}
				}
					$('#currentVidTrack').attr('src', $source);
					document.getElementById("currentVidTrack").load();
					
					var xhttpx = new XMLHttpRequest();
					xhttpx.open("POST", "addview.php", true);
					xhttpx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttpx.send("pieceID="+pieceID);
					
					$nextPieceID = nextPieceID;
			}
			if($currentSoundType == 'yt')
			{
				player.stopVideo();
				$state = 'paused';
				if(document.getElementById($currentTrackID) !== null)
				{
					document.getElementById($currentTrackID).classList.replace('fa-pause','fa-play');
				}
			}

			document.getElementById(pieceID).classList.replace('fa-play','fa-pause');
			
			document.getElementById('playButton').className = 'fa fa-pause soundPlayerIcon';
			document.getElementById('playButton').style = 'position: relative;font-size: 19px;';
			$track.play();
			update = setInterval(updateTime,100);
			
			$currentTrackID = pieceID;
			$currentSoundType = 'mp4';
		}
	}
	function playOrPause2(pieceID, nextPieceID, $clicked, php, $thisPlaylistID)	{
		$('#currentVidTrack').attr('src', '');
		$currentPlaylistID = $thisPlaylistID;
		//document.getElementById('currentVidTrack').pause();
		$track = document.getElementById('currentTrack');
		changeCurrentPlaying(pieceID);
		
		if (nextPieceID != '')
		{
			$php = php;
			if ($php == 'audio')
			{
				$loadTo = nextPieceID;
			}
		}

		var $url = "https://soundabox.com/";
		var $source = 'uploaded/'+ pieceID+'.mp3';
		
		if(!$track.paused && !$track.ended && document.getElementById("currentTrack").src == $url + $source) //pauses track if playing
		{
			document.getElementById(pieceID).classList.replace('fa-pause','fa-play');
			document.getElementById('playButton').className = 'fa fa-play soundPlayerIcon';
			document.getElementById('playButton').style = 'position: relative;font-size: 19px;';
			$track.pause();
		}
		else //plays track if not playing
		{
			if (document.getElementById("currentTrack").src != $url + $source)
			{
				if ($clicked == true)
				{
					var xhttps = new XMLHttpRequest();
					xhttps.open("POST", "add_chain.php", true);
					xhttps.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttps.send("nextchain="+pieceID);
				}
				
				if ($currentTrackID != null)
				{
					var xhttp = new XMLHttpRequest();
					if(document.getElementById($currentTrackID) !== null)
					{
						document.getElementById($currentTrackID).classList.replace('fa-pause','fa-play');
					}
					if ($currentSoundType == 'mp3')
					{
						xhttp.open("POST", "addlistentime.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("pieceID="+$currentTrackID+"&listenTime="+$track.currentTime);
					}
					else if ($currentSoundType == 'yt')
					{
						xhttp.open("POST", "addlistentime.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("pieceID="+$currentTrackID+"&listenTime="+player.getCurrentTime());
					}
				}
				
					$('#currentTrack').attr('src', $source)
					document.getElementById("currentTrack").load();
					
					var xhttpx = new XMLHttpRequest();
					xhttpx.open("POST", "addview.php", true);
					xhttpx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttpx.send("pieceID="+pieceID);
					
					$nextPieceID = nextPieceID;
			}
			if($currentSoundType == 'yt')
			{
				player.stopVideo();
				$state = 'paused';
				if(document.getElementById($currentTrackID) !== null)
				{
					document.getElementById($currentTrackID).classList.replace('fa-pause','fa-play');
				}
			}
			
			document.getElementById(pieceID).classList.replace('fa-play','fa-pause');
			
			document.getElementById('playButton').className = 'fa fa-pause soundPlayerIcon';
			document.getElementById('playButton').style = 'position: relative;font-size: 19px;';
			$track.play();
			update = setInterval(updateTime,100);
			
			$currentTrackID = pieceID;
			$currentSoundType = 'mp3';
		}
	}
	function loadPlaylist(pieceID, e, $matchLocation)
	{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			$(e).siblings("#addTo").html(this.responseText); 
			
			
			$others = document.getElementsByClassName('dropdown-content');
			for (var i=0; i < $others.length; i++) {
				$others[i].style = "";
			}
			
			$(e).siblings("#addTo").css( "display", 'block' );
			if ($matchLocation == true)
			{
				$(e).siblings("#addTo").css("left", e.getBoundingClientRect().left+'px');
				//$(e).siblings("#addTo").css( "display", 'block' );
			}
		}
		};
		xhttp.open("POST", "add_to.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("pieceID="+pieceID);
	
	}
	document.addEventListener("click", function(event) {
		if (event.target.closest(".dropdown-content")) return;
		$others = document.getElementsByClassName('dropdown-content');
		for (var i=0; i < $others.length; i++) {
			$others[i].style = "";
		}
	});
	
	var valueHover = 0;
	function calcSliderPos(e) {
		return (e.offsetX / e.target.clientWidth /0.85) *  parseInt(e.target.getAttribute('max'),10);
	}
	
	var div = document.getElementById('tooltipTime'); 
	document.addEventListener('mousemove',function(e) {	
		div.style.left = e.pageX/0.85+"px";
		var hoverTime = parseInt($fullDuration*calcSliderPos(e)/1000/60)+':' + ('0' + parseInt($fullDuration*calcSliderPos(e)/1000%60)).slice(-2);
		div.innerHTML = hoverTime;  
	});
	
	
	function addPlaylist(e)
	{
		var children = e.parentNode.childNodes;
		$value = ''
		for (var i=0; i < children.length; i++) {
			if (children[i].className = "createPlaylist") {
				$value= children[i].value;
				break;
			}
		}
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "add_playlist.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("playlistName="+$value);
		e.parentNode.style.display = 'none';
	}
	
	function deletePlaylist($trackID, e)
	{
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "add_playlist.php", true);//add_playlist function as both delete and adding playlists.
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("playlistID="+$trackID);
		e.parentNode.parentNode.style.display = 'none';
	}
	
	function savePlaylist($trackID, e)
	{
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "save_playlist.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		for (var i=0; i < e.childNodes.length; i++) 
		{
			if (e.childNodes[i].classList == 'fa fa-plus tooltip savePlaylist' || e.childNodes[i].classList == 'fa fa-check tooltip savePlaylist')
			{	
				$piece = e.childNodes[i];
				if ($piece.classList.contains("fa-check"))
				{
					$piece.className = 'fa fa-plus tooltip savePlaylist';
					xhttp.send("trackID="+$trackID+"&save=no");
					
					for (var o=0; o < $piece.childNodes.length; o++) 
					{
						if ($piece.childNodes[o].className == "tooltiptext") {
							$piece.childNodes[o].innerHTML = "Add To My Playlist";	
						}
					}
				}
				else if($piece.classList.contains("fa-plus"))
				{
					$piece.className = 'fa fa-check tooltip savePlaylist';
					xhttp.send("trackID="+$trackID+"&save=yes");
					for (var o=0; o < $piece.childNodes.length; o++) 
					{
						if ($piece.childNodes[o].className == "tooltiptext") {
							$piece.childNodes[o].innerHTML = "Remove From My Playlist";	
						}
					}
					
				}
			}
		}
	}
	
	function addToPlaylist($trackID, $pieceID,e)
	{	
			if (e.className == "fa fa-check tooltip playlistIcon") {
				e.className = "fa fa-plus tooltip playlistIcon";
				var childrenChildren = e.childNodes;
				for (var o=0; o < childrenChildren.length; o++) {
					if (childrenChildren[o].className == "tooltiptext") {
						childrenChildren[o].innerHTML = "Add To Playlist";	
					}
				}
				
				var xhttp = new XMLHttpRequest();
				xhttp.open("POST", "add_to_playlist.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("trackID="+$trackID+"&pieceID="+$pieceID+"&saveOrRemove=remove");
			}
			
			else if (e.className == "fa fa-plus tooltip playlistIcon") {
				e.className = "fa fa-check tooltip playlistIcon";
				var childrenChildren = e.childNodes;
				for (var o=0; o < childrenChildren.length; o++) {
					if (childrenChildren[o].className == "tooltiptext") {
						childrenChildren[o].innerHTML = "Remove From Playlist";	
					}
				}
				
				var xhttp = new XMLHttpRequest();
				xhttp.open("POST", "add_to_playlist.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("trackID="+$trackID+"&pieceID="+$pieceID+"&saveOrRemove=save");
			}
	
	}
	function Validate(input)
	{
		var validImageFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png", ".svg", ".bin"];
		var validSoundFileExtensions = [".mp3",".ogg", ".bin" ];
		for (var i = 0; i < input.files.length ; i++) 
		{
			for (var j = 0; j < validImageFileExtensions.length; j++) {
				if (getExtension(input.files[i].name) == validImageFileExtensions[j]) {
					return "image";
					break;
				}
			}
			for (var i = 0; i < input.files.length ; i++) 
			{
				for (var j = 0; j < validSoundFileExtensions.length; j++) {
					if (getExtension(input.files[i].name) == validSoundFileExtensions[j]) 
					{
						return "sound";
						break;
					}
				}
			}
		}
		return false;
	}
	function getExtension(fileName)
	{
		return "." + fileName.split('.').pop().toLowerCase();
	}

	$('body').on('click', '[data-editable]', function(){
		var $description = document.getElementById('description').innerHTML;
		var $el = $(this);
				  
		var $input = $('<input class = "pieceNameText" />').val($description);
		$el.replaceWith( $input );
	  
		var save = function()
		{
			if ($input.val().trim() == "" || $input.val().trim() == null)
			{
				var $p = $("<span id = 'description' style = 'font-size: 20px; padding: 10px;' data-editable />").text($description);
				document.getElementById('pieceName').value = $description;
			}
			else
			{
				var $p = $("<span id = 'description' style = 'font-size: 20px; padding: 10px;' data-editable />").text( $input.val() );	
				document.getElementById('pieceName').value = $input.val();
				$description = $input.val();
				updateDatax('iDescription', $description);
			}
			
			$input.replaceWith($p);
		};
	$input.one('blur', save).focus();
	});
	document.onkeyup = function(e) {
	var tag = e.target.tagName.toLowerCase();
	if ((tag != 'input' && tag != 'textarea') && e.which == 77) {
		minimize();
	}
	if ((tag != 'input' && tag != 'textarea') && e.which == 84) {
		clearQueue();
	}
	if (e.target.id == 'searchWhat' && e.which == 13) {
		search();
	}
	};
	window.addEventListener('keydown', function(e) {
		var tag = e.target.tagName.toLowerCase();
		if(e.keyCode == 32 && tag != 'input' && tag != 'textarea') {
			e.preventDefault();
			playOrPause();
		}
	});
	$('body').on('click', '[description-editable]', function(){
	var $el = $(this);
	$previousValue = document.getElementById('pieceDescriptionInner').innerHTML;
	$previousValue = $previousValue.replace(/&amp;/g, "&");
	var $input = $('<textarea class = "editable" id = "pieceDescriptionInner" />').val($previousValue);
	$el.replaceWith( $input );
	$pieceID = document.getElementById('pieceID').value;
	var save = function()
	{
		if ($input.val().trim() == "" )
		{
			var $p = $('<textarea readonly class = "noneditable" id = "pieceDescriptionInner" description-editable />').text($previousValue);
			document.getElementById('pieceDescriptionInner').value = $previousValue;
		}
		else
		{
			var $p = $('<textarea readonly class = "noneditable" id = "pieceDescriptionInner" description-editable />').text( $input.val() );	
			document.getElementById('pieceDescriptionInner').value = $input.val();
			updatePiece($pieceID,document.getElementById('pieceDescriptionInner'));
		}

		$input.replaceWith( $p );
	};
	$input.one('blur', save).focus();
	});

	function updateDatax($changeThis,$value)
	{
		if ($changeThis == 'iDescription')
		{	
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "update_data.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("changeWhat="+$changeThis+"&value="+$value);
			xhttp.onreadystatechange = function() {
			};
		}
		if ($changeThis == 'disableShortVersion')
		{	
			$bool = $value.checked;
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "update_data.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("changeWhat="+$changeThis+"&value="+$bool);
			xhttp.onreadystatechange = function() {
			};
		}
		if ($changeThis == 'weebMode')
		{	
			$bool = $value.checked;
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "update_data.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("changeWhat="+$changeThis+"&value="+$bool);
			xhttp.onreadystatechange = function() {
			};
		}
		if ($changeThis == 'YoutubeHider')
		{	
			$bool = $value.checked;
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "update_data.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("changeWhat="+$changeThis+"&value="+$bool);
			xhttp.onreadystatechange = function() {
			};
		}
	}
	function updatePiece($pieceID,e)
	{
		$changeThis = e.id;
		var xhttp = new XMLHttpRequest();
		var formData = new FormData();
		if ($changeThis == 'pieceType')
		{	
			xhttp.open("POST", "update_data.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("changeWhat=piece&row=type&value="+e.value+"&pieceID="+$pieceID);
		}
		if ($changeThis == 'pieceDescriptionInner')
		{	
			xhttp.open("POST", "update_data.php", true);
			
			$value = e.value.replace(/'/g, "\\'");
			formData.append("changeWhat", "piece");
			formData.append("row", "idDescription");
			formData.append("value", $value);
			formData.append("pieceID", $pieceID);
			xhttp.send(formData);
		}
		if ($changeThis == 'shortVersion')
		{	
			value = '';
			if (e.value == '')
			{
				value = '';
			}
			else
			{
				value = e.value.split('?v=')[1].substring(0, 11);
			}
			xhttp.open("POST", "update_data.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("changeWhat=piece&row=shortVersion&value="+value+"&pieceID="+$pieceID);
		}
		
		if ($changeThis == 'altID')
		{	
			value = e.value;
			xhttp.open("POST", "update_data.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("changeWhat=piece&row=altID&value="+value+"&pieceID="+$pieceID);
		}
		xhttp.onreadystatechange = function() {
		};
	}
	
	function _(el) {
	  return document.getElementById(el);
	}
	$status = 'empty';
	function progressHandler(event) {
	  var percent = (event.loaded / event.total) * 100;
		_("progressBar").value = Math.round(percent);
		_("progressBar").style.display = 'inline';
	}

	function completeHandler(event) {
		_("progressBar").value = 0; //will clear progress bar after successful upload
		_("progressBar").style.display = 'none';
		if (window.location.pathname != 'uploadpiece')
		{
			loadURL('',window.location.pathname, window.location.search);
		}
	}

	function errorHandler(event) {
	  _("status").innerHTML = "Upload Failed";
	}

	function abortHandler(event) {
	  _("status").innerHTML = "Upload Aborted";
	}
	

</script>

<?php
	function get_title($url){
		$str = file_get_contents($url);
		if(strlen($str)>0){
			$str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
			$str = str_replace(" - MyAnimeList.net","",$str);
			preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
			return $title[1];
		}
	}
?>











