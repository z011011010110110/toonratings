<?php
	include_once 'dbh.inc.php';
	function get_title($url){
		$str = file_get_contents($url);
		if(strlen($str)>0){
			$str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
			$str = str_replace(" - MyAnimeList.net","",$str);
			preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
			return $title[1];
		}
	}
	if (isset($_POST['customArtistUsername']))//inserted custom user
	{
		$username = $_POST['customArtistUsername'];
		if (mysqli_query($con, "INSERT INTO user (userName, admin)VALUES(\"$username\", 2);")) {
			$id = mysqli_insert_id($con);
			$result = mysqli_query($con, "SELECT *FROM user WHERE id = $id");
			copy("defaultProf.jpg", "user/".$id."ProfPic.jpg");
			echo $id;
		}
	}
	
	if (isset($_POST['sourceName']))//insert new source
	{
		$sourceName = $_POST['sourceName'];
		$uniqueID =hash('adler32',  uniqid());
		if (mysqli_query($con, "INSERT INTO source (sourceName, sourceID)VALUES(\"$sourceName\", '$uniqueID');")) {
			$id = mysqli_insert_id($con);
			$result = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM source WHERE id = $id"));
			$sourceID = $string = preg_replace('/\s+/', '', $result['sourceID']);
			copy("defaultProf.jpg", "sourceMaterial/".$sourceID.".jpg");
			echo $sourceID;
		}
	}
	
	if (isset($_POST['sourceID']))
	{
		$sourceID = $_POST['sourceID'];

		if (isset($_POST['sourceType']))
		{
			$sourceType = $_POST['sourceType'];
			mysqli_query($con, "UPDATE source SET sourceType = '".$sourceType."' WHERE sourceID = '".$sourceID."';");
		}
		
		if (isset($_POST['mal']))
		{
			$mal = $_POST['mal'];
			mysqli_query($con, "UPDATE source SET mal = ".$mal." WHERE sourceID = '".$sourceID."';");
			
			$weebName = get_title("https://myanimelist.net/anime/".$mal);
			
			mysqli_query($con, "UPDATE source SET weebSourceName = '$weebName' WHERE sourceID = '".$sourceID."';");
			
		}		
		
		if (isset($_POST['parentSourceID']))
		{
			$parentSourceID = $_POST['parentSourceID'];
			mysqli_query($con, "UPDATE source SET parentSourceID = '".$parentSourceID."' WHERE sourceID = '".$sourceID."';");
		}
	}
?>










