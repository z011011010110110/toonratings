<?php
    session_start();
    include_once 'dbh.inc.php';

    
    $editId = 0;
    if (isset($_POST['editId']))
    {
        $editId = $_POST['editId'];
    }
    
	//for deleting webtoon
	$active = 0;
    if (isset($_POST['active']))
    {
        $active = $_POST['active'];
    }
	
    if (isset($_GET['toon']))
    {
        $toonId = $_GET['toon'];
    }
	

    $userId = $_SESSION['userID'];

	
    $review = "'".'-'."'";
    if (!empty($_POST['review']))
    {
        $review = "'".mysqli_real_escape_string($con, $_POST['review'])."'";
    }

    $userRating = 0;
    if (isset($_POST['userRating']))
    {
        $userRating = $_POST['userRating'];
    }

    $storyRating = 0;
    if (isset($_POST['storyRating']))
    {
        $storyRating = $_POST['storyRating'];
    }
	
	$artRating = 0;
    if (isset($_POST['artRating']))
    {
        $artRating = $_POST['artRating'];
    }
	
	$panelRating = 0;
    if (isset($_POST['panelRating']))
    {
        $panelRating = $_POST['panelRating'];
    }

	
	$date = 'CURRENT_TIMESTAMP';
    if (isset($_POST['date']))
    {
        $date = "'".$_POST['date']."'";
    }
	

    $replyId = 0;
    if (isset($_POST['replyId']))
    {
        $replyId = $_POST['replyId'];
    }
	
	if ($editId > 0 && $active < 0)
    {
        $sql = "UPDATE review set active = $active WHERE id = $editId;";
	}
    else if ($editId <= 0)//New review
    {
        $sql = "INSERT INTO review (toonId, userId, review, userRating, storyRating, artRating, panelRating, date, replyId)
        VALUES($toonId, $userId, $review, $userRating, $storyRating, $artRating, $panelRating, $date, $replyId);";
    }
    else if ($editId > 0)//Edit review
    {
        $sql = "UPDATE review set userId = $userId, review = $review, userRating = $userRating, storyRating = $storyRating, artRating = $artRating, panelRating = $panelRating, date = $date, replyId = $replyId, active = $active WHERE id = $editId;";
    }
    echo $sql;
    $query = mysqli_query($con,$sql);
	
//UPDATES USER RATINGS	
	$newRating = 0;
	$total = 0;
	//get reviews for the toon
	$toon = mysqli_query($con, "SELECT *FROM review WHERE toonId = $toonId AND userRating > 0 AND active > -1;");	
	//returns toon that matches and adds up total user ratings
	while($row = mysqli_fetch_assoc($toon))
	{
		$newRating += $row['userRating'];
		$total += 1;
	}
	//get score from admin rating
	$toon = mysqli_query($con, "SELECT *FROM toon WHERE id = $toonId;");	
	//returns toon that matches and adds up total user ratings
	while($row = mysqli_fetch_assoc($toon))
	{
		$newRating += ($row['artRating']+$row['storyRating'])/2;
		$total += 1;
	}
	$newRating = (double)$newRating/$total;
	if ($total == 0)
	{
		$newRating = 0;
	}
	
	//Update webtoon user rating
	if ($toonId > 0)
    {
        $sql2 = "UPDATE toon set overallRating = $newRating WHERE id = $toonId;";
    }
	//echo $newRating;
	$query = mysqli_query($con,$sql2);
	
?>
